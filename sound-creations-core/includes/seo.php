<?php
/**
 * SEO and structured data: meta description, canonical, Open Graph, Twitter, JSON-LD.
 * Lives in the plugin so it survives theme changes.
 *
 * @package SoundCreationsCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Read a business setting, using the theme helper when present. */
function sc_core_get( $key, $default = '' ) {
	if ( function_exists( 'sc_setting' ) ) {
		return sc_setting( $key, $default );
	}
	$o = get_option( 'soundcreations_settings', array() );
	if ( is_array( $o ) && ! empty( $o[ $key ] ) ) {
		return $o[ $key ];
	}
	return $default;
}

function sc_seo_description() {
	if ( is_singular() ) {
		$id = get_queried_object_id();
		$d  = get_post_meta( $id, '_sc_seo_desc', true );
		if ( $d ) {
			return $d;
		}
		$sum = get_post_meta( $id, '_sc_summary', true );
		if ( $sum ) {
			return $sum;
		}
		$ex = get_the_excerpt( $id );
		if ( $ex ) {
			return wp_strip_all_tags( $ex );
		}
	}
	if ( ( is_tax() || is_category() || is_tag() ) ) {
		$t = term_description();
		if ( $t ) {
			return wp_strip_all_tags( $t );
		}
	}
	return sc_core_get( 'tagline', get_bloginfo( 'description' ) );
}

function sc_seo_image() {
	if ( is_singular() && has_post_thumbnail( get_queried_object_id() ) ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'large' );
		if ( $src ) {
			return $src[0];
		}
	}
	$icon = get_site_icon_url( 512 );
	return $icon ? $icon : '';
}

function sc_seo_canonical() {
	if ( is_singular() ) {
		return get_permalink();
	}
	if ( is_post_type_archive() ) {
		return get_post_type_archive_link( get_query_var( 'post_type' ) );
	}
	if ( is_tax() || is_category() || is_tag() ) {
		$term = get_queried_object();
		$link = $term ? get_term_link( $term ) : '';
		return is_wp_error( $link ) ? '' : $link;
	}
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	return '';
}

add_action( 'wp_head', 'sc_seo_head', 1 );
function sc_seo_head() {
	if ( is_admin() ) {
		return;
	}
	$desc  = sc_seo_description();
	$img   = sc_seo_image();
	$canon = sc_seo_canonical();
	$title = wp_get_document_title();
	$type  = ( is_singular() && ! is_front_page() ) ? 'article' : 'website';

	echo "\n<!-- Sound Creations SEO -->\n";
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $canon && ! is_singular() ) {
		echo '<link rel="canonical" href="' . esc_url( $canon ) . '">' . "\n";
	}
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $canon ) {
		echo '<meta property="og:url" content="' . esc_url( $canon ) . '">' . "\n";
	}
	if ( $img ) {
		echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
	}
	echo '<meta name="twitter:card" content="' . ( $img ? 'summary_large_image' : 'summary' ) . '">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $img ) {
		echo '<meta name="twitter:image" content="' . esc_url( $img ) . '">' . "\n";
	}
	sc_seo_jsonld();
}

