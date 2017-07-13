<?php
/*
Plugin Name: Codexin Core
Plugin URI: http://codexin.com
Description: A plugin to carry out all the core functionalities for Reveal theme
Version: 1.0
Author: Codexin
Author URI: http://codexin.com
License: GPL2
*/


require_once( 'cx_shortcodes.php' );
require_once( 'kc_integrated.php' );


function codexin_shortcodes_scripts () {
	wp_enqueue_style( 'codexin-shortcode-stylesheet', plugin_dir_url( __FILE__ ) . 'assets/css/shortcodes.css',false,'1.1','all');
	wp_enqueue_script( 'codexin-js-script', plugin_dir_url( __FILE__ ) . 'assets/js/shortcode.js', array ( 'jquery' ), 1.1, true);

} 

add_action( 'wp_enqueue_scripts', 'codexin_shortcodes_scripts');



class Codexin_Core {

	/**
	 * Call all loading functions.
	 * 
	 * @since v1.0.0
	 */
	public function __construct() {

        define('CODEXIN_CORE_INC_DIR', plugin_dir_url( __FILE__ ) .'inc');
        define('CODEXIN_CORE_ASSET_DIR', plugin_dir_url( __FILE__ ) .'assets');

		// Loading the core files
		$this -> codexin_includes();

		// Enquequeing styles and scripts 
		$this -> codexin_enqueque();

		// Register actions using add_actions() custom function.
		$this -> reveal_add_actions();

	}

	/**
	 * Loading the core files
	 * 
	 * @since v1.0.0
	 */
	public function codexin_includes() {

		// Registering Custom Posts
		require_once CODEXIN_CORE_INC_DIR . '/inc/custompost.php';

		// Registering Shortcodes
		require_once CODEXIN_CORE_INC_DIR . '/inc/cx_shortcodes.php';

		// Register widgets and Custom widgets
		require_once CODEXIN_CORE_INC_DIR . '/inc/widgets.php';

		// Integrating the Shortcodes in King Composer 
		require_once CODEXIN_CORE_INC_DIR . '/inc/kc_integrated.php';

	}

	/**
	 * Enqueques styles and scripts
	 * 
	 * @since v1.0.0
	 */
	public function codexin_enqueque() {

		add_action( 'init', array( $this, 'codexin_scripts' ) );

	}

	public function codexin_scripts() {

		wp_enqueue_style( 'codexin-shortcodes-stylesheet', CODEXIN_CORE_ASSET_DIR . 'assets/css/shortcodes.css',false,'1.0','all');
		wp_enqueue_script( 'codexin-js-script', CODEXIN_CORE_ASSET_DIR . 'assets/js/shortcode.js', array ( 'jquery' ), 1.0, true);

	}

	/**
	 * Add actions and filters in the plugin.
	 * 
	 * @uses add_action()
	 * @uses add_filter()
	 * @since v1.0.0
	 */

	public function reveal_add_actions() {

		// Providing Shortcode Support on text widget
		add_filter( 'widget_text', 'do_shortcode' );

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


// Instantiating the class
$codexin_core = new Codexin_Core();

?>
