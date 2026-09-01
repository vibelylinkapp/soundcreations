<?php
/**
 * Brand archive. Owns the /brands/ URL (sc_brand CPT has_archive => brands).
 * The brand grid is data-driven from published sc_brand posts, ordered by the
 * post "Order" (menu_order) field so the team can reorder brands in wp-admin
 * without code. Each card shows the brand logo from
 * assets/img/brands/logos/{_sc_logo}.png, falling back to a styled wordmark.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_img  = SC_THEME_URI . '/assets/img/fane';
$sc_sol  = SC_THEME_URI . '/assets/img/solutions';
$sc_brd  = SC_THEME_URI . '/assets/img/brands';

$sc_hero_img   = $sc_brd . '/brands-hero.jpg';
$sc_brands_url = get_post_type_archive_link( 'sc_brand' );
if ( empty( $sc_brands_url ) ) {
	$sc_brands_url = home_url( '/brands/' );
}
$sc_products_url = get_post_type_archive_link( 'sc_product' );
if ( empty( $sc_products_url ) ) {
	$sc_products_url = home_url( '/products/' );
}

$sc_pills = array(
	array( 'Curated Excellence', 'Carefully selected global brands we trust.', '<polygon points="12 2 15 9 22 9 16 14 18 21 12 17 6 21 8 14 2 9 9 9 12 2"/>' ),
	array( 'Proven Performance', 'Industry-leading technology built to perform.', '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' ),
	array( 'Full Integration', 'Seamless compatibility and system reliability.', '<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/>' ),
	array( 'Local Support', 'Backed by our technical experts across the region.', '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>' ),
);

$sc_cats = array(
	array( 'Loudspeaker Components', '<rect x="6" y="3" width="12" height="18" rx="2"/><circle cx="12" cy="14" r="3"/><circle cx="12" cy="7" r="1"/>' ),
	array( 'Loudspeaker Systems', '<rect x="5" y="2" width="6" height="20" rx="1"/><rect x="13" y="2" width="6" height="20" rx="1"/><circle cx="8" cy="8" r="1.5"/><circle cx="16" cy="8" r="1.5"/>' ),
	array( 'Electronics & Amplification', '<line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/>' ),
	array( 'Microphones & Wireless', '<path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>' ),
	array( 'Digital & Mixing Consoles', '<rect x="3" y="3" width="18" height="18" rx="2"/><line x1="8" y1="7" x2="8" y2="17"/><line x1="12" y1="7" x2="12" y2="17"/><line x1="16" y1="7" x2="16" y2="17"/><circle cx="8" cy="10" r="1.4"/><circle cx="12" cy="14" r="1.4"/><circle cx="16" cy="9" r="1.4"/>' ),
	array( 'Lighting & Control', '<path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a7 7 0 0 0-4 12.7c.6.5 1 1.3 1 2.3h6c0-1 .4-1.8 1-2.3A7 7 0 0 0 12 2z"/>' ),
	array( 'Acoustics & Installation', '<path d="M2 10v4"/><path d="M6 6v12"/><path d="M10 3v18"/><path d="M14 8v8"/><path d="M18 5v14"/><path d="M22 10v4"/>' ),
	array( 'Cables & Infrastructure', '<path d="M9 2v6"/><path d="M15 2v6"/><path d="M7 8h10v3a5 5 0 0 1-10 0z"/><path d="M12 16v6"/>' ),
);

$sc_stats = array(
	array( '11+', 'Global Brands', '<path d="M12 2 2 7l10 5 10-5-10-5z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/>' ),
	array( '100%', 'Genuine Products', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>' ),
	array( 'Expert', 'Technical Support', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>' ),
	array( 'Regional', 'Logistics & Service', '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>' ),
);

$sc_arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
?>

<section class="sc-support-hero sc-brands-hero" style="background-image:url('<?php echo esc_url( $sc_hero_img ); ?>');">
	<span class="sc-support-hero__scrim" aria-hidden="true"></span>
	<div class="sc-container sc-support-hero__inner">
		<nav class="sc-crumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> <span aria-hidden="true">&rsaquo;</span> <span class="sc-crumb__cur"><?php esc_html_e( 'Brands', 'soundcreations' ); ?></span></nav>
		<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'brands_eyebrow', 'Our Brands' ) ); ?></p>
		<h1 class="sc-support-hero__title"><?php echo esc_html( sc_setting( 'brands_title', 'The brands we represent.' ) ); ?></h1>
		<p class="sc-lead sc-support-hero__lead"><?php echo esc_html( sc_setting( 'brands_lead', 'World-class professional audio, electronics and acoustics brands selected for performance, reliability and innovation.' ) ); ?></p>
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
		<p class="sc-eyebrow"><?php esc_html_e( 'Browse brands by category', 'soundcreations' ); ?></p>
		<div class="sc-cat-carousel sc-prod-carousel">
			<button type="button" class="sc-prod-nav sc-prod-nav--prev" data-sc-scroll="prev" aria-label="Scroll left"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg></button>
			<div class="sc-cat-row" data-sc-scroller>
				<?php foreach ( $sc_cats as $i => $c ) : ?>
					<button type="button" class="sc-cat-card<?php echo 0 === $i ? ' is-active' : ''; ?>">
						<span class="sc-cat-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $c[1]; ?></svg></span>
						<span class="sc-cat-card__label"><?php echo esc_html( $c[0] ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
			<button type="button" class="sc-prod-nav sc-prod-nav--next" data-sc-scroll="next" aria-label="Scroll right"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></button>
		</div>
	</div>
</section>

<section class="sc-section sc-fane-alt">
	<div class="sc-container">
		<div class="sc-res-head">
			<div>
				<p class="sc-eyebrow"><?php esc_html_e( 'Our represented brands', 'soundcreations' ); ?></p>
				<h2 style="margin:.15rem 0 0;"><?php echo esc_html( sc_setting( 'brands_grid_title', 'Partnering with the world’s best.' ) ); ?></h2>
			</div>
			<a class="sc-linkbtn" href="<?php echo esc_url( $sc_products_url ); ?>"><?php esc_html_e( 'Browse All Products', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
		<?php
		$sc_q = new WP_Query(
			array(
				'post_type'      => 'sc_brand',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'title'      => 'ASC',
				),
				'no_found_rows'  => true,
			)
		);
		if ( $sc_q->have_posts() ) :
			?>
			<div class="sc-brand-grid">
				<?php
				while ( $sc_q->have_posts() ) :
					$sc_q->the_post();
					$sc_id    = get_the_ID();
					$sc_name  = get_the_title();
					$sc_cat   = (string) get_post_meta( $sc_id, '_sc_category', true );
					$sc_desc  = (string) get_post_meta( $sc_id, '_sc_tagline', true );
					if ( '' === $sc_desc ) {
						$sc_desc = wp_trim_words( wp_strip_all_tags( get_the_content() ), 22 );
					}
					$sc_logo  = (string) get_post_meta( $sc_id, '_sc_logo', true );
					$sc_rel   = 'assets/img/brands/logos/' . $sc_logo . '.png';
					$sc_logo_url = ( '' !== $sc_logo && file_exists( get_theme_file_path( $sc_rel ) ) ) ? get_theme_file_uri( $sc_rel ) : '';

					$sc_slug = get_post_field( 'post_name', $sc_id );
					if ( 'fane' === $sc_slug ) {
						$sc_href = home_url( '/fane/' );
					} else {
						$sc_href = get_permalink( $sc_id );
					}
					?>
					<div class="sc-brand-card">
						<div class="sc-brand-card__plate">
							<?php if ( '' !== $sc_logo_url ) : ?>
								<img class="sc-brand-card__img" src="<?php echo esc_url( $sc_logo_url ); ?>" alt="<?php echo esc_attr( $sc_name ); ?> logo" loading="lazy" decoding="async" />
							<?php else : ?>
								<span class="sc-brand-card__mark"><?php echo esc_html( $sc_name ); ?></span>
							<?php endif; ?>
						</div>
						<div class="sc-brand-card__body">
							<h3 class="sc-brand-card__name"><?php echo esc_html( $sc_name ); ?></h3>
							<?php if ( '' !== $sc_cat ) : ?>
								<p class="sc-brand-card__cat"><?php echo esc_html( $sc_cat ); ?></p>
							<?php endif; ?>
							<?php if ( '' !== $sc_desc ) : ?>
								<p class="sc-brand-card__desc"><?php echo esc_html( $sc_desc ); ?></p>
							<?php endif; ?>
							<a class="sc-brand-card__link" href="<?php echo esc_url( $sc_href ); ?>"><?php esc_html_e( 'View Brand', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p class="sc-empty"><?php esc_html_e( 'Brands will appear here soon. In wp-admin, open Sound Creations → Sample Catalog and run it to populate the brand list.', 'soundcreations' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container sc-brands-why">
		<div class="sc-brands-why__intro">
			<p class="sc-eyebrow"><?php esc_html_e( 'Why professionals trust our brands', 'soundcreations' ); ?></p>
			<h2><?php echo esc_html( sc_setting( 'brands_why_title', 'Global technology. Local expertise.' ) ); ?></h2>
			<p><?php echo esc_html( sc_setting( 'brands_why_body', 'We partner with leading global manufacturers to bring you reliable, innovative and performance-driven solutions for every project.' ) ); ?></p>
		</div>
		<div class="sc-brands-stats">
			<?php foreach ( $sc_stats as $s ) : ?>
				<div class="sc-brands-stat">
					<span class="sc-brands-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $s[2]; ?></svg></span>
					<strong><?php echo esc_html( $s[0] ); ?></strong>
					<span><?php echo esc_html( $s[1] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( $sc_brd . '/partner.jpg' ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'brands_cta_title', 'Become a brand partner' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 1.5rem;"><?php echo esc_html( sc_setting( 'brands_cta_text', 'Work with Sound Creations to bring your innovative products to the East Africa and Middle East markets.' ) ); ?></p>
				<a class="sc-btn sc-btn--primary sc-brands-partner__btn" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Partner With Us', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
