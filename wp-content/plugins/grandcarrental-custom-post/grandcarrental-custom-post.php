<?php
/*
Plugin Name: Grand Car Rental Theme Custom Post Type
Plugin URI: http://themes.themegoods2.com/grandcarrental/demo/
Description: Plugin that will create custom post types for Grand Car Rental theme.
Version: 1.1
Author: ThemeGoods
Author URI: http://themeforest.net/user/ThemeGoods
License: GPLv2
*/

//Setup translation string via PO file

add_action('plugins_loaded', 'grandcarrental_load_textdomain');
function grandcarrental_load_textdomain() 
{
	load_plugin_textdomain( 'grandcarrental-custom-post', FALSE, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

function post_type_galleries() {
	$labels = array(
    	'name' => esc_html__('Galleries', 'post type general name', 'grandcarrental-custom-post'),
    	'singular_name' => esc_html__('Gallery', 'post type singular name', 'grandcarrental-custom-post'),
    	'add_new' => esc_html__('Add New Gallery', 'book', 'grandcarrental-custom-post'),
    	'add_new_item' => esc_html__('Add New Gallery', 'grandcarrental-custom-post'),
    	'edit_item' => esc_html__('Edit Gallery', 'grandcarrental-custom-post'),
    	'new_item' => esc_html__('New Gallery', 'grandcarrental-custom-post'),
    	'view_item' => esc_html__('View Gallery', 'grandcarrental-custom-post'),
    	'search_items' => esc_html__('Search Gallery', 'grandcarrental-custom-post'),
    	'not_found' =>  esc_html__('No Gallery found', 'grandcarrental-custom-post'),
    	'not_found_in_trash' => esc_html__('No Gallery found in Trash', 'grandcarrental-custom-post'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title', 'excerpt' ),
    	'menu_icon' => ''
	); 		

	register_post_type( 'galleries', $args );
	
  	$labels = array(			  
  	  'name' => esc_html__( 'Gallery Categories', 'taxonomy general name', 'grandcarrental-custom-post' ),
  	  'singular_name' => esc_html__( 'Gallery Category', 'taxonomy singular name', 'grandcarrental-custom-post' ),
  	  'search_items' =>  esc_html__( 'Search Gallery Categories', 'grandcarrental-custom-post' ),
  	  'all_items' => esc_html__( 'All Gallery Categories', 'grandcarrental-custom-post' ),
  	  'parent_item' => esc_html__( 'Parent Gallery Category', 'grandcarrental-custom-post' ),
  	  'parent_item_colon' => esc_html__( 'Parent Gallery Category:', 'grandcarrental-custom-post' ),
  	  'edit_item' => esc_html__( 'Edit Gallery Category', 'grandcarrental-custom-post' ), 
  	  'update_item' => esc_html__( 'Update Gallery Category', 'grandcarrental-custom-post' ),
  	  'add_new_item' => esc_html__( 'Add New Gallery Category', 'grandcarrental-custom-post' ),
  	  'new_item_name' => esc_html__( 'New Gallery Category Name', 'grandcarrental-custom-post' ),
  	); 							  	  
  	
  	register_taxonomy(
		'gallerycat',
		'galleries',
		array(
			'public'=>true,
			'hierarchical' => false,
			'labels'=> $labels,
			'query_var' => 'gallerycat',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'gallerycat', 'with_front' => false ),
		)
	);	
} 
								  
add_action('init', 'post_type_galleries');


function post_type_cars() {
	$labels = array(
    	'name' => esc_html__('Cars', 'post type general name', 'grandcarrental-custom-post'),
    	'singular_name' => esc_html__('Car', 'post type singular name', 'grandcarrental-custom-post'),
    	'add_new' => esc_html__('Add New Car', 'book', 'grandcarrental-custom-post'),
    	'add_new_item' => esc_html__('Add New Car', 'grandcarrental-custom-post'),
    	'edit_item' => esc_html__('Edit Car', 'grandcarrental-custom-post'),
    	'new_item' => esc_html__('New Car', 'grandcarrental-custom-post'),
    	'view_item' => esc_html__('View Car', 'grandcarrental-custom-post'),
    	'search_items' => esc_html__('Search Cars', 'grandcarrental-custom-post'),
    	'not_found' =>  esc_html__('No Car found', 'grandcarrental-custom-post'),
    	'not_found_in_trash' => esc_html__('No Car found in Trash', 'grandcarrental-custom-post'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail', 'comments'),
    	'menu_icon' => ''
	); 		

	register_post_type( 'car', $args );
	
  	$labels = array(			  
  	  'name' => esc_html__( 'Car Brands', 'taxonomy general name', 'grandcarrental-custom-post' ),
  	  'singular_name' => esc_html__( 'Car Brand', 'taxonomy singular name', 'grandcarrental-custom-post' ),
  	  'search_items' =>  esc_html__( 'Search Car Brands', 'grandcarrental-custom-post' ),
  	  'all_items' => esc_html__( 'All Car Brands', 'grandcarrental-custom-post' ),
  	  'parent_item' => esc_html__( 'Parent Car Brand', 'grandcarrental-custom-post' ),
  	  'parent_item_colon' => esc_html__( 'Parent Car Brand:', 'grandcarrental-custom-post' ),
  	  'edit_item' => esc_html__( 'Edit Car Brand', 'grandcarrental-custom-post' ), 
  	  'update_item' => esc_html__( 'Update Car Brand', 'grandcarrental-custom-post' ),
  	  'add_new_item' => esc_html__( 'Add New Car Brand', 'grandcarrental-custom-post' ),
  	  'new_item_name' => esc_html__( 'New Car Brand', 'grandcarrental-custom-post' ),
  	); 							  
  	
  	register_taxonomy(
		'carbrand',
		'car',
		array(
			'public'=>true,
			'hierarchical' => false,
			'labels'=> $labels,
			'query_var' => 'carbrand',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'carbrand', 'with_front' => false ),
		)
	);
	
	$labels = array(			  
  	  'name' => esc_html__( 'Car Types', 'taxonomy general name', 'grandcarrental-custom-post' ),
  	  'singular_name' => esc_html__( 'Car Type', 'taxonomy singular name', 'grandcarrental-custom-post' ),
  	  'search_items' =>  esc_html__( 'Search Car Types', 'grandcarrental-custom-post' ),
  	  'all_items' => esc_html__( 'All Car Types', 'grandcarrental-custom-post' ),
  	  'parent_item' => esc_html__( 'Parent Car Type', 'grandcarrental-custom-post' ),
  	  'parent_item_colon' => esc_html__( 'Parent Car Type:', 'grandcarrental-custom-post' ),
  	  'edit_item' => esc_html__( 'Edit Car Type', 'grandcarrental-custom-post' ), 
  	  'update_item' => esc_html__( 'Update Car Type', 'grandcarrental-custom-post' ),
  	  'add_new_item' => esc_html__( 'Add New Car Type', 'grandcarrental-custom-post' ),
  	  'new_item_name' => esc_html__( 'New Car Type', 'grandcarrental-custom-post' ),
  	); 							  
  	
  	register_taxonomy(
		'cartype',
		'car',
		array(
			'public'=>true,
			'hierarchical' => false,
			'labels'=> $labels,
			'query_var' => 'cartype',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'cartype', 'with_front' => false ),
		)
	);	  
}
								  
add_action('init', 'post_type_cars');

add_action( 'init', 'create_car_tag_taxonomies', 0 );

function create_car_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Car Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Car Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Car Tags' ),
    'popular_items' => __( 'Popular Car Tags' ),
    'all_items' => __( 'All Car Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Car Tag' ), 
    'update_item' => __( 'Update Car Tag' ),
    'add_new_item' => __( 'Add New Car Tag' ),
    'new_item_name' => __( 'New Car Tag Name' ),
    'separate_items_with_commas' => __( 'Separate car tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove car tags' ),
    'choose_from_most_used' => __( 'Choose from the most used car tags' ),
    'menu_name' => __( 'Car Tags' ),
  ); 

  register_taxonomy('cartag','car',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_menu' => false,
    'show_in_nav_menus' => false,
    'show_in_rest' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cartag' ),
  ));
}

