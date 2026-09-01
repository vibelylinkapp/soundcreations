<?php
/**
 * Single service (Consultancy, Distribution & Dealership, Integration, After-Sale Services).
 *
 * @package SoundCreations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	$sc_summary = sc_field( 'summary' );
	$sc_imgk    = (string) sc_field( 'image' );
	$sc_img     = '';
	if ( has_post_thumbnail() ) {
		$sc_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	} elseif ( '' !== $sc_imgk ) {
		$sc_img = SC_THEME_URI . '/assets/img/' . $sc_imgk;
	}
	?>
	<div class="sc-container sc-page">
		<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Services', home_url( '/#services' ) ), array( get_the_title(), '' ) ) ); ?>
		<header class="sc-detail-hero">
			<p class="sc-eyebrow"><?php esc_html_e( 'Service', 'soundcreations' ); ?></p>
			<h1><?php the_title(); ?></h1>
			<?php if ( $sc_summary ) : ?><p class="sc-lead" style="max-width:62ch;"><?php echo esc_html( $sc_summary ); ?></p><?php endif; ?>
		</header>
		<?php if ( '' !== $sc_img ) : ?>
			<div class="sc-detail__media" style="margin-bottom:2.5rem;"><img src="<?php echo esc_url( $sc_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async"></div>
		<?php endif; ?>
		<div class="sc-detail">
			<div class="sc-prose"><?php the_content(); ?></div>
			<aside class="sc-aside">
				<?php
				$sc_sib = new WP_Query(
					array(
						'post_type'      => 'sc_service',
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
						'no_found_rows'  => true,
						'post__not_in'   => array( get_the_ID() ),
					)
				);
				if ( $sc_sib->have_posts() ) :
					?>
					<div class="sc-aside__row">
						<span class="sc-aside__label"><?php esc_html_e( 'Our services', 'soundcreations' ); ?></span>
						<ul class="sc-ticklist">
							<?php
							while ( $sc_sib->have_posts() ) :
								$sc_sib->the_post();
								?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</ul>
					</div>
					<?php
				endif;
				?>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
			</aside>
		</div>
	</div>
	<?php
endwhile;
get_footer();
