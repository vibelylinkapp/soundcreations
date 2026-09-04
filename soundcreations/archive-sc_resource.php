<?php
/**
 * Resource archive. Owns the /resources/ URL (sc_resource CPT has_archive => resources).
 * Resources are now a standalone page (previously surfaced only inside the Support page,
 * which has been retired). The grid is data-driven from published sc_resource posts,
 * ordered by menu_order (editable in wp-admin), then most recent. Each card links to the
 * resource's file URL (_sc_file meta) when set, otherwise to the resource permalink.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_hero_img = SC_THEME_URI . '/assets/img/support-hero.jpg';
$sc_cta_img  = SC_THEME_URI . '/assets/img/support-cta.jpg';
$sc_consult  = home_url( '/request-a-consultation/' );
$sc_arrow    = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
$sc_dl       = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>';

$sc_pills = array(
	array( 'Product Manuals', 'User guides and documentation', '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>' ),
	array( 'Datasheets', 'Technical specifications', '<rect x="3" y="3" width="18" height="18" rx="2"/><line x1="8" y1="8" x2="16" y2="8"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="8" y1="16" x2="13" y2="16"/>' ),
	array( 'Guides', 'Setup and troubleshooting', '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>' ),
	array( 'Firmware', 'Latest updates and release notes', '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>' ),
);
?>

<section class="sc-support-hero" style="background-image:url('<?php echo esc_url( $sc_hero_img ); ?>');">
	<span class="sc-support-hero__scrim" aria-hidden="true"></span>
	<div class="sc-container sc-support-hero__inner">
		<nav class="sc-crumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> <span aria-hidden="true">&rsaquo;</span> <span class="sc-crumb__cur"><?php esc_html_e( 'Resources', 'soundcreations' ); ?></span></nav>
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'resources_eyebrow', 'Resources' ) ); ?></p>
		<h1 class="sc-support-hero__title"><?php echo esc_html( sc_setting( 'resources_title', 'Resources & downloads.' ) ); ?></h1>
		<p class="sc-lead sc-support-hero__lead"><?php echo esc_html( sc_setting( 'resources_lead', 'Manuals, datasheets, guides and firmware for the systems and brands we supply and support.' ) ); ?></p>
		<div class="sc-support-pills">
			<?php foreach ( $sc_pills as $p ) : ?>
				<div class="sc-contact-pill">
					<span class="sc-contact-pill__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $p[2]; ?></svg></span>
					<div class="sc-contact-pill__text"><strong><?php echo esc_html( $p[0] ); ?></strong><span><?php echo esc_html( $p[1] ); ?></span></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-res-head">
			<div>
				<p class="sc-eyebrow"><?php esc_html_e( 'Downloads & documentation', 'soundcreations' ); ?></p>
				<h2 style="margin:.15rem 0 0;"><?php echo esc_html( sc_setting( 'resources_grid_title', 'Everything you need, in one place.' ) ); ?></h2>
			</div>
		</div>
		<?php
		$sc_q = new WP_Query(
			array(
				'post_type'      => 'sc_resource',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
				),
				'no_found_rows'  => true,
			)
		);
		if ( $sc_q->have_posts() ) :
			?>
			<div class="sc-res-grid">
				<?php
				while ( $sc_q->have_posts() ) :
					$sc_q->the_post();
					$sc_rid  = get_the_ID();
					$sc_file = (string) get_post_meta( $sc_rid, '_sc_file', true );
					$sc_href = ( '' !== $sc_file ) ? $sc_file : get_permalink( $sc_rid );
					$sc_desc = has_excerpt( $sc_rid ) ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 20 );
					$sc_ext  = ( '' !== $sc_file );
					?>
					<a class="sc-res-card" href="<?php echo esc_url( $sc_href ); ?>"<?php echo $sc_ext ? ' target="_blank" rel="noopener"' : ''; ?>>
						<span class="sc-res-card__icon" aria-hidden="true"><?php echo $sc_dl; ?></span>
						<span class="sc-res-card__text"><strong><?php echo esc_html( get_the_title() ); ?></strong><span><?php echo esc_html( $sc_desc ); ?></span></span>
					</a>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p class="sc-empty"><?php esc_html_e( 'Resources will appear here soon. In wp-admin, open Resources → Add New to publish manuals, datasheets, guides and firmware.', 'soundcreations' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( $sc_cta_img ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'resources_cta_title', 'Can’t find what you need?' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 1.5rem;"><?php echo esc_html( sc_setting( 'resources_cta_text', 'Our technical team can send you the right manual, datasheet or firmware for your system.' ) ); ?></p>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_consult ); ?>"><?php esc_html_e( 'Contact Our Team', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
