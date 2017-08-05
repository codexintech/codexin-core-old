<?php



/*
    ============================================
        CODEXIN INSTAGRAM WIDGET CLASS
    ============================================
*/



class Codexin_Instagram_Widget extends WP_Widget {
    
    //setup the widget name, description, etc...
    public function __construct() {

        $widget_ops = array(
            'classname' => 'codexin-instagram-widget',
            'description' => esc_html('Displays Your Latest Instagrams', 'codexin'),
        );
        parent::__construct( 'codexin_instagram_widget', esc_html__('Codexin: Instagram Widget', 'codexin'), $widget_ops );

    }
    
    // front-end display of widget
    public function widget( $args, $instance ) {

        $title    = ( ! empty( $instance['title'] ) ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $username = ( ! empty( $instance['username'] ) ) ? esc_attr( $instance['username'] ) : '';

        // Get instagrams
        $cx_instagram = $this->get_instagrams_data( array(
            'user_id'     => $instance['user_id'],
            'client_id'   => $instance['client_id'],
            'accss_token' => $instance['accss_token'],
            'count'       => $instance['count'],
            'flush_cache' => false,
        ) );

        // Check the parameters
        if ( false !== $cx_instagram ) : ?>

            <?php
                printf( '%s', $args['before_widget'] );
                printf( '%s' . esc_html( $title ) . '%s', $args['before_title'], $args['after_title'] );
                $ig_image_lo_res = apply_filters( 'codexin_lo_image_res', 'thumbnail' );
                $ig_image_hi_res = apply_filters( 'codexin_hi_image_res', 'standard_resolution' );
            ?>

            <div class="instagram-images">

            <?php 
                // Looping through the parameters
                foreach( $cx_instagram['data'] as $key => $ig_image ) {
                    echo apply_filters( 'codexin_ig_image_html', sprintf( 
                        '<a href="%1$s" class="cx-image-link">
                            <img src="%2$s" alt="%3$s" title="%3$s" />
                            <div class="hoverable"></div>
                        </a>',
                        // $ig_image['link'],
                        $ig_image['images'][ $ig_image_hi_res ]['url'],
                        $ig_image['images'][ $ig_image_lo_res ]['url'],
                        $ig_image['caption']['text']
                    ), $ig_image );
                }
            ?>
            </div>
            <a href="https://instagram.com/<?php echo esc_html( $username ); ?>" class='more' target='_blank'><i><?php printf( esc_html__( 'Follow %1$s on Instagram', 'codexin' ), esc_html( $username ) ); ?></i></a>

            <?php printf( '%s', $args['after_widget'] ); ?>

        <?php elseif( ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) && ( defined( 'WP_DEBUG_DISPLAY' ) && false !== WP_DEBUG_DISPLAY ) ): ?>
            <div id="message" class="error"><p><?php esc_html_e( 'Error: We were unable to fetch your instagram feed.', 'codexin' ); ?></p></div>
        <?php endif;
    }

    // back-end display of widget
    public function form( $instance ) {

        // Get options or set defaults
        $title       = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $username    = ( ! empty( $instance['username'] ) ) ? $instance['username'] : '';
        $user_id     = ( ! empty( $instance['user_id'] ) ) ? $instance['user_id'] : '';
        $client_id   = ( ! empty( $instance['client_id'] ) ) ? $instance['client_id'] : '';
        $accss_token = ( ! empty( $instance['accss_token'] ) ) ? $instance['accss_token'] : '';
        $count       = ( ! empty( $instance['count'] ) ) ? $instance['count'] : '';
        $placeholder = ( ! empty( $instance['placeholder'] ) ) ? $instance['placeholder'] : '';

        $this->form_input(
            array(
                'label'       => esc_html__( 'Widget Title:', 'codexin'),
                'name'        => $this->get_field_name( 'title' ),
                'id'          => $this->get_field_id( 'title' ),
                'type'        => 'text',
                'value'       => $title,
                'placeholder' => 'Instagram'
            )
        );
        $this->form_input(
            array(
                'label'       => esc_html__( 'Username:', 'codexin'),
                'name'        => $this->get_field_name( 'username' ),
                'id'          => $this->get_field_id( 'username' ),
                'type'        => 'text',
                'value'       => $username,
                'placeholder' => 'Insert User Name'
            )
        );
        $this->form_input(
            array(
                'label'       => esc_html__( 'User ID:', 'codexin'),
                'name'        => $this->get_field_name( 'user_id' ),
                'id'          => $this->get_field_id( 'user_id' ),
                'type'        => 'text',
                'value'       => $user_id,
                'placeholder' => 'Insert User ID',
                'desc'        => sprintf( __( 'Lookup your User ID from <a href="%1$s" target="_blank">here</a>', 'codexin' ), esc_url( '//ershad7.com/InstagramUserID/' ) )
            )
        );
        $this->form_input(
            array(
                'label'       => esc_html__( 'Access Token:', 'codexin'),
                'name'        => $this->get_field_name( 'accss_token' ),
                'id'          => $this->get_field_id( 'accss_token' ),
                'type'        => 'text',
                'value'       => $accss_token,
                'placeholder' => 'Insert Access Token',
                'desc'        => sprintf( __( 'Generate Your Access Token from <a href="%1$s" target="_blank">here</a>', 'codexin' ), esc_url( '//instagram.pixelunion.net/' ) )
            )
        );
        $this->form_input(
            array(
                'label'       => esc_html__( 'Client ID:', 'codexin'),
                'name'        => $this->get_field_name( 'client_id' ),
                'id'          => $this->get_field_id( 'client_id' ),
                'type'        => 'text',
                'value'       => $client_id,
                'placeholder' => 'Insert Client ID',
                'desc'        => sprintf( __( 'Register a new client from <a href="%1$s" target="_blank">here</a>', 'codexin' ), esc_url( '//instagram.com/developer/clients/manage/' )
            ) )
        );
        $this->form_input(
            array(
                'label'       => esc_html__( 'Number of Photos to be Shown:', 'codexin'),
                'name'        => $this->get_field_name( 'count' ),
                'id'          => $this->get_field_id( 'count' ),
                'type'        => 'number',
                'value'       => $count,
                // 'placeholder' => esc_html__('9', 'codexin')
            )
        );

    }


