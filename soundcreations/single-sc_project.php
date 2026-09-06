<?php
/**
 * Single project - professional case study.
 *
 * Structured fields (edited in the "Project Details" box in wp-admin):
 * client (Client / venue), location, year, summary, scope (one per line),
 * brands_used, and gallery (photos). The full write-up is the post body.
 * Everything on this page is editable - nothing is hardcoded.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$sc_client  = sc_field( 'client' );
	$sc_loc     = sc_field( 'location' );
	$sc_year    = sc_field( 'year' );
	$sc_summary = sc_field( 'summary' );
	$sc_scope   = sc_render_ticklist( sc_field( 'scope' ) );
	$sc_brands  = sc_field( 'brands_used' );
	$sc_btags   = sc_term_tags( get_the_ID(), 'sc_brand_tax' );
	$sc_eyebrow = sc_primary_term_name( get_the_ID(), 'sc_industry', __( 'Project', 'soundcreations' ) );
	$sc_gallery = array_filter( array_map( 'absint', explode( ',', (string) sc_field( 'gallery' ) ) ) );
	$sc_body    = get_the_content();
	$sc_hasbody = strlen( trim( wp_strip_all_tags( $sc_body ) ) ) > 0;
	?>
	<article class="sc-case">
		<div class="sc-container">
			<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Projects', get_post_type_archive_link( 'sc_project' ) ), array( get_the_title(), '' ) ) ); ?>
			<header class="sc-case__head">
				<p class="sc-eyebrow"><?php echo esc_html( $sc_eyebrow ); ?></p>
				<h1 class="sc-case__title"><?php the_title(); ?></h1>
				<?php if ( $sc_summary ) : ?>
					<p class="sc-lead sc-case__lead"><?php echo esc_html( $sc_summary ); ?></p>
				<?php endif; ?>
			</header>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="sc-case__hero">
				<div class="sc-container"><?php the_post_thumbnail( 'large', array( 'class' => 'sc-case__heroimg', 'loading' => 'eager' ) ); ?></div>
			</div>
		<?php endif; ?>

		<div class="sc-container sc-case__body">
			<div class="sc-case__main">
				<?php if ( $sc_hasbody ) : ?>
					<div class="sc-prose sc-case__prose"><?php the_content(); ?></div>
				<?php endif; ?>

				<?php if ( count( $sc_gallery ) > 0 ) : ?>
					<section class="sc-case__gallery" aria-label="<?php esc_attr_e( 'Project photos', 'soundcreations' ); ?>">
						<h2 class="sc-case__h2"><?php esc_html_e( 'Project gallery', 'soundcreations' ); ?></h2>
						<div class="sc-gallery-grid">
							<?php
							foreach ( $sc_gallery as $gid ) :
								$full = wp_get_attachment_image_url( $gid, 'full' );
								$img  = wp_get_attachment_image( $gid, 'large', false, array( 'class' => 'sc-gallery-grid__img', 'loading' => 'lazy' ) );
								if ( $img ) :
									?>
									<a class="sc-gallery-grid__item" href="<?php echo esc_url( $full ); ?>" target="_blank" rel="noopener"><?php echo $img; ?></a>
									<?php
								endif;
							endforeach;
							?>
						</div>
					</section>
				<?php endif; ?>
			</div>

			<aside class="sc-case__aside">
				<div class="sc-factcard">
					<h2 class="sc-factcard__title"><?php esc_html_e( 'Project details', 'soundcreations' ); ?></h2>
					<dl class="sc-factcard__list">
						<?php if ( $sc_client ) : ?>
							<div class="sc-factcard__row"><dt><?php esc_html_e( 'Client / venue', 'soundcreations' ); ?></dt><dd><?php echo esc_html( $sc_client ); ?></dd></div>
						<?php endif; ?>
						<?php if ( $sc_loc ) : ?>
							<div class="sc-factcard__row"><dt><?php esc_html_e( 'Location', 'soundcreations' ); ?></dt><dd><?php echo esc_html( $sc_loc ); ?></dd></div>
						<?php endif; ?>
						<?php if ( $sc_year ) : ?>
							<div class="sc-factcard__row"><dt><?php esc_html_e( 'Year', 'soundcreations' ); ?></dt><dd><?php echo esc_html( $sc_year ); ?></dd></div>
						<?php endif; ?>
					</dl>

					<?php if ( $sc_scope ) : ?>
						<div class="sc-factcard__block">
							<span class="sc-factcard__label"><?php esc_html_e( 'Scope of work', 'soundcreations' ); ?></span>
							<?php echo $sc_scope; ?>
						</div>
					<?php endif; ?>

					<?php if ( $sc_btags ) : ?>
						<div class="sc-factcard__block">
							<span class="sc-factcard__label"><?php esc_html_e( 'Brands used', 'soundcreations' ); ?></span>
							<?php echo $sc_btags; ?>
						</div>
					<?php elseif ( $sc_brands ) : ?>
						<div class="sc-factcard__block">
							<span class="sc-factcard__label"><?php esc_html_e( 'Brands used', 'soundcreations' ); ?></span>
							<div class="sc-tags">
								<?php
								$sc_bparts = array_filter( array_map( 'trim', explode( ',', $sc_brands ) ) );
								foreach ( $sc_bparts as $sc_b ) {
									echo '<span class="sc-tag">' . esc_html( $sc_b ) . '</span>';
								}
								?>
							</div>
						</div>
					<?php endif; ?>

					<a class="sc-btn sc-btn--primary sc-factcard__cta" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Start a similar project', 'soundcreations' ); ?></a>
				</div>
			</aside>
		</div>
	</article>
	<?php
endwhile;

get_footer();
