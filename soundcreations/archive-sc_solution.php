<?php
/**
 * Solutions landing page (renders at /solutions/, the sc_solution archive).
 * Faithful .sc-proto port of the approved prototype Solutions route:
 * page hero + "Our solutions" grid of image cards + red CTA. Hero/heading/CTA
 * copy stays editable in Sound Creations -> Settings. Cards pull live
 * sc_solution posts (image, summary, permalink) with a prototype-matching fallback.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_solimg = SC_THEME_URI . '/assets/img/solutions/';
?>

<div class="sc-proto">

<?php
echo sc_proto_pagehero( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party markup.
	array(
		'title' => sc_setting( 'sol_hero_title', 'Engineered solutions. Exceptional experiences.' ),
		'desc'  => sc_setting( 'sol_hero_lead', 'We design, integrate and support professional audio, visual, lighting and acoustic solutions for every space, application and performance.' ),
		'img'   => SC_THEME_URI . '/assets/img/solutions-hero.jpg',
	)
);
?>

<section class="section alt">
	<div class="container">
		<div class="kicker"><?php echo esc_html( sc_setting( 'sol_solutions_eyebrow', 'Our solutions' ) ); ?></div>
		<h2><?php echo esc_html( sc_setting( 'sol_solutions_title', 'Built around your room, application and requirements.' ) ); ?></h2>
		<div class="grid3">
			<?php
			$sc_fallback = array(
				array( 'Consultation', 'Site assessment, system design and specification - measure, model and plan before equipment goes in.', 'consultation.jpg', '/service/consultancy/' ),
				array( 'Acoustics', 'Acoustic design, measurement, analysis, treatment and noise control for clear, intelligible sound.', 'acoustics.jpg', '/solutions/acoustics/' ),
				array( 'Live Sound & Installation', 'Professional live-sound systems, installation, commissioning and calibration by our technical team.', 'installation.jpg', '/solutions/installation/' ),
				array( 'Professional Audio', 'Loudspeakers, amplification, DSP, mixing, microphones and wireless systems.', 'audio.jpg', '/request-a-consultation/' ),
				array( 'Conferencing', 'Boardrooms, hybrid meetings and collaboration spaces engineered for clarity.', 'conferencing.jpg', '/request-a-consultation/' ),
				array( 'System Integration', 'Complete audio-visual and control integration from design through support.', 'integration.jpg', '/request-a-consultation/' ),
			);
			$sc_solq = new WP_Query( array( 'post_type' => 'sc_solution', 'post_status' => 'publish', 'posts_per_page' => 6, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'no_found_rows' => true ) );
			if ( $sc_solq->have_posts() ) :
				while ( $sc_solq->have_posts() ) :
					$sc_solq->the_post();
					$sc_sid  = get_the_ID();
					$sc_slug = get_post_field( 'post_name', $sc_sid );
					$sc_rel  = 'assets/img/solutions/' . $sc_slug . '.jpg';
					if ( has_post_thumbnail( $sc_sid ) ) {
						$sc_cimg = get_the_post_thumbnail_url( $sc_sid, 'large' );
					} elseif ( file_exists( get_theme_file_path( $sc_rel ) ) ) {
						$sc_cimg = get_theme_file_uri( $sc_rel );
					} else {
						$sc_cimg = $sc_solimg . 'audio.jpg';
					}
					$sc_csum = sc_field( 'summary' );
					if ( '' === $sc_csum ) {
						$sc_csum = wp_strip_all_tags( get_the_excerpt() );
					}
					?>
					<a class="card" style="padding:0;overflow:hidden" href="<?php the_permalink(); ?>"><div style="height:210px;overflow:hidden"><img src="<?php echo esc_url( $sc_cimg ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" style="width:100%;height:100%;object-fit:cover" loading="lazy" decoding="async"></div><div style="padding:20px"><h3 style="font-size:15px;margin:0 0 8px"><?php echo esc_html( get_the_title() ); ?></h3><p class="lead" style="font-size:11px"><?php echo esc_html( wp_trim_words( $sc_csum, 22 ) ); ?></p><span class="link"><?php esc_html_e( 'Explore solution', 'soundcreations' ); ?> &rarr;</span></div></a>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				foreach ( $sc_fallback as $sc_c ) :
					?>
					<a class="card" style="padding:0;overflow:hidden" href="<?php echo esc_url( home_url( $sc_c[3] ) ); ?>"><div style="height:210px;overflow:hidden"><img src="<?php echo esc_url( $sc_solimg . $sc_c[2] ); ?>" alt="<?php echo esc_attr( $sc_c[0] ); ?>" style="width:100%;height:100%;object-fit:cover" loading="lazy" decoding="async"></div><div style="padding:20px"><h3 style="font-size:15px;margin:0 0 8px"><?php echo esc_html( $sc_c[0] ); ?></h3><p class="lead" style="font-size:11px"><?php echo esc_html( $sc_c[1] ); ?></p><span class="link"><?php esc_html_e( 'Explore solution', 'soundcreations' ); ?> &rarr;</span></div></a>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<?php
echo sc_proto_cta( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party markup.
	array(
		'title' => sc_setting( 'sol_cta_title', 'Have a project in mind?' ),
		'text'  => sc_setting( 'sol_cta_text', 'Let us design and deliver the right solution for your space and application.' ),
	)
);
?>

</div>

<?php
get_footer();
