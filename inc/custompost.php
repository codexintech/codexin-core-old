<?php 
/**
* The Function Cotain all propertyes & attributes of Custom Posts Type..
* Create Two Arrays ($labes, $args) That Stores All Labes And Attributes of Custome Post Type..
* Developed by Reveal on 12-04-2017,
* Updated and modified by Reveal..
*
*/

 add_action( 'init', 'reveal_framework_custompost_type' );

 function reveal_framework_custompost_type() {

 //Create a custom post for Portfolio...
 	$labels = array(
 				'name'					=> 'Portfolio',
 				'singular_name'			=> 'Portfolio',
 				'add_new'				=> 'Add Portfolio',
 				'all_items'				=> 'All Portfolio',
 				'add_new_item'			=> 'Add Portfolio',
 				'edit_item'				=> 'Edit Portfolio',
 				'new_item'				=> 'New Portfolio',
 				'view_item'				=> 'View Portfolio',
 				'search_item'			=> 'Search Portfolio Post',
 				'not_found'				=> 'No Portfolio Found',
 				'not_found_in_trash' 	=> 'No Portfolio In Trash',
 				'parent_item_colon'		=> 'Parent Portfolio'

 			);

 	// Create a Aruments Array that Store all argumens of posts..
 	$args = array(
 			'labels'				=> $labels,
 			'menu_icon'				=> 'dashicons-art',
 			'public'				=> true,
 			'has_archive'			=> true,
 			'publicly_queryable'	=> true,
 			'query_var'				=> true,
 			'rewrite'				=> true,
 			'capability-type'		=> 'post',
 			'hierarchical'			=> true,
 			// $Supports Array Create Custome From Fiels In WP-Dashbord,Defults are (title,Editor)
 			'supports'				=> array(
 										'title',
 										'editor',
 										'excerpt',
 										'thumbnail',
 										'comments'
 									),
 			'taxonomies'			=> array( ''),
 			'menu_position'			=> 5,
 			'exclude_from_search'	=> false
 		);

 	register_post_type( 'portfolio', $args );


 	//Create a custom post for Testimonial...
 	$labels = array(
 				'name'					=> 'Testimonial',
 				'singular_name'			=> 'Testimonial',
 				'add_new'				=> 'Add Testimonial',
 				'all_items'				=> 'All Testimonial',
 				'add_new_item'			=> 'Add Testimonial',
 				'edit_item'				=> 'Edit Testimonial',
 				'new_item'				=> 'New Testimonial',
 				'view_item'				=> 'View Testimonial',
 				'search_item'			=> 'Search Testimonial Post',
 				'not_found'				=> 'No Testimonial Found',
 				'not_found_in_trash' 	=> 'No Testimonial In Trash',
 				'parent_item_colon'		=> 'Parent Testimonial'

 			);

 	// Create a Aruments Array that Store all argumens of posts..
 	$args = array(
 			'labels'				=> $labels,
 			'menu_icon'				=> 'dashicons-admin-customizer',
 			'public'				=> true,
 			'has_archive'			=> false,
 			'publicly_queryable'	=> false,
 			'query_var'				=> true,
 			'rewrite'				=> true,
 			'capability-type'		=> 'post',
 			'hierarchical'			=> true,
 			// $Supports Array Create Custome From Fiels In WP-Dashbord,Defults are (title,Editor)
 			'supports'				=> array(
 										'title',
 										'editor',
 										'excerpt',
 										'thumbnail'
 									),
 			'taxonomies'			=> array(''),
 			'menu_position'			=> 11,
 			'exclude_from_search'	=> false
 		);

 	register_post_type( 'testimonial', $args );

 	//Create a custom post for Clients...
 	$labels = array(
 				'name'					=> 'Clients',
 				'singular_name'			=> 'Clients',
 				'add_new'				=> 'Add Clients',
 				'all_items'				=> 'All Clients',
 				'add_new_item'			=> 'Add Clients',
 				'edit_item'				=> 'Edit Clients',
 				'new_item'				=> 'New Clients',
 				'view_item'				=> 'View Clients',
 				'search_item'			=> 'Search Clients Post',
 				'not_found'				=> 'No Clients Found',
 				'not_found_in_trash' 	=> 'No Clients In Trash',
 				'parent_item_colon'		=> 'Parent Clients'

 			);

 	// Create a Aruments Array that Store all argumens of posts..
 	$args = array(
 			'labels'				=> $labels,
 			'menu_icon'				=> 'dashicons-universal-access-alt',
 			'public'				=> true,
 			'has_archive'			=> false,
 			'publicly_queryable'	=> false,
 			'query_var'				=> true,
 			'rewrite'				=> true,
 			'capability-type'		=> 'post',
 			'hierarchical'			=> true,
 			// $Supports Array Create Custome From Fiels In WP-Dashbord,Defults are (title,Editor)
 			'supports'				=> array(
 										'title',
 										'thumbnail'
 									),
 			'taxonomies'			=> array(''),
 			'menu_position'			=> 12,
 			'exclude_from_search'	=> false
 		);

 	register_post_type( 'clients', $args );


 	//Create a custom post for Events...
 	$labels = array(
 				'name'					=> 'Events',
 				'singular_name'			=> 'Events',
 				'add_new'				=> 'Add Events',
 				'all_items'				=> 'All Events',
 				'add_new_item'			=> 'Add Events',
 				'edit_item'				=> 'Edit Events',
 				'new_item'				=> 'New Events',
 				'view_item'				=> 'View Events',
 				'search_item'			=> 'Search Events Post',
 				'not_found'				=> 'No Events Found',
 				'not_found_in_trash' 	=> 'No Events In Trash',
 				'parent_item_colon'		=> 'Parent Events'
 			);

 	// Create a Aruments Array that Store all argumens of posts..
 	$args = array(
 			'labels'				=> $labels,
 			'menu_icon'				=> 'dashicons-nametag',
 			'public'				=> true,
 			'has_archive'			=> true,
 			'publicly_queryable'	=> true,
 			'query_var'				=> true,
 			'rewrite'				=> true,
 			'capability-type'		=> 'post',
 			'hierarchical'			=> true,
 			// $Supports Array Create Custome From Fiels In WP-Dashbord,Defults are (title,Editor)
 			'supports'				=> array(
 										'title',
 										'editor',
 										'excerpt',
 										'thumbnail',
 									),
 			'taxonomies'			=> array( ''),
 			'menu_position'			=> 7,
 			'exclude_from_search'	=> false
 		);

 	register_post_type( 'events', $args );


} // End reveal_framework_custompost_type()...


