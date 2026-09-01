<?php
/**
 * Template helpers and the central business-settings API.
 * Single source of truth for contact / WhatsApp / social data.
 *
 * @package SoundCreations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Brief-verified defaults. Overridable in wp-admin when the
 * Sound Creations Core plugin is active (Sound Creations -> Settings).
 */
function sc_default_settings() {
	return array(
		'company_name' => 'Sound Creations Ltd',
		'slogan'       => 'If it sounds good, it’s Sound Creations',
		'profiles_eyebrow'      => 'Company Profiles',
		'profiles_title'        => 'Download our profiles',
		'profiles_intro'        => 'Get the full picture of who we are and what we deliver. Download our company and acoustic profiles to share with your team.',
		'company_profile_desc'  => 'An overview of Sound Creations — our story, capabilities, brands and the projects we deliver across Africa and the Middle East.',
		'acoustic_profile_desc' => 'Our acoustic design and treatment expertise — room acoustics, sound isolation and the products we use to engineer great-sounding spaces.',
		'tagline'      => 'Engineered for sound. Built for Africa.',
		'contact_eyebrow'       => 'Contact Us',
		'contact_title'         => 'Let’s talk about your project.',
		'contact_lead'          => 'Whether you’re planning a new installation, upgrading your systems or need expert advice, our team is ready to help.',
		'contact_offices_title' => 'Local presence. Regional impact.',
		'contact_cta_title'     => 'Have a project in mind?',
		'contact_cta_text'      => 'Tell us about your space and application. Our technical team will help you design the right solution.',
		'sol_hero_title'      => 'Engineered solutions. Exceptional experiences.',
		'sol_hero_lead'       => 'We design, integrate and support professional audio, visual, lighting and acoustic solutions for every space, application and performance.',
		'sol_solutions_title' => 'Complete technology solutions for every environment.',
		'sol_process_title'   => 'A proven process. A better result.',
		'sol_sectors_title'   => 'Engineered for how corporates actually operate.',
		'sol_sectors'         => "Corporate & Boardrooms\nHouses of Worship\nEducation & Campuses\nHospitality & Retail\nLive Events & Touring\nGovernment & Public",
		'sol_support_title'   => 'We don’t disappear after installation.',
		'sol_support_text'    => 'Preventive maintenance, genuine spare parts, operator training and rapid response — a single support relationship that keeps your systems performing for years.',
		'sol_support_points'  => "Manufacturer-certified technical team\nGenuine parts & warranty management\nOperator & technical training\nRegional presence for fast on-site help",
		'sol_support_cta'     => 'Talk to our team',
		'sol_about_title'     => 'Why organisations choose Sound Creations.',
		'sol_about_items'     => "20+ Years Experience | Two decades of delivering complex solutions across the region.\nExpert Engineering Team | Highly skilled engineers, technicians and project managers.\nQuality You Can Trust | We work with the world’s leading brands and technologies.\nRegional Presence | On-the-ground presence in Kenya, Rwanda, DR Congo and the UAE.\nEnd-to-End Solutions | From consultation to support, we’ve got you covered.\nClient-Centric Approach | Your success is our priority. We build long-term partnerships.",
		'sol_cta_title'       => 'Have a project in mind?',
		'sol_cta_text'        => 'Let’s design and deliver the right solution for your space and application.',
		'phone'        => '+254 715 754 758',
		'phone_link'   => '+254715754758',
		'email'        => 'info@soundcreationsltd.com',
		'address'      => 'Mpaka Plaza, Mpaka Road, Westlands, Nairobi, Kenya',
		'hours_week'   => 'Mon-Fri: 9:00 AM - 5:30 PM',
		'hours_sat'    => 'Sat: 9:00 AM - 1:30 PM',
		'hours_sun'    => 'Sun: Closed',
		'regions'      => 'Kenya · Rwanda · DR Congo · UAE',
		'whatsapp'     => '', // [VERIFY] No verified WhatsApp number was supplied. Blank = button hidden.
		'facebook'     => 'https://web.facebook.com/soundcreationsKE',
		'x'            => 'https://x.com/SCL_kenya',
		'linkedin'     => 'https://www.linkedin.com/company/soundcreationsltd/',
		'youtube'      => 'https://www.youtube.com/channel/UCw4U1dOOT0fcz13L3Zqw3Cgwe', // [VERIFY] URL looks malformed.
		'home_hero_cta1_label' => 'Request a Consultation',
		'home_hero_cta1_url'   => '/request-a-consultation/',
		'home_hero_cta2_label' => 'Explore Our Solutions',
		'home_hero_cta2_url'   => '/solutions/',
		'home_whatwedo_eyebrow'=> 'What we do',
		'home_solutions_eyebrow'=> 'Solutions',
		'home_partners_label'  => 'Global Technology Partners',
		'home_projects_eyebrow'=> 'Featured Projects',
		'home_steps'           => "Consult | We listen, assess and recommend the right solution for your needs.\nDesign | Custom system designs tailored to your space, goals and budget.\nDistribute | Quality audio solutions from trusted global brands.\nIntegrate | Professional installation and system integration done right.\nSupport | Ongoing support and maintenance to keep you performing.",
		'projects_eyebrow'     => 'Our Projects',
		'projects_title'       => 'Real solutions. Real impact.',
		'projects_lead'        => 'Explore a selection of our professional audio, acoustics and integration projects across Africa and the Middle East.',
		'proj_stats'           => "300+ | Projects Completed | Across Africa & Middle East\n50+ | Expert Professionals | Delivering Excellence\n4 | Regional Offices | Local Presence, Global Reach\n20+ | Years of Experience | In Audio, Visual & Acoustics",
		'projects_cta_title'   => 'Have a project in mind?',
		'projects_cta_text'    => 'Our team of experts is ready to help you design and deliver the right solution.',
		'hero_video'   => 'https://soundcreationsltd.com/newwebsite/wp-content/uploads/2026/08/dbtechnologies_stories_homepage-1280.mp4',
		'footer_about'       => 'World-class professional audio, visual, lighting and acoustic solutions — engineered, delivered and supported across Africa and the Middle East.',
		'footer_explore'     => "Home | /\nSolutions | /solutions/\nBrands & Products | /brands/\nProjects | /projects/\nAbout | /about/\nContact | /contact/",
		'footer_solutions'   => "Professional Audio | /solutions/professional-audio/\nAcoustics | /solutions/acoustics/\nConferencing | /solutions/conferencing/\nSystem Integration | /solutions/system-integration/\nFANE Loudspeakers | /fane/",
		'footer_address'     => "Mpaka Plaza, Mpaka Road\nWestlands Nairobi",
		'footer_hours_label' => 'Open Hours',
		'footer_hours'       => "Mon – Fri: 9 am – 5:30 pm\nSat: 9 am – 1:30 pm\nSunday: CLOSED",
	);
}