    // update widget
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
            foreach ( array( 'title', 'username', 'user_id', 'accss_token', 'client_id', 'count' ) as $key => $value ) {
                $instance[$value] = sanitize_text_field( $new_instance[$value] );
            }
            delete_transient( $this->id );
        return $instance;
    }

    // Building the form inputs
    public function form_input( $args = array() ) {
        $args = wp_parse_args( $args, array(
            'label'       => '',
            'name'        => '',
            'id'          => '',
            'type'        => 'text',
            'value'       => '',
            'placeholder' => '',
            'desc'        => ''
        ) );
        $label       = esc_html( $args['label'] );
        $name        = esc_html( $args['name'] );
        $id          = esc_html( $args['id'] );
        $type        = esc_html( $args['type'] );
        $value       = esc_html( $args['value'] );
        $placeholder = esc_html( $args['placeholder'] );
        $desc        = ! empty( $args['desc'] ) ? sprintf( '<span class="description">%1$s</span>', $args['desc'] ) : '';
        printf(
            '<p><label for="%1$s">%2$s</label><input type="%3$s" class="widefat" name="%4$s" id="%1$s" value="%5$s" placeholder="%6$s" />%7$s</p>',
            $id,
            $label,
            $type,
            $name,
            $value,
            $placeholder,
            $desc
        );
    }


    // Getting data from Instagram API.
    public function get_instagrams_data( $args = array() ) {

        // Get args
        $user_id        = ( ! empty( $args['user_id'] ) ) ? $args['user_id'] : '';
        $accss_token    = ( ! empty( $args['accss_token'] ) ) ? $args['accss_token'] : '';
        $client_id      = ( ! empty( $args['client_id'] ) ) ? $args['client_id'] : '';
        $count          = ( ! empty( $args['count'] ) ) ? $args['count'] : '';
        $flush          = ( ! empty( $args['flush_cache'] ) ) ? $args['flush_cache'] : '';

        // Check if all the fields are filled up
        if ( empty( $client_id ) || empty( $user_id ) || empty( $accss_token ) ) {
            echo esc_html__('Please Provide Valid Instagram User ID, Client ID and Access Token', 'codexin');
            return false;
        }

        // Get instagram URL by username and access token
        $api_url = 'https://api.instagram.com/v1/users/' . esc_html( $user_id ) . '/media/recent/?access_token='. esc_html( $accss_token );

        // Set transient key
        $transient_key = $this->id;

        // Attempt to fetch from transient
        $data = get_transient( $transient_key );

        // If we're flushing or there's no transient
        if ( $flush || false === ( $data ) ) {

            // Ping Instragram's API
            $ig_ping = wp_remote_get( add_query_arg( array(
                'client_id' => esc_html( $client_id ),
                'count'     => absint( $count )
            ), $api_url ) );

            // Check if the API is up
            if ( ! 200 == wp_remote_retrieve_response_code( $ig_ping ) ) {
                return false;
            }

            // Parse the API data and store in a variable
            $data = json_decode( wp_remote_retrieve_body( $ig_ping ), true );

            // Check the result whether its an array
            if ( ! is_array( $data ) ) {
                return false;
            }

            // Unserialize the results
            $data = maybe_unserialize( $data );

            // Store Instagrams in a transient, and expire every hour
            set_transient( $transient_key, $data, apply_filters( 'codexin_instagram_cache', 1 * HOUR_IN_SECONDS ) );
        }

        return $data;
    }
} 

// Registering the widget
add_action( 'widgets_init', function() {
    register_widget( 'Codexin_Instagram_Widget' );
} );