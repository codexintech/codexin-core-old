<?php
 
/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */
 
/**
 * Initializes the theme options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */

class CodexinAdminMenu {

	public function __construct() {

		add_action( 'admin_init', array ( $this, 'codexin_admin_init' ) );
		add_action( 'admin_menu', array( $this, 'codexin_admin_menu' ) );

	}

	public function codexin_admin_menu() {
	 
	    add_menu_page(
	        'Codexin Core Options',          		// The title to be displayed on the corresponding page for this menu
	        'Codexin Core',                  		// The text to be displayed for this actual menu item
	        'manage_options',            			// Which type of users can see this menu
	        'codexin-options',                  	// The unique ID - that is, the slug - for this menu item
	        array( $this, 'cx_settings_page_cb' ),	// The name of the function to call when rendering the menu for this page
	        ''
	    );
	 
	} // end sandbox_create_menu_page

	function cx_settings_page_cb() {

		$this->options_general = get_option( 'codexin_options_general' );
		$this->options_social = get_option( 'codexin_options_social' );
		$this->options_in_api = get_option( 'codexin_options_gmap_api' ); 

		$social_Screen = ( isset( $_GET['action'] ) && 'social' == $_GET['action'] ) ? true : false;
		$gmap_api_Screen = ( isset( $_GET['action'] ) && 'api' == $_GET['action'] ) ? true : false;
	     ?>
	    <!-- Create a header in the default WordPress 'wrap' container -->
	    <div class="wrap">    
	        <h1>Codexin Core Options</h1>
	        <p class="description">These settings showcases the core functionality of the <b> Codexin Core </b> Plugin.</p>
            <h2 class="nav-tab-wrapper">
				<a href="<?php echo admin_url( 'admin.php?page=codexin-options' ); ?>" class="nav-tab<?php if ( ! isset( $_GET['action'] ) || isset( $_GET['action'] ) && 'social' != $_GET['action']  && 'api' != $_GET['action'] ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'General', 'codexin' ); ?></a>
				<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'social' ), admin_url( 'admin.php?page=codexin-options' ) ) ); ?>" class="nav-tab<?php if ( $social_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Social Media', 'codexin' ); ?></a> 
				<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'api' ), admin_url( 'admin.php?page=codexin-options' ) ) ); ?>" class="nav-tab<?php if ( $gmap_api_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Google Map API', 'codexin' ); ?></a>        
			</h2>
	        <?php settings_errors(); ?>

        	 <form method="post" action="options.php"><?php //   settings_fields( 'codexin_options );
				 if($social_Screen) { 
					settings_fields( 'codexin_options_social' );
					do_settings_sections( 'codexin-setting-social' );
					submit_button();
				} elseif($gmap_api_Screen) {
					settings_fields( 'codexin_options_gmap_api' );
					do_settings_sections( 'codexin-setting-gmap' );
					submit_button();
				}else { 
					settings_fields( 'codexin_options_general' );
					do_settings_sections( 'codexin-setting-admin' );
					// submit_button(); 
				} ?>
			</form>
        </div><!-- end wrap -->

	     <?php
	} // end sandbox_menu_page_display

	
	public function codexin_admin_init() {

		register_setting(
            'codexin_options_general', // Option group
            'codexin_options_general', // Option name
            array( $this, 'cx_sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            esc_html__( 'All Settings', 'codexin' ), // Title
            array( $this, 'general_section_info' ), // Callback
            'codexin-setting-admin' // Page
        ); 
		add_settings_field(
            'placeholder', 
            esc_html__( 'Placeholder', 'codexin' ), 
            array( $this, 'placeholder_callback' ), 
            'codexin-setting-admin', 
            'setting_section_id'
        );  		
		
		register_setting(
            'codexin_options_social', // Option group
            'codexin_options_social', // Option name
            array( $this, 'cx_sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            esc_html__( 'Social Settings', 'codexin' ), // Title
            array( $this, 'social_section_info' ), // Callback
            'codexin-setting-social' // Page
        );  

		add_settings_field(
            'tw_url', // ID
            esc_html__( 'Twitter URL', 'codexin' ), // Title 
            array( $this, 'tw_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section           
        );
		
		add_settings_field(
            'fb_url', // ID
            esc_html__('Facebook URL', 'codexin'), // Title 
            array( $this, 'fb_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );	

		add_settings_field(
            'in_url', // ID
            esc_html__('Instagram URL', 'codexin'), // Title 
            array( $this, 'in_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );	

		add_settings_field(
            'pin_url', // ID
            esc_html__('Pinterest URL', 'codexin'), // Title 
            array( $this, 'pin_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );	

		add_settings_field(
            'be_url', // ID
            esc_html__('Behance URL', 'codexin'), // Title 
            array( $this, 'be_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );	

		add_settings_field(
            'gp_url', // ID
            esc_html__('GooglePlus URL', 'codexin'), // Title 
            array( $this, 'gp_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );

		add_settings_field(
            'li_url', // ID
            esc_html__('LinkedIn URL', 'codexin'), // Title 
            array( $this, 'li_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );		

		add_settings_field(
            'yt_url', // ID
            esc_html__('Youtube URL', 'codexin'), // Title 
            array( $this, 'yt_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );		

		add_settings_field(
            'sk_url', // ID
            esc_html__('Skype URL', 'codexin'), // Title 
            array( $this, 'sk_url_callback' ), // Callback
            'codexin-setting-social', // Page
            'setting_section_id' // Section      
        );	
		
		register_setting(
            'codexin_options_gmap_api', // Option group
            'codexin_options_gmap_api', // Option name
            array( $this, 'cx_sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            esc_html__('Google Map API', 'codexin'), // Title
            array( $this, 'gmap_section_info' ), // Callback
            'codexin-setting-gmap' // Page
        );         

		add_settings_field(
            'gmap_api', // ID
            esc_html__('Google Map API Key', 'codexin'), // Title 
            array( $this, 'gmap_api_callback' ), // Callback
            'codexin-setting-gmap', // Page
            'setting_section_id' // Section      
        );	
	     
	} // end codexin_admin_init
	 

	public function general_section_info() {
		echo '<h1>Welcome to Codexin Core Options. </h1>';
	}

	public function social_section_info() {
		printf( '<p>%s</p>', esc_html__( 'This Section Represents the Social Profile Input Section. Please Enter Your Valid Social Profile Information listed below:', 'codexin' ) );
	}

	public function gmap_section_info() {
		printf( '<p>%s</p>', esc_html__( 'This Section Represents the Google Map API Input Section. Please Enter Required Valid Information listed below:', 'codexin' ) );
	}

	public function tw_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="tw_url" name="codexin_options_social[tw_url]" value="%s" />',
            isset( $this->options_social['tw_url'] ) ? esc_attr( $this->options_social['tw_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your Twitter Profile URL', 'codexin' ) );
    }

	public function fb_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="fb_url" name="codexin_options_social[fb_url]" value="%s" />',
            isset( $this->options_social['fb_url'] ) ? esc_attr( $this->options_social['fb_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your Facebook Profile URL', 'codexin' ) );
    }

	public function in_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="in_url" name="codexin_options_social[in_url]" value="%s" />',
            isset( $this->options_social['in_url'] ) ? esc_attr( $this->options_social['in_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your Instagram Profile URL', 'codexin' ) );
    }

	public function pin_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="pin_url" name="codexin_options_social[pin_url]" value="%s" />',
            isset( $this->options_social['pin_url'] ) ? esc_attr( $this->options_social['pin_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your Pinterest Profile URL', 'codexin' ) );
    }

	public function be_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="be_url" name="codexin_options_social[be_url]" value="%s" />',
            isset( $this->options_social['be_url'] ) ? esc_attr( $this->options_social['be_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your Behance Profile URL', 'codexin' ) );
    }

	public function gp_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="gp_url" name="codexin_options_social[gp_url]" value="%s" />',
            isset( $this->options_social['gp_url'] ) ? esc_attr( $this->options_social['gp_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your GooglePlus Profile URL', 'codexin' ) );
    }

	public function li_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="li_url" name="codexin_options_social[li_url]" value="%s" />',
            isset( $this->options_social['li_url'] ) ? esc_attr( $this->options_social['li_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your LinkedIn Profile URL', 'codexin' ) );
    }

	public function yt_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="yt_url" name="codexin_options_social[yt_url]" value="%s" />',
            isset( $this->options_social['yt_url'] ) ? esc_attr( $this->options_social['yt_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your YouTube Profile URL', 'codexin' ) );
    }

	public function sk_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="sk_url" name="codexin_options_social[sk_url]" value="%s" />',
            isset( $this->options_social['sk_url'] ) ? esc_attr( $this->options_social['sk_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', esc_html__( 'Please Insert Your Skype Profile URL', 'codexin' ) );
    }

	public function gmap_api_callback() {
        printf(
            '<input type="text" class="regular-text" id="gmap_api" name="codexin_options_gmap_api[gmap_api]" value="%s" />',
            isset( $this->options_in_api['gmap_api'] ) ? esc_attr( $this->options_in_api['gmap_api']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%1$s<a href="%2$s" target="_blank">%3$s</a></span>', esc_html__( 'Generate Your Google Map API Key from ', 'codexin' ), esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key'), esc_html__('here'), 'codexin' );
    }


    public function placeholder_callback() {
        // printf(
        //     '<input type="text" name="codexin_options_general[logo_image]" id="logo_image" value="%s"> <a href="#" id="logo_image_url" class="button" > Select </a>',
        //     isset( $this->options_general['logo_image'] ) ? esc_attr( $this->options_general['logo_image']) : ''
        //      );
			echo '<p class="description">This is a General Placeholder section</p>';
    }

   public function cx_sanitize( $input )  {
        $new_input = array();

        if( isset( $input['tw_url'] ) )
            $new_input['tw_url'] = sanitize_text_field( $input['tw_url'] );

        if( isset( $input['fb_url'] ) )
            $new_input['fb_url'] = sanitize_text_field( $input['fb_url'] );

        if( isset( $input['in_url'] ) )
            $new_input['in_url'] = sanitize_text_field( $input['in_url'] );

        if( isset( $input['pin_url'] ) )
            $new_input['pin_url'] = sanitize_text_field( $input['pin_url'] );

        if( isset( $input['be_url'] ) )
            $new_input['be_url'] = sanitize_text_field( $input['be_url'] );

        if( isset( $input['gp_url'] ) )
            $new_input['gp_url'] = sanitize_text_field( $input['gp_url'] );

        if( isset( $input['li_url'] ) )
            $new_input['li_url'] = sanitize_text_field( $input['li_url'] );

        if( isset( $input['yt_url'] ) )
            $new_input['yt_url'] = sanitize_text_field( $input['yt_url'] );

        if( isset( $input['sk_url'] ) )
            $new_input['sk_url'] = sanitize_text_field( $input['sk_url'] );

        if( isset( $input['gmap_api'] ) )
            $new_input['gmap_api'] = sanitize_text_field( $input['gmap_api'] );

        return $new_input;
    }



} 

$codexin_admin = new CodexinAdminMenu;


