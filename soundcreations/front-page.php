<?php
/**
 * Homepage template - faithful emulation of the approved high-fidelity prototype.
 *
 * The body is rendered inside a scoped .sc-proto wrapper (see assets/css/proto.css) so the
 * prototype's spacing and design system apply here without leaking to other pages. Header and
 * footer are the theme's (they already match the prototype). Editable copy (hero, what-we-do,
 * projects, CTA) still reads from Sound Creations -> Settings; Featured Projects are live posts.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_uri    = SC_THEME_URI;
$sc_hero    = $sc_uri . '/assets/img/hero-poster.jpg';
$sc_feat_img = $sc_uri . '/assets/img/solutions/installation.jpg';
$sc_cta_img = $sc_uri . '/assets/img/cta-building.jpg';

$sc_hc1_l = sc_setting( 'home_hero_cta1_label', 'Request a Consultation' );
$sc_hc1_u = sc_setting( 'home_hero_cta1_url', '/request-a-consultation/' );
$sc_hc2_l = sc_setting( 'home_hero_cta2_label', 'Explore Our Solutions' );
$sc_hc2_u = sc_setting( 'home_hero_cta2_url', '/solutions/' );
$sc_hc1_h = ( 0 === strpos( $sc_hc1_u, 'http' ) ) ? $sc_hc1_u : home_url( $sc_hc1_u );
$sc_hc2_h = ( 0 === strpos( $sc_hc2_u, 'http' ) ) ? $sc_hc2_u : home_url( $sc_hc2_u );

$sc_consult = home_url( '/request-a-consultation/' );
$sc_sol_url = home_url( '/solutions/' );
$sc_prj_url = home_url( '/projects/' );
$sc_prd_url = home_url( '/products/' );
?>

<div class="sc-proto">

<section class="hero">
	<div class="photo" style="background-image:url('<?php echo esc_url( $sc_hero ); ?>')"></div>
	<div class="container">
		<div>
			<div class="eyebrow"><?php echo esc_html( sc_setting( 'home_hero_eyebrow', 'Consult - Design - Distribute - Integrate - Support' ) ); ?></div>
			<h1><?php echo esc_html( sc_setting( 'home_hero_title', 'Engineering exceptional sound. Delivering complete solutions.' ) ); ?><span class="dot">.</span></h1>
			<p><?php echo esc_html( sc_setting( 'home_hero_lead', 'We design, supply, integrate and support professional audio, visual, lighting and acoustic systems across Africa and the Middle East.' ) ); ?></p>
			<div class="actions">
				<?php if ( '' !== $sc_hc1_l ) : ?><a class="btn primary" href="<?php echo esc_url( $sc_hc1_h ); ?>"><?php echo esc_html( $sc_hc1_l ); ?> &rarr;</a><?php endif; ?>
				<?php if ( '' !== $sc_hc2_l ) : ?><a class="btn secondary" href="<?php echo esc_url( $sc_hc2_h ); ?>"><?php echo esc_html( $sc_hc2_l ); ?> &rarr;</a><?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="trust">
	<div class="container">
		<div class="trustgrid">
			<?php
			$sc_trust = array(
				array( 'star', 'End-to-end Expertise', 'From concept to commissioning and beyond.' ),
				array( 'chip', 'World-class Technology', 'Trusted brands, engineered for your environment.' ),
				array( 'shield', 'Long-term Partnership', 'Reliable support that keeps you performing.' ),
				array( 'check', 'Proven Results', 'Hundreds of successful projects across the region.' ),
			);
			$sc_trust_icons = array(
				'star'   => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3.2l2.47 5 5.53.8-4 3.9.94 5.5L12 18.8l-4.94 2.6.94-5.5-4-3.9 5.53-.8z"/></svg>',
				'chip'   => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="7" width="10" height="10" rx="2"/><path d="M10 3v2M14 3v2M10 19v2M14 19v2M3 10h2M3 14h2M19 10h2M19 14h2"/></svg>',
				'shield' => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.4-3 7.6-7 9-4-1.4-7-4.6-7-9V6z"/><path d="m9 12 2 2 4-4"/></svg>',
				'check'  => '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 10 17l-5-5"/></svg>',
			);
			foreach ( $sc_trust as $sc_t ) :
				$sc_ic = isset( $sc_trust_icons[ $sc_t[0] ] ) ? $sc_trust_icons[ $sc_t[0] ] : '';
				?>
				<div class="trustitem"><div class="trusticon"><?php echo $sc_ic; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></div><div><b><?php echo esc_html( $sc_t[1] ); ?></b><p><?php echo esc_html( $sc_t[2] ); ?></p></div></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="kicker"><?php echo esc_html( sc_setting( 'home_whatwedo_eyebrow', 'What we do' ) ); ?></div>
		<div class="sectionhead">
			<div><h2><?php echo esc_html( sc_setting( 'home_whatwedo_title', 'More than equipment. A complete solution.' ) ); ?></h2></div>
			<p><?php echo esc_html( sc_setting( 'home_whatwedo_lead', 'If it sounds good, it is Sound Creations. From acoustic design and system engineering to equipment, integration, commissioning and support, we deliver world-class technology and expertise across Africa and the Middle East.' ) ); ?></p>
		</div>
		<div class="grid4">
			<?php
			$sc_svc_icons = array(
				'consultancy'             => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h4v4l5-4h7a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"/><path d="M12 6.7a3 3 0 0 0-1.8 5.4c.35.27.55.7.55 1.15h2.5c0-.45.2-.88.55-1.15A3 3 0 0 0 12 6.7z"/><path d="M10.9 14.4h2.2"/></svg>',
				'distribution-dealership' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5h13v10H1z"/><path d="M14 8h4l3 3v4h-7z"/><circle cx="5.5" cy="17.5" r="1.8"/><circle cx="17.5" cy="17.5" r="1.8"/></svg>',
				'integration'             => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20.5 11H19V7a2 2 0 0 0-2-2h-4V3.5a2.5 2.5 0 0 0-5 0V5H4a2 2 0 0 0-2 2v3.8h1.5a2.2 2.2 0 0 1 0 4.4H2V19a2 2 0 0 0 2 2h3.8v-1.5a2.2 2.2 0 0 1 4.4 0V21H17a2 2 0 0 0 2-2v-4h1.5a2.5 2.5 0 0 0 0-5z"/></svg>',
				'after-sale-services'     => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13v-1a8 8 0 0 1 16 0v1"/><path d="M20 14a2 2 0 0 1-2 2h-2v-5h2a2 2 0 0 1 2 2z"/><path d="M4 14a2 2 0 0 0 2 2h2v-5H6a2 2 0 0 0-2 2z"/><path d="M18 16v1a3 3 0 0 1-3 3h-3"/></svg>',
			);
			$sc_svc_fallback = array(
				array( 'consultancy', 'Consultancy', 'Design and consultation across audio, acoustics, lighting and visuals - at every phase of your project.' ),
				array( 'distribution-dealership', 'Distribution & Dealership', 'Certified exclusive dealers for leading global brands, with reliable regional distribution and logistics.' ),
				array( 'integration', 'Integration', 'Site mapping, system design, installation, commissioning, training and support.' ),
				array( 'after-sale-services', 'After-Sale Services', 'Warranty management, genuine spare parts, servicing and technical support that keeps your system performing.' ),
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
					<a class="card service" href="<?php the_permalink(); ?>"><div class="icon"><?php echo $sc_sicon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></div><h3><?php echo esc_html( get_the_title() ); ?></h3><p><?php echo esc_html( $sc_ssum ); ?></p><span class="link"><?php esc_html_e( 'Learn more', 'soundcreations' ); ?> &rarr;</span></a>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				foreach ( $sc_svc_fallback as $sc_sv ) :
					$sc_sicon = isset( $sc_svc_icons[ $sc_sv[0] ] ) ? $sc_svc_icons[ $sc_sv[0] ] : $sc_svc_icons['integration'];
					?>
					<a class="card service" href="<?php echo esc_url( home_url( '/service/' . $sc_sv[0] . '/' ) ); ?>"><div class="icon"><?php echo $sc_sicon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></div><h3><?php echo esc_html( $sc_sv[1] ); ?></h3><p><?php echo esc_html( $sc_sv[2] ); ?></p><span class="link"><?php esc_html_e( 'Learn more', 'soundcreations' ); ?> &rarr;</span></a>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<section class="brandsbar">
	<div class="container">
		<div class="brandrow">
			<div class="brandtitle"><?php echo esc_html( sc_setting( 'home_partners_label', 'Global Technology Partners' ) ); ?></div>
			<div class="brandlogos">
				<?php
				$sc_brands = array( 'dB Technologies', 'FANE', 'Shure', 'Midas', 'Behringer', 'Rockfon', 'Barrisol' );
				foreach ( $sc_brands as $sc_b ) :
					?>
					<div class="brandpill"><?php echo esc_html( $sc_b ); ?></div>
				<?php endforeach; ?>
			</div>
			<a href="<?php echo esc_url( $sc_prd_url ); ?>"><?php esc_html_e( 'View All Brands', 'soundcreations' ); ?> &rarr;</a>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<div class="kicker"><?php echo esc_html( sc_setting( 'home_solutions_eyebrow', 'Our solutions' ) ); ?></div>
		<div class="sectionhead">
			<h2><?php echo esc_html( sc_setting( 'home_solutions_title', 'Complete technology solutions for every environment.' ) ); ?></h2>
			<p><?php echo esc_html( sc_setting( 'home_solutions_lead', 'From houses of worship and corporate spaces to live events and hospitality venues, we deliver tailored audio, visual, lighting and acoustic solutions.' ) ); ?></p>
		</div>
		<div class="feature">
			<div class="visual"><img src="<?php echo esc_url( $sc_feat_img ); ?>" alt="Live sound and installation"></div>
			<div class="copy">
				<div class="kicker">Designed around you</div>
				<h2 style="font-size:34px">One partner from concept to completion.</h2>
				<ul class="checklist">
					<li><span class="check">&#10003;</span> Consultation &amp; site assessment</li>
					<li><span class="check">&#10003;</span> System design &amp; specification</li>
					<li><span class="check">&#10003;</span> Supply &amp; logistics</li>
					<li><span class="check">&#10003;</span> Installation &amp; commissioning</li>
					<li><span class="check">&#10003;</span> Training &amp; after-sales support</li>
				</ul>
				<a class="btn primary" href="<?php echo esc_url( $sc_sol_url ); ?>"><?php esc_html_e( 'Explore All Solutions', 'soundcreations' ); ?> &rarr;</a>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="kicker"><?php echo esc_html( sc_setting( 'home_projects_eyebrow', 'Featured projects' ) ); ?></div>
		<div class="sectionhead">
			<h2><?php echo esc_html( sc_setting( 'home_projects_title', 'Real solutions. Real impact.' ) ); ?></h2>
			<a class="btn secondary" href="<?php echo esc_url( $sc_prj_url ); ?>"><?php esc_html_e( 'View All Projects', 'soundcreations' ); ?> &rarr;</a>
		</div>
		<div class="projectgrid">
			<?php
			$sc_pq = new WP_Query( array( 'post_type' => 'sc_project', 'post_status' => 'publish', 'posts_per_page' => 4, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'no_found_rows' => true ) );
			if ( $sc_pq->have_posts() ) :
				while ( $sc_pq->have_posts() ) :
					$sc_pq->the_post();
					$sc_pid  = get_the_ID();
					$sc_imgk = (string) get_post_meta( $sc_pid, '_sc_image', true );
					$sc_rel  = 'assets/img/projects/' . $sc_imgk . '.jpg';
					$sc_img  = ( '' !== $sc_imgk && file_exists( get_theme_file_path( $sc_rel ) ) ) ? get_theme_file_uri( $sc_rel ) : ( SC_THEME_URI . '/assets/img/projects/boardroom.jpg' );
					$sc_loc  = (string) get_post_meta( $sc_pid, '_sc_location', true );
					$sc_terms = get_the_terms( $sc_pid, 'sc_solution' );
					$sc_tag   = ( is_array( $sc_terms ) && isset( $sc_terms[0] ) ) ? strtoupper( $sc_terms[0]->name ) : '';
					$sc_desc  = wp_strip_all_tags( get_the_excerpt() );
					if ( '' === $sc_desc ) {
						$sc_desc = 'Professional systems engineered for clarity, performance and reliability.';
					}
					?>
					<a class="card projectcard" href="<?php the_permalink(); ?>"><div class="projectphoto"><img src="<?php echo esc_url( $sc_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async"><?php if ( '' !== $sc_tag ) : ?><span class="tag"><?php echo esc_html( $sc_tag ); ?></span><?php endif; ?></div><div class="projectbody"><?php if ( '' !== $sc_loc ) : ?><span class="location"><?php echo esc_html( $sc_loc ); ?></span><?php endif; ?><h3><?php echo esc_html( get_the_title() ); ?></h3><p><?php echo esc_html( wp_trim_words( $sc_desc, 18 ) ); ?></p><span class="link"><?php esc_html_e( 'View Project', 'soundcreations' ); ?> &rarr;</span></div></a>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				$sc_fb = array(
					array( 'citam-buruburu', 'AUDIO', 'CITAM Buruburu', 'Nairobi, Kenya' ),
					array( 'cathedral', 'ACOUSTIC / AUDIO', 'All Saints Cathedral', 'Nairobi, Kenya' ),
					array( 'pcea-chuka', 'ACOUSTIC', 'PCEA Chuka', 'Chuka, Kenya' ),
					array( 'kabarak-university', 'AUDIO / VISUAL', 'Kabarak University', 'Nakuru, Kenya' ),
				);
				foreach ( $sc_fb as $sc_f ) :
					?>
					<a class="card projectcard" href="<?php echo esc_url( $sc_prj_url ); ?>"><div class="projectphoto"><img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/projects/' . $sc_f[0] . '.jpg' ); ?>" alt="<?php echo esc_attr( $sc_f[2] ); ?>" loading="lazy" decoding="async"><span class="tag"><?php echo esc_html( $sc_f[1] ); ?></span></div><div class="projectbody"><span class="location"><?php echo esc_html( $sc_f[3] ); ?></span><h3><?php echo esc_html( $sc_f[2] ); ?></h3><p>Professional systems engineered for clarity, performance and reliability.</p><span class="link"><?php esc_html_e( 'View Project', 'soundcreations' ); ?> &rarr;</span></div></a>
					<?php
				endforeach;
			endif;
			?>
		</div>
		<div class="metrics">
			<div class="metric"><strong>22+</strong><span>Years Experience</span></div>
			<div class="metric"><strong>4</strong><span>Regional Locations</span></div>
			<div class="metric"><strong>850+</strong><span>Projects Completed</span></div>
		</div>
	</div>
</section>

<section class="section" style="padding-top:0">
	<div class="container">
		<div class="ctabox">
			<div class="bg" style="background:linear-gradient(90deg,rgba(111,4,20,.96),rgba(111,4,20,.55)),url('<?php echo esc_url( $sc_cta_img ); ?>') center/cover"></div>
			<div class="content">
				<div class="eyebrow">Ready when you are</div>
				<h2><?php echo esc_html( sc_setting( 'home_cta_title', 'Have a project in mind?' ) ); ?></h2>
				<p><?php echo esc_html( sc_setting( 'home_cta_text', 'Let us design and deliver the right solution for your space and application.' ) ); ?></p>
				<a class="btn primary" href="<?php echo esc_url( $sc_consult ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?> &rarr;</a>
			</div>
		</div>
	</div>
</section>

</div>

<?php
get_footer();
