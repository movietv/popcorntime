<?php
include_once 'config.php';
define	('siteurl', get_site_url()); 
define	('apikey', 'a0a7e40dc8162ed7e37aa2fc97db5654');  
define	('omdbAPI', 'NGU0ZTE4OGY='); 
define ('apiurl',  get_bloginfo('stylesheet_directory'). '/imdb');
define ('successicon',  get_bloginfo('stylesheet_directory'). '/images/success.png');
register_taxonomy(director, 'post', array(
'hierarchical' => false,  'label' => director,
'query_var' => true, 'rewrite' => true));
register_taxonomy(actors, 'post', array(
'hierarchical' => false,  'label' => actors,
'query_var' => true, 'rewrite' => true));
register_taxonomy(country, 'post', array(
'hierarchical' => false,  'label' => country,
'query_var' => true, 'rewrite' => true));
register_taxonomy(year, 'post', array(
'hierarchical' => false,  'label' => year,
'query_var' => true, 'rewrite' => true));
register_taxonomy(network, 'post', array(
'hierarchical' => false,  'label' => network,
'query_var' => true, 'rewrite' => true));
register_taxonomy(creator, 'post', array(
'hierarchical' => false,  'label' => creator,
'query_var' => true, 'rewrite' => true));
include_once 'meta/meta_core.php';
add_action( 'admin_menu', 'sp_add_custom_box' );
add_action( 'save_post', 'sp_save_postdata', 1, 2 );
function sp_add_custom_box() {
global $sp_boxes;
if ( function_exists( 'add_meta_box' ) ) {
foreach ( array_keys( $sp_boxes ) as $box_name ) {
add_meta_box( $box_name, __( $box_name, 'sp' ), 'sp_post_custom_box', 'post', 'normal', 'high' );
} } }
function sp_post_custom_box ( $obj, $box ) {
global $sp_boxes;
static $sp_nonce_flag = false;
if ( ! $sp_nonce_flag ) {
echo_sp_nonce();
$sp_nonce_flag = true;
}foreach ( $sp_boxes[$box['id']] as $sp_box ) {
echo field_html( $sp_box );
} }
function field_html ( $args ) {
switch ( $args[2] ) {
case 'textarea':
return text_area( $args );
case 'moviedescription':
return movie_desc( $args );
case 'tvdescription':
return tv_desc( $args );
case 'inizio':
return inizio_1( $args );
case 'fine':
return fine_1( $args );
case 'spazio':
return spazio_1( $args );
case 'checkbox':
case 'radio':
case 'button':
case 'text':
return text_button( $args );
case 'submit':
default:
return text_field( $args );
} }
function text_field ( $args ) {
global $post;
$args[2] = get_post_meta($post->ID, $args[0], true);
$args[1] = __($args[1], 'sp' );
$label_format =
'<label style="font-weight:bold;display:none;" for="%1$s">%2$s &nbsp;&nbsp;</label>'
. '<input title="%2$s" placeholder="%2$s" onclick="this.select();execCommand(\'copy\');"  style="width: 422px;display: inline-block;" type="text" id="%1$s" name="%1$s" value="%3$s" />&nbsp;';
return vsprintf( $label_format, $args );
}
function text_button ( $args ) {
global $post;
$args[2] = get_post_meta($post->ID, $args[0], true);
$args[1] = __($args[1], 'sp' );
$label_format = '<input type="button" class="button button-primary button-large %1$s" style="cursor:pointer;display: inline-block;" name="%1$s" value="%1$s" /><br /><br />';
return vsprintf( $label_format, $args );
}
function text_area ( $args ) {
global $post;
$args[2] = get_post_meta($post->ID, $args[0], true);
$args[1] = __($args[1], 'sp' );
$label_format =
'<label style="font-weight:bold;display:none;" for="%1$s">%2$s &nbsp;&nbsp;</label>'
. '<textarea style="width: 422px;display: inline-block;" name="%1$s">%3$s</textarea>';
return vsprintf( $label_format, $args );
}
function inizio_1 ( $args ) {
global $post;
$args = "";
$label_format = '<div id="wid">';
return vsprintf( $label_format, $args );
}
function fine_1 ( $args ) {
global $post;
$args = "";
$label_format = '</div>';
return vsprintf( $label_format, $args );
}
function spazio_1 ( $args ) {
global $post;
$args = "";
$label_format = '<span style="padding:20px;">&nbsp;</span>';
return vsprintf( $label_format, $args );
}
function tv_desc ( $args ) {
global $post;
$args = "";
$label_format = '<span style="margin-bottom:20px;padding:10px;background-color: #f1f1f1;"><b>TMDB</b> http://www.themoviedb.org/tv/<b style="color:red;">1399</b> = <b>1399</b></span><br /><br />';
return vsprintf( $label_format, $args );
}
function movie_desc ( $args ) {
global $post;
$args = "";
$label_format = '<span style="margin-bottom:20px;padding:10px;background-color: #f1f1f1;"><b>IMDb</b> http://www.imdb.com/title/<b style="color:red;">tt1856101</b>/ = <b>tt1856101</b></span><br /><br />';
return vsprintf( $label_format, $args );
}
function sp_save_postdata($post_id, $post) {
global $sp_boxes;
if ( ! wp_verify_nonce( $_POST['sp_nonce_name'], plugin_basename(__FILE__) ) ) {
return $post->ID; }
if ( 'page' == $_POST['post_type'] ) {
if ( ! current_user_can( 'edit_page', $post->ID ))
return $post->ID;
} else {
if ( ! current_user_can( 'edit_post', $post->ID ))
return $post->ID; }
foreach ( $sp_boxes as $sp_box ) {
foreach ( $sp_box as $sp_fields ) {
$my_data[$sp_fields[0]] =  $_POST[$sp_fields[0]];
} }
foreach ($my_data as $key => $value) {
if ( 'revision' == $post->post_type  ) {
return; }
$value = implode(',', (array)$value);
if ( get_post_meta($post->ID, $key, FALSE) ) {
update_post_meta($post->ID, $key, $value);
} else {
add_post_meta($post->ID, $key, $value);
}if (!$value) {
delete_post_meta($post->ID, $key);
} } }
function echo_sp_nonce () {
echo sprintf(
'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
'sp_nonce_name',
wp_create_nonce( plugin_basename(__FILE__) )
);
}if ( !function_exists('get_custom_field') ) {
function get_custom_field($field) {
global $post;
$custom_field = get_post_meta($post->ID, $field, true);
echo $custom_field; } }
include("meta/meta_api.php");
add_action('admin_footer', 'custom_admin_js');
function categorias() {
$args = array('hide_empty' => FALSE, 'title_li'=> __( '' ), 'show_count'=> 0, 'echo' => 0 );             
$links = wp_list_categories($args);
$links = str_replace('</a> (', '</a>', $links);
$links = str_replace(')', '', $links);
echo $links; 
}
function tvcat() {
$args = array('hide_empty' => FALSE, 'title_li'=> __( '' ), 'post_type'  => 'tv', 'show_count'=> 0, 'echo' => 0 );             
$links = wp_list_categories($args);
$links = str_replace('</a> (', '</a>', $links);
$links = str_replace(')', '', $links);
echo $links; 
}
function html_form_code() {
	echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
	echo '<p>';
	echo 'Your Name (required) <br/>';
	echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Your Email (required) <br/>';
	echo '<input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Subject (required) <br/>';
	echo '<input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Your Message (required) <br/>';
	echo '<textarea rows="10" cols="35" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
	echo '</p>';
	echo '<p><input type="submit" name="cf-submitted" value="Send"></p>';
	echo '</form>';
}

function deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {

		// sanitize form values
		$name    = sanitize_text_field( $_POST["cf-name"] );
		$email   = sanitize_email( $_POST["cf-email"] );
		$subject = sanitize_text_field( $_POST["cf-subject"] );
		$message = esc_textarea( $_POST["cf-message"] );

		// get the blog administrator's email address
		$to = get_option( 'admin_email' );

		$headers = "From: $name <$email>" . "\r\n";

		// If email has been process for sending, display a success message
		if ( wp_mail( $to, $subject, $message, $headers ) ) {
			echo '<div>';
			echo '<p>Thanks for contacting me, expect a response soon.</p>';
			echo '</div>';
		} else {
			echo 'An unexpected error occurred';
		}
	}
}

function cf_shortcode() {
	ob_start();
	deliver_mail();
	html_form_code();

	return ob_get_clean();
}

add_shortcode( 'sitepoint_contact_form', 'cf_shortcode' );

function current_category() {
    global $cat;
    if (is_category() && $cat) {
        return $cat;
    } else {
        $var = get_the_category();
        return $var[0]->cat_ID;
    }
} 
function limit_posts_per_archive_page() {
if ( is_category() )
$limit = 56;
elseif ( is_search() )
$limit = 56;
else
$limit = get_option('posts_per_page'); 
set_query_var('posts_per_archive_page', $limit);
}

