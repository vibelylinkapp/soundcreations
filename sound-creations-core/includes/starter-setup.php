<?php
/**
 * Starter Setup: one-click creation of core pages, sample solutions and the primary menu.
 * The runner is reusable so the Setup Wizard can call it too. Idempotent - existing items are skipped.
 *
 * @package SoundCreationsCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sc_core_starter_pages() {
	$privacy = <<<'HTML'
<p><em>Last updated: [insert date]</em></p>
<p>Sound Creations Ltd ("Sound Creations", "we", "us" or "our") is committed to protecting the privacy and personal data of everyone who visits our website, contacts us, or engages our products and services. This Privacy Policy explains what personal data we collect, how and why we use it, who we share it with, how long we keep it, and the rights available to you.</p>
<p>This policy is designed to align with the Kenya Data Protection Act, 2019 and the Data Protection (General) Regulations, 2021, and reflects the principles of the EU General Data Protection Regulation (GDPR) where applicable.</p>
<h2>1. Who we are (Data Controller)</h2>
<p>Sound Creations Ltd is the data controller responsible for your personal data.</p>
<ul>
<li>Registered office: Mpaka Plaza, Mpaka Road, Westlands, Nairobi, Kenya</li>
<li>Email: info@soundcreationsltd.com</li>
<li>Telephone: +254 715 754 758</li>
<li>Regional offices: Nairobi (Kenya), Kigali (Rwanda), Kinshasa (DR Congo), Dubai (UAE)</li>
</ul>
<p>For any questions about this policy or your personal data, contact us using the details above, marked for the attention of the Data Protection Officer.</p>
<h2>2. The personal data we collect</h2>
<p>Depending on how you interact with us, we may collect:</p>
<ul>
<li>Identity and contact data — name, job title, company, email address, telephone number, postal address.</li>
<li>Enquiry and project data — details you provide when requesting a quotation, consultation or support, including information about your premises, requirements and project.</li>
<li>Transaction data — orders, invoices, payment records and correspondence relating to products and services.</li>
<li>Technical data — IP address, browser type and version, device information, and pages visited, collected through cookies and similar technologies.</li>
<li>Communications — records of your correspondence with us by email, phone, contact forms, WhatsApp or social media.</li>
</ul>
<p>We do not intentionally collect special categories of sensitive personal data through the website.</p>
<h2>3. How we collect your data</h2>
<ul>
<li>Directly from you — when you complete a form, request a quotation or consultation, place an order, email or call us, or otherwise communicate with us.</li>
<li>Automatically — as you navigate the website, through cookies and analytics.</li>
<li>From third parties — such as our partners, referrals, or publicly available sources, where relevant to a business relationship.</li>
</ul>
<h2>4. Why we use your data and our lawful basis</h2>
<p>We use your personal data only where the law allows. Our lawful bases include:</p>
<ul>
<li>Performance of a contract — to prepare quotations, fulfil orders, deliver and install products, and provide support and warranty services.</li>
<li>Legitimate interests — to respond to enquiries, manage and grow our business, improve our products, services and website, and keep records, provided your rights do not override those interests.</li>
<li>Consent — where you have opted in to receive marketing communications, or where required for certain cookies.</li>
<li>Legal obligation — to comply with applicable laws, tax and accounting requirements, and lawful requests by public authorities.</li>
</ul>
<h2>5. Marketing</h2>
<p>We may send you information about products, services, events and offers that may interest you where you have consented or where we are otherwise permitted to do so. You can opt out at any time by using the unsubscribe link in our emails or by contacting us.</p>
<h2>6. Sharing your data</h2>
<p>We may share your personal data with:</p>
<ul>
<li>Group offices and staff in Kenya, Rwanda, DR Congo and the UAE who need it to serve you.</li>
<li>Suppliers, manufacturers and service providers who help us deliver products, installation, logistics, IT and support services.</li>
<li>Professional advisers, auditors and insurers.</li>
<li>Public authorities and regulators where required by law.</li>
</ul>
<p>We do not sell your personal data.</p>
<h2>7. International transfers</h2>
<p>As a business operating across Kenya, Rwanda, DR Congo and the UAE, your data may be transferred to and processed in countries other than your own. Where we transfer personal data across borders, we take steps to ensure it is protected by appropriate safeguards and in accordance with applicable data protection law.</p>
<h2>8. Data retention</h2>
<p>We keep personal data only for as long as necessary for the purposes for which it was collected, including to satisfy legal, accounting, warranty or reporting requirements. When data is no longer needed, we securely delete or anonymise it.</p>
<h2>9. Cookies</h2>
<p>Our website uses cookies and similar technologies to make the site work, remember your preferences, and understand how the site is used. You can control cookies through your browser settings. Disabling some cookies may affect how the website functions.</p>
<h2>10. Data security</h2>
<p>We implement appropriate technical and organisational measures to protect personal data against unauthorised access, loss, misuse or alteration. While we take security seriously, no method of transmission over the internet is completely secure.</p>
<h2>11. Your rights</h2>
<p>Subject to applicable law, you have the right to be informed about how your data is used; to access the personal data we hold about you; to request correction of inaccurate or incomplete data; to request deletion of your data; to object to or restrict our processing; to request portability of your data; to withdraw consent at any time; and to lodge a complaint with the Office of the Data Protection Commissioner (Kenya) or your local supervisory authority.</p>
<p>To exercise any of these rights, contact us using the details in Section 1. We may need to verify your identity before responding.</p>
<h2>12. Third-party links</h2>
<p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those sites, and we encourage you to review their privacy policies.</p>
<h2>13. Children</h2>
<p>Our website and services are directed at businesses and adults. We do not knowingly collect personal data from children.</p>
<h2>14. Changes to this policy</h2>
<p>We may update this Privacy Policy from time to time. The latest version will always be published on this page with its effective date.</p>
<h2>15. Contact us</h2>
<p>Sound Creations Ltd, Mpaka Plaza, Mpaka Road, Westlands, Nairobi, Kenya — info@soundcreationsltd.com — +254 715 754 758.</p>
HTML;

	$terms = <<<'HTML'
<p><em>Last updated: [insert date]</em></p>
<p>These Terms and Conditions ("Terms") govern your use of the website at soundcreationsltd.com (the "Website") and the sale and supply of products and services by Sound Creations Ltd ("Sound Creations", "we", "us" or "our"). By using our Website or engaging our products or services, you agree to these Terms.</p>
<h2>1. About us</h2>
<p>Sound Creations Ltd provides professional audio, visual, lighting and acoustic solutions, with its registered office at Mpaka Plaza, Mpaka Road, Westlands, Nairobi, Kenya, and regional offices in Kigali (Rwanda), Kinshasa (DR Congo) and Dubai (UAE). Contact: info@soundcreationsltd.com, +254 715 754 758.</p>
<h2>2. Use of the Website</h2>
<ul>
<li>The Website and its content are provided for general information about our products and services.</li>
<li>You agree to use the Website lawfully and not to misuse it, introduce harmful code, or attempt to gain unauthorised access.</li>
<li>We may update, suspend or withdraw all or part of the Website at any time without notice.</li>
<li>We make reasonable efforts to keep information accurate and up to date but do not warrant that it is complete, current or error-free. Product specifications, images and availability may change.</li>
</ul>
<h2>3. Intellectual property</h2>
<p>All content on the Website — including text, graphics, logos, images, videos, brand names and design — is owned by or licensed to Sound Creations and is protected by intellectual property laws. You may not copy, reproduce, distribute or use any content without our prior written permission. Third-party brand names and trademarks remain the property of their respective owners.</p>
<h2>4. Quotations and orders</h2>
<ul>
<li>Quotations are valid for the period stated on the quotation, or 30 days where no period is stated, and are subject to change or withdrawal before acceptance.</li>
<li>All orders are subject to acceptance by us and to product availability. A binding contract arises only when we confirm your order in writing or begin performance.</li>
<li>Descriptions, specifications and samples are indicative; minor variations do not affect the contract.</li>
</ul>
<h2>5. Prices and payment</h2>
<ul>
<li>Prices are as stated in our quotation or invoice and, unless stated otherwise, are exclusive of VAT, duties, delivery, installation and other charges.</li>
<li>Payment terms are as set out in the quotation or invoice. Unless agreed otherwise, a deposit may be required to confirm an order, with the balance due before delivery, installation or as otherwise specified.</li>
<li>We reserve the right to charge interest on overdue amounts and to suspend delivery or services while payment is outstanding.</li>
</ul>
<h2>6. Delivery, title and risk</h2>
<ul>
<li>Delivery and completion timelines are estimates and are not guaranteed. We are not liable for delays outside our reasonable control.</li>
<li>Risk in goods passes to you on delivery. Title to goods remains with Sound Creations until we have received payment in full.</li>
<li>You are responsible for ensuring that the delivery and installation site is ready, safe and accessible.</li>
</ul>
<h2>7. Installation and services</h2>
<ul>
<li>Where we provide design, integration, installation or commissioning services, you agree to provide accurate information, timely access, and a suitable environment (including power, structural and safety conditions).</li>
<li>Additional work outside the agreed scope may be subject to further charges agreed in advance.</li>
</ul>
<h2>8. Cancellations and returns</h2>
<ul>
<li>Custom-configured, special-order and installed products may not be cancellable or returnable once ordered.</li>
<li>Any cancellation or return must be agreed in writing and may be subject to restocking or cancellation charges.</li>
<li>Warranty returns are handled under our Warranty Policy.</li>
</ul>
<h2>9. Warranty</h2>
<p>Products and installation work are covered by our Warranty Policy, which forms part of these Terms. Please refer to the Warranty page for full details, coverage and claims procedures.</p>
<h2>10. Limitation of liability</h2>
<ul>
<li>Nothing in these Terms excludes or limits liability that cannot be excluded or limited by law, including for death or personal injury caused by negligence, or for fraud.</li>
<li>Subject to the above, our total liability arising out of or in connection with any contract shall not exceed the price paid for the products or services giving rise to the claim.</li>
<li>We are not liable for indirect or consequential loss, or for loss of profit, revenue, data or business, howsoever arising.</li>
</ul>
<h2>11. Force majeure</h2>
<p>We are not liable for any failure or delay in performance caused by events beyond our reasonable control, including acts of God, natural disasters, war, civil unrest, strikes, power failures, supplier or logistics failures, epidemics, or government action.</p>
<h2>12. Third-party links</h2>
<p>The Website may link to third-party websites. We are not responsible for the content, products or practices of those sites.</p>
<h2>13. Governing law and disputes</h2>
<p>These Terms are governed by the laws of Kenya. The parties will first seek to resolve any dispute amicably. Failing that, disputes shall be subject to the exclusive jurisdiction of the courts of Kenya or, where the parties agree, referred to arbitration in Nairobi in accordance with applicable Kenyan law.</p>
<h2>14. Changes to these Terms</h2>
<p>We may amend these Terms from time to time. The current version will always be available on the Website with its effective date. Continued use of the Website or our services constitutes acceptance of the updated Terms.</p>
<h2>15. Contact</h2>
<p>Sound Creations Ltd, Mpaka Plaza, Mpaka Road, Westlands, Nairobi, Kenya — info@soundcreationsltd.com — +254 715 754 758.</p>
HTML;

	$warranty = <<<'HTML'
<p><em>Last updated: [insert date]</em></p>
<p>This Warranty Policy sets out the warranty that Sound Creations Ltd ("Sound Creations", "we", "us" or "our") provides on products supplied and installation work performed by us. It forms part of our Terms and Conditions.</p>
<h2>1. Manufacturer warranty</h2>
<ul>
<li>All new products we supply are covered by the applicable manufacturer warranty, which varies by brand and product. The warranty period and terms are those specified by the manufacturer.</li>
<li>As an authorised distributor and partner for leading global brands, Sound Creations manages warranty claims on your behalf with the manufacturer wherever possible.</li>
<li>Warranty covers defects in materials and workmanship under normal use during the warranty period. It does not cover consumable or wear items unless stated by the manufacturer.</li>
</ul>
<h2>2. Installation and workmanship warranty</h2>
<ul>
<li>Where Sound Creations designs, integrates and installs a system, we warrant our installation workmanship for a period of [insert period, e.g. 12 months] from the date of completion or handover, unless a different period is stated in your contract.</li>
<li>This covers defects arising from our installation work. It does not cover the products themselves, which are covered by the manufacturer warranty above.</li>
</ul>
<h2>3. What is covered</h2>
<ul>
<li>Manufacturing defects in materials and workmanship.</li>
<li>Failure of a product to perform to the manufacturer published specification under normal use, within the warranty period.</li>
</ul>
<h2>4. What is not covered</h2>
<p>The warranty does not apply to faults or damage caused by:</p>
<ul>
<li>misuse, abuse, neglect, accident, or failure to follow operating instructions;</li>
<li>incorrect power supply, power surges, lightning, voltage fluctuations, or inadequate earthing;</li>
<li>unauthorised repair, modification or tampering by any party other than Sound Creations or an authorised service provider;</li>
<li>normal wear and tear, cosmetic damage, or consumable items;</li>
<li>environmental factors such as moisture, dust, pests, heat, or ventilation outside product specifications;</li>
<li>relocation, reinstallation, or changes made by others after handover;</li>
<li>use of the product with incompatible equipment or accessories not approved by the manufacturer.</li>
</ul>
<h2>5. Conditions of warranty</h2>
<ul>
<li>The warranty applies to the original purchaser and is valid only where the product has been paid for in full.</li>
<li>Proof of purchase (invoice or delivery note) is required for any claim.</li>
<li>Products must have been installed, operated and maintained in accordance with the manufacturer and our instructions.</li>
<li>Serial numbers and warranty labels must be intact and legible.</li>
</ul>
<h2>6. Making a warranty claim</h2>
<ul>
<li>Contact us as soon as a fault is discovered, at info@soundcreationsltd.com or +254 715 754 758, quoting your invoice number and a description of the fault.</li>
<li>We will assess the fault and advise on the appropriate remedy. You may be required to return the product to us or provide access for on-site assessment.</li>
<li>Where a claim is valid, the remedy will be repair, replacement or credit at our or the manufacturer discretion, in accordance with the manufacturer warranty.</li>
</ul>
<h2>7. Costs</h2>
<ul>
<li>Valid in-warranty repairs or replacements are carried out at no charge for the parts and labour covered by the warranty.</li>
<li>Transport, shipping, site attendance, or diagnosis of faults found not to be covered by the warranty may be chargeable. We will advise of any charges before proceeding.</li>
</ul>
<h2>8. Out-of-warranty support</h2>
<p>Sound Creations offers preventive maintenance, service contracts, genuine spare parts, operator training and technical support beyond the warranty period. Please contact us to discuss a support plan tailored to your systems.</p>
<h2>9. Statutory rights and limitation</h2>
<p>This warranty is provided in addition to, and does not affect, any statutory rights you may have under applicable law. To the extent permitted by law, our liability under this warranty is limited to the repair, replacement or credit of the affected product or workmanship as set out above.</p>
<h2>10. Contact</h2>
<p>Sound Creations Ltd, Mpaka Plaza, Mpaka Road, Westlands, Nairobi, Kenya — info@soundcreationsltd.com — +254 715 754 758.</p>
HTML;

	return array(
		array( 'About', 'about', 'Sound Creations is a professional audio, acoustics, distribution and integration company serving East Africa from Nairobi. [CONTENT TO BE CONFIRMED]' ),
		array( 'FANE', 'fane', 'FANE professional loudspeaker components. Sound Creations is developing the FANE dealer ecosystem across East Africa. [CONTENT TO BE CONFIRMED]' ),
		array( 'Distribution and Dealership', 'distribution', 'Sound Creations is a regional distribution and market-development partner. [CONTENT TO BE CONFIRMED]' ),
		array( 'Support', 'support', 'Technical support, product training and after-sales service. [CONTENT TO BE CONFIRMED]' ),
		array( 'Contact', 'contact', 'Talk to our technical team about your project. [CONTENT TO BE CONFIRMED]' ),
		array( 'Request a Consultation', 'request-a-consultation', 'Tell us about your space and application and our technical team will help you specify the right system. [CONTENT TO BE CONFIRMED]' ),
		array( 'Become a Dealer', 'become-a-dealer', 'Partner with Sound Creations across East Africa. [CONTENT TO BE CONFIRMED]' ),
		array( 'Request a Quote', 'request-a-quote', 'Request pricing and availability from a specialist. [CONTENT TO BE CONFIRMED]' ),
		array( 'Privacy Policy', 'privacy-policy', $privacy ),
		array( 'Terms and Conditions', 'terms', $terms ),
		array( 'Warranty', 'warranty', $warranty ),
		array( 'Cookie Policy', 'cookie-policy', 'Cookie policy. [CONTENT TO BE CONFIRMED - legal review required before publication]' ),
	);
}

function sc_core_starter_solutions() {
	return array(
		array( 'Professional Audio', 'professional-audio', 'Loudspeaker systems, subwoofers, amplification, DSP, mixing, microphones and wireless - designed, supplied and tuned. [CONTENT TO BE CONFIRMED]' ),
		array( 'Acoustics', 'acoustics', 'Acoustics as an engineering discipline: measure, analyze, design, treat and verify. [CONTENT TO BE CONFIRMED]' ),
		array( 'Conferencing', 'conferencing', 'Boardrooms, hybrid meetings and collaboration spaces engineered for clarity and reliability. [CONTENT TO BE CONFIRMED]' ),
		array( 'System Integration', 'system-integration', 'Supply, installation, commissioning, calibration and project management under one technical team. [CONTENT TO BE CONFIRMED]' ),
		array( 'Lighting', 'lighting', 'Stage, architectural, entertainment and lighting-control systems - designed, supplied, installed and programmed. [CONTENT TO BE CONFIRMED]' ),
		array( 'Video and Displays', 'video-displays', 'LED video walls, professional displays, projection and digital signage for live, corporate and commercial spaces. [CONTENT TO BE CONFIRMED]' ),
		array( 'Broadcast and Recording', 'broadcast-recording', 'Broadcast audio, recording and studio systems - specified, integrated and commissioned to professional standards. [CONTENT TO BE CONFIRMED]' ),
		array( 'Consultation and Design', 'consultation-design', 'Technical consultation, site assessment, system design and specification. [CONTENT TO BE CONFIRMED]' ),
		array( 'Installation', 'installation', 'Professional installation and commissioning by our technical team. [CONTENT TO BE CONFIRMED]' ),
		array( 'Support and Training', 'support-training', 'Technical support, product training and after-sales service. [CONTENT TO BE CONFIRMED]' ),
	);
}

/**
 * Create the core pages, sample solutions and primary menu. Idempotent. Returns a report.
 */
