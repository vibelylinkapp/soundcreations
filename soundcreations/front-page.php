<?php
/**
 * Homepage template. Cinematic dark hero + narrative sections.
 * All copy is editable in wp-admin: Sound Creations -> Settings (Homepage section).
 * Solution cards and Featured Projects are pulled live from the Solutions and
 * Projects you manage in wp-admin (with a safe fallback if none exist yet).
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_hero_video  = sc_setting( 'hero_video' );
$sc_hero_poster = SC_THEME_URI . '/assets/img/hero-poster.jpg';

$sc_hc1_l = sc_setting( 'home_hero_cta1_label', 'Request a Consultation' );
$sc_hc1_u = sc_setting( 'home_hero_cta1_url', '/request-a-consultation/' );
$sc_hc2_l = sc_setting( 'home_hero_cta2_label', 'Explore Our Solutions' );
$sc_hc2_u = sc_setting( 'home_hero_cta2_url', '/solutions/' );
$sc_hc1_h = ( 0 === strpos( $sc_hc1_u, 'http' ) ) ? $sc_hc1_u : home_url( $sc_hc1_u );
$sc_hc2_h = ( 0 === strpos( $sc_hc2_u, 'http' ) ) ? $sc_hc2_u : home_url( $sc_hc2_u );
?>

<section class="sc-hero sc-hero--video" style="background-image:url('<?php echo esc_url( $sc_hero_poster ); ?>');">
	<?php if ( $sc_hero_video ) : ?>
		<video class="sc-hero__video" autoplay muted loop playsinline preload="metadata" poster="<?php echo esc_url( $sc_hero_poster ); ?>">
			<source src="<?php echo esc_url( $sc_hero_video ); ?>" type="video/mp4">
		</video>
	<?php endif; ?>
	<span class="sc-hero__scrim" aria-hidden="true"></span>
	<div class="sc-container sc-hero__inner">
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'home_hero_eyebrow', 'Consult -> Design -> Distribute -> Integrate -> Support' ) ); ?></p>
		<h1 class="sc-hero__title"><?php echo esc_html( sc_setting( 'home_hero_title', 'Engineering exceptional sound. Delivering complete solutions.' ) ); ?></h1>
		<div class="sc-hero__cta">
			<?php if ( '' !== $sc_hc1_l ) : ?><a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_hc1_h ); ?>"><?php echo esc_html( $sc_hc1_l ); ?></a><?php endif; ?>
			<?php if ( '' !== $sc_hc2_l ) : ?><a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( $sc_hc2_h ); ?>"><?php echo esc_html( $sc_hc2_l ); ?></a><?php endif; ?>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'home_whatwedo_eyebrow', 'What we do' ) ); ?></p>
		<h2><?php echo esc_html( sc_setting( 'home_whatwedo_title', 'More than equipment. A complete solution.' ) ); ?></h2>
		<p class="sc-lead" style="margin-bottom:2rem;"><?php echo esc_html( sc_setting( 'home_whatwedo_lead', 'We consult, design, supply, integrate and support professional audio, visual, lighting and acoustic systems-engineered for your space and built to perform.' ) ); ?></p>
		<div class="sc-steps">
			<?php
			$sc_step_icons = array(
				'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 8.5 8.5 0 0 1-3.9-.9L3 21l1.9-5.6A8.5 8.5 0 0 1 12.5 3 8.38 8.38 0 0 1 21 11.5Z"/></svg>',
				'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>',
				'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.27 6.96 12 12.01l8.73-5.05"/><path d="M12 22.08V12"/></svg>',
				'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M9 1v3"/><path d="M15 1v3"/><path d="M9 20v3"/><path d="M15 20v3"/><path d="M20 9h3"/><path d="M20 14h3"/><path d="M1 9h3"/><path d="M1 14h3"/></svg>',
				'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>',
			);
			$sc_steps = sc_split_lines( sc_setting( 'home_steps' ), 2 );
			$sc_ic_n  = count( $sc_step_icons );
			foreach ( $sc_steps as $i => $st ) :
				$icon = ( $i < $sc_ic_n ) ? $sc_step_icons[ $i ] : $sc_step_icons[ $sc_ic_n - 1 ];
				?>
				<div class="sc-step"><span class="sc-step__icon"><?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></span><h3 class="sc-step__title"><?php echo esc_html( $st[0] ); ?></h3><p class="sc-step__desc"><?php echo esc_html( isset( $st[1] ) ? $st[1] : '' ); ?></p></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--surface">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'home_solutions_eyebrow', 'Solutions' ) ); ?></p>
		<h2 style="margin-bottom:2rem;"><?php echo esc_html( sc_setting( 'home_solutions_title', 'Built around your room, application and operating requirements.' ) ); ?></h2>
		<div class="sc-grid">
			<?php
			$sc_sol_fallback = array(
				'professional-audio'  => 'solutions/audio.jpg',
				'acoustics'           => 'solutions/acoustics.jpg',
				'conferencing'        => 'solutions/conferencing.jpg',
				'system-integration'  => 'solutions/integration.jpg',
				'consultation-design' => 'solutions/support.jpg',
				'installation'        => 'solutions/led.jpg',
				'support-training'    => 'solutions/support.jpg',
			);
			$sc_solq = new WP_Query(
				array(
					'post_type'      => 'sc_solution',
					'post_status'    => 'publish',
					'posts_per_page' => 4,
					'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
					'no_found_rows'  => true,
				)
			);
			if ( $sc_solq->have_posts() ) :
				while ( $sc_solq->have_posts() ) :
					$sc_solq->the_post();
					$sid  = get_the_ID();
					$slug = get_post_field( 'post_name', $sid );
					$img  = has_post_thumbnail( $sid ) ? get_the_post_thumbnail_url( $sid, 'large' ) : '';
					if ( '' === $img ) {
						$rel = isset( $sc_sol_fallback[ $slug ] ) ? $sc_sol_fallback[ $slug ] : 'solutions/audio.jpg';
						$img = SC_THEME_URI . '/assets/img/' . $rel;
					}
					$sum = sc_field( 'summary', $sid );
					if ( '' === $sum ) {
						$sum = wp_strip_all_tags( get_the_excerpt( $sid ) );
					}
					?>
					<a class="sc-card sc-card--media" href="<?php the_permalink(); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3><?php echo esc_html( get_the_title() ); ?></h3><p><?php echo esc_html( $sum ); ?></p></div></a>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<a class="sc-card sc-card--media" href="<?php echo esc_url( home_url( '/solutions/professional-audio/' ) ); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/audio.jpg' ); ?>" alt="Professional Audio" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3>Professional Audio</h3><p>Loudspeakers, subs, amplification, DSP, mixing, microphones and wireless - designed, supplied and tuned.</p></div></a>
				<a class="sc-card sc-card--media" href="<?php echo esc_url( home_url( '/solutions/acoustics/' ) ); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/acoustics.jpg' ); ?>" alt="Acoustics" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3>Acoustics</h3><p>Measure -> Analyze -> Design -> Treat -> Verify. Acoustics treated as an engineering discipline.</p></div></a>
				<a class="sc-card sc-card--media" href="<?php echo esc_url( home_url( '/solutions/conferencing/' ) ); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/conferencing.jpg' ); ?>" alt="Conferencing" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3>Conferencing</h3><p>Boardrooms, hybrid meetings and collaboration spaces engineered for clarity and reliability.</p></div></a>
				<a class="sc-card sc-card--media" href="<?php echo esc_url( home_url( '/solutions/system-integration/' ) ); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/integration.jpg' ); ?>" alt="System Integration" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3>System Integration</h3><p>Supply, installation, commissioning, calibration and project management under one technical team.</p></div></a>
				<?php
			endif;
			?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--partners">
	<div class="sc-container sc-partners__wrap">
		<span class="sc-partners__label"><?php echo esc_html( sc_setting( 'home_partners_label', 'Global Technology Partners' ) ); ?></span>
		<?php echo do_shortcode( '[sc_partners]' ); ?>
	</div>
</section>

<section class="sc-section sc-section--surface">
	<div class="sc-container">
		<div class="sc-section__head">
			<div>
				<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'home_projects_eyebrow', 'Featured Projects' ) ); ?></p>
				<h2 style="margin:0;"><?php echo esc_html( sc_setting( 'home_projects_title', 'Real spaces. Real results.' ) ); ?></h2>
			</div>
			<a class="sc-link-arrow" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'View All Projects', 'soundcreations' ); ?> &rarr;</a>
		</div>
		<div class="sc-carousel" data-sc-carousel>
			<button class="sc-carousel__btn sc-carousel__btn--prev" type="button" data-sc-prev aria-label="Previous">&lsaquo;</button>
			<div class="sc-carousel__track">
				<?php
				$sc_pq = new WP_Query(
					array(
						'post_type'      => 'sc_project',
						'post_status'    => 'publish',
						'posts_per_page' => 6,
						'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
						'no_found_rows'  => true,
					)
				);
				if ( $sc_pq->have_posts() ) :
					while ( $sc_pq->have_posts() ) :
						$sc_pq->the_post();
						$pid  = get_the_ID();
						$imgk = (string) get_post_meta( $pid, '_sc_image', true );
						$rel  = 'assets/img/projects/' . $imgk . '.jpg';
						$img  = ( '' !== $imgk && file_exists( get_theme_file_path( $rel ) ) ) ? get_theme_file_uri( $rel ) : ( SC_THEME_URI . '/assets/img/projects/boardroom.jpg' );
						$loc  = (string) get_post_meta( $pid, '_sc_location', true );
						?>
						<a class="sc-project" href="<?php the_permalink(); ?>"><span class="sc-project__media"><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async" width="400" height="250"></span><h3 class="sc-project__title"><?php echo esc_html( get_the_title() ); ?></h3><?php if ( '' !== $loc ) : ?><p class="sc-project__loc"><?php echo esc_html( $loc ); ?></p><?php endif; ?></a>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<a class="sc-project" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><span class="sc-project__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/projects/boardroom.jpg' ); ?>" alt="Corporate Boardroom" loading="lazy" decoding="async" width="400" height="250"></span><h3 class="sc-project__title">Corporate Boardroom</h3><p class="sc-project__loc">Nairobi, Kenya</p></a>
					<a class="sc-project" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><span class="sc-project__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/projects/worship.jpg' ); ?>" alt="House of Worship" loading="lazy" decoding="async" width="400" height="250"></span><h3 class="sc-project__title">House of Worship</h3><p class="sc-project__loc">Kigali, Rwanda</p></a>
					<a class="sc-project" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><span class="sc-project__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/projects/conference.jpg' ); ?>" alt="Conference Centre" loading="lazy" decoding="async" width="400" height="250"></span><h3 class="sc-project__title">Conference Centre</h3><p class="sc-project__loc">Dubai, UAE</p></a>
					<a class="sc-project" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><span class="sc-project__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/projects/performance.jpg' ); ?>" alt="Performance Venue" loading="lazy" decoding="async" width="400" height="250"></span><h3 class="sc-project__title">Performance Venue</h3><p class="sc-project__loc">Nairobi, Kenya</p></a>
					<?php
				endif;
				?>
			</div>
			<button class="sc-carousel__btn sc-carousel__btn--next" type="button" data-sc-next aria-label="Next">&rsaquo;</button>
		</div>
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
</section>

<section class="sc-stats sc-stats--proof">
	<div class="sc-container">
		<div class="sc-stats__grid">
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M8.21 13.89 7 22l5-3 5 3-1.21-8.11"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num"><?php echo esc_html( sc_setting( 'home_stat1_num', '20+' ) ); ?></div>
					<div class="sc-stat__sub"><?php echo esc_html( sc_setting( 'home_stat1_label', 'Years Experience' ) ); ?></div>
				</div>
			</div>
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num"><?php echo esc_html( sc_setting( 'home_stat2_num', '4' ) ); ?></div>
					<div class="sc-stat__sub"><?php echo esc_html( sc_setting( 'home_stat2_label', 'Regional Locations' ) ); ?><span class="sc-stat__note"><?php echo esc_html( sc_setting( 'home_stat2_note', 'Kenya | Rwanda | DR Congo | UAE' ) ); ?></span></div>
				</div>
			</div>
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num"><?php echo esc_html( sc_setting( 'home_stat3_num', '50+' ) ); ?></div>
					<div class="sc-stat__sub"><?php echo esc_html( sc_setting( 'home_stat3_label', 'Brands' ) ); ?></div>
				</div>
			</div>
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num"><?php echo esc_html( sc_setting( 'home_stat4_num', '850+' ) ); ?></div>
					<div class="sc-stat__sub"><?php echo esc_html( sc_setting( 'home_stat4_label', 'Projects Completed' ) ); ?></div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( SC_THEME_URI . '/assets/img/cta-building.jpg' ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'home_cta_title', 'Have a project in mind?' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 1.5rem;"><?php echo esc_html( sc_setting( 'home_cta_text', 'Tell us about your space and application. Our technical team will help you specify the right system.' ) ); ?></p>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
