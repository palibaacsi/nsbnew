<?php
	/*-----------------------------------------------------------------------------------*/
	/* This file will be referenced every time a template/page loads on your Wordpress site
	/* This is the place to define custom fxns and specialty code
	/*-----------------------------------------------------------------------------------*/

// Define the version so we can easily replace it throughout the theme
define( 'NAKED_VERSION', 1.0 );

/**
 * Per Theme Check plugin, needed to add
 *
 *  Set up the content width value based on the theme's design.
 * 
 * @see twentyfourteen_content_width()
 *
 */

if ( ! isset( $content_width ) )
    $content_width = 640;
 
function mytheme_adjust_content_width() {
    global $content_width;
 
    if ( is_page_template( 'full-width.php' ) )
        $content_width = 840;
}
add_action( 'template_redirect', 'mytheme_adjust_content_width' );


/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'header'	=>	__( 'Header Menu', 'naked' ), // Register the Header menu
		'primary'	=>	__( 'Primary Menu', 'naked' ), // Register the Primary menu
		'footer'	=>	__( 'Footer Menu', 'naked' ), // Register the Footer menu
		// Copy and paste the line above right here if you want to make another menu, 
		// just change the name, as in 'primary', to another name
	)
);

/*-----------------------------------------------------------------------------------*/
/* Activate sidebars for Wordpress use
/*-----------------------------------------------------------------------------------*/
function naked_register_sidebars() {
	register_sidebar(array(				// Start a series of sidebars to register
		'id' => 'sidebar', 					// Make an ID
		'name' => 'Sidebar',				// Name it
		'description' => 'Take it on the side...', // Dumb description for the admin side
		'before_widget' => '<div>',	// What to display before each widget
		'after_widget' => '</div>',	// What to display following each widget
		'before_title' => '<h3 class="side-title">',	// What to display before each widget's title
		'after_title' => '</h3>',		// What to display following each widget's title
		'empty_title'=> '',					// What to display in the case of no title defined for a widget
		// Copy and paste the lines above right here if you want to make another sidebar, 
		// just change the values of id and name to another word/name
	));
	register_sidebar(array(			
		'id' => 'home-products',
		'name' => 'Product Slider',
		'description' => 'This is the widget area for the product image rotator', 
		'before_widget' => '<div>',	
		'after_widget' => '</div>',	
		'before_title' => '<h3 class="side-title">',
		'after_title' => '</h3>',	
		'empty_title'=> '',			
	));
	register_sidebar(array(			
		'id' => 'footer-left', 		
		'name' => 'Left Footer',	
		'description' => 'Take it on the side...', 
		'before_widget' => '<div>',	
		'after_widget' => '</div>',	
		'before_title' => '<h3 class="side-title">',
		'after_title' => '</h3>',	
		'empty_title'=> '',			
	));
	register_sidebar(array(			
		'id' => 'footer-right', 	
		'name' => 'Right Footer',	
		'description' => 'Take it on the side...', 
		'before_widget' => '<div>',	
		'after_widget' => '</div>',	
		'before_title' => '<h3 class="side-title">',
		'after_title' => '</h3>',	
		'empty_title'=> '',			
	));
	register_sidebar(array(			
		'id' => 'footer-bottom', 	
		'name' => 'Bottom Footer',	
		'description' => 'This area will be at the bottom of every page', 
		'before_widget' => '<div>',	
		'after_widget' => '</div>',	
		'before_title' => '<h3 class="side-title">',
		'after_title' => '</h3>',	
		'empty_title'=> '',			
	));
} 
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'naked_register_sidebars' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function naked_scripts()  { 

	wp_enqueue_style( 'nsb-style', get_template_directory_uri() . '/inc/styles/nsb-main.css', '10000', 'all' );
	wp_enqueue_style( 'nsb-hover', get_template_directory_uri() . '/inc/styles/nsb-hover.css', '10000', 'all' );
	wp_enqueue_style( 'nsb-responsive', get_template_directory_uri() . '/inc/styles/nsb-responsive.css', '10000', 'all' );

	// get the theme directory style.css and link to it in the header
	wp_enqueue_style( 'naked-style', get_template_directory_uri() . '/style.css', '10000', 'all' );
			
	// add fitvid
	wp_enqueue_script( 'naked-fitvid', get_template_directory_uri() . '/inc/js/jquery.fitvids.js', array( 'jquery' ), NAKED_VERSION, true );
	
	// add theme scripts
	wp_enqueue_script( 'naked', get_template_directory_uri() . '/inc/js/theme.min.js', array(), NAKED_VERSION, true );
  
}
add_action( 'wp_enqueue_scripts', 'naked_scripts' ); // Register this fxn and allow Wordpress to call it automatcally in the header

/*-----------------------------------------------------------------------------------*/
/* Extend the default WordPress body classes.
/*-----------------------------------------------------------------------------------*/

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {

/*	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}
*/
	if ( ( ! is_active_sidebar( 'sidebar' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'footer-bottom' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Implement the Custom Addons.
/*-----------------------------------------------------------------------------------*/

// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


