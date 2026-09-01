<?php
/**
 * Sample catalog seeder: starter Brands, Products and Projects.
 * Idempotent by slug. Unverified details are flagged [VERIFY] for the team to complete.
 *
 * @package SoundCreationsCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sc_core_get_or_create_term( $name, $taxonomy ) {
	if ( ! taxonomy_exists( $taxonomy ) ) {
		return 0;
	}
	$term = get_term_by( 'name', $name, $taxonomy );
	if ( $term ) {
		return (int) $term->term_id;
	}
	$res = wp_insert_term( $name, $taxonomy );
	if ( is_wp_error( $res ) ) {
		return 0;
	}
	return (int) $res['term_id'];
}

function sc_core_seed_catalog() {
	$report = array( 'brands' => 0, 'products' => 0, 'projects' => 0 );

	// Brands we represent. Order is driven by menu_order (editable in wp-admin via the
	// "Order" field on each Brand) so the /brands/ page is not hardcoded. Logo maps to a
	// PNG in the active theme at assets/img/brands/logos/{logo}.png; FANE has no supplied
	// logo yet and falls back to a styled wordmark. Tuple: slug, title, origin, category,
	// tagline, menu_order, logo.
	$brands = array(
		array( 'db-technologies', 'dB Technologies', 'Italy', 'Loudspeakers & Amplification', 'Active loudspeakers and amplification engineered in Italy.', 10, 'db-technologies' ),
		array( 'nexo', 'NEXO', 'France', 'Loudspeaker Systems', 'Innovative loudspeaker systems designed and built in France.', 20, 'nexo' ),
		array( 'fane', 'FANE', 'United Kingdom', 'Loudspeaker Components', 'Precision-engineered drivers and components, built in the UK since 1954.', 30, 'fane' ),
		array( 'shure', 'Shure', 'United States', 'Microphones & Wireless', 'Industry-leading microphones and wireless audio systems.', 40, 'shure' ),
		array( 'midas', 'Midas', 'United Kingdom', 'Mixing Consoles', 'Legendary digital and analogue mixing consoles trusted worldwide.', 50, 'midas' ),
		array( 'biamp', 'Biamp', 'United States', 'DSP & Conferencing', 'Audio DSP, conferencing and collaboration solutions.', 60, 'biamp' ),
		array( 'behringer', 'Behringer', 'Germany', 'Mixing & Amplification', 'Accessible professional audio, mixing and amplification.', 70, 'behringer' ),
		array( 'rockfon', 'Rockfon', 'Denmark', 'Acoustic Ceilings', 'High-performance acoustic ceiling and wall solutions.', 80, 'rockfon' ),
		array( 'barrisol', 'Barrisol', 'France', 'Acoustic & Stretch Ceilings', 'Acoustic and stretch-ceiling systems for modern spaces.', 90, 'barrisol' ),
		array( 'sommer-cable', 'Sommer Cable', 'Germany', 'Cables & Infrastructure', 'Professional audio, video and signal cabling solutions.', 100, 'somer-cable' ),
		array( 'chamsys', 'ChamSys', 'United Kingdom', 'Lighting Control', 'Professional lighting control consoles and software.', 110, 'chamsys' ),
	);
	foreach ( $brands as $b ) {
		list( $slug, $title, $origin, $cat, $tag, $order, $logo ) = $b;
		$existing = get_page_by_path( $slug, OBJECT, 'sc_brand' );
		if ( $existing ) {
			// Upsert: keep any team-edited body, but sync order + meta.
			$id = (int) $existing->ID;
			wp_update_post(
				array(
					'ID'         => $id,
					'menu_order' => $order,
				)
			);
		} else {
			$content = $title . ' is among the professional brands represented by Sound Creations. [VERIFY] Confirm the brand description and distribution status before publishing.';
			$id      = wp_insert_post(
				array(
					'post_type'    => 'sc_brand',
					'post_status'  => 'publish',
					'post_title'   => $title,
					'post_name'    => $slug,
					'post_content' => $content,
					'menu_order'   => $order,
				)
			);
		}
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_sc_origin', $origin );
			update_post_meta( $id, '_sc_category', $cat );
			update_post_meta( $id, '_sc_tagline', $tag );
			update_post_meta( $id, '_sc_logo', $logo );
			$report['brands']++;
		}
	}

	// FANE products: model names verified from the brief; specs left for the team to add from datasheets.
	$cat_term  = sc_core_get_or_create_term( 'Loudspeaker Components', 'sc_product_category' );
	$fane_term = sc_core_get_or_create_term( 'FANE', 'sc_brand_tax' );
	$products  = array(
		array( 'fane-colossus-18xb', 'FANE Colossus 18XB', '18-inch subwoofer driver' ),
		array( 'fane-imperium-18xl', 'FANE Imperium 18XL', '18-inch low-frequency driver' ),
		array( 'fane-sovereign-15-600', 'FANE Sovereign 15-600', '15-inch low-mid driver' ),
		array( 'fane-sovereign-12-250tc', 'FANE Sovereign 12-250TC', '12-inch driver' ),
		array( 'fane-cd140', 'FANE CD140', 'Compression driver' ),
	);
	foreach ( $products as $p ) {
		list( $slug, $title, $kind ) = $p;
		if ( get_page_by_path( $slug, OBJECT, 'sc_product' ) ) {
			continue;
		}
		$content = $kind . '. [VERIFY] Add the full product description and datasheet specifications from the FANE datasheet before publishing.';
		$id      = wp_insert_post(
			array(
				'post_type'    => 'sc_product',
				'post_status'  => 'publish',
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => $content,
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_sc_brand_name', 'FANE' );
			update_post_meta( $id, '_sc_model', trim( str_replace( 'FANE ', '', $title ) ) );
			update_post_meta( $id, '_sc_availability', 'Available on indent' );
			if ( $cat_term ) {
				wp_set_object_terms( $id, array( $cat_term ), 'sc_product_category' );
			}
			if ( $fane_term ) {
				wp_set_object_terms( $id, array( $fane_term ), 'sc_brand_tax' );
			}
			$report['products']++;
		}
	}

	// Projects shown on the /projects/ archive. Order via menu_order (editable in wp-admin).
	// Tuple: slug, title, client, location, industry, category (filter), badge, solution, image, summary, menu_order.
	$projects = array(
		array( 'citam-buruburu', 'CITAM Buruburu', 'CITAM Buruburu', 'Nairobi, Kenya', 'Houses of Worship', 'Worship', 'Worship', 'Professional Audio', 'worship', 'Complete audio system upgrade including line array, stage monitors and digital mixing.', 10 ),
		array( 'all-saints-cathedral', 'All Saints Cathedral', 'All Saints Cathedral', 'Nairobi, Kenya', 'Houses of Worship', 'Worship', 'Worship', 'Acoustics', 'cathedral', 'Acoustic treatment and audio enhancement for one of Africa’s largest cathedrals.', 20 ),
		array( 'pcea-chuka', 'PCEA Chuka', 'PCEA Chuka', 'Chuka, Kenya', 'Conference & Events', 'Conference & Events', 'Conference', 'Conferencing', 'conference', 'Modern conference system with DSP, microphones and control integration.', 30 ),
		array( 'kabarak-university', 'Kabarak University', 'Kabarak University', 'Nairobi, Kenya', 'Education', 'Education', 'Education', 'System Integration', 'campus', 'Campus-wide PA system, lecture capture and auditorium integration.', 40 ),
		array( 'nairobi-chapel', 'Nairobi Chapel', 'Nairobi Chapel', 'Nairobi, Kenya', 'Houses of Worship', 'Worship', 'Worship', 'Professional Audio', 'chapel', 'High-performance audio solution delivering clarity and impact for modern worship.', 50 ),
		array( 'hotel-audio-solution', 'Hotel Audio Solution', 'Hotel Audio Solution', 'Dubai, UAE', 'Hospitality', 'Hospitality', 'Hospitality', 'Professional Audio', 'hotel', 'Distributed audio system for guest areas, restaurants and conference facilities.', 60 ),
		array( 'corporate-boardroom', 'Corporate Boardroom', 'Corporate Boardroom', 'Kigali, Rwanda', 'Corporate & Offices', 'Corporate', 'Corporate', 'System Integration', 'boardroom', 'Integrated AV solution for executive meetings and hybrid collaboration.', 70 ),
		array( 'live-event-production', 'Live Event Production', 'Live Event Production', 'DR Congo', 'Entertainment', 'Entertainment', 'Entertainment', 'Live Events', 'performance', 'Full sound reinforcement solution for large-scale live events and concerts.', 80 ),
	);
	foreach ( $projects as $pr ) {
		list( $slug, $title, $client, $loc, $industry, $cat, $badge, $sol, $img, $summary, $order ) = $pr;
		$existing = get_page_by_path( $slug, OBJECT, 'sc_project' );
		if ( $existing ) {
			$id = (int) $existing->ID;
			wp_update_post( array( 'ID' => $id, 'menu_order' => $order ) );
		} else {
			$content = 'Sound Creations delivered a professional audio installation for ' . $client . '. [VERIFY] Confirm the scope, equipment supplied and completion date before publishing.';
			$id      = wp_insert_post(
				array(
					'post_type'    => 'sc_project',
					'post_status'  => 'publish',
					'post_title'   => $title,
					'post_name'    => $slug,
					'post_content' => $content,
					'menu_order'   => $order,
				)
			);
		}
		if ( $id && is_wp_error( $id ) === false ) {
			update_post_meta( $id, '_sc_client', $client );
			update_post_meta( $id, '_sc_location', $loc );
			update_post_meta( $id, '_sc_summary', $summary );
			update_post_meta( $id, '_sc_category', $cat );
			update_post_meta( $id, '_sc_badge', $badge );
			update_post_meta( $id, '_sc_solution', $sol );
			update_post_meta( $id, '_sc_image', $img );
			$it = sc_core_get_or_create_term( $industry, 'sc_industry' );
			if ( $it ) {
				wp_set_object_terms( $id, array( $it ), 'sc_industry' );
			}
			$lt = sc_core_get_or_create_term( $loc, 'sc_location' );
			if ( $lt ) {
				wp_set_object_terms( $id, array( $lt ), 'sc_location' );
			}
			$report['projects']++;
		}
	}

	return $report;

}

// Auto re-run the (idempotent) seeder once after a plugin update so brand order,
// logos and new brands sync without visiting the Sample Catalog page manually.
add_action(
	'admin_init',
	function () {
		if ( get_option( 'sc_core_seed_version' ) === SC_CORE_SEED_VERSION ) {
			return;
		}
		if ( function_exists( 'sc_core_seed_catalog' ) ) {
			sc_core_seed_catalog();
			update_option( 'sc_core_seed_version', SC_CORE_SEED_VERSION );
		}
	}
);

add_action(
	'admin_menu',
	function () {
		add_submenu_page( 'sc-settings', 'Sample Catalog', 'Sample Catalog', 'manage_options', 'sc-seed-catalog', 'sc_core_render_seed_page' );
	},
	20
);

function sc_core_render_seed_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$rep = get_transient( 'sc_core_seed_report' );
	if ( $rep ) {
		delete_transient( 'sc_core_seed_report' );
	}
	?>
	<div class="wrap">
		<h1>Sample Catalog</h1>
		<p>Creates starter Brands, Products and Projects so those sections have real content. Idempotent - existing items (matched by slug) are skipped. Items flagged [VERIFY] are stubs for your team to confirm and complete.</p>
		<?php if ( is_array( $rep ) ) : ?>
			<div class="notice notice-success"><p>Added <?php echo (int) $rep['brands']; ?> brands, <?php echo (int) $rep['products']; ?> products and <?php echo (int) $rep['projects']; ?> projects. If any archive link shows 404, visit Settings -> Permalinks and click Save Changes once.</p></div>
		<?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="sc_core_seed_catalog">
			<?php wp_nonce_field( 'sc_core_seed_catalog' ); ?>
			<?php submit_button( 'Create sample catalog' ); ?>
		</form>
	</div>
	<?php
}

add_action(
	'admin_post_sc_core_seed_catalog',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Insufficient permissions.' );
		}
		check_admin_referer( 'sc_core_seed_catalog' );
		$rep = sc_core_seed_catalog();
		set_transient( 'sc_core_seed_report', $rep, 60 );
		wp_safe_redirect( admin_url( 'admin.php?page=sc-seed-catalog' ) );
		exit;
	}
);
