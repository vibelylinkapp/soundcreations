<?php
/**
 * Asset loading.
 *
 * @package SoundCreations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'wp_enqueue_scripts',
	function () {
		// Design tokens + @font-face are inlined in <head> (see below) to remove two
		// render-blocking requests and apply the preloaded fonts immediately.
		wp_enqueue_style( 'sc-main', SC_THEME_URI . '/assets/css/main.css', array(), SC_THEME_VERSION );
		wp_enqueue_style( 'sc-content', SC_THEME_URI . '/assets/css/content.css', array( 'sc-main' ), SC_THEME_VERSION );

		wp_enqueue_script( 'sc-theme', SC_THEME_URI . '/assets/js/theme.js', array(), SC_THEME_VERSION, true );
		wp_enqueue_script( 'sc-map', SC_THEME_URI . '/assets/js/map.js', array(), SC_THEME_VERSION, true );
	},
	20
);

// Set the saved / default (dark) colour theme before first paint to avoid a flash.
add_action(
	'wp_head',
	function () {
		echo "<script>(function(){try{var t=localStorage.getItem('sc-theme');if(t!=='light'&&t!=='dark'){t='dark';}document.documentElement.setAttribute('data-theme',t);}catch(e){document.documentElement.setAttribute('data-theme','dark');}})();</script>\n";
	},
	0
);

// Preload the primary self-hosted fonts and the LCP hero image for faster first paint.
add_action(
	'wp_head',
	function () {
		$u = SC_THEME_URI;
		echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="' . esc_url( $u . '/assets/fonts/inter-400.woff2' ) . '">' . "\n";
		echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="' . esc_url( $u . '/assets/fonts/space-grotesk-700.woff2' ) . '">' . "\n";
		if ( is_front_page() ) {
			echo '<link rel="preload" as="image" fetchpriority="high" href="' . esc_url( $u . '/assets/img/hero-poster.jpg' ) . '">' . "\n";
		} elseif ( is_page( 'about' ) ) {
			echo '<link rel="preload" as="image" fetchpriority="high" href="' . esc_url( $u . '/assets/img/about-photo.jpg' ) . '">' . "\n";
		}
	},
	1
);


// Inline critical CSS (design tokens + @font-face) so above-the-fold content can
// be styled and painted without waiting for two extra render-blocking stylesheets.
// Relative font URLs are rewritten to absolute so they resolve from the document.
add_action(
	'wp_head',
	function () {
		$sc_css = '';
		foreach ( array( 'tokens.css', 'fonts.css' ) as $sc_file ) {
			$sc_path = SC_THEME_DIR . '/assets/css/' . $sc_file;
			if ( is_readable( $sc_path ) ) {
				$sc_css .= file_get_contents( $sc_path );
			}
		}
		if ( '' === $sc_css ) {
			return;
		}
		$sc_css = str_replace( '../fonts/', SC_THEME_URI . '/assets/fonts/', $sc_css );
		echo '<style id="sc-critical-inline">' . $sc_css . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party CSS.
	},
	2
);
