<?php
/**
 * Sound Creations Child theme functions.
 *
 * @package SoundCreationsChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'wp_enqueue_scripts',
	function () {
		// Parent stylesheets (sc-tokens, sc-main) are already enqueued by the parent theme.
		wp_enqueue_style(
			'soundcreations-child',
			get_stylesheet_directory_uri() . '/style.css',
			array( 'sc-main' ),
			wp_get_theme()->get( 'Version' )
		);
	},
	30
);
