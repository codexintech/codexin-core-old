<?php

/**
 * Widget Class -  Recent Projects
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

class Codexin_Recent_Projects extends WP_Widget {

	// Initializing meta property
	private $client_name;
	private $project_date;
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		// Initializing the basic parameters
		$widget_ops = array(
			'classname' 	=> esc_attr( 'codexin-recent-projects-widget' ),
			'description' 	=> esc_html__( 'Displays Most Recent Projects', 'codexin' ),
		);
		parent::__construct( 'cx_recent_projects', esc_html__( 'Codexin: Recent Projects', 'codexin' ), $widget_ops );
		
	}
	
	// Back-end display of widget
	public function form( $instance ) {

		// Assigning or updating the values
		$title 			= ( ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
		$num_posts 		= ( ! empty( $instance[ 'num_posts' ] ) ? absint( $instance[ 'num_posts' ] ) : esc_html__( '3', 'codexin' ) );
		$title_len 		= ( ! empty( $instance[ 'title_len' ] ) ? absint( $instance[ 'title_len' ] ) : esc_html__( '30', 'codexin' ) );
		$show_thumb 	= ( ! empty( $instance[ 'show_thumb' ] ) ? $instance[ 'show_thumb' ] : '' );
		$meta_date	 	= ( ! empty( $instance[ 'meta_date' ] ) ? $instance[ 'meta_date' ] : '' );
		$meta_cat	 	= ( ! empty( $instance[ 'meta_cat' ] ) ? $instance[ 'meta_cat' ] : '' );
		$display_order 	= ( ! empty( $instance[ 'display_order' ] ) ? $instance[ 'display_order' ] : '' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'codexin' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php echo esc_html__( 'Ex: Recent Projects', 'codexin' ) ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_posts' ) ); ?>"><?php echo esc_html__( 'Number of Projects to Show:', 'codexin' ) ?></label>
			<input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'num_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_posts' ) ); ?>" value="<?php echo esc_attr( $num_posts ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title_len' ) ); ?>"><?php echo esc_html__( 'Title Length (In Characters): ', 'codexin' ) ?></label>
			<input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'title_len' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_len' ) ); ?>" value="<?php echo esc_attr( $title_len ); ?>">
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $show_thumb, 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumb' ) ); ?>" /> 
		    <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>"><?php echo esc_html__( 'Display Post Featured Image?', 'codexin' ); ?></label>
		</p>

		<p style="margin-top: 20px"><?php echo esc_html__( 'Select Project Meta to Display :', 'codexin' ); ?></p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $meta_date, 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'meta_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'meta_date' ) ); ?>" /> 
		    <label for="<?php echo esc_attr( $this->get_field_id( 'meta_date' ) ); ?>"><?php echo esc_html__( 'Display Project Completion Date', 'codexin' ); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $meta_cat, 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'meta_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'meta_cat' ) ); ?>" /> 
		    <label for="<?php echo esc_attr( $this->get_field_id( 'meta_cat' ) ); ?>"><?php echo esc_html__( 'Display Project Categories', 'codexin' ); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'display_order' ) ); ?>"><?php echo esc_html__( 'Choose The Order to Display projects:', 'codexin' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'display_order' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_order' ) ); ?>" class="widefat">
				<?php
				$disp_opt = array(
						esc_html__( 'Descending', 'codexin' ) 	=> 'DESC', 
						esc_html__( 'Ascending', 'codexin' ) 	=> 'ASC'
						);
				foreach ($disp_opt as $opt => $value) {
					echo '<option value="' . esc_attr( $value ) . '" id="' . esc_attr( $value ) . '"', $display_order == $value ? ' selected="selected"' : '', '>', $opt, '</option>';
				}
				?>
			</select>
		</p>

		

<?php
		
	}

	// Updating the widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();

		// Updating to the latest values
		$instance[ 'title' ] 			= ( ! empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'num_posts' ] 		= ( ! empty( $new_instance[ 'num_posts' ] ) ? absint( strip_tags( $new_instance[ 'num_posts' ] ) ) : 0 );
		$instance[ 'title_len' ] 		= ( ! empty( $new_instance[ 'title_len' ] ) ? absint( strip_tags( $new_instance[ 'title_len' ] ) ) : 0 );
		$instance[ 'show_thumb' ] 		= strip_tags( $new_instance[ 'show_thumb' ] );
		$instance[ 'meta_date' ] 		= strip_tags( $new_instance[ 'meta_date' ] );
		$instance[ 'meta_cat' ] 		= strip_tags( $new_instance[ 'meta_cat' ] );
		$instance[ 'display_order' ] 	= strip_tags( $new_instance[ 'display_order' ] );
		
		return $instance;
		
	}

	// Front-end display of widget
	public function widget( $args, $instance ) {
		
		$num_posts 		= absint( $instance[ 'num_posts' ] );
		$title_len 		= absint( $instance[ 'title_len' ] );
		$show_thumb 	= $instance[ 'show_thumb' ];
		$meta_date 		= $instance[ 'meta_date' ];
		$meta_cat 		= $instance[ 'meta_cat' ];
		$display_order 	= $instance[ 'display_order' ];

		$posts_args = array(
			'post_type'			=> 'portfolio',
			'posts_per_page'	=> $num_posts,
			'posts_per_page'	=> $num_posts,
			'order'				=> $display_order,
		);
		
		$posts_query = new WP_Query( $posts_args );
		
		printf( '%s', $args[ 'before_widget' ] );
		
		if( ! empty( $instance[ 'title' ] ) ) {			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);			
		}
		
		if( $posts_query->have_posts() ) {
				
			while( $posts_query->have_posts() ) {
				$posts_query->the_post();

				// Alt tag
				$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

            	// Project thumbnail
				$thumbnail_size = 'codexin-core-square-one';
				if( function_exists( 'codexin_attachment_metas_extended' ) ) {
					$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'portfolio', $thumbnail_size )['src'];
				} else {
					$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/80X80';
				}

				echo '<div class="posts-single clearfix">';
					if( 'on' == $instance[ 'show_thumb' ] ) {
						echo '<div class="posts-single-left">';
							echo '<a href="' . esc_url( get_the_permalink() ) . '"><img src="'. esc_url( $post_thumbnail ) .'" alt="' . esc_attr( $image_alt ) . '"/></a>';
						echo '</div><!-- end of posts-single-left -->';
					}
					echo '<div class="posts-single-right">';
						echo '<h4><a href="'. esc_url( get_the_permalink() ) .'">';
			            	if( function_exists( 'codexin_char_limit' ) ) {
			                    echo apply_filters( 'the_title', codexin_char_limit( $title_len, 'title' ) );
			            	} else {
						    	echo esc_html( wp_trim_words( get_the_title(), $title_len ) );
			            	}
						echo '</a></h4>';

						//fetch custom-meta data
						$pr_date = $this->project_date = rwmb_meta( 'codexin_portfolio_date' );
						$p_date  = date( get_option('date_format'), strtotime( $pr_date ) );

						if( 'on' == $instance[ 'meta_date' ] ) {
							echo '<p>' . esc_html( $p_date ) . '</p>';
						}
						//get texonomy
						if( 'on' == $instance[ 'meta_cat' ] ) {
							$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 
							$port_cat = array();
							foreach ($term_list as $sterm) {
								$port_cat[] = ucfirst($sterm->name); 
							}
							echo '<p>' . esc_html( implode( ", ", array_reverse( $port_cat ) ) ) . '</p>';
						}
					echo '</div><!-- end of posts-single-right -->';
				echo '</div><!-- end of posts-single -->';				
			}		
		}

		wp_reset_postdata();
		
		printf( '%s', $args[ 'after_widget' ] );

	}
	
}

// Registering the Widget
add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Recent_Projects' );
} );