function post_type_testimonials() {
	$labels = array(
    	'name' => esc_html__('Testimonials', 'post type general name', 'grandcarrental-custom-post'),
    	'singular_name' => esc_html__('Testimonial', 'post type singular name', 'grandcarrental-custom-post'),
    	'add_new' => esc_html__('Add New Testimonial', 'book', 'grandcarrental-custom-post'),
    	'add_new_item' => esc_html__('Add New Testimonial', 'grandcarrental-custom-post'),
    	'edit_item' => esc_html__('Edit Testimonial', 'grandcarrental-custom-post'),
    	'new_item' => esc_html__('New Testimonial', 'grandcarrental-custom-post'),
    	'view_item' => esc_html__('View Testimonial', 'grandcarrental-custom-post'),
    	'search_items' => esc_html__('Search Testimonial', 'grandcarrental-custom-post'),
    	'not_found' =>  esc_html__('No Testimonial found', 'grandcarrental-custom-post'),
    	'not_found_in_trash' => esc_html__('No Testimonial found in Trash', 'grandcarrental-custom-post'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title', 'editor', 'thumbnail'),
    	'menu_icon' => ''
	); 		

	register_post_type( 'testimonials', $args );
	
	$labels = array(			  
  	  'name' => esc_html__( 'Testimonial Categories', 'taxonomy general name', 'grandcarrental-custom-post' ),
  	  'singular_name' => esc_html__( 'Testimonial Category', 'taxonomy singular name', 'grandcarrental-custom-post' ),
  	  'search_items' =>  esc_html__( 'Search Testimonial Categories', 'grandcarrental-custom-post' ),
  	  'all_items' => esc_html__( 'All Testimonial Categories', 'grandcarrental-custom-post' ),
  	  'parent_item' => esc_html__( 'Parent Testimonial Category', 'grandcarrental-custom-post' ),
  	  'parent_item_colon' => esc_html__( 'Parent Testimonial Category:', 'grandcarrental-custom-post' ),
  	  'edit_item' => esc_html__( 'Edit Testimonial Category', 'grandcarrental-custom-post' ), 
  	  'update_item' => esc_html__( 'Update Testimonial Category', 'grandcarrental-custom-post' ),
  	  'add_new_item' => esc_html__( 'Add New Testimonial Category', 'grandcarrental-custom-post' ),
  	  'new_item_name' => esc_html__( 'New Testimonial Category Name', 'grandcarrental-custom-post' ),
  	); 							  
  	
  	register_taxonomy(
		'testimonialcats',
		'testimonials',
		array(
			'public'=>true,
			'hierarchical' => false,
			'labels'=> $labels,
			'query_var' => 'testimonialcats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'testimonialcats', 'with_front' => false ),
		)
	);		  
} 
								  
add_action('init', 'post_type_testimonials');


function post_type_team() {
	$labels = array(
    	'name' => esc_html__('Team Members', 'post type general name', 'grandcarrental-custom-post'),
    	'singular_name' => esc_html__('Team Member', 'post type singular name', 'grandcarrental-custom-post'),
    	'add_new' => esc_html__('Add New Team Member', 'book', 'grandcarrental-custom-post'),
    	'add_new_item' => esc_html__('Add New Team Member', 'grandcarrental-custom-post'),
    	'edit_item' => esc_html__('Edit Team Member', 'grandcarrental-custom-post'),
    	'new_item' => esc_html__('New Team Member', 'grandcarrental-custom-post'),
    	'view_item' => esc_html__('View Team Member', 'grandcarrental-custom-post'),
    	'search_items' => esc_html__('Search Team Members', 'grandcarrental-custom-post'),
    	'not_found' =>  esc_html__('No Team Member found', 'grandcarrental-custom-post'),
    	'not_found_in_trash' => esc_html__('No Team Member found in Trash', 'grandcarrental-custom-post'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => ''
	); 		

	register_post_type( 'team', $args );
	
	$labels = array(			  
  	  'name' => esc_html__( 'Team Categories', 'taxonomy general name', 'grandcarrental-custom-post' ),
  	  'singular_name' => esc_html__( 'Team Category', 'taxonomy singular name', 'grandcarrental-custom-post' ),
  	  'search_items' =>  esc_html__( 'Team Service Categories', 'grandcarrental-custom-post' ),
  	  'all_items' => esc_html__( 'All Team Categories', 'grandcarrental-custom-post' ),
  	  'parent_item' => esc_html__( 'Parent Team Category', 'grandcarrental-custom-post' ),
  	  'parent_item_colon' => esc_html__( 'Parent Team Category:', 'grandcarrental-custom-post' ),
  	  'edit_item' => esc_html__( 'Edit Team Category', 'grandcarrental-custom-post' ), 
  	  'update_item' => esc_html__( 'Update Team Category', 'grandcarrental-custom-post' ),
  	  'add_new_item' => esc_html__( 'Add New Team Category', 'grandcarrental-custom-post' ),
  	  'new_item_name' => esc_html__( 'New Team Category Name', 'grandcarrental-custom-post' ),
  	); 							  
  	
  	register_taxonomy(
		'teamcats',
		'team',
		array(
			'public'=>true,
			'hierarchical' => false,
			'labels'=> $labels,
			'query_var' => 'teamcats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'teamcats', 'with_front' => false ),
		)
	);
}
add_action('init', 'post_type_team');


function post_type_pricing() {
	$labels = array(
    	'name' => esc_html__('Pricing', 'post type general name', 'grandcarrental-custom-post'),
    	'singular_name' => esc_html__('Pricing', 'post type singular name', 'grandcarrental-custom-post'),
    	'add_new' => esc_html__('Add New Pricing', 'book', 'grandcarrental-custom-post'),
    	'add_new_item' => esc_html__('Add New Pricing', 'grandcarrental-custom-post'),
    	'edit_item' => esc_html__('Edit Pricing', 'grandcarrental-custom-post'),
    	'new_item' => esc_html__('New Pricing', 'grandcarrental-custom-post'),
    	'view_item' => esc_html__('View Pricing', 'grandcarrental-custom-post'),
    	'search_items' => esc_html__('Search Pricings', 'grandcarrental-custom-post'),
    	'not_found' =>  esc_html__('No Pricing found', 'grandcarrental-custom-post'),
    	'not_found_in_trash' => esc_html__('No Pricing found in Trash', 'grandcarrental-custom-post'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title'),
    	'menu_icon' => ''
	); 		

	register_post_type( 'pricing', $args );
	
	$labels = array(			  
  	  'name' => esc_html__( 'Pricing Categories', 'taxonomy general name', 'grandcarrental-custom-post' ),
  	  'singular_name' => esc_html__( 'Pricing Category', 'taxonomy singular name', 'grandcarrental-custom-post' ),
  	  'search_items' =>  esc_html__( 'Pricing Service Categories', 'grandcarrental-custom-post' ),
  	  'all_items' => esc_html__( 'All Pricing Categories', 'grandcarrental-custom-post' ),
  	  'parent_item' => esc_html__( 'Parent Pricing Category', 'grandcarrental-custom-post' ),
  	  'parent_item_colon' => esc_html__( 'Parent Pricing Category:', 'grandcarrental-custom-post' ),
  	  'edit_item' => esc_html__( 'Edit Pricing Category', 'grandcarrental-custom-post' ), 
  	  'update_item' => esc_html__( 'Update Pricing Category', 'grandcarrental-custom-post' ),
  	  'add_new_item' => esc_html__( 'Add New Pricing Category', 'grandcarrental-custom-post' ),
  	  'new_item_name' => esc_html__( 'New Pricing Category Name', 'grandcarrental-custom-post' ),
  	); 							  
  	
  	register_taxonomy(
		'pricingcats',
		'pricing',
		array(
			'public'=>true,
			'hierarchical' => false,
			'labels'=> $labels,
			'query_var' => 'pricingcats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'pricingcats', 'with_front' => false ),
		)
	);
}
add_action('init', 'post_type_pricing');


add_filter( 'manage_posts_columns', 'rt_add_gravatar_col');
function rt_add_gravatar_col($cols) {
	$cols['thumbnail'] = esc_html__('Thumbnail', 'grandcarrental-custom-post');
	return $cols;
}

add_action( 'manage_posts_custom_column', 'rt_get_author_gravatar');
function rt_get_author_gravatar($column_name ) {
	if ( $column_name  == 'thumbnail'  ) {
		echo get_the_post_thumbnail(get_the_ID(), array(100, 100));
	}
}

/*
	Get gallery list
*/
$args = array(
    'numberposts' => -1,
    'post_type' => array('galleries'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();

foreach($galleries_arr as $gallery)
{
	$galleries_select[$gallery->ID] = $gallery->post_title;
}

/*
	Get car list
*/
$args = array(
    'numberposts' => -1,
    'post_type' => array('car'),
);

$cars_arr = get_posts($args);
$cars_select = array();

foreach($cars_arr as $car)
{
	$cars_select[$car->ID] = $car->post_title;
}

/*
	Get post layouts
*/
$post_layout_select = array();
$post_layout_select = array(
	'With Right Sidebar' => 'With Right Sidebar',
	'With Left Sidebar' => 'With Left Sidebar',
	'Fullwidth' => 'Fullwidth',
);

//Get all sidebars
$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar',
);

$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
	}
}

//Get contact form 7 form list
$contactform7_arr = array();
$contactform7_arr[-1] = '';

//Check if contact form 7 plugin is installed	
$contactform7_plugin_path = 'contact-form-7/wp-contact-form-7.php';

if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$contactform7_activated = is_plugin_active($contactform7_plugin_path);
if($contactform7_activated)
{
	$contactform7_obj_arr = WPCF7_ContactForm::find($args);
	
	if(!empty($contactform7_obj_arr) && is_array($contactform7_obj_arr))
	{
		foreach($contactform7_obj_arr as $contactform7_obj)
		{
			$contactform7_id = $contactform7_obj->id();
			$contactform7_title = $contactform7_obj->title();
			
			$contactform7_arr[$contactform7_id] = $contactform7_title;
		}
	}
}

//Get woocommerce product list
$woocommerce_product_arr = array();
$woocommerce_product_arr[-1] = '';

//Check if woocommerce plugin is installed	
$woocommerce_plugin_path = 'woocommerce/woocommerce.php';

if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$woocommerce_activated = is_plugin_active($woocommerce_plugin_path);
if($woocommerce_activated)
{
	$args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'suppress_filters' => false );

    $products_arr = get_posts( $args );

    if(!empty($products_arr) && is_array($products_arr))
	{
		foreach($products_arr as $products_obj)
		{
			$woocommerce_product_arr[$products_obj->ID] = $products_obj->post_title;
		}
	}
}

//Get all sidebars
$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar',
);