/**
 * Create Custom Place Holders..
 */
	add_filter('enter_title_here', 'codexin_title_placeholder', 0, 2 );

	function codexin_title_placeholder( $title , $post ){

		if( $post->post_type == 'portfolio' ) {
			$cx_title = "Enter Portfolio Title..";
			return $cx_title;
		} elseif( $post->post_type == 'team' ) {
			$cx_title = "Enter Team Member Or Staff Name..";
			return $cx_title;
		} elseif( $post->post_type == 'testimonial' ) {
			$cx_title = "Enter Testimonial Title..";
			return $cx_title;
		} elseif( $post->post_type == 'clients' ) {
			$cx_title = "Enter Client Name..";
			return $cx_title;
		}elseif( $post->post_type == 'events' ) {
			$cx_title = "Enter Events Name..";
			return $cx_title;
		}

		return $title;

	}

function reveal_portfolio_taxonomies_type() {

	// add new taxonomy hierarchical

	$labels = array(

		'name' 				=> __('Portfolio Categories', 'reveal'),
		'singular_name' 	=> __('Portfolio Category', 'reveal'),
		'search_items' 		=> __('Search Portfolio Category', 'reveal'),
		'all_items' 		=> __('All Portfolio Categories', 'reveal'),
		'parent_item' 		=> __('Parent Portfolio Category', 'reveal'),
		'parent_item_colon' => __('Parent Portfolio Category:', 'reveal'),
		'edit_item' 		=> __('Edit Portfolio Category', 'reveal'),
		'update_item' 		=> __('Update Portfolio Category', 'reveal'),
		'add_new_item' 		=> __('Add New Portfolio Category', 'reveal'),
		'new_item_name' 	=> __('New Portfolio Category Name', 'reveal'),
		'menu_name' 		=> __('Portfolio Categories', 'reveal')

	);



	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'has_archive'	=> true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'portfolio-category')
	);



	register_taxonomy('portfolio-category', array('portfolio'), $args);

	// add new taxonomy NON hierarchical



	register_taxonomy('portfolio_tags', 'portfolio', array(

		'label' => 'Portfolio Tags',

		'rewrite' => array('slug' => 'portfolio-tags'),

		'hierarchical' => false

	));

}



add_action('init', 'reveal_portfolio_taxonomies_type');