<?php
/**
 * cpp-tricks functions and definitions
 *
 * @package cpp-tricks
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'cpp_tricks_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cpp_tricks_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cpp-tricks, use a find and replace
	 * to change 'cpp-tricks' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cpp-tricks', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cpp-tricks' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cpp_tricks_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
	add_theme_support('post-thumbnails');
	/*set_post_thumbnail_size( 490, 350 );
	add_image_size( 'single-post-thumbnail', 490, 350 );*/
}
endif; // cpp_tricks_setup
add_action( 'after_setup_theme', 'cpp_tricks_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
/*function cpp_tricks_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cpp-tricks' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}*/
add_action( 'widgets_init', 'cpp_tricks_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cpp_tricks_scripts() {
	wp_enqueue_style( 'cpp-tricks-style', get_stylesheet_uri() );

	wp_enqueue_script( 'cpp-tricks-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'cpp-tricks-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cpp_tricks_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
function Get_Post_Number($postID){
	$temp_query = $wp_query;
	$postNumberQuery = new WP_Query('orderby=date&order=<strong>DESC</strong>&posts_per_page=-1');
	$counter = 1;
	$postCount = 0;
	if($postNumberQuery->have_posts()) :
		while ($postNumberQuery->have_posts()) : $postNumberQuery->the_post();
			if ($postID == get_the_ID()){
				$postCount = $counter;
			} else {
				$counter++;
			}
	endwhile; endif;
	wp_reset_query();
	$wp_query = $temp_query;
	return $postCount;
}
