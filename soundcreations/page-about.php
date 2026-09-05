<?php
/**
 * About page. Auto-applies to the page with slug "about".
 *
 * Simplified layout: a single About + history block with a photo,
 * followed by What We Do, Our Brands, and downloadable Company Profiles.
 * All copy and the photo are editable in Sound Creations -> Settings.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_about_photo = sc_setting( 'about_hero_image', SC_THEME_URI . '/assets/img/about-photo.jpg' );

$sc_exp_default = "Distribution | Importation and distribution of world-class audio, visual, lighting and acoustic equipment.\nSystem Integration | Design, installation and integration of complete audio-visual and control systems.\nAcoustic Consultancy | Acoustic design, analysis and treatment for optimal sound performance.\nTechnical Training | Manufacturer-certified training for technicians, consultants and end users.\nProduct Demonstrations | In-house and on-site demos to help you experience the right technology.\nDealer Development | Supporting partners with tools, training and go-to-market strategies.\nWarranty Support | Official product warranty management and technical back-up.\nAfter-Sales Service | Ongoing support, maintenance and service to keep your systems performing.";
$sc_exp_raw   = sc_setting( 'about_exp_items', $sc_exp_default );
$sc_exp_items = array();
foreach ( preg_split( "/\r\n|\r|\n/", $sc_exp_raw ) as $sc_line ) {
	$sc_line = trim( $sc_line );
	if ( $sc_line === '' ) {
		continue;
	}
	$sc_parts       = array_map( 'trim', explode( '|', $sc_line, 2 ) );
	$sc_exp_items[] = array( 'title' => $sc_parts[0], 'desc' => isset( $sc_parts[1] ) ? $sc_parts[1] : '' );
}
$sc_exp_icons = array(
	'<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.27 6.96 12 12.01l8.73-5.05"/><path d="M12 22.08V12"/>',
	'<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M9 2v2"/><path d="M15 2v2"/><path d="M9 20v2"/><path d="M15 20v2"/><path d="M20 9h2"/><path d="M20 14h2"/><path d="M2 9h2"/><path d="M2 14h2"/>',
	'<path d="M12 3v18"/><path d="M8 6v12"/><path d="M4 9v6"/><path d="M16 6v12"/><path d="M20 9v6"/>',
	'<path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1 2 2 6 2s6-1 6-2v-5"/>',
	'<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/>',
	'<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
	'<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/>',
	'<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>',
);
?>

<section class="sc-about-hero sc-section--tight" id="about-intro">
	<div class="sc-container sc-journey">
		<div class="sc-journey__text">
			<span class="sc-journey__badge"><?php echo esc_html( sc_setting( 'about_journey_badge', 'Since 2004' ) ); ?></span>
			<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'about_hero_eyebrow', 'About Sound Creations' ) ); ?></p>
			<h1 class="sc-about-hero__title"><?php echo esc_html( sc_setting( 'about_hero_title', 'Engineering exceptional sound across Africa & the Middle East.' ) ); ?></h1>
			<p class="sc-journey__lead"><?php echo esc_html( sc_setting( 'about_journey_p1', 'Founded in 2004, Sound Creations Ltd has grown into a leading provider of professional audio, visual, lighting and acoustic solutions across East Africa and beyond. What began as a specialist audio company is today a full-service integrator — designing, supplying, installing and supporting complete systems for the region’s most demanding spaces.' ) ); ?></p>
			<p><?php echo esc_html( sc_setting( 'about_journey_p2', 'We pair the world’s leading technology brands with deep local expertise and an in-house team of certified engineers. From houses of worship and corporate boardrooms to campuses, stadiums and broadcast studios, we deliver solutions that are engineered to perform and built to last — backed by long-term support in Kenya, Rwanda, DR Congo and the UAE.' ) ); ?></p>
		</div>
		<div class="sc-about-hero__media" style="align-self:stretch;min-height:360px;background-image:url('<?php echo esc_url( $sc_about_photo ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Sound Creations at work', 'soundcreations' ); ?>"></div>
	</div>
</section>

<section class="sc-section sc-section--tight" id="what-we-do">
	<div class="sc-container">
		<div class="sc-expertise-wrap">
			<div class="sc-expertise-head">
				<div>
					<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'about_exp_eyebrow', 'What We Do' ) ); ?></p>
					<h2><?php echo esc_html( sc_setting( 'about_exp_title', 'Our Expertise' ) ); ?></h2>
				</div>
				<p class="sc-expertise-intro"><?php echo esc_html( sc_setting( 'about_exp_intro', 'We provide complete solutions across every stage of your project — from idea to installation and beyond.' ) ); ?></p>
			</div>
			<div class="sc-exp-grid">
				<?php foreach ( $sc_exp_items as $sc_i => $sc_card ) : ?>
					<div class="sc-exp-card">
						<span class="sc-exp-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $sc_exp_icons[ $sc_i % count( $sc_exp_icons ) ]; ?></svg></span>
						<h3><?php echo esc_html( $sc_card['title'] ); ?></h3>
						<p><?php echo esc_html( $sc_card['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="sc-section sc-section--tight" id="our-brands">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'about_partners_eyebrow', 'Our Brands' ) ); ?></p>
		<h2 style="margin-bottom:1.5rem;"><?php echo esc_html( sc_setting( 'about_partners_title', 'World-class brands, supported locally' ) ); ?></h2>
		<?php echo do_shortcode( '[sc_partners]' ); ?>
	</div>
</section>

<section class="sc-section sc-section--tight" id="company-profiles">
	<div class="sc-container">
		<?php echo do_shortcode( '[sc_profiles]' ); ?>
	</div>
</section>

<?php
get_footer();
