<?php


/*
    ================================
        CODEXIN BLOG SHORTCODE
    ================================
*/

// Registering Codexin Blog Shortcode
function cx_blog_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'img_alt'			=> '',
			'number_of_posts'	=> '',
			'order'				=> '',
			'orderby'			=> '',
			'show_date'			=> '',
			'title_length'		=> '',
			'desc_length'		=> '',
			'postview_comments'	=> '',
			'readmore_text'		=> '',
			'class'				=> ''
	), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
   $master_class = apply_filters( 'kc-el-class', $atts );
   $master_class[] = 'cx-blog';

   // Retrieving user define classes
   $classes = array( 'blog-row' );
   (!empty($class)) ? $classes[] = $class : '';

   ob_start(); 
	?>
	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

			<?php 
			//start query..
			$args = array(
					'post_type'				=> 'post',
					'posts_per_page'		=> $number_of_posts,
					'order'					=> $order,
					'orderby'				=> $orderby,
					'meta_key'				=> 'cx_post_views',
					'ignore_sticky_posts' 	=> 1
				);

			$data = new WP_Query( $args );

			if( $data->have_posts() ) :
				$i = 0;
				while( $data->have_posts() ) : $data->the_post();
				$i++;
				$column = 12/$number_of_posts;
				$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();



			 ?>
				<div class="col-md-<?php echo $column ?> col-sm-12">
					<div class="blog-wrapper">
						<div class="img-thumb">
							<div class="img-wrapper">
								<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'blog-grid-image' ) : '//placehold.it/540x341' ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
							</div>
							<?php if( $show_date ) : ?>
							<div class="meta">
								<p><?php echo get_the_time( 'd' ); ?></p>
								<p><?php echo get_the_time( 'M' ); ?></p>
							</div>
							<?php endif; ?>
						</div>

						<div class="blog-content">
							<p class="blog-title">
								<?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?>
							</p>
							<p class="blog-desc"> 
								<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
							</p>
							<a class="read-more" href="<?php echo esc_url( get_the_permalink() ); ?>">
								<?php echo esc_html( !empty( $readmore_text ) ? $readmore_text : __('Read More', 'codexin') ); ?>
							</a>
						</div>
					<?php
						if( $postview_comments ) : ?>
						<div class="blog-info">
							<?php
							$order_cpv = 'meta_value_num';
							$order_com = 'comment_count';
							if( $orderby == $order_cpv ) : 
							?>
							<span>
								<i class="fa fa-eye"></i> <i>
									<?php echo codexin_get_post_views(get_the_ID()); ?>
								</i>
							</span>
							<span> 											
								<i class="fa fa-comments"></i> <i>
									<?php comments_number('0', '1', '%'); ?>	
								</i>
							</span>
							<?php elseif( $orderby == $order_com ) : ?>
							<span> 											
								<i class="fa fa-comments"></i> <i>
									<?php comments_number('0', '1', '%'); ?>	
								</i>
							</span>
							<span>
								<i class="fa fa-eye"></i> <i>
									<?php echo codexin_get_post_views(get_the_ID()); ?>
								</i>
							</span>
							<?php else : ?>
							<span>
								<i class="fa fa-eye"></i> <i>
									<?php echo codexin_get_post_views(get_the_ID()); ?>
								</i>
							</span>
							<span> 											
								<i class="fa fa-comments"></i> <i>
									<?php comments_number('0', '1', '%'); ?>	
								</i>
							</span>
						<?php endif; ?>	

						</div>

					<?php endif; //End postview_comments if ?>

					</div><!--/.blog-wrapper -->
				</div> <!-- end of col -->
			<?php
				if( $i%$number_of_posts == 0 ):
					echo '<div class="clearfix"></div>';
				endif;
				endwhile;
			endif;
			?>
		</div> <!-- end of blog-row -->
	</div> <!-- end of cx-blog -->

	<div class="clearfix"></div>

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_blog

