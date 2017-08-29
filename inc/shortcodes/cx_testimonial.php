<?php


/*
    ======================================
        CODEXIN TESTIMONIAL SHORTCODE
    ======================================
*/
	
// Registering Testimonial Shortcode
function cx_testimonial_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'layout'	=> '',
			'class_layout_one' => '',
			'class_layout_two' => '',
			'class_layout_three' => '',
			'section_title' => '',
			'sub_title' => '',
			'testimonial_icon' => '',
	), $atts));

	$result = '';

	ob_start(); 

	// Retrieving Image Alt Tags
	$img_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

   		if( ! empty( $layout ) ) :
   			if( $layout == 1 ) :

   				// Assigning a master css class and hooking into KC
				$master_class = apply_filters( 'kc-el-class', $atts );
				$master_class[] = 'quote';

				// Retrieving user define classes
				$classes = array( 'testimonial-row' );
				(!empty($class_layout_one)) ? $classes[] = $class_layout_one : ''; 

				?>

				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
						<div id="quote-carousel" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators hidden">
								<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
								<li data-target="#quote-carousel" data-slide-to="1"></li>
							</ol>

							<!-- Wrapper for slides -->
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<div class="carousel-inner" role="listbox">
										<?php 
																		//start new query..
										$args = array(
											'post_type'		 => 'testimonial',
											'order'			 => 'date',
											'orderby'		 => 'DESC',
											'posts_per_page' => -1,
											);

										$data = new WP_Query( $args );
										$i = 0;
										if( $data->have_posts() ) :
																			//Start loop here...
											while( $data->have_posts() ) : $data->the_post();
										$i++;

										if( $i == 1 ) :
											?>
										<div class="item active">
											<?php 
											else : ?>
											<div class="item">
												<?php
												endif;
												?>

												<div class="quote-wrapper">
													<div class="quote-author-thumb">
														<i class="fa <?php echo $testimonial_icon; ?>"></i>
													</div>
													<div class="quote-text">
														<p> <?php printf( '%s', get_the_excerpt() ); ?> </p>
														<p class="quote-author-name">
															<?php 
															$aut_name = rwmb_meta( 'reveal_author_name','type=text' );
															echo esc_html( $aut_name );
															?>
														</p>
													</div>
												</div>
											</div> <!--/item-->
											<?php 
											endwhile;
											endif; //End check-posts if()....
											wp_reset_postdata();
											?>	
										</div> <!-- end of carousel inner -->
									</div> <!-- end of col -->
								</div> <!-- end of row -->

								<!-- Controls -->
								<a class="left quote-carousel-control" href="#quote-carousel" role="button" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								</a>
								<a class="right quote-carousel-control" href="#quote-carousel" role="button" data-slide="next">
									<i class="fa fa-angle-right"></i>
								</a>
							</div><!--#quote-carousel-->
						</div><!--/.row-->
					</div>  <!-- end of quote -->
   			

		<?php 
			endif; //End layout - 1 ...

			if( $layout == 2 ) :

				// Assigning a master css class and hooking into KC
   				$master_class = apply_filters( 'kc-el-class', $atts );
	   			$master_class[] = 'testimonials animated';

	   			// Retrieving user define classes
	   			$classes = array( 'testimonial-two-row' );
	   			(!empty($class_layout_two)) ? $classes[] = $class_layout_two : '';
	?>
			<section id="testimonials" class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php 
									//start new query..
					$args = array(
						'post_type'		 => 'testimonial',
						'order'			 => 'date',
						'orderby'		 => 'DESC',
						'posts_per_page' => 4,
						);

					$data = new WP_Query( $args );
					if( $data->have_posts() ) :
						while( $data->have_posts() ) : $data->the_post();
						?>
					<div class="col-sm-6 quote-wrapper">
						<div class="media">
							<div class="media-left">
								<img class="media-object img-circle" src="<?php echo esc_url( the_post_thumbnail_url( 'testimonial-mini-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
							</div>
							<div class="media-body">
								<h3 class="media-heading">
									<?php 
									$name = rwmb_meta( 'reveal_author_name', 'type=text' ); 
									echo esc_html( $name );
									?>
								</h3>
								<p class="designation">
									<?php 
									$desig = rwmb_meta( 'reveal_author_desig', 'type=text' ); 
									echo esc_html( $desig );
									?>
								</p>
								 <p class="testimonial-description"> <?php printf('%s', get_the_excerpt() ); ?> </p>
							</div>
						</div>
					</div> <!--end of quote-wrapper -->

				<?php 
				endwhile;
				endif;
				wp_reset_postdata(); ?>

				</div><!--/.row -->
			</section> <!-- end of testimonials -->

		<?php			
		endif; //End layout-2 

		if( $layout == 3 ) :

			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
   			$master_class[] = 'client-feedback';

   			// Retrieving user define classes
   			$classes = array( 'container' );
   			(!empty($class_layout_three)) ? $classes[] = $class_layout_three : ''; ?>

   			<section id="feedback" class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
   				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
   					<div class="row">
   						<!-- section title  -->
   						<div class="col-sm-12">
   							<div class="rv2-title after-white center-block">
   								<h2 class="primary-title rv2"> <?php echo esc_html( $section_title ); ?> </h2>
   								<h4 class="secondary-title rv2"><?php echo esc_html( $sub_title ); ?></h4>
   							</div>
   						</div>  <!-- end of col-sm-12 -->
   						<div class="clearfix"></div>

   						<div class="client-comment-curosel owl-carousel owl-theme">
   							<?php 
									//start new query..
   							$args = array(
   								'post_type'		 => 'testimonial',
   								'order'			 => 'date',
   								'orderby'		 => 'DESC',
   								'posts_per_page' => -1,
   								);

   							$data = new WP_Query( $args );
   							if( $data->have_posts() ) :
   								while( $data->have_posts() ) : $data->the_post();
   							?>
   							<div class="col-sm-6">
   								<div class="client ">
   									<div class="client-info">
   										<div class="client-img">
   											<img src="<?php echo esc_url( the_post_thumbnail_url( 'testimonial-mini-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
   										</div>
   										<div class="client-name">
   											<i class="flaticon-right-quotes-symbol"></i>
   											<h3 class="title-3">
   												<?php 
   												$name = rwmb_meta( 'reveal_author_name', 'type=text' ); 
   												echo esc_html( $name );
   												?>
   											</h3>
   										</div>
   									</div>
   									<div class="client-comment">
   										<p> <?php printf('%s', get_the_excerpt() ); ?> </p>
   									</div>
   								</div>
   							</div> <!-- end of col-sm-6 -->
   							<?php 
   							endwhile;
   							endif;
   							wp_reset_postdata(); ?>
   						</div> <!-- end of client-comment-curosel -->
   					</div> <!-- end of row -->
   				</div> <!-- end of container -->
   			</section> <!-- end of section -->
   			<div class="clearfix"></div>


	<?php endif; ?>

	<?php
		endif;
	$result .= ob_get_clean();
	return $result;

} //End cx_testimonial

