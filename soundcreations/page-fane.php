<?php
/**
 * FANE brand hub. Auto-applies to the page with slug "fane".
 * Copy is editable in Sound Creations -> Settings where wired via sc_setting().
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_img  = SC_THEME_URI . '/assets/img/fane';
$sc_sol  = SC_THEME_URI . '/assets/img/solutions';
$sc_proj = SC_THEME_URI . '/assets/img/projects';
$sc_spec = $sc_img . '/dist-network.jpg';

$sc_consult = home_url( '/request-a-consultation/' );
$sc_products_url = sc_setting( 'fane_products_url', home_url( '/products/' ) );
$sc_apps_url = sc_setting( 'fane_apps_url', home_url( '/projects/' ) );
$sc_catalogue = sc_setting( 'fane_catalogue_url', '#' );

$sc_pills = array(
	array( '70+', 'Years of Engineering Heritage', '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>' ),
	array( 'Precision', 'Engineered for performance', '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>' ),
	array( 'Built to Last', 'Reliability in every environment', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>' ),
	array( 'Global Standards', 'Designed & engineered in the UK', '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>' ),
);

$sc_diff = array(
	array( 'Core', 'Engineered for accuracy and clarity' ),
	array( 'Voice Coil', 'High-power handling and efficiency' ),
	array( 'Basket', 'Rigid, lightweight and durable' ),
	array( 'Magnet System', 'High flux, low distortion motor design' ),
	array( 'Complete Driver', 'Engineered as one precision system' ),
);

$sc_timeline = array(
	array( '1954', 'FANE is founded in the UK with a passion for loudspeaker innovation.' ),
	array( '1960s - 70s', 'Growth and expansion of professional audio component technology.' ),
	array( '1980s - 90s', 'FANE becomes a trusted name in professional loudspeaker components.' ),
	array( '2000s', 'Continued innovation and investment in engineering excellence.' ),
	array( 'Today', 'FANE components power systems in the world’s most demanding venues.' ),
);

$sc_apps = array(
	array( 'Live Sound', $sc_proj . '/performance.jpg' ),
	array( 'Installed Audio', $sc_sol . '/audio.jpg' ),
	array( 'Worship', $sc_proj . '/worship.jpg' ),
	array( 'Touring', $sc_img . '/app-touring.jpg' ),
	array( 'Studio & Recording', $sc_sol . '/broadcast.jpg' ),
	array( 'Hospitality', $sc_img . '/app-hospitality.jpg' ),
	array( 'Custom Design', $sc_img . '/app-custom.jpg' ),
);

// name, spec, power label, img, data-app, data-type, data-power(num), data-size
$sc_prod = array(
	array( 'FANE Colossus 18XB', '18" High Power Bass Driver', '1600W AES · 8Ω', $sc_img . '/prod-colossus18xb.jpg', 'live-sound touring', 'bass', '1600', '18' ),
	array( 'FANE Imperium 18XL', '18" High Power Bass Driver', '1200W AES · 8Ω', $sc_img . '/prod-imperium18xl.jpg', 'live-sound touring', 'bass', '1200', '18' ),
	array( 'FANE Sovereign 15-600', '15" Mid Bass Driver', '600W AES · 8Ω', $sc_img . '/prod-sovereign15.jpg', 'installed-audio worship', 'mid-bass', '600', '15' ),
	array( 'FANE Sovereign 12-250TC', '12" Midrange Driver', '250W AES · 8Ω', $sc_img . '/prod-sovereign12.jpg', 'installed-audio studio', 'midrange', '250', '12' ),
	array( 'FANE CD140', '1.4" Compression Driver', '140W AES · 8Ω', $sc_img . '/prod-cd140.jpg', 'live-sound studio', 'compression', '140', '1.4' ),
);

$sc_why = array(
	array( 'Heritage', 'Decades of loudspeaker engineering experience.', '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>' ),
	array( 'Engineering', 'Precision components designed for demanding applications.', '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>' ),
	array( 'Performance', 'Reliable, consistent performance worldwide.', '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' ),
	array( 'Flexibility', 'Solutions from individual drivers to complete loudspeaker systems.', '<path d="M12 2 2 7l10 5 10-5-10-5z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/>' ),
);

$sc_dist = array(
	array( 'Authorised Distribution', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>' ),
	array( 'Technical Expertise', '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>' ),
	array( 'System Integration', '<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/>' ),
	array( 'After-Sales Support', '<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>' ),
);

$sc_arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
?>

<section class="sc-fane-hero">
	<div class="sc-container sc-fane-hero__grid">
		<div class="sc-fane-hero__left">
			<div class="sc-fane-mark"><span class="sc-fane-mark__bar" aria-hidden="true"></span>FANE</div>
			<p class="sc-eyebrow sc-fane-hero__eyebrow"><?php echo esc_html( sc_setting( 'fane_eyebrow', 'Engineered in the UK. Trusted worldwide.' ) ); ?></p>
			<h1 class="sc-fane-hero__title"><?php echo esc_html( sc_setting( 'fane_title', 'Engineering sound since 1954.' ) ); ?></h1>
			<p class="sc-lead sc-fane-hero__lead"><?php echo esc_html( sc_setting( 'fane_lead', 'Precision-engineered loudspeaker components built for demanding professional applications, trusted by sound professionals around the world.' ) ); ?></p>
			<div class="sc-fane-hero__cta">
				<a class="sc-btn sc-btn--primary" href="#fane-products"><?php esc_html_e( 'Explore FANE Products', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
				<a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( $sc_consult ); ?>"><?php esc_html_e( 'Talk to a FANE Specialist', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
			</div>
		</div>
		<div class="sc-fane-hero__media">
			<img src="<?php echo esc_url( $sc_img . '/fane-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'FANE professional loudspeaker driver', 'soundcreations' ); ?>">
		</div>
	</div>
	<div class="sc-container">
		<div class="sc-fane-stats">
			<?php foreach ( $sc_pills as $p ) : ?>
				<div class="sc-fane-stat">
					<span class="sc-fane-stat__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $p[2]; ?></svg></span>
					<div class="sc-fane-stat__text"><strong><?php echo esc_html( $p[0] ); ?></strong><span><?php echo esc_html( $p[1] ); ?></span></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section" id="fane-difference">
	<div class="sc-container sc-fane-diff">
		<div class="sc-fane-diff__intro">
			<p class="sc-eyebrow"><?php esc_html_e( 'The FANE difference', 'soundcreations' ); ?></p>
			<h2><?php echo esc_html( sc_setting( 'fane_diff_title', 'Built from the inside out.' ) ); ?></h2>
			<p class="sc-support-sub"><?php echo esc_html( sc_setting( 'fane_diff_body', 'Every FANE component is designed and engineered to work in perfect harmony - delivering the performance, reliability and consistency professionals depend on.' ) ); ?></p>
			<a class="sc-btn sc-btn--ghost" href="#fane-products"><?php esc_html_e( 'Discover Our Technology', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
		</div>
		<div class="sc-fane-diff__media">
			<img src="<?php echo esc_url( $sc_img . '/fane-exploded.jpg' ); ?>" alt="<?php esc_attr_e( 'Exploded view of a FANE loudspeaker driver', 'soundcreations' ); ?>" loading="lazy">
			<div class="sc-fane-diff__labels">
				<?php foreach ( $sc_diff as $d ) : ?>
					<div class="sc-fane-diff__label"><span class="sc-fane-diff__dot" aria-hidden="true"></span><div><strong><?php echo esc_html( $d[0] ); ?></strong><span><?php echo esc_html( $d[1] ); ?></span></div></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="sc-section sc-fane-alt" id="fane-heritage">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php esc_html_e( 'Our heritage', 'soundcreations' ); ?></p>
		<h2 class="sc-fane-heritage__title"><?php echo esc_html( sc_setting( 'fane_heritage_title', '70+ years of loudspeaker engineering.' ) ); ?></h2>
		<div class="sc-fane-heritage">
			<div class="sc-timeline">
				<?php foreach ( $sc_timeline as $t ) : ?>
					<div class="sc-tl-item">
						<span class="sc-tl-item__dot" aria-hidden="true"></span>
						<span class="sc-tl-item__year"><?php echo esc_html( $t[0] ); ?></span>
						<span class="sc-tl-item__text"><?php echo esc_html( $t[1] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="sc-fane-heritage__img">
				<img src="<?php echo esc_url( $sc_img . '/fane-building.jpg' ); ?>" alt="<?php esc_attr_e( 'FANE manufacturing building', 'soundcreations' ); ?>" loading="lazy">
			</div>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-res-head">
			<div>
				<p class="sc-eyebrow"><?php esc_html_e( 'Made for the application', 'soundcreations' ); ?></p>
				<h2 style="margin:.15rem 0 0;"><?php echo esc_html( sc_setting( 'fane_apps_title', 'One technology. Many possibilities.' ) ); ?></h2>
			</div>
			<a class="sc-linkbtn" href="<?php echo esc_url( $sc_apps_url ); ?>"><?php esc_html_e( 'View All Applications', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
		<div class="sc-fane-apps">
			<?php foreach ( $sc_apps as $a ) : ?>
				<a class="sc-fane-app" href="<?php echo esc_url( $sc_apps_url ); ?>" style="background-image:url('<?php echo esc_url( $a[1] ); ?>');">
					<span class="sc-fane-app__scrim" aria-hidden="true"></span>
					<span class="sc-fane-app__label"><?php echo esc_html( $a[0] ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-section sc-fane-alt" id="fane-products">
	<div class="sc-container">
		<div class="sc-res-head">
			<div>
				<p class="sc-eyebrow"><?php esc_html_e( 'Product explorer', 'soundcreations' ); ?></p>
				<h2 style="margin:.15rem 0 0;"><?php echo esc_html( sc_setting( 'fane_products_title', 'Find the right FANE component.' ) ); ?></h2>
			</div>
			<a class="sc-linkbtn" href="<?php echo esc_url( $sc_products_url ); ?>"><?php esc_html_e( 'View All Products', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</div>
		<div class="sc-prod-filters" data-sc-prodfilter>
			<label class="sc-prod-filter"><span>Application</span><select data-f="app"><option value="all">All Applications</option><option value="live-sound">Live Sound</option><option value="installed-audio">Installed Audio</option><option value="worship">Worship</option><option value="touring">Touring</option><option value="studio">Studio &amp; Recording</option></select></label>
			<label class="sc-prod-filter"><span>Driver Type</span><select data-f="type"><option value="all">All Types</option><option value="bass">Bass Driver</option><option value="mid-bass">Mid Bass</option><option value="midrange">Midrange</option><option value="compression">Compression Driver</option></select></label>
			<label class="sc-prod-filter"><span>Power Handling</span><select data-f="power"><option value="all">All Power</option><option value="0-250">Up to 250W</option><option value="250-600">250 - 600W</option><option value="600-99999">600W and above</option></select></label>
			<label class="sc-prod-filter"><span>Size</span><select data-f="size"><option value="all">All Sizes</option><option value="1.4">1.4"</option><option value="12">12"</option><option value="15">15"</option><option value="18">18"</option></select></label>
			<label class="sc-prod-filter"><span>Sort By</span><select data-f="sort"><option value="featured">Featured</option><option value="power">Power</option><option value="size">Size</option><option value="name">Name</option></select></label>
		</div>
		<div class="sc-prod-carousel">
			<button type="button" class="sc-prod-nav sc-prod-nav--prev" data-sc-scroll="prev" aria-label="Scroll left"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg></button>
			<div class="sc-prod-track" data-sc-scroller>
				<?php foreach ( $sc_prod as $pr ) : ?>
					<div class="sc-prod-card" data-app="<?php echo esc_attr( $pr[4] ); ?>" data-type="<?php echo esc_attr( $pr[5] ); ?>" data-power="<?php echo esc_attr( $pr[6] ); ?>" data-size="<?php echo esc_attr( $pr[7] ); ?>">
						<div class="sc-prod-card__media"><img src="<?php echo esc_url( $pr[3] ); ?>" alt="<?php echo esc_attr( $pr[0] ); ?>" loading="lazy"></div>
						<div class="sc-prod-card__body">
							<h3 class="sc-prod-card__name"><?php echo esc_html( $pr[0] ); ?></h3>
							<p class="sc-prod-card__spec"><?php echo esc_html( $pr[1] ); ?></p>
							<p class="sc-prod-card__power"><?php echo esc_html( $pr[2] ); ?></p>
							<a class="sc-prod-card__link" href="<?php echo esc_url( $sc_products_url ); ?>"><?php esc_html_e( 'View Product', 'soundcreations' ); ?> <span aria-hidden="true">&rarr;</span></a>
						</div>
					</div>
				<?php endforeach; ?>
				<div class="sc-prod-empty" data-sc-noresults hidden><?php esc_html_e( 'No products match the selected filters.', 'soundcreations' ); ?></div>
			</div>
			<button type="button" class="sc-prod-nav sc-prod-nav--next" data-sc-scroll="next" aria-label="Scroll right"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></button>
		</div>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<p class="sc-eyebrow"><?php esc_html_e( 'Why professionals choose FANE', 'soundcreations' ); ?></p>
		<div class="sc-fane-why">
			<?php foreach ( $sc_why as $w ) : ?>
				<div class="sc-fane-why__item">
					<span class="sc-fane-why__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $w[2]; ?></svg></span>
					<h3><?php echo esc_html( $w[0] ); ?></h3>
					<p><?php echo esc_html( $w[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-fane-dist">
	<div class="sc-fane-dist__media" style="background-image:url('<?php echo esc_url( $sc_spec ); ?>');"><span class="sc-fane-dist__scrim" aria-hidden="true"></span></div>
	<div class="sc-fane-dist__panel">
		<p class="sc-eyebrow"><?php esc_html_e( 'FANE in East Africa', 'soundcreations' ); ?></p>
		<h2><?php echo esc_html( sc_setting( 'fane_dist_title', 'FANE. Delivered by Sound Creations.' ) ); ?></h2>
		<p class="sc-support-sub"><?php echo esc_html( sc_setting( 'fane_dist_body', 'As the exclusive FANE distributor across East Africa, we provide more than just components - we deliver technical expertise, system design, integration and long-term support.' ) ); ?></p>
		<div class="sc-fane-dist__feats">
			<?php foreach ( $sc_dist as $d ) : ?>
				<div class="sc-fane-dist__feat"><span class="sc-fane-dist__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $d[1]; ?></svg></span><span><?php echo esc_html( $d[0] ); ?></span></div>
			<?php endforeach; ?>
		</div>
		<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_consult ); ?>"><?php esc_html_e( 'Talk to a FANE Specialist', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
	</div>
</section>

<section class="sc-section">
	<div class="sc-container">
		<div class="sc-cta-band sc-cta-band--photo" style="background-image:url('<?php echo esc_url( $sc_img . '/fane-hero.jpg' ); ?>');">
			<div class="sc-cta-band__inner">
				<h2><?php echo esc_html( sc_setting( 'fane_cta_title', 'Become a FANE distributor.' ) ); ?></h2>
				<p class="sc-lead" style="margin:0 0 1.5rem;"><?php echo esc_html( sc_setting( 'fane_cta_text', 'We’re building the FANE dealer network across Kenya, Rwanda, DR Congo and the UAE. Sound Creations focuses on large, project-based installations, so we partner with distributors who can stock and sell FANE components at the local level.' ) ); ?></p>
				<div class="sc-fane-cta__btns">
					<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/become-a-dealer/' ) ); ?>"><?php esc_html_e( 'Become a Distributor', 'soundcreations' ); ?> <?php echo $sc_arrow; ?></a>
					<a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( $sc_catalogue ); ?>"><?php esc_html_e( 'Download Catalogue', 'soundcreations' ); ?> <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
