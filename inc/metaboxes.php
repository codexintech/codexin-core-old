<?php
add_filter( 'rwmb_meta_boxes', 'reveal_register_meta_boxes' );

function reveal_register_meta_boxes( $meta_boxes ) {
    $prefix = 'reveal_';
    
    //1st meta box
    $meta_boxes[] = array(
        'id'         => 'reveal-team-member',
        'title'      => esc_html__( 'Team Member Information', 'reveal' ),
        'post_types' => array( 'team' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => esc_html__( 'Designation', 'reveal' ),
                'desc'  => esc_html__('Enter Designation', 'reveal' ),
                'id'    => $prefix . 'team_designation',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Facebook URL', 'reveal' ),
                'desc'  => esc_html__('Enter facebook url', 'reveal' ),
                'id'    => $prefix . 'team_facebook',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Twitter URL', 'reveal' ),
                'desc'  => esc_html__('Enter Twitter URL', 'reveal' ),
                'id'    => $prefix . 'team_twitter',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Instagram URL', 'reveal' ),
                'desc'  => esc_html__('Enter Instagram URL', 'reveal' ),
                'id'    => $prefix . 'team_ig',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

        array(
                'name'  => esc_html__( 'Google Plus URL', 'reveal' ),
                'desc'  => esc_html__('Enter Google Plus URL', 'reveal' ),
                'id'    => $prefix . 'team_gp',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),


        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-testimonail-meta',
        'title'      => esc_html__( 'Author Information', 'reveal' ),
        'post_types' => array( 'testimonial' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'  => esc_html__( 'Name', 'reveal' ),
                'desc'  => esc_html__('Enter Name', 'reveal' ),
                'id'    => $prefix . 'author_name',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Designation', 'reveal' ),
                'desc'  => esc_html__('Enter Designation', 'reveal' ),
                'id'    => $prefix . 'author_desig',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Company', 'reveal' ),
                'desc'  => esc_html__('Enter Company Name', 'reveal' ),
                'id'    => $prefix . 'author_company',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

        )

    );


    $meta_boxes[] = array(
        'id'         => 'reveal-portfolio-meta',
        'title'      => esc_html__( 'Portfolio Information', 'reveal' ),
        'post_types' => array( 'portfolio' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'  => esc_html__( 'Client Name', 'reveal' ),
                'desc'  => esc_html__('Enter client name', 'reveal' ),
                'id'    => $prefix . 'portfolio_client',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Date', 'reveal' ),
                'desc'  => esc_html__('Enter project date. Example: 14-Apr-17', 'reveal' ),
                'id'    => $prefix . 'portfolio_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Skills', 'reveal' ),
                'desc'  => esc_html__('Enter project skills', 'reveal' ),
                'id'    => $prefix . 'portfolio_skills',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),


            array(
                'name'  => esc_html__( 'Project Site Name', 'reveal' ),
                'desc'  => esc_html__('Enter project site name', 'reveal' ),
                'id'    => $prefix . 'portfolio_sname',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Project Site URL', 'reveal' ),
                'desc'  => esc_html__('Enter project site URL', 'reveal' ),
                'id'    => $prefix . 'portfolio_surl',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),




        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-page-background-meta',
        'title'      => esc_html__( 'Page Header Background Image', 'reveal' ),
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Background Image', 'reveal' ),
                'desc'      => esc_html__('Upload Page Header Background Image', 'reveal'),
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
        'id'         => 'reveal-gallery-meta',
        'title'      => esc_html__( 'Gallery', 'reveal' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Create Gallery', 'reveal' ),
                'desc'      => esc_html__('Add images to create a slideshow', 'reveal'),
                'id'        => $prefix . 'gallery',
                'type'      => 'image_advanced',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-video-meta',
        'title'      => esc_html__( 'Video', 'reveal' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Embed Video', 'reveal' ),
                'desc'      => sprintf('%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__('Insert Video Links from Youtube, Vimeo and ', 'reveal'), esc_url('//codex.wordpress.org/Embeds'), esc_html__('all Video supported sites by WordPress.', 'reveal')),
                'id'        => $prefix . 'video',
                'type'      => 'oembed',
                'size'      => 95
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-audio-meta',
        'title'      => esc_html__( 'Audio Placeholder metabox', 'reveal' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Embed Audio', 'reveal' ),
                'desc'      => sprintf('%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__('Insert Audio Links from Soundcloud, Spotify and ', 'reveal'), esc_url('//codex.wordpress.org/Embeds'), esc_html__('all Music supported sites by WordPress.', 'reveal')),
                'id'        => $prefix . 'audio',
                'type'      => 'oembed',
                'size'      => 95
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-quote-meta',
        'title'      => esc_html__( 'Quote', 'reveal' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Quote Text', 'reveal' ),
                'desc'      => esc_html__('Insert The Quote Text', 'reveal'),
                'id'        => $prefix . 'quote_text',
                'type'      => 'textarea',
                'rows'      => '5'
            ),

            array(
                'name'      => esc_html__( 'Name', 'reveal' ),
                'desc'      => esc_html__('Author Name', 'reveal'),
                'id'        => $prefix . 'quote_name',
                'type'      => 'text',
                'size'      => 80,
            ),

            array(
                'name'      => esc_html__( 'Source', 'reveal' ),
                'desc'      => esc_html__('Source URL', 'reveal'),
                'id'        => $prefix . 'quote_source',
                'type'      => 'url',
                'size'      => 80,
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'reveal-link-meta',
        'title'      => esc_html__( 'Link', 'reveal' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'      => esc_html__( 'Link URL', 'reveal' ),
                'desc'      => esc_html__('Insert Link URL', 'reveal'),
                'id'        => $prefix . 'link_url',
                'type'      => 'text',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Link Text', 'reveal' ),
                'desc'      => esc_html__('Insert Link Text', 'reveal'),
                'id'        => $prefix . 'link_text',
                'type'      => 'text',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Open link in a new window?', 'reveal' ),
                'desc'      => esc_html__('Select "yes" to open link in a new window', 'reveal'),
                'id'        => $prefix . 'link_target',
                'type'      => 'select',
                'options'   => array(
                        '_blank' => __('Yes', 'reveal'),
                        '_self' => __('No', 'reveal'),
                    ),

                'std'       => '_blank',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Link Relation (Optional)', 'reveal' ),
                'desc'      => esc_html__('Set the link "rel" attribute(ex: nofollow, dofollow, etc.)', 'reveal'),
                'id'        => $prefix . 'link_rel',
                'type'      => 'text',
                'size'  => 95,
            ),
        )
    );



    $meta_boxes[] = array(
        'id'         => 'reveal-client-logo-meta',
        'title'      => esc_html__( 'Client Information', 'reveal' ),
        'post_types' => array( 'clients' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(


            array(
                'name'  => esc_html__( 'Client Site URL', 'reveal' ),
                'desc'  => esc_html__('Enter client site URL', 'reveal' ),
                'id'    => $prefix . 'clients_surl',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),



        )
    );


    $meta_boxes[] = array(
        'id'         => 'reveal-event-meta',
        'title'      => esc_html__( 'Event Information', 'reveal' ),
        'post_types' => array( 'events' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'name'  => esc_html__( 'Event Start Date', 'reveal' ),
                'desc'  => esc_html__('Enter event start date', 'reveal' ),
                'id'    => $prefix . 'event_start_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95,
                'js_options' => 'MM d, YY'
            ),


            array(
                'name'  => esc_html__( 'Event Start Time', 'reveal' ),
                'desc'  => esc_html__('Enter event start time', 'reveal' ),
                'id'    => $prefix . 'event_start_time',
                'type'  => 'time',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Event End Date', 'reveal' ),
                'desc'  => esc_html__('Enter events end date', 'reveal' ),
                'id'    => $prefix . 'event_end_date',
                'type'  => 'date',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Event End Time', 'reveal' ),
                'desc'  => esc_html__('Enter event end time', 'reveal' ),
                'id'    => $prefix . 'event_end_time',
                'type'  => 'time',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Contact Phone', 'reveal' ),
                'desc'  => esc_html__('Enter phone number', 'reveal' ),
                'id'    => $prefix . 'event_phone',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Contact Email', 'reveal' ),
                'desc'  => esc_html__('Enter email address', 'reveal' ),
                'id'    => $prefix . 'event_email',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Address', 'reveal' ),
                'desc'  => esc_html__('Enter event location address', 'reveal' ),
                'id'    => $prefix . 'event_address',
                'type'  => 'textarea',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Location Latitude', 'reveal' ),
                'desc'  => esc_html__('Enter event location latitude, you can find latitude/longitude by entering your address here', 'reveal' ),
                'id'    => $prefix . 'event_address_latitude',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Events Location Longitude', 'reveal' ),
                'desc'  => esc_html__('Enter event location longitude, you can find latitude/longitude by entering your address here', 'reveal' ),
                'id'    => $prefix . 'event_address_longitude',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),




        )
    );

    return $meta_boxes;
}