/**
 * Read one setting, preferring the saved option, then the brief default.
 */
function sc_setting( $key, $default = '' ) {
	$opts = get_option( 'soundcreations_settings', array() );
	if ( is_array( $opts ) && isset( $opts[ $key ] ) && '' !== $opts[ $key ] ) {
		return $opts[ $key ];
	}
	$defaults = sc_default_settings();
	if ( isset( $defaults[ $key ] ) && '' !== $defaults[ $key ] ) {
		return $defaults[ $key ];
	}
	return $default;
}

/**
 * Build a wa.me link from the central WhatsApp number. Empty when unset.
 */
/**
 * Split a settings textarea into rows. Each line: 'A | B | C'.
 */
function sc_split_lines( $raw, $parts = 2 ) {
	$rows  = array();
	$lines = preg_split( '/\r\n|\r|\n/', (string) $raw );
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$cols = array_map( 'trim', explode( '|', $line ) );
		while ( count( $cols ) < $parts ) {
			$cols[] = '';
		}
		$rows[] = $cols;
	}
	return $rows;
}

function sc_whatsapp_url() {
	$num = preg_replace( '/[^0-9]/', '', sc_setting( 'whatsapp' ) );
	return $num ? 'https://wa.me/' . $num : '';
}

/**
 * Return label => URL for configured social profiles.
 */
