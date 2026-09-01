<?php
/**
 * Custom post types.
 *
 * @package SoundCreationsCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sc_core_register_post_types() {
	$types = array(
		'sc_project'       => array( 'Project', 'Projects', 'projects', 'dashicons-portfolio' ),
		'sc_product'       => array( 'Product', 'Products', 'products', 'dashicons-products' ),
		'sc_brand'         => array( 'Brand', 'Brands', 'brands', 'dashicons-awards' ),
		'sc_solution'      => array( 'Solution', 'Solutions', 'solutions', 'dashicons-analytics' ),
		'sc_case_study'    => array( 'Case Study', 'Case Studies', 'case-studies', 'dashicons-media-document' ),
		'sc_resource'      => array( 'Resource', 'Resources', 'resources', 'dashicons-download' ),
		'sc_fane_resource' => array( 'FANE Resource', 'FANE Resources', 'fane-resources', 'dashicons-format-audio' ),
	);

	foreach ( $types as $slug => $data ) {
		list( $single, $plural, $rewrite, $icon ) = $data;
		register_post_type(
			$slug,
			array(
				'labels'       => array(
					'name'          => $plural,
					'singular_name' => $single,
					'add_new_item'  => 'Add New ' . $single,
					'edit_item'     => 'Edit ' . $single,
					'menu_name'     => $plural,
				),
				'public'       => true,
				'has_archive'  => true,
				'menu_icon'    => $icon,
				'rewrite'      => array( 'slug' => $rewrite, 'with_front' => false ),
				'show_in_rest' => true,
				'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
			)
		);
	}

	// Enquiries: private storage so no lead is ever lost.
	register_post_type(
		'sc_enquiry',
		array(
			'labels'          => array( 'name' => 'Enquiries', 'singular_name' => 'Enquiry', 'menu_name' => 'Enquiries' ),
			'public'          => false,
			'show_ui'         => true,
			'menu_icon'       => 'dashicons-email-alt',
			'capability_type' => 'post',
			'supports'        => array( 'title', 'custom-fields' ),
		)
	);
}
add_action( 'init', 'sc_core_register_post_types' );