$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
	}
}

/*
	Begin creating custom fields
*/

$postmetas = 
	array (
		'post' => array(
			array("section" => "Content Type", "id" => "post_layout", "type" => "template", "title" => "Post Layout", "description" => "You can select layout of this single post page.", "items" => $post_layout_select),
			array(
    		"section" => "Featured Content Type", "id" => "post_ft_type", "type" => "select", "title" => "Featured Content Type", "description" => "Select featured content type for this post. Different content type will be displayed on single post page", 
				"items" => array(
					"Image" => "Image",
					"Gallery" => "Gallery",
					"Vimeo Video" => "Vimeo Video",
					"Youtube Video" => "Youtube Video",
				)),
			
			array("section" => "Gallery", "id" => "post_ft_gallery", "type" => "select", "title" => "Gallery (Optional)", "description" => "Please select a gallery.</strong>", "items" => $galleries_select),
				
			array("section" => "Vimeo Video ID", "id" => "post_ft_vimeo", "type" => "text", "title" => "Vimeo Video ID", "description" => "Please enter Vimeo Video ID for example 73317780"),
			
			array("section" => "Youtube Video ID", "id" => "post_ft_youtube", "type" => "text", "title" => "Youtube Video ID", "description" => "Please enter Youtube Video ID for example 6AIdXisPqHc"),
			
			array("section" => "Page Menu", "id" => "post_menu_transparent", "type" => "checkbox", "title" => "Make Menu Transparent", "description" => "Check this option if you want to display main menu in transparent"),
		),
		
		'car' => array(
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_passengers", 
				"type" 			=> "text", 
				"title" 		=> esc_html__("Number of Passenger(s)", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter number of passenger(s) for this car", 'grandcarrental-custom-post')
			),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_luggages", 
				"type" 			=> "text", 
				"title" 		=> esc_html__("Luggage(s)", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter number of luggage(s) for this car", 'grandcarrental-custom-post')
			),
			array(
    			"section" 		=> "Car Attributes", 
    			"id" 			=> "car_transmission", 
    			"type" 			=> "select", 
    			"title" 		=> esc_html__("Transmission", 'grandcarrental-custom-post'), 
    			"description" 	=> "Select which transmission this car has", 
				"items" 		=> array(
					"auto" 		=> "Auto",
					"manual" 	=> "Manual",
			)),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_doors", 
				"type" 			=> "text", 
				"title" 		=> esc_html__("Doors", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter number of doors this car has", 'grandcarrental-custom-post')
			),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_price_day", 
				"type" 			=> "text", 
				"title" 		=> esc_html__("Price per Day", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter price per day for this car", 'grandcarrental-custom-post')
			),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_price_hour", 
				"type" 			=> "text", 
				"title" 		=> esc_html__("Price per Hour", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter price per hour for this car", 'grandcarrental-custom-post')
			),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_price_airport", 
				"type" 			=> "text", 
				"title" 		=> esc_html__("Airport Transfer Price", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter price per 1 airport transfer for this car", 'grandcarrental-custom-post')
			),
			array(
    			"section" 		=> "Car Attributes", 
    			"id" 			=> "car_booking_contactform7", 
    			"type" 			=> "select", 
    			"title" 		=> esc_html__("Booking Form"), 
    			"description" 	=> "Select booking form for this car", 
				"items" 		=> $contactform7_arr
			),
			array(
    			"section" 		=> "Car Attributes", 
    			"id" 			=> "car_booking_product", 
    			"type" 			=> "select", 
    			"title" 		=> esc_html__("Woocommerce Product for book instantly"), 
    			"description" 	=> "Select product for this car for book instantly option", 
				"items" 		=> $woocommerce_product_arr
			),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_included", 
				"type" 			=> "adding_list", 
				"title" 		=> esc_html__("Included", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter what's included in this car", 'grandcarrental-custom-post')
			),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_not_included", 
				"type" 			=> "adding_list", 
				"title" 		=> esc_html__("Not Included", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Enter what 's not included in this car", 'grandcarrental-custom-post')
			),
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_gallery", 
				"type" 			=> "select", 
				"title" 		=> esc_html__("Gallery (Optional)", 'grandcarrental-custom-post'), 
				"description" 	=> esc_html__("Select sample image gallery for this car", 'grandcarrental-custom-post'),
				"items" 		=> $galleries_select
			),
			
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_video_review", 
				"type" 			=> "textarea", 
				"title" 		=> esc_html__("Video Review (Optional)", 'grandtour-custom-post'), 
				"description" 	=> esc_html__("Enter video review embed HTML code for this tour", 'grandtour-custom-post'),
			),
			
			array(
    			"section" 		=> "Car Attributes", 
    			"id" 			=> "car_header_type", 
    			"type" 			=> "select", 
    			"title" 		=> "Header Content Type", 
    			"description" 	=> "Select header content type for this car. Different content type will be displayed on single car page", 
				"items" 		=> array(
					"Image" => "Featured Image",
					"Vimeo Video" => "Vimeo Video",
					"Youtube Video" => "Youtube Video",
			)),
				
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_header_vimeo", 
				"type" 			=> "text", 
				"title" 		=> "Vimeo Video ID ", 
				"description" 	=> "Please enter Vimeo Video ID for example 73317780"
			),
			
			array(
				"section" 		=> "Car Attributes", 
				"id" 			=> "car_header_youtube", 
				"type" 			=> "text", 
				"title" 		=> "Youtube Video ID", 
				"description" 	=> "Please enter Youtube Video ID for example 6AIdXisPqHc"
			),
			
			array("section" => "Page Menu", "id" => "post_menu_transparent", "type" => "checkbox", "title" => "Make Menu Transparent", "description" => "Check this option if you want to display main menu in transparent"),
		),
		
		'team' => array(
			array("section" => "Team Option", "id" => "team_position", "type" => "text", "title" => "Position and Role", "description" => "Enter team member position and role ex. Marketing Manager"),
			array("section" => "Facebook URL", "id" => "member_facebook", "type" => "text", "title" => "Facebook URL", "description" => "Enter team member Facebook URL"),
		    array("section" => "Twitter URL", "id" => "member_twitter", "type" => "text", "title" => "Twitter URL", "description" => "Enter team member Twitter URL"),
		    array("section" => "Google+ URL", "id" => "member_google", "type" => "text", "title" => "Google+ URL", "description" => "Enter team member Google+ URL"),
		    array("section" => "Linkedin URL", "id" => "member_linkedin", "type" => "text", "title" => "Linkedin URL", "description" => "Enter team member Linkedin URL"),
		),
		
		'pricing' => array(
			array("section" => "Pricing Option", "id" => "pricing_featured", "type" => "checkbox", "title" => "Make this pricing featured", "description" => "Check this option if you want to display this pricing as featured one."),
			array("section" => "Pricing Option", "id" => "pricing_plan_currency", "type" => "text", "title" => "Currency", "description" => "Enter currency", "sample" => "$"),
			array("section" => "Pricing Option", "id" => "pricing_plan_price", "type" => "text", "title" => "Exact Price", "description" => "Enter exact price", "sample" => "10"),
			array("section" => "Pricing Option", "id" => "pricing_plan_time", "type" => "text", "title" => "Time", "description" => "Enter price per time (optional)", "sample" => 'month'),
			array("section" => "Pricing Option", "id" => "pricing_plan_features", "type" => "textarea", "title" => "Plan Features", "description" => "Enter pricing plan features.", "sample" => "Unlimited Pages\nUnlimited Storage\nMobile Website\n24/7 Customer Support"),
			array("section" => "Pricing Option", "id" => "pricing_button_text", "type" => "text", "title" => "Button Text", "description" => "Enter pricing button text", "sample" => "Purchase Now"),
		    array("section" => "Pricing Option", "id" => "pricing_button_url", "type" => "text", "title" => "Button URL", "description" => "Enter pricing button  URL", "sample" => "http://themeforest.net"),
		),
		
		'testimonials' => array(
			array("section" => "Testimonial Option", "id" => "testimonial_name", "type" => "text", "title" => "Customer Name", "description" => "Enter customer name"),
			array("section" => "Testimonial Option", "id" => "testimonial_position", "type" => "text", "title" => "Customer Position", "description" => "Enter customer position in company"),
			array("section" => "Testimonial Option", "id" => "testimonial_company_name", "type" => "text", "title" => "Company Name", "description" => "Enter customer company name"),
			array("section" => "Testimonial Option", "id" => "testimonial_company_website", "type" => "text", "title" => "Company Website URL", "description" => "Enter customer company website URL"),
		),
);

