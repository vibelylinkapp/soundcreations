<?php
/**
 * Single solution.
 *
 * @package SoundCreations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	$sc_summary  = sc_field( 'summary' );
	$sc_includes = sc_render_ticklist( sc_field( 'includes' ) );
	$sc_outcome  = sc_field( 'outcome' );
	?>
	<div class="sc-container sc-page">
		<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Solutions', get_post_type_archive_link( 'sc_solution' ) ), array( get_the_title(), '' ) ) ); ?>
		<header class="sc-detail-hero">
			<p class="sc-eyebrow"><?php echo esc_html( sc_primary_term_name( get_the_ID(), 'sc_solution_area', __( 'Solution', 'soundcreations' ) ) ); ?></p>
			<h1><?php the_title(); ?></h1>
			<?php if ( $sc_summary ) : ?><p class="sc-lead" style="max-width:62ch;"><?php echo esc_html( $sc_summary ); ?></p><?php endif; ?>
		</header>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="sc-detail__media" style="margin-bottom:2.5rem;"><?php the_post_thumbnail( 'large' ); ?></div>
		<?php endif; ?>
		<div class="sc-detail">
			<div class="sc-prose"><?php the_content(); ?></div>
			<aside class="sc-aside">
				<?php if ( $sc_includes ) : ?><div class="sc-aside__row"><span class="sc-aside__label"><?php esc_html_e( 'What is included', 'soundcreations' ); ?></span><?php echo $sc_includes; ?></div><?php endif; ?>
				<?php if ( $sc_outcome ) : ?><div class="sc-aside__row"><span class="sc-aside__label"><?php esc_html_e( 'Outcome', 'soundcreations' ); ?></span><span class="sc-aside__val"><?php echo esc_html( $sc_outcome ); ?></span></div><?php endif; ?>
				<?php
				$sc_apps = sc_term_tags( get_the_ID(), 'sc_application' );
				if ( $sc_apps ) :
					?><div class="sc-aside__row"><span class="sc-aside__label"><?php esc_html_e( 'Applications', 'soundcreations' ); ?></span><?php echo $sc_apps; ?></div><?php endif; ?>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?></a>
			</aside>
		</div>

		<?php
		// Related projects sharing an industry with this solution.
		$sc_inds = get_the_terms( get_the_ID(), 'sc_industry' );
		$sc_ind_ids = array();
		if ( $sc_inds && ! is_wp_error( $sc_inds ) ) {
			foreach ( $sc_inds as $sc_i ) {
				$sc_ind_ids[] = (int) $sc_i->term_id;
			}
		}
		if ( $sc_ind_ids ) {
			$sc_rp = new WP_Query(
				array(
					'post_type'      => 'sc_project',
					'posts_per_page' => 3,
					'no_found_rows'  => true,
					'tax_query'      => array( array( 'taxonomy' => 'sc_industry', 'field' => 'term_id', 'terms' => $sc_ind_ids ) ),
				)
			);
			if ( $sc_rp->have_posts() ) {
				echo '<section style="margin-top:4rem;"><div class="sc-section-head"><h2>' . esc_html__( 'Related projects', 'soundcreations' ) . '</h2></div><div class="sc-grid">';
				while ( $sc_rp->have_posts() ) {
					$sc_rp->the_post();
					echo sc_media_card( get_the_ID(), sc_field( 'client' ), sc_field( 'year' ) );
				}
				echo '</div></section>';
			}
			wp_reset_postdata();
		}
		?>
	</div>
	<?php
endwhile;
get_footer();
