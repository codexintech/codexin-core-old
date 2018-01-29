<?php
/**
 * The file Contains all metaboxes used in the 'Reveal' Theme using Metabox Plugin
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );


add_filter( 'rwmb_meta_boxes', 'codexin_register_meta_boxes' );
/**
 * Function to register all the metaboxes
 *
 * @since 1.0
 */
function codexin_register_meta_boxes( $meta_boxes ) {
    $prefix = 'codexin_';

    // Retrieving the created slider names and ids from Smart Slider
    if ( is_plugin_active( 'nextend-smart-slider3-pro/nextend-smart-slider3-pro.php' ) ) {
        global $wpdb; 
        $a = array();
        $b = array();
        $smartsliders = $wpdb->get_results( "SELECT id, title FROM ".$wpdb->prefix."nextend2_smartslider3_sliders" );
        foreach( $smartsliders as $slide ) {
            $a[] = $slide->id;
            $b[] = $slide->title;
        }
        $sliders = array_combine( $a, $b );

    } else {
        $sliders = array();
    }
    
    /**
     * Metabox for 'Team' Custom Post
     *
     */

    // Team Member Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_team_member_info',
        'title'         => esc_html__( 'Team Member Information', 'codexin' ),
        'post_types'    => array( 'team' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Designation', 'codexin' ),
                'desc'  => esc_html__( 'Enter Designation', 'codexin' ),
                'id'    => $prefix . 'team_designation',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Email', 'codexin' ),
                'desc'  => esc_html__( 'Enter Email Address', 'codexin' ),
                'id'    => $prefix . 'team_email',
                'type'  => 'email',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Phone', 'codexin' ),
                'desc'  => esc_html__( 'Enter Phone Number', 'codexin' ),
                'id'    => $prefix . 'team_phone',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Company Name', 'codexin' ),
                'desc'  => esc_html__( 'Enter Company Name', 'codexin' ),
                'id'    => $prefix . 'team_company',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) //End Fields 
    ); //End codexin_team_member_info

    // Team Member Social Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_team_member_social',
        'title'         => esc_html__( 'Team Member Social Information', 'codexin' ),
        'post_types'    => array( 'team' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Facebook URL', 'codexin' ),
                'desc'  => esc_html__( 'Enter facebook URL', 'codexin' ),
                'id'    => $prefix . 'team_facebook',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Twitter URL', 'codexin' ),
                'desc'  => esc_html__( 'Enter Twitter URL', 'codexin' ),
                'id'    => $prefix . 'team_twitter',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Instagram URL', 'codexin' ),
                'desc'  => esc_html__( 'Enter Instagram URL', 'codexin' ),
                'id'    => $prefix . 'team_ig',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Google Plus URL', 'codexin' ),
                'desc'  => esc_html__( 'Enter Google Plus URL', 'codexin' ),
                'id'    => $prefix . 'team_gp',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'LinkedIn URL', 'codexin' ),
                'desc'  => esc_html__( 'Enter LinkedIn URL', 'codexin' ),
                'id'    => $prefix . 'team_ld',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) //End Fields 
    ); //End codexin_team_member_social

    /**
     * Metabox for 'Testimonial' Custom Post
     *
     */
    
    // Testimonial Author Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_testimonial_meta',
        'title'         => esc_html__( 'Author Information', 'codexin' ),
        'post_types'    => array( 'testimonial' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Name', 'codexin' ),
                'desc'  => esc_html__( 'Enter Name', 'codexin' ),
                'id'    => $prefix . 'author_name',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Designation', 'codexin' ),
                'desc'  => esc_html__( 'Enter Designation', 'codexin' ),
                'id'    => $prefix . 'author_desig',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Company', 'codexin' ),
                'desc'  => esc_html__( 'Enter Company Name', 'codexin' ),
                'id'    => $prefix . 'author_company',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) // End fields
    ); // End codexin_testimonial_meta

    /**
     * Metabox for 'Portfolio' Custom Post
     *
     */
    
    // Portfolio Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_portfolio_meta',
        'title'         => esc_html__( 'Portfolio', 'codexin' ),
        'post_types'    => array( 'portfolio' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Client Name', 'codexin' ),
                'desc'  => esc_html__( 'Enter client name', 'codexin' ),
                'id'    => $prefix . 'portfolio_client',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Site Name', 'codexin' ),
                'desc'  => esc_html__( 'Enter project site name', 'codexin' ),
                'id'    => $prefix . 'portfolio_sname',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Site URL', 'codexin' ),
                'desc'  => esc_html__( 'Enter project site URL', 'codexin' ),
                'id'    => $prefix . 'portfolio_surl',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Date', 'codexin' ),
                'desc'  => esc_html__( 'Enter project date. Example: 14-Apr-17', 'codexin' ),
                'id'    => $prefix . 'portfolio_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Skills', 'codexin' ),
                'desc'  => esc_html__( 'Enter project skills (if have multiple skills, seperate them by comma)', 'codexin' ),
                'id'    => $prefix . 'portfolio_skills',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) // End fields
    ); // End codexin_portfolio_meta

    /**
     * Metabox for Pages
     *
     */
    
    // Page Header & Footer Disabling Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_page_header_footer',
        'title'         => esc_html__( 'Page Header & Footer Settings', 'codexin' ),
        'post_types'    => array( 'page' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'id'    => $prefix . 'disable_header',
                'name'  => esc_html__( 'Disable Page Header?', 'codexin' ),
                'type'  => 'checkbox',
                'desc'  => esc_html__( 'Checking this will disable the Page Header', 'codexin' ),
            ),

            array(
                'id'    => $prefix . 'disable_footer',
                'name'  => esc_html__( 'Disable Page Footer?', 'codexin' ),
                'type'  => 'checkbox',
                'desc'  => esc_html__( 'Checking this will disable the Page Footer', 'codexin' ),
            ),
        ) // End fields
    ); // End codexin_page_header_footer

    // Page Header Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_page_header_layout',
        'title'         => esc_html__( 'Page Header Settings', 'codexin' ),
        'post_types'    => array( 'page' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'     => esc_html__( 'Header layout', 'codexin' ),
                'type'     => 'image_select',
                'id'       => $prefix.'header_layout_meta',
                'desc'     => esc_html__( "Please choose header layout for this page only. If you wish to use the global settings, select the first image named 'Global Header'.", 'codexin' ),
                'options'  => array(
                    0 => CODEXIN_CORE_ASSET_DIR . '/images/header/header-0.png',
                    1 => CODEXIN_CORE_ASSET_DIR . '/images/header/header-1.png',
                    2 => CODEXIN_CORE_ASSET_DIR . '/images/header/header-2.png',
                    3 => CODEXIN_CORE_ASSET_DIR . '/images/header/header-3.png',
                    4 => CODEXIN_CORE_ASSET_DIR . '/images/header/header-4.png',
                ),
                'std'       => '0',
            ),
        ) // End fields
    ); // End codexin_page_header_layout

    // Page Title Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_page_background_meta_common',
        'title'         => esc_html__( 'Page Title Settings', 'codexin' ),
        'post_types'    => array( 'page', 'portfolio' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'      => esc_html__( 'Disable Page Title Area?', 'codexin' ),
                'desc'      => esc_html__( 'Checking this will disable the Page Title Section', 'codexin' ),
                'id'        => $prefix . 'disable_page_title',
                'type'      => 'checkbox',
                'clone'     => false,
            ),

            array(
                'name'      => esc_html__( 'Page Title Background Image', 'codexin' ),
                'desc'      => esc_html__( 'Upload Page Header Background Image. The Image will be functional for all page templates except \'Page - Home\'. This image will override the page title background image set from theme options ', 'codexin' ),
                'id'        => $prefix . 'page_background',
                'type'      => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status'       => true,
                'clone'     => false,
            ),

            array(
                'name'      => esc_html__( 'Page Title Alignment', 'codexin' ),
                'desc'      => esc_html__( 'Please Select the Page title alignment to override. If you want default settings, choose \'Global Settings\'', 'codexin' ),
                'id'        => $prefix . 'page_title_alignment',
                'type'      => 'select',
                'options'   => array(
                        '0' => esc_html__( 'Global Settings', 'codexin' ),
                        '1' => esc_html__( 'Left', 'codexin' ),
                        '2' => esc_html__( 'Center', 'codexin' ),
                        '3' => esc_html__( 'Right', 'codexin' ),
                    ),

                'std'       => '0',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Breadcrumbs Alignment', 'codexin' ),
                'desc'      => esc_html__( 'Please Select the Breadcrumbs alignment to override. If you want default settings, choose \'Global Settings\'', 'codexin' ),
                'id'        => $prefix . 'page_breadcrumb_alignment',
                'type'      => 'select',
                'options'   => array(
                        '0' => esc_html__( 'Global Settings', 'codexin' ),
                        '1' => esc_html__( 'Left', 'codexin' ),
                        '2' => esc_html__( 'Center', 'codexin' ),
                        '3' => esc_html__( 'Right', 'codexin' ),
                    ),

                'std'       => '0',
                'size'  => 95,
            ),
        ) // End fields
    ); // End codexin_page_background_meta_common

    // Page Slider Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_page_background_meta',
        'title'         => esc_html__( 'Page Slider Settings', 'codexin' ),
        'post_types'    => array( 'page' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'          => esc_html__( 'Select a Page Slider', 'codexin' ),
                'desc'          => empty( array_filter( $sliders ) ) ? esc_html__( 'Smart Slider is not Activated. Please Activate Smart Slider and try again.', 'codexin' ) : esc_html__( 'Select Slider Name to show on Page header, Please note that, Slider will be functional for \'Page - Home\' template only  ', 'codexin' ),
                'id'            => $prefix . 'page_slider',
                'type'          => 'select',
                'options'       => $sliders,
                'placeholder'   => esc_html__( 'Select a Slider', 'codexin' ),
                'clone'         => false,
            ),
        ) // End fields
    ); // End codexin_page_background_meta

    /**
     * Metabox for Posts Formats for 'Posts'
     *
     */

    // Gallery Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'reveal-gallery-meta',
        'title'         => esc_html__( 'Gallery', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Create Gallery', 'codexin' ),
                'desc'  => esc_html__( 'Add images to create a slideshow', 'codexin' ),
                'id'    => $prefix . 'gallery',
                'type'  => 'image_advanced',
            ),
        )
    );

    // Video Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'reveal-video-meta',
        'title'         => esc_html__( 'Video', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Embed Video', 'codexin' ),
                'desc'  => sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Insert Video Links from Youtube, Vimeo and ', 'codexin' ), esc_url( '//codex.wordpress.org/Embeds' ), esc_html__( 'all Video supported sites by WordPress.', 'codexin' ) ),
                'id'    => $prefix . 'video',
                'type'  => 'oembed',
                'size'  => 95
            ),
        )
    );

    // Audio Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'reveal-audio-meta',
        'title'         => esc_html__( 'Audio', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Embed Audio', 'codexin' ),
                'desc'  => sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Insert Audio Links from Soundcloud, Spotify and ', 'codexin' ), esc_url( '//codex.wordpress.org/Embeds' ), esc_html__( 'all Music supported sites by WordPress.', 'codexin' ) ),
                'id'    => $prefix . 'audio',
                'type'  => 'oembed',
                'size'  => 95
            ),
        )
    );

    // Quote Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'reveal-quote-meta',
        'title'         => esc_html__( 'Quote', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Quote Text', 'codexin' ),
                'desc'  => esc_html__( 'Insert The Quote Text', 'codexin' ),
                'id'    => $prefix . 'quote_text',
                'type'  => 'textarea',
                'rows'  => '5'
            ),

            array(
                'name'  => esc_html__( 'Name', 'codexin' ),
                'desc'  => esc_html__( 'Author Name', 'codexin' ),
                'id'    => $prefix . 'quote_name',
                'type'  => 'text',
                'size'  => 80,
            ),

            array(
                'name'  => esc_html__( 'Source', 'codexin' ),
                'desc'  => esc_html__( 'Source URL', 'codexin' ),
                'id'    => $prefix . 'quote_source',
                'type'  => 'url',
                'size'  => 80,
            ),
        )
    );

    // Link Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'reveal-link-meta',
        'title'         => esc_html__( 'Link', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Link URL', 'codexin' ),
                'desc'  => esc_html__( 'Insert Link URL', 'codexin' ),
                'id'    => $prefix . 'link_url',
                'type'  => 'text',
                'size'  => 95,
            ),

            array(
                'name'  => esc_html__( 'Link Text', 'codexin' ),
                'desc'  => esc_html__( 'Insert Link Text', 'codexin' ),
                'id'    => $prefix . 'link_text',
                'type'  => 'text',
                'size'  => 95,
            ),

            array(
                'name'    => esc_html__( 'Open link in a new window?', 'codexin' ),
                'desc'    => esc_html__( 'Select "yes" to open link in a new window', 'codexin' ),
                'id'      => $prefix . 'link_target',
                'type'    => 'select',
                'options' => array(
                    '_blank' => esc_html__( 'Yes', 'codexin' ),
                    '_self'  => esc_html__( 'No', 'codexin' ),
                ),

                'std'     => '_blank',
                'size'    => 95,
            ),

            array(
                'name'  => esc_html__( 'Link Relation (Optional)', 'codexin' ),
                'desc'  => esc_html__( 'Set the link "rel" attribute(ex: nofollow, dofollow, etc.)', 'codexin' ),
                'id'    => $prefix . 'link_rel',
                'type'  => 'text',
                'size'  => 95,
            ),
        )
    );

    /**
     * Metabox for 'Clients' Custom Post
     *
     */

    // Client Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_client_logo_meta',
        'title'         => esc_html__( 'Client Information', 'codexin' ),
        'post_types'    => array( 'clients' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Client Site URL', 'codexin' ),
                'desc'  => esc_html__( 'Enter client site URL', 'codexin' ),
                'id'    => $prefix . 'clients_surl',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) // End fields
    ); // End codexin_client_logo_meta

    /**
     * Metabox for 'Events' Custom Post
     *
     */

    // Events Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_event_meta',
        'title'         => esc_html__( 'Event Information', 'codexin' ),
        'post_types'    => array( 'events' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Event Start Date', 'codexin' ),
                'desc'  => esc_html__( 'Enter event start date', 'codexin' ),
                'id'    => $prefix . 'event_start_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95,
                'js_options' => 'MM d, YY'
            ),

            array(
                'name'  => esc_html__( 'Event Start Time', 'codexin' ),
                'desc'  => esc_html__( 'Enter event start time', 'codexin' ),
                'id'    => $prefix . 'event_start_time',
                'type'  => 'time',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Event End Date', 'codexin' ),
                'desc'  => esc_html__( 'Enter events end date', 'codexin' ),
                'id'    => $prefix . 'event_end_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Event End Time', 'codexin' ),
                'desc'  => esc_html__( 'Enter event end time', 'codexin' ),
                'id'    => $prefix . 'event_end_time',
                'type'  => 'time',
                'clone' => false,
                'size'  => 95
            ),
        ) // End fields
    ); // End codexin_event_meta

    // Events Contact Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_event_contact_meta',
        'title'         => esc_html__( 'Event Contact Information', 'codexin' ),
        'post_types'    => array( 'events' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Contact Phone', 'codexin' ),
                'desc'  => esc_html__( 'Enter phone number', 'codexin' ),
                'id'    => $prefix . 'event_phone',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Contact Email', 'codexin' ),
                'desc'  => esc_html__( 'Enter email address', 'codexin' ),
                'id'    => $prefix . 'event_email',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) // End fields
    ); // End codexin_event_contact_meta

    // Events Location Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_event_location_meta',
        'title'         => esc_html__( 'Event Location Information', 'codexin' ),
        'post_types'    => array( 'events' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(

            array(
                'name'  => esc_html__( 'Events Address', 'codexin' ),
                'desc'  => esc_html__( 'Enter event location address', 'codexin' ),
                'id'    => $prefix . 'event_address',
                'type'  => 'textarea',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Location Latitude', 'codexin' ),
                'desc'  => sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Enter event location latitude, you can find latitude/longitude by entering your address ', 'codexin' ), esc_url( '//latlong.net' ), esc_html__( 'here', 'codexin' ) ),
                'id'    => $prefix . 'event_address_latitude',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Location Longitude', 'codexin' ),
                'desc'  => sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Enter event location longitude, you can find latitude/longitude by entering your address ', 'codexin' ), esc_url( '//latlong.net' ), esc_html__( 'here', 'codexin' ) ),
                'id'    => $prefix . 'event_address_longitude',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) // End fields
    ); // End codexin_event_location_meta

    return $meta_boxes;
}


