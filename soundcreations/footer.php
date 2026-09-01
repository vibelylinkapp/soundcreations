<?php
/**
 * Footer template. Four editable columns:
 *   1. About + social   2. Explore   3. Solutions   4. Contact (head office).
 * Every value is editable in wp-admin: Sound Creations -> Settings (Footer section).
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
$sc_explore = sc_split_lines( sc_setting( 'footer_explore' ), 2 );
$sc_fsol    = sc_split_lines( sc_setting( 'footer_solutions' ), 2 );
$sc_addr    = sc_split_lines( sc_setting( 'footer_address' ), 1 );
$sc_hours   = sc_split_lines( sc_setting( 'footer_hours' ), 1 );
$sc_phone   = sc_setting( 'phone' );
$sc_phone_l = sc_setting( 'phone_link' );
$sc_email   = sc_setting( 'email' );
?>
</main>

<footer class="sc-footer">
	<div class="sc-container">
		<div class="sc-footer__grid">

			<div class="sc-foot-about">
				<div class="sc-foot-logo">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="sc-logo" rel="home"><img src="' . esc_url( SC_THEME_URI . '/assets/img/logo-white.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="484" height="180"></a>';
					}
					?>
				</div>
				<p><?php echo esc_html( sc_setting( 'footer_about' ) ); ?></p>
				<div class="sc-foot-soc"><?php sc_all_social(); ?></div>
			</div>

			<div class="sc-foot-col">
				<h2><?php esc_html_e( 'Explore', 'soundcreations' ); ?></h2>
				<ul>
					<?php
					foreach ( $sc_explore as $sc_row ) {
						$sc_lbl = isset( $sc_row[0] ) ? $sc_row[0] : '';
						$sc_url = isset( $sc_row[1] ) ? $sc_row[1] : '';
						if ( '' === $sc_lbl ) {
							continue;
						}
						$sc_href = ( 0 === strpos( $sc_url, 'http' ) ) ? $sc_url : home_url( $sc_url );
						echo '<li><a href="' . esc_url( $sc_href ) . '">' . esc_html( $sc_lbl ) . '</a></li>';
					}
					?>
				</ul>
			</div>

			<div class="sc-foot-col">
				<h2><?php esc_html_e( 'Solutions', 'soundcreations' ); ?></h2>
				<ul>
					<?php
					foreach ( $sc_fsol as $sc_row ) {
						$sc_lbl = isset( $sc_row[0] ) ? $sc_row[0] : '';
						$sc_url = isset( $sc_row[1] ) ? $sc_row[1] : '';
						if ( '' === $sc_lbl ) {
							continue;
						}
						$sc_href = ( 0 === strpos( $sc_url, 'http' ) ) ? $sc_url : home_url( $sc_url );
						echo '<li><a href="' . esc_url( $sc_href ) . '">' . esc_html( $sc_lbl ) . '</a></li>';
					}
					?>
				</ul>
			</div>

			<div class="sc-foot-contact">
				<h2><?php esc_html_e( 'Contact', 'soundcreations' ); ?></h2>
				<address class="sc-foot-addr">
					<?php
					foreach ( $sc_addr as $sc_row ) {
						if ( '' === $sc_row[0] ) {
							continue;
						}
						echo '<span>' . esc_html( $sc_row[0] ) . '</span>';
					}
					?>
				</address>
				<?php if ( $sc_phone ) : ?>
					<a href="tel:<?php echo esc_attr( $sc_phone_l ); ?>"><?php echo esc_html( $sc_phone ); ?></a>
				<?php endif; ?>
				<?php if ( $sc_email ) : ?>
					<a href="mailto:<?php echo esc_attr( $sc_email ); ?>"><?php echo esc_html( $sc_email ); ?></a>
				<?php endif; ?>
				<?php if ( count( $sc_hours ) > 0 ) : ?>
					<div class="sc-foot-hours">
						<span class="sc-foot-hours__label"><?php echo esc_html( sc_setting( 'footer_hours_label', 'Open Hours' ) ); ?></span>
						<ul>
							<?php
							foreach ( $sc_hours as $sc_row ) {
								if ( '' === $sc_row[0] ) {
									continue;
								}
								echo '<li>' . esc_html( $sc_row[0] ) . '</li>';
							}
							?>
						</ul>
					</div>
				<?php endif; ?>
			</div>

		</div>

		<div class="sc-footer__bottom">
			<div>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( sc_setting( 'company_name' ) ); ?>. <?php esc_html_e( 'All rights reserved.', 'soundcreations' ); ?></div>
			<div class="sc-footer__legal">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'soundcreations' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'soundcreations' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/warranty/' ) ); ?>"><?php esc_html_e( 'Warranty', 'soundcreations' ); ?></a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
