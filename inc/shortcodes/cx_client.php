<?php

/**
 * Shortcode -  Clients
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Client Shortcode
function cx_client_shortcode( $atts, $content = null ) {
   	extract( shortcode_atts( array(
   		'layout'			=> '',
   		'number_of_clients'	=> '',
   		'no_of_clients'		=> '',
   		'number_of_slides'	=> '',
   		'continous_p'	    => '',
   		'link_client'	    => '',
   		'class'	    	    => '',
   		'arrow'         	=> '',
   		'dots'         	  	=> '',
   		'play'         	    => '',
   		'speed'             => '',
   		'pl_speed'     	  	=> ''
   	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-clients-wrapper';

	ob_start();

	// Building variables to pass values to javascript
	$num_slide 		= ( ! empty( $number_of_slides ) ) ? $number_of_slides : '6';
	$cont_p 		= ( $continous_p ) ? true : 0;
	$slick_arrow 	= ( $arrow ) ? true : 0;
	$en_dots 		= ( $dots ) ? true : 0;
	$auto_play 		= ( $play ) ? true : 0;
	$atp_speed 		= ( ! empty( $speed ) ) ? $speed : '2000';
	$con_speed 		= ( ! empty( $pl_speed ) ) ? $pl_speed : '2500';

	if( ! empty( $layout ) ) {
		if( $layout == 1 ) {

			// Registering and enqueueing some scripts and passing the values to Javascript
			wp_enqueue_script( 'slick-script', CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js', array ( 'jquery' ), 1.7, true );
			wp_register_script( 'slick-shortcode-script', CODEXIN_CORE_JS_DIR . '/cx-client-carousel.js', array ( 'jquery', 'slick-script' ), 1.0, true );
		    wp_localize_script( 'slick-shortcode-script', 'cx_client_params', array(
		        'logo_slide' 	=> $num_slide,
		        'show_arrow' 	=> $slick_arrow,
		        'show_dot' 		=> $en_dots,
		        'aut_play' 		=> $auto_play,
		        'ap_speed' 		=> $atp_speed,
		        'con_play' 		=> $cont_p,
		        'play_speed' 	=> $con_speed,
		    ) ); 
		    wp_enqueue_script( 'slick-shortcode-script' );

			// Retrieving user define classes
			$classes = array( 'cx-client-carousel-1' );
			( ! empty( $class ) ) ? $classes[] = $class : '';
			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php 
					// start query..
					$args = array(
						'post_type'			=> 'clients',
						'order'				=> 'DESC',
						'posts_per_page'	=> $number_of_clients
						);
					$data = new WP_Query( $args );

					if( $data->have_posts() ) {
						
						while( $data->have_posts() ) {
							$data->the_post();							
							$client_url = rwmb_meta( 'codexin_clients_surl' );
							$c_url 		= ! empty( $client_url ) ? esc_url( $client_url ) : '#';

							// Retrieving Image alt tag
							$image_alt 	= ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

							echo '<div class="item">';
								echo ( $link_client ) ? '<a href="'. $c_url .'" target="_blank">' : '';
									echo '<img src="'. esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) . '" alt="'. esc_attr( $image_alt ) .'">';
								echo ( $link_client ) ? '</a>' : '';
							echo '</div>';
						} // end of loop have_posts()
					} //End check-posts if()
					wp_reset_postdata();
					?>
				</div> <!-- end of cx-client-carousel-1 -->
			</div> <!-- end of cx-clients-wrapper -->
			<div class="clearfix"></div>

			<?php

		} elseif( $layout == 2 ) {

			// Retrieving user define classes
			$classes = array( 'cx-client-carousel-2' );
			( ! empty( $class ) ) ? $classes[] = $class : '';

			$grid_columns = 12 / ( $no_of_clients / 2 );

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="clients-first-row">
						<?php 
						// start query..
						$args = array(
							'post_type'			=> 'clients',
							'order'				=> 'DESC',
							'posts_per_page'	=> $no_of_clients
							);
						$data = new WP_Query( $args );

						if( $data->have_posts() ) {
							$i = 0;

							while( $data->have_posts() ) {

								$data->the_post();

								$i++;
								$client_url = rwmb_meta( 'codexin_clients_surl' );
								$c_url 		= ! empty( $client_url ) ? esc_url( $client_url ) : '#';

								// Retrieving Image alt tag
								$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

								echo '<div class="col-lg-'. esc_attr( $grid_columns ) .' col-sm-6 client-image-single cx-border-1">';
									echo ( $link_client ) ? '<a href="'. $c_url .'" target="_blank">' : '';
										echo '<img src="'. esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) . '" alt="'. esc_attr( $image_alt ) .'">';
									echo ( $link_client ) ? '</a>' : '';
								echo '</div>';

								echo ( $i == ( $no_of_clients / 2 ) ) ? '</div><div class="clients-second-row">' :'';

							} // end of loop have_posts()
						} //End check-posts if()
						wp_reset_postdata();
						?>
					</div>
				</div> <!-- end of cx-client-carousel-2 -->
			</div> <!-- end of cx-clients-wrapper -->

			<?php

		} // end of layout-2
	} // end of layout check
	$result .= ob_get_clean();
	return $result;

} //End cx_client


// Integrating Shortcode with King Composer
function cx_client_kc() {

 	if( function_exists( 'kc_add_map' ) ) {
 		kc_add_map(
 			array(
 				'cx_client' 		=> array(
 					'name' 			=> esc_html__( 'Codexin Clients', 'codexin' ),
 					'description' 	=> esc_html__( 'Clients Section', 'codexin' ),
 					'icon' 			=> 'et-hazardous',
 					'category' 		=> 'Codexin',
	                //Only load assets when using this element
 					'assets' => array(
 					// 	'scripts' => array(
 					// 		'slick-script' => CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js',
						// ),

		      			// 'styles'	=> array(
		      			// 	'slick-stylesheet'	=> CODEXIN_CORE_ASSET_DIR . '/css/slick.css',
	      				// ),

	                ), //End assets
 					'params' => array(
 						// general params
 						'general'	=> array(
							array(
								'name'			=> 'layout',
								'lable'			=> esc_html__( 'Select Testimonial Template', 'codexin' ),
								'type'			=> 'radio_image',
								'options'		=> array(
									'1'			=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/clients/clients-1.jpg',
									'2'			=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/clients/clients-2.jpg',
								),
								'value'			=> '1',
								'admin_label'	=> true,
							),

	    					array(
	    						'name'			=> 'number_of_clients',
	    						'label' 		=> esc_html__( 'Number of Clients', 'codexin' ),
	    						'type'			=> 'dropdown',
	    						'description' 	=> esc_html__( 'Choose the number of client logo you want to show', 'codexin' ),
	    						'options'		=> array(
	    							'3'			=> esc_html( '3', 'codexin' ),
	    							'6'			=> esc_html( '6', 'codexin' ),
	    							'9'			=> esc_html( '9', 'codexin' ),
	    							'-1'		=> esc_html( 'All', 'codexin' ),
	    						),
								'relation' 		=> array(
									'parent'	=> 'layout',
									'show_when' => '1',
								),
	    						'value'			=> '-1',
	    						'admin_label'	=> true
	    					),

	    					array(
	    						'name'			=> 'no_of_clients',
	    						'label' 		=> esc_html__( 'Number of Clients', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'description' 	=> esc_html__( 'Choose the number of client logo you want to show', 'codexin' ),
	    						'options'		=> array(
	    							'min'			=> 4,
	    							'max'			=> 8,
	    							'unit'			=> '',
	    							'step'			=> '2',
	    							'show_input'	=> true
    							),
								'relation' => array(
									'parent'	=> 'layout',
									'show_when' => '2',
								),
	    						'value'			=> '8',
	    						'admin_label'	=> true
	    					),

	    					array(
	    						'name'			=> 'number_of_slides',
	    						'label' 		=> esc_html__( 'Number of Slides', 'codexin' ),
	    						'type'			=> 'number_slider',
								'relation' => array(
									'parent'	=> 'layout',
									'show_when' => '1',
								),
	    						'options'		=> array(
	    							'min'			=> 4,
	    							'max'			=> 8,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							),
	    						'description' 	=> esc_html__( 'Choose the number of client logo slides you want to show on screen', 'codexin' ),
	    						'value'			=> 6,
	    						'admin_label'	=> true
	    					),

	    					array(
	    						'name'			=> 'continous_p',
	    						'label' 		=> esc_html__( 'Enable Continous Play?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable Continous Autoplay', 'codexin' ),
	    						'type'			=> 'toggle',
								'relation' 		=> array(
									'parent'	=> 'layout',
									'show_when' => '1',
								),
	    						'value'			=> 'no',
	    					),


	    					array(
	    						'name'			=> 'arrow',
	    						'label' 		=> esc_html__( 'Show Arrow?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable Navigation Arrow', 'codexin' ),
	    						'type'			=> 'toggle',
								'relation' 		=> array(
									'parent'	=> 'continous_p',
									'hide_when' => 'yes',
								),
	    						'value'			=> 'no',
	    					),

	    					array(
	    						'name'			=> 'dots',
	    						'label' 		=> esc_html__( 'Show Paginations?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable Pagination', 'codexin' ),
	    						'type'			=> 'toggle',
								'relation' 		=> array(
									'parent'	=> 'continous_p',
									'hide_when' => 'yes',
								),
	    						'value'			=> 'no',
	    					),

	    					array(
	    						'name'			=> 'play',
	    						'label' 		=> esc_html__( 'Enable Autoplay?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable AutoPlay', 'codexin' ),
	    						'type'			=> 'toggle',
								'relation' 		=> array(
									'parent'	=> 'continous_p',
									'hide_when' => 'yes',
								),
	    						'value'			=> 'yes',
	    					),


	    					array(
	    						'name'			=> 'pl_speed',
	    						'label' 		=> esc_html__( 'Continous Play Duration', 'codexin' ),
	    						'type'			=> 'text',
								'relation' 		=> array(
									'parent'	=> 'continous_p',
									'show_when' => 'yes',
								),
	    						'description' 	=> esc_html__( 'Insert the duration of continous play speed in milisecond. For example: 2500', 'codexin' ),
	    						'value'			=> '2500',
	    					),

	    					array(
	    						'name'			=> 'speed',
	    						'label' 		=> esc_html__( 'Autoplay Duration', 'codexin' ),
	    						'type'			=> 'text',
								'relation' 		=> array(
									'parent'	=> 'play',
									'show_when' => 'yes',
								),
	    						'description' 	=> esc_html__( 'Choose the duration of autoplay speed in milisecond. For example: 4000', 'codexin' ),
	    						'value'			=> '2000',
	    					),

	    					array(
	    						'name'			=> 'link_client',
	    						'label' 		=> esc_html__( 'Enable Client URL?', 'codexin' ),
	    						'type'			=> 'toggle',
	    						'description' 	=> esc_html__( 'Choose to enable/disable clients URL', 'codexin' ),
	    						'value'			=> 'yes'
	    					),
	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
	    						'type'			=> 'text',
	    						'description' 	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	    					)
 						), //end of general params

						// Styling Params
						'styling' => array(
 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										esc_html__( 'Logo', 'codexin' ) => array(
 											array( 'property' => 'background-color', 'label' => esc_html__('Background', 'codexin'), 'selector' => 'img' ),
 											array( 'property' => 'background-color', 'label' => esc_html__('Background on Hover', 'codexin'), 'selector' => 'img:hover' ),
 											array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => 'img' ),
 											array( 'property' => 'max-width', 'label' => esc_html__('Max Width', 'codexin'), 'selector' => 'img' ),
 											array( 'property' => 'max-height', 'label' => esc_html__('Max Height', 'codexin'), 'selector' => 'img' ),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => 'img'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => 'img')
 										),
 										
 										esc_html__( 'Logo Wrapper Layout-2', 'codexin' ) => array(
 											array( 'property' => 'background-color', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.client-image-single' ),
 											array( 'property' => 'background-color', 'label' => esc_html__('Background on Hover', 'codexin'), 'selector' => '.client-image-single:hover' ),
 											array( 'property' => 'border-color', 'label' => esc_html__('Border Color', 'codexin'), 'selector' => '.client-image-single' ),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.client-image-single'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.client-image-single')
 										)
 									)
 								)
 							)
						), //End Styling

						// Animate Params
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						)//End animate
	                ) //End params array
	            ),  // End of elemnt cx_client
			) //end of  array 
		);  //end of kc_add_map....
	} //End if
} // end of cx_client


