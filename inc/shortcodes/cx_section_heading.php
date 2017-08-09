<?php


/*
    ======================================
        CODEXIN SECTION HEADING SHORTCODE
    ======================================
*/

function cx_section_heading_shortcode(  $atts, $content = null) {
   extract(shortcode_atts(array(
   			'title' 				=> '',
   			'subtitle'	 			=> '',
   			'description_toggle' 	=> '',
   			'description'  			=> '',
   			'class'		  			=> '',
   ), $atts));

   $master_class = apply_filters( 'kc-el-class', $atts );
   $master_class[] = 'section-heading';
   $classes = array( 'cx-section-heading' );
   (!empty($class)) ? $classes[] = $class : '';

   $result = '';
   ob_start(); ?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<h3 class="primary-title"><?php echo esc_html( $title ); ?></h3>
				<h2 class="secondary-title"><?php echo esc_html( $subtitle ); ?></h2>
				<?php if( $description_toggle == 'yes' ): ?>
				<div class="col-md-10 col-md-offset-1 cx-description">
					<p><?php printf('%s', $description ); ?></p>		
				</div>
				<?php endif; ?>
			</div><!-- end of cx-section-heading -->
		</div><!-- end of section-heading -->

	<?php
	$result .= ob_get_clean();
	return $result;

} 


// Integrating Shortcode with King Composer
function cx_section_heading_kc() {

	if (function_exists('kc_add_map')) { 
	    kc_add_map(
  	        array(
	            'cx_section_heading'=> array(
                	'name' 			=> esc_html__( 'Codexin Section Header', 'codexin' ),
	                'description' 	=> esc_html__('Section Header', 'codexin'),
	                'icon' 			=> 'kc-icon-title',
	                'category' 		=> 'Codexin',
	                'params' 		=> array(
	                	//General params
						'general' 	=> array(
		                    array(
		                        'name' 			=> 'title',
		                        'label' 		=> esc_html__( 'Enter Title', 'codexin' ),
		                        'type' 			=> 'text',
		                        'admin_label'	=> true,
		                    ),

		                    array(
		                        'name' 			=> 'subtitle',
		                        'label' 		=> esc_html__( 'Enter Subtitle', 'codexin' ),
		                        'type' 			=> 'text',
		                    ),

		                    array(
		                        'name' 			=> 'description_toggle',
		                        'label' 		=> esc_html__( 'Enable Description Field? ', 'codexin' ),
		                        'type' 			=> 'toggle',
		                    ),

		                    array(
		                    	'name' 			=> 'description',
		                    	'label' 		=> esc_html__( 'Enter Description', 'codexin' ),
		                    	'type' 			=> 'textarea',
		                    	'relation' 		=> array(
		                    		'parent'    => 'description_toggle',
		                    		'show_when' => 'yes',
		                    	),
		                    ),

							array(
								'name'			=> 'class',
								'label' 		=> __(' Extra Class', 'codexin'),
								'type'			=> 'text'
							),
						), // end of general

						//Styling params
						'styling' 	=> array(
							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' => array(
									array(
										"screens" => "any,1199,991,767,479",
										'Title' => array(
											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.primary-title'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.primary-title')
										),

										'Subtitle' => array(
											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.secondary-title'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.secondary-title'),
										),

										'Divider' => array(
											array('property' => 'background', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.secondary-title::after'),
											array('property' => 'width', 'label' => esc_html__( 'Width', 'codexin'), 'selector' => '.secondary-title::after'),
											array('property' => 'height', 'label' => esc_html__( 'Height', 'codexin'), 'selector' => '.secondary-title::after'),
											array('property' => 'display', 'label' => esc_html__( 'Display', 'codexin'), 'selector' => '.secondary-title::after'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.secondary-title::after')
										),

										'Desc' => array(
											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-description'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-description'),
										),

										'Box'	=> array(
											array('property' => 'background'),
											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin')),
											array('property' => 'display', 'label' => esc_html__( 'Display', 'codexin')),
											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius','codexin')),
											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow','codexin'), 'selector' => '+.section-heading'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin','codexin')),
											array('property' => 'padding', 'label' => esc_html__( 'Padding','codexin')),
										)
										
									)
								)
							)
						), // end of styling

						//Animate params
						'animate' 	=> array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						), // end of animate

          			)  //end of params
      			), // end of cx_section_heading
			) //end of  array 
		);  //end of kc_add_map
	}
} // end of cx_section_heading_kc


