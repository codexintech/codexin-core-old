<?php
/*
Plugin Name: Codexin Core
Plugin URI: http://codexin.com
Description: A plugin to carry out all the core functionalities for Reveal theme
Version: 1.0
Author: Codexin
Author URI: http://codexin.com
License: GPL2
Text Domain: codexin
*/


class Codexin_Core {

	/**
	 * Call all loading functions.
	 * 
	 * @since v1.0.0
	 */

	public function __construct() {

		// Declaring Global Variables for plugin paths and URL
        define('CODEXIN_CORE_INC_DIR', plugin_dir_path( __FILE__ ) .'inc');
        define('CODEXIN_CORE_ASSET_DIR', plugin_dir_url( __FILE__ ) .'assets');
        define('CODEXIN_CORE_SC_DIR', plugin_dir_path( __FILE__ ) .'inc/shortcodes');
        define('CODEXIN_CORE_WDGT_DIR', plugin_dir_path( __FILE__ ) .'inc/widgets');

		// Loading the core files
		$this -> codexin_includes();

		// Enquequeing styles and scripts
		$this -> codexin_enqueque();

		// Register actions using add_actions() custom function.
		$this -> codexin_add_actions();

	}

	/**
	 * Loading the core files
	 * 
	 * @since v1.0.0
	 */
	public function codexin_includes() {

		// Registering Custom Posts
		require_once CODEXIN_CORE_INC_DIR . '/custompost.php';

		// Registering and Integrating the Shortcodes in King Composer 
		require_once CODEXIN_CORE_INC_DIR . '/shortcode_loader.php';

		// Registering Admin Menu for plugin
		if(is_admin()){
			require_once CODEXIN_CORE_INC_DIR . '/admin_menu.php';
		}

		// Adding Helper File
		require_once CODEXIN_CORE_INC_DIR . '/helpers.php';

		// Adding metaboxes
		require_once CODEXIN_CORE_INC_DIR . '/metaboxes.php';

		// Initalizing custom widgets
		$cx_widgets = glob(CODEXIN_CORE_WDGT_DIR.'/*.php');
		foreach ($cx_widgets as $cx_widget){
		    require_once( sanitize_text_field( $cx_widget ) );    		    
		}

		// Loading all the custom shortcode files
		$cx_sc_files = glob(CODEXIN_CORE_SC_DIR.'/*.php');
		foreach ($cx_sc_files as $filename){
		    require_once( sanitize_text_field( $filename ) );    		    
		}

	}

	/**
	 * Enqueques styles and scripts
	 * 
	 * @since v1.0.0
	 */

	public function codexin_enqueque() {

		add_action( 'wp_enqueue_scripts', array( $this, 'codexin_styles' ), 9 );
		add_action( 'wp_enqueue_scripts', array( $this, 'codexin_script' ), 999 );

	}

	public function codexin_styles() {

		wp_enqueue_style( 'codexin-shortcodes-stylesheet', CODEXIN_CORE_ASSET_DIR . '/css/shortcodes.css', false, '1.0','all');
		wp_enqueue_style( 'codexin-widget-stylesheet', CODEXIN_CORE_ASSET_DIR . '/css/widgets.css', false, '1.0','all');
		// wp_enqueue_style( 'codexin-responsive-stylesheet', CODEXIN_CORE_ASSET_DIR . '/css/responsive.css', false, '1.0','all');

	}

	public function codexin_script() {

		wp_enqueue_script( 'codexin-post-like-script', CODEXIN_CORE_ASSET_DIR . '/js/codexin-post-like.js', array( 'jquery' ), '0.5', true );
		wp_enqueue_script( 'modernizr-custom', CODEXIN_CORE_ASSET_DIR . '/js/modernizr-custom.js', array( 'jquery' ), '0.5', true );
		wp_localize_script( 'codexin-post-like-script', 'postLikes', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'like' => esc_html__( 'Like', 'codexin' ),
			'unlike' => esc_html__( 'Unlike', 'codexin' )
		) );

	}

	/**
	 * Add actions and filters in the plugin.
	 * 
	 * @uses add_action()
	 * @uses add_filter()
	 * @since v1.0.0
	 */

	public function codexin_add_actions() {

		/**
		 * Load plugin text domain.
		 *
		 * @since 1.0.0
		 */
		add_action( 'init', 'codexin_core_load_textdomain' );
		function codexin_core_load_textdomain() {
			load_plugin_textdomain( 'codexin-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
		}

		/**
		 * Adding custom image sizes.
		 *
		 * @since 1.0.0
		 */
		add_action( 'init', 'codexin_add_image_sizes' );
		function codexin_add_image_sizes() {
			add_image_size('rectangle-one', 600, 400, true);
			add_image_size('rectangle-two', 570, 464, true);
			add_image_size('rectangle-three', 480, 595, true);
			add_image_size('rectangle-four', 600, 327, true);
			add_image_size('rectangle-five', 740, 580, true);
			add_image_size('square-one', 220, 220, true);
			add_image_size('square-two', 500, 500, true);
		  	add_image_size('blog-grid-image', 540, 341, true);
		  	add_image_size('event-v2-image', 570, 310, true);
			add_image_size('first-portfolio-img-rv2', 370, 550, true);
			add_image_size('portfolio-min-img-rv2', 370, 250, true);
			add_image_size('rv2-blog-mini-img', 360, 282, true);
		}

		/**
		 * Adding flaticons on front end for King Composer
		 *
		 */
		add_action('init', 'codexin_flaticons');
		function codexin_flaticons() {
			if( function_exists( 'kc_add_icon' ) ) {
				kc_add_icon( CODEXIN_CORE_ASSET_DIR.'/icofonts/flaticon.css' );
			}
		}

	}

}


// Instantiating the class
$codexin_core = new Codexin_Core();
		

?>