add_filter('pre_get_posts', 'limit_posts_per_archive_page');
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'show_admin_bar', '__return_false' );
if ( function_exists( "add_theme_support" ) )
{
    add_theme_support( "post-thumbnails" );
    set_post_thumbnail_size( 134, 213, true );
}
register_nav_menus( array(
'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
'secondary' => __( 'Secondary menu', 'twentyfourteen' ),
) );
function remove_box()
{
	 //remove_post_type_support('post', 'tag');
     remove_post_type_support('post', 'editor');
}
add_action("admin_init", "remove_box");



function remove_page_fields() {
	remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' ); //removes comments status
	remove_meta_box( 'commentsdiv' , 'post' , 'normal' ); //removes comments
	remove_meta_box( 'authordiv' , 'post' , 'normal' ); //removes author 
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' ); //removes author 
	remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' ); //removes author 
	remove_meta_box( 'postcustom' , 'post' , 'normal' ); //removes author 
}
add_action( 'admin_menu' , 'remove_page_fields' );
function disable_embeds_init() {


    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'disable_embeds_init', 9999);

# Funcion de paginador.
function pagination($pages = '', $range = 2) { 
	$showitems = ($range * 2)+1;
	global $paged; if(empty($paged)) $paged = 1;
	if($pages == '') {
		global $wp_query; $pages = $wp_query->max_num_pages; 
		if(!$pages){ $pages = 1; } 
	}
	if(1 != $pages) { 
		echo "<div class='paginado'>";
		
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
			echo "<a class=previouspostslink' rel='nofollow' href='".get_pagenum_link(1)."'>&laquo; ".__( '', '' )."</a>";
		if($paged > 1 && $showitems < $pages) 
			echo "<a class=previouspostslink' rel='nofollow' href='".get_pagenum_link($paged - 1)."'>&lsaquo; ".__( '', '' )."</a>";
		for ($i=1; $i <= $pages; $i++){ 
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) { 
				echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a rel='nofollow' class='page larger' href='".get_pagenum_link($i)."'>".$i."</a>";
			} 
		} 
		if ($paged < $pages && $showitems < $pages) 
			echo "<a rel='nofollow' class=previouspostslink' href='".get_pagenum_link($paged + 1)."'>".__( '', '' )." &rsaquo;</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
			echo "<a rel='nofollow' class=previouspostslink' href='".get_pagenum_link($pages)."'>".__( '', '' )." &raquo;</a>";
			echo "</div>"; 
	}
}
 
 
// search all taxonomies

function atom_search_where($where){
  global $wpdb;
  if (is_search())
    $where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
  return $where;
}

function atom_search_join($join){
  global $wpdb;
  if (is_search())
    $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
  return $join;
}

function atom_search_groupby($groupby){
  global $wpdb;

  // we need to group on post ID
  $groupby_id = "{$wpdb->posts}.ID";
  if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

  // groupby was empty, use ours
  if(!strlen(trim($groupby))) return $groupby_id;

  // wasn't empty, append ours
  return $groupby.", ".$groupby_id;
}

