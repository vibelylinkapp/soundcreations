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
$sc_hero_poster = sc_setting( 'home_hero_poster', SC_THEME_URI . '/assets/img/hero-poster.jpg' );

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
		<p class="sc-hero__lead"><?php echo sc_rich_e( sc_setting( 'home_hero_lead', 'We design, supply, integrate and support professional audio, visual, lighting and acoustic systems across Africa and the Middle East.' ) ); ?></p>
		<div class="sc-hero__cta">
			<?php if ( '' !== $sc_hc1_l ) : ?><a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_hc1_h ); ?>"><?php echo esc_html( $sc_hc1_l ); ?></a><?php endif; ?>
			<?php if ( '' !== $sc_hc2_l ) : ?><a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( $sc_hc2_h ); ?>"><?php echo esc_html( $sc_hc2_l ); ?></a><?php endif; ?>
		</div>
	</div>
</section>

<section class="sc-pillars">
	<div class="sc-container sc-pillars__grid">
		<?php
		$sc_pillars = array(
			array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="2.3"/><circle cx="18" cy="18" r="2.3"/><path d="M8.3 6H15a3 3 0 0 1 3 3v6.7"/><path d="M6 8.3V15a3 3 0 0 0 3 3h6.7"/></svg>', 'End-to-end Expertise', 'From concept to commissioning and beyond.' ),
			array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="7" width="10" height="10" rx="2"/><path d="M10 3v3M14 3v3M10 18v3M14 18v3M3 10h3M3 14h3M18 10h3M18 14h3"/></svg>', 'World-class Technology', 'Trusted brands, engineered for your environment.' ),
			array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="3"/><circle cx="17" cy="9.5" r="2.3"/><path d="M2.5 19a5.5 5.5 0 0 1 11 0"/><path d="M14.8 14.3a4.6 4.6 0 0 1 6.7 4.7"/></svg>', 'Long-term Partnership', 'Reliable support that keeps you performing.' ),
			array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 4h8v4a4 4 0 0 1-8 0z"/><path d="M8 5H5v1.4A3.5 3.5 0 0 0 8 10M16 5h3v1.4A3.5 3.5 0 0 1 16 10"/><path d="M12 12v3M9 20h6M10 20l.6-3h2.8l.6 3"/></svg>', 'Proven Results', 'Hundreds of successful projects across the region.' ),
		);
		foreach ( $sc_pillars as $sc_p ) :
			?>
			<div class="sc-pillar">
				<span class="sc-pillar__icon"><?php echo $sc_p[0]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></span>
				<div class="sc-pillar__text">
					<strong><?php echo esc_html( $sc_p[1] ); ?></strong>
					<span><?php echo esc_html( $sc_p[2] ); ?></span>
				</div>
			</div>
			<?php
		endforeach;
		?>
	</div>
</section>

