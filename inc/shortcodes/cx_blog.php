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
			'posts_per_page'	=> '',
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
   $master_class[] = 'blog blog-shortcode';

   // Retrieving user define classes
   $classes = array( 'blog-row' );
   (!empty($class)) ? $classes[] = $class : '';

   ob_start(); 
	?>
	<section id="blog" class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

			<?php 
			//start query..
			$args = array(
					'post_type'			=> 'post',
					'posts_per_page'	=> $posts_per_page,
					'order'				=> $order,
					'orderby'			=> $orderby,
					'meta_key'			=> 'cx_post_views',
				);

			$data = new WP_Query( $args );

				if( $data->have_posts() ) :
					//Srat loop here..
					while( $data->have_posts() ) : $data->the_post();
				$column = 12/$posts_per_page;
			 ?>
				<div class="col-md-<?php echo $column ?> col-ss-12">
					<div class="blog-wrapper">
						<div class="img-thumb">
							<div class="img-wrapper"><img src="<?php echo esc_url( the_post_thumbnail_url( 'blog-grid-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive"></div>
							<?php if( $atts['show_date'] == 'yes') : ?>
								<div class="meta">
									<p><?php the_time( 'd' ); ?></p>
									<p><?php the_time( 'M' ); ?></p>
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
								<?php echo esc_html( $readmore_text ); ?>
							</a>
						</div>
					<?php
						if( $atts['postview_comments'] == 'yes' ) : ?>
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
									<?php comments_number('No Comments', '1', '%'); ?>	
								</i>
							</span>
						<?php elseif( $orderby == $order_com ) : ?>
								<span> 											
								<i class="fa fa-comments"></i> <i>
									<?php comments_number('No Comments', '1', '%'); ?>	
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
									<?php comments_number('No Comments', '1', '%'); ?>	
								</i>
							</span>
						<?php endif; ?>	

						</div>

					<?php endif; //End postview_comments if ?>

					</div><!--/.blog-wrapper -->
				</div> <!-- end of col -->
			<?php
				endwhile;
			endif;
			?>
		</div> <!-- end of blog-row -->
	</section> <!-- end of blog -->

	<div class="clearfix"></div>

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_blog


	function cx_blog_kc() {

		if (function_exists('kc_add_map')) 
		{ 
			kc_add_map(
				array(
					'cx_blog' => array(
						'name' => esc_html__( 'Codexin Blog', 'codexin' ),
						'description' => esc_html__('Codexin Blog', 'codexin'),
						'icon' => 'et-hazardous',
						'category' => 'Codexin',
						'params' => array(
							'general' => array(
								array(
		    						'name'        	=> 'posts_per_page',
		    						'label'       	=> esc_html__('Number Of Post Display', 'codexin'),
		    						'type'        	=> 'select',
		    						'options'		=> array(
		    								'2'	=> '2',
		    								'3'	=> '3',
		    								'4'	=> '4',
		    							),
		    						'value'		=> '3',
		    						'description'	=> esc_html__( 'The number of posts you want to show.', 'codexin' ),
		    						'admin_label' 	=> true,
		    					),

		    					array(
		    						'name'        	=> 'order',
		    						'label'       	=> esc_html__('Post Order', 'codexin'),
		    						'type'        	=> 'select',
		    						'options'		=> array(
		    								'ASC'	=> 'ASC',
		    								'DESC'	=> 'DESC',
		    							),
		    						'value'		=> 'date',
		    						'description'	=> esc_html__( 'Select posts order you want to show.', 'codexin' ),
		    						'admin_label' 	=> true,
		    					),

		    					array(
		    						'name'        	=> 'orderby',
		    						'label'       	=> esc_html__('Post Order By', 'codexin'),
		    						'type'        	=> 'select',
		    						'options'		=> array(
		    								'date'			 => 'Date',
		    								'comment_count'	 => 'Namber Of Comments',
		    								'meta_value_num' => 'Sort By Views Count',
		    								'rand'			 => 'Random Order',
		    							),
		    						'value'		=> 'date',
		    						'description'	=> esc_html__( 'Select posts order by Option you want to show', 'codexin' ),
		    						'admin_label' 	=> true,
		    					),

		    					array(
		    						'type'			=> 'toggle',
		    						'name'			=> 'show_date',
		    						'label'			=> esc_html__( 'Show Date', 'codexin' ),
		    						'value'			=> 'yes',
		    						'description'	=> esc_html__(' Display date of post in post items.', 'codexin')
		    					),

		    					array(
		    						'name'			=> 'title_length',
		    						'label'			=> esc_html__( 'Limit Words Of Title', 'codexin' ),
		    						'type'			=> 'number_slider',
		    						'value'			=> '4',
		    						'description'	=> esc_html__(' Specify number of Words that you want to show into title. Here Minimum value is 3 & Maximum 8', 'codexin'),
		    						'options'		=> array(
		    							'min'			=> 3,
		    							'max'			=> 8,
		    							'unit'			=> '',
		    							'show_input'	=> false
		    							)
		    						),

		    					array(
		    						'name'			=> 'desc_length',
		    						'label'			=> esc_html__( 'Limit Words Of Description', 'codexin' ),
		    						'type'			=> 'number_slider',
		    						'value'			=> '10',
		    						'description'	=> esc_html__(' Specify number of Words that you want to show into Description. Here Minimum value is 10 & Maximum 18', 'codexin'),
		    						'options'		=> array(
		    							'min'			=> 10,
		    							'max'			=> 18,
		    							'unit'			=> '',
		    							'show_input'	=> false
		    							)
		    						),

		    					array(
		    						'type'			=> 'toggle',
		    						'name'			=> 'postview_comments',
		    						'label'			=> esc_html__( 'Show Posts View & Comments Number', 'codexin' ),
		    						'value'			=> 'yes',
		    						'description'	=> esc_html__(' Display count number of visited posts & Total number of comments in a post ', 'codexin')
		    					),

		    					array(
		    						'name'	=> 'readmore_text',
		    						'label' => esc_html__( 'Read More Text', 'codexin' ),
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
		    						'admin_label' => true
		    					),

							), //End general array(),
						
						'styling' => array(

	 							array(
	 								'name'    		=> 'codexin_css',
	 								'type'    		=> 'css',
	 								'options' 		=> array(
	 									array(
	 										"screens" => "any,1199,991,767,479",

	 										'Title' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.blog-title'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.blog-title'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.blog-title'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.blog-title'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.blog-title'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.blog-title'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.blog-title')
	 											),

	 										'Meta Text' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.meta, .blog-info i'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.meta'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.meta'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.meta'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.meta'),
	 											array('property' => 'background', 'label' => 'Background', 'selector' => '.meta'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.meta'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.meta')
	 											),

	 										'Description' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.blog-content, .blog-desc'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.blog-content, .blog-desc'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '..blog-content, .blog-desc'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '..blog-content, .blog-desc'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '..blog-content, .blog-desc'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '..blog-content, .blog-desc'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '..blog-content, .blog-desc')
	 											),

	 										'Read More' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.blog-content a'),
	 											array('property' => 'background-color', 'label' => 'Background Color', 'selector' => '.blog-content a'),
	 											array('property' => 'color', 'label' => 'Hover Color', 'selector' => '.blog-content a:hover'),
	 											array('property' => 'background-color', 'label' => 'Backgroung Hover Color', 'selector' => '.blog-content a:hover'),
	 											array('property' => 'border', 'label' => 'Border', 'selector' => '.blog-content a:hover'),
	 											array('property' => 'border-color', 'label' => 'Border Hover Color', 'selector' => '.blog-content a:hover'),
	 											array('property' => 'transition', 'label' => 'Hover Transition', 'selector' => '.blog-content a:hover'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.blog-content a'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '..blog-content a'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '..blog-content a'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '..blog-content a'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '..blog-content a'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '..blog-content a')
	 											),

	 										'Box'	=> array(
	 											array('property' => 'background'),
	 											array('property' => 'border', 'label' => 'Border'),
	 											array('property' => 'border-radius', 'label' => 'Border Radius'),
	 											array('property' => 'box-shadow', 'label' => 'Box Shadow'),
	 											array('property' => 'margin', 'label' => 'Margin'),
	 											array('property' => 'padding', 'label' => 'Padding'),
	 											),

										) //End inner-option array

									) //End option array

								) //End inner-styling array

	                		), //End styling array..

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

			} // end of cx_team_kc


