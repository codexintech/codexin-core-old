<?php


/*
    ======================================
        CODEXIN SECTION HEADING SHORTCODE
    ======================================
*/

// Registering Section heading Shortcode
function cx_section_heading_shortcode(  $atts, $content = null) {
	extract(shortcode_atts(array(
				'layout'				=> '',
				'title' 				=> '',
				'subtitle'	 			=> '',
				'description_toggle' 	=> '',
				'description'  			=> '',
				'class'		  			=> '',
	), $atts));

	$result = '';

	ob_start(); 

		if( ! empty( $layout ) ) :
			if( $layout == 1 ) :
				// Assigning a master css class and hooking into KC
				$master_class = apply_filters( 'kc-el-class', $atts );
				$master_class[] = 'section-heading';

				// Retrieving user define classes
				$classes = array( 'cx-section-heading' );
				(!empty($class)) ? $classes[] = $class : ''; 
		?>
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
			endif; //end layout 1
			if( $layout == 2 ) :
		 
			// Assigning a master css class and hooking into KC
				$master_class = apply_filters( 'kc-el-class', $atts );
				$master_class[] = 'rv2-title';

				// Retrieving user define classes
				$classes = array( 'rv2-title-inner' );
				(!empty($class)) ? $classes[] = $class : ''; 
			?>	

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<h2 class="primary-title rv2"> <?php echo esc_html( $title ); ?> </h2>
					<h4 class="secondary-title rv2"><?php echo esc_html( $subtitle ); ?></h4>
				</div>
			</div>


	<?php endif; //End layout 2 ?>

	<?php
		endif;
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
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select Section Header Template', 'codexin' ),
								'name'			=> 'layout',
								'admin_label'	=> true,
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/section-header/layout-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/section-header/layout-2.png',
								),
								'value'	=> '1'
							),

		                    array(
		                        'name' 			=> 'subtitle',
		                        'label' 		=> esc_html__( 'Enter Subtitle', 'codexin' ),
		                        'type' 			=> 'text',
		                        'admin_label'	=> true,
		                    ),

		                    array(
		                        'name' 			=> 'title',
		                        'label' 		=> esc_html__( 'Enter Title', 'codexin' ),
		                        'type' 			=> 'text',
		                    ),

		                    array(
		                        'name' 			=> 'description_toggle',
		                        'label' 		=> esc_html__( 'Enable Description Field? ', 'codexin' ),
		                        'type' 			=> 'toggle',
		                        'relation'		=> array(
		                        	'parent'	=> 'layout',
		                        	'show_when'	=> '1'
		                        ),
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
											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.primary-title, h2.primary-title.rv2')
										),

										'Subtitle' => array(
											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.secondary-title, .secondary-title .rv2'),
										),

										'Divider' => array(
											array('property' => 'background-color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.secondary-title::after,.rv2-title::before' ),
											array('property' => 'width', 'label' => esc_html__( 'Width', 'codexin'), 'selector' => '.secondary-title::after,.rv2-title::before'),
											array('property' => 'height', 'label' => esc_html__( 'Height', 'codexin'), 'selector' => '.secondary-title::after,.rv2-title::before'),
											array('property' => 'display', 'label' => esc_html__( 'Display', 'codexin'), 'selector' => '.secondary-title::after,.rv2-title::before'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.secondary-title::after,.rv2-title::before')
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


