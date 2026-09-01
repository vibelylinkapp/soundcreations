<?php
/**
 * Central business + content settings (Sound Creations -> Settings).
 * Writes to option 'soundcreations_settings', read by the theme via sc_setting().
 * Single source of truth for contact details AND homepage / About page copy.
 *
 * @package SoundCreationsCore
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}

function sc_core_settings_fields() {
	// key => array( 'Label', 'type' ). type: text | textarea | image | heading.
	return array(
		'__sec_business'       => array( 'Business details', 'heading' ),
		'company_name'         => array( 'Company name', 'text' ),
			'slogan'               => array( 'Slogan (footer)', 'text' ),
		'tagline'              => array( 'Tagline', 'text' ),
		'phone'                => array( 'Phone (display)', 'text' ),
		'phone_link'           => array( 'Phone (tel: digits, e.g. +254715754758)', 'text' ),
		'email'                => array( 'Email', 'text' ),
		'address'              => array( 'Address', 'text' ),
		'hours_week'           => array( 'Hours - weekdays', 'text' ),
		'hours_sat'            => array( 'Hours - Saturday', 'text' ),
		'hours_sun'            => array( 'Hours - Sunday', 'text' ),
		'regions'              => array( 'Regional presence line', 'text' ),
		'whatsapp'             => array( 'WhatsApp number (digits only, country code, no +)', 'text' ),
		'facebook'             => array( 'Facebook URL', 'text' ),
		'x'                    => array( 'X (Twitter) URL', 'text' ),
		'linkedin'             => array( 'LinkedIn URL', 'text' ),
		'youtube'              => array( 'YouTube URL', 'text' ),
			'instagram'            => array( 'Instagram URL', 'text' ),
		'hero_video'           => array( 'Hero background video URL (MP4)', 'image' ),

		'__sec_footer'         => array( 'Footer', 'heading' ),
		'footer_about'         => array( 'About column: text', 'textarea' ),
		'footer_explore'       => array( 'Explore column links (one per line: Label | URL or /path)', 'textarea' ),
		'footer_solutions'     => array( 'Solutions column links (one per line: Label | URL or /path)', 'textarea' ),
		'footer_address'       => array( 'Contact: address (one line per row)', 'textarea' ),
		'footer_hours_label'   => array( 'Contact: open-hours heading', 'text' ),
		'footer_hours'         => array( 'Contact: open hours (one line per row)', 'textarea' ),

		'__sec_home'           => array( 'Homepage content', 'heading' ),
		'home_hero_eyebrow'    => array( 'Hero: eyebrow line', 'text' ),
		'home_hero_title'      => array( 'Hero: headline', 'text' ),
		'home_hero_lead'       => array( 'Hero: intro paragraph', 'textarea' ),
		'home_whatwedo_title'  => array( 'What we do: heading', 'text' ),
		'home_whatwedo_lead'   => array( 'What we do: intro', 'textarea' ),
		'home_solutions_title' => array( 'Solutions: heading', 'text' ),
		'home_projects_title'  => array( 'Featured projects: heading', 'text' ),
		'home_stat1_num'       => array( 'Proof stat 1: number', 'text' ),
		'home_stat1_label'     => array( 'Proof stat 1: label', 'text' ),
		'home_stat2_num'       => array( 'Proof stat 2: number', 'text' ),
		'home_stat2_label'     => array( 'Proof stat 2: label', 'text' ),
		'home_stat2_note'      => array( 'Proof stat 2: sub-note', 'text' ),
		'home_stat3_num'       => array( 'Proof stat 3: number', 'text' ),
		'home_stat3_label'     => array( 'Proof stat 3: label', 'text' ),
		'home_stat4_num'       => array( 'Proof stat 4: number', 'text' ),
		'home_stat4_label'     => array( 'Proof stat 4: label', 'text' ),
		'home_cta_title'       => array( 'CTA: heading', 'text' ),
		'home_cta_text'        => array( 'CTA: text', 'textarea' ),

			'home_hero_cta1_label' => array( 'Hero: primary button label', 'text' ),
			'home_hero_cta1_url'   => array( 'Hero: primary button link (path or URL)', 'text' ),
			'home_hero_cta2_label' => array( 'Hero: secondary button label', 'text' ),
			'home_hero_cta2_url'   => array( 'Hero: secondary button link (path or URL)', 'text' ),
			'home_whatwedo_eyebrow'=> array( 'What we do: eyebrow', 'text' ),
			'home_steps'           => array( 'Process steps (one per line: Title | Description)', 'textarea' ),
			'home_solutions_eyebrow'=> array( 'Solutions: eyebrow', 'text' ),
			'home_partners_label'  => array( 'Partners strip: label', 'text' ),
			'home_projects_eyebrow'=> array( 'Featured projects: eyebrow', 'text' ),
		'__sec_about'          => array( 'About page content', 'heading' ),
		'about_hero_eyebrow'   => array( 'About hero: eyebrow', 'text' ),
		'about_hero_title'     => array( 'About hero: headline', 'text' ),
		'about_hero_lead'      => array( 'About hero: intro', 'textarea' ),
		'about_stat1_num'      => array( 'About stat 1: number', 'text' ),
		'about_stat1_label'    => array( 'About stat 1: label', 'text' ),
		'about_stat2_num'      => array( 'About stat 2: number', 'text' ),
		'about_stat2_label'    => array( 'About stat 2: label', 'text' ),
		'about_stat3_head'     => array( 'About stat 3: heading', 'text' ),
		'about_stat3_sub'      => array( 'About stat 3: sub', 'text' ),
		'about_stat4_head'     => array( 'About stat 4: heading', 'text' ),
		'about_stat4_sub'      => array( 'About stat 4: sub', 'text' ),
		'about_journey_eyebrow'=> array( 'Journey: eyebrow', 'text' ),
		'about_journey_title'  => array( 'Journey: heading', 'text' ),
		'about_journey_p1'     => array( 'Journey: paragraph 1', 'textarea' ),
		'about_journey_p2'     => array( 'Journey: paragraph 2', 'textarea' ),
		'about_story_label'    => array( 'Story card: label', 'text' ),
			'about_hero_image'     => array( 'About hero: photo (upload to Media, paste URL)', 'image' ),
		'about_story_video'    => array( 'Story card: YouTube video URL (paste full link)', 'image' ),
		'about_exp_eyebrow'    => array( 'Expertise: eyebrow', 'text' ),
		'about_exp_title'      => array( 'Expertise: heading', 'text' ),
		'about_exp_intro'      => array( 'Expertise: intro', 'textarea' ),
		'about_exp_items'      => array( 'Expertise cards (one per line: Title | Description)', 'textarea' ),
		'about_operate_eyebrow'=> array( 'Where we operate: eyebrow', 'text' ),
		'about_operate_title'  => array( 'Where we operate: heading', 'text' ),
		'about_operate_body'   => array( 'Where we operate: body', 'textarea' ),
		'about_partners_eyebrow'=> array( 'Partners: eyebrow', 'text' ),
		'about_partners_title' => array( 'Partners: heading', 'text' ),
		'about_cta_title'      => array( 'About CTA: heading', 'text' ),
		'about_cta_text'       => array( 'About CTA: text', 'textarea' ),

			'__sec_downloads'      => array( 'Company profiles (downloads)', 'heading' ),
			'profiles_eyebrow'     => array( 'Profiles: eyebrow', 'text' ),
			'profiles_title'       => array( 'Profiles: heading', 'text' ),
			'profiles_intro'       => array( 'Profiles: intro', 'textarea' ),
			'company_profile_url'  => array( 'Company Profile: PDF URL (upload to Media, paste link)', 'image' ),
			'company_profile_desc' => array( 'Company Profile: description', 'textarea' ),
			'acoustic_profile_url' => array( 'Acoustic Profile: PDF URL (upload to Media, paste link)', 'image' ),
			'acoustic_profile_desc'=> array( 'Acoustic Profile: description', 'textarea' ),

			'__sec_solutions'      => array( 'Solutions page content', 'heading' ),
			'sol_hero_title'       => array( 'Solutions hero: headline', 'text' ),
			'sol_hero_lead'        => array( 'Solutions hero: intro', 'textarea' ),
			'sol_solutions_title'  => array( 'Solutions: section heading', 'text' ),
			'sol_process_title'    => array( 'Process: heading', 'text' ),
			'sol_sectors_title'    => array( 'Who we work with: heading', 'text' ),
			'sol_sectors'          => array( 'Who we work with: sectors (one per line)', 'textarea' ),
			'sol_support_title'    => array( 'End-to-end support: heading', 'text' ),
			'sol_support_text'     => array( 'End-to-end support: text', 'textarea' ),
			'sol_support_points'   => array( 'End-to-end support: checklist (one per line)', 'textarea' ),
			'sol_support_cta'      => array( 'End-to-end support: button label', 'text' ),
			'sol_about_title'      => array( 'About Sound Creations: heading', 'text' ),
			'sol_about_items'      => array( 'About Sound Creations cards (one per line: Title | Description)', 'textarea' ),
			'sol_cta_title'        => array( 'Solutions CTA: heading', 'text' ),
			'sol_cta_text'         => array( 'Solutions CTA: text', 'textarea' ),

			'__sec_contact'        => array( 'Contact / About page content', 'heading' ),
			'contact_eyebrow'      => array( 'Contact hero: eyebrow', 'text' ),
			'contact_title'        => array( 'Contact hero: headline', 'text' ),
			'contact_lead'         => array( 'Contact hero: intro', 'textarea' ),
			'contact_offices_title'=> array( 'Offices: heading', 'text' ),
			'contact_cta_title'    => array( 'Contact CTA: heading', 'text' ),
			'contact_cta_text'     => array( 'Contact CTA: text', 'textarea' ),
			'__sec_projectspage'   => array( 'Projects page', 'heading' ),
			'projects_eyebrow'     => array( 'Projects hero: eyebrow', 'text' ),
			'projects_title'       => array( 'Projects hero: headline', 'text' ),
			'projects_lead'        => array( 'Projects hero: intro', 'textarea' ),
			'proj_stats'           => array( 'Projects stats (one per line: Number | Label | Sub-note)', 'textarea' ),
			'projects_cta_title'   => array( 'Projects CTA: heading', 'text' ),
			'projects_cta_text'    => array( 'Projects CTA: text', 'textarea' ),
	);
}

add_action(
	'admin_menu',
	function () {
		add_menu_page( 'Sound Creations', 'Sound Creations', 'manage_options', 'sc-settings', 'sc_core_render_settings_page', 'dashicons-format-audio', 58 );
		add_submenu_page( 'sc-settings', 'Settings', 'Settings', 'manage_options', 'sc-settings', 'sc_core_render_settings_page' );
	}
);

add_action(
	'admin_init',
	function () {
		register_setting(
			'sc_settings_group',
			'soundcreations_settings',
			array(
				'type'              => 'array',
				'sanitize_callback' => 'sc_core_sanitize_settings',
				'default'           => array(),
			)
		);
	}
);

function sc_core_sanitize_settings( $input ) {
	$clean = array();
	foreach ( sc_core_settings_fields() as $key => $def ) {
		$type = isset( $def[1] ) ? $def[1] : 'text';
		if ( 'heading' === $type ) {
			continue;
		}
		if ( isset( $input[ $key ] ) === false ) {
			continue;
		}
		$val = trim( (string) $input[ $key ] );
		if ( in_array( $key, array( 'facebook', 'x', 'linkedin', 'youtube', 'instagram' ), true ) || 'image' === $type ) {
			$clean[ $key ] = esc_url_raw( $val );
		} elseif ( 'email' === $key ) {
			$clean[ $key ] = sanitize_email( $val );
		} elseif ( 'textarea' === $type ) {
			$clean[ $key ] = sanitize_textarea_field( $val );
		} else {
			$clean[ $key ] = sanitize_text_field( $val );
		}
	}
	return $clean;
}

function sc_core_render_settings_page() {
	if ( current_user_can( 'manage_options' ) === false ) {
		return;
	}
	$opts     = get_option( 'soundcreations_settings', array() );
	$defaults = function_exists( 'sc_default_settings' ) ? sc_default_settings() : array();
	?>
	<div class="wrap">
		<h1>Sound Creations - Central Settings</h1>
		<p>Everything here feeds the live site: header, footer, contact details, and the homepage and About page copy. Update once and every template follows. Leave a field blank to use the built-in default (shown as grey placeholder text).</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'sc_settings_group' ); ?>
			<table class="form-table" role="presentation"><tbody>
			<?php
			foreach ( sc_core_settings_fields() as $key => $def ) {
				$label = isset( $def[0] ) ? $def[0] : $key;
				$type  = isset( $def[1] ) ? $def[1] : 'text';
				if ( 'heading' === $type ) {
					printf( '<tr><th colspan="2" style="padding:26px 0 0;"><h2 style="margin:0;border-bottom:1px solid #dcdcde;padding-bottom:6px;">%s</h2></th></tr>', esc_html( $label ) );
					continue;
				}
				$value       = isset( $opts[ $key ] ) ? $opts[ $key ] : '';
				$placeholder = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
				if ( 'textarea' === $type ) {
					printf(
						'<tr><th scope="row"><label for="sc_%1$s">%2$s</label></th><td><textarea id="sc_%1$s" name="soundcreations_settings[%1$s]" rows="3" class="large-text" placeholder="%4$s">%3$s</textarea></td></tr>',
						esc_attr( $key ),
						esc_html( $label ),
						esc_textarea( $value ),
						esc_attr( $placeholder )
					);
				} else {
					printf(
						'<tr><th scope="row"><label for="sc_%1$s">%2$s</label></th><td><input type="text" id="sc_%1$s" name="soundcreations_settings[%1$s]" value="%3$s" placeholder="%4$s" class="regular-text" style="width:34rem;max-width:100%%;"></td></tr>',
						esc_attr( $key ),
						esc_html( $label ),
						esc_attr( $value ),
						esc_attr( $placeholder )
					);
				}
			}
			?>
			</tbody></table>
			<?php submit_button( 'Save settings' ); ?>
		</form>
	</div>
	<?php
}