// Integrating Shortcode with King Composer
function cx_blog_kc() {
	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_blog' => array(
					'name' => esc_html__( 'Codexin Blog', 'codexin' ),
					'description' => esc_html__('Codexin Blog', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					'params' => array(
	    				// General Params
						'general' => array(
							array(
	    						'name'        	=> 'number_of_posts',
	    						'label'       	=> esc_html__('Number Of Post to Display', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'2'	=> '2',
    								'3'	=> '3',
    								'4'	=> '4',
    							),
	    						'value'			=> '3',
	    						'description'	=> esc_html__( 'Choose the number of posts you want to show.', 'codexin' ),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__('Post Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> 'Ascending',
    								'DESC'	=> 'Descending',
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Posts:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__('Post Sorting Method', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => 'Date',
    								'comment_count'	 => 'Number Of Comments',
    								'meta_value_num' => 'Views Count',
    								'rand'			 => 'Randomize',
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Posts Sorting Method:', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_date',
	    						'label'			=> esc_html__( 'Show Post Pulbished Date?', 'codexin' ),
	    						'value'			=> 'yes',
	    						'description'	=> esc_html__('Choose to enable/disable post published date', 'codexin')
	    					),

	    					array(
	    						'name'			=> 'title_length',
	    						'label'			=> esc_html__( 'Title Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '4',
	    						'description'	=> esc_html__('Specify number of Words that you want to show in your title', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 3,
	    							'max'			=> 8,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
    						),

	    					array(
	    						'name'			=> 'desc_length',
	    						'label'			=> esc_html__( 'Excerpt Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '10',
	    						'description'	=> esc_html__('Specify number of Words that you want to show in your excerpt', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 10,
	    							'max'			=> 20,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
    						),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'postview_comments',
	    						'label'			=> esc_html__( 'Show Posts View & Comments Number?', 'codexin' ),
	    						'value'			=> 'yes',
	    						'description'	=> esc_html__('Displays the post views count and comments count', 'codexin'),
	    						'admin_label' => true
	    					),

	    					array(
	    						'name'	=> 'readmore_text',
	    						'label' => esc_html__( 'Read More Button Text', 'codexin' ),
	    						'type'	=> 'text',
	    						'value'	=> 'Read more',
	    						'description' => esc_html__( 'Edit the text that appears on the "Read more" button.', 'codexin' ),
	    						'admin_label' => true
	    					),

	    					array(
	    						'name'	=> 'class',
	    						'label' => esc_html__( 'Extra Class', 'codexin' ),
	    						'type'	=> 'text',
	    						'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	    					),

						), //End general params
					
						// Style based Params
						'styling' => array(
 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										'Title' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-title')
										),

 										'Post Meta' => array(
 											array('property' => 'color', 'label' => esc_html__('Date Color', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'color', 'label' => esc_html__('Meta Text Color', 'codexin'), 'selector' => '.blog-info i'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.meta'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.meta')
										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content, .blog-desc'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content, .blog-desc'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '..blog-content, .blog-desc'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '..blog-content, .blog-desc'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '..blog-content, .blog-desc'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '..blog-content, .blog-desc'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '..blog-content, .blog-desc')
										),

 										'Read More' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content a'),
 											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.blog-content a'),
 											array('property' => 'color', 'label' => esc_html__('Hover Color', 'codexin'), 'selector' => '.blog-content a:hover'),
 											array('property' => 'background-color', 'label' => esc_html__('Backgroung Hover Color', 'codexin'), 'selector' => '.blog-content a:hover'),
 											array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-content a:hover'),
 											array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'codexin'), 'selector' => '.blog-content a:hover'),
 											array('property' => 'transition', 'label' => esc_html__('Hover Transition', 'codexin'), 'selector' => '.blog-content a:hover'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content a'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '..blog-content a'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '..blog-content a'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '..blog-content a'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '..blog-content a'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '..blog-content a')
										),

 										'Box'	=> array(
 											array('property' => 'background'),
 											array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
 											array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin') ),
 											array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin') ),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
										),
									) 
								) 
							) 
                		), //End styling array..

						// Animate Params
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						),//End animate
	                ) //End params array()..
	            ),  // End of elemnt cx_blog....
			) //end of  array 
		);  //end of kc_add_map....
	} //End if
} // end of cx_blog_kc


