<?php
/**
 * The Keynote functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The_Keynote
 */

if ( ! function_exists( 'thekeynote_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thekeynote_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on The Keynote, use a find and replace
		 * to change 'thekeynote' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'thekeynote', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'thekeynote' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thekeynote_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'thekeynote_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thekeynote_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thekeynote_content_width', 640 );
}
add_action( 'after_setup_theme', 'thekeynote_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thekeynote_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'thekeynote' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'thekeynote' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'thekeynote_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function thekeynote_scripts() {
	wp_enqueue_style( 'thekeynote-foundation-style', get_template_directory_uri() . '/scss/foundation-6/css/foundation.min.css', array(), false, 'all' );

	wp_enqueue_style( 'thekeynote-font-awesome', get_template_directory_uri() . '/scss/font-awesome/font-awesome.min.css', array(), false, 'all' );

	wp_enqueue_style( 'thekeynote-style', get_stylesheet_uri() );

	wp_enqueue_script( 'thekeynote-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'thekeynote-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'thekeynote-script', get_template_directory_uri() . '/js/thekeynote-script.js', array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thekeynote_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types
 */
require_once get_template_directory() . '/custom-post-types/cpt-sessions.php';
require_once get_template_directory() . '/custom-post-types/cpt-speakers.php';

add_shortcode( 'sessions', 'thekeynote_sessions' );
function thekeynote_sessions( $atts, $content ) {

	$atts = shortcode_atts( array(
		'row'   => 'no',
		'title' => '',
	), $atts );

	$term        = get_term_by( 'slug', 'gic-insights', 'session_category' );
	$child_terms = get_term_children( $term->term_id, 'session_category' );
	$session_args  = array(
		'post_type' => 'session',
		'meta_key'  => 'sessions_group_session_time',
		'orderby'   => 'meta_value',
		'order'     => 'ASC',

		'tax_query' => array(
			array(
				'taxonomy' => 'session_category',
				'field' => 'term_id',
			),
		),
	);

	ob_start();

	if ( 'yes' === $atts['row'] ) {
		echo '<div class="row column">';
	}

	if ( ! empty( $atts['title'] ) ) {
		echo '<h2 class="sessions-shortcode-title">' . esc_html( $atts['title'] ) . '</h2>';
	}

	foreach ( $child_terms as $child_term_id ) {
		$child_term = get_term_by( 'id', $child_term_id, 'session_category' );
		echo '<div class="session-container">';
		echo '<div class="date-title">';
		echo '<div class="session-date">' . esc_html( $child_term->name ) . '</div>';
		echo '</div>';

		$session_args['tax_query'][0]['terms'] = $child_term_id;
		$session_query = new WP_Query( $session_args );

		if ( $session_query->have_posts() ) {
			while ( $session_query->have_posts() ) {
				$session_query->the_post();
				echo '<div class="session-details">';
				echo '<div class="session-time">';
				echo esc_html( get_post_meta( get_the_ID(), 'sessions_group_session_time', true ) );
				echo '</div>';
				echo '<div class="session-title">';
				echo the_title();
				if ( ! empty( get_the_content() ) ) {
					echo '<div class="read-more-link"><a href="' . get_the_permalink() . '">Read More</a></div>';
				}
				echo '</div>';
				echo '</div>';
			}
		}
		echo '</div>';
	}

	if ( 'yes' === $atts['row'] ) {
		echo '</div>';
	}

	return ob_get_clean();
}