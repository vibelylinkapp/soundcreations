<?php
/**
 * Single solution (Professional Audio, Acoustics, Audio Visual & Integration, ...).
 *
 * Professional, articulated layout that shares the service design system:
 * hero band, narrative prose, a sticky sidebar with the inclusions / outcome /
 * applications, related projects, and a closing CTA. Each real solution kind
 * gets a tailored section: Acoustics = Architectural Acoustic Services
 * (accordion + video + photos); Professional Audio = Capabilities cards +
 * deployment photos; Integration = turnkey installation context + process +
 * photos.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

while ( have_posts() ) :
	the_post();

	$sc_summary  = (string) sc_field( 'summary' );
	$sc_includes = (string) sc_render_ticklist( sc_field( 'includes' ) );
	$sc_outcome  = (string) sc_field( 'outcome' );
	$sc_apps     = (string) sc_term_tags( get_the_ID(), 'sc_application' );
	$sc_eyebrow  = sc_primary_term_name( get_the_ID(), 'sc_solution_area', __( 'Solution', 'soundcreations' ) );

	$sc_tl = strtolower( (string) get_the_title() );
	$sc_sk = 'general';
	if ( is_int( strpos( $sc_tl, 'acoustic' ) ) ) {
		$sc_sk = 'acoustics';
	} elseif ( is_int( strpos( $sc_tl, 'integ' ) ) || is_int( strpos( $sc_tl, 'visual' ) ) || is_int( strpos( $sc_tl, 'install' ) ) ) {
		$sc_sk = 'integration';
	} elseif ( is_int( strpos( $sc_tl, 'audio' ) ) ) {
		$sc_sk = 'audio';
	}

	// Each real solution kind renders its own tailored section below, so the
	// generic in-column capabilities strip is intentionally left empty.
	$sc_capmap = array(
		'audio'       => array(),
		'acoustics'   => array(),
		'integration' => array(),
		'general'     => array(),
	);
	$sc_caps = isset( $sc_capmap[ $sc_sk ] ) ? $sc_capmap[ $sc_sk ] : array();
	?>

	<article class="sc-svc">
		<header class="sc-svc-hero">
			<div class="sc-container">
				<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Solutions', get_post_type_archive_link( 'sc_solution' ) ), array( get_the_title(), '' ) ) ); ?>
				<p class="sc-eyebrow"><?php echo esc_html( $sc_eyebrow ); ?></p>
				<h1 class="sc-svc-hero__title"><?php the_title(); ?></h1>
				<?php if ( strlen( $sc_summary ) > 0 ) : ?>
					<p class="sc-svc-hero__lead"><?php echo esc_html( $sc_summary ); ?></p>
				<?php endif; ?>
				<div class="sc-svc-hero__actions">
					<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
					<a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'sc_solution' ) ); ?>"><?php esc_html_e( 'All Solutions', 'soundcreations' ); ?></a>
				</div>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="sc-container">
				<div class="sc-svc-figure"><?php the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?></div>
			</div>
		<?php endif; ?>

		<section class="sc-section sc-section--tight">
			<div class="sc-container sc-svc-body">
				<div class="sc-svc-main">
					<div class="sc-prose"><?php the_content(); ?></div>

					<?php if ( count( $sc_caps ) > 0 ) : ?>
						<div class="sc-svc-highlights">
							<h2 class="sc-svc-h2"><?php esc_html_e( 'Capabilities', 'soundcreations' ); ?></h2>
							<div class="sc-svc-cards">
								<?php foreach ( $sc_caps as $sc_c ) : ?>
									<div class="sc-svc-card">
										<span class="sc-svc-card__dot" aria-hidden="true"></span>
										<h3><?php echo esc_html( $sc_c[0] ); ?></h3>
										<p><?php echo esc_html( $sc_c[1] ); ?></p>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<aside class="sc-svc-aside">
					<div class="sc-svc-sidecard">
						<?php if ( strlen( $sc_includes ) > 0 ) : ?>
							<span class="sc-svc-sidecard__label"><?php esc_html_e( 'What is included', 'soundcreations' ); ?></span>
							<div class="sc-svc-sidecard__includes"><?php echo $sc_includes; ?></div>
						<?php endif; ?>
						<?php if ( strlen( $sc_outcome ) > 0 ) : ?>
							<div class="sc-svc-fact"><span class="sc-svc-fact__k"><?php esc_html_e( 'Outcome', 'soundcreations' ); ?></span><span class="sc-svc-fact__v"><?php echo esc_html( $sc_outcome ); ?></span></div>
						<?php endif; ?>
						<?php if ( strlen( $sc_apps ) > 0 ) : ?>
							<div class="sc-svc-fact"><span class="sc-svc-fact__k"><?php esc_html_e( 'Applications', 'soundcreations' ); ?></span><div class="sc-svc-tags"><?php echo $sc_apps; ?></div></div>
						<?php endif; ?>
						<div class="sc-svc-sidecard__cta">
							<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
							<a class="sc-svc-sidecard__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Or contact us directly', 'soundcreations' ); ?> &rarr;</a>
						</div>
					</div>
				</aside>
			</div>
		</section>

		<?php if ( 'acoustics' === $sc_sk ) : ?>
			<section class="sc-section sc-section--tight sc-section--surface sc-acoustics">
				<div class="sc-container">
					<div class="sc-acoustics__head">
						<p class="sc-eyebrow"><?php esc_html_e( 'Acoustic expertise', 'soundcreations' ); ?></p>
						<h2 class="sc-svc-h2"><?php esc_html_e( 'Architectural Acoustic Services', 'soundcreations' ); ?></h2>
						<p class="sc-acoustics__intro"><?php esc_html_e( 'From first concept to the finished room, we design, measure and treat critical listening spaces so they perform exactly as intended.', 'soundcreations' ); ?></p>
					</div>
					<div class="sc-acoustics__grid">
						<div class="sc-acc">
							<details class="sc-acc__item" open>
								<summary class="sc-acc__q"><span><?php esc_html_e( 'Design and Consulting', 'soundcreations' ); ?></span></summary>
								<div class="sc-acc__a"><p>In partnership with architects and architectural firms, we can provide innovative solutions and procedures towards creating excellence in acoustic and electroacoustic design and installation. We always look forward to participate in the collaborative design process.</p></div>
							</details>
							<details class="sc-acc__item">
								<summary class="sc-acc__q"><span><?php esc_html_e( 'Testing and Measurement', 'soundcreations' ); ?></span></summary>
								<div class="sc-acc__a"><p>Using advanced acoustic testing and measurement equipment, Sound Creations&rsquo; consultants can evaluate and analyze different spaces to develop acoustic criteria as well as evaluate their achievement with utmost accuracy.</p></div>
							</details>
							<details class="sc-acc__item">
								<summary class="sc-acc__q"><span><?php esc_html_e( 'Surface Treatments', 'soundcreations' ); ?></span></summary>
								<div class="sc-acc__a"><p>Critical listening spaces such as auditoria, churches, studios, theatres, conference rooms, home theaters and all speech intelligibility sensitive spaces benefit from accurate acoustic design. We provide appropriate surface treatments to enhance the audio experience in these spaces.</p></div>
							</details>
						</div>
						<div class="sc-acoustics__media">
							<div class="sc-embed">
								<iframe src="https://www.youtube-nocookie.com/embed/HtZTBWb701I?rel=0" title="<?php esc_attr_e( 'Sound Creations - Architectural Acoustics', 'soundcreations' ); ?>" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
							</div>
							<div class="sc-acoustics__shots">
								<figure class="sc-acoustics__shot">
									<img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/acoustics-design.jpg' ); ?>" alt="<?php esc_attr_e( 'Acoustic diffuser and panel design model', 'soundcreations' ); ?>" loading="lazy" decoding="async">
									<figcaption><?php esc_html_e( 'Acoustic design modelling', 'soundcreations' ); ?></figcaption>
								</figure>
								<figure class="sc-acoustics__shot">
									<img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/acoustics-measure.jpg' ); ?>" alt="<?php esc_attr_e( 'On-site reverberation time measurement with an acoustic analyser', 'soundcreations' ); ?>" loading="lazy" decoding="async">
									<figcaption><?php esc_html_e( 'On-site testing and measurement', 'soundcreations' ); ?></figcaption>
								</figure>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( 'audio' === $sc_sk ) : ?>
			<section class="sc-section sc-section--tight sc-section--surface sc-solsec">
				<div class="sc-container">
					<div class="sc-solsec__head">
						<p class="sc-eyebrow"><?php esc_html_e( 'Professional audio', 'soundcreations' ); ?></p>
						<h2 class="sc-svc-h2"><?php esc_html_e( 'Capabilities', 'soundcreations' ); ?></h2>
						<p class="sc-solsec__intro">We supply, install and tune complete professional audio systems - from the loudspeakers to the console and microphones - for live events, worship spaces, boardrooms and installations.</p>
					</div>
					<div class="sc-audio-caps">
						<div class="sc-audio-cap">
							<span class="sc-audio-cap__ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"></rect><circle cx="12" cy="14" r="4"></circle><line x1="12" y1="6" x2="12.01" y2="6"></line></svg></span>
							<h3><?php esc_html_e( 'Loudspeakers', 'soundcreations' ); ?></h3>
							<p>Mid and full-range loudspeakers, line arrays and subwoofers for concerts, worship and installed sound - specified and tuned for your space.</p>
							<ul class="sc-chips"><li>dBTechnologies INGENIA</li><li>dBTechnologies VIO</li><li>NEXO ID Series</li><li>Subwoofers</li></ul>
						</div>
						<div class="sc-audio-cap">
							<span class="sc-audio-cap__ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></span>
							<h3><?php esc_html_e( 'Conferencing', 'soundcreations' ); ?></h3>
							<p>Networked ceiling and boardroom microphone systems for clear, intelligible meetings and hybrid conferencing.</p>
							<ul class="sc-chips"><li>Shure MXA920</li><li>Shure MXA310</li><li>Microflex Wireless</li></ul>
						</div>
						<div class="sc-audio-cap">
							<span class="sc-audio-cap__ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line></svg></span>
							<h3><?php esc_html_e( 'Microphones', 'soundcreations' ); ?></h3>
							<p>Wired and wireless microphone systems for speech, vocals and live performance - from handhelds to professional digital wireless.</p>
							<ul class="sc-chips"><li>Shure SM58</li><li>Shure PGA48 / PGA58</li><li>BLX / SLXD / QLXD / ULXD</li></ul>
						</div>
						<div class="sc-audio-cap">
							<span class="sc-audio-cap__ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg></span>
							<h3><?php esc_html_e( 'Mixers', 'soundcreations' ); ?></h3>
							<p>Digital and analogue mixing consoles for live sound and installations, scaled from compact venues to large productions.</p>
							<ul class="sc-chips"><li>Allen &amp; Heath ZED6</li><li>Allen &amp; Heath ZEDi10FX</li><li>Midas</li><li>Behringer</li></ul>
						</div>
					</div>
					<div class="sc-showcase">
						<figure class="sc-shot">
							<img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/audio-live.jpg' ); ?>" alt="<?php esc_attr_e( 'Line array system at a live concert by Sound Creations', 'soundcreations' ); ?>" loading="lazy" decoding="async">
							<figcaption><span><?php esc_html_e( 'Live events and concerts', 'soundcreations' ); ?></span></figcaption>
						</figure>
						<figure class="sc-shot">
							<img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/audio-worship.jpg' ); ?>" alt="<?php esc_attr_e( 'Line array system installed in a house of worship', 'soundcreations' ); ?>" loading="lazy" decoding="async">
							<figcaption><span><?php esc_html_e( 'Houses of worship', 'soundcreations' ); ?></span></figcaption>
						</figure>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( 'integration' === $sc_sk ) : ?>
			<section class="sc-section sc-section--tight sc-section--surface sc-solsec">
				<div class="sc-container">
					<div class="sc-solsec__head">
						<p class="sc-eyebrow"><?php esc_html_e( 'Installation and integration', 'soundcreations' ); ?></p>
						<h2 class="sc-svc-h2"><?php esc_html_e( 'Turnkey AV installation and integration', 'soundcreations' ); ?></h2>
						<p class="sc-solsec__intro">Sound Creations Ltd designs, supplies, installs and supports complete audio, visual, lighting and acoustic systems. From a single boardroom to a full auditorium, we handle the entire project - site survey and system design, professional installation and cabling, calibration and commissioning, operator training and ongoing technical support - so your venue performs reliably from the first event.</p>
						<ul class="sc-chips"><li>Audio systems</li><li>Video &amp; LED screens</li><li>Stage &amp; architectural lighting</li><li>Acoustic treatment</li><li>Control &amp; automation</li></ul>
					</div>
					<div class="sc-steps">
						<div class="sc-step"><span class="sc-step__n">01</span><h3>Site survey and design</h3><p>We map your venue and design a complete system around your space, application and budget.</p></div>
						<div class="sc-step"><span class="sc-step__n">02</span><h3>Supply and installation</h3><p>Professional installation, rigging and cabling using equipment from the global brands we represent.</p></div>
						<div class="sc-step"><span class="sc-step__n">03</span><h3>Calibration and commissioning</h3><p>Systems tuned and commissioned by our technical team so every seat looks and sounds right.</p></div>
						<div class="sc-step"><span class="sc-step__n">04</span><h3>Training and support</h3><p>Operator training, documentation and responsive after-sales support to keep it performing.</p></div>
					</div>
					<div class="sc-showcase">
						<figure class="sc-shot">
							<img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/install-citam.jpg' ); ?>" alt="<?php esc_attr_e( 'Audio, video and lighting installation in a large house of worship', 'soundcreations' ); ?>" loading="lazy" decoding="async">
							<figcaption><span><?php esc_html_e( 'House of worship: audio, video and lighting', 'soundcreations' ); ?></span></figcaption>
						</figure>
						<figure class="sc-shot">
							<img src="<?php echo esc_url( SC_THEME_URI . '/assets/img/solutions/install-theatre.jpg' ); ?>" alt="<?php esc_attr_e( 'Auditorium audio-visual and lighting integration', 'soundcreations' ); ?>" loading="lazy" decoding="async">
							<figcaption><span><?php esc_html_e( 'Auditorium AV and lighting integration', 'soundcreations' ); ?></span></figcaption>
						</figure>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php
		$sc_inds    = get_the_terms( get_the_ID(), 'sc_industry' );
		$sc_ind_ids = array();
		if ( $sc_inds && is_wp_error( $sc_inds ) === false ) {
			foreach ( $sc_inds as $sc_i ) {
				$sc_ind_ids[] = (int) $sc_i->term_id;
			}
		}
		if ( count( $sc_ind_ids ) > 0 ) {
			$sc_rp = new WP_Query(
				array(
					'post_type'      => 'sc_project',
					'posts_per_page' => 3,
					'no_found_rows'  => true,
					'tax_query'      => array( array( 'taxonomy' => 'sc_industry', 'field' => 'term_id', 'terms' => $sc_ind_ids ) ),
				)
			);
			if ( $sc_rp->have_posts() ) {
				echo '<section class="sc-section sc-section--tight sc-section--surface"><div class="sc-container"><div class="sc-svc-reach__head"><p class="sc-eyebrow">' . esc_html__( 'Proof', 'soundcreations' ) . '</p><h2 class="sc-svc-h2">' . esc_html__( 'Related projects', 'soundcreations' ) . '</h2></div><div class="sc-grid">';
				while ( $sc_rp->have_posts() ) {
					$sc_rp->the_post();
					echo sc_media_card( get_the_ID(), sc_field( 'client' ), sc_field( 'year' ) );
				}
				echo '</div></div></section>';
			}
			wp_reset_postdata();
		}
		?>

		<section class="sc-section">
			<div class="sc-container">
				<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( sc_setting( 'home_cta_image', SC_THEME_URI . '/assets/img/cta-building.jpg' ) ); ?>');">
					<div class="sc-cta-band__inner">
						<h2><?php esc_html_e( 'Have a project in mind?', 'soundcreations' ); ?></h2>
						<p class="sc-lead" style="margin:0 0 .9rem;"><?php esc_html_e( 'Tell us about your space and application. Our technical team will help you specify the right system.', 'soundcreations' ); ?></p>
						<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
					</div>
				</div>
			</div>
		</section>
	</article>

	<?php
endwhile;
get_footer();
