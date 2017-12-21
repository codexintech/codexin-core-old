<?php 

/**
 * The file Contains all propertyes & attributes of all the Custom Posts Type and Taxonomies used in the 'Reveal' Theme
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );


add_action( 'init', 'codexin_custompost_type' );
/**
 * Function to register all the Custom Post Types
 *
 * @since 1.0
 */
function codexin_custompost_type() {

	/**
	 * Custom Post Type -  Portfolio
	 *
	 */

	// Creating the Labels for Portfolio Custom Post
 	$labels = array(
		'name'					=> esc_html__( 'Portfolio', 'codexin' ),
		'singular_name'			=> esc_html__( 'Portfolio', 'codexin' ),
		'add_new'				=> esc_html__( 'Add Portfolio', 'codexin' ),
		'all_items'				=> esc_html__( 'All Portfolio', 'codexin' ),
		'add_new_item'			=> esc_html__( 'Add Portfolio', 'codexin' ),
		'edit_item'				=> esc_html__( 'Edit Portfolio', 'codexin' ),
		'new_item'				=> esc_html__( 'New Portfolio', 'codexin' ),
		'view_item'				=> esc_html__( 'View Portfolio', 'codexin' ),
		'search_item'			=> esc_html__( 'Search Portfolio Post', 'codexin' ),
		'not_found'				=> esc_html__( 'No Portfolio Found', 'codexin' ),
		'not_found_in_trash' 	=> esc_html__( 'No Portfolio In Trash', 'codexin' ),
		'parent_item_colon'		=> esc_html__( 'Parent Portfolio', 'codexin' )

	);

 	// Creating an Aruments Array that Store all argumens of Portfolio Custom Post
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

 	// Registering the Portfolio Custom Post
 	register_post_type( 'portfolio', $args );


	/**
	 * Custom Post Type -  Testimonial
	 *
	 */

 	// Creating the Labels for Testimonial Custom Post
 	$labels = array(
		'name'					=> esc_html__( 'Testimonial', 'codexin' ),
		'singular_name'			=> esc_html__( 'Testimonial', 'codexin' ),
		'add_new'				=> esc_html__( 'Add Testimonial', 'codexin' ),
		'all_items'				=> esc_html__( 'All Testimonial', 'codexin' ),
		'add_new_item'			=> esc_html__( 'Add Testimonial', 'codexin' ),
		'edit_item'				=> esc_html__( 'Edit Testimonial', 'codexin' ),
		'new_item'				=> esc_html__( 'New Testimonial', 'codexin' ),
		'view_item'				=> esc_html__( 'View Testimonial', 'codexin' ),
		'search_item'			=> esc_html__( 'Search Testimonial Post', 'codexin' ),
		'not_found'				=> esc_html__( 'No Testimonial Found', 'codexin' ),
		'not_found_in_trash' 	=> esc_html__( 'No Testimonial In Trash', 'codexin' ),
		'parent_item_colon'		=> esc_html__( 'Parent Testimonial', 'codexin' )

	);

 	// Creating an Aruments Array that Store all argumens of Testimonial Custom Post
 	$args = array(
		'labels'				=> $labels,
		'menu_icon'				=> 'dashicons-admin-customizer',
		'public'				=> true,
		'has_archive'			=> true,
		'publicly_queryable'	=> true,
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability-type'		=> 'post',
		'hierarchical'			=> true,
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

	// Registering the Testimonial Custom Post
 	register_post_type( 'testimonial', $args );


	/**
	 * Custom Post Type -  Clients
	 *
	 */

 	// Creating the Labels for Clients Custom Post
 	$labels = array(
		'name'					=> esc_html__( 'Clients', 'codexin' ),
		'singular_name'			=> esc_html__( 'Clients', 'codexin' ),
		'add_new'				=> esc_html__( 'Add Clients', 'codexin' ),
		'all_items'				=> esc_html__( 'All Clients', 'codexin' ),
		'add_new_item'			=> esc_html__( 'Add Clients', 'codexin' ),
		'edit_item'				=> esc_html__( 'Edit Clients', 'codexin' ),
		'new_item'				=> esc_html__( 'New Clients', 'codexin' ),
		'view_item'				=> esc_html__( 'View Clients', 'codexin' ),
		'search_item'			=> esc_html__( 'Search Clients Post', 'codexin' ),
		'not_found'				=> esc_html__( 'No Clients Found', 'codexin' ),
		'not_found_in_trash' 	=> esc_html__( 'No Clients In Trash', 'codexin' ),
		'parent_item_colon'		=> esc_html__( 'Parent Clients', 'codexin' )

	);

 	// Creating an Aruments Array that Store all argumens of Clients Custom Post
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
		'supports'				=> array(
									'title',
									'thumbnail'
								),
		'taxonomies'			=> array(''),
		'menu_position'			=> 12,
		'exclude_from_search'	=> false
	);

	// Registering the Clients Custom Post
 	register_post_type( 'clients', $args );


	/**
	 * Custom Post Type -  Team
	 *
	 */

 	// Creating the Labels for team Custom Post
 	$labels = array(
		'name'					=> esc_html__( 'Team', 'codexin' ),
		'singular_name'			=> esc_html__( 'Team', 'codexin' ),
		'add_new'				=> esc_html__( 'Add New Member', 'codexin' ),
		'all_items'				=> esc_html__( 'All Members', 'codexin' ),
		'add_new_item'			=> esc_html__( 'Add New Member', 'codexin' ),
		'edit_item'				=> esc_html__( 'Edit Member', 'codexin' ),
		'new_item'				=> esc_html__( 'New Member', 'codexin' ),
		'view_item'				=> esc_html__( 'View Member', 'codexin' ),
		'search_item'			=> esc_html__( 'Search Team Member', 'codexin' ),
		'not_found'				=> esc_html__( 'No Team Member Found', 'codexin' ),
		'not_found_in_trash' 	=> esc_html__( 'No Team Member In Trash', 'codexin' ),
		'parent_item_colon'		=> esc_html__( 'Parent Team', 'codexin' )

	);

 	// Creating an Aruments Array that Store all argumens of Team Custom Post
 	$args = array(
		'labels'				=> $labels,
		'menu_icon'				=> 'dashicons-groups',
		'public'				=> true,
		'has_archive'			=> true,
		'publicly_queryable'	=> true,
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability-type'		=> 'post',
		'hierarchical'			=> true,
		'supports'				=> array(
									'title',
									'thumbnail',
									'editor',
									'excerpt'
								),
		'taxonomies'			=> array(''),
		'menu_position'			=> 5,
		'exclude_from_search'	=> false
	);

	// Registering the Team Custom Post
 	register_post_type( 'team', $args );


	/**
	 * Custom Post Type -  Events
	 *
	 */

 	// Creating the Labels for Events Custom Post
 	$labels = array(
		'name'					=> esc_html__( 'Events', 'codexin' ),
		'singular_name'			=> esc_html__( 'Events', 'codexin' ),
		'add_new'				=> esc_html__( 'Add Events', 'codexin' ),
		'all_items'				=> esc_html__( 'All Events', 'codexin' ),
		'add_new_item'			=> esc_html__( 'Add Events', 'codexin' ),
		'edit_item'				=> esc_html__( 'Edit Events', 'codexin' ),
		'new_item'				=> esc_html__( 'New Events', 'codexin' ),
		'view_item'				=> esc_html__( 'View Events', 'codexin' ),
		'search_item'			=> esc_html__( 'Search Events Post', 'codexin' ),
		'not_found'				=> esc_html__( 'No Events Found', 'codexin' ),
		'not_found_in_trash' 	=> esc_html__( 'No Events In Trash', 'codexin' ),
		'parent_item_colon'		=> esc_html__( 'Parent Events', 'codexin' )
	);

 	// Creating an Aruments Array that Store all argumens of Events Custom Post
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

	// Registering the Events Custom Post
 	register_post_type( 'events', $args );


} // End codexin_custompost_type()


