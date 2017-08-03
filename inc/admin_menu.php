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
	        'Codexin Options',                  	// The text to be displayed for this actual menu item
	        'manage_options',            			// Which type of users can see this menu
	        'codexin-options',                  	// The unique ID - that is, the slug - for this menu item
	        array( $this, 'cx_settings_page_cb' ),	// The name of the function to call when rendering the menu for this page
	        ''
	    );
	 
	} // end sandbox_create_menu_page

	function cx_settings_page_cb() {

		$this->options_general = get_option( 'codexin_options_general' );
		$this->options_social = get_option( 'codexin_options_social' );
		$this->options_in_api = get_option( 'codexin_options_in_api' ); 

		$social_Screen = ( isset( $_GET['action'] ) && 'social' == $_GET['action'] ) ? true : false;
		$api_Screen = ( isset( $_GET['action'] ) && 'api' == $_GET['action'] ) ? true : false;
	     ?>
	    <!-- Create a header in the default WordPress 'wrap' container -->
	    <div class="wrap">    
	        <h1>Codexin Core Options</h1>
	        <p class="description">These settings showcases the core functionality of the <b> Codexin Core </b> Plugin.</p>
            <h2 class="nav-tab-wrapper">
				<a href="<?php echo admin_url( 'admin.php?page=codexin-options' ); ?>" class="nav-tab<?php if ( ! isset( $_GET['action'] ) || isset( $_GET['action'] ) && 'social' != $_GET['action']  && 'api' != $_GET['action'] ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'General', 'codexin' ); ?></a>
				<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'social' ), admin_url( 'admin.php?page=codexin-options' ) ) ); ?>" class="nav-tab<?php if ( $social_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Social Media', 'codexin' ); ?></a> 
				<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'api' ), admin_url( 'admin.php?page=codexin-options' ) ) ); ?>" class="nav-tab<?php if ( $api_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Instagram API Settings', 'codexin' ); ?></a>        
			</h2>
	        <?php settings_errors(); ?>

        	 <form method="post" action="options.php"><?php //   settings_fields( 'codexin_options );
				 if($social_Screen) { 
					settings_fields( 'codexin_options_social' );
					do_settings_sections( 'codexin-setting-social' );
					submit_button();
				} elseif($api_Screen) {
					settings_fields( 'codexin_options_in_api' );
					do_settings_sections( 'codexin-setting-instagram' );
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
            'codexin_options_in_api', // Option group
            'codexin_options_in_api', // Option name
            array( $this, 'cx_sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            esc_html__('Instagram API Details', 'codexin'), // Title
            array( $this, 'instagram_section_info' ), // Callback
            'codexin-setting-instagram' // Page
        );         

		add_settings_field(
            'in_name', // ID
            esc_html__('Instagram Username', 'codexin'), // Title 
            array( $this, 'in_name_callback' ), // Callback
            'codexin-setting-instagram', // Page
            'setting_section_id' // Section      
        );	

		add_settings_field(
            'in_id', // ID
            esc_html__('Instagram User ID', 'codexin'), // Title 
            array( $this, 'in_id_callback' ), // Callback
            'codexin-setting-instagram', // Page
            'setting_section_id' // Section      
        );	

		add_settings_field(
            'acc_token', // ID
            esc_html__('Access Token', 'codexin'), // Title 
            array( $this, 'acc_token_callback' ), // Callback
            'codexin-setting-instagram', // Page
            'setting_section_id' // Section      
        );

		add_settings_field(
            'cli_id', // ID
            esc_html__('Client ID', 'codexin'), // Title 
            array( $this, 'cli_id_callback' ), // Callback
            'codexin-setting-instagram', // Page
            'setting_section_id' // Section      
        );		
	     
	} // end codexin_admin_init
	 

	public function general_section_info() {
		echo '<h1>Welcome to Codexin Core Options. </h1>';
	}

	public function social_section_info() {
		printf( '<p>%s</p>', __( 'This Section Represents the Social Profile Input Section. Please Enter Your Valid Social Profile Information listed below:', 'codexin' ) );
	}

	public function instagram_section_info() {
		printf( '<p>%s</p>', __( 'This Section Represents the Instagram API Input Section. Please Enter Required Valid Information listed below:', 'codexin' ) );
	}

	public function tw_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="tw_url" name="codexin_options_social[tw_url]" value="%s" />',
            isset( $this->options_social['tw_url'] ) ? esc_attr( $this->options_social['tw_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your Twitter Profile URL', 'codexin' ) );
    }

	public function fb_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="fb_url" name="codexin_options_social[fb_url]" value="%s" />',
            isset( $this->options_social['fb_url'] ) ? esc_attr( $this->options_social['fb_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your Facebook Profile URL', 'codexin' ) );
    }

	public function in_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="in_url" name="codexin_options_social[in_url]" value="%s" />',
            isset( $this->options_social['in_url'] ) ? esc_attr( $this->options_social['in_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your Instagram Profile URL', 'codexin' ) );
    }

	public function pin_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="pin_url" name="codexin_options_social[pin_url]" value="%s" />',
            isset( $this->options_social['pin_url'] ) ? esc_attr( $this->options_social['pin_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your Pinterest Profile URL', 'codexin' ) );
    }

	public function be_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="be_url" name="codexin_options_social[be_url]" value="%s" />',
            isset( $this->options_social['be_url'] ) ? esc_attr( $this->options_social['be_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your Behance Profile URL', 'codexin' ) );
    }

	public function gp_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="gp_url" name="codexin_options_social[gp_url]" value="%s" />',
            isset( $this->options_social['gp_url'] ) ? esc_attr( $this->options_social['gp_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your GooglePlus Profile URL', 'codexin' ) );
    }

	public function li_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="li_url" name="codexin_options_social[li_url]" value="%s" />',
            isset( $this->options_social['li_url'] ) ? esc_attr( $this->options_social['li_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your LinkedIn Profile URL', 'codexin' ) );
    }

	public function yt_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="yt_url" name="codexin_options_social[yt_url]" value="%s" />',
            isset( $this->options_social['yt_url'] ) ? esc_attr( $this->options_social['yt_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your YouTube Profile URL', 'codexin' ) );
    }

	public function sk_url_callback() {
        printf(
            '<input type="text" class="regular-text" id="sk_url" name="codexin_options_social[sk_url]" value="%s" />',
            isset( $this->options_social['sk_url'] ) ? esc_attr( $this->options_social['sk_url']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your Skype Profile URL', 'codexin' ) );
    }

	public function in_name_callback() {
        printf(
            '<input type="text" class="regular-text" id="in_name" name="codexin_options_in_api[in_name]" value="%s" />',
            isset( $this->options_in_api['in_name'] ) ? esc_attr( $this->options_in_api['in_name']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%s</span>', __( 'Please Insert Your Instagram User Name', 'codexin' ) );
    }

	public function in_id_callback() {
        printf(
            '<input type="text" class="regular-text" id="in_id" name="codexin_options_in_api[in_id]" value="%s" />',
            isset( $this->options_in_api['in_id'] ) ? esc_attr( $this->options_in_api['in_id']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%1$s<a href="%2$s" target="_blank">%3$s</a></span>', __( 'Lookup your User ID from ', 'codexin' ), esc_url( '//ershad7.com/InstagramUserID/' ), __( 'here', 'codexin' ) );
    }

	public function acc_token_callback() {
        printf(
            '<input type="text" class="regular-text" id="acc_token" name="codexin_options_in_api[acc_token]" value="%s" />',
            isset( $this->options_in_api['acc_token'] ) ? esc_attr( $this->options_in_api['acc_token']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%1$s<a href="%2$s" target="_blank">%3$s</a></span>', __( 'Generate Your Access Token from ', 'codexin' ), esc_url( '//instagram.pixelunion.net/' ), __( 'here', 'codexin' ) );
    }

	public function cli_id_callback() {
        printf(
            '<input type="text" class="regular-text" id="cli_id" name="codexin_options_in_api[cli_id]" value="%s" />',
            isset( $this->options_in_api['cli_id'] ) ? esc_attr( $this->options_in_api['cli_id']) : ''
        );
        printf( '&nbsp;&nbsp;<span class="description">%1$s<a href="%2$s" target="_blank">%3$s</a></span>', __( 'Register a new client from ', 'codexin' ), esc_url( '//instagram.com/developer/clients/manage/' ), __( 'here', 'codexin' ) );
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

        if( isset( $input['in_name'] ) )
            $new_input['in_name'] = sanitize_text_field( $input['in_name'] );

        if( isset( $input['in_id'] ) )
            $new_input['in_id'] = sanitize_text_field( $input['in_id'] );

        if( isset( $input['acc_token'] ) )
            $new_input['acc_token'] = sanitize_text_field( $input['acc_token'] );

        if( isset( $input['cli_id'] ) )
            $new_input['cli_id'] = sanitize_text_field( $input['cli_id'] );

        return $new_input;
    }



} 

$codexin_admin = new CodexinAdminMenu;