function sc_social_links() {
	$out = array();
	$map = array( 'facebook' => 'Facebook', 'x' => 'X', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube' );
	foreach ( $map as $key => $label ) {
		$url = sc_setting( $key );
		if ( $url ) {
			$out[ $label ] = esc_url( $url );
		}
	}
	return $out;
}

/**
 * The dark / light colour-theme toggle button.
 */
function sc_theme_toggle_button() {
	echo '<button class="sc-theme-toggle" type="button" data-sc-theme-toggle aria-label="' . esc_attr__( 'Switch colour theme', 'soundcreations' ) . '">'
		. '<span class="sc-theme-toggle__sun" aria-hidden="true">&#9728;</span>'
		. '<span class="sc-theme-toggle__moon" aria-hidden="true">&#9789;</span>'
		. '</button>';
}

/* ------------------------------------------------------------------ *
 * Catalog template helpers (Products / Brands / Projects) - v0.2.0
 * ------------------------------------------------------------------ */

/** Read a Sound Creations Core custom field for a post. */
function sc_field( $key, $id = 0 ) {
	$id = $id ? $id : get_the_ID();
	return get_post_meta( $id, '_sc_' . $key, true );
}

/** Render a "Label: Value" block into a spec table. */
function sc_render_specs( $raw ) {
	$raw = trim( (string) $raw );
	if ( '' === $raw ) {
		return '';
	}
	$rows = '';
	foreach ( preg_split( '/\r\n|\r|\n/', $raw ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$parts = explode( ':', $line, 2 );
		$label = trim( $parts[0] );
		$val   = isset( $parts[1] ) ? trim( $parts[1] ) : '';
		$rows .= '<tr><th scope="row">' . esc_html( $label ) . '</th><td>' . esc_html( $val ) . '</td></tr>';
	}
	return $rows ? '<table class="sc-specs"><tbody>' . $rows . '</tbody></table>' : '';
}

/** Render newline-separated lines into a tick list. */
function sc_render_ticklist( $raw ) {
	$raw = trim( (string) $raw );
	if ( '' === $raw ) {
		return '';
	}
	$items = '';
	foreach ( preg_split( '/\r\n|\r|\n/', $raw ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$items .= '<li>' . esc_html( $line ) . '</li>';
	}
	return $items ? '<ul class="sc-ticklist">' . $items . '</ul>' : '';
}

/** Breadcrumb from an array of [label, url]; final crumb is current. */
function sc_breadcrumb( $trail ) {
	$out  = '<nav class="sc-breadcrumb" aria-label="Breadcrumb">';
	$last = count( $trail ) - 1;
	foreach ( $trail as $i => $crumb ) {
		list( $label, $url ) = $crumb;
		if ( $i > 0 ) {
			$out .= '<span class="sep">/</span>';
		}
		if ( $url && $i !== $last ) {
			$out .= '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
		} else {
			$out .= '<span aria-current="page">' . esc_html( $label ) . '</span>';
		}
	}
	return $out . '</nav>';
}

/** Filter chips for a taxonomy, highlighting the active term. */
function sc_term_chips( $taxonomy, $base_url ) {
	if ( ! taxonomy_exists( $taxonomy ) ) {
		return '';
	}
	$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true ) );
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return '';
	}
	$current = is_tax( $taxonomy ) ? (int) get_queried_object_id() : 0;
	$out     = '<div class="sc-filters">';
	$out    .= '<a class="sc-chip' . ( $current ? '' : ' is-active' ) . '" href="' . esc_url( $base_url ) . '">All</a>';
	foreach ( $terms as $t ) {
		$active = ( $current === (int) $t->term_id ) ? ' is-active' : '';
		$out   .= '<a class="sc-chip' . $active . '" href="' . esc_url( get_term_link( $t ) ) . '">' . esc_html( $t->name ) . '</a>';
	}
	return $out . '</div>';
}

/** Term chips (tags) for a post. */
function sc_term_tags( $post_id, $taxonomy ) {
	$terms = get_the_terms( $post_id, $taxonomy );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return '';
	}
	$out = '<div class="sc-tags">';
	foreach ( $terms as $t ) {
		$out .= '<a class="sc-tag" href="' . esc_url( get_term_link( $t ) ) . '">' . esc_html( $t->name ) . '</a>';
	}
	return $out . '</div>';
}

/** Name of the first term in a taxonomy, or a fallback. */
function sc_primary_term_name( $post_id, $taxonomy, $fallback = '' ) {
	$terms = get_the_terms( $post_id, $taxonomy );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$first = reset( $terms );
		return $first->name;
	}
	return $fallback;
}

/** A media card for archive/related grids. Falls back to a monogram tile. */
function sc_media_card( $post_id, $kicker = '', $meta = '', $logo = false ) {
	$link     = get_permalink( $post_id );
	$title    = get_the_title( $post_id );
	$mediacls = $logo ? 'sc-card__media sc-card__media--logo' : 'sc-card__media';
	$out      = '<a class="sc-card sc-card--media" href="' . esc_url( $link ) . '">';
	$out     .= '<div class="' . esc_attr( $mediacls ) . '">';
	if ( has_post_thumbnail( $post_id ) ) {
		$out .= get_the_post_thumbnail( $post_id, $logo ? 'medium' : 'large', array( 'loading' => 'lazy', 'alt' => esc_attr( $title ) ) );
	} else {
		$initial = strtoupper( substr( wp_strip_all_tags( $title ), 0, 2 ) );
		$out    .= '<div class="sc-card__ph">' . esc_html( $initial ) . '</div>';
	}
	$out .= '</div><div class="sc-card__body">';
	if ( '' !== trim( (string) $kicker ) ) {
		$out .= '<span class="sc-card__kicker">' . esc_html( $kicker ) . '</span>';
	}
	$out .= '<span class="sc-card__title">' . esc_html( $title ) . '</span>';
	if ( '' !== trim( (string) $meta ) ) {
		$out .= '<span class="sc-card__meta">' . esc_html( $meta ) . '</span>';
	}
	return $out . '</div></a>';
}

