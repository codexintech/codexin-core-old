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


		// Loading the core files
		$this -> codexin_includes();

		// Enquequeing styles
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

		// Loading all the custom shortcode files
		$cx_files = glob(CODEXIN_CORE_SC_DIR.'/*.php');
		foreach ($cx_files as $filename){
		    require_once( sanitize_text_field( $filename ) );    		    
		}

	}

	/**
	 * Enqueques styles
	 * 
	 * @since v1.0.0
	 */

	public function codexin_enqueque() {

		add_action( 'wp_enqueue_scripts', array( $this, 'codexin_styles' ), 9 );

	}

	public function codexin_styles() {

		wp_enqueue_style( 'codexin-shortcodes-stylesheet', CODEXIN_CORE_ASSET_DIR . '/css/shortcodes.css', false, '1.0','all');

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

	}

}


// Instantiating the class
$codexin_core = new Codexin_Core();
		

?>
