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
   			'cta_content'   => '',
   			'button_text'  	=> '',
   			'href'		  	=> '',
   			'class'			=> ''
	), $atts));

	$result = '';

	// Retrieving the url
	$retrieve_link = codexin_retrieve_url( $href );
	$title = ($retrieve_link[1]) ? 'title="'.esc_attr($retrieve_link[1]).'"':'';
	$target = ($retrieve_link[2]) ? 'target="'.esc_attr($retrieve_link[2]).'"':'';

   	ob_start(); 

   	if( ! empty( $layout ) ) :
   		if( $layout == 1 ) :
			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
	   		$master_class[] = 'cx-cta';

			// Retrieving user define classes
	   		$classes = array( 'cta-content cx-bg-0' );
	   		(!empty($class)) ? $classes[] = $class : '';
		?>

		   	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
	   			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php if( $icon_toggle ): ?>
					<i class="<?php echo esc_attr( $icon ); ?> cx-color-2"></i>
					<?php endif; ?>
	   				<div class="cta-details cx-color-2">
	   					<?php if( !empty( $cta_title ) ): ?>
		   					<h4 class="cta-title"><?php printf('%s', $cta_title); ?></h4>
		   				<?php endif; ?>
		   				<?php if( !empty( $cta_desc ) ): ?>
		   					<p><?php printf('%s', $cta_desc); ?></p>
		   				<?php endif; ?>
	   				</div>
	   				<div class="cx-cta-btn">
		   				<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>><?php echo esc_html( $button_text ); ?></a>
		   			</div>
	   			</div><!-- end of cta-content -->
		   	</div><!-- end of cx-cta -->

	   	<?php 
		endif; //End Layout - 1 

		if( $layout == 2 ) :
		   	// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-cta-2';

			// Retrieving user define classes
			$classes = array( 'cta-content cx-border-2' );
			(!empty($class)) ? $classes[] = $class : ''; 
		?>
			
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">	
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="cta-details cx-bg-2">
						<div class="cx-content">
							<p><?php printf( '%s', $cta_content ); ?></p>
						</div>
					</div> <!-- end of cta-details -->
				</div> <!-- end of cta-cta-content-2 -->
			</div> <!-- end of cx-cta -->

		<?php endif; //End Layout - 2 

		if( $layout == 3 ) :
			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-cta-3';

			// Retrieving user define classes
			$classes = array( 'cta-content cx-bg-0 cx-color-2' );
			(!empty($class)) ? $classes[] = $class : ''; 
		?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			  	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			  		<div class="cta-details">
			  			<?php if( !empty( $cta_title ) ): ?>
				  			<h4 class="cta-title"><?php printf('%s', $cta_title); ?></h4>
				  		<?php endif; ?>
				  		<?php if( !empty( $cta_desc ) ): ?>
				  			<p> <?php printf( '%s', $cta_desc ); ?> </p>
				  		<?php endif; ?>
		   				<div class="cx-cta-btn">
			   				<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>><?php echo esc_html( $button_text ); ?></a>
			   			</div>
			  		</div>
	   			</div><!-- end of cta-content -->
		   	</div><!-- end of cx-cta -->

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
	    			'name' 			=> esc_html__( 'Codexin Call to Action', 'codexin' ),
	    			'description' 	=> esc_html__('Call To Action Box', 'codexin'),
	    			'icon' 			=> 'et-hazardous',
	    			'category' 		=> 'Codexin',
	    			'params' 		=> array(
	    				// General Params
	    				'general' 	=> array(
	    					array(
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select CTA Template', 'codexin' ),
								'name'			=> 'layout',
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/cta/cta-1.jpg',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/cta/cta-2.jpg',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/cta/cta-3.jpg',
								),
								'value'	=> '1',
								'admin_label' => true,
							),

	    					array(
	    						'name'        	=> 'cta_title',
	    						'label'       	=> esc_html__('CTA Title', 'codexin'),
	    						'type'        	=> 'textarea',
	    						'description' 	=> esc_html__( 'Enter Call To Action Title Here', 'codexin' ),
	    						'relation'	  	=> array(
	    							'parent' 	=> 'layout',
	    							'show_when'	=> '1,3',
	    						),
	    						'admin_label' 	=> true,
	    						'value'		  	=> 'Sample CTA Title'
    						),

	    					array(
	    						'name'			=> 'cta_content',
	    						'label' 		=> esc_html__(' CTA Content', 'codexin'),
	    						'type'			=> 'textarea',
	    						'relation'		=> array(
	    							'parent' 	=> 'layout',
	    							'show_when' => '2',
	    						),
	    						'description'	=> esc_html__( 'Your Call to Action Description Here', 'codexin' ),
	    						'admin_label' 	=> true,
    						),

	        				array(
	        					'name' 			=> 'desc_toggle',
	        					'label' 		=> esc_html__( 'Enable Content? ', 'codexin' ),
	        					'type' 			=> 'toggle',
	        					'relation'	  => array(
	    							'parent' 	=> 'layout',
	    							'show_when'	=> '1,3',
	    						),
      						),

    						array(
	    						'name'			=> 'cta_desc',
	    						'label' 		=> esc_html__('CTA Content', 'codexin'),
	    						'type'			=> 'textarea',
	    						'relation'		=> array(
	    							'parent' 	=> 'desc_toggle',
	    							'show_when' => 'yes',
	    						),
	    						'description'	=> esc_html__( 'Your Call to Action Description Here', 'codexin' )
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
	    						'description' => esc_html__( 'Enter Call to Action Button Text Here', 'codexin' ),
	    						'value'		  	=> 'Read More'
    						),

	    					array(
	    						'name'     		=> 'href',
	    						'label'    		=> esc_html__(' Button URL', 'codexin'),
	    						'type'    		=> 'link',
	    						'relation'	  => array(
	    							'parent' 	=> 'layout',
	    							'show_when'	=> '1,3',
	    						),
	    						'description' 	=> esc_html__(' The URL which this box assigned to. You can select page/post or other post type', 'codexin'),
	    						'value'		  	=> '#'
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
	    									array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.cta-title'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.cta-title'),
    									),

    									'Content' => array(
	    									array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'color', 'label' => esc_html__('Content Link Color (If any)', 'codexin'), 'selector' => '.cta-details p a, .cx-content p a'),
	    									array('property' => 'color', 'label' => esc_html__('Content Link Color on Hover (If any)', 'codexin'), 'selector' => '.cta-details p a:hover, .cx-content p a:hover'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.cta-details p, .cx-content p'),
    									),

	    								'Icon' => array(
	    									array('property' => 'color', 'label' => esc_html__('Icon Color', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'font-size', 'label' => esc_html__('Icon Font Size', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Icon Font Size', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Icon Font Weight', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'padding', 'label' => esc_html__('Icon Padding', 'codexin'), 'selector' => '.cta-content i'),
	    									array('property' => 'margin', 'label' => esc_html__('Icon Margin', 'codexin'), 'selector' => '.cta-content i'),

    									),

	    								'Button' => array(
	    									array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'color', 'label' => esc_html__('Color On Hover', 'codexin'), 'selector' => '.cx-cta-btn a:hover'),
	    									array('property' => 'background', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'background-color', 'label' => esc_html__('Background Color On Hover', 'codexin'), 'selector' => '.cx-cta-btn a:hover'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.cx-cta-btn a'),
											array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'border-color', 'label' => esc_html__('Border Color on Hover', 'codexin'), 'selector' => '.cx-cta-btn a:hover'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.cx-cta-btn a'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.cx-cta-btn a')
    									),

	    								'Content Wrapper' => array(
	    									array('property' => 'background-color', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.cta-content'),
	    									array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.cta-content'),
	    									array('property' => 'height', 'label' => esc_html__('Height', 'codexin'), 'selector' => '.cta-content'),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.cta-content'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.cta-content'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.cta-content'),
    									),

	    								'Box'	=> array(
	    									array('property' => 'background'),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
	    									array('property' => 'height', 'label' => esc_html__('Height', 'codexin') ),
	    									array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin') ),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
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
} // end of cx_call_to_action