// Integrating Shortcode with King Composer
function cx_testimonial_kc() {

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_testimonial' => array(
					'name' => esc_html__( 'Codexin Testimonial', 'codexin' ),
					'description' => esc_html__('Codexin Testimonial', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					// Only load assets when using this element
  	        		'assets' 			=> array(
  	        			'scripts' 		=> array(
  	        				'owl-js-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/owl.carousel.min.js',
  	        				'owl-active-js' 	=> CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_clientcarosel_layout_3.js',
  	        				),
  	        			'styles'	=> array(
  	        				'owl-style'	=> CODEXIN_CORE_ASSET_DIR . '/css/owl.carousel.min.css',
  	        				'owl-theme-style'	=> CODEXIN_CORE_ASSET_DIR . '/css/owl.theme.default.min.css',
  	        				),

                	), //End assets
					'params' => array(
						'general' => array(
							array(
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select Testimonial Template', 'codexin' ),
								'name'			=> 'layout',
								'admin_label'	=> true,
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/layout-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/layout-2.png',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/layout-3.png',
								),
								'value'	=> '1'
							),
	                		
	                		//layout One 
							array(
								'name' 			=> 'testimonial_icon',
								'label' 		=> __( 'Testimonial Icon', 'codexin' ),
								'type' 			=> 'icon_picker',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '1',
								),
								'description'	=> esc_html__( 'Select Your Icon Here', 'codexin' ),
								'admin_label' 	=> false,
							),

							array(
								'name' 			=> 'class_layout_one',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '1',
								),
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
								'admin_label' 	=> false,
							),

	                		//Layout Two
							array(
								'name' 			=> 'class_layout_two',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '2',
								),
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
								'admin_label' 	=> false,
							),

							//Layout Three
							array(
								'name'	=> 'section_title',
								'label'	=> __( 'Section Title', 'codexin' ),
								'type'	=> 'text',
								'relation' => array(
									'parent'	=> 'layout',
									'show_when' => '3',
								),
								'description'	=> __( 'Enter Section Title Here', 'codexin' ),
							),

							array(
								'name'	=> 'sub_title',
								'label'	=> __( 'Sub Title', 'codexin' ),
								'type'	=> 'text',
								'relation' => array(
									'parent'	=> 'layout',
									'show_when' => '3',
								),
								'description'	=> __( 'Enter Section Sub Title Here', 'codexin'),
							),

							array(
								'name' 			=> 'class_layout_three',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3',
								),
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
								'admin_label' 	=> false,
							),

	                	), //End general array..

	                	//Styling Layout One
						'styling' => array(
							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' 		=> array(
									array(
										"screens" => "any,1199,991,767,479",

										'Name'	=> array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color' ), 'selector' => '.client-name .title-3' ),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size' ), 'selector' => '.client-name .title-3' ),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family' ), 'selector' => '.client-name .title-3' ),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight' ), 'selector' => '.client-name .title-3' ),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin' ), 'selector' => '.client-name .title-3' ),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding' ), 'selector' => '.client-name .title-3' ),
										),

										'Icon'	=> array(
											array( 'property' => 'color', 'label' => 'Icon Color', 'selector' => '.quote-author-thumb i' ),
											array( 'property' => 'border', 'label' => 'Icon Box Border', 'selector' => '.quote-author-thumb i' ),
											array( 'property' => 'border-radius', 'label' => 'Icon Box Border Radius', 'selector' => '.quote-author-thumb i' ),
										),

										'Description' => array(
											array('property' => 'color', 'label' => esc_html__( 'Text Color' ), 'selector' => '.quote-text p,.media-heading,designation,p,.client-comment p'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family' ), 'selector' => '.quote-text p,.client-comment p'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align' ), 'selector' => '.quote-text p, .testimonial-description,.client-comment p'),
										),

										'Image' => array(
											array('property' => 'border', 'label' => 'Image Box Border', 'selector' => '.img-circle'),
											array('property' => 'border-radius', 'label' => 'Image Box Border Radius', 'selector' => '.img-circle'),
										),

										'Divider' => array(
											array('property' => 'background', 'label' => 'Color', 'selector' => '.quote-author-name::before, .designation::after'),
											array('property' => 'width', 'label' => 'Width', 'selector' => '.quote-author-name::before, .designation::after'),
											array('property' => 'height', 'label' => 'Height', 'selector' => '.quote-author-name::before, .designation::after'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.quote-author-name::before, .designation::after'),
											array('property' => 'padding', 'label' => 'padding', 'selector' => '.quote-author-name::before, .designation::after')
										),

										'Box'	=> array(
											array('property' => 'background'),
											array('property' => 'border', 'label' => 'Border'),
											array('property' => 'border-radius', 'label' => 'Border Radius'),
											array('property' => 'box-shadow', 'label' => 'Box Shadow'),
											array('property' => 'box-shadow', 'label' => 'Box Shadow on Hover'),
											array('property' => 'transition', 'label' => 'Hover Transition Animation'),
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

	                ), //End params array()..

	            ),  // End of elemnt cx_testimonial

			) //end of  array 

		);  //end of kc_add_map....

	} //End if

} // end of cx_team_kc


