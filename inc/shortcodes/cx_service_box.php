<?php

/*
    ======================================
        CODEXIN SERVICE BOX SHORTCODE
    ======================================
*/

// Registering Service Box Shortcode
function cx_service_box_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
            'layout'    	=> '',
            'icon'          => '',
            'icon_toggle'   => '',
            's_media'       => '',
            's_icon'        => '',
            's_image'       => '',
            'media_image'   => '',
            'media_img'     => '',
            'image_alt' 	=> '',
            'service_title'	=> '',
            'service_desc'  => '',
            'class'         => '',

	), $atts));

	$result = '';

    // Assigning a master css class and hooking into KC
    $master_class = apply_filters( 'kc-el-class', $atts );
    $master_class[] = 'cx-service-box';

    // Retrieving the image url
    $ret_full_img_url = retrieve_img_src( $media_image, 'full' );


	ob_start(); 
	?>

	<?php 
    if( ! empty( $layout ) ) :
        if( $layout == 1 ):

            // Retrieving user define classes
            $classes = array( 'service-single clearfix' );
            (!empty($class)) ? $classes[] = $class : '';
           ?>
          	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
          		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
          			<div class="media-wrapper">
          				<?php if( $icon_toggle ): ?>
          				<div class="media-thumb">
                            <?php if( $s_media == 's_icon' ): ?>
              					<i class="<?php echo esc_attr( $icon ); ?>"></i>
                            <?php else: ?>
                                <img src="<?php echo esc_url( $ret_full_img_url ); ?>" alt="<?php if( !empty( $image_alt ) ): echo esc_html( $image_alt ); else: echo esc_html( $service_title ); endif; ?>">
                            <?php endif; ?>
          				</div>
          				<?php endif; ?>
          				<div class="media-desc">
          					<h4 class="media-title"><?php echo esc_html( $service_title ); ?></h4>
          					<div class="media-texts"><?php printf( '%s', $service_desc ) ; ?></div>
          				</div>
          			</div><!-- end of media-wrapper -->
          		</div><!-- end of service-single -->
          	</div><!-- end of cx-service-box -->
    	<?php // End Layout - 1
        endif;

        if( $layout == 2 ) :

            // Retrieving user define classes
            $classes = array( 'service-single-2 clearfix' );
            (!empty($class)) ? $classes[] = $class : '';
            ?>

            <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
                <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
                    <div class="media-wrapper">
                        <div class="media-thumb">
                            <?php if( $s_media == 's_icon' ): ?>
                                <i class="<?php echo esc_attr( $icon ); ?>"></i>
                            <?php else: ?>
                                <img src="<?php echo esc_url( $ret_full_img_url ); ?>" alt="<?php if( !empty( $image_alt ) ): echo esc_html( $image_alt ); else: echo esc_html( $service_title ); endif; ?>">
                            <?php endif; ?>
                        </div>
                        <div class="media-desc">
                            <h4 class="media-title"><?php echo esc_html( $service_title ); ?></h4>
                            <p class="media-texts"><?php printf( '%s', $service_desc ) ; ?></p>
                        </div>
                    </div><!-- end of media-wrapper -->
                </div><!-- end of service-single-2 -->
            </div><!-- end of cx-service-box -->

        <?php endif; // End Layout - 2

        if( $layout == 3 ) :

            // Retrieving user define classes
            $classes = array( 'service-single-3 clearfix' );
            (!empty($class)) ? $classes[] = $class : '';

            ?>

            <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
                <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
                    <div class="media-wrapper">
                        <div class="media-thumb">
                            <?php if( $s_media == 's_icon' ): ?>
                                <i class="<?php echo esc_attr( $icon ); ?>"></i>
                            <?php else: ?>
                                <img src="<?php echo esc_url( $ret_full_img_url ); ?>" alt="<?php if( !empty( $image_alt ) ): echo esc_html( $image_alt ); else: echo esc_html( $service_title ); endif; ?>">
                            <?php endif; ?>
                        </div>
                        <div class="media-desc">
                            <h4 class="media-title"><?php echo esc_html( $service_title ); ?></h4>
                            <p class="media-texts"><?php printf( '%s', $service_desc ) ; ?></p>
                        </div>
                    </div><!-- end of media-wrapper -->
                </div><!-- end of service-single-3 -->
            </div><!-- end of cx-service-box -->

        <?php endif; //End layout - 3 

        if( $layout == 4 ) :

            // Retrieving user define classes
            $classes = array( 'service-single-4 clearfix' );
            (!empty($class)) ? $classes[] = $class : '';

            // Retrieving the image url
            $ret_img_url = retrieve_img_src( $media_img, 'rectangle-one' );

            ?>

            <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
                <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
                    <div class="media-wrapper">
                        <div class="media-image">
                            <img src="<?php echo esc_url( $ret_img_url ); ?>" alt="<?php if( !empty( $image_alt ) ): echo esc_html( $image_alt ); else: echo esc_html( $service_title ); endif; ?>">
                        </div>
                        <div class="media-desc">
                            <?php if( $icon_toggle ): ?>
                                <div class="media-thumb">
                                    <?php if( $s_media == 's_icon' ): ?>
                                        <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                    <?php else: ?>
                                        <img src="<?php echo esc_url( $ret_full_img_url ); ?>" alt="<?php if( !empty( $image_alt ) ): echo esc_html( $image_alt ); else: echo esc_html( $service_title ); endif; ?>">
                                    <?php endif; ?>
                                </div>
                            <?php else: echo '<div class="no-media-thumb"></div>'; endif; ?>
                            <h4 class="media-title"><?php echo esc_html( $service_title ); ?></h4>
                            <p class="media-texts"><?php printf( '%s', $service_desc ) ; ?></p>
                        </div>
                    </div><!-- end of media-wrapper -->
                </div><!-- end of service-single-3 -->
            </div><!-- end of cx-service-box -->

        <?php endif; //End layout - 4 ?>

	<?php
    endif;

	$result .= ob_get_clean();
	return $result;
} //End cx_service_box