function sc_seo_jsonld() {
	$org_id  = home_url( '/#organization' );
	$site_id = home_url( '/#website' );

	// Organization entity (site-wide, stable @id).
	$org = array(
		'@type' => 'Organization',
		'@id'   => $org_id,
		'name'  => get_bloginfo( 'name' ),
		'url'   => home_url( '/' ),
	);
	$desc = sc_core_get( 'tagline', get_bloginfo( 'description' ) );
	if ( $desc ) {
		$org['description'] = $desc;
	}
	$logo = get_site_icon_url( 512 );
	if ( $logo ) {
		$org['logo']  = $logo;
		$org['image'] = $logo;
	}
	$phone = sc_core_get( 'phone' );
	if ( $phone ) {
		$org['telephone'] = $phone;
	}
	$email = sc_core_get( 'email' );
	if ( $email ) {
		$org['email'] = $email;
	}
	$org['areaServed'] = array( 'Kenya', 'Rwanda', 'DRC Congo', 'United Arab Emirates', 'East Africa' );
	$org['knowsAbout'] = array(
		'professional audio', 'sound reinforcement', 'PA systems', 'loudspeaker system design',
		'sound and acoustic integration', 'acoustics', 'acoustic treatment', 'conferencing systems',
		'systems integration', 'installation', 'calibration', 'commissioning',
	);
	$same = array();
	foreach ( array( 'facebook', 'x', 'linkedin', 'youtube', 'instagram', 'google_business' ) as $s ) {
		$u = sc_core_get( $s );
		if ( $u ) {
			$same[] = $u;
		}
	}
	if ( $same ) {
		$org['sameAs'] = array_values( $same );
	}

	// WebSite entity.
	$website = array(
		'@type'     => 'WebSite',
		'@id'       => $site_id,
		'url'       => home_url( '/' ),
		'name'      => get_bloginfo( 'name' ),
		'publisher' => array( '@id' => $org_id ),
	);

	$graph = array( $org, $website );

	// LocalBusiness only on the contact / Nairobi location page, linked to the Organization.
	$is_local = is_page( array( 'contact', 'nairobi' ) );
	$is_local = apply_filters( 'sc_seo_is_local_page', $is_local );
	if ( $is_local ) {
		$local = array(
			'@type'              => 'LocalBusiness',
			'@id'                => home_url( '/#nairobi' ),
			'name'               => get_bloginfo( 'name' ) . ' - Nairobi',
			'parentOrganization' => array( '@id' => $org_id ),
			'url'                => home_url( '/' ),
		);
		if ( $phone ) {
			$local['telephone'] = $phone;
		}
		if ( $logo ) {
			$local['image'] = $logo;
		}
		$addr = sc_core_get( 'address' );
		if ( $addr ) {
			$local['address'] = array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $addr,
				'addressLocality' => 'Nairobi',
				'addressRegion'   => 'Nairobi',
				'addressCountry'  => 'KE',
			);
		}
		$lat = sc_core_get( 'geo_lat' );
		$lng = sc_core_get( 'geo_lng' );
		if ( $lat && $lng ) {
			$local['geo'] = array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => $lat,
				'longitude' => $lng,
			);
		}
		$local['openingHoursSpecification'] = array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
				'opens'     => '09:00',
				'closes'    => '17:30',
			),
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => 'Saturday',
				'opens'     => '09:00',
				'closes'    => '13:30',
			),
		);
		$local['areaServed'] = array( 'Nairobi', 'Kenya', 'East Africa' );
		$graph[] = $local;
	}

	echo "\n" . '<script type="application/ld+json">' . wp_json_encode(
		array(
			'@context' => 'https://schema.org',
			'@graph'   => $graph,
		)
	) . '</script>' . "\n";

	// Service node on solution pages, provided by the Organization.
	if ( is_singular( 'sc_solution' ) ) {
		$sid = get_queried_object_id();
		$svc = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => get_the_title( $sid ),
			'serviceType' => get_the_title( $sid ),
			'provider'    => array( '@id' => $org_id ),
			'areaServed'  => array( 'Kenya', 'East Africa' ),
			'url'         => get_permalink( $sid ),
		);
		$sd = wp_strip_all_tags( get_the_excerpt( $sid ) );
		if ( $sd ) {
			$svc['description'] = $sd;
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $svc ) . '</script>' . "\n";
	}

	// Product node on product pages (enquiry-only: no price/offer/GTIN/rating).
	if ( is_singular( 'sc_product' ) ) {
		$id   = get_queried_object_id();
		$prod = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Product',
			'name'        => get_the_title( $id ),
			'description' => wp_strip_all_tags( get_the_excerpt( $id ) ),
			'url'         => get_permalink( $id ),
		);
		$brand = get_post_meta( $id, '_sc_brand_name', true );
		if ( $brand ) {
			$prod['brand'] = array( '@type' => 'Brand', 'name' => $brand );
		}
		$model = get_post_meta( $id, '_sc_model', true );
		if ( $model ) {
			$prod['sku'] = $model;
			$prod['mpn'] = $model;
		}
		if ( has_post_thumbnail( $id ) ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
			if ( $src ) {
				$prod['image'] = $src[0];
			}
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $prod ) . '</script>' . "\n";
	}

	// Project node (real-world evidence): CreativeWork linked to Organization + place + brands.
	if ( is_singular( 'sc_project' ) ) {
		$id   = get_queried_object_id();
		$proj = array(
			'@context' => 'https://schema.org',
			'@type'    => 'CreativeWork',
			'name'     => get_the_title( $id ),
			'url'      => get_permalink( $id ),
			'creator'  => array( '@id' => $org_id ),
		);
		$pd = wp_strip_all_tags( get_the_excerpt( $id ) );
		if ( $pd ) {
			$proj['description'] = $pd;
		}
		if ( has_post_thumbnail( $id ) ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
			if ( $src ) {
				$proj['image'] = $src[0];
			}
		}
		$locs = get_the_terms( $id, 'sc_location' );
		if ( $locs && ( is_wp_error( $locs ) === false ) ) {
			$first = reset( $locs );
			$proj['contentLocation'] = array( '@type' => 'Place', 'name' => $first->name );
		}
		$brands = get_the_terms( $id, 'sc_brand_tax' );
		if ( $brands && ( is_wp_error( $brands ) === false ) ) {
			$mentions = array();
			foreach ( $brands as $b ) {
				$mentions[] = array( '@type' => 'Brand', 'name' => $b->name );
			}
			$proj['mentions'] = $mentions;
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $proj ) . '</script>' . "\n";
	}

	// Brand node.
	if ( is_singular( 'sc_brand' ) ) {
		$id  = get_queried_object_id();
		$brd = array(
			'@context' => 'https://schema.org',
			'@type'    => 'Brand',
			'name'     => get_the_title( $id ),
			'url'      => get_permalink( $id ),
		);
		$bsite = get_post_meta( $id, '_sc_brand_url', true );
		if ( $bsite ) {
			$brd['sameAs'] = $bsite;
		}
		if ( has_post_thumbnail( $id ) ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
			if ( $src ) {
				$brd['logo'] = $src[0];
			}
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $brd ) . '</script>' . "\n";
	}

	// Article node on resources / insights.
	if ( is_singular( array( 'sc_resource', 'post' ) ) ) {
		$id  = get_queried_object_id();
		$art = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'Article',
			'headline'         => get_the_title( $id ),
			'url'              => get_permalink( $id ),
			'datePublished'    => get_the_date( 'c', $id ),
			'dateModified'     => get_the_modified_date( 'c', $id ),
			'publisher'        => array( '@id' => $org_id ),
			'mainEntityOfPage' => get_permalink( $id ),
		);
		if ( has_post_thumbnail( $id ) ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
			if ( $src ) {
				$art['image'] = $src[0];
			}
		}
		$author = get_post_meta( $id, '_sc_author_name', true );
		if ( $author ) {
			$art['author'] = array( '@type' => 'Person', 'name' => $author );
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $art ) . '</script>' . "\n";
	}

	// CollectionPage on CPT archives.
	if ( is_post_type_archive( array( 'sc_solution', 'sc_product', 'sc_project', 'sc_brand', 'sc_case_study', 'sc_resource' ) ) ) {
		$coll = array(
			'@context' => 'https://schema.org',
			'@type'    => 'CollectionPage',
			'name'     => post_type_archive_title( '', false ),
			'url'      => get_post_type_archive_link( get_query_var( 'post_type' ) ),
			'isPartOf' => array( '@id' => $site_id ),
			'about'    => array( '@id' => $org_id ),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $coll ) . '</script>' . "\n";
	}

	// Breadcrumbs.
	if ( is_singular() && ( is_front_page() === false ) ) {
		$crumbs = array( array( 'name' => get_bloginfo( 'name' ), 'item' => home_url( '/' ) ) );
		$pt     = get_post_type();
		$pto    = get_post_type_object( $pt );
		if ( $pto && empty( $pto->has_archive ) === false ) {
			$crumbs[] = array( 'name' => $pto->labels->name, 'item' => get_post_type_archive_link( $pt ) );
		}
		$crumbs[] = array( 'name' => get_the_title(), 'item' => get_permalink() );
		$items    = array();
		foreach ( $crumbs as $ci => $cb ) {
			$items[] = array( '@type' => 'ListItem', 'position' => $ci + 1, 'name' => $cb['name'], 'item' => $cb['item'] );
		}
		echo '<script type="application/ld+json">' . wp_json_encode(
			array(
				'@context'        => 'https://schema.org',
				'@type'           => 'BreadcrumbList',
				'itemListElement' => $items,
			)
		) . '</script>' . "\n";
	}
}

