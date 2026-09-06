<?php
/**
 * Project archive - owns /projects/. Faithful .sc-proto port of the prototype
 * Projects route: page hero + filters/search bar + project grid + red CTA.
 * Cards are data-driven from published sc_project posts (image, tag, location,
 * summary, permalink) with a prototype-matching fallback set. Filter + search is
 * self-contained client-side JS that matches card text.
 *
 * @package SoundCreations
 */

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}
get_header();

$sc_q = new WP_Query( array( 'post_type' => 'sc_project', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'no_found_rows' => true ) );
$sc_items = array();
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
		if ( has_post_thumbnail( $pid ) ) {
			$img = get_the_post_thumbnail_url( $pid, 'large' );
		} elseif ( strlen( $imgk ) && file_exists( get_theme_file_path( $rel ) ) ) {
			$img = get_theme_file_uri( $rel );
		} else {
			$img = SC_THEME_URI . '/assets/img/projects-hero.jpg';
		}
		$tag = strlen( $badge ) ? $badge : ( strlen( $cat ) ? $cat : ( strlen( $sol ) ? $sol : 'Project' ) );
		if ( strlen( $sum ) === 0 ) {
			$sum = wp_strip_all_tags( get_the_excerpt() );
		}
		$sc_items[] = array( 'title' => get_the_title(), 'href' => get_permalink( $pid ), 'loc' => $loc, 'tag' => $tag, 'sum' => $sum, 'img' => $img );
	}
	wp_reset_postdata();
}
if ( count( $sc_items ) === 0 ) {
	$sc_fb = array(
		array( 'citam-buruburu', 'AUDIO', 'CITAM Buruburu', 'Nairobi, Kenya' ),
		array( 'cathedral', 'ACOUSTIC / AUDIO', 'All Saints Cathedral', 'Nairobi, Kenya' ),
		array( 'pcea-chuka', 'ACOUSTIC', 'PCEA Chuka', 'Chuka, Kenya' ),
		array( 'kabarak-university', 'AUDIO / VISUAL', 'Kabarak University', 'Nakuru, Kenya' ),
		array( 'chapel', 'AUDIO', 'Nairobi Chapel', 'Nairobi, Kenya' ),
		array( 'boardroom', 'AUDIO / VISUAL', 'Corporate Boardroom', 'Kigali, Rwanda' ),
		array( 'conference', 'AUDIO', 'Conference Centre', 'Dubai, UAE' ),
		array( 'performance', 'AUDIO', 'Live Event Production', 'DR Congo' ),
	);
	foreach ( $sc_fb as $f ) {
		$sc_items[] = array( 'title' => $f[2], 'href' => home_url( '/projects/' ), 'loc' => $f[3], 'tag' => $f[1], 'sum' => 'Professional systems engineered for clarity, performance and reliability.', 'img' => SC_THEME_URI . '/assets/img/projects/' . $f[0] . '.jpg' );
	}
}
?>

<div class="sc-proto">

<?php
echo sc_proto_pagehero( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party markup.
	array(
		'title' => sc_setting( 'projects_title', 'Real solutions. Real impact.' ),
		'desc'  => sc_setting( 'projects_lead', 'Explore selected professional audio, acoustic, visual and integration projects delivered across the region.' ),
		'img'   => SC_THEME_URI . '/assets/img/projects-hero.jpg',
	)
);
?>

<section class="section">
	<div class="container">
		<div class="filters">
			<button class="filter active" data-filter="all"><?php esc_html_e( 'All Projects', 'soundcreations' ); ?></button>
			<button class="filter" data-filter="acoustic"><?php esc_html_e( 'Acoustic', 'soundcreations' ); ?></button>
			<button class="filter" data-filter="audio"><?php esc_html_e( 'Audio', 'soundcreations' ); ?></button>
			<button class="filter" data-filter="visual"><?php esc_html_e( 'Visual', 'soundcreations' ); ?></button>
			<input class="search" id="scProjectSearch" placeholder="<?php esc_attr_e( 'Search project, venue or solution...', 'soundcreations' ); ?>">
		</div>
		<div class="sectionhead">
			<h2><?php esc_html_e( 'Featured Projects', 'soundcreations' ); ?></h2>
			<a class="btn secondary" href="<?php echo esc_url( home_url( '/request-a-consultation/' ) ); ?>"><?php esc_html_e( 'Start Your Project', 'soundcreations' ); ?> &rarr;</a>
		</div>
		<div class="projectgrid" id="scProjectGrid">
			<?php foreach ( $sc_items as $it ) : ?>
				<a class="card projectcard" href="<?php echo esc_url( $it['href'] ); ?>"><div class="projectphoto"><img src="<?php echo esc_url( $it['img'] ); ?>" alt="<?php echo esc_attr( $it['title'] ); ?>" loading="lazy" decoding="async"><span class="tag"><?php echo esc_html( strtoupper( $it['tag'] ) ); ?></span></div><div class="projectbody"><?php if ( strlen( $it['loc'] ) ) : ?><span class="location"><?php echo esc_html( $it['loc'] ); ?></span><?php endif; ?><h3><?php echo esc_html( $it['title'] ); ?></h3><?php if ( strlen( $it['sum'] ) ) : ?><p><?php echo esc_html( wp_trim_words( $it['sum'], 18 ) ); ?></p><?php endif; ?><span class="link"><?php esc_html_e( 'View Project', 'soundcreations' ); ?> &rarr;</span></div></a>
			<?php endforeach; ?>
		</div>
		<p id="scProjectEmpty" class="lead" style="display:none;margin-top:24px"><?php esc_html_e( 'No projects match your filters.', 'soundcreations' ); ?></p>
	</div>
</section>

<?php
echo sc_proto_cta( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- first-party markup.
	array(
		'title' => sc_setting( 'projects_cta_title', 'Have a project in mind?' ),
		'text'  => sc_setting( 'projects_cta_text', 'Our team is ready to help you design and deliver the right solution.' ),
	)
);
?>

</div>

<script>
(function(){
	var grid=document.getElementById('scProjectGrid');
	if(grid===null){return;}
	var cards=[].slice.call(grid.querySelectorAll('.projectcard'));
	var filters=[].slice.call(document.querySelectorAll('.sc-proto .filter'));
	var search=document.getElementById('scProjectSearch');
	var empty=document.getElementById('scProjectEmpty');
	var current='all';
	function apply(){
		var q=(search&&search.value?search.value:'').toLowerCase();
		var shown=0;
		cards.forEach(function(c){
			var t=c.innerText.toLowerCase();
			var okCat=(current==='all')||(t.indexOf(current)>-1);
			var okQ=(q==='')||(t.indexOf(q)>-1);
			var on=okCat&&okQ;
			c.style.display=on?'':'none';
			if(on){shown=shown+1;}
		});
		if(empty){empty.style.display=(shown===0)?'block':'none';}
	}
	filters.forEach(function(b){
		b.addEventListener('click',function(){
			filters.forEach(function(x){x.classList.remove('active');});
			b.classList.add('active');
			current=b.getAttribute('data-filter')||'all';
			apply();
		});
	});
	if(search){search.addEventListener('input',apply);}
})();
</script>

<?php
get_footer();
