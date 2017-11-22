<?php
add_filter( 'rwmb_meta_boxes', 'reveal_register_meta_boxes' );

function reveal_register_meta_boxes( $meta_boxes ) {
    $prefix = 'reveal_';
    if ( is_plugin_active( 'nextend-smart-slider3-pro/nextend-smart-slider3-pro.php' ) ):
        global $wpdb; 
        $a = array();
        $b = array();
        $smartsliders = $wpdb->get_results("SELECT id, title FROM ".$wpdb->prefix."nextend2_smartslider3_sliders");
        foreach ($smartsliders as $slide) {
            $a[] = $slide->id;
            $b[] = $slide->title;
        }
        $sliders = array_combine($a, $b);

    else: 
        $sliders = array();
    endif;
    
    //1st meta box
    $meta_boxes[] = array(
        'id'         => 'reveal-team-member-info',
        'title'      => esc_html__( 'Team Member Information', 'codexin' ),
        'post_types' => array( 'team' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => esc_html__( 'Designation', 'codexin' ),
                'desc'  => esc_html__('Enter Designation', 'codexin' ),
                'id'    => $prefix . 'team_designation',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Email', 'codexin' ),
                'desc'  => esc_html__('Enter Email Address', 'codexin' ),
                'id'    => $prefix . 'team_email',
                'type'  => 'email',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Phone', 'codexin' ),
                'desc'  => esc_html__('Enter Phone Number', 'codexin' ),
                'id'    => $prefix . 'team_phone',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Company Name', 'codexin' ),
                'desc'  => esc_html__('Enter Company Name', 'codexin' ),
                'id'    => $prefix . 'team_company',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

        ) //End Fields 

    ); //End reveal-team-member-info

    //reveal-team-member-social
    $meta_boxes[] = array(
        'id'         => 'reveal-team-member-social',
        'title'      => esc_html__( 'Team Member Social Information', 'codexin' ),
        'post_types' => array( 'team' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'  => esc_html__( 'Facebook URL', 'codexin' ),
                'desc'  => esc_html__('Enter facebook URL', 'codexin' ),
                'id'    => $prefix . 'team_facebook',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Twitter URL', 'codexin' ),
                'desc'  => esc_html__('Enter Twitter URL', 'codexin' ),
                'id'    => $prefix . 'team_twitter',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Instagram URL', 'codexin' ),
                'desc'  => esc_html__('Enter Instagram URL', 'codexin' ),
                'id'    => $prefix . 'team_ig',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Google Plus URL', 'codexin' ),
                'desc'  => esc_html__('Enter Google Plus URL', 'codexin' ),
                'id'    => $prefix . 'team_gp',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'LinkedIn URL', 'codexin' ),
                'desc'  => esc_html__('Enter LinkedIn URL', 'codexin' ),
                'id'    => $prefix . 'team_ld',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

        ) //End Fields 

    ); //End reveal-team-member-social

    //start reveal-testimonial-meta
    $meta_boxes[] = array(
        'id'         => 'reveal-testimonail-meta',
        'title'      => esc_html__( 'Author Information', 'codexin' ),
        'post_types' => array( 'testimonial' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'  => esc_html__( 'Name', 'codexin' ),
                'desc'  => esc_html__('Enter Name', 'codexin' ),
                'id'    => $prefix . 'author_name',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Designation', 'codexin' ),
                'desc'  => esc_html__('Enter Designation', 'codexin' ),
                'id'    => $prefix . 'author_desig',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Company', 'codexin' ),
                'desc'  => esc_html__('Enter Company Name', 'codexin' ),
                'id'    => $prefix . 'author_company',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

        )

    );


    $meta_boxes[] = array(
        'id'         => 'reveal-portfolio-meta',
        'title'      => esc_html__( 'Portfolio', 'codexin' ),
        'post_types' => array( 'portfolio' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'  => esc_html__( 'Client Name', 'codexin' ),
                'desc'  => esc_html__('Enter client name', 'codexin' ),
                'id'    => $prefix . 'portfolio_client',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Site Name', 'codexin' ),
                'desc'  => esc_html__('Enter project site name', 'codexin' ),
                'id'    => $prefix . 'portfolio_sname',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Site URL', 'codexin' ),
                'desc'  => esc_html__('Enter project site URL', 'codexin' ),
                'id'    => $prefix . 'portfolio_surl',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Date', 'codexin' ),
                'desc'  => esc_html__('Enter project date. Example: 14-Apr-17', 'codexin' ),
                'id'    => $prefix . 'portfolio_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Skills', 'codexin' ),
                'desc'  => esc_html__('Enter project skills', 'codexin' ),
                'id'    => $prefix . 'portfolio_skills',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-page-header-footer',
        'title'      => esc_html__( 'Page Header & Footer Settings', 'codexin' ),
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'id'   => $prefix . 'disable_header',
                'name' => __( 'Disable Page Header?', 'codexin' ),
                'type' => 'checkbox',
                'desc' => __( 'Checking this will disable the Page Header', 'codexin' ),
            ),

            array(
                'id'   => $prefix . 'disable_footer',
                'name' => __( 'Disable Page Footer?', 'codexin' ),
                'type' => 'checkbox',
                'desc' => __( 'Checking this will disable the Page Footer', 'codexin' ),
            ),
        )
    );


    $meta_boxes[] = array(
        'id'         => 'reveal-page-background-meta-common',
        'title'      => esc_html__( 'Page Header Settings', 'codexin' ),
        'post_types' => array( 'page', 'portfolio' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Disable Page Title Area?', 'codexin' ),
                'desc'      => esc_html__('Checking this will disable the Page Title Section', 'codexin'),
                'id'        => $prefix . 'disable_page_title',
                //'type'      => 'image_advanced',
                'type'      => 'checkbox',
                'clone'     => false,
            ),

            array(
                'name'      => esc_html__( 'Page Title Background Image', 'codexin' ),
                'desc'      => esc_html__('Upload Page Header Background Image. The Image will be functional for all page templates except \'Page - Home\'. This image will override the page title background image set from theme options ', 'codexin'),
                'id'        => $prefix . 'page_background',
                //'type'      => 'image_advanced',
                'type'      => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status'       => true,
                'clone'     => false,
            ),
        )
    );


    $meta_boxes[] = array(
        'id'         => 'reveal-page-background-meta',
        'title'      => esc_html__( 'Page Slider Settings', 'codexin' ),
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Select a Page Slider', 'codexin' ),
                'desc'      => empty( array_filter( $sliders ) ) ? esc_html__( 'Smart Slider is not Activated. Please Activate Smart Slider and try again.', 'codexin' ) : esc_html__('Select Slider Name to show on Page header, Please note that, Slider will be functional for \'Page - Home\' template only  ', 'codexin'),
                'id'        => $prefix . 'page_slider',
                //'type'      => 'image_advanced',
                'type'    => 'select',
                'options' => $sliders,
                'placeholder' => esc_html__( 'Select a Slider', 'codexin' ),
                'clone'     => false,
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-gallery-meta',
        'title'      => esc_html__( 'Gallery', 'codexin' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Create Gallery', 'codexin' ),
                'desc'      => esc_html__('Add images to create a slideshow', 'codexin'),
                'id'        => $prefix . 'gallery',
                'type'      => 'image_advanced',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-video-meta',
        'title'      => esc_html__( 'Video', 'codexin' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Embed Video', 'codexin' ),
                'desc'      => sprintf('%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__('Insert Video Links from Youtube, Vimeo and ', 'codexin'), esc_url('//codex.wordpress.org/Embeds'), esc_html__('all Video supported sites by WordPress.', 'codexin')),
                'id'        => $prefix . 'video',
                'type'      => 'oembed',
                'size'      => 95
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-audio-meta',
        'title'      => esc_html__( 'Audio Placeholder metabox', 'codexin' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Embed Audio', 'codexin' ),
                'desc'      => sprintf('%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__('Insert Audio Links from Soundcloud, Spotify and ', 'codexin'), esc_url('//codex.wordpress.org/Embeds'), esc_html__('all Music supported sites by WordPress.', 'codexin')),
                'id'        => $prefix . 'audio',
                'type'      => 'oembed',
                'size'      => 95
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-quote-meta',
        'title'      => esc_html__( 'Quote', 'codexin' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Quote Text', 'codexin' ),
                'desc'      => esc_html__('Insert The Quote Text', 'codexin'),
                'id'        => $prefix . 'quote_text',
                'type'      => 'textarea',
                'rows'      => '5'
            ),

            array(
                'name'      => esc_html__( 'Name', 'codexin' ),
                'desc'      => esc_html__('Author Name', 'codexin'),
                'id'        => $prefix . 'quote_name',
                'type'      => 'text',
                'size'      => 80,
            ),

            array(
                'name'      => esc_html__( 'Source', 'codexin' ),
                'desc'      => esc_html__('Source URL', 'codexin'),
                'id'        => $prefix . 'quote_source',
                'type'      => 'url',
                'size'      => 80,
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-link-meta',
        'title'      => esc_html__( 'Link', 'codexin' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Link URL', 'codexin' ),
                'desc'      => esc_html__('Insert Link URL', 'codexin'),
                'id'        => $prefix . 'link_url',
                'type'      => 'text',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Link Text', 'codexin' ),
                'desc'      => esc_html__('Insert Link Text', 'codexin'),
                'id'        => $prefix . 'link_text',
                'type'      => 'text',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Open link in a new window?', 'codexin' ),
                'desc'      => esc_html__('Select "yes" to open link in a new window', 'codexin'),
                'id'        => $prefix . 'link_target',
                'type'      => 'select',
                'options'   => array(
                        '_blank' => __('Yes', 'codexin'),
                        '_self' => __('No', 'codexin'),
                    ),

                'std'       => '_blank',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Link Relation (Optional)', 'codexin' ),
                'desc'      => esc_html__('Set the link "rel" attribute(ex: nofollow, dofollow, etc.)', 'codexin'),
                'id'        => $prefix . 'link_rel',
                'type'      => 'text',
                'size'  => 95,
            ),
        )
    );



    $meta_boxes[] = array(
        'id'         => 'reveal-client-logo-meta',
        'title'      => esc_html__( 'Client Information', 'codexin' ),
        'post_types' => array( 'clients' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(


            array(
                'name'  => esc_html__( 'Client Site URL', 'codexin' ),
                'desc'  => esc_html__('Enter client site URL', 'codexin' ),
                'id'    => $prefix . 'clients_surl',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),



        )
    );


    $meta_boxes[] = array(
        'id'         => 'reveal-event-meta',
        'title'      => esc_html__( 'Event Information', 'codexin' ),
        'post_types' => array( 'events' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'  => esc_html__( 'Event Start Date', 'codexin' ),
                'desc'  => esc_html__('Enter event start date', 'codexin' ),
                'id'    => $prefix . 'event_start_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95,
                'js_options' => 'MM d, YY'
            ),


            array(
                'name'  => esc_html__( 'Event Start Time', 'codexin' ),
                'desc'  => esc_html__('Enter event start time', 'codexin' ),
                'id'    => $prefix . 'event_start_time',
                'type'  => 'time',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Event End Date', 'codexin' ),
                'desc'  => esc_html__('Enter events end date', 'codexin' ),
                'id'    => $prefix . 'event_end_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Event End Time', 'codexin' ),
                'desc'  => esc_html__('Enter event end time', 'codexin' ),
                'id'    => $prefix . 'event_end_time',
                'type'  => 'time',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Contact Phone', 'codexin' ),
                'desc'  => esc_html__('Enter phone number', 'codexin' ),
                'id'    => $prefix . 'event_phone',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Contact Email', 'codexin' ),
                'desc'  => esc_html__('Enter email address', 'codexin' ),
                'id'    => $prefix . 'event_email',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Address', 'codexin' ),
                'desc'  => esc_html__('Enter event location address', 'codexin' ),
                'id'    => $prefix . 'event_address',
                'type'  => 'textarea',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Location Latitude', 'codexin' ),
                'desc'  => esc_html__('Enter event location latitude, you can find latitude/longitude by entering your address here', 'codexin' ),
                'id'    => $prefix . 'event_address_latitude',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Location Longitude', 'codexin' ),
                'desc'  => esc_html__('Enter event location longitude, you can find latitude/longitude by entering your address here', 'codexin' ),
                'id'    => $prefix . 'event_address_longitude',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),




        )
    );

    return $meta_boxes;
}


