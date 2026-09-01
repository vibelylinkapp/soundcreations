<?php
/**
 * Enquiry submission handler: validation, spam protection, storage and notification.
 *
 * @package SoundCreationsEnquiries
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sc_enq_redirect( $url, $status, $code ) {
	$url = remove_query_arg( array( 'sc_sent', 'sc_error' ), $url );
	if ( 'sent' === $status ) {
		$url = add_query_arg( 'sc_sent', '1', $url );
	} else {
		$url = add_query_arg( 'sc_error', $code, $url );
	}
	wp_safe_redirect( $url . '#sc-form' );
	exit;
}

function sc_enq_recipient( $type ) {
	$over = get_option( 'sc_enq_recipients', array() );
	if ( is_array( $over ) && ! empty( $over[ $type ] ) && is_email( $over[ $type ] ) ) {
		return $over[ $type ];
	}
	if ( is_array( $over ) && ! empty( $over['default'] ) ) {
		return $over['default'];
	}
	$settings = get_option( 'soundcreations_settings', array() );
	if ( is_array( $settings ) && ! empty( $settings['email'] ) && is_email( $settings['email'] ) ) {
		return $settings['email'];
	}
	return 'info@soundcreationsltd.com';
}

function sc_enq_summary( $form, $data, $file_url, $ip ) {
	$lines   = array();
	$lines[] = 'New ' . $form['subject'] . ' enquiry';
	$lines[] = '';
	foreach ( $form['fields'] as $fld ) {
		if ( 'file' === $fld[2] ) {
			continue;
		}
		$name = $fld[0];
		$val  = isset( $data[ $name ] ) ? $data[ $name ] : '';
		if ( '' !== $val ) {
			$lines[] = $fld[1] . ': ' . $val;
		}
	}
	if ( $file_url ) {
		$lines[] = 'Attachment: ' . $file_url;
	}
	if ( '' !== $ip ) {
		$lines[] = '';
		$lines[] = 'IP: ' . $ip;
		$lines[] = 'Submitted: ' . current_time( 'mysql' );
	}
	return implode( "\n", $lines );
}

function sc_enq_handle_upload() {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	if ( empty( $_FILES['sc_file']['name'] ) ) {
		return '';
	}
	if ( isset( $_FILES['sc_file']['size'] ) && (int) $_FILES['sc_file']['size'] > 8 * 1024 * 1024 ) {
		return '';
	}
	$mimes     = array(
		'pdf'  => 'application/pdf',
		'doc'  => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'jpg'  => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'png'  => 'image/png',
	);
	$overrides = array( 'test_form' => false, 'mimes' => $mimes );
	$moved     = wp_handle_upload( $_FILES['sc_file'], $overrides );
	if ( is_array( $moved ) && isset( $moved['url'] ) && empty( $moved['error'] ) ) {
		return esc_url_raw( $moved['url'] );
	}
	return '';
}

function sc_enq_handle() {
	$forms    = sc_enq_forms();
	$type     = isset( $_POST['sc_type'] ) ? sanitize_key( wp_unslash( $_POST['sc_type'] ) ) : '';
	$redirect = isset( $_POST['sc_redirect'] ) ? esc_url_raw( wp_unslash( $_POST['sc_redirect'] ) ) : home_url( '/' );

	$nonce = isset( $_POST['sc_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'sc_enquiry_submit' ) ) {
		sc_enq_redirect( $redirect, 'error', 'spam' );
	}
	if ( ! isset( $forms[ $type ] ) ) {
		sc_enq_redirect( $redirect, 'error', 'spam' );
	}
	// Honeypot: silently accept so bots do not retry.
	if ( ! empty( $_POST['sc_website'] ) ) {
		sc_enq_redirect( $redirect, 'sent', '1' );
	}
	// Time trap.
	$rendered = isset( $_POST['sc_rendered'] ) ? absint( $_POST['sc_rendered'] ) : 0;
	if ( $rendered && ( time() - $rendered ) < 3 ) {
		sc_enq_redirect( $redirect, 'error', 'spam' );
	}
	// Rate limit.
	$ip    = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$rlkey = 'sc_enq_rl_' . md5( $ip );
	$count = (int) get_transient( $rlkey );
	if ( $count >= 8 ) {
		sc_enq_redirect( $redirect, 'error', 'rate' );
	}

	$form = $forms[ $type ];

	if ( ! empty( $form['consent'] ) && empty( $_POST['sc_consent'] ) ) {
		sc_enq_redirect( $redirect, 'error', 'validation' );
	}

	$data = array();
	foreach ( $form['fields'] as $fld ) {
		$name  = $fld[0];
		$ftype = $fld[2];
		$req   = ! empty( $fld[3] );
		if ( 'file' === $ftype ) {
			continue;
		}
		$raw = isset( $_POST[ $name ] ) ? wp_unslash( $_POST[ $name ] ) : '';
		if ( 'textarea' === $ftype ) {
			$val = sanitize_textarea_field( $raw );
		} elseif ( 'email' === $name ) {
			$val = sanitize_email( $raw );
		} else {
			$val = sanitize_text_field( $raw );
		}
		if ( $req && '' === $val ) {
			sc_enq_redirect( $redirect, 'error', 'validation' );
		}
		if ( 'email' === $name && $val && ! is_email( $val ) ) {
			sc_enq_redirect( $redirect, 'error', 'validation' );
		}
		$data[ $name ] = $val;
	}

	$file_url = sc_enq_handle_upload();

	$country = isset( $data['country'] ) ? $data['country'] : '';
	$who     = isset( $data['name'] ) ? $data['name'] : 'Unknown';
	$title   = $form['subject'] . ' - ' . $who . ( $country ? ' (' . $country . ')' : '' );

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'sc_enquiry',
			'post_status'  => 'publish',
			'post_title'   => wp_strip_all_tags( $title ),
			'post_content' => sc_enq_summary( $form, $data, $file_url, $ip ),
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_sc_type', $type );
		foreach ( $data as $k => $v ) {
			update_post_meta( $post_id, '_sc_' . $k, $v );
		}
		if ( $file_url ) {
			update_post_meta( $post_id, '_sc_file', $file_url );
		}
		update_post_meta( $post_id, '_sc_ip', $ip );
		update_post_meta( $post_id, '_sc_source', $redirect );
	}

	// Notify.
	$recipient = sc_enq_recipient( $type );
	$subject   = 'New ' . $form['subject'] . ' enquiry' . ( $country ? ' - ' . $country : '' );
	$body      = sc_enq_summary( $form, $data, $file_url, '' ) . "\n\nSource: " . $redirect;
	$headers   = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( ! empty( $data['email'] ) && is_email( $data['email'] ) ) {
		$from_name = ! empty( $data['name'] ) ? $data['name'] : 'Website enquiry';
		$headers[] = 'Reply-To: ' . $from_name . ' <' . $data['email'] . '>';
	}
	wp_mail( $recipient, $subject, $body, $headers );

	set_transient( $rlkey, $count + 1, 600 );

	sc_enq_redirect( $redirect, 'sent', '1' );
}
add_action( 'admin_post_nopriv_sc_enquiry', 'sc_enq_handle' );
add_action( 'admin_post_sc_enquiry', 'sc_enq_handle' );
