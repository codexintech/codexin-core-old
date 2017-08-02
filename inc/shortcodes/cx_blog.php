<?php
	function cx_blog_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'			=> '',
	   		'posts_per_page'	=> '',
	   		'order'				=> '',
	   		'orderby'			=> '',
	   		'show_date'			=> '',
	   		'title_length'		=> '',
	   		'desc_length'		=> '',
	   		'count_post_view'	=> '',
	   		'count_comment'		=> '',
	   		'readmore_text'		=> '',
	   		'class'				=> ''
	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		<section id="blog" class="blog blog-shortcode">
			<div class="container">
				<div class="row">

					<?php 
					//start query..
					$args = array(
							'post_type'			=> 'post',
							'posts_per_page'	=> $posts_per_page,
							'order'				=> $order,
							'orderby'			=> $orderby,
						);

					$data = new WP_Query( $args );

						if( $data->have_posts() ) :
							//Srat loop here..
							while( $data->have_posts() ) : $data->the_post();
					 ?>

						<div class="col-sm-4">
							<div class="blog-wrapper">
								<div class="img-thumb">
									<div class="img-wrapper"><img src="<?php echo esc_url( the_post_thumbnail_url( 'blog-mini-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive"></div>
									<?php if( $show_date ) : ?>
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
									<p> 
										<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
									</p>
									<a href="<?php echo esc_url( get_the_permalink() ); ?>">
										<?php echo esc_html( $readmore_text ); ?>
									</a>
								</div>

								<div class="blog-info">
									<span>
										<i class="fa fa-eye"></i> <i>
											<?php
												if( $count_post_view ) :
											 		echo reveal_get_post_views(get_the_ID()); 
											 	endif;
											 ?>
										</i>
									</span>
									<span>
										<i class="fa fa-comments"></i> <i>
											<?php 
											if( $count_comment ) :
												comments_number('No Comments', '1', '%'); 
											endif;
											?>
										</i>
									</span>
								</div>
							</div><!--/.blog-wrapper -->
						</div> <!-- end of col -->
					<?php
						endwhile;
					endif;
					?>
				</div> <!-- end of row -->
			</div> <!-- end of container -->
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
		    						'value'		=> '2',
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
		    								'ID'	=> 'Post ID',
		    								'author'	=> 'Author',
		    								'title'	=> 'Title',
		    								'name'	=> 'Post Name',
		    								'type'	=> 'Post Type',
		    								'date'	=> 'Date',
		    								'comment_count'	=> 'Namber Of Comments',
		    								'rand'	=> 'Random Order',
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
		    						'name'			=> 'count_post_view',
		    						'label'			=> esc_html__( 'Show Posts Count View', 'codexin' ),
		    						'value'			=> 'yes',
		    						'description'	=> esc_html__(' Display count number of visited posts.', 'codexin')
		    					),

		    					array(
		    						'type'			=> 'toggle',
		    						'name'			=> 'count_comment',
		    						'label'			=> esc_html__( 'Show Comments Count View', 'codexin' ),
		    						'value'			=> 'yes',
		    						'description'	=> esc_html__(' Display count number of comments in a post.', 'codexin')
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

							), //End general array(),,

		                ) //End params array()..

		            ),  // End of elemnt cx_blog....


						) //end of  array 


					);  //end of kc_add_map....

				} //End if

			} // end of cx_team_kc


