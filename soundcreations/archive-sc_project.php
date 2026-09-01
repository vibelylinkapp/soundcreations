<?php
/**
 * Project archive. Owns the /projects/ URL (sc_project has_archive => projects).
 * Cards are data-driven from published sc_project posts, ordered by menu_order
 * (editable in wp-admin). Category / location / solution filtering and search are
 * client-side (see [data-sc-projfilter] wiring in assets/js/theme.js).
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_archive  = get_post_type_archive_link( 'sc_project' );
if ( empty( $sc_archive ) ) {
	$sc_archive = home_url( '/projects/' );
}
$sc_consult  = home_url( '/request-a-consultation/' );
$sc_hero_img = SC_THEME_URI . '/assets/img/projects-hero.jpg';
$sc_cta_img  = SC_THEME_URI . '/assets/img/projects-cta.jpg';
$sc_arrow    = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
$sc_pinicon  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>';

// Category pills (fixed set matching the design). Slug must match sanitize_title of each card's category.
$sc_cat_pills = array( 'Worship', 'Conference & Events', 'Corporate', 'Hospitality', 'Education', 'Entertainment', 'Government' );

// Collect projects (data-driven, ordered by menu_order).
$sc_q = new WP_Query(
	array(
		'post_type'      => 'sc_project',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
		'no_found_rows'  => true,
	)
);
$sc_items = array();
$sc_sols  = array();
$sc_locs  = array();
if ( $sc_q->have_posts() ) {
	while ( $sc_q->have_posts() ) {
		$sc_q->the_post();
		$pid   = get_the_ID();
		$cat   = (string) get_post_meta( $pid, '_sc_category', true );
		$badge = (string) get_post_meta( $pid, '_sc_badge', true );
		$loc   = (string) get_post_meta( $pid, '_sc_location', true );
		$sol   = (string) get_post_meta( $pid, '_sc_solution', true );
		$sum   = (string) get_post_meta( $pid, '_sc_summary', true );
		$imgk  = (string) get_post_meta( $pid, '_sc_image', true );
		$rel   = 'assets/img/projects/' . $imgk . '.jpg';
		$img   = ( '' !== $imgk && file_exists( get_theme_file_path( $rel ) ) ) ? get_theme_file_uri( $rel ) : ( SC_THEME_URI . '/assets/img/projects-hero.jpg' );
		if ( '' !== $sol && ! in_array( $sol, $sc_sols, true ) ) {
			$sc_sols[] = $sol;
		}
		if ( '' !== $loc && ! in_array( $loc, $sc_locs, true ) ) {
			$sc_locs[] = $loc;
		}
		$sc_items[] = array(
			'title' => get_the_title(),
			'href'  => get_permalink( $pid ),
			'cat'   => $cat,
			'badge' => ( '' !== $badge ) ? $badge : $cat,
			'loc'   => $loc,
			'sol'   => $sol,
			'sum'   => $sum,
			'img'   => $img,
		);
	}
	wp_reset_postdata();
}
?>

<section class="sc-projhero">
	<div class="sc-container sc-projhero__grid">
		<div class="sc-projhero__text">
			<?php echo sc_breadcrumb( array( array( 'Home', home_url( '/' ) ), array( 'Projects', '' ) ) ); ?>
			<p class="sc-eyebrow"><?php echo esc_html( sc_setting( 'projects_eyebrow', 'Our Projects' ) ); ?></p>
			<h1 class="sc-projhero__title"><?php echo esc_html( sc_setting( 'projects_title', 'Real solutions. Real impact.' ) ); ?></h1>
			<p class="sc-lead sc-projhero__lead"><?php echo esc_html( sc_setting( 'projects_lead', 'Explore a selection of our professional audio, acoustics and integration projects across Africa and the Middle East.' ) ); ?></p>
			<a class="sc-btn sc-btn--primary sc-projhero__btn" href="<?php echo esc_url( $sc_consult ); ?>"><?php esc_html_e( 'Start Your Project', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
		</div>
		<div class="sc-projhero__media">
			<img src="<?php echo esc_url( $sc_hero_img ); ?>" alt="<?php esc_attr_e( 'Concert hall and auditorium installation', 'soundcreations' ); ?>" loading="eager" decoding="async">
		</div>
	</div>
</section>

<section class="sc-section sc-projfilter-sec">
	<div class="sc-container" data-sc-projfilter>
		<div class="sc-projfilters">
			<div class="sc-projfilters__row">
				<span class="sc-projfilters__label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg> <?php esc_html_e( 'Filter by Category', 'soundcreations' ); ?></span>
				<div class="sc-projfilters__pills">
					<button type="button" class="sc-projpill is-active" data-proj-cat="all"><?php esc_html_e( 'All Projects', 'soundcreations' ); ?></button>
					<?php foreach ( $sc_cat_pills as $c ) : ?>
						<button type="button" class="sc-projpill" data-proj-cat="<?php echo esc_attr( sanitize_title( $c ) ); ?>"><?php echo esc_html( $c ); ?></button>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="sc-projfilters__row sc-projfilters__row--controls">
				<label class="sc-projctrl">
					<span class="sc-projfilters__label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg> <?php esc_html_e( 'Filter by Solution', 'soundcreations' ); ?></span>
					<select data-proj-sol>
						<option value="all"><?php esc_html_e( 'All Solutions', 'soundcreations' ); ?></option>
						<?php foreach ( $sc_sols as $s ) : ?>
							<option value="<?php echo esc_attr( sanitize_title( $s ) ); ?>"><?php echo esc_html( $s ); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
				<label class="sc-projctrl">
					<span class="sc-projfilters__label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg> <?php esc_html_e( 'Filter by Location', 'soundcreations' ); ?></span>
					<select data-proj-loc>
						<option value="all"><?php esc_html_e( 'All Locations', 'soundcreations' ); ?></option>
						<?php foreach ( $sc_locs as $l ) : ?>
							<option value="<?php echo esc_attr( sanitize_title( $l ) ); ?>"><?php echo esc_html( $l ); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
				<label class="sc-projctrl sc-projctrl--search">
					<span class="sc-projfilters__label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg> <?php esc_html_e( 'Search Projects', 'soundcreations' ); ?></span>
					<input type="search" data-proj-search placeholder="<?php esc_attr_e( 'Search project, venue or solution...', 'soundcreations' ); ?>">
				</label>
			</div>
		</div>

		<div class="sc-projfeat-head">
			<h2><?php esc_html_e( 'Featured Projects', 'soundcreations' ); ?></h2>
			<a class="sc-linkbtn" href="<?php echo esc_url( $sc_archive ); ?>"><?php esc_html_e( 'View All Projects', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>

		<?php if ( count( $sc_items ) > 0 ) : ?>
			<div class="sc-projgrid">
				<?php
				foreach ( $sc_items as $it ) :
					$text = strtolower( $it['title'] . ' ' . $it['loc'] . ' ' . $it['cat'] . ' ' . $it['sol'] . ' ' . $it['sum'] );
					?>
					<article class="sc-projcard" data-card data-category="<?php echo esc_attr( sanitize_title( $it['cat'] ) ); ?>" data-location="<?php echo esc_attr( sanitize_title( $it['loc'] ) ); ?>" data-solution="<?php echo esc_attr( sanitize_title( $it['sol'] ) ); ?>" data-text="<?php echo esc_attr( $text ); ?>">
						<a class="sc-projcard__media" href="<?php echo esc_url( $it['href'] ); ?>" style="background-image:url('<?php echo esc_url( $it['img'] ); ?>');">
							<?php if ( '' !== $it['badge'] ) : ?>
								<span class="sc-projcard__badge"><?php echo esc_html( $it['badge'] ); ?></span>
							<?php endif; ?>
							<?php if ( '' !== $it['loc'] ) : ?>
								<span class="sc-projcard__loc"><?php echo $sc_pinicon; ?> <?php echo esc_html( $it['loc'] ); ?></span>
							<?php endif; ?>
						</a>
						<div class="sc-projcard__body">
							<h3 class="sc-projcard__title"><?php echo esc_html( $it['title'] ); ?></h3>
							<?php if ( '' !== $it['sum'] ) : ?>
								<p class="sc-projcard__desc"><?php echo esc_html( $it['sum'] ); ?></p>
							<?php endif; ?>
							<a class="sc-projcard__link" href="<?php echo esc_url( $it['href'] ); ?>"><?php esc_html_e( 'View Project', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
			<p class="sc-projempty" data-proj-empty hidden><?php esc_html_e( 'No projects match your filters.', 'soundcreations' ); ?></p>
		<?php else : ?>
			<div class="sc-empty"><?php esc_html_e( 'No projects published yet. In wp-admin, open Sound Creations -> Sample Catalog to add starter items.', 'soundcreations' ); ?></div>
		<?php endif; ?>
	</div>
</section>

<?php
$sc_stat_icons = array(
	'<path d="M3 21h18"/><path d="M6 21V7l6-4 6 4v14"/><path d="M9 9h.01"/><path d="M15 9h.01"/><path d="M9 13h.01"/><path d="M15 13h.01"/><path d="M9 17h.01"/><path d="M15 17h.01"/>',
	'<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
	'<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
	'<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><circle cx="12" cy="16" r="2.4"/>',
);
$sc_stats  = sc_split_lines( sc_setting( 'proj_stats' ), 3 );
$sc_stat_n = count( $sc_stat_icons );
?>
<section class="sc-section">
	<div class="sc-container">
		<div class="sc-projstats">
			<?php foreach ( $sc_stats as $si => $st ) : $sc_ic = ( $si < $sc_stat_n ) ? $sc_stat_icons[ $si ] : $sc_stat_icons[ $sc_stat_n - 1 ]; ?>
				<div class="sc-projstat">
					<span class="sc-projstat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $sc_ic; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG. ?></svg></span>
					<div class="sc-projstat__text">
						<strong><?php echo esc_html( $st[0] ); ?></strong>
						<span class="sc-projstat__label"><?php echo esc_html( $st[1] ); ?></span>
						<span class="sc-projstat__sub"><?php echo esc_html( $st[2] ); ?></span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( $sc_cta_img ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'projects_cta_title', 'Have a project in mind?' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 1.5rem;"><?php echo esc_html( sc_setting( 'projects_cta_text', 'Our team of experts is ready to help you design and deliver the right solution.' ) ); ?></p>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_consult ); ?>"><?php esc_html_e( 'Request a Consultation', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
