<?php
/**
 * Product archive.
 *
 * @package SoundCreations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
$sc_archive = get_post_type_archive_link( 'sc_product' );
?>
<div class="sc-container sc-page">
	<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Products', '' ) ) ); ?>
	<header class="sc-archive-head">
		<p class="sc-eyebrow"><?php esc_html_e( 'Products', 'soundcreations' ); ?></p>
		<h1><?php esc_html_e( 'Professional audio and integration products', 'soundcreations' ); ?></h1>
		<p class="sc-lead"><?php esc_html_e( 'Loudspeakers, amplification, DSP, conferencing and acoustic products - specified, supplied and supported by our technical team.', 'soundcreations' ); ?></p>
	</header>
	<?php echo sc_term_chips( 'sc_product_category', $sc_archive ); ?>
	<?php if ( have_posts() ) : ?>
		<div class="sc-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				echo sc_media_card( get_the_ID(), sc_field( 'brand_name' ), sc_field( 'model' ) );
			endwhile;
			?>
		</div>
		<div style="margin-top:2.5rem;"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<div class="sc-empty"><?php esc_html_e( 'No products published yet. Run Sound Creations -> Sample Catalog to add starter items.', 'soundcreations' ); ?></div>
	<?php endif; ?>
</div>
<?php
get_footer();
