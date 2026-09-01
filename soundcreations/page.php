<?php
/**
 * Page template.
 *
 * @package SoundCreations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<div class="sc-container sc-page">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<header><h1><?php the_title(); ?></h1></header>
		<div class="sc-page__body"><?php the_content(); ?></div>
		<?php
	endwhile;
	?>
</div>
<?php
get_footer();
