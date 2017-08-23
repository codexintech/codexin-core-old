<?php


/*
	============================================
		CODEXIN TESTIMONIAL WIDGET CLASS
	============================================
*/

class Codexin_Testimonial_Widget extends WP_Widget {
	
	// Initializing meta property
	private $author_name;

	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'codexin-testimonial-widget',
			'description' => esc_html__('Displays Testimonial Carousel', 'codexin'),
		);
		parent::__construct( 'cx_testimonial_widget', esc_html__('Codexin: Testimonial Widget', 'codexin'), $widget_ops );
		
	}
	
	//back-end display of widget
	public function form( $instance ) {

		$title 			= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );


		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php echo esc_html__('Ex: Testimonials', 'codexin') ?>">
		</p>

<?php
		
	}

	// update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		
		return $instance;
		
	}

	//front-end display of widget
	public function widget( $args, $instance ) {
		
		$posts_args = array(
			'post_type'			=> 'testimonial',
			'posts_per_page'	=> -1,
			'order'				=> 'DESC'
		);
		
		$posts_query = new WP_Query( $posts_args );
		
		printf( '%s', $args[ 'before_widget' ] );
		
		if( !empty( $instance[ 'title' ] ) ):
			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);
			
		endif;

		echo '<div id="quote-carousel" class="carousel slide" data-ride="carousel">';
			echo '<ol class="carousel-indicators hidden">';
		    	echo '<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>';
		        echo '<li data-target="#quote-carousel" data-slide-to="1"></li>';
		    echo '</ol>';
			echo '<div class="carousel-inner" role="listbox">';

			if( $posts_query->have_posts() ):

				$i = 0;	
				while( $posts_query->have_posts() ): $posts_query->the_post();
				$i++;

				?>
					<?php if( $i == 1 ): ?>
	                <div class="item active">
		            <?php else: ?>
	            	<div class="item">
		            <?php endif; ?>
	                    <div class="quote-wrapper">
	                        <div class="quote-author-thumb">
	                            <i class="fa fa-comments"></i>
	                        </div>
	                        <div class="quote-text">
	                            <p><?php echo the_content(); ?></p>
	                            <p class="quote-author-name">"<?php echo $this->author_name = rwmb_meta( 'reveal_author_name','type=text' ); ; ?>"</p>
	                        </div>
	                    </div>
	                </div>

	               <?php
	
				endwhile;
			
			endif;

			echo '</div>';
		echo '</div>';


		wp_reset_postdata();
		
		printf( '%s', $args[ 'after_widget' ] );

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Testimonial_Widget' );
} );