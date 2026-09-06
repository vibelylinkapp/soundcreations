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

$sc_pills = array(
	array( 'End-to-end expertise', 'From concept to commissioning and beyond.', '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>' ),
	array( 'World-class technology', 'The best brands, engineered for your environment.', '<circle cx="12" cy="8" r="6"/><path d="M8.21 13.89 7 22l5-3 5 3-1.21-8.11"/>' ),
	array( 'Long-term partnership', 'Reliable support that keeps you performing.', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>' ),
);

$sc_solutions = array(
	array( 'Consultation', 'Site assessment, system design and specification - we measure, model and plan the right solution before any equipment goes in.', 'consultation.jpg', '/service/consultancy/', '<path d="M20 4H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4v4l5-4h7a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"/><path d="M12 6.7a3 3 0 0 0-1.8 5.4c.35.27.55.7.55 1.15h2.5c0-.45.2-.88.55-1.15A3 3 0 0 0 12 6.7z"/><path d="M10.9 14.4h2.2"/>' ),
	array( 'Acoustics', 'Acoustic design, measurement, analysis, treatment and noise control for clear, intelligible sound in every space.', 'acoustics.jpg', '/solutions/acoustics/', '<path d="M2 12h3l2-6 3 13 3-16 2 9h4"/>' ),
	array( 'Live Sound &amp; Installation', 'Professional live-sound systems, installation, commissioning and calibration by our technical team.', 'installation.jpg', '/solutions/installation/', '<polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>' ),
);

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
