<?php
/**
 * Editorial custom fields for Products, Brands and Projects.
 *
 * @package SoundCreationsCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sc_core_field_groups() {
	return array(
		'sc_solution' => array(
			'title'  => 'Solution Details',
			'fields' => array(
				array( 'summary', 'One-line summary', 'text', 'Shown under the title and on cards' ),
				array( 'includes', 'What is included', 'textarea', 'One item per line' ),
				array( 'outcome', 'Key outcome', 'text', 'e.g. Intelligible speech in a reverberant hall' ),
			),
		),
		'sc_product' => array(
			'title'  => 'Product Details',
			'fields' => array(
				array( 'brand_name', 'Brand', 'text', 'e.g. FANE, NEXO, Shure' ),
				array( 'model', 'Model / SKU', 'text', '' ),
				array( 'availability', 'Availability', 'text', 'e.g. In stock, Available on indent' ),
				array( 'datasheet', 'Datasheet URL', 'url', 'Link to the manufacturer datasheet (PDF)' ),
				array( 'specs', 'Key specifications', 'textarea', 'One per line as Label: Value (e.g. Power: 600 W AES)' ),
			),
		),
		'sc_brand'   => array(
			'title'  => 'Brand Details',
			'fields' => array(
				array( 'origin', 'Country of origin', 'text', '' ),
				array( 'category', 'Category', 'text', 'e.g. Loudspeakers, DSP, Acoustics' ),
				array( 'tagline', 'Short tagline', 'text', '' ),
				array( 'website', 'Brand website', 'url', '' ),
			),
		),
		'sc_project' => array(
			'title'  => 'Project Details',
			'fields' => array(
				array( 'client', 'Client / venue', 'text', '' ),
				array( 'location', 'Location', 'text', '' ),
				array( 'year', 'Year completed', 'text', '' ),
				array( 'summary', 'One-line summary', 'text', '' ),
				array( 'scope', 'Scope of work', 'textarea', 'One item per line' ),
				array( 'brands_used', 'Brands used', 'text', 'Comma separated (optional if using the Brand taxonomy)' ),
			),
		),
	);
}

add_action(
	'add_meta_boxes',
	function () {
		foreach ( sc_core_field_groups() as $pt => $group ) {
			add_meta_box( 'sc_fields_' . $pt, $group['title'], 'sc_core_render_meta_box', $pt, 'normal', 'high' );
		}
	}
);

function sc_core_render_meta_box( $post ) {
	$groups = sc_core_field_groups();
	if ( ! isset( $groups[ $post->post_type ] ) ) {
		return;
	}
	wp_nonce_field( 'sc_core_fields', 'sc_core_fields_nonce' );
	echo '<style>.sc-mb{display:grid;gap:1rem;margin-top:.5rem;}.sc-mb label{font-weight:600;display:block;margin-bottom:.25rem;}.sc-mb input[type=text],.sc-mb input[type=url],.sc-mb textarea{width:100%;}.sc-mb .desc{color:#666;font-size:12px;margin:.2rem 0 0;}</style>';
	echo '<div class="sc-mb">';
	foreach ( $groups[ $post->post_type ]['fields'] as $f ) {
		list( $key, $label, $type, $help ) = $f;
		$val = get_post_meta( $post->ID, '_sc_' . $key, true );
		$id  = 'sc_' . $key;
		echo '<div>';
		echo '<label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
		if ( 'textarea' === $type ) {
			echo '<textarea id="' . esc_attr( $id ) . '" name="sc_fields[' . esc_attr( $key ) . ']" rows="5">' . esc_textarea( $val ) . '</textarea>';
		} else {
			$it = ( 'url' === $type ) ? 'url' : 'text';
			echo '<input type="' . esc_attr( $it ) . '" id="' . esc_attr( $id ) . '" name="sc_fields[' . esc_attr( $key ) . ']" value="' . esc_attr( $val ) . '">';
		}
		if ( $help ) {
			echo '<p class="desc">' . esc_html( $help ) . '</p>';
		}
		echo '</div>';
	}
	echo '</div>';
}

add_action(
	'save_post',
	function ( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['sc_core_fields_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sc_core_fields_nonce'] ) ), 'sc_core_fields' ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$groups = sc_core_field_groups();
		$pt     = get_post_type( $post_id );
		if ( ! isset( $groups[ $pt ] ) ) {
			return;
		}
		$in = ( isset( $_POST['sc_fields'] ) && is_array( $_POST['sc_fields'] ) ) ? wp_unslash( $_POST['sc_fields'] ) : array();
		foreach ( $groups[ $pt ]['fields'] as $f ) {
			list( $key, $label, $type, $help ) = $f;
			$raw = isset( $in[ $key ] ) ? $in[ $key ] : '';
			if ( 'textarea' === $type ) {
				$clean = sanitize_textarea_field( $raw );
			} elseif ( 'url' === $type ) {
				$clean = esc_url_raw( trim( $raw ) );
			} else {
				$clean = sanitize_text_field( $raw );
			}
			update_post_meta( $post_id, '_sc_' . $key, $clean );
		}
	}
);
