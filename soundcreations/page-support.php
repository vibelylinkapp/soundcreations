<?php
/**
 * Support page. Auto-applies to the page with slug "support".
 * Uses the Sound Creations Enquiries plugin [sc_enquiry_form type="support"].
 * Copy is editable in Sound Creations -> Settings where wired via sc_setting().
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_hero_img = SC_THEME_URI . '/assets/img/support-hero.jpg';
$sc_cta_img  = SC_THEME_URI . '/assets/img/support-cta.jpg';

$sc_pills = array(
	array( 'Expert Support', 'Skilled engineers ready to help', '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>' ),
	array( 'Fast Response', 'Quick turnaround when you need us', '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>' ),
	array( 'Genuine Parts', 'Quality assured components', '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>' ),
	array( 'End-to-End Care', 'From installation to long-term support', '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"/><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"/><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"/><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"/>' ),
);

$sc_services = array(
	array( 'Technical Support', 'Get expert assistance from our technical team via phone, email or remote access.', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>' ),
	array( 'Maintenance & Service', 'Preventive maintenance, inspections and repairs to keep your systems running flawlessly.', '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>' ),
	array( 'System Upgrades', 'Upgrade your systems with the latest technology for improved performance and reliability.', '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="8"/><polyline points="8 12 12 8 16 12"/>' ),
	array( 'Training', 'Hands-on training for your team to maximize the performance of your equipment.', '<path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1 2 3 6 3s6-2 6-3v-5"/>' ),
	array( 'Spare Parts', 'Genuine spare parts and accessories for all major brands we represent.', '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>' ),
	array( 'Warranty Support', 'Support for warranty claims and extended service agreements.', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>' ),
);

$sc_resources = array(
	array( 'Product Manuals', 'Download user manuals and documentation.', '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>' ),
	array( 'Knowledge Base', 'Browse articles and troubleshooting guides.', '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>' ),
	array( 'Video Tutorials', 'Step-by-step videos on setup and use.', '<circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/>' ),
	array( 'Firmware Updates', 'Latest updates and release notes.', '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>' ),
);

$sc_res_url = sc_setting( 'support_res_all_url', home_url( '/resources/' ) );
?>

<section class="sc-support-hero" style="background-image:url('<?php echo esc_url( $sc_hero_img ); ?>');">
	<span class="sc-support-hero__scrim" aria-hidden="true"></span>
	<div class="sc-container sc-support-hero__inner">
		<nav class="sc-crumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> <span aria-hidden="true">&rsaquo;</span> <span class="sc-crumb__cur"><?php esc_html_e( 'Support', 'soundcreations' ); ?></span></nav>
		<h1 class="sc-support-hero__title"><?php echo esc_html( sc_setting( 'support_title_a', 'We’re here to' ) ); ?><br><span class="sc-accent"><?php echo esc_html( sc_setting( 'support_title_b', 'keep you performing.' ) ); ?></span></h1>
		<p class="sc-lead sc-support-hero__lead"><?php echo esc_html( sc_setting( 'support_lead', 'Technical support, product training and after-sales service from a team that knows your system inside out.' ) ); ?></p>
		<div class="sc-support-pills">
			<?php foreach ( $sc_pills as $p ) : ?>
				<div class="sc-contact-pill">
					<span class="sc-contact-pill__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $p[2]; ?></svg></span>
					<div class="sc-contact-pill__text"><strong><?php echo esc_html( $p[0] ); ?></strong><span><?php echo esc_html( $p[1] ); ?></span></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--compact">
	<div class="sc-container sc-support-main">
		<div class="sc-support-main__left">
			<h2 class="sc-support-h2"><?php echo esc_html( sc_setting( 'support_services_title', 'Our Support Services' ) ); ?></h2>
			<p class="sc-support-sub"><?php echo esc_html( sc_setting( 'support_services_sub', 'Comprehensive care for every stage of your system’s lifecycle.' ) ); ?></p>
			<div class="sc-svc-grid">
				<?php foreach ( $sc_services as $s ) : ?>
					<div class="sc-svc-card">
						<span class="sc-svc-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $s[2]; ?></svg></span>
						<h3 class="sc-svc-card__title"><?php echo esc_html( $s[0] ); ?></h3>
						<p class="sc-svc-card__desc"><?php echo esc_html( $s[1] ); ?></p>
						<a class="sc-svc-card__arrow" href="#request-support" aria-label="<?php echo esc_attr( sprintf( 'Request %s', $s[0] ) ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="sc-support-main__right">
			<div class="sc-formcard" id="request-support">
				<h2 class="sc-formcard__title"><?php echo esc_html( sc_setting( 'support_form_title', 'Request Support' ) ); ?></h2>
				<p class="sc-formcard__sub"><?php echo esc_html( sc_setting( 'support_form_sub', 'Fill in the form and our team will get back to you as soon as possible.' ) ); ?></p>
				<?php echo do_shortcode( '[sc_enquiry_form type="support"]' ); ?>
			</div>
		</div>
	</div>
</section>

<section class="sc-section sc-section--compact">
	<div class="sc-container">
		<div class="sc-res-head">
			<div>
				<h2 class="sc-support-h2"><?php echo esc_html( sc_setting( 'support_res_title', 'Support Resources' ) ); ?></h2>
				<p class="sc-support-sub" style="margin-bottom:0;"><?php echo esc_html( sc_setting( 'support_res_sub', 'Find answers, downloads and guides to help you get the most out of your systems.' ) ); ?></p>
			</div>
			<a class="sc-linkbtn" href="<?php echo esc_url( $sc_res_url ); ?>"><?php esc_html_e( 'View All Resources', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
		<div class="sc-res-grid">
			<?php foreach ( $sc_resources as $r ) : ?>
				<a class="sc-res-card" href="<?php echo esc_url( $sc_res_url ); ?>">
					<span class="sc-res-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $r[2]; ?></svg></span>
					<span class="sc-res-card__text"><strong><?php echo esc_html( $r[0] ); ?></strong><span><?php echo esc_html( $r[1] ); ?></span></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--compact">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( $sc_cta_img ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'support_cta_title', 'Need immediate assistance?' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 1.5rem;"><?php echo esc_html( sc_setting( 'support_cta_text', 'Call our support line for urgent technical help.' ) ); ?></p>
				<a class="sc-btn sc-btn--primary sc-cta-phone" href="tel:<?php echo esc_attr( sc_setting( 'phone_link', '+254715754758' ) ); ?>"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg> <?php echo esc_html( sc_setting( 'phone', '+254 715 754 758' ) ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