function sc_core_run_starter_setup() {
	$report   = array( 'pages' => 0, 'solutions' => 0, 'menu' => false );
	$page_ids = array();

	foreach ( sc_core_starter_pages() as $pg ) {
		list( $title, $slug, $content ) = $pg;
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $existing ) {
			$page_ids[ $slug ] = (int) $existing->ID;
			$sc_ph = ( false !== strpos( (string) $existing->post_content, '[CONTENT TO BE CONFIRMED' ) );
			if ( $sc_ph && $content !== $existing->post_content ) {
				wp_update_post(
					array(
						'ID'           => $existing->ID,
						'post_content' => $content,
					)
				);
				$report['pages']++;
			}
			continue;
		}
		$page_ids[ $slug ] = (int) wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			)
		);
		$report['pages']++;
	}

	sc_core_ensure_home_front();

	foreach ( sc_core_starter_solutions() as $sol ) {
		list( $title, $slug, $content ) = $sol;
		if ( get_page_by_path( $slug, OBJECT, 'sc_solution' ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'sc_solution',
			)
		);
		$report['solutions']++;
	}

	$menu = wp_get_nav_menu_object( 'Primary' );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( 'Primary' );
		$items   = array(
			array( 'Solutions', get_post_type_archive_link( 'sc_solution' ), 'custom' ),
			array( 'Products', get_post_type_archive_link( 'sc_product' ), 'custom' ),
			array( 'Brands', get_post_type_archive_link( 'sc_brand' ), 'custom' ),
			array( 'Projects', get_post_type_archive_link( 'sc_project' ), 'custom' ),
			array( 'FANE', '', 'fane' ),
			array( 'About', '', 'about' ),
			array( 'Resources', get_post_type_archive_link( 'sc_resource' ), 'custom' ),
			array( 'Support', '', 'support' ),
			array( 'Contact', '', 'contact' ),
		);
		foreach ( $items as $it ) {
			list( $label, $url, $type ) = $it;
			if ( 'custom' === $type ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => $label,
						'menu-item-url'    => $url ? $url : home_url( '/' ),
						'menu-item-status' => 'publish',
						'menu-item-type'   => 'custom',
					)
				);
			} else {
				$pid = isset( $page_ids[ $type ] ) ? $page_ids[ $type ] : 0;
				if ( $pid ) {
					wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-title'     => $label,
							'menu-item-object'    => 'page',
							'menu-item-object-id' => $pid,
							'menu-item-type'      => 'post_type',
							'menu-item-status'    => 'publish',
						)
					);
				}
			}
		}
		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
		$report['menu'] = true;
	}

	return $report;
}