<section class="sc-section" id="services">
	<div class="sc-container">
		<div class="sc-sechead">
			<div>
				<p class="sc-eyebrow">What We Do</p>
				<h2>More than equipment. A complete solution.</h2>
			</div>
			<p class="sc-sechead__intro">If it sounds good, it's Sound Creations. From acoustic design and system engineering to equipment, integration, commissioning and support, we deliver world-class technology and expertise across Africa and the Middle East.</p>
		</div>
		<div class="sc-svcards">
			<?php
			$sc_svc_ico = array(
				'consultancy'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4v4l5-4h7a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"/><path d="M12 6.7a3 3 0 0 0-1.8 5.4c.35.27.55.7.55 1.15h2.5c0-.45.2-.88.55-1.15A3 3 0 0 0 12 6.7z"/><path d="M10.9 14.4h2.2"/></svg>',
				'distribution' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5h13v10H1z"/><path d="M14 8h4l3 3v4h-7z"/><circle cx="5.5" cy="17.5" r="1.8"/><circle cx="17.5" cy="17.5" r="1.8"/></svg>',
				'integration'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20.5 11H19V7a2 2 0 0 0-2-2h-4V3.5a2.5 2.5 0 0 0-5 0V5H4a2 2 0 0 0-2 2v3.8h1.5a2.2 2.2 0 0 1 0 4.4H2V19a2 2 0 0 0 2 2h3.8v-1.5a2.2 2.2 0 0 1 4.4 0V21H17a2 2 0 0 0 2-2v-4h1.5a2.5 2.5 0 0 0 0-5z"/></svg>',
				'aftersale'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13v-1a8 8 0 0 1 16 0v1"/><path d="M20 14a2 2 0 0 1-2 2h-2v-5h2a2 2 0 0 1 2 2z"/><path d="M4 14a2 2 0 0 0 2 2h2v-5H6a2 2 0 0 0-2 2z"/><path d="M18 16v1a3 3 0 0 1-3 3h-3"/></svg>',
			);
			// Live links to the /service/{slug}/ pages, matched by title keyword so a
			// slug typo (for example "intergration") still resolves; falls back to the
			// legacy URL when the matching Service page does not exist yet.
			$sc_service_links = array();
			$sc_svc_q = new WP_Query( array( 'post_type' => 'sc_service', 'post_status' => 'publish', 'posts_per_page' => -1, 'no_found_rows' => true ) );
			if ( $sc_svc_q->have_posts() ) {
				while ( $sc_svc_q->have_posts() ) {
					$sc_svc_q->the_post();
					$sc_service_links[] = array( 't' => strtolower( get_the_title() ), 'u' => get_permalink() );
				}
				wp_reset_postdata();
			}
			$sc_services = array(
				array( 'service-consultancy.jpg', 'consultancy', 'Consultancy', 'Design and consultation across audio, acoustics, lighting and visuals - at every phase of your project.', '/request-a-consultation/', 'home_svc1_img', array( 'consult' ) ),
				array( 'service-distribution.jpg', 'distribution', 'Distribution & Dealership', 'Certified exclusive dealers for leading global brands, with reliable regional distribution and logistics.', '/brands/', 'home_svc2_img', array( 'distribut', 'dealer' ) ),
				array( 'service-integration.jpg', 'integration', 'Integration', 'Site mapping, system design, installation, commissioning, training and support for every audio and acoustic need.', '/solutions/', 'home_svc3_img', array( 'integ' ) ),
				array( 'service-aftersale.jpg', 'aftersale', 'After-Sale Services', 'Warranty management, genuine spare parts, servicing and technical support that keep your systems performing.', '/contact/', 'home_svc4_img', array( 'after', 'sale' ) ),
			);
			foreach ( $sc_services as $sc_s ) :
				$sc_img  = sc_setting( $sc_s[5], SC_THEME_URI . '/assets/img/home/' . $sc_s[0] );
				$sc_href = home_url( $sc_s[4] );
				foreach ( $sc_service_links as $sc_l ) {
					$sc_hit = false;
					foreach ( $sc_s[6] as $sc_nd ) {
						if ( is_int( strpos( $sc_l['t'], $sc_nd ) ) ) {
							$sc_hit = true;
						}
					}
					if ( $sc_hit === true ) {
						$sc_href = $sc_l['u'];
						break;
					}
				}
				?>
				<a class="sc-svcard" href="<?php echo esc_url( $sc_href ); ?>">
					<span class="sc-svcard__img">
						<img src="<?php echo esc_url( $sc_img ); ?>" alt="<?php echo esc_attr( $sc_s[2] ); ?>" loading="lazy" decoding="async" width="600" height="450">
					</span>
					<span class="sc-svcard__body">
						<span class="sc-svcard__badge"><?php echo $sc_svc_ico[ $sc_s[1] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></span>
						<h3><?php echo esc_html( $sc_s[2] ); ?></h3>
						<p><?php echo esc_html( $sc_s[3] ); ?></p>
						<span class="sc-svcard__more"><?php esc_html_e( 'Learn more', 'soundcreations' ); ?> &rarr;</span>
					</span>
				</a>
				<?php
			endforeach;
			?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--surface">
	<div class="sc-container">
		<div class="sc-sechead">
			<div>
				<p class="sc-eyebrow">Our Solutions</p>
				<h2>Complete technology solutions for every environment.</h2>
			</div>
			<p class="sc-sechead__intro">From houses of worship and corporate spaces to live events and hospitality venues, we deliver tailored audio, visual, lighting and acoustic solutions.</p>
		</div>
		<div class="sc-solgrid">
			<?php
			// Live links to the /solutions/{slug}/ pages, matched by title keyword
			// (fixes the AV card, whose legacy /solutions/installation/ URL 404s).
			$sc_solution_links = array();
			$sc_sol_q = new WP_Query( array( 'post_type' => 'sc_solution', 'post_status' => 'publish', 'posts_per_page' => -1, 'no_found_rows' => true ) );
			if ( $sc_sol_q->have_posts() ) {
				while ( $sc_sol_q->have_posts() ) {
					$sc_sol_q->the_post();
					$sc_solution_links[] = array( 't' => strtolower( get_the_title() ), 'u' => get_permalink() );
				}
				wp_reset_postdata();
			}
			$sc_sols = array(
				array( 'solution-professional-audio.jpg', 'Professional Audio', 'Powerful, intelligible and reliable sound systems designed around your room and application.', '/solutions/professional-audio/', 'home_sol1_img', array( 'professional audio', 'audio' ) ),
				array( 'solution-acoustics.jpg', 'Acoustics', 'Acoustics treated as an engineering discipline: measure, analyze, design, treat and verify for clear, intelligible sound.', '/solutions/acoustics/', 'home_sol2_img', array( 'acoustic' ) ),
				array( 'solution-av-integration.jpg', 'Sound & Acoustic Integration', 'Professional sound and acoustic systems, installed, commissioned and calibrated by our technical team.', '/solutions/installation/', 'home_sol3_img', array( 'integ', 'installation' ) ),
			);
			foreach ( $sc_sols as $sc_so ) :
				$sc_img  = sc_setting( $sc_so[4], SC_THEME_URI . '/assets/img/home/' . $sc_so[0] );
				$sc_href = home_url( $sc_so[3] );
				foreach ( $sc_solution_links as $sc_l ) {
					$sc_hit = false;
					foreach ( $sc_so[5] as $sc_nd ) {
						if ( is_int( strpos( $sc_l['t'], $sc_nd ) ) ) {
							$sc_hit = true;
						}
					}
					if ( $sc_hit === true ) {
						$sc_href = $sc_l['u'];
						break;
					}
				}
				?>
				<a class="sc-solcard" href="<?php echo esc_url( $sc_href ); ?>">
					<span class="sc-solcard__img"><img src="<?php echo esc_url( $sc_img ); ?>" alt="<?php echo esc_attr( $sc_so[1] ); ?>" loading="lazy" decoding="async" width="640" height="440"></span>
					<span class="sc-solcard__body">
						<h3><?php echo esc_html( $sc_so[1] ); ?></h3>
						<p><?php echo esc_html( $sc_so[2] ); ?></p>
						<span class="sc-solcard__more"><?php esc_html_e( 'Explore solution', 'soundcreations' ); ?> &rarr;</span>
					</span>
				</a>
				<?php
			endforeach;
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
						'posts_per_page' => 8,
						'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
						'no_found_rows'  => true,
					)
				);
				if ( $sc_pq->have_posts() ) :
					while ( $sc_pq->have_posts() ) :
						$sc_pq->the_post();
						$pid  = get_the_ID();
						$img = sc_project_card_image( $pid );
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
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="6"/><path d="m12 6.4 1.13 2.29 2.53.37-1.83 1.78.43 2.52L12 12.06l-2.26 1.19.43-2.52-1.83-1.78 2.53-.37z"/><path d="M9 14.4 7.5 21l4.5-2.6L16.5 21 15 14.4"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num">22+</div>
					<div class="sc-stat__sub">Years Experience</div>
				</div>
			</div>
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3c2.6 2.5 4 5.6 4 9s-1.4 6.5-4 9c-2.6-2.5-4-5.6-4-9s1.4-6.5 4-9z"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num">4</div>
					<div class="sc-stat__sub">Regional Locations<span class="sc-stat__note">Kenya | Rwanda | DRC Congo | UAE</span></div>
				</div>
			</div>
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4.5h6a1 1 0 0 1 1 1V6a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-.5a1 1 0 0 1 1-1z"/><path d="M8 5.5H6a2 2 0 0 0-2 2V19a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5a2 2 0 0 0-2-2h-2"/><path d="m8.5 13.5 2.2 2.2 4.3-4.3"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num">850+</div>
					<div class="sc-stat__sub">Projects Completed</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( sc_setting( 'home_cta_image', SC_THEME_URI . '/assets/img/cta-building.jpg' ) ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'home_cta_title', 'Have a project in mind?' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 .9rem;"><?php echo sc_rich_e( sc_setting( 'home_cta_text', 'Tell us about your space and application. Our technical team will help you specify the right system.' ) ); ?></p>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
