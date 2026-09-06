<?php
/**
 * Single project - case study. Faithful .sc-proto port of the prototype
 * projectDetail: page hero + detail (image + narrative) + sticky scope card +
 * delivery timeline + red CTA. All content stays editable in the Project
 * Details box; only generic fallbacks are hardcoded.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

while ( have_posts() ) :
	the_post();
	$sc_id        = get_the_ID();
	$sc_loc       = (string) sc_field( 'location' );
	$sc_year      = (string) sc_field( 'year' );
	$sc_summary   = (string) sc_field( 'summary' );
	$sc_scope_raw = (string) sc_field( 'scope' );
	$sc_brands    = (string) sc_field( 'brands_used' );
	$sc_btags     = sc_term_tags( $sc_id, 'sc_brand_tax' );
	$sc_cat       = (string) sc_primary_term_name( $sc_id, 'sc_industry', '' );
	if ( strlen( $sc_cat ) === 0 ) {
		$sc_cat = (string) get_post_meta( $sc_id, '_sc_category', true );
	}
	$sc_sol  = (string) get_post_meta( $sc_id, '_sc_solution', true );
	$sc_tag  = strlen( $sc_cat ) ? $sc_cat : ( strlen( $sc_sol ) ? $sc_sol : 'Project' );
	$sc_gallery = array_filter( array_map( 'absint', explode( ',', (string) sc_field( 'gallery' ) ) ) );
	$sc_body    = get_the_content();
	$sc_hasbody = strlen( trim( wp_strip_all_tags( $sc_body ) ) ) > 0;

	if ( has_post_thumbnail() ) {
		$sc_img = get_the_post_thumbnail_url( $sc_id, 'large' );
	} else {
		$sc_imgk = (string) get_post_meta( $sc_id, '_sc_image', true );
		$sc_rel  = 'assets/img/projects/' . $sc_imgk . '.jpg';
		$sc_img  = ( strlen( $sc_imgk ) && file_exists( get_theme_file_path( $sc_rel ) ) ) ? get_theme_file_uri( $sc_rel ) : ( SC_THEME_URI . '/assets/img/projects-hero.jpg' );
	}

	$sc_scope_lines = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $sc_scope_raw ) ) ) );
	if ( count( $sc_scope_lines ) === 0 ) {
		$sc_scope_lines = array( 'System design & specification', 'Equipment supply', 'Installation & commissioning', 'Calibration & technical support' );
	}

	$sc_sub_parts = array();
	if ( strlen( $sc_loc ) ) {
		$sc_sub_parts[] = $sc_loc;
	}
	if ( strlen( $sc_tag ) ) {
		$sc_sub_parts[] = $sc_tag;
	}
	$sc_sub = implode( ' . ', $sc_sub_parts );
	?>

<div class="sc-proto">

<section class="pagehero">
	<div class="container">
		<div><div class="kicker"><?php esc_html_e( 'Project Case Study', 'soundcreations' ); ?></div><h1><?php the_title(); ?></h1></div>
		<?php if ( strlen( $sc_sub ) ) : ?><p><?php echo esc_html( $sc_sub ); ?></p><?php endif; ?>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="detail">
			<div>
				<img class="detailimg" src="<?php echo esc_url( $sc_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="eager" decoding="async">
				<div style="margin-top:28px">
					<div class="kicker"><?php esc_html_e( 'The project', 'soundcreations' ); ?></div>
					<?php if ( strlen( $sc_summary ) ) : ?>
						<h2 style="font-size:34px"><?php echo esc_html( $sc_summary ); ?></h2>
					<?php else : ?>
						<h2 style="font-size:34px"><?php esc_html_e( 'Designing for the space, not just the specification.', 'soundcreations' ); ?></h2>
					<?php endif; ?>
					<?php if ( $sc_hasbody ) : ?>
						<div class="sc-prose" style="margin-top:14px"><?php the_content(); ?></div>
					<?php else : ?>
						<p class="lead"><?php esc_html_e( 'Every project starts with understanding the room, audience, operational requirements and desired experience. The system is then engineered, installed, commissioned and handed over as one complete solution.', 'soundcreations' ); ?></p>
					<?php endif; ?>
				</div>
				<?php if ( count( $sc_gallery ) > 0 ) : ?>
					<div class="grid3" style="margin-top:34px">
						<?php
						foreach ( $sc_gallery as $sc_gid ) :
							$sc_full  = wp_get_attachment_image_url( $sc_gid, 'full' );
							$sc_thumb = wp_get_attachment_image_url( $sc_gid, 'large' );
							if ( $sc_thumb ) :
								?>
								<a class="card" style="padding:0;overflow:hidden" href="<?php echo esc_url( $sc_full ); ?>" target="_blank" rel="noopener"><div style="height:150px;overflow:hidden"><img src="<?php echo esc_url( $sc_thumb ); ?>" alt="" style="width:100%;height:100%;object-fit:cover" loading="lazy" decoding="async"></div></a>
								<?php
							endif;
						endforeach;
						?>
					</div>
				<?php endif; ?>
			</div>
			<div class="card sticky">
				<span class="tag" style="position:static;display:inline-block"><?php echo esc_html( strtoupper( $sc_tag ) ); ?></span>
				<h2 style="font-size:34px;margin-top:18px"><?php the_title(); ?></h2>
				<?php if ( strlen( $sc_loc ) ) : ?><p class="lead"><?php echo esc_html( $sc_loc ); ?><?php if ( strlen( $sc_year ) ) : ?> &middot; <?php echo esc_html( $sc_year ); ?><?php endif; ?></p><?php endif; ?>
				<ul class="checklist">
					<?php foreach ( $sc_scope_lines as $sc_ln ) : ?>
						<li><span class="check">&#10003;</span> <?php echo esc_html( $sc_ln ); ?></li>
					<?php endforeach; ?>
				</ul>
				<?php if ( $sc_btags ) : ?>
					<div style="margin:16px 0 4px"><span class="kicker"><?php esc_html_e( 'Brands used', 'soundcreations' ); ?></span></div>
					<?php echo $sc_btags; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- themed term tags. ?>
				<?php elseif ( strlen( $sc_brands ) ) : ?>
					<p class="lead" style="margin-top:14px"><?php esc_html_e( 'Brands used:', 'soundcreations' ); ?> <?php echo esc_html( $sc_brands ); ?></p>
				<?php endif; ?>
				<a class="btn primary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>" style="margin-top:16px"><?php esc_html_e( 'Discuss a similar project', 'soundcreations' ); ?> &rarr;</a>
			</div>
		</div>

		<div style="margin-top:70px">
			<div class="kicker"><?php esc_html_e( 'How we delivered it', 'soundcreations' ); ?></div>
			<h2><?php esc_html_e( 'From first consultation to final commissioning.', 'soundcreations' ); ?></h2>
			<div class="timeline">
				<?php
				$sc_steps = array(
					array( 'Consultation', 'Understanding the room, audience and goals.' ),
					array( 'Design & Specification', 'Engineering the right system for the space.' ),
					array( 'Supply', 'Genuine equipment from trusted brands.' ),
					array( 'Installation', 'Installed, commissioned and calibrated.' ),
					array( 'Support', 'Training and after-sales technical support.' ),
				);
				foreach ( $sc_steps as $sc_st ) :
					?>
					<div><b><?php echo esc_html( $sc_st[0] ); ?></b><p><?php echo esc_html( $sc_st[1] ); ?></p></div>
					<?php
				endforeach;
				?>
			</div>
		</div>
	</div>
</section>

<?php
echo sc_proto_cta( array() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party markup.
?>

</div>

	<?php
endwhile;
get_footer();
