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

        define('CODEXIN_CORE_INC_DIR', plugin_dir_path( __FILE__ ) .'inc');
        define('CODEXIN_CORE_ASSET_DIR', plugin_dir_url( __FILE__ ) .'assets');

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

		// Registering Shortcodes
		require_once CODEXIN_CORE_INC_DIR . '/cx_shortcodes.php';

		// Integrating the Shortcodes in King Composer 
		require_once CODEXIN_CORE_INC_DIR . '/kc_integrated.php';

	}

	/**
	 * Enqueques styles and scripts
	 * 
	 * @since v1.0.0
	 */
	public function codexin_enqueque() {

<<<<<<< HEAD
		add_action( 'wp_footer', array( $this, 'codexin_scripts' ) );
=======
		add_action( 'wp_enqueue_scripts', array( $this, 'codexin_styles' ), 9 );
		add_action( 'wp_enqueue_scripts', array( $this, 'codexin_scripts' ), 999 );

	}

	public function codexin_styles() {

		wp_enqueue_style( 'codexin-shortcodes-stylesheet', CODEXIN_CORE_ASSET_DIR . '/css/shortcodes.css', false, '1.0','all');
>>>>>>> e0a19e9d8b2d575a50a8687502e73f4243a96536

	}

	public function codexin_scripts() {

<<<<<<< HEAD
		wp_enqueue_style( 'codexin-shortcodes-stylesheet', CODEXIN_CORE_ASSET_DIR . '/css/shortcodes.css',false,'1.0','all' );
		wp_enqueue_script( 'codexin-js-script', CODEXIN_CORE_ASSET_DIR . '/js/shortcode.js', array ( 'jquery' ), 1.0, true );
=======
		wp_enqueue_script( 'codexin-js-script', CODEXIN_CORE_ASSET_DIR . '/js/shortcode.js', array ( 'jquery' ), 1.0, true);
>>>>>>> e0a19e9d8b2d575a50a8687502e73f4243a96536

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
