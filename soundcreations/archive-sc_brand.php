<?php
/**
 * Brand archive - owns /brands/ (sc_brand has_archive; /products/ 301-redirects here).
 * Faithful .sc-proto port of the prototype Products route: page hero +
 * "Our brands" grid of brand cards + red CTA. Cards are data-driven from
 * published sc_brand posts (name, tagline, logo, link) with a prototype-matching
 * fallback list. Hero/heading/CTA copy is editable in Sound Creations -> Settings.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_brd = SC_THEME_URI . '/assets/img/brands';
?>

<div class="sc-proto">

<?php
echo sc_proto_pagehero( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party markup.
	array(
		'eyebrow' => sc_setting( 'products_eyebrow', 'Consult - Design - Distribute - Integrate - Support' ),
		'title'   => sc_setting( 'products_hero_title', 'Global technology. Local expertise.' ),
		'desc'    => sc_setting( 'products_hero_lead', 'Leading professional brands, genuine products and regional technical support - all through one trusted partner.' ),
		'img'     => $sc_brd . '/brands-hero.jpg',
	)
);
?>

<section class="section">
	<div class="container">
		<div class="kicker"><?php echo esc_html( sc_setting( 'brands_grid_eyebrow', 'Our brands' ) ); ?></div>
		<h2><?php echo esc_html( sc_setting( 'brands_grid_heading', 'World-class brands, supported locally.' ) ); ?></h2>
		<p class="lead"><?php echo esc_html( sc_setting( 'brands_grid_lead', 'We work with leading manufacturers to give clients access to trusted professional technology with local specification, supply, installation and after-sales support.' ) ); ?></p>
		<div class="grid3">
			<?php
			$sc_fallback = array( 'dB Technologies', 'FANE', 'Shure', 'Midas', 'Behringer', 'Rockfon', 'Barrisol', 'Sommer Cable', 'Bose Professional', 'AID', 'Asona', 'Allen & Heath' );
			$sc_q = new WP_Query( array( 'post_type' => 'sc_brand', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'no_found_rows' => true ) );
			if ( $sc_q->have_posts() ) :
				while ( $sc_q->have_posts() ) :
					$sc_q->the_post();
					$sc_id   = get_the_ID();
					$sc_name = get_the_title();
					$sc_desc = (string) get_post_meta( $sc_id, '_sc_tagline', true );
					if ( '' === $sc_desc ) {
						$sc_desc = wp_trim_words( wp_strip_all_tags( get_the_content() ), 20 );
					}
					if ( '' === $sc_desc ) {
						$sc_desc = 'Professional technology for demanding audio, visual, acoustic and integration applications.';
					}
					$sc_logo     = (string) get_post_meta( $sc_id, '_sc_logo', true );
					$sc_rel      = 'assets/img/brands/logos/' . $sc_logo . '.png';
					$sc_logo_url = ( strlen( $sc_logo ) && file_exists( get_theme_file_path( $sc_rel ) ) ) ? get_theme_file_uri( $sc_rel ) : '';
					$sc_slug     = get_post_field( 'post_name', $sc_id );
					$sc_href     = ( 'fane' === $sc_slug ) ? home_url( '/fane/' ) : get_permalink( $sc_id );
					?>
					<div class="card product"><div class="brandpill" style="width:100%;height:70px"><?php if ( strlen( $sc_logo_url ) ) : ?><img src="<?php echo esc_url( $sc_logo_url ); ?>" alt="<?php echo esc_attr( $sc_name ); ?> logo" style="max-height:44px;max-width:80%;object-fit:contain" loading="lazy" decoding="async"><?php else : ?><?php echo esc_html( $sc_name ); ?><?php endif; ?></div><h3 style="margin:18px 0 7px"><?php echo esc_html( $sc_name ); ?></h3><p><?php echo esc_html( $sc_desc ); ?></p><a class="link" href="<?php echo esc_url( $sc_href ); ?>"><?php esc_html_e( 'Enquire about', 'soundcreations' ); ?> <?php echo esc_html( $sc_name ); ?> &rarr;</a></div>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				$sc_contact = home_url( '/contact/' );
				foreach ( $sc_fallback as $sc_b ) :
					?>
					<div class="card product"><div class="brandpill" style="width:100%;height:70px"><?php echo esc_html( $sc_b ); ?></div><h3 style="margin:18px 0 7px"><?php echo esc_html( $sc_b ); ?></h3><p>Professional technology for demanding audio, visual, acoustic and integration applications.</p><a class="link" href="<?php echo esc_url( $sc_contact ); ?>"><?php esc_html_e( 'Enquire about', 'soundcreations' ); ?> <?php echo esc_html( $sc_b ); ?> &rarr;</a></div>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<?php
echo sc_proto_cta( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party markup.
	array(
		'eyebrow' => 'Partner with us',
		'title'   => sc_setting( 'brands_cta_title', 'Become a partner' ),
		'text'    => sc_setting( 'brands_cta_text', 'Work with Sound Creations to bring your professional products to the East Africa and Middle East markets.' ),
		'label'   => 'Partner With Us',
		'img'     => $sc_brd . '/partner.jpg',
	)
);
?>

</div>

<?php
get_footer();
