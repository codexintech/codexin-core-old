<?php

/*
    ======================================
        CODEXIN SERVICE BOX SHORTCODE
    ======================================
*/

// Registering Service Box Shortcode
function cx_service_box_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'layout'    		=> '',
      'icon'          => '',
      'image'         => '',
			'img_alt'    	  => '',
			'icon_toggle'		=> '',
			'service_title'	=> '',
      'service_desc'  => '',
      'delay_time'    => '',
      'item_selected' => '',
			'class'         => '',

	), $atts));

	$result = '';

	ob_start(); 
	?>

	<?php 
  if( ! empty( $layout ) ) :
    if( $layout == 1 ):
      // Assigning a master css class and hooking into KC
      $master_class = apply_filters( 'kc-el-class', $atts );
      $master_class[] = 'cx-service-box';

      // Retrieving user define classes
      $classes = array( 'single-service' );
      (!empty($class)) ? $classes[] = $class : '';
   ?>
  	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
  		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
  			<div class="media">
  				<?php if( $icon_toggle ): ?>
  				<div class="media-left">
  					<i class="<?php echo esc_attr( $icon ); ?>"></i>
  				</div>
  				<?php endif; ?>
  				<div class="media-body">
  					<h4 class="media-heading"><?php echo esc_html( $service_title ); ?></h4>
  					<p><?php printf( '%s', $service_desc ) ; ?></p>
  				</div>
  			</div><!-- end of media -->
  		</div><!-- end of single-service -->
  	</div><!-- end of cx-service-box -->
	<?php 
    endif;
    if( $layout == 2 ) :
      // Assigning a master css class and hooking into KC
      $master_class = apply_filters( 'kc-el-class', $atts );
      $master_class[] = 'servicebox-2-wrapper';

      // Retrieving user define classes
      if( $item_selected == 'on' ) :
        $classes = array( 'featured-item item-hover' );
      else :
        $classes = array( 'featured-item' );
      endif;
      (!empty($class)) ? $classes[] = $class : '';
   ?>

     <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
      <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?> text-center wow fadeInUp " data-wow-duration="1s" data-wow-delay="<?php echo esc_attr( $delay_time ); ?>">
        <div class="rv2-icon-1 featured-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
        <h4 class="title-3"><?php echo esc_html( $service_title ); ?></h4>
        <p class="servicebox-2-desc"><?php printf( '%s', $service_desc ) ; ?></p>
      </div>
    </div>

<?php endif;

  if( $layout == 3 ) :

    // Retrieving the image url
    $retrive_img_url = retrieve_img_src( $image, 'about-mini-image' );
    $ret_full_img_url = retrieve_img_src( $image, 'full' );

    // Assigning a master css class and hooking into KC
      $master_class = apply_filters( 'kc-el-class', $atts );
      $master_class[] = 'wrapper-servocebox-3';

      // Retrieving user define classes
      $classes = array( 'service-item pad-50' );
      (!empty($class)) ? $classes[] = $class : '';
?>
    <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
      <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
        <div class="service-icon">
          <img src="<?php echo $retrive_img_url; ?>" alt="<?php echo $img_alt; ?>" />
        </div>
        <div class="service-content">
          <h4 class="title-3"><?php echo esc_html( $service_title ); ?></h4>
          <p class="servicebox-3-desc"><?php printf( '%s', $service_desc ) ; ?></p>
        </div>
      </div>
    </div>

<?php endif; ?>

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
                        '1' => CODEXIN_CORE_ASSET_DIR . '/images/servicebox/layout-1.png',
                        '2' => CODEXIN_CORE_ASSET_DIR . '/images/servicebox/layout-2.png',
  	        						'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/servicebox/layout-3.png',
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
  	        					'name' 			=> 'icon_toggle',
  	        					'label' 		=> esc_html__( 'Enable Service Icon? ', 'codexin' ),
  	        					'type' 			=> 'toggle',
                      'relation'  => array(
                        'parent'    => 'layout',
                        'show_when' =>  '1, 2',
                        ),
  	        					'value'			=> 'no'
        					 ),

  	        				array(
  	        					'name' 			=> 'icon',
  	        					'label' 		=> esc_html__( 'Choose Service Icon', 'codexin' ),
  	        					'type' 			=> 'icon_picker',
  	        					'relation' 		=> array(
  	        						'parent'    => 'icon_toggle',
  	        						'show_when' => 'yes',
        						),
  	        					'description'	=> esc_html__( 'Select Service Icon', 'codexin' ),
        					),

                  array(
                    'name'         => 'image',
                    'label'        => esc_html__(' Upload Icon Image', 'codexin'),
                    'type'         => 'attach_image',
                    'relation'     => array(
                      'parent'    => 'layout',
                      'show_when' => '3',
                      ),
                    'admin_label'  => true,
                  ),

                  array(
                  'name'      => 'img_alt',
                  'label'     => esc_html__( 'Enter Image Alt Tag', 'codexin' ),
                  'type'      => 'text',
                  'relation'     => array(
                      'parent'    => 'layout',
                      'show_when' => '3',
                      ),
                  ),

  	        			 array(
                      'name'      => 'service_desc',
                      'label'     => esc_html__( 'Service Description ', 'codexin' ),
                      'type'      => 'textarea',
                      'description' => esc_html__( 'Enter Service Description', 'codexin' ),
                  ),

                   array(
                      'name'      => 'item_selected',
                      'label'     => esc_html__( 'Animation Delay Time', 'codexin' ),
                      'type'      => 'checkbox',
                      'options'   => array(
                          'on'  => 'Selected Box Item',
                        ),
                      'relation'  => array(
                          'parent'    => 'layout',
                          'show_when' => '2',
                        ),
                      'description' => esc_html__( 'If you wish to style the service-box as selected, please check this box', 'codexin' ),
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
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-service h4,.title-3'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-service h4,.title-3'),
        								),

  	        							'Designation' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-service p,.servicebox-2-desc'),
        								),

  	        							'Icon' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.single-service i,.featured-icon i:before'),
                            array('property' => 'color', 'label' => esc_html__('Color On Hover', 'codexin'), 'selector' => '.featured-item:hover i:before'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-service i,.rv2-icon-1 i:before'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-service i,.rv2-icon-1 i:before'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-service i,.rv2-icon-1 i:before')
        								),

  	        							'Box'	=> array(
  	        								array('property' => 'background', 'selector' => '.featured-item, .service-item'),
  	        								array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
  	        								array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin') ),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '+.cx-service-box, .featured-item'),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin'), 'selector' => '+.cx-service-box:hover,.item-hover, .featured-item:hover'),
  	        								array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '+.cx-service-box,.item-hover, .featured-item:hover'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
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


