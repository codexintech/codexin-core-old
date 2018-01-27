<?php

/**
 * Shortcode -  Mini Testimonial
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );
	
// Registering Mini Testimonial Shortcode
function cx_testimonial_mini_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'layout'			=> '',
		'designation'	 	=> '',
		'fade'			 	=> '',
		'arrow'				=> '',
		'adaptive_height'	=> '',
		'dots'			 	=> '',
		'play'		 		=> '',
		'speed'		 		=> '',
		'testimonial_icon' 	=> '',
		'class'			 	=> '',
	), $atts));

	$result = '';

	// Retrieving user define classes
	$classes = array( 'row' );
	( ! empty( $class ) ) ? $classes[] = $class : ''; 

	// Buiding up args for query
	$args = array(
		'post_type'		 => 'testimonial',
		'order'			 => 'DESC',
		'orderby'		 => 'date',
		'posts_per_page' => -1,
		'post_status'	 => 'publish'
	);

	ob_start(); 

	if( ! empty( $layout ) ) {
		if( $layout == 1 ) {

			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-testimonial';

			// Building variables to pass values to javascript
			$slick_arrow1 	= ( $arrow ) ? true : 0;
			$fade1 			= ( $fade ) ? true : 0;
			$a_height 		= ( $adaptive_height ) ? true : 0;

			// Registering and enqueueing some scripts and passing the values to Javascript
			wp_register_script( 'cx-testimonial-script-one', CODEXIN_CORE_JS_DIR . '/cx-testimonial-one.js', array ( 'jquery' ), 1.0, true );
		    wp_localize_script( 'cx-testimonial-script-one', 'cx_testimonial_one_params', array(
		        'sh_arrow1' => $slick_arrow1,
		        'fd1' 		=> $fade1,
		        'ad_h1' 	=> $a_height,
		    ) ); 
		    wp_enqueue_script( 'cx-testimonial-script-one' );

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="cx-testimonial-1">
							<?php 

							$data = new WP_Query( $args );
							$i = 0;
							if( $data->have_posts() ) {
								//Start loop here...
								while( $data->have_posts() ) {
									$data->the_post();
									$aut_name = rwmb_meta( 'reveal_author_name' );
									?>
									<div class="item">
										<div class="quote-wrapper clearfix">
											<div class="quote-author-thumb cx-color-1">
												<i class="<?php echo esc_attr( $testimonial_icon ); ?>"></i>
											</div>
											<div class="quote-text">
												<p> "<?php echo esc_html( get_the_excerpt() ); ?>" </p>
												<p class="quote-author-name sec-font cx-bg-overlay"><?php echo esc_html( $aut_name ); ?></p>
											</div>
										</div>
									</div> <!-- end of item -->
								<?php 
								}
							} //End check-posts if()....
							wp_reset_postdata();
							?>	
						</div> <!-- end of cx-testimonial-1 -->
					</div> <!-- end of col -->
				</div><!--end of row-->
			</div>  <!-- end of quote -->			

		<?php 
		} //End layout - 1

		if( $layout == 2 ) {

			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-testimonial-2';

			?>
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php 
					//start new query..
					$args['posts_per_page'] = 4;

					$data = new WP_Query( $args );
					
					if( $data->have_posts() ) {
						$i = 0;
						while( $data->have_posts() ) {
							$data->the_post();

							// Retrieving Image alt tag
							$img_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

							$name 	 = rwmb_meta( 'reveal_author_name' );
							$desig 	 = rwmb_meta( 'reveal_author_desig' ); 
							$company = rwmb_meta( 'reveal_author_company' );  

							$thumbnail_size = 'codexin-core-square-one';
							if( function_exists( 'codexin_attachment_metas_extended' ) ) {
								$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'testimonial', $thumbnail_size )['src'];
							} else {
								$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/220X220';
							}
							?>
							<div class="col-sm-6 quote-wrapper">
								<div class="media-wrapper">
									<div class="media-thumb">
										<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
									</div>
									<div class="media-desc">
										<h3 class="media-title"><?php echo esc_html( $name ); ?></h3>
										<?php 
										if( ! empty( $desig ) && ! empty( $company ) ) { ?>
											<p class="media-designation"><?php echo esc_html( $desig ) .', '. sprintf( '%s', $company ); ?></p>
										<?php } elseif( ! empty( $desig ) && empty( $compnay ) ) { ?>
											<p class="media-designation"><?php echo esc_html( $desig ); ?></p>
										<?php } elseif( empty( $desig ) && ! empty( $company ) ) { ?>
											<p class="media-designation"><?php echo sprintf( '%s', $company ); ?></p>
										<?php }
										?>
										<p class="media-texts cx-bg-overlay"> <?php echo esc_html( get_the_excerpt() ); ?> </p>
									</div>
								</div>
							</div> <!--end of quote-wrapper -->
							<?php $i++; 
							echo ( $i % 2 == 0 ) ? '<div class="clearfix"></div>' : '';
						}
					}
					wp_reset_postdata();
					?>
				</div><!--end of row -->
			</div> <!-- end of testimonials -->
		<?php			
		} //End layout-2 

		if( $layout == 3 ) {

			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-testimonial';

			// Building variables to pass values to javascript
			$atp_speed 		= ( ! empty( $speed ) ) ? $speed : '2000';
			$slick_arrow 	= ( $arrow ) ? true : 0;
			$en_dots		= ( $dots ) ? true : 0;
			$auto_play 		= ( $play ) ? true : 0;

			// Registering and enqueueing some scripts and passing the values to Javascript
			wp_enqueue_script( 'slick-script', CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js', array ( 'jquery' ), 1.7, true );
			wp_register_script( 'cx-testimonial-script-two', CODEXIN_CORE_JS_DIR . '/cx-testimonial-two.js', array ( 'jquery', 'slick-script' ), 1.0, true );
		    wp_localize_script( 'cx-testimonial-script-two', 'cx_testimonial_two_params', array(
		        'sh_arrow'	=> $slick_arrow,
		        'sh_dot'	=> $en_dots,
		        'aut_p' 	=> $auto_play,
		        'ap_sp' 	=> $atp_speed,
		    ) ); 
		    wp_enqueue_script( 'cx-testimonial-script-two' );

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="cx-testimonial-3">
						<?php 

						$data = new WP_Query( $args );

						if( $data->have_posts() ) {
							while( $data->have_posts() ) {
								$data->the_post();

								// Retrieving Image alt tag
								$img_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();
								$name 	 = rwmb_meta( 'reveal_author_name' );
								$desig   = rwmb_meta( 'reveal_author_desig' );
								$company = rwmb_meta( 'reveal_author_company' );

								$thumbnail_size = 'codexin-core-square-one';
								if( function_exists( 'codexin_attachment_metas_extended' ) ) {
									$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'testimonial', $thumbnail_size )['src'];
								} else {
									$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/220X220';
								}
								?>
								<div class="col-sm-6">
									<div class="item">
										<div class="quote-meta-wrapper">
											<div class="quote-author-thumb">
												<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
											</div>
											<div class="quote-author-meta">
												<i class="fa fa-quote-right cx-color-1"></i>
												<h3 class="quote-author-name"><?php echo esc_html( $name ); ?></h3>
												<?php 
												if( $designation ) {
													if( ! empty( $desig ) && ! empty( $company ) ) { ?>
														<p class="author-designation"><?php echo esc_html( $desig ) .', '. sprintf( '%s', $company ); ?></p>
													<?php } elseif( ! empty( $desig ) && empty( $compnay ) ) { ?>
														<p class="author-designation"><?php echo esc_html( $desig ); ?></p>
													<?php } elseif( empty( $desig ) && ! empty( $company ) ) { ?>
														<p class="author-designation"><?php echo sprintf( '%s', $company ); ?></p>
													<?php 
													}
												}
												?>
											</div>
										</div>
										<div class="quote-text">
											<p> <?php echo esc_html( get_the_excerpt() ); ?> </p>
										</div>
									</div>
								</div>
							<?php 
							}
						}
						wp_reset_postdata(); ?>
					</div> <!-- end of client-comment-curosel -->
				</div> <!-- end of row -->
			</div> <!-- end of cx-testimonial-3 -->
			<div class="clearfix"></div>

		<?php } // End layout - 3 

		if( $layout == 4 ) {
		 	// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-testimonial';

			// Building variables to pass values to javascript
			$atp_speed 		= ( ! empty( $speed ) ) ? $speed : '2000';
			$slick_arrow 	= ( $arrow ) ? true : 0;
			$en_dots		= ( $dots ) ? true : 0;
			$auto_play 		= ( $play ) ? true : 0;
			$fade_eff 		= ( $fade ) ? true : 0;
			$ad_h 			= ( $adaptive_height ) ? true : 0;

			// Registering and enqueueing some scripts and passing the values to Javascript
			wp_enqueue_script( 'slick-script', CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js', array ( 'jquery' ), 1.7, true );
			wp_register_script( 'cx-testimonial-script-three', CODEXIN_CORE_JS_DIR . '/cx-testimonial-three.js', array ( 'jquery', 'slick-script' ), 1.0, true );
		    wp_localize_script( 'cx-testimonial-script-three', 'cx_testimonial_three_params', array(
		        's_arrow'	=> $slick_arrow,
		        's_dot'		=> $en_dots,
		        'at_p' 		=> $auto_play,
		        'ap_spd' 	=> $atp_speed,
		        'fade_e' 	=> $fade_eff,
		        'ad_h4' 	=> $ad_h,
		    ) ); 
		    wp_enqueue_script( 'cx-testimonial-script-three' );

		?>
	
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="col-sm-9 center-block">
						<div class="cx-testimonial-4">
							<?php 

							$data = new WP_Query( $args );
							if( $data->have_posts() ) {
								while( $data->have_posts() ) {
									$data->the_post();

									// Retrieving Image alt tag
									$img_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();
									$name 	 = rwmb_meta( 'reveal_author_name' ); 
									$desig 	 = rwmb_meta( 'reveal_author_desig' );
									$company = rwmb_meta( 'reveal_author_company' );

									$thumbnail_size = 'codexin-core-square-one';
									if( function_exists( 'codexin_attachment_metas_extended' ) ) {
										$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'testimonial', $thumbnail_size )['src'];
									} else {
										$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/220X220';
									}
								?>
									<div class="item">
										<div class="quote-text">
											<p> <?php echo esc_html( get_the_excerpt() ); ?> </p>
										</div>
										<div class="quote-meta-wrapper center-block">
											<div class="quote-author-thumb">
												<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
											</div>
											<div class="quote-author-meta">
												<h3 class="quote-author-name"><?php echo esc_html( $name ); ?></h3>
												<?php 
												if( $designation ) {
													if( ! empty( $desig ) && ! empty( $company ) ) { ?>
														<p class="author-designation"><?php echo esc_html( $desig ) .', '. sprintf( '%s', $company ); ?></p>
													<?php } elseif( ! empty( $desig ) && empty( $compnay ) ) { ?>
														<p class="author-designation"><?php echo esc_html( $desig ); ?></p>
													<?php } elseif( empty( $desig ) && ! empty( $company ) ) { ?>
														<p class="author-designation"><?php echo sprintf( '%s', $company ); ?></p>
													<?php 
													}
												}
												?>
											</div>
										</div>
									</div>
								<?php 
								}
							}
							wp_reset_postdata(); ?>	
						</div> <!-- end of cx-testimonial-4 -->
					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of section -->
			<div class="clearfix"></div>

		<?php } //End layout - 4 

		if( $layout == 5 ) {
		 	// Assigning a master css class and hooking into KC
			$master_class 	= apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-testimonial';

			$count_posts 	= wp_count_posts('testimonial')->publish;

			// Building variables to pass values to javascript
			$atp_speed5		= ( ! empty( $speed ) ) ? $speed : '2000';
			$slick_arrow5 	= ( $arrow ) ? true : 0;
			$en_dots5		= ( $dots ) ? true : 0;
			$auto_play5		= ( $play ) ? true : 0;
			$fade_eff5 		= ( $fade ) ? true : 0;
			$ad_he5			= ( $adaptive_height ) ? true : 0;

			// Registering and enqueueing some scripts and passing the values to Javascript
			wp_enqueue_script( 'slick-script', CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js', array ( 'jquery' ), 1.7, true );
			wp_register_script( 'cx-testimonial-script-four', CODEXIN_CORE_JS_DIR . '/cx-testimonial-four.js', array ( 'jquery', 'slick-script' ), 1.0, true );
		    wp_localize_script( 'cx-testimonial-script-four', 'cx_testimonial_four_params', array(
		        's_arrow5'	=> $slick_arrow5,
		        's_dot5'	=> $en_dots5,
		        'at_p5'		=> $auto_play5,
		        'ap_spd5' 	=> $atp_speed5,
		        'fade_e5' 	=> $fade_eff5,
		        'ad_h5' 	=> $ad_he5,
		        'count' 	=> $count_posts,
		    ) ); 
		    wp_enqueue_script( 'cx-testimonial-script-four' );

		?>
	
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="col-sm-12 text-center">
						<div class="cx-testimonial-5">
							<div class="row">
								<div class="col-md-6 col-md-push-3">
									<div class="slick-slider-nav">
										<?php 

										$data = new WP_Query( $args );
										if( $data->have_posts() ) {
											while( $data->have_posts() ) {
												$data->the_post();

												// Retrieving Image alt tag
												$img_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

												$thumbnail_size = 'codexin-core-square-one';
												if( function_exists( 'codexin_attachment_metas_extended' ) ) {
													$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'testimonial', $thumbnail_size )['src'];
												} else {
													$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/220X220';
												}
											?>

												<div class="item">
													<div class="quote-author-media">
														<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
													</div>
												</div>

											<?php if( ( $data->current_post + 1 ) == ( $data->post_count ) ) { ?>								
									</div> <!-- end of slick-slider-nav -->
								</div> <!-- end of col -->
							</div> <!-- end of row -->
							<div class="testimonial-content-desc slick-slider-content">
								<?php 
								$new_data = new WP_Query( $args );
								if( $new_data->have_posts() ) {
									while( $new_data->have_posts() ) {
										$new_data->the_post(); 

										$name 	 = rwmb_meta( 'reveal_author_name' );
										$desig 	 = rwmb_meta( 'reveal_author_desig' );
										$company = rwmb_meta( 'reveal_author_company' );

										?>
										<div class="item">
											<div class="quote-text">
												<p> <?php echo esc_html( get_the_excerpt() ); ?> </p>
											</div>
											<div class="quote-author-meta">
												<h3 class="quote-author-name"><?php echo esc_html( $name ); ?></h3>
												<?php 
												if( $designation ) {
													if( ! empty( $desig ) && ! empty( $company ) ) { ?>
														<p class="author-designation"><?php echo esc_html( $desig ) .', '. sprintf( '%s', $company ); ?></p>
													<?php } elseif( ! empty( $desig ) && empty( $compnay ) ) { ?>
														<p class="author-designation"><?php echo esc_html( $desig ); ?></p>
													<?php } elseif( empty( $desig ) && ! empty( $company ) ) { ?>
														<p class="author-designation"><?php echo sprintf( '%s', $company ); ?></p>
													<?php 
													}
												}
												?>
											</div>
										</div>
									<?php 
										}
									}
									wp_reset_postdata();
									}
								}
							}
							wp_reset_postdata(); ?>	
							</div> <!-- end of slick-slider-content -->
						</div> <!-- end of cx-testimonial-5 -->							
					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of cx-testimonial -->
			<div class="clearfix"></div>

		<?php } //End layout - 5 ?>

	<?php
	} // end of layout check
	$result .= ob_get_clean();
	return $result;

} //End cx_testimonial_mini


// Integrating Shortcode with King Composer
function cx_testimonial_mini_kc() {

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_testimonial_mini' => array(
					'name' 			=> esc_html__( 'Codexin Mini Testimonial', 'codexin' ),
					'description' 	=> esc_html__( 'Codexin Mini Testimonial', 'codexin' ),
					'icon' 			=> 'et-hazardous',
					'category' 		=> 'Codexin',

					'params' => array(
						'general' => array(
							array(
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select Testimonial Template', 'codexin' ),
								'name'			=> 'layout',
								'admin_label'	=> true,
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/testimonial-1.jpg',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/testimonial-2.jpg',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/testimonial-3.jpg',
									'4'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/testimonial-4.jpg',
									'5'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/testimonial/testimonial-5.jpg',
								),
								'value'	=> '1'
							),
	                		
							array(
								'name' 			=> 'testimonial_icon',
								'label' 		=> esc_html__( 'Testimonial Icon', 'codexin' ),
								'type' 			=> 'icon_picker',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '1',
								),
								'description'	=> esc_html__( 'Select Your Icon Here', 'codexin' ),
							),

							array(
								'name' 			=> 'designation',
								'label' 		=> esc_html__( 'Display Designation?', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3,4,5',
								),
								'description'	=> esc_html__( 'Enable to display designation and company name.', 'codexin' ),
							),

							array(
								'name' 			=> 'fade',
								'label' 		=> esc_html__( 'Enable Fade Animation? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '1,4,5',
								),
								'description'	=> esc_html__( 'Choose to Enable Fade Animation instead of default slide animation.', 'codexin' ),
							),

							array(
								'name' 			=> 'arrow',
								'label' 		=> esc_html__( 'Enable Navigation Arrow? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'hide_when' => '2',
								),
								'description'	=> esc_html__( 'Choose to Enable/Disable Navigation Arrows.', 'codexin' ),
							),

							array(
								'name' 			=> 'dots',
								'label' 		=> esc_html__( 'Enable Dot Pagination? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3,4,5',
								),
								'description'	=> esc_html__( 'Choose to Enable/Disable Dot Pagination.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'adaptive_height',
								'label' 		=> esc_html__( 'Enable Adaptive height? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '1,4,5',
								),
								'description'	=> esc_html__( 'Choose to Enable Adaptive Height instead of Fixed Height.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'play',
								'label' 		=> esc_html__( 'Enable Autoplay? ', 'codexin' ),
								'type' 			=> 'toggle',
								'relation'		=> array(
									'parent'	=> 'layout',
									'show_when' => '3,4,5',
								),
								'description'	=> esc_html__( 'Choose to Enable Autoplay.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'speed',
								'label' 		=> esc_html__( 'Enter Autoplay Duration', 'codexin' ),
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
								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
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

										esc_html__( 'Name', 'codexin' )	=> array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.client-name .title-3, .quote-author-name, .media-title' ),
										),

										esc_html__( 'Icon', 'codexin' )	=> array(
											array( 'property' => 'color', 'label' => esc_html__( 'Icon Color', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i, .slick-slider-nav .item.slick-current .cx-overlay::before' ),
											array( 'property' => 'border', 'label' => esc_html__( 'Icon Box Border', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Icon Box Border Radius', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'display', 'label' => esc_html__( 'Display', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i, .slick-slider-nav .item.slick-current .cx-overlay::before' ),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.quote-author-thumb i, .quote-author-meta i' ),
										),

										esc_html__( 'Designation', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Text Color', 'codexin' ), 'selector' => '.media-designation, .author-designation'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin' ), 'selector' => '.media-designation, .author-designation'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.media-designation, .author-designation'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.media-designation, .author-designation'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin' ), 'selector' => '.media-designation, .author-designation'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.media-designation, .author-designation'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.media-designation, .author-designation'),
										),

										esc_html__( 'Description', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Text Color', 'codexin' ), 'selector' => '.quote-text p, .media-texts'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin' ), 'selector' => '.quote-text p, .media-text'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.quote-text p, .media-texts'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.quote-text p, .media-texts'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin' ), 'selector' => '.quote-text p, .media-texts'),
											array( 'property' => 'font-style', 'label' => esc_html__( 'Font Style', 'codexin' ), 'selector' => '.quote-text p, .media-texts'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.quote-text p, .media-texts'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.quote-text p, .media-texts'),
										),

										esc_html__( 'Image', 'codexin' ) => array(
											
											array( 'property' => 'border', 'label' => esc_html__( 'Image Box Border', 'codexin' ), 'selector' => '.media-thumb img, .quote-author-thumb, .quote-author-media img'),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Image Box Border Radius', 'codexin' ), 'selector' => '.media-thumb img, .quote-author-thumb, .quote-author-media img'),
											array( 'property' => 'background-color', 'label' => esc_html__( 'Active Image Overlay Color for Layout-5', 'codexin' ), 'selector' => '.slick-slider-nav .item.slick-current .cx-overlay'),
											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Active Image Box Shadow for Layout-5', 'codexin' ), 'selector' => '.slick-slider-nav .item.slick-current .quote-author-media img'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.media-thumb img, .quote-author-thumb, .quote-author-media img'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.media-thumb img, .quote-author-thumb, .quote-author-media img'),
										),

										esc_html__( 'Nav', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color of Nav Arrow', 'codexin' ), 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'background', 'label' => esc_html__( 'Background of Nav Arrow', 'codexin' ), 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Arrow Font Size of Nav Arrow', 'codexin' ), 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin of Nav Arrow', 'codexin' ), 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'padding', 'label' => esc_html__( 'padding of Nav Arrow', 'codexin' ), 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'color', 'label' => esc_html__( 'Color of Dot Nav', 'codexin' ), 'selector' => '.slick-dots li button:before'),
											array( 'property' => 'color', 'label' => esc_html__( 'Color of Dot Nav on Active State', 'codexin' ), 'selector' => '.slick-dots li.slick-active button:before'),
											array( 'property' => 'color', 'label' => esc_html__( 'Color of Dot Nav on Hover', 'codexin' ), 'selector' => '.slick-dots li button:hover:before'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin of Dot Nav', 'codexin' ), 'selector' => '.slick-dots li'),
											array( 'property' => 'padding', 'label' => esc_html__( 'padding of Dot Nav', 'codexin' ), 'selector' => '.slick-dots li')
										),

										esc_html__( 'Divider', 'codexin' ) => array(
											array( 'property' => 'background', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.quote-author-name::before, .media-texts::before'),
											array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin' ), 'selector' => '.quote-author-name::before, .media-texts::before'),
											array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin' ), 'selector' => '.quote-author-name::before, .media-texts::before'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.quote-author-name::before, .media-texts::before'),
											array( 'property' => 'padding', 'label' => esc_html__( 'padding', 'codexin' ), 'selector' => '.quote-author-name::before, .media-texts::before')
										),

										esc_html__( 'Slider Wrapper', 'codexin' ) => array(
											array( 'property' => 'background', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.item'),
											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin' ), 'selector' => '.item'),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin' ), 'selector' => '.item'),
											array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin' ), 'selector' => '.item'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.item'),
											array( 'property' => 'padding', 'label' => esc_html__( 'padding', 'codexin' ), 'selector' => '.item')
										),

										esc_html__( 'Box', 'codexin' )	=> array(
											array( 'property' => 'background'),
											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin' ) ),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin' ) ),
											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin' ) ),
											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow on Hover', 'codexin' ) ),
											array( 'property' => 'transition', 'label' => esc_html__( 'Hover Transition Animation', 'codexin' ) ),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ) ),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ) ),
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
			) //end of array
		);  //end of kc_add_map....
	} //End if
} // end of cx_testimonial_mini_kc


