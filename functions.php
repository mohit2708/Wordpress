<?php
require_once('bs4navwalker.php');
 //Category Description in html formet 
foreach ( array( 'pre_term_description' ) as $filter ) { 
    remove_filter( $filter, 'wp_filter_kses' ); 
} 
foreach ( array( 'term_description' ) as $filter ) { 
    remove_filter( $filter, 'wp_kses_data' ); 
}


add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
		'flex-width' => true,
	) );

//Widget function
function mohit_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mohit' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'mohit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Number & Mail', 'mohit' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'mohit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header Social Media', 'mohit' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'mohit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mohit_widgets_init' );
/* Slider  Post Type */
function slider_post_register() {
    $labels = array(
        'name' => _x('Slider', 'post type general name'),
        'singular_name' => _x('Slider Item', 'post type singular name'),
        'add_new' => _x('Add New', 'Slider item'),
        'add_new_item' => __('Add New Slider'),
        'edit_item' => __('Edit Slider'),
        'new_item' => __('New Slider Item'),
        'view_item' => __('View Slider Item'),
        'search_items' => __('Search Slider Items'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon'   => 'dashicons-images-alt',
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 20,
        'supports' => array('title','editor','thumbnail')
    ); 
    register_post_type( 'slider' , $args );
}
add_action('init', 'slider_post_register');
/* Slider Post Type Taxonomies*/
// function create_slider_taxonomies() {
//     $labels = array(
//         'name'              => _x( 'Categories', 'taxonomy general name' ),
//         'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
//         'search_items'      => __( 'Search Categories' ),
//         'all_items'         => __( 'All Categories' ),
//         'parent_item'       => __( 'Parent Category' ),
//         'parent_item_colon' => __( 'Parent Category:' ),
//         'edit_item'         => __( 'Edit Category' ),
//         'update_item'       => __( 'Update Category' ),
//         'add_new_item'      => __( 'Add New Category' ),
//         'new_item_name'     => __( 'New Category Name' ),
//         'menu_name'         => __( 'Categories' ),
//     );
//     $args = array(
//         'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
//         'labels'            => $labels,
//         'show_ui'           => true,
//         'show_admin_column' => true,
//         'query_var'         => true,
//         'rewrite'           => array( 'slug' => 'categories' ),
//     );
//     register_taxonomy( 'slider_categories', array( 'slider' ), $args );
// }
// add_action( 'init', 'create_slider_taxonomies', 0 );

/* Testimonials  Post Type */
function testimonials_post_register() {
    $labels = array(
        'name' => _x('Testimonials', 'post type general name'),
        'singular_name' => _x('Testimonials Item', 'post type singular name'),
        'add_new' => _x('Add New', 'Testimonials item'),
        'add_new_item' => __('Add New Testimonials'),
        'edit_item' => __('Edit Testimonials Item'),
        'new_item' => __('New Testimonials Item'),
        'view_item' => __('View Testimonials Item'),
        'search_items' => __('Search Testimonials Items'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon'   => 'dashicons-editor-quote',
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 21,
        'supports' => array('title','editor','thumbnail')
    ); 
    register_post_type( 'testimonials' , $args );
}
add_action('init', 'testimonials_post_register');

/* Faq  Post Type */
function faq_post_register() {
    $labels = array(
        'name' => _x('Faq', 'post type general name'),
        'singular_name' => _x('Faq Item', 'post type singular name'),
        'add_new' => _x('Add New', 'Faq item'),
        'add_new_item' => __('Add New Faq'),
        'edit_item' => __('Edit Faq Item'),
        'new_item' => __('New Faq Item'),
        'view_item' => __('View Faq Item'),
        'search_items' => __('Search Faq Items'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon'   => 'dashicons-clipboard',
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 23,
        'supports' => array('title','editor','thumbnail')
    ); 
    register_post_type( 'faq' , $args );
}
add_action('init', 'faq_post_register');





function load_theme_files() {   
    wp_enqueue_style('bootstrap', esc_url( get_stylesheet_directory_uri() ).'/css/bootstrap.min.css');
    wp_enqueue_style('animation', esc_url( get_stylesheet_directory_uri() ).'/css/animation.min.css');
    wp_enqueue_style('slick', esc_url( get_stylesheet_directory_uri() ).'/css/slick.min.css');
    wp_enqueue_style('font-awesome', esc_url( get_stylesheet_directory_uri() ).'/css/font-awesome.min.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Arimo:400,400i,700,700i|Courgette|Raleway:400,400i,500,600,700');
    wp_enqueue_style('stylesheet', esc_url( get_stylesheet_directory_uri() ).'/style.css');
}
add_action('wp_enqueue_scripts', 'load_theme_files');

function my_theme_scripts_function() {
  wp_enqueue_script( 'myscript1', get_template_directory_uri() . '/js/jquery.min.js');  
  wp_enqueue_script( 'myscript2', get_template_directory_uri() . '/js/jquery-migrate.min.js');   
  wp_enqueue_script( 'myscript3', get_template_directory_uri() . '/js/bootstrap.min.js');   
  wp_enqueue_script( 'myscript4', get_template_directory_uri() . '/js/wow.min.js');   
  wp_enqueue_script( 'myscript5', get_template_directory_uri() . '/js/slick.js');   
  wp_enqueue_script( 'myscript6', get_template_directory_uri() . '/js/custom.js');     
}
add_action('wp_enqueue_scripts','my_theme_scripts_function');

function remove_head_scripts() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);
   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
 add_action('wp_footer', 'wp_print_head_scripts', 5); 

} 

add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );


