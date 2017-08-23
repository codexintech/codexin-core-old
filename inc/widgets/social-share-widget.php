<?php


/*
	============================================
		CODEXIN SOCIAL SHARE WIDGET CLASS
	============================================
*/


class Codexin_Social_Share_Widget extends WP_Widget {
	
	// setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'codexin-social-share-widget',
			'description' => 'Social Media Share for Posts or Pages',
		);
		parent::__construct( 'codexin_social_share_widget', esc_html('Codexin: Social Media Share', 'codexin'), $widget_ops );
		
	}
	
	// back-end display of widget
	public function form( $instance ) { 

		$title 	= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php echo esc_html__('Ex: Share', 'codexin') ?>">
		</p>
		
	<?php	

	}

	//Updating the widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance[ 'title' ] 	= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );

		return $instance;
		
	}
	
	//front-end display of widget
	public function widget( $args, $instance ) {

		printf( '%s', $args['before_widget'] ); 
		$share_url = esc_url( get_the_permalink() );
		if ( is_home() && !is_front_page() ):
			$share_url = esc_url( get_permalink( get_option('page_for_posts' ) ) );
		endif;
		if ( is_home() && is_front_page() ):
			$share_url = esc_url( home_url('/') );
		endif;

		?>

            <div class="share socials">
                <div class="caption"><span class="flaticon-technology"></span> <?php echo $instance[ 'title' ] ; ?></div>    
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url;?>"><i class="fa fa-facebook"></i></a>
                <a target="_blank" href="https://twitter.com/home?status=<?php echo $share_url; ?>"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="https://plus.google.com/share?url=<?php echo $share_url; ?>"><i class="fa fa-google-plus"></i></a>
                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>"><i class="fa fa-linkedin"></i></a>       
            </div>


		<?php
		
		printf( '%s', $args['after_widget'] );

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Social_Share_Widget' );
} );