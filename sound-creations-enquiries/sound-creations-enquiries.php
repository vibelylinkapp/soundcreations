<?php
/**
 * Plugin Name:       Sound Creations Enquiries
 * Plugin URI:        https://soundcreationsltd.com/
 * Description:       Professional B2B enquiry system for Sound Creations: consultation, quote, product, dealer, FANE and support forms with conditional fields, lead routing, secure storage, email notification and spam protection.
 * Version:           0.1.6
 * Requires at least: 6.4
 * Requires PHP:      8.0
 * Author:            Sound Creations Ltd
 * License:           GPL-2.0-or-later
 * Text Domain:       sc-enquiries
 *
 * @package SoundCreationsEnquiries
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SC_ENQ_VERSION', '0.1.6' );
define( 'SC_ENQ_DIR', plugin_dir_path( __FILE__ ) );
define( 'SC_ENQ_URI', plugin_dir_url( __FILE__ ) );

require_once SC_ENQ_DIR . 'includes/forms.php';
require_once SC_ENQ_DIR . 'includes/handler.php';
require_once SC_ENQ_DIR . 'includes/admin.php';

// Ensure a private enquiry store exists even if the Core plugin is not active.
add_action(
	'init',
	function () {
		if ( ! post_type_exists( 'sc_enquiry' ) ) {
			register_post_type(
				'sc_enquiry',
				array(
					'labels'          => array( 'name' => 'Enquiries', 'singular_name' => 'Enquiry', 'menu_name' => 'Enquiries' ),
					'public'          => false,
					'show_ui'         => true,
					'menu_icon'       => 'dashicons-email-alt',
					'capability_type' => 'post',
					'supports'        => array( 'title', 'editor', 'custom-fields' ),
				)
			);
		}
	},
	20
);
