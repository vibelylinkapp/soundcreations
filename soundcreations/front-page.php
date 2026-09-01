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
				'consultancy'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h13a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H9l-4 4V6a2 2 0 0 1 2-2z"/><path d="M8 9h8"/><path d="M8 12h5"/></svg>',
				'distribution-dealership' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5h13v10H1z"/><path d="M14 8h4l3 3v4h-7z"/><circle cx="5.5" cy="17.5" r="1.8"/><circle cx="17.5" cy="17.5" r="1.8"/></svg>',
				'integration'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><path d="M10 6.5h4M6.5 10v4M17.5 10v4M10 17.5h4"/></svg>',
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
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M8.21 13.89 7 22l5-3 5 3-1.21-8.11"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num">22+</div>
					<div class="sc-stat__sub">Years Experience</div>
				</div>
			</div>
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 8 3 16 6 23 3 23 18 16 21 8 18 1 21"/><line x1="8" y1="3" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="21"/></svg></span>
				<div class="sc-stat__body">
					<div class="sc-stat__head sc-stat__head--num">4</div>
					<div class="sc-stat__sub">Regional Locations<span class="sc-stat__note">Kenya | Rwanda | DR Congo | UAE</span></div>
				</div>
			</div>
			<div class="sc-stat">
				<span class="sc-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></span>
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