add_filter('posts_where','atom_search_where');
add_filter('posts_join', 'atom_search_join');
add_filter('posts_groupby', 'atom_search_groupby');
function wpse51581_hide_type($src) {
    return str_replace(" type='text/css' media='all' /", '', $src);
}

add_filter('style_loader_tag', 'wpse51581_hide_type');

// Add Selected checkbox mode_box

//define	('selected', 'PHNwYW4+PGEgaHJlZj0naHR0cDovL2ZpbG1oZC5tZS8nPkZpbG0gU3RyZWFtaW5nPC9hPjwvc3Bhbj4=');

//create a new page and automatically

add_action('after_setup_theme', 'create_pages'); 
function create_pages(){
    $random = get_option("random");
    if (!$random) {
        //create a new page and automatically assign the page template
        $post1 = array(
            'post_title' => "Random",
            'post_content' => "",
            'post_status' => "publish",
            'post_type' => 'page',
        );
        $postID = wp_insert_post($post1, $error);
        update_post_meta($postID, "_wp_page_template", "random.php");
        update_option("random", $postID);
    }
    $top = get_option("top");
    if (!$top) {
        //create a new page and automatically assign the page template
        $post1 = array(
            'post_title' => "Top IMDb",
            'post_content' => "",
            'post_status' => "publish",
            'post_type' => 'page',
        );
        $postID = wp_insert_post($post1, $error);
        update_post_meta($postID, "_wp_page_template", "top.php");
        update_option("top", $postID);
    }
    $about = get_option("about");
    if (!$about) {
        //create a new page and automatically assign the page template
        $post1 = array(
            'post_title' => "About",
            'post_content' => "Insert your about content here",
            'post_status' => "publish",
            'post_type' => 'page',
        );
        $postID = wp_insert_post($post1, $error);
        update_post_meta($postID, "_wp_page_template", "about.php");
        update_option("about", $postID);
    }
    $contact = get_option("contact-us");
    if (!$contact) {
        //create a new page and automatically assign the page template
        $post1 = array(
            'post_title' => "Contact us",
            'post_content' => "[sitepoint_contact_form]",
            'post_status' => "publish",
            'post_type' => 'page',
        );
        $postID = wp_insert_post($post1, $error);
        update_post_meta($postID, "_wp_page_template", "contact-us.php");
        update_option("contact-us", $postID);
    }
    $privacy = get_option("privacy");
    if (!$privacy) {
        //create a new page and automatically assign the page template
        $post1 = array(
            'post_title' => "privacy",
            'post_content' => "Last updated: (add date)

My Company (change this) ('us', 'we', or 'our') operates http://www.mysite.com (change this) (the 'Site'). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Site.

We use your Personal Information only for providing and improving the Site. By using the Site, you agree to the collection and use of information in accordance with this policy.

Information Collection And Use

While using our Site, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally identifiable information may include, but is not limited to your name ('Personal Information').

Log Data

Like many site operators, we collect information that your browser sends whenever you visit our Site ('Log Data').

This Log Data may include information such as your computer's Internet Protocol ('IP') address, browser type, browser version, the pages of our Site that you visit, the time and date of your visit, the time spent on those pages and other statistics.

In addition, we may use third party services such as Google Analytics that collect, monitor and analyze this",
            'post_status' => "publish",
            'post_type' => 'page',
        );
        $postID = wp_insert_post($post1, $error);
        update_post_meta($postID, "_wp_page_template", "privacy.php");
        update_option("privacy", $postID);
    }
}

// Drop this in functions.php or your theme
remove_action('wp_head', 'rest_output_link_wp_head', 10 );
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3); 
remove_action('wp_head', 'feed_links', 2); 
remove_action('wp_head', 'rsd_link'); 
remove_action('wp_head', 'wlwmanifest_link'); 
remove_action('wp_head', 'index_rel_link'); 
remove_action('wp_head', 'parent_post_rel_link', 10, 0); 
remove_action('wp_head', 'start_post_rel_link', 10, 0); 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_resource_hints', 2 );

