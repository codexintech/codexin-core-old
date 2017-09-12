<?php


/*
    ======================================
        CODEXIN CTA SHORTCODE
    ======================================
*/

// Registering Call To Action Shortcode
function cx_call_to_action_shortcode(  $atts, $content = null) {
   extract(shortcode_atts(array(
   			'layout'		=> '',
   			'cta_title'		=> '',
   			'icon_toggle' 	=> '',
   			'icon'       	=> '',
   			'cta_desc'      => '',
   			'button_text'  	=> '',
   			'href'		  	=> '',
   			'class'			=> ''
	), $atts));

	$result = '';

	// Retrieving the url
	$retrieve_link = retrieve_url( $href );

	$title = ($retrieve_link[1]) ? 'title='.esc_attr($retrieve_link[1]):'';
	$target = ($retrieve_link[2]) ? 'target='.esc_attr($retrieve_link[2]):'';

   	ob_start(); 

   	if( ! empty( $layout ) ) :
   		if( $layout == 1 ) :
		// Assigning a master css class and hooking into KC
		$master_class = apply_filters( 'kc-el-class', $atts );
   		$master_class[] = 'cx-cta';

		// Retrieving user define classes
   		$classes = array( 'cta-content' );
   		(!empty($class)) ? $classes[] = $class : '';
   	?>

   	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
   			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

          <?php if( $icon_toggle ): ?>
          <i class="<?php echo esc_attr( $icon ); ?>"></i>
          <?php endif; ?>

   				<div class="cta-title"><?php printf('%s', $cta_title); ?></div>
   				<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>" class="btn-rv btn-white "><?php echo esc_html__( $button_text ); ?></a>
   			</div>
   	</div><!--  end of cta-wrapper-rv2  -->
   	<div class="clearfix"></div>

   <?php 
   endif; //End Layout - 1 

   if( $layout == 2 ) :
   	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx_cta_section';

	// Retrieving user define classes
	$classes = array( 'cta-container' );
	(!empty($class)) ? $classes[] = $class : ''; ?>
	
	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">	
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="col-sm-12 col-xs-12">

				<div class="cx_outer_div">
					<div class="cx_content_div">
						<?php echo $content; ?>
					</div>
				</div> <!-- end of cx_outer_div -->		        

			</div> <!-- end of col-xs-12 -->
		</div> <!-- end of cta-container -->
	</div> <!-- end of cx_cta_section -->

<?php endif; //End Layout - 2 

	  if( $layout == 3 ) :
	  // Assigning a master css class and hooking into KC
	  $master_class = apply_filters( 'kc-el-class', $atts );
	  $master_class[] = 'cx-cta-button-3';

	  // Retrieving user define classes
	  $classes = array( 'wrapper-cta-3' );
	  (!empty($class)) ? $classes[] = $class : ''; ?>
	  <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
	  	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	  		<div class="rv3-cta-content">
	  			<h4 class="cta-title"><?php printf('%s', $cta_title); ?></h4>
	  			<p> <?php printf( '%s', $cta_desc ); ?> </p>
	  			<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>" class="btn-rv btn-white "><?php echo esc_html__( $button_text ); ?></a>
	  		</div>
	  	</div>
	  </div><!--  cta section end  -->
	  <div class="clearfix"></div>

	<?php endif; //End Layout - 3 ?>  

	<?php
	endif;
	$result .= ob_get_clean();
	return $result;

} // end of cx_call_to_action

