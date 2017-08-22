<?php


/*
	============================================
		CODEXIN POPULAR POSTS WIDGET CLASS
	============================================
*/


class Codexin_Popular_Posts extends WP_Widget {
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		// Initializing the basic parameters
		$widget_ops = array(
			'classname' => 'codexin-popular-posts-widget',
			'description' => esc_html('Displays Most Popular Posts' , 'codexin'),
		);
		parent::__construct( 'codexin_popular_posts', esc_html__('Codexin: Popular Posts', 'codexin'), $widget_ops );
		
	}
	
	// Back-end display of widget
	public function form( $instance ) {
		
		// Assigning or updating the values
		$title 				= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__('Popular Posts', 'codexin') );
		$num_posts 			= ( !empty( $instance[ 'num_posts' ] ) ? absint( $instance[ 'num_posts' ] ) : esc_html__('3', 'codexin') );
		$title_len 			= ( !empty( $instance[ 'title_len' ] ) ? absint( $instance[ 'title_len' ] ) : esc_html__('7', 'codexin') );
		$show_thumb 		= ( !empty( $instance[ 'show_thumb' ] ) ? $instance[ 'show_thumb' ] : '' );
		$display_meta 		= ( !empty( $instance[ 'display_meta' ] ) ? $instance[ 'display_meta' ] : '' );
		$display_orderby 	= ( !empty( $instance[ 'display_orderby' ] ) ? $instance[ 'display_orderby' ] : '' );
		$show_like	 		= ( !empty( $instance[ 'show_like' ] ) ? $instance[ 'show_like' ] : '' );
		
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_posts' ) ); ?>"><?php echo esc_html__('Number of Posts to Show: ', 'codexin') ?></label>
			<input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'num_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_posts' ) ); ?>" value="<?php echo esc_attr( $num_posts ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title_len' ) ); ?>"><?php echo esc_html__('Title Length (In Words): ', 'codexin') ?></label>
			<input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'title_len' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_len' ) ); ?>" value="<?php echo esc_attr( $title_len ); ?>">
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $show_thumb, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'show_thumb' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_thumb' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'show_thumb' ) ); ?>"><?php echo esc_html__('Display Post Featured Image?', 'codexin'); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $show_like, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'show_like' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_like' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'show_like' ) ); ?>"><?php echo esc_html__('Display Like Button?', 'codexin'); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('display_orderby') ); ?>"><?php echo esc_html__('Choose The Posts Sorting Method:', 'codexin'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('display_orderby') ); ?>" id="<?php echo esc_attr( $this->get_field_id('display_orderby') ); ?>" class="widefat">
				<?php
				$dispby_opt = array(
						esc_html__('Sort By Views Count', 'codexin') => 'meta_value_num', 
						esc_html__('Sort By Comments Count', 'codexin') => 'comment_count'
						);
				foreach ($dispby_opt as $opt => $value) {
					echo '<option value="' . $value . '" id="' . $value . '"', $display_orderby == $value ? ' selected="selected"' : '', '>', $opt, '</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('display_meta') ); ?>"><?php echo esc_html__('Select Post Meta to Display:', 'codexin'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('display_meta') ); ?>" id="<?php echo esc_attr( $this->get_field_id('display_meta') ); ?>" class="widefat">
				<?php
				$options = array(
						esc_html__('Display Post Date', 'codexin'), 
						esc_html__('Display Post Views Count', 'codexin'), 
						esc_html__('Display Comments Count', 'codexin'), 
						esc_html__('Display Both Post Views and Comments Count', 'codexin')
						);
				foreach ($options as $option) {
					$opt = strtolower( str_replace(" ","-", $option ) );
					echo '<option value="' . $opt . '" id="' . $opt . '"', $display_meta == $opt ? ' selected="selected"' : '', '>', $option, '</option>';
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
		$instance[ 'title' ] 			= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'num_posts' ] 		= ( !empty( $new_instance[ 'num_posts' ] ) ? absint( strip_tags( $new_instance[ 'num_posts' ] ) ) : 0 );
		$instance[ 'title_len' ] 		= ( !empty( $new_instance[ 'title_len' ] ) ? absint( strip_tags( $new_instance[ 'title_len' ] ) ) : 0 );
		$instance[ 'show_thumb' ] 		= strip_tags( $new_instance[ 'show_thumb' ] );
		$instance[ 'show_like' ] 		= strip_tags( $new_instance[ 'show_like' ] );
		$instance[ 'display_meta' ] 	= ( !empty( $new_instance[ 'display_meta' ] ) ? strip_tags( $new_instance[ 'display_meta' ] ) : '' );
		$instance[ 'display_orderby' ] 	= ( !empty( $new_instance[ 'display_orderby' ] ) ? strip_tags( $new_instance[ 'display_orderby' ] ) : '' );
		
		return $instance;
		
	}
	
	// Front-end display of widget
	public function widget( $args, $instance ) {
		
		$num_posts 			= absint( $instance[ 'num_posts' ] );
		$title_len 			= absint( $instance[ 'title_len' ] );
		$show_thumb 		= $instance[ 'show_thumb' ];
		$show_like 			= $instance[ 'show_like' ];
		$display_meta 		= $instance[ 'display_meta' ];
		$display_orderby 	= $instance[ 'display_orderby' ];
		$display_meta_a 	= 'display-post-date';
		$display_meta_b 	= 'display-post-views-count';
		$display_meta_c 	= 'display-comments-count';
		$display_meta_d 	= 'display-both-post-views-and-comments-count';
		
		$posts_args = array(
			'post_type'				=> 'post',
			'posts_per_page'		=> $num_posts,
			'meta_key'				=> 'cx_post_views',
			'orderby'				=> $display_orderby,
			'order'					=> 'DESC',
			'ignore_sticky_posts' 	=> 1
		);
		
		$posts_query = new WP_Query( $posts_args );
		
		printf( '%s', $args[ 'before_widget' ] );
		
		if( !empty( $instance[ 'title' ] ) ):
			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);
			
		endif;
		
		if( $posts_query->have_posts() ):
				
			while( $posts_query->have_posts() ): $posts_query->the_post();

				global $post;
            	$image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
            	$image_alt  = ( !empty( $image['alt'] ) ) ? 'alt="' . esc_attr( $image['alt'] ) . '"' : 'alt="' .get_the_title() . '"';

				echo '<div class="posts-single clearfix">';
					if( 'on' == $instance[ 'show_thumb' ] ) {
						echo '<div class="posts-single-left">';
							echo '<a href="' . get_the_permalink() . '"><img src="';
							if ( has_post_thumbnail() ) { 
								esc_url( the_post_thumbnail_url('blog-widget-image') ); 
							} else { 
								echo esc_url('//placehold.it/80x80'); 
							}
							echo '" ' . $image_alt . '/></a>';
						echo '</div><!-- end of posts-single-left -->';
					}
					echo '<div class="posts-single-right">';
						echo '<h4><a href="'. get_the_permalink() .'">' . wp_trim_words( get_the_title(), $title_len, null ) . '</a></h4>';
						if ( $display_meta == $display_meta_a ) {
						echo '<p>'. get_the_time( 'F j, Y' ) .'</p>';
						}
						if( $display_meta == $display_meta_a AND 'on' == $instance[ 'show_like' ] ) {
						echo '<span>'. codexin_likes_button( get_the_ID(), 0 ) .'</span>';
						}
						if( $display_meta == $display_meta_d || $display_meta == $display_meta_b || $display_meta == $display_meta_c) {

							echo '<div class="blog-info">';
								if( $display_orderby == 'meta_value_num' ) {
									if( $display_meta == $display_meta_d OR $display_meta == $display_meta_b ) {
									echo '<span><i class="fa fa-eye"></i><i>' . codexin_get_post_views(get_the_ID()) . '</i></span>';
									}
									if( $display_meta == $display_meta_d OR $display_meta == $display_meta_c ) {
									echo '<span><i class="fa fa-comments"></i><i>' . ' ' . get_comments_number() . '</i></span>';
									}
								} else {
									if( $display_meta == $display_meta_d OR $display_meta == $display_meta_c ) {
									echo '<span><i class="fa fa-comments"></i><i>' . ' ' . get_comments_number() . '</i></span>';
									}
									if( $display_meta == $display_meta_d OR $display_meta == $display_meta_b ) {
									echo '<span><i class="fa fa-eye"></i><i>' . codexin_get_post_views(get_the_ID()) . '</i></span>';
									}
								}
								if( 'on' == $instance[ 'show_like' ] ) {
									echo '<span>'. codexin_likes_button( get_the_ID(), 0 ) .'</span>';
								}

							echo '</div>';

						}

					echo '</div><!-- end of posts-single-right -->';
				echo '</div><!-- end of posts-single -->';
			
			endwhile;
		
		endif;

		wp_reset_postdata();
		
		printf( '%s', $args[ 'after_widget' ] );
		
	}
	
}

// Registering Widget
add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Popular_Posts' );
} );