add_action('init', 'codexin_cpt_taxonomies');
/**
 * Function to register all the Custom Taxonomies for Custom Post Type
 *
 * @since 1.0
 */
function codexin_cpt_taxonomies() {

	/**
	 * Custom Taxonomy for Portfolio Custom Post
	 *
	 */

	// Adding new taxonomy (hierarchical)
	$labels = array(
		'name' 				=> esc_html__( 'Portfolio Categories', 'codexin' ),
		'singular_name' 	=> esc_html__( 'Portfolio Category', 'codexin' ),
		'search_items' 		=> esc_html__( 'Search Portfolio Category', 'codexin' ),
		'all_items' 		=> esc_html__( 'All Portfolio Categories', 'codexin' ),
		'parent_item' 		=> esc_html__( 'Parent Portfolio Category', 'codexin' ),
		'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'codexin' ),
		'edit_item' 		=> esc_html__( 'Edit Portfolio Category', 'codexin' ),
		'update_item' 		=> esc_html__( 'Update Portfolio Category', 'codexin' ),
		'add_new_item' 		=> esc_html__( 'Add New Portfolio Category', 'codexin' ),
		'new_item_name' 	=> esc_html__( 'New Portfolio Category Name', 'codexin' ),
		'menu_name' 		=> esc_html__( 'Portfolio Categories', 'codexin' )
	);

	$args = array(
		'hierarchical' 		=> true,
		'labels' 			=> $labels,
		'show_ui' 			=> true,
		'has_archive'		=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'rewrite' 			=> array( 'slug' => 'portfolio-category' )
	);

	// Registering the hierarchical Taxonomy
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), $args );

	// Registering new taxonomy NON hierarchical
	register_taxonomy( 'portfolio_tags', 'portfolio', array(
			'label' 		=> esc_html__( 'Portfolio Tags', 'codexin' ),
			'rewrite' 		=> array( 'slug' => 'portfolio-tags' ),
			'hierarchical' 	=> false
		)
	);


	/**
	 * Custom Taxonomy for Events Custom Post
	 *
	 */

	// Adding new taxonomy (hierarchical)
	$labels = array(
		'name' 				=> esc_html__( 'Events Categories', 'codexin' ),
		'singular_name' 	=> esc_html__( 'Events Category', 'codexin' ),
		'search_items' 		=> esc_html__( 'Search Events Category', 'codexin' ),
		'all_items' 		=> esc_html__( 'All Events Categories', 'codexin' ),
		'parent_item' 		=> esc_html__( 'Parent Events Category', 'codexin' ),
		'parent_item_colon' => esc_html__( 'Parent Events Category:', 'codexin' ),
		'edit_item' 		=> esc_html__( 'Edit Events Category', 'codexin' ),
		'update_item' 		=> esc_html__( 'Update Events Category', 'codexin' ),
		'add_new_item' 		=> esc_html__( 'Add New Events Category', 'codexin' ),
		'new_item_name' 	=> esc_html__( 'New Events Category Name', 'codexin' ),
		'menu_name' 		=> esc_html__( 'Events Categories', 'codexin' )
	);

	$args = array(
		'hierarchical' 		=> true,
		'labels' 			=> $labels,
		'show_ui' 			=> true,
		'has_archive'		=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'rewrite' 			=> array( 'slug' => 'events-category' )
	);

	// Registering the hierarchical Taxonomy
	register_taxonomy( 'events-category', array( 'events' ), $args );

	// Registering new taxonomy NON hierarchical
	register_taxonomy( 'events_tags', 'events', array(
			'label' 		=> esc_html__( 'Events Tags', 'codexin' ),
			'rewrite' 		=> array( 'slug' => 'events-tags' ),
			'hierarchical' 	=> false

		)
	);

}


/**
 * Creating Custom Place Holders for the Custom Post Types
 */
add_filter( 'enter_title_here', 'codexin_title_placeholder', 0, 2 );
/**
 * Function to Create Custom Title Placeholders for the Custom Post Types
 *
 * @since 1.0
 */
function codexin_title_placeholder( $title , $post ) {

	if( $post->post_type == 'portfolio' ) {
		$cx_title = esc_html__( 'Enter Portfolio Title', 'codexin' );
		return $cx_title;
	} elseif( $post->post_type == 'team' ) {
		$cx_title = esc_html__( 'Enter Team Member Or Staff Name', 'codexin' );
		return $cx_title;
	} elseif( $post->post_type == 'testimonial' ) {
		$cx_title = esc_html__( 'Enter Testimonial Title', 'codexin' );
		return $cx_title;
	} elseif( $post->post_type == 'clients' ) {
		$cx_title = esc_html__( 'Enter Client Name', 'codexin' );
		return $cx_title;
	} elseif( $post->post_type == 'events' ) {
		$cx_title = esc_html__( 'Enter Events Name', 'codexin' );
		return $cx_title;
	}

	return $title;

}