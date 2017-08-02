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

		// Register Custom Menu for plugin
		$this -> codexin_menu_actions();

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

	public function codexin_menu_actions() {

		add_action( 'admin_menu', array($this, 'cx_register_menu') );

		add_action( 'admin_init', array( $this, 'cx_settings_fields' ) );

	}

	public function cx_register_menu()
	{
		$menu = add_menu_page(
				esc_html__('Codexin Core Options', 'codexin'),
				esc_html__('Codexin Options', 'codexin'),
				'manage_options',
				'cx_options',
				array($this, 'cx_show_options')
		 );
		
	}

	public function cx_show_options() {

		?>
		<div id="wrap">
		<?php
		$current_screen = get_current_screen();
		// Verify that data is being saved ONLY from the NinjaStars options page.
		if ( $current_screen->id == "cx_options" && isset( $_POST['cx_submit_opts'] ) ) :
			if ( isset( $_POST['ninjastars_color'] ) ) : 
				update_option( 'ninjastars_color', sanitize_text_field( $_POST['ninjastars_color'] ) );
			endif;
			if ( isset( $_POST['ninjastars_logo'] ) ) :
				update_option( 'ninjastars_logo', sanitize_text_field( $_POST['ninjastars_logo'] ) );
			endif;
			if ( isset( $_POST['ninjastars_rcolor'] ) ) :
				update_option( 'ninjastars_rcolor', sanitize_text_field( $_POST['ninjastars_rcolor'] ) );
			endif;
			if ( isset( $_POST['ninjastars_readmore'] ) ) :
				update_option( 'ninjastars_readmore', sanitize_text_field( $_POST['ninjastars_readmore'] ) );
			endif;
			if ( isset( $_POST['ninjastars_fcolor'] ) ) :
				update_option( 'ninjastars_fcolor', sanitize_text_field( $_POST['ninjastars_fcolor'] ) );
			endif;
		endif;
		?>
			<form method="POST" action="">
		<?php
			settings_fields( 'cx_settings_group' );   
            do_settings_sections( 'cx_options' );
            submit_button( 'Save Codexin Options', 'primary', 'cx_submit_opts' );
		?>
 			</form>
 		</div>
		<?php

	}

	public function cx_settings_fields() {

 		register_setting(
 			'cx_settings_group',
 			'cx_settings'
 		);

 		add_settings_section(
 			'cx_settings_group',
 			'<b>Codexin Settings</b>',
 			array( $this, 'ns_settings_section_cb' ),
 			'cx_settings'
 		);

 		add_settings_field(
 			'ninjastars_color',
 			'<b>Primary Theme Color</b>',
 			array( $this, 'ns_settings_color_cb' ),
 			'ninjastars',
 			'cx_settings_group'
 		);

  		add_settings_field(
 			'ninjastars_rcolor',
 			'<b>Review Content BG Color</b>',
 			array( $this, 'ns_settings_rcolor_cb' ),
 			'ninjastars',
 			'cx_settings_group'
 		);
		
  		add_settings_field(
 			'ninjastars_fcolor',
 			'<b>Widget Author Name Text Color</b>',
 			array( $this, 'ns_settings_fcolor_cb' ),
 			'ninjastars',
 			'cx_settings_group'
 		);

 		add_settings_field(
 			'ninjastars_logo',
 			'<b>Logo Upload URL</b>',
 			array( $this, 'ns_settings_logo_cb' ),
 			'ninjastars',
 			'cx_settings_group'
 		);

 		add_settings_field(
 			'ninjastars_readmore',
 			'<b>Reviews Link</b>',
 			array( $this, 'ns_settings_readmore_cb'),
 			'ninjastars',
 			'cx_settings_group'
 		);

	}

}


// Instantiating the class
$codexin_core = new Codexin_Core();
		

?>