// Integrating Shortcode with King Composer
function cx_call_to_action_kc() {
	if (function_exists('kc_add_map')) { 
	    kc_add_map(
	    	array(
	    		'cx_call_to_action' => array(
	    			'name' 			=> esc_html__( 'Codexin CTA', 'codexin' ),
	    			'description' 	=> esc_html__('Call To Action Box', 'codexin'),
	    			'icon' 			=> 'et-hazardous',
	    			'category' 		=> 'Codexin',
	    			'is_container'  => true,
	    			'params' 		=> array(
	    				// General Params
	    				'general' 	=> array(
	    					array(
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select CTA Template', 'codexin' ),
								'name'			=> 'layout',
								'admin_label'	=> true,
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/cta/layout-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/cta/layout-2.png',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/cta/layout-3.png',
								),
								'value'	=> '1'
							),

	    					array(
	    						'name'        => 'cta_title',
	    						'label'       => esc_html__('CTA Title', 'codexin'),
	    						'type'        => 'text',
	    						'description' => esc_html__( 'Enter Call To Action Title Here', 'codexin' ),
	    						'relation'	  => array(
	    							'parent' 	=> 'layout',
	    							'show_when'	=> '1,3',
	    						),
	    						'admin_label' => true,
    						),

	        				array(
	        					'name' 			=> 'icon_toggle',
	        					'label' 		=> esc_html__( 'Enable Icon? ', 'codexin' ),
	        					'type' 			=> 'toggle',
	        					'relation'	  => array(
	    							'parent' 	=> 'layout',
	    							'show_when'	=> '1',
	    						),
      						),

	        				array(
	        					'name' 			=> 'icon',
	        					'label' 		=> esc_html__( 'Choose Icon', 'codexin' ),
	        					'type' 			=> 'icon_picker',
	        					'relation' 		=> array(
	        						'parent'    => 'icon_toggle',
	        						'show_when' => 'yes',
      							),
      						),

	    					array(
	    						'name' 		=> 'button_text',
	    						'label' 	=> esc_html__( 'Button Text', 'codexin' ),
	    						'type' 		=> 'text',
	    						'relation'	  => array(
	    							'parent' 	=> 'layout',
	    							'show_when'	=> '1,3',
	    						),
	    						'description' => esc_html__( 'Enter CTA Button Text Here', 'codexin' ),
    						),

	    					array(
	    						'name'     		=> 'href',
	    						'label'    		=> esc_html__(' Custom URL', 'codexin'),
	    						'type'    		=> 'link',
	    						'relation'	  => array(
	    							'parent' 	=> 'layout',
	    							'show_when'	=> '1,3',
	    						),
	    						'description' 	=> esc_html__(' The URL which this box assigned to. You can select page/post or other post type', 'codexin')
    						),

	    					array(
	    						'name'			=> 'content',
	    						'label' 		=> esc_html__(' CTA Content', 'codexin'),
	    						'type'			=> 'textarea_html',
	    						'relation'		=> array(
	    							'parent' => 'layout',
	    							'show_when' => '2',
	    						),
	    						'description'	=> esc_html__( 'Your CTA Description Here', 'codexin' )
    						),

    						array(
	    						'name'			=> 'cta_desc',
	    						'label' 		=> esc_html__('CTA Content', 'codexin'),
	    						'type'			=> 'textarea',
	    						'relation'		=> array(
	    							'parent' => 'layout',
	    							'show_when' => '3',
	    						),
	    						'description'	=> esc_html__( 'Your CTA Description Here', 'codexin' )
    						),

    						array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__(' Extra Class', 'codexin'),
	    						'type'			=> 'text'
    						),

    					), // end of general

						// Style based Params
	    				'styling' => array(
	    					array(
	    						'name'    		=> 'codexin_css',
	    						'type'    		=> 'css',
	    						'options' 		=> array(
	    							array(
	    								"screens" => "any,1199,991,767,479",

	    								'Title' => array(
	    									array('property' => 'color', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.cta-title'),
    									),

	    								'Icon' => array(
	    									array('property' => 'color', 'label' => esc_html__('Icon Color', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'font-size', 'label' => esc_html__('Icon Font Size', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Icon Font Size', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Icon Font Weight', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'padding', 'label' => esc_html__('Icon Padding', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'margin', 'label' => esc_html__('Icon Margin', 'codexin'), 'selector' => '.cta-content i'),

    									),

	    								'Button' 	=> array(
	    									array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.btn-white'),
	    									array('property' => 'color', 'label' => esc_html__('Color On Hover', 'codexin'), 'selector' => '.btn-white:hover'),
	    									array('property' => 'background', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.btn-white'),
	    									array('property' => 'background-color', 'label' => esc_html__('Background Color On Hover', 'codexin'), 'selector' => '.btn-white:hover'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.btn-white'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.btn-white'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.btn-white'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.btn-white'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.btn-white'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.btn-white')
    									),

    									'Href Text' => array(
	    									array('property' => 'color', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.cx_content_div p a'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.cx_content_div p a'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.cx_content_div p a'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.cx_content_div p a'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.cx_content_div p a'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.cx_content_div p a'),
	    									array('property' => 'text-decoration', 'label' => esc_html__('Text Decoration', 'codexin'), 'selector' => '.cx_content_div p a'),
    									),

    									'Text' => array(
	    									array('property' => 'color', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.cx_content_div p'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.cx_content_div p'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.cx_content_div p'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.cx_content_div p'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.cx_content_div p'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.cx_content_div p'),
    									),

	    								'Box'	=> array(
	    									array('property' => 'background', 'selector' => '.cx_content_div'),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.cx_outer_div'),
	    									array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin'), 'selector'=> '.cx_outer_div'),
	    									array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '.cx_outer_div'),
	    									array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin'), 'selector' => '.cx_outer_div'),
	    									array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '.cx_outer_div'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.cx_content_div'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.cx_content_div'),
    									)
    								)
    							) //End Options
    						) //End array
    					), // end of styling

	    				// Animate param
	    				'animate' => array(
	    					array(
	    						'name'    		=> 'animate',
	    						'type'    		=> 'animate'
    						)
    					), // end of animate
    				)
	            ),  // End of cx_about_box array
			) //end of array
	    );  //end of kc_add_map
	} //End if
} // end of cx_about_box_kc


