<?php


/*
	============================================
		CODEXIN SOCIAL WIDGET CLASS
	============================================
*/


class Codexin_Social_Widget extends WP_Widget {
	
	// setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'codexin-social-widget',
			'description' => 'Displays All Your Social Media Profiles to follow',
		);
		parent::__construct( 'codexin_social_widget', esc_html('Codexin: Social Media Follow', 'codexin'), $widget_ops );

        // Fetching data from options page
        $this->options = get_option( 'codexin_options_social' );
		
	}
	
	// back-end display of widget
	public function form( $instance ) { 
		
		$title 	= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__('Follow Us', 'codexin') );
		
		echo '<p>'. esc_html__('In Order To Use This Widget Please Fill Up The Social Profile Information In The "Social Media" Section of ', 'codexin') .'<strong><a href="'. esc_url(admin_url().'admin.php?page=codexin-options&action=social') .'" target="_blank">'. esc_html('Codexin Core.', 'codexin') .'</a></strong></p>';

		// echo '<p>'. esc_html('Choose The Social Profiles to be Shown:', 'codexin') .'</p>';

		$facebook	 		= ( !empty( $instance[ 'facebook' ] ) ? $instance[ 'facebook' ] : '' );
		$twitter	 		= ( !empty( $instance[ 'twitter' ] ) ? $instance[ 'twitter' ] : '' );
		$instagram	 		= ( !empty( $instance[ 'instagram' ] ) ? $instance[ 'instagram' ] : '' );
		$pinterest	 		= ( !empty( $instance[ 'pinterest' ] ) ? $instance[ 'pinterest' ] : '' );
		$behance	 		= ( !empty( $instance[ 'behance' ] ) ? $instance[ 'behance' ] : '' );
		$google_plus	 	= ( !empty( $instance[ 'google_plus' ] ) ? $instance[ 'google_plus' ] : '' );
		$youtube	 		= ( !empty( $instance[ 'youtube' ] ) ? $instance[ 'youtube' ] : '' );
		$skype	 			= ( !empty( $instance[ 'skype' ] ) ? $instance[ 'skype' ] : '' );
		$linkedin	 		= ( !empty( $instance[ 'linkedin' ] ) ? $instance[ 'linkedin' ] : '' );


	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<?php if( isset($this->options['fb_url']) && !empty( $this->options['fb_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $facebook, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'facebook' ) ); ?>"><?php _e('Facebook', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['tw_url']) && !empty( $this->options['tw_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $twitter, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'twitter' ) ); ?>"><?php _e('Twitter', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['in_url']) && !empty( $this->options['in_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $instagram, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'instagram' ) ); ?>"><?php _e('Instagram', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['pin_url']) && !empty( $this->options['pin_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $pinterest, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'pinterest' ) ); ?>"><?php _e('Pinterest', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['be_url']) && !empty( $this->options['be_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $behance, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'behance' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'behance' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'behance' ) ); ?>"><?php _e('Behance', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['gp_url']) && !empty( $this->options['gp_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $google_plus, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'google_plus' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'google_plus' ) ); ?>"><?php _e('Google Plus', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['yt_url']) && !empty( $this->options['yt_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $youtube, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'youtube' ) ); ?>"><?php _e('Youtube', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['sk_url']) && !empty( $this->options['sk_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $skype, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'skype' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'skype' ) ); ?>"><?php _e('Skype', 'codexin'); ?></label>
		</p>
		<?php endif; ?>

		<?php if( isset($this->options['li_url']) && !empty( $this->options['li_url'] ) ): ?>
		<p style="width: 33%; float:left">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $linkedin, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'linkedin' ) ); ?>"><?php _e('Linked In', 'codexin'); ?></label>
		</p>
		<?php endif; ?>
		<hr style="clear: both; padding: 5px;">


	<?php	

	}

	//Updating the widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance[ 'title' ] 	= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );

        foreach ( array( 'facebook', 'twitter', 'instagram', 'pinterest', 'behance', 'google_plus', 'youtube', 'skype', 'linkedin' ) as $key => $value ) {
            $instance[$value] = ( !empty( $new_instance[ $value ] ) ? sanitize_text_field( $new_instance[ $value ] ) : '' );
        }
		return $instance;
		
	}
	
	//front-end display of widget
	public function widget( $args, $instance ) {

		// Retrieving values from plugin options
		$cx_facebook 	= $this->options['fb_url'];	
		$cx_twitter 	= $this->options['tw_url'];	
		$cx_instagram 	= $this->options['in_url'];	
		$cx_pinterest 	= $this->options['pin_url'];	
		$cx_behance 	= $this->options['be_url'];	
		$cx_gplus 		= $this->options['gp_url'];	
		$cx_youtube 	= $this->options['yt_url'];	
		$cx_skype 		= $this->options['sk_url'];	
		$cx_linkedin 	= $this->options['li_url'];	
		
		printf( '%s', $args['before_widget'] ); ?>

		<div class="footer-left">
			<p><span class="italic"><?php echo esc_html($instance[ 'title' ] ); ?></span>

				<?php if( !empty( $cx_facebook ) && ( 'on' == $instance[ 'facebook' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_facebook); ?>"><i class="fa fa-facebook"></i></a>
				<?php elseif( empty( $cx_facebook ) && ( 'on' == $instance[ 'facebook' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_twitter ) && ( 'on' == $instance[ 'twitter' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_twitter); ?>"><i class="fa fa-twitter"></i></a>
				<?php elseif( empty( $cx_twitter ) && ( 'on' == $instance[ 'twitter' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_instagram ) && ( 'on' == $instance[ 'instagram' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_instagram); ?>"><i class="fa fa-instagram"></i></a>
				<?php elseif( empty( $cx_instagram ) && ( 'on' == $instance[ 'instagram' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_pinterest ) && ( 'on' == $instance[ 'pinterest' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_pinterest); ?>"><i class="fa fa-pinterest"></i></a>
				<?php elseif( empty( $cx_pinterest ) && ( 'on' == $instance[ 'pinterest' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_behance ) && ( 'on' == $instance[ 'behance' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_behance); ?>"><i class="fa fa-behance"></i></a>
				<?php elseif( empty( $cx_behance ) && ( 'on' == $instance[ 'behance' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_gplus ) && ( 'on' == $instance[ 'google_plus' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_gplus); ?>"><i class="fa fa-google-plus"></i></a>
				<?php elseif( empty( $cx_google_plus ) && ( 'on' == $instance[ 'google_plus' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_youtube ) && ( 'on' == $instance[ 'youtube' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_youtube); ?>"><i class="fa fa-youtube-play"></i></a>
				<?php elseif( empty( $cx_youtube ) && ( 'on' == $instance[ 'youtube' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_skype ) && ( 'on' == $instance[ 'skype' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_skype); ?>"><i class="fa fa-skype"></i></a>
				<?php elseif( empty( $cx_skype ) && ( 'on' == $instance[ 'skype' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

				<?php if( !empty( $cx_linkedin ) && ( 'on' == $instance[ 'linkedin' ] ) ) : ?>
				<a href="<?php echo esc_url($cx_linkedin); ?>"><i class="fa fa-linkedin"></i></a>
				<?php elseif( empty( $cx_linkedin ) && ( 'on' == $instance[ 'linkedin' ] ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>

			</p>
		</div>

		<?php
		printf( '%s', $args['after_widget'] );

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Social_Widget' );
} );