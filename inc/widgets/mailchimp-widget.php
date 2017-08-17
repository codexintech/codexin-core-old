<?php


/*
	============================================
		CODEXIN RECENT POSTS WIDGET CLASS
	============================================
*/

class Codexin_Newsletter_Subscriber extends WP_Widget {
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'codexin-newsletter-subscriber',
			'description' => esc_html__('NewsLetter Subscriber', 'codexin'),
		);
		parent::__construct( 'cx_newsletter_subscriber', esc_html__('Codexin: News Letter Subscribe', 'codexin'), $widget_ops );
		
	}
	
	//back-end display of widget
	public function form( $instance ) {

		$title 		= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__('NewsLetter Subscriber', 'codexin') );
		$listId 	= ( !empty( $instance[ 'listId' ] ) ? $instance[ 'listId' ] : '' );
		$uId 		= ( !empty( $instance[ 'uId' ] ) ? $instance[ 'uId' ] : '' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'listId' ) ); ?>"><?php echo esc_html__('List ID:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'listId' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'listId' ) ); ?>" value="<?php echo esc_attr( $listId ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'uId' ) ); ?>"><?php echo esc_html__('Form u ID:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'uId' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'uId' ) ); ?>" value="<?php echo esc_attr( $uId ); ?>">
		</p>

<?php
		
	}

	// update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] 	= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'listId' ] 	= strip_tags( $new_instance[ 'listId' ] );
		$instance[ 'uId' ] 	= strip_tags( $new_instance[ 'uId' ] );
		
		return $instance;
		
	}

	//front-end display of widget
	public function widget( $args, $instance ) {
		
		$listId	= $instance[ 'listId' ];
		$uId	= $instance[ 'uId' ];
		
		printf( '%s', $args[ 'before_widget' ] );

		?>
		
		<div class="contact-form-wrapper">
			<div class="contact-form">
				<div class="contact-intro">
					<?php 
					if( !empty( $instance[ 'title' ] ) ):

						printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);

					endif; ?>
				</div>			
				<!-- Begin MailChimp Signup Form -->
				<div id="mc_embed_signup">
					<form action="http://codexin.us16.list-manage.com/subscribe/post?u=<?php echo $uId; ?>&amp;id=<?php echo $listId; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">
							<div class="mc-field-group">
								<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
								</label>
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
							</div>
							<div class="mc-field-group">
								<label for="mce-FNAME"> Name </label>
								<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
							</div>
						</div> 
						<div class="clear">
							<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						</div>
					</form>
				</div>

			<!--End mc_embed_signup-->
		</div> <!-- end of col -->
	</div> <!-- end of row -->
	<?php
		printf( '%s', $args[ 'after_widget' ] );

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Newsletter_Subscriber' );
} );