add_action(
	'admin_menu',
	function () {
		add_submenu_page( 'sc-settings', 'Starter Setup', 'Starter Setup', 'manage_options', 'sc-starter', 'sc_core_render_starter_page' );
	}
);

function sc_core_render_starter_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$done = isset( $_GET['sc_done'] ) ? absint( $_GET['sc_done'] ) : 0;
	?>
	<div class="wrap">
		<h1>Sound Creations - Starter Setup</h1>
		<p>Creates the core pages, seven sample Solutions and the primary navigation menu so the site is fully navigable. Safe to run more than once - existing items are skipped.</p>
		<?php if ( $done ) : ?>
			<div class="notice notice-success"><p>Starter setup complete. If any link shows 404, go to Settings -> Permalinks and click Save Changes once.</p></div>
		<?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="sc_core_starter_setup">
			<?php wp_nonce_field( 'sc_core_starter_setup' ); ?>
			<?php submit_button( 'Create starter pages and menu' ); ?>
		</form>
	</div>
	<?php
}

add_action(
	'admin_post_sc_core_starter_setup',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Insufficient permissions.' );
		}
		check_admin_referer( 'sc_core_starter_setup' );
		sc_core_run_starter_setup();
		wp_safe_redirect( admin_url( 'admin.php?page=sc-starter&sc_done=1' ) );
		exit;
	}
);

