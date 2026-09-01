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

<section class="sc-section" id="services">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'home_whatwedo_eyebrow', 'What we do' ) ); ?></p>
		<h2><?php echo esc_html( sc_setting( 'home_whatwedo_title', 'More than equipment. A complete solution.' ) ); ?></h2>
		<p class="sc-lead" style="margin-bottom:2rem;"><?php echo esc_html( sc_setting( 'home_whatwedo_lead', 'We consult, design, supply, integrate and support professional audio, visual, lighting and acoustic systems-engineered for your space and built to perform.' ) ); ?></p>
		<div class="sc-svcs">
			<?php
			$sc_svc_icons = array(
				'consultancy'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4v4l5-4h7a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"/><path d="M12 6.7a3 3 0 0 0-1.8 5.4c.35.27.55.7.55 1.15h2.5c0-.45.2-.88.55-1.15A3 3 0 0 0 12 6.7z"/><path d="M10.9 14.4h2.2"/></svg>',
				'distribution-dealership' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5h13v10H1z"/><path d="M14 8h4l3 3v4h-7z"/><circle cx="5.5" cy="17.5" r="1.8"/><circle cx="17.5" cy="17.5" r="1.8"/></svg>',
				'integration'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20.5 11H19V7a2 2 0 0 0-2-2h-4V3.5a2.5 2.5 0 0 0-5 0V5H4a2 2 0 0 0-2 2v3.8h1.5a2.2 2.2 0 0 1 0 4.4H2V19a2 2 0 0 0 2 2h3.8v-1.5a2.2 2.2 0 0 1 4.4 0V21H17a2 2 0 0 0 2-2v-4h1.5a2.5 2.5 0 0 0 0-5z"/></svg>',
				'after-sale-services'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13v-1a8 8 0 0 1 16 0v1"/><path d="M20 14a2 2 0 0 1-2 2h-2v-5h2a2 2 0 0 1 2 2z"/><path d="M4 14a2 2 0 0 0 2 2h2v-5H6a2 2 0 0 0-2 2z"/><path d="M18 16v1a3 3 0 0 1-3 3h-3"/></svg>',
			);
			$sc_svc_fallback = array(
				array( 'consultancy', 'Consultancy', 'We listen, assess and design the right solution across audio, acoustics, lighting and visuals.' ),
				array( 'distribution-dealership', 'Distribution & Dealership', 'Certified exclusive dealer for leading global brands, with reliable regional distribution.' ),
				array( 'integration', 'Integration', 'Site mapping, system design, installation, commissioning, training and support.' ),
				array( 'after-sale-services', 'After-Sale Services', 'Warranty management, genuine spare parts, servicing and technical support.' ),
			);
			$sc_svcq = new WP_Query( array( 'post_type' => 'sc_service', 'post_status' => 'publish', 'posts_per_page' => 8, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'no_found_rows' => true ) );
			if ( $sc_svcq->have_posts() ) :
				while ( $sc_svcq->have_posts() ) :
					$sc_svcq->the_post();
					$sc_sslug = get_post_field( 'post_name', get_the_ID() );
					$sc_sicon = isset( $sc_svc_icons[ $sc_sslug ] ) ? $sc_svc_icons[ $sc_sslug ] : $sc_svc_icons['integration'];
					$sc_ssum  = sc_field( 'summary' );
					if ( '' === $sc_ssum ) {
						$sc_ssum = wp_strip_all_tags( get_the_excerpt() );
					}
					?>
					<a class="sc-svc" href="<?php the_permalink(); ?>"><span class="sc-svc__icon"><?php echo $sc_sicon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></span><h3 class="sc-svc__title"><?php echo esc_html( get_the_title() ); ?></h3><p class="sc-svc__desc"><?php echo esc_html( $sc_ssum ); ?></p><span class="sc-svc__more"><?php esc_html_e( 'Learn more', 'soundcreations' ); ?> &rarr;</span></a>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				foreach ( $sc_svc_fallback as $sc_sv ) :
					$sc_sicon = isset( $sc_svc_icons[ $sc_sv[0] ] ) ? $sc_svc_icons[ $sc_sv[0] ] : $sc_svc_icons['integration'];
					?>
					<a class="sc-svc" href="<?php echo esc_url( home_url( '/service/' . $sc_sv[0] . '/' ) ); ?>"><span class="sc-svc__icon"><?php echo $sc_sicon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></span><h3 class="sc-svc__title"><?php echo esc_html( $sc_sv[1] ); ?></h3><p class="sc-svc__desc"><?php echo esc_html( $sc_sv[2] ); ?></p><span class="sc-svc__more"><?php esc_html_e( 'Learn more', 'soundcreations' ); ?> &rarr;</span></a>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<section class="sc-section sc-section--surface">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'home_solutions_eyebrow', 'Solutions' ) ); ?></p>
		<h2 style="margin-bottom:2rem;"><?php echo esc_html( sc_setting( 'home_solutions_title', 'Built around your room, application and operating requirements.' ) ); ?></h2>
		<div class="sc-grid sc-grid--3">
			<a class="sc-card sc-card--media" href="<?php echo esc_url( home_url( '/service/consultancy/' ) ); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/consultation.jpg' ); ?>" alt="Consultation" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3>Consultation</h3><p>Site assessment, system design and specification - we measure, model and plan the right solution before a single cable is run.</p></div></a>
			<a class="sc-card sc-card--media" href="<?php echo esc_url( home_url( '/solutions/acoustics/' ) ); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/acoustics.jpg' ); ?>" alt="Acoustics" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3>Acoustics</h3><p>Acoustics treated as an engineering discipline: measure, analyze, design, treat and verify for clear, intelligible sound.</p></div></a>
			<a class="sc-card sc-card--media" href="<?php echo esc_url( home_url( '/solutions/installation/' ) ); ?>"><span class="sc-card__media"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/installation.jpg' ); ?>" alt="Live Sound and Installation" loading="lazy" decoding="async" width="640" height="420"></span><div class="sc-card__body"><h3>Live Sound &amp; Installation</h3><p>Professional live-sound systems, installation, commissioning and calibration by our technical team.</p></div></a>
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
					<div class="sc-stat__sub">Regional Locations<span class="sc-stat__note">Kenya | Rwanda | DR Congo | UAE</span></div>
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
