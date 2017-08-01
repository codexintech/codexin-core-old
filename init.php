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
        define('CODEXIN_CORE_SC_DIR', plugin_dir_path( __FILE__ ) .'inc/shortcodes');


		// Loading the core files
		$this -> codexin_includes();

		// Enquequeing styles and scripts 
		$this -> codexin_enqueque();

		// Register actions using add_actions() custom function.
		$this -> codexin_add_actions();

		// $this->template_path = plugin_dir_url( __FILE__ ) . 'inc/shortcodes';

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
		// require_once CODEXIN_CORE_INC_DIR . '/cx_shortcodes.php';

		// Integrating the Shortcodes in King Composer 
		// require_once CODEXIN_CORE_INC_DIR . '/kc_integrated.php';
		// require_once CODEXIN_CORE_INC_DIR . '/shortcodes/cx-section-heading.php';


		$cx_files = glob(CODEXIN_CORE_SC_DIR.'/*.php');

		foreach ($cx_files as $filename){

		    require_once($filename);    
		    
		}

	}

	/**
	 * Enqueques styles and scripts
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

		// $class_methods = get_class_methods(new SectionHeading());

		// foreach ($class_methods as $method_name) {
		//     echo "$method_name\n";
		// }

		// Load shortcode maps into kc map
		add_action( 'init', 'cx_section_heading_kc', 99 );
		add_action( 'init', 'cx_about_box_kc', 99 );
		add_action( 'init', 'cx_animated_counter_kc', 99 );
		add_action( 'init', 'cx_service_box_kc', 99 );
		add_action( 'init', 'cx_information_box_kc', 99 );
		add_action( 'init', 'cx_events_box_kc', 99 );
		add_action( 'init', 'cx_team_kc', 99 );
		add_action( 'init', 'cx_portfolio_kc', 99 );
		add_action( 'init', 'cx_client_kc', 99 );
		add_action( 'init', 'cx_testimonial_kc', 99 );
		add_action( 'init', 'cx_blog_kc', 99 );
		add_action( 'init', 'cx_map_kc', 99 );
		add_action( 'init', 'cx_contact_form_kc', 99 );
		add_action( 'init', 'cx_social_media_share_kc', 99 );

		// Registering the shortcodes 
		add_action('init', 'codexin_shortcodes' );
		function codexin_shortcodes() {
			$shortcodes = array(
				'cx_section_heading',
				'cx_about_box',
				'cx_animated_counter',
				'cx_service_box',
				'cx_information_box',
				'cx_events_box',
				'cx_team',
				'cx_portfolio',
				'cx_client',
				'cx_testimonial',
				'cx_blog',
				'cx_map',
				'cx_contact_form',
				'cx_social_media_share',

			);
			foreach ($shortcodes as $shortcode) {
				add_shortcode( $shortcode, $shortcode . '_shortcode' );
			}
			
		}

	}

}


// Instantiating the class
$codexin_core = new Codexin_Core();
		

?>
