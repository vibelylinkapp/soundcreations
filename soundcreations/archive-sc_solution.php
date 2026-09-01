<?php
/**
 * Solutions landing page (renders at /solutions/, the sc_solution archive).
 * Hero, section headings, sectors, support callout and About cards are all
 * editable in Sound Creations -> Settings (Solutions page content).
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_img       = SC_THEME_URI . '/assets/img/solutions/';
$sc_sol_hero  = SC_THEME_URI . '/assets/img/solutions-hero.jpg';
$sc_cta_photo = SC_THEME_URI . '/assets/img/cta-building.jpg';
$sc_support_img = SC_THEME_URI . '/assets/img/solutions/support-endtoend.jpg';
$sc_arrow     = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';

$sc_pills = array(
	array( 'End-to-end expertise', 'From concept to commissioning and beyond.', '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>' ),
	array( 'World-class technology', 'The best brands, engineered for your environment.', '<circle cx="12" cy="8" r="6"/><path d="M8.21 13.89 7 22l5-3 5 3-1.21-8.11"/>' ),
	array( 'Long-term partnership', 'Reliable support that keeps you performing.', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>' ),
);

$sc_solutions = array(
	array( 'Professional Audio', 'Loudspeakers, amplifiers, mixers, DSP, microphones and complete sound reinforcement systems.', 'audio.jpg', '/solutions/professional-audio/', '<polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>' ),
	array( 'Acoustics', 'Acoustic design, measurement, analysis, treatment and noise control solutions.', 'acoustics.jpg', '/solutions/acoustics/', '<path d="M2 12h3l2-6 3 13 3-16 2 9h4"/>' ),
	array( 'Conferencing &amp; Collaboration', 'Boardrooms, hybrid meeting solutions, AV over IP, control and collaboration systems.', 'conferencing.jpg', '/solutions/conferencing/', '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>' ),
	array( 'System Integration', 'Design, installation, commissioning and integration of audio, video, lighting and control systems.', 'integration.jpg', '/solutions/system-integration/', '<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M9 2v2"/><path d="M15 2v2"/><path d="M9 20v2"/><path d="M15 20v2"/><path d="M20 9h2"/><path d="M20 14h2"/><path d="M2 9h2"/><path d="M2 14h2"/>' ),
	array( 'Lighting Solutions', 'Stage lighting, architectural lighting, control systems and lighting design and programming.', 'lighting.jpg', '/solutions/lighting/', '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>' ),
	array( 'LED Screens &amp; Displays', 'LED video walls, displays and content solutions for indoor and outdoor applications.', 'led.jpg', '/solutions/led-screens/', '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/>' ),
	array( 'Broadcast &amp; Recording', 'Studio solutions, recording equipment, broadcast systems and post-production.', 'broadcast.jpg', '/solutions/broadcast/', '<circle cx="12" cy="12" r="2"/><path d="M4.93 19.07a10 10 0 0 1 0-14.14"/><path d="M7.76 16.24a6 6 0 0 1 0-8.49"/><path d="M16.24 7.76a6 6 0 0 1 0 8.49"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>' ),
	array( 'Support &amp; Maintenance', 'Preventive maintenance, system monitoring, technical support and service contracts.', 'support.jpg', '/solutions/support/', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>' ),
);

$sc_steps = array(
	array( '01', 'Consult', 'We listen, assess your needs and recommend the right solution.', '<path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 8.5 8.5 0 0 1-3.9-.9L3 21l1.9-5.6A8.5 8.5 0 0 1 12.5 3 8.38 8.38 0 0 1 21 11.5Z"/>' ),
	array( '02', 'Design', 'Our engineers design tailored systems to meet your goals and budget.', '<path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>' ),
	array( '03', 'Supply', 'We source and deliver premium products from trusted global brands.', '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.27 6.96 12 12.01l8.73-5.05"/><path d="M12 22.08V12"/>' ),
	array( '04', 'Integrate', 'Our team installs and integrates systems to the highest standards.', '<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M9 1v3"/><path d="M15 1v3"/><path d="M9 20v3"/><path d="M15 20v3"/><path d="M20 9h3"/><path d="M20 14h3"/><path d="M1 9h3"/><path d="M1 14h3"/>' ),
	array( '05', 'Support', 'We stay with you through training, maintenance and long-term support.', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>' ),
);

// Icons cycled by index for the (editable) sector list.
$sc_sector_icons = array(
	'<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M12 6h.01"/><path d="M16 6h.01"/><path d="M8 10h.01"/><path d="M12 10h.01"/><path d="M16 10h.01"/>',
	'<path d="M12 2v6"/><path d="M9 5h6"/><path d="M6 22V10l6-4 6 4v12"/><path d="M10 22v-4h4v4"/>',
	'<path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1 2.5 3 6 3s6-2 6-3v-5"/>',
	'<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>',
	'<rect x="4" y="2" width="16" height="20" rx="2"/><circle cx="12" cy="14" r="4"/><circle cx="12" cy="7" r="1"/>',
	'<polygon points="12 2 20 7 4 7"/><line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/>',
);

// Icons cycled by index for the (editable) About Sound Creations cards.
$sc_about_icons = array(
	'<circle cx="12" cy="8" r="6"/><path d="M8.21 13.89 7 22l5-3 5 3-1.21-8.11"/>',
	'<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
	'<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/>',
	'<path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/>',
	'<path d="M12 2 2 7l10 5 10-5-10-5Z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/>',
	'<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78L12 21l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"/>',
);

$sc_sectors = sc_split_lines( sc_setting( 'sol_sectors' ), 1 );
$sc_about   = sc_split_lines( sc_setting( 'sol_about_items' ), 2 );
$sc_points  = sc_split_lines( sc_setting( 'sol_support_points' ), 1 );

$sc_projects = array(
	array( 'Worship Centre', 'Nairobi, Kenya', 'worship.jpg' ),
	array( 'Conference Centre', 'Dubai, UAE', 'conference.jpg' ),
	array( 'Corporate Boardroom', 'Kigali, Rwanda', 'boardroom.jpg' ),
	array( 'Performing Arts Theatre', 'DR Congo', 'performance.jpg' ),
);
?>

<section class="sc-hero sc-hero--video sc-hero--solutions" style="background-image:url('<?php echo esc_url( $sc_sol_hero ); ?>');">
	<span class="sc-hero__scrim" aria-hidden="true"></span>
	<div class="sc-container sc-hero__inner">
		<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Solutions', '' ) ) ); ?>
		<h1 class="sc-hero__title"><?php echo esc_html( sc_setting( 'sol_hero_title', 'Engineered solutions. Exceptional experiences.' ) ); ?></h1>
		<p class="sc-lead"><?php echo esc_html( sc_setting( 'sol_hero_lead', 'We design, integrate and support professional audio, visual, lighting and acoustic solutions for every space, application and performance.' ) ); ?></p>
		<div class="sc-hero-pills">
			<?php foreach ( $sc_pills as $p ) : ?>
				<div class="sc-hero-pill">
					<span class="sc-hero-pill__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $p[2]; ?></svg></span>
					<div class="sc-hero-pill__text"><strong><?php echo esc_html( $p[0] ); ?></strong><span><?php echo esc_html( $p[1] ); ?></span></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php esc_html_e( 'Our Solutions', 'soundcreations' ); ?></p>
		<h2 style="margin:.4rem 0 1.75rem;"><?php echo esc_html( sc_setting( 'sol_solutions_title', 'Complete technology solutions for every environment.' ) ); ?></h2>
		<div class="sc-scard-grid">
			<?php foreach ( $sc_solutions as $s ) : ?>
				<a class="sc-scard" href="<?php echo esc_url( home_url( $s[3] ) ); ?>">
					<span class="sc-scard__media">
						<span class="sc-scard__frame"><img src="<?php echo esc_url( $sc_img . $s[2] ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $s[0] ) ); ?>" loading="lazy"></span>
						<span class="sc-scard__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><?php echo $s[4]; ?></svg></span>
					</span>
					<div class="sc-scard__body">
						<h3><?php echo wp_kses_post( $s[0] ); ?></h3>
						<p><?php echo esc_html( $s[1] ); ?></p>
						<span class="sc-scard__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--surface">
	<div class="sc-container">
		<div class="sc-sec-head-center">
			<p class="sc-eyebrow"><?php esc_html_e( 'Who we work with', 'soundcreations' ); ?></p>
			<h2><?php echo esc_html( sc_setting( 'sol_sectors_title', 'Engineered for how corporates actually operate.' ) ); ?></h2>
		</div>
		<div class="sc-sectors">
			<?php foreach ( $sc_sectors as $i => $sec ) : ?>
				<?php if ( '' === $sec[0] ) { continue; } ?>
				<div class="sc-sector">
					<span class="sc-sector__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $sc_sector_icons[ $i % count( $sc_sector_icons ) ]; ?></svg></span>
					<span><?php echo esc_html( $sec[0] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-section__head">
			<div>
				<p class="sc-eyebrow"><?php esc_html_e( 'Our Process', 'soundcreations' ); ?></p>
				<h2 style="margin:.3rem 0 0;"><?php echo esc_html( sc_setting( 'sol_process_title', 'A proven process. A better result.' ) ); ?></h2>
			</div>
			<a class="sc-link-arrow" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'How We Work', 'soundcreations' ); ?> &rarr;</a>
		</div>
		<div class="sc-steps sc-steps--process">
			<?php foreach ( $sc_steps as $st ) : ?>
				<div class="sc-step">
					<span class="sc-step__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $st[3]; ?></svg></span>
					<div class="sc-step__label"><span class="sc-step__num"><?php echo esc_html( $st[0] ); ?></span><h3 class="sc-step__title"><?php echo esc_html( $st[1] ); ?></h3></div>
					<p class="sc-step__desc"><?php echo esc_html( $st[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--surface">
	<div class="sc-container">
		<div class="sc-support">
			<div class="sc-support__media" style="background-image:url('<?php echo esc_url( $sc_support_img ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Technical support team', 'soundcreations' ); ?>"></div>
			<div class="sc-support__body">
				<p class="sc-eyebrow"><?php esc_html_e( 'End-to-end support', 'soundcreations' ); ?></p>
				<h2><?php echo esc_html( sc_setting( 'sol_support_title', 'We don’t disappear after installation.' ) ); ?></h2>
				<p class="sc-lead"><?php echo esc_html( sc_setting( 'sol_support_text', 'Preventive maintenance, genuine spare parts, operator training and rapid response — a single support relationship that keeps your systems performing for years.' ) ); ?></p>
				<ul class="sc-ticklist">
					<?php foreach ( $sc_points as $pt ) : ?>
						<?php if ( '' === $pt[0] ) { continue; } ?>
						<li><?php echo esc_html( $pt[0] ); ?></li>
					<?php endforeach; ?>
				</ul>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php echo esc_html( sc_setting( 'sol_support_cta', 'Talk to our team' ) ); ?> <?php echo $sc_arrow; ?></a>
			</div>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-sec-head-center">
			<p class="sc-eyebrow"><?php esc_html_e( 'About Sound Creations', 'soundcreations' ); ?></p>
			<h2><?php echo esc_html( sc_setting( 'sol_about_title', 'Why organisations choose Sound Creations.' ) ); ?></h2>
		</div>
		<div class="sc-about-grid">
			<?php foreach ( $sc_about as $i => $ab ) : ?>
				<?php if ( '' === $ab[0] ) { continue; } ?>
				<div class="sc-why__item sc-about-card">
					<span class="sc-why__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $sc_about_icons[ $i % count( $sc_about_icons ) ]; ?></svg></span>
					<div>
						<h3><?php echo esc_html( $ab[0] ); ?></h3>
						<p><?php echo esc_html( isset( $ab[1] ) ? $ab[1] : '' ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--partners">
	<div class="sc-container sc-partners__wrap">
		<span class="sc-partners__label"><?php esc_html_e( 'Global Technology Partners', 'soundcreations' ); ?></span>
		<?php echo do_shortcode( '[sc_partners]' ); ?>
	</div>
</section>

<section class="sc-section sc-section--surface">
	<div class="sc-container">
		<div class="sc-section__head">
			<div>
				<p class="sc-eyebrow"><?php esc_html_e( 'Featured Projects', 'soundcreations' ); ?></p>
				<h2 style="margin:.3rem 0 0;"><?php esc_html_e( 'Real spaces. Real results.', 'soundcreations' ); ?></h2>
			</div>
			<a class="sc-link-arrow" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'View All Projects', 'soundcreations' ); ?> &rarr;</a>
		</div>
		<div class="sc-carousel" data-sc-carousel>
			<button class="sc-carousel__btn sc-carousel__btn--prev" type="button" data-sc-prev aria-label="Previous">&lsaquo;</button>
			<div class="sc-carousel__track">
				<?php foreach ( $sc_projects as $pr ) : ?>
					<a class="sc-project" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><span class="sc-project__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/projects/' . $pr[2] ); ?>" alt="<?php echo esc_attr( $pr[0] ); ?>" loading="lazy"></span><h3 class="sc-project__title"><?php echo esc_html( $pr[0] ); ?></h3><p class="sc-project__loc"><?php echo esc_html( $pr[1] ); ?></p></a>
				<?php endforeach; ?>
			</div>
			<button class="sc-carousel__btn sc-carousel__btn--next" type="button" data-sc-next aria-label="Next">&rsaquo;</button>
		</div>
		<script>
		(function(){
			var roots = document.querySelectorAll('[data-sc-carousel]');
			roots.forEach(function(root){
				var track = root.querySelector('.sc-carousel__track');
				if (track === null) { return; }
				function step(){
					var card = track.querySelector('.sc-project');
					if (card === null) { return 320; }
					return card.getBoundingClientRect().width + 20;
				}
				var prev = root.querySelector('[data-sc-prev]');
				var next = root.querySelector('[data-sc-next]');
				if (prev) { prev.addEventListener('click', function(){ track.scrollBy({ left: -step(), behavior: 'smooth' }); }); }
				if (next) { next.addEventListener('click', function(){ track.scrollBy({ left: step(), behavior: 'smooth' }); }); }
			});
		})();
		</script>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( $sc_cta_photo ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'sol_cta_title', 'Have a project in mind?' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 1.5rem;"><?php echo esc_html( sc_setting( 'sol_cta_text', 'Let’s design and deliver the right solution for your space and application.' ) ); ?></p>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
