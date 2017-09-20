<?php


/*
    ======================================
        CODEXIN TESTIMONIAL SHORTCODE
    ======================================
*/
	
// Registering Testimonial Shortcode
function cx_testimonial_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'layout'			=> '',
			'designation'	 	=> '',
			'fade'			 	=> '',
			'arrow'				=> '',
			'dots'			 	=> '',
			'play'		 		=> '',
			'speed'		 		=> '',
			'testimonial_icon' 	=> '',
			'class'			 	=> '',
	), $atts));

	$result = '';

	ob_start(); 

	// Retrieving user define classes
	$classes = array( 'row' );
	(!empty($class)) ? $classes[] = $class : ''; 

   		if( ! empty( $layout ) ) :
   			if( $layout == 1 ) :

   				// Assigning a master css class and hooking into KC
				$master_class = apply_filters( 'kc-el-class', $atts );
				$master_class[] = 'cx-testimonial';

				?>

				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

						<!-- Wrapper for slides -->
						<div class="col-sm-10 col-sm-offset-1">
							<div class="cx-testimonial-1">
								<?php 
								//start new query..
								$args = array(
									'post_type'		 => 'testimonial',
									'order'			 => 'DESC',
									'orderby'		 => 'date',
									'posts_per_page' => -1,
									'post_status'	 => 'publish'
									);

								$data = new WP_Query( $args );
								$i = 0;
								if( $data->have_posts() ) :
																	//Start loop here...
									while( $data->have_posts() ) : $data->the_post();
										?>
										<div class="item">
											<div class="quote-wrapper clearfix">
												<div class="quote-author-thumb">
													<i class="fa <?php echo $testimonial_icon; ?>"></i>
												</div>
												<div class="quote-text">
													<p> "<?php printf( '%s', get_the_excerpt() ); ?>" </p>
													<p class="quote-author-name">
														<?php 
														$aut_name = rwmb_meta( 'reveal_author_name','type=text' );
														echo esc_html( $aut_name );
														?>
													</p>
												</div>
											</div>
										</div> <!-- end of item -->
									<?php 
									endwhile;
								endif; //End check-posts if()....
								wp_reset_postdata();
								?>	
							</div> <!-- end of cx-testimonial-1 -->
						</div> <!-- end of col -->

					</div><!--end of row-->
				</div>  <!-- end of quote -->
   			

		<?php 
			endif; //End layout - 1 ...

			if( $layout == 2 ) :

				// Assigning a master css class and hooking into KC
   				$master_class = apply_filters( 'kc-el-class', $atts );
	   			$master_class[] = 'cx-testimonial-2';

			?>
				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
						<?php 
						//start new query..
						$args = array(
							'post_type'		 => 'testimonial',
							'order'			 => 'DESC',
							'orderby'		 => 'date',
							'post_status'	 => 'publish',
							'posts_per_page' => 4,
							);

						$data = new WP_Query( $args );
						
						if( $data->have_posts() ) :
							$i = 0;
							while( $data->have_posts() ) : $data->the_post();

							// Retrieving Image alt tag
							$img_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();
							?>
						<div class="col-sm-6 quote-wrapper">
							<div class="media-wrapper">
								<div class="media-thumb">
									<img src="<?php if(has_post_thumbnail()): echo esc_url( the_post_thumbnail_url( 'square-one' ) ); else: echo '//placehold.it/220X220'; endif; ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
								</div>
								<div class="media-desc">
									<h3 class="media-title">
										<?php 
										$name = rwmb_meta( 'reveal_author_name', 'type=text' ); 
										echo esc_html( $name );
										?>
									</h3>

									<?php 
									$desig = rwmb_meta( 'reveal_author_desig', 'type=text' ); 
									$company = rwmb_meta( 'reveal_author_company', 'type=text' );  
									if(!empty($desig) && !empty($company)):?>
									<p class="media-designation"><?php echo esc_html( $desig ) .', '. esc_html( $company ); ?></p>
									<?php elseif(!empty($desig) && empty($compnay)): ?>
									<p class="media-designation"><?php echo esc_html( $desig ); ?></p>

									<?php elseif(empty($desig) && !empty($company)): ?>
									<p class="media-designation"><?php echo esc_html( $company ); ?></p>
									<?php endif; ?>


									<p class="media-texts"> <?php printf('%s', get_the_excerpt() ); ?> </p>
								</div>
							</div>
						</div> <!--end of quote-wrapper -->
						<?php $i++; 

						if($i%2 == 0): echo '<div class="clearfix"></div>'; endif;

						endwhile;
					endif;
					wp_reset_postdata(); ?>

					</div><!--end of row -->
				</div> <!-- end of testimonials -->

		<?php			
		endif; //End layout-2 

		if( $layout == 3 ) :

			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
   			$master_class[] = 'cx-testimonial';

			// Passing values to javascript
			$codeopt = '';
			(!empty( $speed )) ? $atp_speed = $speed : $atp_speed = '2000';
			(!empty( $arrow )) ? $slick_arrow = true : $slick_arrow = false;
			(!empty( $dots )) ? $en_dots = true : $en_dots = false;
			(!empty( $play )) ? $auto_play = true : $auto_play = false;
			$codeopt .= '
			<script type="text/javascript">
				var sh_arrow = "' . $slick_arrow . '";
				var sh_dot = "' . $en_dots . '";
				var aut_p = "' . $auto_play . '";
				var ap_sp = "' . $atp_speed . '";
			</script>';
			echo $codeopt;

   			?>

   			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
   				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

					<div class="cx-testimonial-3">
						<?php 
							//start new query..
						$args = array(
							'post_type'		 => 'testimonial',
							'order'			 => 'DESC',
							'orderby'		 => 'date',
							'post_status'	 => 'publish',
							'posts_per_page' => -1,
							);

						$data = new WP_Query( $args );
						if( $data->have_posts() ) :
							while( $data->have_posts() ) : $data->the_post();

								// Retrieving Image alt tag
								$img_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();
							?>
								<div class="col-sm-6">
									<div class="item">
										<div class="quote-meta-wrapper">
											<div class="quote-author-thumb">
												<img src="<?php echo esc_url( the_post_thumbnail_url( 'square-one' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
											</div>
											<div class="quote-author-meta">
												<i class="fa fa-quote-right"></i>
												<h3 class="quote-author-name">
													<?php 
													$name = rwmb_meta( 'reveal_author_name', 'type=text' ); 
													echo esc_html( $name );
													?>
												</h3>
												<?php 
												if( $designation ):
													$desig = rwmb_meta( 'reveal_author_desig', 'type=text' ); 
													$company = rwmb_meta( 'reveal_author_company', 'type=text' );  
													if(!empty($desig) && !empty($company)):?>
													<p class="author-designation"><?php echo esc_html( $desig ) .', '. esc_html( $company ); ?></p>
													<?php elseif(!empty($desig) && empty($compnay)): ?>
													<p class="author-designation"><?php echo esc_html( $desig ); ?></p>

													<?php elseif(empty($desig) && !empty($company)): ?>
													<p class="author-designation"><?php echo esc_html( $company ); ?></p>
													<?php 
													endif;
												endif; ?>
											</div>
										</div>
										<div class="quote-text">
											<p> <?php printf('%s', get_the_excerpt() ); ?> </p>
										</div>
									</div>
								</div>
							<?php 
							endwhile;
						endif;
						wp_reset_postdata(); ?>
					</div> <!-- end of client-comment-curosel -->
				</div> <!-- end of row -->
   			</div> <!-- end of cx-testimonial-3 -->
   			<div class="clearfix"></div>


	<?php endif; // End layout - 3 

		if( $layout == 4 ) : 
		 	// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-testimonial';

			// Passing values to javascript
			$codeopt = '';
			(!empty( $speed )) ? $atp_speed = $speed : $atp_speed = '2000';
			(!empty( $arrow )) ? $slick_arrow = true : $slick_arrow = false;
			(!empty( $dots )) ? $en_dots = true : $en_dots = false;
			(!empty( $play )) ? $auto_play = true : $auto_play = false;
			(!empty( $fade )) ? $fade_eff = true : $fade_eff = false;
			$codeopt .= '
			<script type="text/javascript">
				var s_arrow = "' . $slick_arrow . '";
				var s_dot = "' . $en_dots . '";
				var at_p = "' . $auto_play . '";
				var ap_spd = "' . $atp_speed . '";
				var fade_e = "' . $fade_eff . '";
			</script>';
			echo $codeopt;

		?>
			
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="col-sm-9 center-block">
						<div class="cx-testimonial-4">
						<?php 
							//start new query..
							$args = array(
								'post_type'		 => 'testimonial',
								'order'			 => 'DESC',
								'orderby'		 => 'date',
								'posts_per_page' => -1,
								'post_status'	 => 'publish',
								);

							$data = new WP_Query( $args );
							if( $data->have_posts() ) :
								while( $data->have_posts() ) : $data->the_post();

									// Retrieving Image alt tag
									$img_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();
								?>
									<div class="item">
										<div class="quote-text">
											<p> <?php printf('%s', get_the_excerpt() ); ?> </p>
										</div>
										<div class="quote-meta-wrapper center-block">
											<div class="quote-author-thumb">
												<img src="<?php echo esc_url( the_post_thumbnail_url( 'square-one' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
											</div>
											<div class="quote-author-meta">
												<h3 class="quote-author-name">
													<?php 
													$name = rwmb_meta( 'reveal_author_name', 'type=text' ); 
													echo esc_html( $name );
													?>
												</h3>
												<?php 
												if( $designation ):
													$desig = rwmb_meta( 'reveal_author_desig', 'type=text' ); 
													$company = rwmb_meta( 'reveal_author_company', 'type=text' );  
													if(!empty($desig) && !empty($company)):?>
													<p class="author-designation"><?php echo esc_html( $desig ) .', '. esc_html( $company ); ?></p>
													<?php elseif(!empty($desig) && empty($compnay)): ?>
													<p class="author-designation"><?php echo esc_html( $desig ); ?></p>

													<?php elseif(empty($desig) && !empty($company)): ?>
													<p class="author-designation"><?php echo esc_html( $company ); ?></p>
													<?php 
													endif;
												endif; ?>
											</div>
										</div>
									</div>
								<?php 
								endwhile;
							endif;
							wp_reset_postdata(); ?>	
						</div> <!-- end of cx-testimonial-4 -->
					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of section -->
			<div class="clearfix"></div>

		<?php endif; //End layout - 4 

		if( $layout == 5 ) : 
		 	// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-testimonial';

			// Passing values to javascript
			$codeopt = '';
			(!empty( $speed )) ? $atp_speed = $speed : $atp_speed = '2000';
			(!empty( $arrow )) ? $slick_arrow = true : $slick_arrow = false;
			(!empty( $dots )) ? $en_dots = true : $en_dots = false;
			(!empty( $play )) ? $auto_play = true : $auto_play = false;
			(!empty( $fade )) ? $fade_eff = true : $fade_eff = false;
			$codeopt .= '
			<script type="text/javascript">
				var s_arrow = "' . $slick_arrow . '";
				var s_dot = "' . $en_dots . '";
				var at_p = "' . $auto_play . '";
				var ap_spd = "' . $atp_speed . '";
				var fade_e = "' . $fade_eff . '";
			</script>';
			echo $codeopt;

		?>
			
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="col-sm-9 center-block">
						<div class="cx-testimonial-5">
						<?php 
							//start new query..
							$args = array(
								'post_type'		 => 'testimonial',
								'order'			 => 'DESC',
								'orderby'		 => 'date',
								'posts_per_page' => -1,
								'post_status'	 => 'publish',
								);

							$data = new WP_Query( $args );
							if( $data->have_posts() ) :
								while( $data->have_posts() ) : $data->the_post();

									// Retrieving Image alt tag
									$img_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();
								?>
									<div class="item">
										<div class="quote-text">
											<p> <?php printf('%s', get_the_excerpt() ); ?> </p>
										</div>
										<div class="quote-meta-wrapper center-block">
											<div class="quote-author-thumb">
												<img src="<?php echo esc_url( the_post_thumbnail_url( 'square-one' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
											</div>
											<div class="quote-author-meta">
												<h3 class="quote-author-name">
													<?php 
													$name = rwmb_meta( 'reveal_author_name', 'type=text' ); 
													echo esc_html( $name );
													?>
												</h3>
												<?php 
												if( $designation ):
													$desig = rwmb_meta( 'reveal_author_desig', 'type=text' ); 
													$company = rwmb_meta( 'reveal_author_company', 'type=text' );  
													if(!empty($desig) && !empty($company)):?>
													<p class="author-designation"><?php echo esc_html( $desig ) .', '. esc_html( $company ); ?></p>
													<?php elseif(!empty($desig) && empty($compnay)): ?>
													<p class="author-designation"><?php echo esc_html( $desig ); ?></p>

													<?php elseif(empty($desig) && !empty($company)): ?>
													<p class="author-designation"><?php echo esc_html( $company ); ?></p>
													<?php 
													endif;
												endif; ?>
											</div>
										</div>
									</div>
								<?php 
								endwhile;
							endif;
							wp_reset_postdata(); ?>	
						</div> <!-- end of cx-testimonial-4 -->
					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of section -->
			<div class="clearfix"></div>

		<?php endif; //End layout - 4 ?>

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
  	        				'slick-cx-main-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js',
  	        				'slick-cx-user-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_testimonial.js',
  	        				),

  	        			'styles'	=> array(
  	        				'slick-cx-main-style'	=> CODEXIN_CORE_ASSET_DIR . '/css/slick.css',
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
									'4'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/layout-4.png',
								),
								'value'	=> '1'
							),
	                		
							array(
								'name' 			=> 'testimonial_icon',
								'label' 		=> __( 'Testimonial Icon', 'codexin' ),
								'type' 			=> 'icon_picker',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '1',
								),
								'description'	=> esc_html__( 'Select Your Icon Here', 'codexin' ),
							),

							array(
								'name' 			=> 'designation',
								'label' 		=> __( 'Display Designation? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3,4',
								),
								'description'	=> esc_html__( 'Enable to display designation and company name.', 'codexin' ),
							),

							array(
								'name' 			=> 'fade',
								'label' 		=> __( 'Enable Fade Animation? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '4',
								),
								'description'	=> esc_html__( 'Choose to Enable Fade Animation instead of default slide animation.', 'codexin' ),
							),

							array(
								'name' 			=> 'arrow',
								'label' 		=> __( 'Enable Navigation Arrow? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3,4',
								),
								'description'	=> esc_html__( 'Choose to Enable/Disable Navigation Arrows.', 'codexin' ),
							),

							array(
								'name' 			=> 'dots',
								'label' 		=> __( 'Enable Dot Pagination? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3,4',
								),
								'description'	=> esc_html__( 'Choose to Enable/Disable Dot Pagination.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'play',
								'label' 		=> __( 'Enable Autoplay? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3,4',
								),
								'description'	=> esc_html__( 'Choose to Enable Autoplay.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'speed',
								'label' 		=> __( 'Enter Autoplay Duration', 'codexin' ),
								'type' 			=> 'text',
								'relation'		=> array(
									'parent'	=> 'play',
									'show_when' => 'yes',
								),
								'description'	=> esc_html__( 'Choose the duration of autoplay speed in milisecond. For example: 4000', 'codexin' ),
								'value'			=> '2000'
							),

							array(
								'name' 			=> 'class',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
							),

	                	), //End general array..

	                	//Styling Params
						'styling' => array(
							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' 		=> array(
									array(
										"screens" => "any,1199,991,767,479",

										'Name'	=> array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
										),

										'Icon'	=> array(
											array( 'property' => 'color', 'label' => 'Icon Color', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'border', 'label' => 'Icon Box Border', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'border-radius', 'label' => 'Icon Box Border Radius', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'display', 'label' => 'Display', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'font-size', 'label' => 'Font Size', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'text-align', 'label' => 'Text Align', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'line-height', 'label' => 'Line Height', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'padding', 'label' => 'Padding', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'margin', 'label' => 'Margin', 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
										),

										'Designation' => array(
											array('property' => 'color', 'label' => esc_html__( 'Text Color' ), 'selector' => '.media-designation, .author-designation'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family' ), 'selector' => '.media-designation, .author-designation'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size' ), 'selector' => '.media-designation, .author-designation'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height' ), 'selector' => '.media-designation, .author-designation'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align' ), 'selector' => '.media-designation, .author-designation'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin' ), 'selector' => '.media-designation, .author-designation'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding' ), 'selector' => '.media-designation, .author-designation'),
										),

										'Description' => array(
											array('property' => 'color', 'label' => esc_html__( 'Text Color' ), 'selector' => '.quote-text p, .media-texts'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family' ), 'selector' => '.quote-text p, .media-text'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size' ), 'selector' => '.quote-text p, .media-texts'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height' ), 'selector' => '.quote-text p, .media-texts'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align' ), 'selector' => '.quote-text p, .media-texts'),
											array('property' => 'font-style', 'label' => esc_html__( 'Font Style' ), 'selector' => '.quote-text p, .media-texts'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin' ), 'selector' => '.quote-text p, .media-texts'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding' ), 'selector' => '.quote-text p, .media-texts'),
										),

										'Image' => array(
											
											array('property' => 'border', 'label' => 'Image Box Border', 'selector' => '.media-thumb img, .quote-author-thumb'),
											array('property' => 'border-radius', 'label' => 'Image Box Border Radius', 'selector' => '.media-thumb img, .quote-author-thumb'),
											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.media-thumb img, .quote-author-thumb'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.media-thumb img, .quote-author-thumb'),
										),

										'Nav' => array(
											array('property' => 'color', 'label' => 'Color of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'background', 'label' => 'Background of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'font-size', 'label' => 'Arrow Font Size of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'margin', 'label' => 'Margin of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'padding', 'label' => 'padding of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'color', 'label' => 'Color of Dot Nav', 'selector' => '.slick-dots li button:before'),
											array('property' => 'color', 'label' => 'Color of Dot Nav on Active State', 'selector' => '.slick-dots li.slick-active button:before'),
											array('property' => 'color', 'label' => 'Color of Dot Nav on Hover', 'selector' => '.slick-dots li button:hover:before'),
											array('property' => 'margin', 'label' => 'Margin of Dot Nav', 'selector' => '.slick-dots li'),
											array('property' => 'padding', 'label' => 'padding of Dot Nav', 'selector' => '.slick-dots li')
										),

										'Divider' => array(
											array('property' => 'background', 'label' => 'Color', 'selector' => '.quote-author-name::before, .media-texts::before'),
											array('property' => 'width', 'label' => 'Width', 'selector' => '.quote-author-name::before, .media-texts::before'),
											array('property' => 'height', 'label' => 'Height', 'selector' => '.quote-author-name::before, .media-texts::before'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.quote-author-name::before, .media-texts::before'),
											array('property' => 'padding', 'label' => 'padding', 'selector' => '.quote-author-name::before, .media-texts::before')
										),

										'Slider Wrapper' => array(
											array('property' => 'background', 'label' => 'Color', 'selector' => '.item'),
											array('property' => 'border', 'label' => 'Border', 'selector' => '.item'),
											array('property' => 'border-radius', 'label' => 'Border Radius', 'selector' => '.item'),
											array('property' => 'height', 'label' => 'Height', 'selector' => '.item'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.item'),
											array('property' => 'padding', 'label' => 'padding', 'selector' => '.item')
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

} // end of cx_testimonial