function create_meta_box() {

	global $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}
	
	if ( function_exists('add_meta_box') && isset($postmetas) && count($postmetas) > 0 ) {  
		foreach($postmetas as $key => $postmeta)
		{
			if($_GET['post_type']==$key && !empty($postmeta))
			{
				add_meta_box( 'metabox', ucfirst($key).' Options', 'new_meta_box', $key, 'normal', 'high' );
			}
		}
	}

}  

function new_meta_box() {
	global $post, $postmetas, $gallery_template_urls;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}

	echo '<input type="hidden" name="pp_meta_form" id="pp_meta_form" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	//Get visual page template option
	$pp_visual_page_templates = get_option('pp_visual_page_templates');
	
	$meta_section = '';

	foreach ( $postmetas as $key => $postmeta ) {
	
		if($_GET['post_type'] == $key)
		{
		
			foreach ( $postmeta as $postmeta_key => $each_meta ) {
		
				$meta_id = $each_meta['id'];
				$meta_title = $each_meta['title'];
				$meta_description = $each_meta['description'];
				
				if(isset($postmeta['section']))
				{
					$meta_section = $postmeta['section'];
				}
				
				$meta_type = '';
				if(isset($each_meta['type']))
				{
					$meta_type = $each_meta['type'];
				}
				
				echo '<div id="post_option_'.strtolower($each_meta['id']).'" class="pp_meta_option key'.intval($postmeta_key+1).' '.$meta_type.'">';
				echo "<div class=\"meta_title_wrapper\">";
				echo "<strong>".$meta_title."</strong>";
				
				echo "<div class='pp_widget_description'>$meta_description</div>";
				
				echo "</div>";
				echo "<div class=\"meta_title_field\">";
				
				if ($meta_type == 'checkbox') {
					$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
					echo "<input type='checkbox' name='$meta_id' id='$meta_id' class='iphone_checkboxes' value='1' $checked />";
				}
				else if ($meta_type == 'select') {
					echo "<select name='$meta_id' id='$meta_id'>";
					
					if(!empty($each_meta['items']))
					{
						foreach ($each_meta['items'] as $key => $item)
						{
							echo '<option value="'.$key.'"';
							
							if($key == get_post_meta($post->ID, $meta_id, true))
							{
								echo ' selected ';
							}
							
							echo '>'.$item.'</option>';
						}
					}
					
					echo "</select>";
				}
				else if ($meta_type == 'template') {
					$current_value = get_post_meta($post->ID, $meta_id, true);
					echo "<input type='hidden' name='$meta_id' id='$meta_id' value='$current_value' />";
					echo "<ul name=\"".$meta_id."_list\" id=\"".$meta_id."_list\" class=\"meta_template_list\">";
					
					if(!empty($each_meta['items']))
					{
						foreach ($each_meta['items'] as $key => $template_name)
						{
							echo '<li data-parent="'.$meta_id.'" data-value="'.esc_attr($key).'" ';
							
							if($key == $current_value)
							{
								echo 'class="checked"';
							}
							
							echo '>';
							
							//Check if use visual page templates
						    if(!empty($pp_visual_page_templates))
						    {
								if(isset($gallery_template_urls[$key]))
								{
									echo '<a href="'.esc_url($gallery_template_urls[$key]).'" target="_blank" title="View Sample" class="tooltipster meta_template_link"><i class="fa fa-external-link"></i></a>';
								}
							}
							echo '<div class="template_title">'.$template_name.'</div>';
							echo '</li>';
						}
					}
					
					echo "</ul>";
				}
				else if ($meta_type == 'checkboxes') {
					if(!empty($each_meta['items']))
					{
						$checkboxes_post_values = get_post_meta($post->ID, $meta_id, true);
						
						echo '<div class="wp-tab-panel"><ul id="'.$meta_id.'_checklist">';
					
						foreach ($each_meta['items'] as $key => $item)
						{
							echo '<li>';
							echo '<input name="'.$meta_id.'[]" id="'.$meta_id.'[]" type="checkbox"  value="'.$key.'"';
							
							if(is_array($checkboxes_post_values) && !empty($checkboxes_post_values) && in_array($key, $checkboxes_post_values))
							{
								echo ' checked ';
							}
							
							echo '/>'.$item;
							echo '</li>';
						}
						
						echo '</ul></div>';
					}
				}
				else if ($meta_type == 'adding_list') {
					
					echo '<table id="'.$meta_id.'_sortable" class="adding_list_sortable">';
		
					echo '<thead>';
					echo '<tr>';
					
					echo '<th width="5%"></th>';
					echo '<th width="90%">'.esc_html__("Title", 'grandcarrental-custom-post').'</th>';
					echo '<th width="5%"></th>';
					
					echo '</tr>';
					echo '</thead>';
					
					echo '<tbody>';
					
					$adding_list_arr = get_post_meta($post->ID, $meta_id, true);
					
					if(!empty($adding_list_arr) && is_array($adding_list_arr))
					{
						foreach($adding_list_arr as $key => $adding_list_item)
						{
							echo '<tr>';
							echo '<td class="sortable_handle"><span class="dashicons dashicons-menu"></span></td>';
							echo '<td><input type="text" class="widefat" name="'.$meta_id.'[]" value="'.esc_attr($adding_list_item).'"></td>';
							echo '<td><a class="button adding_list_remove_row" href="javascript:;"><span class="dashicons dashicons-no-alt"></span></a></td>';
							echo '</tr>';
						}
					}
					else
					{
						echo '<tr>';
							echo '<td class="sortable_handle"><span class="dashicons dashicons-menu"></span></td>';
							echo '<td><input type="text" class="widefat" name="'.$meta_id.'[]" value=""></td>';
							echo '<td><a class="button adding_list_remove_row" href="javascript:;"><span class="dashicons dashicons-no-alt"></span></a></td>';
							echo '</tr>';
					}
					
					echo '</tbody>';
					echo '</table>';
		
					echo '<a id="'.$meta_id.'_add_row" class="button adding_list_add_row" data-target="'.$meta_id.'_sortable" data-metaid="'.$meta_id.'" href="javascript:;">'.esc_html__("Add another", 'grandcarrental-custom-post').'</a>';
					
					echo '<script>';
					echo '
						jQuery("#'.$meta_id.'_add_row").on( "click", function(){
							var rowHTML = \'\';
							rowHTML+= \'<tr>\';
							rowHTML+= \'<td class="sortable_handle"><span class="dashicons dashicons-menu"></span></td>\';
							rowHTML+= \'<td><input type="text" class="widefat" name="'.$meta_id.'[]"></td>\';
							rowHTML+= \'<td><a class="button adding_list_remove_row" href="javascript:;"><span class="dashicons dashicons-no-alt"></span></a></td>\';
							rowHTML+= \'</tr>\';
							
							jQuery("#'.$meta_id.'_sortable").find("tbody:last").append(rowHTML);
							addingListRemoveEvent();
						});
					';
					echo '</script>';
				}
				else if ($meta_type == 'file') { 
				    echo "<input type='text' name='$meta_id' id='$meta_id' class='' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:calc(100% - 75px)' /><input id='".$meta_id."_button' name='".$meta_id."_button' type='button' value='Upload' class='metabox_upload_btn button' readonly='readonly' rel='".$meta_id."' style='margin:0 0 0 5px' />";
				}
				else if ($meta_type == 'textarea') {
					if(isset($postmeta[$postmeta_key]['sample']))
					{
						echo "<textarea name='$meta_id' id='$meta_id' class=' hint' style='width:100%' rows='7' title='".$postmeta[$postmeta_key]['sample']."'>".get_post_meta($post->ID, $meta_id, true)."</textarea>";
					}
					else
					{
						echo "<textarea name='$meta_id' id='$meta_id' class='' style='width:100%' rows='7'>".get_post_meta($post->ID, $meta_id, true)."</textarea>";
					}
				}			
				else {
					if(isset($postmeta[$postmeta_key]['sample']))
					{
						echo "<input type='text' name='$meta_id' id='$meta_id' class='' title='".$postmeta[$postmeta_key]['sample']."' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:100%' />";
					}
					else
					{
						echo "<input type='text' name='$meta_id' id='$meta_id' class='' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:100%' />";
					}
				}
				
				echo "</div>";
				echo '</div>';
			}
		}
	}

}

