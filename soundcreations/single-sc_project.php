<?php
/**
 * Single project.
 *
 * @package SoundCreations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	$sc_client      = sc_field( 'client' );
	$sc_loc         = sc_field( 'location' );
	$sc_year        = sc_field( 'year' );
	$sc_summary     = sc_field( 'summary' );
	$sc_scope       = sc_render_ticklist( sc_field( 'scope' ) );
	$sc_brands_used = sc_field( 'brands_used' );
	?>
	<div class="sc-container sc-page">
		<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Projects', get_post_type_archive_link( 'sc_project' ) ), array( get_the_title(), '' ) ) ); ?>
		<header class="sc-detail-hero">
			<p class="sc-eyebrow"><?php echo esc_html( sc_primary_term_name( get_the_ID(), 'sc_industry', __( 'Project', 'soundcreations' ) ) ); ?></p>
			<h1><?php the_title(); ?></h1>
			<?php if ( $sc_summary ) : ?><p class="sc-lead" style="max-width:60ch;"><?php echo esc_html( $sc_summary ); ?></p><?php endif; ?>
			<div class="sc-metalist">
				<?php if ( $sc_client ) : ?><div><span class="k"><?php esc_html_e( 'Client', 'soundcreations' ); ?></span><span class="v"><?php echo esc_html( $sc_client ); ?></span></div><?php endif; ?>
				<?php if ( $sc_loc ) : ?><div><span class="k"><?php esc_html_e( 'Location', 'soundcreations' ); ?></span><span class="v"><?php echo esc_html( $sc_loc ); ?></span></div><?php endif; ?>
				<?php if ( $sc_year ) : ?><div><span class="k"><?php esc_html_e( 'Year', 'soundcreations' ); ?></span><span class="v"><?php echo esc_html( $sc_year ); ?></span></div><?php endif; ?>
			</div>
		</header>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="sc-detail__media" style="margin-bottom:2.5rem;"><?php the_post_thumbnail( 'large' ); ?></div>
		<?php endif; ?>
		<div class="sc-detail">
			<div class="sc-prose"><?php the_content(); ?></div>
			<aside class="sc-aside">
				<?php if ( $sc_scope ) : ?><div class="sc-aside__row"><span class="sc-aside__label"><?php esc_html_e( 'Scope of work', 'soundcreations' ); ?></span><?php echo $sc_scope; ?></div><?php endif; ?>
				<?php
				$sc_btags = sc_term_tags( get_the_ID(), 'sc_brand_tax' );
				if ( $sc_btags ) :
					?><div class="sc-aside__row"><span class="sc-aside__label"><?php esc_html_e( 'Brands', 'soundcreations' ); ?></span><?php echo $sc_btags; ?></div>
				<?php elseif ( $sc_brands_used ) : ?>
					<div class="sc-aside__row"><span class="sc-aside__label"><?php esc_html_e( 'Brands', 'soundcreations' ); ?></span><span class="sc-aside__val"><?php echo esc_html( $sc_brands_used ); ?></span></div>
				<?php endif; ?>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Start a similar project', 'soundcreations' ); ?></a>
			</aside>
		</div>
	</div>
	<?php
endwhile;
get_footer();
