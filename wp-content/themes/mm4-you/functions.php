<?php
/**
 * MM4 You functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package MM4 You
 */

if ( ! function_exists( 'mm4_you_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mm4_you_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MM4 You, use a find and replace
	 * to change 'mm4-you' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mm4-you', get_template_directory() . '/languages' );

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
	add_image_size('blog-feature', 200, 200, true);
	add_image_size('front-page-slide-1', 1400, 535, true);
	add_image_size('front-page-slide-2', 1400, 800, true);
	add_image_size('gallery-main', 1400, 950, true);
	add_image_size('gallery-thumb', 300, 200, true);
	add_image_size('highlight', 500, 450, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mm4-you' ),
		'footer' => esc_html__( 'Footer Menu', 'mm4-you'),
		'aux' => esc_html__( 'Aux Menu', 'mm4-you'),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	/*add_theme_support( 'custom-background', apply_filters( 'mm4_you_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );*/
}
endif; // mm4_you_setup
add_action( 'after_setup_theme', 'mm4_you_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mm4_you_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mm4_you_content_width', 640 );
}
add_action( 'after_setup_theme', 'mm4_you_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mm4_you_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Global Sidebar', 'mm4_you' ),
		'id'            => 'sidebar-global',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'mm4_you' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mm4_you_widgets_init' );

function register_jquery()  {
	if (!is_admin()) {
		wp_deregister_script('jquery');
        // Load the copy of jQuery that comes with WordPress
        // The last parameter set to TRUE states that it should be loaded in the footer.
        wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', FALSE, '1.11.2', TRUE);
    }
}
add_action('init', 'register_jquery');

/**
 * Enqueue scripts and styles.
 */
function mm4_you_scripts() {
	wp_enqueue_style( 'mm4-you-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mm4-you-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );

	if(is_page_template('page-contact.php')) {
		wp_enqueue_script( 'mm4-you-google-map-api', 'http://maps.google.com/maps/api/js?sensor=false', array(), '', true );
		// wp_enqueue_script( 'mm4-you-validate-lib', get_template_directory_uri() . '/js/validate.min.js', array('jquery'), '20150904', true );
		wp_enqueue_script( 'mm4-you-directions', get_template_directory_uri() . '/js/map-directions.js', array('jquery', 'mm4-you-google-map-api'), '20150904', true );
		// wp_enqueue_script( 'mm4-you-main-form-validate', get_template_directory_uri() . '/js/form-main-validate.js', array('jquery', 'mm4-you-validate-lib'), '20150826', true );
	}

	if( is_page_template('frontpage-a.php') || is_page_template('frontpage-b.php') || is_page_template('frontpage-c.php') ) {
		if( function_exists('get_field') ) {
			if( have_rows('slides') ) {
				wp_enqueue_script( 'mm4-you-images-loaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array('jquery'), '20150908', true );
				wp_enqueue_script( 'mm4-you-image-fill', get_template_directory_uri() . '/js/jquery-imagefill.min.js', array('jquery', 'mm4-you-images-loaded'), '20150908', true );
				wp_enqueue_script( 'mm4-you-touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '20150908', true );
				wp_enqueue_script( 'mm4-you-home-carousel', get_template_directory_uri() . '/js/home-carousel.js', array('jquery', 'mm4-you-images-loaded', 'mm4-you-image-fill', 'mm4-you-touchswipe'), '20150908', true );
			}
		}
	}

	if( is_page_template('page-photo-gallery.php') ) {
		if( function_exists('get_field') ) {
			if( have_rows('images') ) {
				wp_enqueue_script( 'mm4-you-images-loaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array('jquery'), '20150908', true );
				wp_enqueue_script( 'mm4-you-image-fill', get_template_directory_uri() . '/js/jquery-imagefill.min.js', array('jquery', 'mm4-you-images-loaded'), '20150908', true );
				wp_enqueue_script( 'mm4-you-touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '20150908', true );
				wp_enqueue_script( 'mm4-you-gallery', get_template_directory_uri() . '/js/photo-gallery.js', array('jquery', 'mm4-you-images-loaded', 'mm4-you-image-fill', 'mm4-you-touchswipe'), '20150908', true );
			}
		}
	}

	wp_enqueue_script( 'mm4-you-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mm4_you_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * INCLUDE PLUGINS
 */

/**
 * Hide ACF menu item from the admin menu
 */

/*function remove_acf_menu() {
	// provide a list of usernames who can edit custom field definitions here
    $admins = array(
		'admin'
    );

    // get the current user
    $current_user = wp_get_current_user();

    // match and remove if needed
    if( !in_array( $current_user->user_login, $admins ) ) {
        remove_menu_page('edit.php?post_type=acf');
    }

}
add_action( 'admin_menu', 'remove_acf_menu', 999 );

include_once( get_stylesheet_directory() . '/plugins/advanced-custom-fields/acf.php' );
include_once( get_stylesheet_directory() . '/plugins/acf-repeater/acf-repeater.php' );

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_home-page-highlight-boxes',
		'title' => 'Home Page Highlight Boxes',
		'fields' => array (
			array (
				'key' => 'field_55f027fd3af22',
				'label' => 'Add highlight boxes?',
				'name' => 'add_highlight_boxes',
				'type' => 'radio',
				'instructions' => 'Would you like to add a section of highlight boxes?',
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'No',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_55ef48fabc1f2',
				'label' => 'Highlights',
				'name' => 'highlights',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55f027fd3af22',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_55ef490ebc1f3',
						'label' => 'Highlight Title',
						'name' => 'highlight_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55ef4928bc1f4',
						'label' => 'Highlight Description',
						'name' => 'highlight_description',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55f9611d8e5be',
						'label' => 'Highlight Link Text',
						'name' => 'highlight_link_text',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55ef4932bc1f5',
						'label' => 'Highlight URL',
						'name' => 'highlight_url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56463275f3a1e',
						'label' => 'Highlight Image',
						'name' => 'highlight_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => 1,
				'row_limit' => 4,
				'layout' => 'row',
				'button_label' => 'Add Highlight',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'frontpage-a.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'frontpage-b.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 5,
	));
	register_field_group(array (
		'id' => 'acf_seo',
		'title' => 'SEO',
		'fields' => array (
			array (
				'key' => 'field_55e884c3c3adb',
				'label' => 'On-Page Title',
				'name' => 'on_page_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 5,
	));
	register_field_group(array (
		'id' => 'acf_sidebar-content',
		'title' => 'Sidebar Content',
		'fields' => array (
			array (
				'key' => 'field_55e887c95f746',
				'label' => 'Sidebar Text',
				'name' => 'sidebar_text',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'page-single-column.php',
					'order_no' => 1,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'page-subnav.php',
					'order_no' => 2,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'page-contact.php',
					'order_no' => 3,
					'group_no' => 0,
				),
				array (
					'param' => 'page_type',
					'operator' => '!=',
					'value' => 'posts_page',
					'order_no' => 4,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'frontpage-a.php',
					'order_no' => 5,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'frontpage-b.php',
					'order_no' => 6,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'frontpage-c.php',
					'order_no' => 7,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'page-photo-gallery.php',
					'order_no' => 8,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 5,
	));
	register_field_group(array (
		'id' => 'acf_home-page-slides',
		'title' => 'Home Page Slides',
		'fields' => array (
			array (
				'key' => 'field_55f02cc65869e',
				'label' => 'Add image carousel?',
				'name' => 'add_image_carousel',
				'type' => 'radio',
				'instructions' => 'Would you like to add a carousel of images/captions?',
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'No',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_55ef3ba857da5',
				'label' => 'Slides',
				'name' => 'slides',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55f02cc65869e',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_55ef3bd557da6',
						'label' => 'Slide Image',
						'name' => 'slide_image',
						'type' => 'image',
						'required' => 1,
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_55ef3bf257da7',
						'label' => 'Slide Caption',
						'name' => 'slide_caption',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => 3,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Slide',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'frontpage-a.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'frontpage-b.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 10,
	));
	register_field_group(array (
		'id' => 'acf_home-page-slides-2',
		'title' => 'Home Page Slides',
		'fields' => array (
			array (
				'key' => 'field_55f1a3388fa48',
				'label' => 'Add image carousel?',
				'name' => 'add_image_carousel',
				'type' => 'radio',
				'instructions' => 'Would you like to add a carousel of images?',
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'No',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_55f1a377b54bf',
				'label' => 'Slides',
				'name' => 'slides',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55f1a3388fa48',
							'operator' => '==',
							'value' => 'Yes',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_55f1a392b54c0',
						'label' => 'Slide Image',
						'name' => 'slide_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),
				),
				'row_min' => 3,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Slide',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'frontpage-c.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 10,
	));
	register_field_group(array (
		'id' => 'acf_photo-gallery',
		'title' => 'Photo Gallery',
		'fields' => array (
			array (
				'key' => 'field_55f1e4dd0db74',
				'label' => 'Images',
				'name' => 'images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_55f1e4f50db75',
						'label' => 'Gallery Image',
						'name' => 'gallery_image',
						'type' => 'image',
						'required' => 1,
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),
				),
				'row_min' => 1,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Image',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-photo-gallery.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 10,
	));
	register_field_group(array (
		'id' => 'acf_quick-contact',
		'title' => 'Quick Contact',
		'fields' => array (
			array (
				'key' => 'field_55e88d80f4dd3',
				'label' => 'Add a quick contact form?',
				'name' => 'quick_contact_form',
				'type' => 'radio',
				'instructions' => '* NOTE: Selecting "Yes" on your blog page will add the form to the main blog page, category/archive pages, and individual posts.',
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'No',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'page-contact.php',
					'order_no' => 1,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'frontpage-c.php',
					'order_no' => 2,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'page-photo-gallery.php',
					'order_no' => 3,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '!=',
					'value' => 'page-single-column.php',
					'order_no' => 4,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 10,
	));
}
*/

include_once( get_stylesheet_directory() . '/plugins/mm4-you-contact-form/mm4-you-cf.php' );

/**
 * BLOG CUSTOMIZATIONS
 */

function mm4_you_modify_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">Read more &raquo;</a>';
}

add_filter( 'the_content_more_link', 'mm4_you_modify_read_more_link' );

/**
 * PAGE SUBNAV
 */

function mm4_you_page_subnav() {
	global $post;
	$parent = array_reverse(get_post_ancestors($post->ID));
	$first_parent = get_page($parent[0]);
	$children = get_pages('child_of='.$first_parent->ID);
	if( count( $children ) != 0 ) {?>
    <div class="subnav-wrapper">
        <nav class="subnav" id="sidebar-subnav">
            <ul>
            <?php wp_list_pages('child_of=' . $first_parent->ID . '&title_li=&sort_column=menu_order'); ?>
            </ul>
        </nav>
    </div>
	<?php }
}

/**
 * SIDEBAR CUSTOM WYSIWYG
 */

function mm4_you_sidebar_wysiwyg() {
	if( function_exists('get_field') ) {
		$sideWYSIWYG = get_field('sidebar_text');
		if($sideWYSIWYG) { ?>
			<aside id="custom-sidebar-wysiwyg">
				<?php echo $sideWYSIWYG; ?>
			</aside>
		<?php }
	}
}

function mm4_you_sidebar_link() {
	if( function_exists('get_field') ) {
		$sideBarLink = get_field('sidebar_link');
		if($sideWYSIWYG) { ?>
			<aside id="custom-sidebar-link">
				<?php echo $sideBarLink; ?>
			</aside>
		<?php }
	}
}

function mm4_you_sidebar_hot_jobs_link() {
	if( function_exists('get_field') ) {
		$sideBarHotJobs = get_field('sidebar_text');
		if($sideWYSIWYG) { ?>
			<aside id="custom-sidebar-link">
				<?php echo $sideBarHotJobs; ?>
			</aside>
		<?php }
	}
}

/**
 * QUICK CONTACT FORM
 */

/*function mm4_you_quick_contact_form() { ?>
	<div class="form-quick-contact-wrapper">
		<h2>Fill out the form below for more information</h2>
		<form id="form-quick-contact" name="form-quick-contact" method="post" action="" novalidate>
			<?php $recipients = get_theme_mod('setting_form_email'); ?>
			<input type="hidden" value="<?php echo $recipients; ?>" name="recipients" id="recipients">
			<input type="hidden" value="Online Contact Form for <?php echo bloginfo('name'); ?>" name="subject" id="subject">
			<div class="flex">
				<div>
					<label for="contact-names"><span class="asterisk">*</span> Name</label>
					<input type="text" id="contact-names" name="contact-names">
				</div>
				<div>
					<label for="contact-email"><span class="asterisk">*</span> Email</label>
					<input type="email" id="contact-email" name="contact-email">
				</div>
				<div>
					<label for="contact-phone">Phone</label>
					<input type="tel" id="contact-phone" name="contact-phone">
				</div>
			</div>
			<div class="flex">
				<div>
					<label for="contact-comments">Comments</label>
					<textarea name="contact-comments" rows="5" id="contact-comments"></textarea>
				</div>
			</div>
			<label for="spam" class="honey">What is 1 plus two + 4?</label>
			<input name="spam" type="text" size="4" id="spam" maxlength="4" class="honey">
			<div class="flex">
				<div>
					<span class="error-box"></span>
				</div>
			</div>
			<div class="flex">
				<div>
					<input type="submit" value="Contact Us">
				</div>
			</div>
		</form>
	</div>
<?php }*/

/*function mm4_you_add_quick_contact_form() {
	if( function_exists(get_field) ) {
		$addForm = get_field('quick_contact_form');
		$blogPage = get_option( 'page_for_posts' );
		$addFormBlog = get_field('quick_contact_form', $blogPage);
		if ( $addFormBlog == 'Yes' && is_home() || $addFormBlog == 'Yes' && is_archive() || $addFormBlog == 'Yes' && is_single() ) {
			mm4_you_quick_contact_form();
			wp_enqueue_script( 'mm4-you-validate-lib', get_template_directory_uri() . '/js/validate.min.js', array('jquery'), '20150904', true );
			wp_enqueue_script( 'mm4-you-quick-form-validate', get_template_directory_uri() . '/js/form-quick-validate.js', array('jquery', 'mm4-you-validate-lib'), '20150904', true );
		} else if( $addForm == 'Yes' && is_page() ) {
			mm4_you_quick_contact_form();
			wp_enqueue_script( 'mm4-you-validate-lib', get_template_directory_uri() . '/js/validate.min.js', array('jquery'), '20150904', true );
			wp_enqueue_script( 'mm4-you-quick-form-validate', get_template_directory_uri() . '/js/form-quick-validate.js', array('jquery', 'mm4-you-validate-lib'), '20150904', true );
		}
	}
}*/

/**
 * CONTACT PAGE
 */

/*function mm4_you_contact_page_form() {
	if(is_page_template('page-contact.php')) { ?>
		<form id="form-main-contact" name="form-main-contact" method="post" action="" novalidate>
			<?php $recipients = get_theme_mod('setting_form_email'); ?>
			<input type="hidden" value="<?php echo $recipients; ?>" name="recipients" id="recipients">
			<input type="hidden" value="Online Contact Form for <?php echo bloginfo('name'); ?>" name="subject" id="subject">
			<label for="contact-names"><span class="asterisk">*</span> Name</label>
			<input type="text" id="contact-names" name="contact-names">
			<label for="contact-company">Company</label>
			<input type="text" id="contact-company" name="contact-company">
			<label for="contact-add1">Address 1</label>
			<input type="text" id="contact-add1" name="contact-add1">
			<label for="contact-add2">Address 2</label>
			<input type="text" id="contact-add2" name="contact-add2">
			<label for="contact-email"><span class="asterisk">*</span> Email</label>
			<input type="email" id="contact-email" name="contact-email">
			<label for="contact-phone"><span class="asterisk">*</span> Phone</label>
			<input type="tel" id="contact-phone" name="contact-phone">
			<label for="contact-comments">Comments</label>
			<textarea name="contact-comments" rows="5" id="contact-comments"></textarea>
			<label for="spam" class="honey">What is 1 plus two + 4?</label>
			<input name="spam" type="text" size="4" id="spam" maxlength="4" class="honey">
			<div class="error-box"></div>
			<input type="submit" value="Contact Us">
		</form>
	<?php }
}*/

function mm4_you_contact_page_sidebar() {
	if(is_page_template('page-contact.php')) {
		$name = get_theme_mod('setting_name');
		$add = get_theme_mod('setting_address');
		$city = get_theme_mod('setting_city');
		$state = get_theme_mod('setting_state');
		$zip = get_theme_mod('setting_zip');
		$ph = get_theme_mod('setting_phone');
		$fx = get_theme_mod('setting_fax');
		$email = get_theme_mod('setting_email');
		$hours1 = get_theme_mod('setting_hours_1');
		$hours2 = get_theme_mod('setting_hours_2');
		$hours3 = get_theme_mod('setting_hours_3');

		if($hours1 || $hours2 || $hours3) { ?>
			<aside id="office-hours">
				<h2>Office Hours</h2>
				<?php if($hours1): ?><span class="hours" id="side-hours-1"><?php echo $hours1; ?></span><?php endif;
				 if($hours2): ?><span class="hours" id="side-hours-2"><?php echo $hours2; ?></span><?php endif;
				 if($hours3): ?><span class="hours" id="side-hours-3"><?php echo $hours3; ?></span><?php endif; ?>
			</aside>
		<?php }

		if($add || $city || $state || $zip || $ph || $fx || $email) { ?>
			<aside id="address-phone">
				<?php if($name): ?><span class="side-contact" id="side-address-1"><?php echo $name; ?></span><?php endif;
				if($add): ?><span class="side-contact" id="side-address-1"><?php echo $add; ?></span><?php endif;
				if($city): ?><span class="side-contact" id="side-city"><?php echo $city; ?></span><?php endif; if($city || $state || $zip): ?><span class="comma">, </span><?php endif; if($state): ?><span class="side-contact" id="side-state"><?php echo $state; ?> </span><?php endif; if($zip): ?><span class="side-contact" id="side-zip"><?php echo $zip; ?></span><?php endif;
				if($ph): ?><span class="side-contact" id="side-phone"><a href="tel:<?php echo $ph; ?>" class="tel">Phone: <?php echo $ph; ?></a></span><?php endif;
				if($fx): ?><span class="side-contact" id="side-fax"><a href="fax:<?php echo $fx; ?>" class="tel">Fax: <?php echo $fx; ?></a></span><?php endif;
				if($email): ?><span class="side-contact" id="side-email"><a href="mailto:<?php echo $email; ?>" target="_blank">Email</a></span><?php endif; ?>

				<div id="directions">
					<div id="side-map-canvas" class="map-canvas"></div>
					<form id="form-directions" onSubmit="calcRoute(); return false;">
						<label for="start">Starting Address</label>
						<input type="text" id="start" name="start">
						<input type="hidden" id="end" name="end" value="<?php echo $add . ', ' . $city . ', ' . $state . ' ' . $zip; ?>">
						<div class="error-box" id="map-error"></div>
						<input type="button" onclick="calcRoute();" value="Get Directions" class="btn">
					</form>
					<div id="directions-panel"></div>
				</div>
			</aside>
		<?php }
	}
}

function mm4_you_contact_page_build_map() {
	$name = get_theme_mod('setting_name');
	$lat = get_theme_mod('setting_latitude');
	$lng = get_theme_mod('setting_longitude');
	$add = get_theme_mod('setting_address');
	$city = get_theme_mod('setting_city');
	$state = get_theme_mod('setting_state');
	$zip = get_theme_mod('setting_zip');
	if( is_page_template('page-contact.php') ) {
		if( $name || $lat || $lng || $add || $city || $state || $zip ) { ?>
		<script>
			var locations = [
				["<?php echo $name; ?>", <?php echo $lat; ?>, <?php echo $lng; ?>, "<?php echo $add; ?>", "<?php echo $city . ', ' . $state . ' ' . $zip; ?>"]
			]
		</script>
		<?php }
	}
}

add_action('wp_footer', 'mm4_you_contact_page_build_map');

/**
 * FRONT PAGE
 */

function mm4_you_home_carousel_body_class( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_page_template('frontpage-a.php') || is_page_template('frontpage-b.php') || is_page_template('frontpage-c.php') && function_exists('get_field') ) {
		if( get_field('add_image_carousel') == 'Yes' )
		$classes[] = 'has-carousel';
	}

	return $classes;
}
add_filter( 'body_class', 'mm4_you_home_carousel_body_class' );


function mm4_you_home_carousel_type_1() {
	if( is_page_template('frontpage-a.php') || is_page_template('frontpage-b.php') ) {
		if( function_exists('get_field') ) {
			$addCarousel = get_field('add_image_carousel');
			if( $addCarousel == 'Yes' && have_rows('slides') ): ?>
				<div id="home-carousel" class="carousel-type-1">
					<ul>
					<?php while ( have_rows('slides') ) : the_row(); ?>
						<li>
						<?php $imageArr = get_sub_field('slide_image');
						$image = wp_get_attachment_image_src($imageArr[id], 'front-page-slide-1');
						$brand = get_sub_field('slide_brand');
						$title = get_sub_field('slide_title');
						$caption = get_sub_field('slide_caption');?>
						<img src="<?php echo $image[0] ?>" alt="<?php echo $imageArr[title]; ?>">
						<div class="slide-brand-name"><span>I</span><span>I</span><span>T</span><span>C</span></div>
						<span class="slide-description"><?php echo $title; ?><br><?php echo $caption; ?></span>

						</li>
					<?php endwhile; ?>
					</ul>
					<?php $rows = get_field('slides');
					$rowCount = count($rows); ?>
					<ol class="carousel-nav">
					<?php for ($i = 1; $i <= $rowCount; $i++) { ?>
						<li><a href="#"><?php echo $i; ?></a></li>
					<?php } ?>
					</ol>
				</div>
			<?php endif;
		}
	}
}

function mm4_you_home_carousel_type_2() {
	if( is_page_template('frontpage-c.php') ) {
		if( function_exists('get_field') ) {
			$addCarousel = get_field('add_image_carousel');
			if( $addCarousel == 'Yes' && have_rows('slides') ): ?>
				<div id="home-carousel" class="carousel-type-2">
					<ul>
					<?php while ( have_rows('slides') ) : the_row(); ?>
						<li>
						<?php $imageArr = get_sub_field('slide_image');
						$image = wp_get_attachment_image_src($imageArr[id], 'front-page-slide-2'); ?>
						<img src="<?php echo $image[0] ?>" alt="<?php echo $imageArr[title]; ?>">
						</li>
					<?php endwhile; ?>
					</ul>
				</div>
			<?php endif;
		}
	}
}

function mm4_you_home_carousel_type_2_controls() {
	if( is_page_template('frontpage-c.php') ) {
		if( function_exists('get_field') ) {
			$addCarousel = get_field('add_image_carousel');
			if( $addCarousel == 'Yes' && have_rows('slides') ):
				$rows = get_field('slides');
				$rowCount = count($rows); ?>
				<ol class="carousel-nav">
				<?php for ($i = 1; $i <= $rowCount; $i++) { ?>
					<li><a href="#"><?php echo $i; ?></a></li>
				<?php } ?>
				</ol>
		<?php endif;
		}
	}
}

function mm4_you_highlight_boxes() {
	if(is_page_template('frontpage-a.php') || is_page_template('frontpage-b.php') ) {
		if( function_exists('get_field') ) {
			$rows = get_field('highlights');
			$rowCount = count($rows);
			$addHighlights = get_field('add_highlight_boxes');
			if( $addHighlights == 'Yes' && have_rows('highlights') ): ?>
				<div id="home-highlight-wrapper" class="highlight-<?php echo $rowCount; ?>">
					<div id="home-highlight-inner-wrapper">
						<?php while( have_rows('highlights') ): the_row();

						$img = get_sub_field('highlight_image');
						$title = get_sub_field('highlight_title');
						$url = get_sub_field('highlight_url');
						$linkTxt = get_sub_field('highlight_link_text');  ?>

							<div class="home-highlight"> <?php

								if($img): ?><img class="highlight-image" src="<?php echo $img['sizes']['highlight']; ?>" /><?php endif;?>

								<?php if($title): ?><span class="highlight-title"><?php echo $title; ?></span><?php endif; echo "\n";

								if($url): ?><span class="highlight-url"><a href="<?php echo $url; ?>"><?php if($linkTxt): echo $linkTxt . ' &raquo;'; else: ?>Learn More &raquo;<?php endif; ?></a></span><?php endif; echo "\n";  ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif;
		}
	}
}

/**
 * PHOTO GALLERY
 */

function mm4_you_photo_gallery() {
	if( is_page_template('page-photo-gallery.php') ) {
		if( function_exists('get_field') ) {
			if( have_rows('images') ): ?>
				<div id="gallery-main">
					<ul>
					<?php while ( have_rows('images') ) : the_row(); ?>
						<li>
						<?php $imageArr = get_sub_field('gallery_image');
						$image = wp_get_attachment_image_src($imageArr[id], 'gallery-main'); ?>
						<img src="<?php echo $image[0] ?>" alt="<?php echo $imageArr[alt]; ?>">
						</li>
					<?php endwhile; ?>
					</ul>
					<button class="carousel-btn" id="prev" aria-controls="galery-main" aria-label="Previous">Previous</button>
					<button class="carousel-btn" id="next" aria-controls="gallery-main" aria-label="Next">Next</button>
				</div>
			<?php endif;
			if( have_rows('images') ): ?>
				<div id="gallery-thumbs">
					<ul>
					<?php while ( have_rows('images') ) : the_row(); ?>
						<li><a href="#">
						<?php $imageArr = get_sub_field('gallery_image');
						$image = wp_get_attachment_image_src($imageArr[id], 'gallery-thumb'); ?>
						<img src="<?php echo $image[0] ?>" alt="<?php echo $imageArr[title]; ?>">
						</a></li>
					<?php endwhile; ?>
					</ul>
				</div>
			<?php endif;
		}
	}
}