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
		array( 'citam-buruburu', 'CITAM Buruburu', 'CITAM Buruburu', 'Nairobi, Kenya', 'Houses of Worship', 'Worship', 'Worship', 'Professional Audio', 'citam-buruburu', 'A full dB Technologies T-Series system - T12/T8 front-of-house, S30 subwoofers, IG1 under-balcony fills and FMX15 monitors - driven by an Allen & Heath Avantis console for clear, powerful worship sound.', 10 ),
		array( 'all-saints-cathedral', 'All Saints Cathedral', 'All Saints Cathedral', 'Nairobi, Kenya', 'Houses of Worship', 'Worship', 'Worship', 'Acoustics', 'all-saints-cathedral', 'Acoustic treatment and audio enhancement for one of Africa’s largest cathedrals.', 20 ),
		array( 'pcea-chuka', 'PCEA Chuka', 'PCEA Chuka', 'Chuka, Kenya', 'Houses of Worship', 'Worship', 'Acoustics', 'Acoustics', 'pcea-chuka', 'Acoustic treatment of a highly reverberant church sanctuary with 740 square metres of Rockfon stone-wool ceiling panels, cutting reverberation from 3.3s to 1.1s for clear, intelligible speech.', 30 ),
		array( 'kabarak-university', 'Kabarak University', 'Kabarak University', 'Nairobi, Kenya', 'Education', 'Education', 'Education', 'System Integration', 'kabarak-university', 'Campus-wide PA system, lecture capture and auditorium integration.', 40 ),
		array( 'nairobi-chapel', 'Nairobi Chapel', 'Nairobi Chapel', 'Nairobi, Kenya', 'Houses of Worship', 'Worship', 'Worship', 'Professional Audio', 'chapel', 'High-performance audio solution delivering clarity and impact for modern worship.', 50 ),
		array( 'hotel-audio-solution', 'Hotel Audio Solution', 'Hotel Audio Solution', 'Dubai, UAE', 'Hospitality', 'Hospitality', 'Hospitality', 'Professional Audio', 'hotel', 'Distributed audio system for guest areas, restaurants and conference facilities.', 60 ),
		array( 'corporate-boardroom', 'Corporate Boardroom', 'Corporate Boardroom', 'Kigali, Rwanda', 'Corporate & Offices', 'Corporate', 'Corporate', 'System Integration', 'boardroom', 'Integrated AV solution for executive meetings and hybrid collaboration.', 70 ),
		array( 'live-event-production', 'Live Event Production', 'Live Event Production', 'DR Congo', 'Entertainment', 'Entertainment', 'Entertainment', 'Live Events', 'performance', 'Full sound reinforcement solution for large-scale live events and concerts.', 80 ),
	);
	$project_bodies = sc_core_project_bodies();
	foreach ( $projects as $pr ) {
		list( $slug, $title, $client, $loc, $industry, $cat, $badge, $sol, $img, $summary, $order ) = $pr;
		$body     = isset( $project_bodies[ $slug ] ) ? $project_bodies[ $slug ] : '';
		$existing = get_page_by_path( $slug, OBJECT, 'sc_project' );
		if ( $existing ) {
			$id  = (int) $existing->ID;
			$upd = array( 'ID' => $id, 'menu_order' => $order );
			// Refresh the body only while it is still the seeded [VERIFY] stub, so real
			// case-study content reaches the live site without clobbering team edits.
			if ( '' !== $body && false !== strpos( (string) $existing->post_content, '[VERIFY]' ) ) {
				$upd['post_content'] = $body;
			}
			wp_update_post( $upd );
		} else {
			$content = ( '' !== $body ) ? $body : 'Sound Creations delivered a professional audio installation for ' . $client . '. [VERIFY] Confirm the scope, equipment supplied and completion date before publishing.';
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

/**
 * Full case-study bodies (HTML) for featured projects, sourced from Sound Creations'
 * own project write-ups. Keyed by project slug. Used by the seeder for new projects and
 * to replace the seeded [VERIFY] stub on existing projects (never overwrites team edits).
 */
function sc_core_project_bodies() {
	$citam = <<<'HTML'
<p>We were honoured to deliver a comprehensive audio solution at CITAM Buruburu, tailored to the demands of a dynamic worship environment with clarity, power and precision.</p>
<h2>Front of house</h2>
<p>A full-range dB Technologies T-Series system (T12 and T8) delivers powerful, consistent sound across the main auditorium.</p>
<h2>Subwoofers</h2>
<p>dB Technologies S30 dual 18-inch subwoofers handle the low end, delivering impactful bass for both speech and music.</p>
<h2>Under-balcony fills</h2>
<p>dB Technologies IG1 speakers maintain coverage and clarity in the under-balcony seating areas.</p>
<h2>Stage monitors</h2>
<p>dB Technologies FMX15 monitors provide clear, powerful foldback for the worship team.</p>
<h2>Audio control</h2>
<p>At the heart of the system, an Allen &amp; Heath Avantis digital mixing console offers flexible, intuitive control and reliable performance for both live and broadcast applications.</p>
<p>This installation reflects our commitment to delivering scalable, high-quality audio-visual systems that elevate the worship experience.</p>
HTML;

	$pcea = <<<'HTML'
<p>"We have good sound! I can't believe our church sound system could sound so good." Those were the words that met Sound Creations on the visit to certify the completed acoustic treatment at P.C.E.A. Chuka, in Meru.</p>
<h2>The challenge</h2>
<p>The Presbyterian Church of East Africa (PCEA) sanctuary in Chuka had suffered from poor acoustics for years. The single-level, T-shaped building was finished in hard materials - a terrazzo floor, natural-stone walls and the exposed underside of an iron-sheet roof on steel trusses - creating a highly reverberant space that destroyed speech clarity. Reverberation-time measurements recorded up to 3.77 seconds at 125 Hz and an average of 3.32 seconds at mid frequencies (500-1,000 Hz), far above the 1.22 seconds recommended for intelligibility in a space of that volume.</p>
<h2>Design and installation</h2>
<p>To bring the reverberation time down, Sound Creations installed 740 square metres of Rockfon Artic stone-wool acoustic ceiling panels, suspended a minimum of 200 mm below the existing ceiling and following its slope. Rockfon Artic combines high sound absorption with fire protection, thermal insulation, humidity and microorganism resistance, and excellent light reflection.</p>
<h2>The results</h2>
<p>Post-installation measurements confirmed the reverberation time at mid frequencies had dropped from 3.3 seconds to 1.1 seconds - exactly as predicted - transforming speech intelligibility. The church also gained improved aesthetics, better thermal comfort and a brighter, more light-filled sanctuary. The committee expressed great satisfaction with the results.</p>
HTML;

	return array(
		'citam-buruburu' => $citam,
		'pcea-chuka'     => $pcea,
	);
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