// Integrating Shortcode with King Composer
function cx_service_box_kc() {

	if (function_exists('kc_add_map')) { 
	    kc_add_map(
  	        array(
  	        	'cx_service_box' 	=> array(
  	        		'name' 			=> esc_html__( 'Codexin Service Box', 'codexin' ),
  	        		'description' 	=> esc_html__('Service Box', 'codexin'),
  	        		'icon' 			=> 'fa-yelp',
  	        		'category' 		=> 'Codexin',
  	        		'params' 		=> array(
  	        			'general'	=> array(
  	        				array(
  	        					'type'			=> 'radio_image',
  	        					'label'			=> esc_html__( 'Select Service Box Template', 'codexin' ),
  	        					'name'			=> 'layout',
  	        					'options'		=> array(
                                    '1' => CODEXIN_CORE_ASSET_DIR . '/images/layout-img/servicebox/service-1.jpg',
                                    '2' => CODEXIN_CORE_ASSET_DIR . '/images/layout-img/servicebox/service-2.jpg',
                                    '3' => CODEXIN_CORE_ASSET_DIR . '/images/layout-img/servicebox/service-3.jpg',
                                    '4' => CODEXIN_CORE_ASSET_DIR . '/images/layout-img/servicebox/service-4.jpg',
                                    ),
  	        					'value'			=> '1'
                            ),

  	        				
  	        				array(
  	        					'name' 			=> 'service_title',
  	        					'label' 		=> esc_html__( 'Servce Title ', 'codexin' ),
  	        					'type' 			=> 'text',
  	        					'description'	=> esc_html__( 'Enter Service Title', 'codexin' ),
  	        					'admin_label' 	=> true,
        					 ),

                            array(
                                'name'          => 'media_img',
                                'label'         => esc_html__( 'Upload Featured Service Image', 'codexin' ),
                                'type'          => 'attach_image',
                                'relation'      => array(
                                    'parent'    => 'layout',
                                    'show_when' => '4',
                                ),
                                'description'   => esc_html__( 'Upload Your Featured Service Image.', 'codexin' ),
                            ),

                            array(
                                'name' 			=> 'icon_toggle',
                                'label' 		=> esc_html__( 'Enable Service Icon? ', 'codexin' ),
                                'type' 			=> 'toggle',
                                'value'			=> 'no'
                            ),

                            array(
                                'name'          => 's_media',
                                'label'         => esc_html__( 'Icon or Image? ', 'codexin' ),
                                'type'          => 'dropdown',
                                'options'       => array(
                                        's_icon'    => "Icon Font",
                                        's_image'   => "Image Icon"
                                ),
                                'relation'      => array(
                                    'parent'    => 'icon_toggle',
                                    'show_when' => 'yes',
                                ),
                                'value'         => 's_icon',
                                'description'   => esc_html__( 'Choose what media you want to show', 'codexin' ),
                            ),

                            array(
                                'name'          => 'media_image',
                                'label'         => esc_html__( 'Upload Service Image Icon', 'codexin' ),
                                'type'          => 'attach_image',
                                'relation'      => array(
                                    'parent'    => 's_media',
                                    'show_when' => 's_image',
                                ),
                                'description'   => esc_html__( 'Recommended Image Icon size 50x50 px.', 'codexin' ),
                            ),

                            array(
                                'name'          => 'image_alt',
                                'label'         => esc_html__( 'Enter Image Alt Tag', 'codexin' ),
                                'type'          => 'text',
                                'relation'      => array(
                                    'parent'    => 's_media',
                                    'show_when' => 's_image',
                                ),
                            ),

  	        				array(
  	        					'name' 			=> 'icon',
  	        					'label' 		=> esc_html__( 'Choose Service Icon', 'codexin' ),
  	        					'type' 			=> 'icon_picker',
  	        					'relation' 		=> array(
  	        						'parent'    => 's_media',
  	        						'show_when' => 's_icon',
        						),
  	        					'description'	=> esc_html__( 'Select Service Icon', 'codexin' ),
        					),

          	        		array(
                              'name'      => 'service_desc',
                              'label'     => esc_html__( 'Service Description ', 'codexin' ),
                              'type'      => 'textarea',
                              'description' => esc_html__( 'Enter Service Description', 'codexin' ),
                          ),

                           array(
                            'name'      => 'class',
                            'label'     => __( 'Enter Class', 'codexin' ),
                            'type'      => 'text',
                            'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
                            'admin_label'   => false,
                           ),

        				 ), // end of general

  	        			// Styling params
  	        			'styling' => array(

  	        				array(
  	        					'name'    		=> 'codexin_css',
  	        					'type'    		=> 'css',
  	        					'options' 		=> array(
  	        						array(
  	        							"screens" => "any,1199,991,767,479",

  	        							'Title' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.media-desc h4'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.media-desc h4'),
        								),

  	        							'Description' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.media-desc .media-texts'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.media-desc .media-texts'),
        								),

  	        							'Icon' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.media-thumb i'),
                                            array('property' => 'color', 'label' => esc_html__('Color On Hover', 'codexin'), 'selector' => '.service-single:hover i, .service-single-2:hover i, .service-single-3:hover i, .service-single-4:hover i'),
                                            array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.media-thumb i'),
                                            array('property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.media-wrapper'),
                                            array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.media-thumb'),
  	        								array('property' => 'transition', 'label' => esc_html__('Transition', 'codexin'), 'selector' => '.media-thumb i'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.media-thumb i'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.media-thumb i')
        								),

                                        'Icon Image' => array(
                                            array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.media-thumb img'),
                                            array('property' => 'max-width', 'label' => esc_html__('Max Width', 'codexin'), 'selector' => '.media-thumb img'),
                                            array('property' => 'height', 'label' => esc_html__('Height', 'codexin'), 'selector' => '.media-thumb img'),
                                            array('property' => 'background-color', 'label' => esc_html__('Icon Image Background Color for Layout-4', 'codexin'), 'selector' => '.service-single-4 .media-thumb'),
                                            array('property' => 'border-color', 'label' => esc_html__('Icon Image border Color for Layout-4 (Should be same as Background Color Above)', 'codexin'), 'selector' => '.service-single-4 .media-thumb::before'),
                                            array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.media-thumb img'),
                                            array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.media-thumb img'),
                                            array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.media-thumb img')
                                        ),

  	        							'Box'	=> array(
  	        								array('property' => 'background', 'selector' => '.service-single, .service-single-2, .service-single-3, .service-single-4'),
                                            array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.service-single, .service-single-2, .service-single-3, .service-single-4' ),
  	        								array('property' => 'border', 'label' => esc_html__('Border on Hover', 'codexin'), 'selector' => '.service-single:hover, .service-single-2:hover, .service-single-3:hover, .service-single-4:hover' ),
  	        								array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin'), 'selector' => '.service-single, .service-single-2, .service-single-3, .service-single-4' ),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '.service-single, .service-single-2, .service-single-3, .service-single-4'),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin'), 'selector' => '.service-single:hover, .service-single-2:hover, .service-single-3:hover, .service-single-4:hover'),
  	        								array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '.service-single, .service-single-2, .service-single-3, .service-single-4'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.service-single, .service-single-2, .service-single-3, .service-single-4' ),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.service-single, .service-single-2, .service-single-3, .service-single-4' ),
        								)									
        							)
        						)
        					)
        				), // end of styling
  	        			// animate param
  	        			'animate' => array(
  	        				array(
  	        					'name'    		=> 'animate',
  	        					'type'    		=> 'animate'
        					)
        				), // end of animate
	                ) //End params
	            ),  // End of elemnt cx_service_box 
			) //end of array 
	    );  //end of kc_add_map
	} //End if
} // end of cx_section_heading_kc