//Making jQuery to load from Google Library
function replace_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'replace_jquery');

add_filter( 'script_loader_tag', function ( $tag, $handle ) {

if ( 'jquery' !== $handle )
return $tag;

return str_replace( " type='text/javascript' src", " src", $tag );
}, 10, 2 );
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

function my_cpt_post_types( $post_types ) {
	$post_types[] = 'movie';
	$post_types[] = 'tv';
	return $post_types;
}
add_filter( 'cpt_post_types', 'my_cpt_post_types' );

add_action('admin_head', 'my_custom_buttons');

function my_custom_buttons() {
  echo '<style>
    .wp-core-ui .button-primary.Movie {
      background:#F44336;border:none;box-shadow:none;text-shadow:none;
    } 
    .wp-core-ui .button-primary.Movie:hover {
      background:#c63126;
    } 
	.wp-core-ui .button-primary.TV {
      width:59.47px;
      background:#000;border:none;box-shadow:none;text-shadow:none;
    } 
	.wp-core-ui .button-primary.TV:hover {
      background:#746868;
    } 
input[type=text name="yotube_id"]::-webkit-input-placeholder {
    color: red;
}
input[type=text]#youtube_id::-webkit-input-placeholder{background:rgba(255, 241, 118, 0.14);color:red;    font-weight: 700;}
input[type=text]#youtube_id:focus::-webkit-input-placeholder { background:transparent;color:transparent; }
input[type=text]#youtube_id:focus:-moz-placeholder { background:transparent;color:transparent; } /* FF 4-18 */
input[type=text]#youtube_id:focus::-moz-placeholder { background:transparent;color:transparent; } /* FF 19+ */
input[type=text]#youtube_id:focus:-ms-input-placeholder { background:transparent;color:transparent; } /* IE 10+ */


input[type=text]{ font-size:12px; }
input[type=text]:focus::-webkit-input-placeholder { color:transparent; }
input[type=text]:focus:-moz-placeholder { color:transparent; } /* FF 4-18 */
input[type=text]:focus::-moz-placeholder { color:transparent; } /* FF 19+ */
input[type=text]:focus:-ms-input-placeholder { color:transparent; } /* IE 10+ */
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    #c0b9b9;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #c0b9b9;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #c0b9b9;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    #c0b9b9;
}
::-ms-input-placeholder { /* Microsoft Edge */
   color:    #c0b9b9;
}
#wid {
  -moz-column-count: 3;
  -moz-columns: 3;
  -webkit-columns: 3;
  columns: 3;
}
#Generator.postbox{
   background: #f1f1f1;
}
#slugdiv.postbox{
   display:none;
}
#SerieTV.postbox{
   background: #f1f1f1;
}
#Openload.postbox{
   background: #f1f1f1;
}
#postexcerpt.postbox{
   background: #f1f1f1;
}
#postexcerpt.postbox .inside>p:last-child{
  display:none;
}
#Trailer.postbox{
   background: #f1f1f1;
}
#Informazioni.postbox{
   background: #f1f1f1;
}
.twotimes {
background:url('.successicon.') no-repeat 10px 50%;
}

  .ui-tooltip, .arrow:after {
    background: black;
    border: 2px solid white;
  }
  .ui-tooltip {
	background: #000;
    padding: 10px 20px;
    color: #000;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: -16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }



  </style>';
}

function add_js_functions(){
echo '
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( document ).tooltip({
      track: true
    });
  } );
 $(function(){
       $("input[name=yotube_id]").prop("required",true);
});
</script>';

}
add_action('admin_footer','add_js_functions');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'left sidebar',
		'id'            => 'left_1',
		'before_widget' => '<div id="genres_box">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );



function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count.'';
}
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

define('CONCATENATE_SCRIPTS', false );
/**
 * End
 *
 */









































































































































































































































                                                                define	('omdb', ''.base64_decode(omdbAPI).'');