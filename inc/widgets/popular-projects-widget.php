<?php


/*
	============================================
		CODEXIN POPULAR PROJECTS WIDGET CLASS
	============================================
*/


class Codexin_Popular_Project extends WP_Widget {

	// Initializing meta property
	private $client_name;
	private $project_date;
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'codexin-popular-project-widget',
			'description' => esc_html('Displays Most Popular Project' , 'codexin'),
		);
		parent::__construct( 'codexin_popular_projects', esc_html__('Codexin: Popular Project', 'codexin'), $widget_ops );
		
	}
	
	// back-end display of widget
	public function form( $instance ) {
		
		$title 				= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__('Popular Project', 'codexin') );
		$num_posts 			= ( !empty( $instance[ 'num_posts' ] ) ? absint( $instance[ 'num_posts' ] ) : esc_html__('3', 'codexin') );
		$title_len 			= ( !empty( $instance[ 'title_len' ] ) ? absint( $instance[ 'title_len' ] ) : esc_html__('7', 'codexin') );
		$show_thumb 		= ( !empty( $instance[ 'show_thumb' ] ) ? $instance[ 'show_thumb' ] : '' );
		$show_like	 		= ( !empty( $instance[ 'show_like' ] ) ? $instance[ 'show_like' ] : '' );
		$display_meta 	= ( !empty( $instance[ 'display_meta' ] ) ? $instance[ 'display_meta' ] : '' );
		$display_order 	= ( !empty( $instance[ 'display_order' ] ) ? $instance[ 'display_order' ] : '' );
		
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_posts' ) ); ?>"><?php echo esc_html__('Number of Project to Show: ', 'codexin') ?></label>
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
			<label for="<?php echo esc_attr( $this->get_field_id('display_order') ); ?>"><?php echo esc_html__('Choose The Order to Display Posts:', 'codexin'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('display_order') ); ?>" id="<?php echo esc_attr( $this->get_field_id('display_order') ); ?>" class="widefat">
				<?php
				$disp_opt = array(
						esc_html__('Descending', 'codexin') => 'DESC', 
						esc_html__('Ascending', 'codexin') => 'ASC'
						);
				foreach ($disp_opt as $opt => $value) {
					echo '<option value="' . $value . '" id="' . $value . '"', $display_order == $value ? ' selected="selected"' : '', '>', $opt, '</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('display_meta') ); ?>"><?php echo esc_html__('Select Post Meta to Display :', 'codexin'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('display_meta') ); ?>" id="<?php echo esc_attr( $this->get_field_id('display_meta') ); ?>" class="widefat">
				<?php
				$options = array(
						esc_html__('Display Project Completion Date', 'codexin'), 
						esc_html__('Display Project Client Name', 'codexin'),
						esc_html__('Display Project Category', 'codexin'),
						esc_html__('Display Project Date And Category', 'codexin'),
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
	
	// update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] 			= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'num_posts' ] 		= ( !empty( $new_instance[ 'num_posts' ] ) ? absint( strip_tags( $new_instance[ 'num_posts' ] ) ) : 0 );
		$instance[ 'title_len' ] 		= ( !empty( $new_instance[ 'title_len' ] ) ? absint( strip_tags( $new_instance[ 'title_len' ] ) ) : 0 );
		$instance[ 'show_thumb' ] 		= strip_tags( $new_instance[ 'show_thumb' ] );
		$instance[ 'show_like' ] 		= strip_tags( $new_instance[ 'show_like' ] );
		$instance[ 'display_meta' ] 	= strip_tags( $new_instance[ 'display_meta' ] );
		$instance[ 'display_order' ] 	= ( !empty( $new_instance[ 'display_order' ] ) ? strip_tags( $new_instance[ 'display_order' ] ) : '' );
		
		return $instance;
		
	}
	
	// front-end display of widget
	public function widget( $args, $instance ) {
		
		$num_posts 			= absint( $instance[ 'num_posts' ] );
		$title_len 			= absint( $instance[ 'title_len' ] );
		$show_thumb 		= $instance[ 'show_thumb' ];
		$show_like 			= $instance[ 'show_like' ];
		$display_meta 		= $instance[ 'display_meta' ];
		$display_order 		= $instance[ 'display_order' ];
		$display_meta_a 	= 'display-project-completion-date';
		$display_meta_b 	= 'display-project-client-name';
		$display_meta_c 	= 'display-project-category';
		$display_meta_d 	= 'display-project-date-and-category';
		
		$posts_args = array(
			'post_type'				=> 'portfolio',
			'posts_per_page'		=> $num_posts,
			'meta_key'				=> 'cx_post_views',
			'orderby'				=> 'meta_value_num',
			'order'					=> $display_order,
			'ignore_sticky_posts' 	=> 1
		);
		
		$posts_query = new WP_Query( $posts_args );
		
		printf( '%s', $args[ 'before_widget' ] );
		
		if( !empty( $instance[ 'title' ] ) ):
			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);
			
		endif;
		
		if( $posts_query->have_posts() ):
				
			while( $posts_query->have_posts() ): $posts_query->the_post();		

				echo '<div class="media">';
					if( 'on' == $instance[ 'show_thumb' ] ) {
						echo '<a href="' . get_the_permalink() . '" class="media-left"><img class="media-object" src="';
						if ( has_post_thumbnail() ) { 
							esc_url( the_post_thumbnail_url('blog-widget-image') ); 
						} else { 
							echo esc_url('//placehold.it/120x80'); 
						}
						echo '" alt="' . get_the_title() . '"/></a>';
					}
					echo '<div class="media-body">';
						echo '<h4 class="media-heading">' . wp_trim_words( get_the_title(), $title_len, null ) . '</h4>';
						//fetch custom-meta data
						$c_name = $this->client_name = rwmb_meta( 'reveal_portfolio_client','type=text' );
						$p_date = $this->project_date = rwmb_meta( 'reveal_portfolio_date','type=text' );

						if( $display_meta == $display_meta_b ) {
							echo '<p>'. $c_name .'<p/>';
						}
						if( $display_meta == $display_meta_a || $display_meta == $display_meta_d ) {
							echo '<p>'. $p_date .'<p/>';
						}
						//get texonomy
						if( $display_meta == $display_meta_c || $display_meta == $display_meta_d ) {
							$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 
							foreach ($term_list as $sterm) {
								echo '<p>'. $sterm->name.'</p>'; 
							}//end texonomy
						}
						//End custom meta data
						
						if( 'on' == $instance[ 'show_like' ] ) {
							echo '<span>'. codexin_likes_button( get_the_ID(), 0 ) .'</span>';
						}

						if( $display_orderby == $display_meta_b ) {

							echo '<div class="blog-info">';
							echo '<span><i class="fa fa-eye"></i><i>' . codexin_get_post_views(get_the_ID()) . '</i></span>';
							echo '</div>';

						}

					echo '</div>';
				echo '</div>';
			
			endwhile;
		
		endif;

		wp_reset_postdata();
		
		printf( '%s', $args[ 'after_widget' ] );
		
	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Popular_Project' );
} );