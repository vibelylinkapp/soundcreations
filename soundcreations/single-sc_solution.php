<?php
/**
 * Single solution (Professional Audio, Acoustics, Audio Visual & Integration, ...).
 *
 * Professional, articulated layout that shares the service design system:
 * hero band, narrative prose, tailored capabilities, a sticky sidebar with the
 * inclusions / outcome / applications, related projects, and a closing CTA.
 * The Acoustics solution swaps the capabilities strip for a dedicated
 * "Architectural Acoustic Services" section (accordion + video + photos).
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

	$sc_capmap = array(
		'audio'       => array(
			array( 'Loudspeakers and subwoofers', 'Line arrays, point-source systems and subwoofers matched to your room and application.' ),
			array( 'Amplification and DSP', 'Power, processing and system tuning for clean, intelligible sound at every seat.' ),
			array( 'Mixing, microphones and wireless', 'Consoles, microphones and reliable wireless for live and installed sound.' ),
		),
		'acoustics'   => array(),
		'integration' => array(
			array( 'System design', 'Complete audio, visual and control system design mapped to your site.' ),
			array( 'Installation and commissioning', 'Professional installation, calibration and commissioning by our technical team.' ),
			array( 'Training and support', 'Operator training, documentation and ongoing technical support after go-live.' ),
		),
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