// Per-post SEO fields.
add_action(
	'add_meta_boxes',
	function () {
		foreach ( array( 'page', 'post', 'sc_product', 'sc_brand', 'sc_project', 'sc_solution', 'sc_case_study', 'sc_resource' ) as $pt ) {
			add_meta_box( 'sc_seo', 'SEO', 'sc_seo_meta_box', $pt, 'normal', 'default' );
		}
	}
);

function sc_seo_meta_box( $post ) {
	wp_nonce_field( 'sc_seo_save', 'sc_seo_nonce' );
	$t = get_post_meta( $post->ID, '_sc_seo_title', true );
	$d = get_post_meta( $post->ID, '_sc_seo_desc', true );
	echo '<p><label style="font-weight:600;display:block;margin-bottom:.25rem;">SEO title (optional)</label>';
	echo '<input type="text" id="sc_seo_title" name="sc_seo_title" value="' . esc_attr( $t ) . '" style="width:100%;" maxlength="70"></p>';
	echo '<p><label style="font-weight:600;display:block;margin-bottom:.25rem;">Meta description (optional)</label>';
	echo '<textarea id="sc_seo_desc" name="sc_seo_desc" rows="3" style="width:100%;" maxlength="200">' . esc_textarea( $d ) . '</textarea>';
	echo '<span class="description">Around 150-160 characters. Falls back to the summary or excerpt when blank.</span></p>';
	$sc_seo_host = (string) wp_parse_url( home_url(), PHP_URL_HOST );
	echo '<div class="sc-seo-preview" hidden'
		. ' data-fallback-title="' . esc_attr( get_the_title( $post ) ) . '"'
		. ' data-fallback-desc="' . esc_attr( sc_core_get( 'tagline', get_bloginfo( 'description' ) ) ) . '"'
		. ' data-site="' . esc_attr( get_bloginfo( 'name' ) ) . '"'
		. ' data-url="' . esc_url( get_permalink( $post ) ) . '"'
		. ' data-host="' . esc_attr( $sc_seo_host ) . '"></div>';
	echo <<<'SCSEO'
<div class="sc-seo-fx">
  <div class="sc-seo-counts">
    <span>Title <b data-c-title>0</b> / 60</span>
    <span>Description <b data-c-desc>0</b> / 160</span>
  </div>
  <div class="sc-seo-help">These override the automatic title and description for this page in Google and social shares. Leave blank to use the page defaults shown below.</div>
  <div class="sc-seo-plabel">Google result preview</div>
  <div class="sc-seo-google">
    <div class="sc-seo-google__url" data-g-url></div>
    <div class="sc-seo-google__title" data-g-title></div>
    <div class="sc-seo-google__desc" data-g-desc></div>
  </div>
  <div class="sc-seo-plabel">Social share preview</div>
  <div class="sc-seo-social">
    <div class="sc-seo-social__meta">
      <div class="sc-seo-social__host" data-s-host></div>
      <div class="sc-seo-social__title" data-s-title></div>
      <div class="sc-seo-social__desc" data-s-desc></div>
    </div>
  </div>
</div>
<style>
.sc-seo-fx { margin-top: 14px; }
.sc-seo-counts { display: flex; gap: 18px; font-size: 12px; color: #555; margin-bottom: 10px; }
.sc-seo-counts b { color: #1a1a1a; }
.sc-seo-counts .sc-seo-over { color: #d63638; }
.sc-seo-help { font-size: 12px; color: #787c82; margin-bottom: 12px; max-width: 640px; }
.sc-seo-plabel { font-size: 11px; text-transform: uppercase; letter-spacing: .04em; color: #787c82; margin: 12px 0 6px; font-weight: 600; }
.sc-seo-google { border: 1px solid #dadce0; border-radius: 8px; padding: 12px 14px; background: #fff; font-family: arial, sans-serif; max-width: 640px; }
.sc-seo-google__url { color: #202124; font-size: 12px; line-height: 1.3; word-break: break-all; }
.sc-seo-google__title { color: #1a0dab; font-size: 18px; line-height: 1.3; margin: 3px 0; }
.sc-seo-google__desc { color: #4d5156; font-size: 13px; line-height: 1.45; }
.sc-seo-social { border: 1px solid #dadce0; border-radius: 8px; overflow: hidden; background: #fff; max-width: 520px; }
.sc-seo-social__meta { padding: 10px 12px; }
.sc-seo-social__host { color: #606770; font-size: 11px; text-transform: uppercase; letter-spacing: .02em; }
.sc-seo-social__title { color: #1d2129; font-size: 15px; font-weight: 600; line-height: 1.3; margin: 3px 0; }
.sc-seo-social__desc { color: #606770; font-size: 13px; line-height: 1.4; }
</style>
<script>
( function () {
  var root = document.querySelector( '.sc-seo-preview' );
  if ( root === null ) { return; }
  var d = root.dataset;
  var ti = document.getElementById( 'sc_seo_title' );
  var de = document.getElementById( 'sc_seo_desc' );
  function q( sel ) { return document.querySelector( sel ); }
  function v( el ) { return ( el === null ) ? '' : String( el.value || '' ); }
  function clip( str, n ) { return ( str.length > n ) ? ( str.slice( 0, n - 1 ) + '...' ) : str; }
  function paint() {
    var t = v( ti ).trim();
    var m = v( de ).trim();
    var et = ( t.length === 0 ) ? ( d.fallbackTitle || '' ) : t;
    var em = ( m.length === 0 ) ? ( d.fallbackDesc || '' ) : m;
    var ct = q( '[data-c-title]' );
    var cm = q( '[data-c-desc]' );
    ct.textContent = String( t.length );
    cm.textContent = String( m.length );
    ct.className = ( t.length > 60 ) ? 'sc-seo-over' : '';
    cm.className = ( m.length > 160 ) ? 'sc-seo-over' : '';
    q( '[data-g-url]' ).textContent = d.url || '';
    q( '[data-g-title]' ).textContent = clip( et, 60 );
    q( '[data-g-desc]' ).textContent = clip( em, 160 );
    q( '[data-s-host]' ).textContent = ( d.host || '' ).toUpperCase();
    q( '[data-s-title]' ).textContent = clip( et, 70 );
    q( '[data-s-desc]' ).textContent = clip( em, 160 );
  }
  if ( ti ) { ti.addEventListener( 'input', paint ); }
  if ( de ) { de.addEventListener( 'input', paint ); }
  paint();
} )();
</script>
SCSEO;

}

add_action(
	'save_post',
	function ( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['sc_seo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sc_seo_nonce'] ) ), 'sc_seo_save' ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$t = isset( $_POST['sc_seo_title'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_seo_title'] ) ) : '';
		$d = isset( $_POST['sc_seo_desc'] ) ? sanitize_textarea_field( wp_unslash( $_POST['sc_seo_desc'] ) ) : '';
		update_post_meta( $post_id, '_sc_seo_title', $t );
		update_post_meta( $post_id, '_sc_seo_desc', $d );
	}
);

add_filter(
	'document_title_parts',
	function ( $parts ) {
		if ( is_singular() ) {
			$t = get_post_meta( get_queried_object_id(), '_sc_seo_title', true );
			if ( $t ) {
				$parts['title'] = $t;
			}
		}
		return $parts;
	}
);