/**
 * Ensure a Home page exists and is set as the static front page.
 * The theme's front-page.php provides the design; content is edited under
 * Sound Creations -> Settings (Homepage section). Returns the Home page ID.
 */
function sc_core_ensure_home_front() {
	$home = get_page_by_path( 'home', OBJECT, 'page' );
	if ( $home ) {
		$home_id = (int) $home->ID;
	} else {
		$home_id = (int) wp_insert_post(
			array(
				'post_title'   => 'Home',
				'post_name'    => 'home',
				'post_content' => 'This page powers your homepage layout. Edit the homepage text and images under Sound Creations -> Settings (Homepage section).',
				'post_status'  => 'publish',
				'post_type'    => 'page',
			)
		);
	}
	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}
	return $home_id;
}

/**
 * One-time, non-destructive: set the static front page automatically after the
 * plugin is installed/updated. Skips silently if the admin has already chosen a
 * static front page, and never runs more than once.
 */
add_action(
	'admin_init',
	function () {
		if ( get_option( 'sc_core_home_set' ) ) {
			return;
		}
		if ( 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) > 0 ) {
			update_option( 'sc_core_home_set', 1 );
			return;
		}
		sc_core_ensure_home_front();
		update_option( 'sc_core_home_set', 1 );
	},
	5
);


/**
 * Ensure the legal / core pages exist even when the full Starter Setup was never run.
 * Idempotent: only creates a page whose slug is missing. Returns the number created.
 */
function sc_core_ensure_core_pages() {
	$slugs   = array( 'privacy-policy', 'terms', 'warranty', 'cookie-policy' );
	$created = 0;
	foreach ( sc_core_starter_pages() as $pg ) {
		list( $title, $slug, $content ) = $pg;
		if ( ! in_array( $slug, $slugs, true ) ) {
			continue;
		}
		if ( get_page_by_path( $slug, OBJECT, 'page' ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			)
		);
		$created++;
	}
	return $created;
}
