<?php


function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');


function m803142_setup() {

    add_theme_support( 'post-thumbnails' );


   // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'top'    => __( 'Top Menu', '803142' ),
        'social' => __( 'Social Links Menu', '803142' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    
    /* Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ) );


/*

    // Define and register starter content to showcase the theme on new sites.
   $starter_content = array(
        'widgets' => array(
            // Place three core-defined widgets in the sidebar area.
            'sidebar-1' => array(
                'text_business_info',
                'search',
                'text_about',
            ),

            // Add the core-defined business info widget to the footer 1 area.
            'sidebar-2' => array(
                'text_business_info',
            ),

            // Put two core-defined widgets in the footer 2 area.
            'sidebar-3' => array(
                'text_about',
                'search',
            ),
        ),

        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts' => array(
            'home',
            'about' => array(
                'thumbnail' => '{{image-sandwich}}',
            ),
            'contact' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
            'blog' => array(
                'thumbnail' => '{{image-coffee}}',
            ),
            'homepage-section' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
        ),



        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods' => array(
            'panel_1' => '{{homepage-section}}',
            'panel_2' => '{{about}}',
            'panel_3' => '{{blog}}',
            'panel_4' => '{{contact}}',
        ),

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus' => array(
            // Assign a menu to the "top" location.
            'top' => array(
                'name' => __( 'Top Menu', 'twentyseventeen' ),
                'items' => array(
                    'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ),
            ),

            // Assign a menu to the "social" location.
            'social' => array(
                'name' => __( 'Social Links Menu', 'twentyseventeen' ),
                'items' => array(
                    'link_yelp',
                    'link_facebook',
                    'link_twitter',
                    'link_instagram',
                    'link_email',
                ),
            ),
        ),
    );

   
     * Filters Twenty Seventeen array of starter content.
     *
     * @since Twenty Seventeen 1.1
     *
     * @param array $starter_content Array of starter content.
     
    $starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

    add_theme_support( 'starter-content', $starter_content ); */
}
add_action( 'after_setup_theme', 'm803142_setup' );
 
add_filter( 'the_content', 'my_the_content_filter' );
function my_the_content_filter( $content ){
   
    return str_replace("img class=\"", "img class=\"img-responsive ", $content);
    
}
function add_image_class($class){
    if( $GLOBALS['post']->post_name != 'blog' )
        return '';

    $class .= ' card-img-top';
    return $class;
}
add_filter('get_image_tag_class','add_image_class');
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function m803142_excerpt_more( $link ) {
    if ( is_admin() ) {
        return $link;
    }

    $link = sprintf( '<p class="link-more"><a href="%1$s" class="btn btn-primary">%2$s</a></p>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '803142' ), get_the_title( get_the_ID() ) )
    );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'm803142_excerpt_more' );

// Bootstrap Styles
if (!is_admin()) {

	// Load CSS
	add_action('wp_enqueue_scripts', 'twbs_load_styles', 11);
	function twbs_load_styles() {
		// Bootstrap
		wp_register_style('bootstrap-styles',  get_theme_file_uri('/assets/css/bootstrap.min.css'), array(), null, 'all');
		wp_enqueue_style('bootstrap-styles');
		// Theme Styles
		wp_register_style('theme-styles', get_stylesheet_uri(), array(), null, 'all');
		wp_enqueue_style('theme-styles');
		// Font Awesome
		wp_register_style('font-awesome',  get_theme_file_uri('/assets/css/font-awesome.min.css'), array(), null, 'all');
		wp_enqueue_style('font-awesome');
	}

	// Load Javascript
	add_action('wp_enqueue_scripts', 'twbs_load_scripts', 12);
	function twbs_load_scripts() {
		// Tether
        wp_register_script('tether',  get_theme_file_uri('/assets/js/tether.min.js'), array(), null, false);
        wp_enqueue_script('tether');
        // jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery',  get_theme_file_uri('/assets/js/jquery.min.js'), array(), null, false);
		wp_enqueue_script('jquery');
	
        // Bootstrap

		wp_register_script('bootstrap-scripts', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), null, false);
		wp_enqueue_script('bootstrap-scripts');

    }

} // end if !is_admin
/* */


require_once('/wp_bootstrap_navwalker.php');
function theme_setup() {
    register_nav_menu( 'Primary', __( 'Primary' ) );
}
add_action( 'init', 'theme_setup' );
 
if ( ! is_nav_menu( 'Primary' ) ) {
    $menu_id = wp_create_nav_menu( 'Primary' );
    wp_update_nav_menu_item( $menu_id, 1 );
}


function bootstrap_embed( $html, $url, $attr ) {
	if ( ! is_admin() ) {
		return "<div class=\"embed-responsive embed-responsive-16by9\">" . $html . "</div>";
	} else {
		return $html;
	}
}
add_filter( 'embed_oembed_html', 'bootstrap_embed', 10, 3 );
/* 
 * Изменение вывода галереи через шоткод 
 * Смотреть функцию gallery_shortcode в http://wp-kama.ru/filecode/wp-includes/media.php
 * $output = apply_filters( 'post_gallery', '', $attr );
 */

add_filter('post_gallery', 'my_gallery_output', 10, 2);
function my_gallery_output( $output, $attr ){
    $ids_arr = explode(',', $attr['ids']);
    $ids_arr = array_map('trim', $ids_arr );

    $pictures = get_posts( array(
        'posts_per_page' => -1,
        'post__in'       => $ids_arr,
        'post_type'      => 'attachment',
        'orderby'        => 'post__in',
    ) );

    if( ! $pictures ) return 'Запрос вернул пустой результат.';

    // Вывод
    $out = '<div id="carousel-example-generic" class="carousel slide " data-ride="carousel" data-interval=false >
            <div class="carousel-inner " role="listbox">';
    $fst=1;
    // Выводим каждую картинку из галереи
    foreach( $pictures as $pic ){
        $src = $pic->guid;
        $t = esc_attr( $pic->post_title );
        $title = ( $t && false === strpos($src, $t)  ) ? $t : '';
        $active = ($fst==1)?' active':'';
        $fst=0;
        $caption = ( $pic->post_excerpt != '' ? $pic->post_excerpt : $title );

        $out .= '<div class="item text-center'.$active.'">
            <img class="" src="'.$src.'" alt="'. $title .'" />'. '</div>';
    
    }

    $out .= '</div>  
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
     </div>';

    return $out;
}

