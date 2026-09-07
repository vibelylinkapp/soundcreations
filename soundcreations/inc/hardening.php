<?php
/**
 * Front-end and admin hardening + lightweight performance cleanup.
 * Conservative by design: nothing here removes functionality the site relies on.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}

/* 1. Trim wp_head cruft (information disclosure + a few bytes). */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

/* Strip only the WordPress core version from asset URLs (keeps our filemtime cache-busting). */
function sc_strip_core_ver( $src ) {
	$wpver = get_bloginfo( 'version' );
	if ( $wpver && strpos( $src, 'ver=' . $wpver ) !== false ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'sc_strip_core_ver', 20 );
add_filter( 'script_loader_src', 'sc_strip_core_ver', 20 );

/* 2. Disable the emoji detection script/styles (removes an inline script + requests). */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter(
	'tiny_mce_plugins',
	function ( $plugins ) {
		return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	}
);
add_filter( 'emoji_svg_url', '__return_false' );

/* 3. Disable oEmbed discovery links and the front-end wp-embed.js. */
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_deregister_script( 'wp-embed' );
	},
	100
);

/* 4. Turn off XML-RPC and pingback (brute-force / DDoS-amplification surface). */
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter(
	'xmlrpc_methods',
	function ( $methods ) {
		unset( $methods['pingback.ping'], $methods['pingback.extensions.getPingbacks'] );
		return $methods;
	}
);

/* 5. Response headers: strip X-Pingback, add baseline security headers. */
add_filter(
	'wp_headers',
	function ( $headers ) {
		unset( $headers['X-Pingback'] );
		$headers['X-Content-Type-Options'] = 'nosniff';
		$headers['X-Frame-Options']        = 'SAMEORIGIN';
		$headers['Referrer-Policy']        = 'strict-origin-when-cross-origin';
		$headers['Permissions-Policy']     = 'geolocation=(), microphone=(), camera=()';
		$headers['Cross-Origin-Opener-Policy'] = 'same-origin';
		if ( is_ssl() ) {
			$headers['Strict-Transport-Security'] = 'max-age=31536000';
		}
		return $headers;
	}
);

/* 6. Block user enumeration via ?author=N scans. */
add_action(
	'template_redirect',
	function () {
		if ( is_admin() || is_user_logged_in() ) {
			return;
		}
		if ( isset( $_GET['author'] ) && '' !== $_GET['author'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only guard, value unused.
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
	}
);

/* 7. Block the REST users endpoints for logged-out visitors (enumeration). */
add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		if ( is_user_logged_in() ) {
			return $endpoints;
		}
		unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		return $endpoints;
	}
);

/* 8. Generic login error (no username/password hinting). */
add_filter(
	'login_errors',
	function () {
		return __( 'Invalid login details. Please try again.', 'soundcreations' );
	}
);

/* 9. Disable the built-in wp-admin theme/plugin file editor (post-compromise pivot). */
if ( defined( 'DISALLOW_FILE_EDIT' ) === false ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/* 10. Disable comments and trackbacks entirely (spam prevention: the site never uses them). */

// Force comments and pings closed everywhere, ignoring any per-post stored value.
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );

// Hide any pre-existing comments from the front end.
add_filter( 'comments_array', '__return_empty_array', 20 );

// Reject any comment posted directly (e.g. a bot POSTing to wp-comments-post.php).
add_filter(
	'preprocess_comment',
	function ( $commentdata ) {
		unset( $commentdata );
		wp_die(
			esc_html__( 'Comments are closed.', 'soundcreations' ),
			esc_html__( 'Comments are closed', 'soundcreations' ),
			array( 'response' => 403 )
		);
	},
	0
);

// Remove comment and trackback support from every registered post type.
add_action(
	'init',
	function () {
		foreach ( get_post_types() as $sc_pt ) {
			if ( post_type_supports( $sc_pt, 'comments' ) === true ) {
				remove_post_type_support( $sc_pt, 'comments' );
			}
			if ( post_type_supports( $sc_pt, 'trackbacks' ) === true ) {
				remove_post_type_support( $sc_pt, 'trackbacks' );
			}
		}
	},
	100
);

// Remove the comments REST endpoints (a common spam-injection route).
add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		foreach ( array_keys( $endpoints ) as $sc_route ) {
			if ( strpos( $sc_route, '/wp/v2/comments' ) === 0 ) {
				unset( $endpoints[ $sc_route ] );
			}
		}
		return $endpoints;
	}
);

// Block the comment feeds so spam can never resurface through them.
add_action(
	'template_redirect',
	function () {
		if ( is_comment_feed() === true ) {
			wp_die(
				esc_html__( 'Comments are closed.', 'soundcreations' ),
				esc_html__( 'Comments are closed', 'soundcreations' ),
				array( 'response' => 403 )
			);
		}
	},
	9
);

// Admin: remove the Comments menu, admin-bar node, dashboard widget and post metaboxes.
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);
add_action(
	'admin_bar_menu',
	function ( $sc_bar ) {
		$sc_bar->remove_node( 'comments' );
	},
	999
);
add_action(
	'wp_dashboard_setup',
	function () {
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	}
);
add_action(
	'add_meta_boxes',
	function () {
		foreach ( get_post_types() as $sc_pt ) {
			remove_meta_box( 'commentsdiv', $sc_pt, 'normal' );
			remove_meta_box( 'commentstatusdiv', $sc_pt, 'normal' );
			remove_meta_box( 'trackbacksdiv', $sc_pt, 'normal' );
		}
	},
	100
);

// Send anyone who reaches the admin Comments screen back to the dashboard.
add_action(
	'admin_init',
	function () {
		global $pagenow;
		if ( 'edit-comments.php' === $pagenow ) {
			wp_safe_redirect( admin_url() );
			exit;
		}
	}
);