function save_postdata( $post_id ) {

	global $postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['pp_meta_form']) && !wp_verify_nonce( $_POST['pp_meta_form'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']))
        return;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}
	
	if (isset($_POST['pp_meta_form'])) 
	{
		//If import page content builder
		if(is_admin() && isset($_POST['ppb_import_current']) && !empty($_POST['ppb_import_current']))
		{
			//If upload import builder file
			if(isset($_FILES['ppb_import_current_file']['name']) && !empty($_FILES['ppb_import_current_file']['name']))
			{
				//Check if zip file
				$import_filename = $_FILES['ppb_import_current_file']['name'];
				$import_type = $_FILES['ppb_import_current_file']['type'];
				$is_zip = FALSE;
				$new_filename = basename($import_filename, '_.zip');
				
				$accepted_types = array('application/zip', 
	                                'application/x-zip-compressed', 
	                                'multipart/x-zip', 
	                                'application/s-compressed');
	 
			    foreach($accepted_types as $mime_type) {
			        if($mime_type == $import_type) {
			            $is_zip = TRUE;
			            break;
			        } 
			    }
			}
			//If import demo pages
			else if(isset($_POST['ppb_import_demo_file']) && !empty($_POST['ppb_import_demo_file']))
			{
				$is_zip = FALSE;
			}
			//If import from saved template
			else if(isset($_POST['ppb_import_template_key']) && !empty($_POST['ppb_import_template_key']))
			{
				$is_zip = FALSE;
			}
			
			if($is_zip)
			{
				WP_Filesystem();
				$upload_dir = wp_upload_dir();
				$cache_dir = '';
				
				if(isset($upload_dir['basedir']))
				{
					$cache_dir = $upload_dir['basedir'].'/meteors';
				}
				
				move_uploaded_file($_FILES["ppb_import_current_file"]["tmp_name"], $cache_dir.'/'.$import_filename);
				//$unzipfile = unzip_file( $cache_dir.'/'.$import_filename, $cache_dir);
				
				$zip = new ZipArchive();
				$x = $zip->open($cache_dir.'/'.$import_filename);
				
				for($i = 0; $i < $zip->numFiles; $i++) {
			        $new_filename = $zip->getNameIndex($i);
			        break;
			    }  
				
				if ($x === true) {
					$zip->extractTo($cache_dir); 
					$zip->close();
				}

				$import_options_json = file_get_contents($cache_dir.'/'.$new_filename);
				unlink($cache_dir.'/'.$import_filename);
				unlink($cache_dir.'/'.$new_filename);
			}
			else
			{
				//If import demo pages
				if(isset($_POST['ppb_import_demo_file']) && !empty($_POST['ppb_import_demo_file']))
				{
					$import_options_json = file_get_contents(get_template_directory().'/cache/demos/pages/'.$_POST['ppb_import_demo_file']);
				}
				//If import from saved template
				else if(isset($_POST['ppb_import_template_key']) && !empty($_POST['ppb_import_template_key']))
				{
					$import_options_json = get_option( SHORTNAME."_template_".$_POST['ppb_import_template_key']);
				}
				else
				{
					//If .json file then import
					$import_options_json = $wp_filesystem->get_contents($_FILES["ppb_import_current_file"]["tmp_name"]);
					
					if(empty($import_options_json))
					{
						$import_options_json = file_get_contents($_FILES["ppb_import_current_file"]["tmp_name"]);
					}
				}
			}
			
			$import_options_arr = json_decode($import_options_json, true);
			
			if(isset($import_options_arr['ppb_form_data_order'][0]) && !empty($import_options_arr['ppb_form_data_order'][0]))
			{
				grandcarrental_page_update_custom_meta($post_id, $import_options_arr['ppb_form_data_order'][0], 'ppb_form_data_order');
			}
			
			$ppb_item_arr = explode(',', $import_options_arr['ppb_form_data_order'][0]);
			
			if(is_array($ppb_item_arr) && !empty($ppb_item_arr))
			{
				foreach($ppb_item_arr as $key => $ppb_item_arr)
				{
					if(isset($import_options_arr[$ppb_item_arr.'_data'][0]) && !empty($import_options_arr[$ppb_item_arr.'_data'][0]))
					{
						grandcarrental_page_update_custom_meta($post_id, $import_options_arr[$ppb_item_arr.'_data'][0], $ppb_item_arr.'_data');
					}
					
					if(isset($import_options_arr[$ppb_item_arr.'_size'][0]) && !empty($import_options_arr[$ppb_item_arr.'_size'][0]))
					{
						grandcarrental_page_update_custom_meta($post_id, $import_options_arr[$ppb_item_arr.'_size'][0], $ppb_item_arr.'_size');
					}
				}
			}
			
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit;
		}
	
		//If export page content builder
		if(is_admin() && isset($_POST['ppb_export_current']) && !empty($_POST['ppb_export_current']))
		{
			$page_title = get_the_title($post_id);
		
			$json_file_name = THEMENAME.'-Page-'.sanitize_title($page_title).'-Export-'.date('m-d-Y_hia');
			$json_file_name = strtolower($json_file_name);
	
			header('Content-disposition: attachment; filename='.$json_file_name.'.json');
			header('Content-type: application/json');
			
			//Get current content builder data
			$ppb_form_data_order = get_post_meta($post_id, 'ppb_form_data_order');
			$export_options_arr = array();
			
			if(!empty($ppb_form_data_order))
			{
				$export_options_arr['ppb_form_data_order'] = $ppb_form_data_order;

				//Get each builder module data
				$ppb_form_item_arr = explode(',', $ppb_form_data_order[0]);
			
				foreach($ppb_form_item_arr as $key => $ppb_form_item)
				{
					$ppb_form_item_data = get_post_meta($post_id, $ppb_form_item.'_data');
					$export_options_arr[$ppb_form_item.'_data'] = $ppb_form_item_data;
					
					$ppb_form_item_size = get_post_meta($post_id, $ppb_form_item.'_size');
					$export_options_arr[$ppb_form_item.'_size'] = $ppb_form_item_size;
				}
			}
		
			echo json_encode($export_options_arr);
			
			exit;
		}
	
		foreach ( $postmetas as $postmeta ) {
			foreach ( $postmeta as $each_meta ) {
				
				if (isset($_POST[$each_meta['id']]) && $_POST[$each_meta['id']]) {
					update_custom_meta($post_id, $_POST[$each_meta['id']], $each_meta['id']);
				}
				
				if (isset($_POST[$each_meta['id']]) && $_POST[$each_meta['id']] == "") {
					delete_post_meta($post_id, $each_meta['id']);
				}
				
				if (!isset($_POST[$each_meta['id']])) {
					delete_post_meta($post_id, $each_meta['id']);
				}
			
			}
		}
	
		// Saving Page Builder Data
		if(isset($_POST['ppb_enable']) && !empty($_POST['ppb_enable']))
		{
		    update_custom_meta($post_id, $_POST['ppb_enable'], 'ppb_enable');
		}
		else
		{
		    delete_post_meta($post_id, 'ppb_enable');
		}
		
		if(isset($_POST['ppb_form_data_order']) && !empty($_POST['ppb_form_data_order']))
		{
		    update_custom_meta($post_id, $_POST['ppb_form_data_order'], 'ppb_form_data_order');
		    
		    $ppb_item_arr = explode(',', $_POST['ppb_form_data_order']);
		    if(is_array($ppb_item_arr) && !empty($ppb_item_arr))
		    {
		    	foreach($ppb_item_arr as $key => $ppb_item_arr)
		    	{
		    		if(isset($_POST[$ppb_item_arr.'_data']) && !empty($_POST[$ppb_item_arr.'_data']))
		    		{
		    			update_custom_meta($post_id, $_POST[$ppb_item_arr.'_data'], $ppb_item_arr.'_data');
		    		}
		    		
		    		if(isset($_POST[$ppb_item_arr.'_size']) && !empty($_POST[$ppb_item_arr.'_size']))
		    		{
		    			update_custom_meta($post_id, $_POST[$ppb_item_arr.'_size'], $ppb_item_arr.'_size');
		    		}
		    	}
		    }
		}
		//If content builder is empty
		else
		{
		    update_custom_meta($post_id, '', 'ppb_form_data_order');
		}
		
		//If enable Content Builder then also copy its content to standard page content
		if (isset($_POST['ppb_enable']) && !empty($_POST['ppb_enable']) && ! wp_is_post_revision( $post_id ) )
		{
			//unhook this function so it doesn't loop infinitely
			remove_action('save_post', 'save_postdata');
		
			//update the post, which calls save_post again
			$ppb_page_content = grandcarrental_apply_builder($post_id, 'portfolios', FALSE);
			
			$current_post = array (
		      'ID'           => $post_id,
		      'post_content' => $ppb_page_content,
		    );
		    
		    wp_update_post($current_post);
		    if (is_wp_error($post_id)) {
				$errors = $post_id->get_error_messages();
				foreach ($errors as $error) {
					echo esc_html($error);
				}
			}
	
			//re-hook this function
			add_action('save_post', 'save_postdata');
		}
	}
}

function update_custom_meta($postID, $newvalue, $field_name) {

	if (isset($_POST['pp_meta_form'])) 
	{
		if (!get_post_meta($postID, $field_name)) {
			add_post_meta($postID, $field_name, $newvalue);
		} else {
			update_post_meta($postID, $field_name, $newvalue);
		}
	}

}

//init

add_action('admin_menu', 'create_meta_box'); 
add_action('save_post', 'save_postdata'); 

/*
	End creating custom fields
*/

//Include gallery admin interface
include_once (plugin_dir_path( __FILE__ ) . "/gallery/tg-gallery.php");

//Include Theme Shortcode
include_once (plugin_dir_path( __FILE__ ) . "tg-shortcode.php");

//Include Content Builder Shortcode
include_once (plugin_dir_path( __FILE__ ) . "tg-contentbuilder.php");

//Include plugin filter & hook
include_once (plugin_dir_path( __FILE__ ) . "tg-filter.php");
?>