if ( function_exists( 'sc_utility_social' ) === false ) {
	function sc_utility_social() {
		$social = array(
			'linkedin'  => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
			'facebook'  => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
			'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>',
		);
		$labels = array( 'linkedin' => 'LinkedIn', 'facebook' => 'Facebook', 'instagram' => 'Instagram' );
		foreach ( $social as $key => $svg ) {
			$url = sc_setting( $key );
			if ( $url ) {
				echo '<a class="sc-utility__soc" href="' . esc_url( $url ) . '" target="_blank" rel="noopener" aria-label="' . esc_attr( $labels[ $key ] ) . '"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">' . $svg . '</svg></a>';
			}
		}
	}
}


if ( function_exists( 'sc_all_social' ) === false ) {
	/**
	 * Render every configured social profile as an icon link (footer).
	 */
	function sc_all_social() {
		$items = array(
			'facebook'  => array( 'Facebook',  '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H8v3h3v7h3v-7h3l1-3h-4V9c0-.6.4-1 1-1z"/></svg>' ),
			'x'         => array( 'X',         '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M18.9 2H22l-7.6 8.7L23 22h-6.9l-5-6.6L4.3 22H1.2l8.2-9.4L1 2h7.1l4.5 6 6.3-6zm-2.4 18h1.9L7.6 4H5.6z"/></svg>' ),
			'instagram' => array( 'Instagram', '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>' ),
			'linkedin'  => array( 'LinkedIn',  '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M6.94 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM3 8.5h3.9V21H3zM9.5 8.5h3.7v1.7h.1c.5-.9 1.8-1.9 3.6-1.9 3.9 0 4.6 2.5 4.6 5.8V21h-3.9v-5.4c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9V21H9.5z"/></svg>' ),
			'youtube'   => array( 'YouTube',   '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M23 12s0-3.2-.4-4.7a2.5 2.5 0 0 0-1.8-1.8C19.2 5 12 5 12 5s-7.2 0-8.8.5A2.5 2.5 0 0 0 1.4 7.3C1 8.8 1 12 1 12s0 3.2.4 4.7a2.5 2.5 0 0 0 1.8 1.8C4.8 19 12 19 12 19s7.2 0 8.8-.5a2.5 2.5 0 0 0 1.8-1.8C23 15.2 23 12 23 12zM9.8 15.3V8.7l5.7 3.3z"/></svg>' ),
			'whatsapp'  => array( 'WhatsApp',  '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.5 15.3L2 22l4.8-1.3A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-2.8.7.8-2.7-.2-.3A8 8 0 1 1 12 20zm4.4-6c-.2-.1-1.4-.7-1.6-.8s-.4-.1-.5.1-.6.8-.8 1-.3.2-.5.1a6.5 6.5 0 0 1-3.2-2.8c-.2-.4.2-.4.6-1.2.1-.2 0-.3 0-.5s-.5-1.3-.7-1.8-.4-.4-.5-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2c0 1.3 1 2.6 1.1 2.8s1.9 3 4.7 4.2c1.7.7 2.4.8 3.2.7.5-.1 1.4-.6 1.6-1.1s.2-1 .1-1.1z"/></svg>' ),
		);
		foreach ( $items as $key => $it ) {
			$url = ( 'whatsapp' === $key ) ? sc_whatsapp_url() : sc_setting( $key );
			if ( $url ) {
				echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener" aria-label="' . esc_attr( $it[0] ) . '">' . $it[1] . '</a>';
			}
		}
	}
}


if ( function_exists( 'sc_youtube_id' ) === false ) {
	/**
	 * Extract an 11-character YouTube video id from a URL or bare id.
	 * Accepts watch, youtu.be, embed and shorts links. Returns '' when none.
	 *
	 * @param string $url YouTube URL or id.
	 * @return string Video id or empty string.
	 */
	function sc_youtube_id( $url ) {
		$url = trim( (string) $url );
		if ( $url === '' ) {
			return '';
		}
		if ( preg_match( '/^[A-Za-z0-9_-]{11}$/', $url ) === 1 ) {
			return $url;
		}
		$patterns = array(
			'/youtu\.be\/([A-Za-z0-9_-]{11})/',
			'/[?&]v=([A-Za-z0-9_-]{11})/',
			'/youtube\.com\/embed\/([A-Za-z0-9_-]{11})/',
			'/youtube\.com\/shorts\/([A-Za-z0-9_-]{11})/',
		);
		foreach ( $patterns as $sc_pat ) {
			if ( preg_match( $sc_pat, $url, $sc_m ) === 1 ) {
				return $sc_m[1];
			}
		}
		return '';
	}
}
