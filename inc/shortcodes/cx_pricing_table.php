<?php


/*
    ======================================
       CODEXIN PRICING TABLE SHORTCODE
    ======================================
*/
	
// Registering Pricing Table Shortcode
function cx_pricing_table_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'price_title'		=> '',
			'price'				=> '',
			'price_duration'	=> '',
			'price_desc'		=> '',
			'featured'			=> '',
			'featured_text'		=> '',
			'list_desc'			=> '',
			'btn_toggle'		=> '',
			'href'				=> '',
			'btn_text'			=> '',
   			'class'				=> ''


	), $atts));

	$result = '';

	ob_start(); 

	// Retrieving the url
	$retrieve_link = retrieve_url( $href );
	$title = ($retrieve_link[1]) ? 'title="'.esc_attr($retrieve_link[1]).'"':'';
	$target = ($retrieve_link[2]) ? 'target="'.esc_attr($retrieve_link[2]).'"':'';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-pricing-tables';

	// Retrieving user define classes
	$classes = array( 'pricing-table-single clearfix' );
	(!empty($class)) ? $classes[] = $class : '';

	if ( !empty( $price_desc ) ):
		$pr_desc = explode( "\n", $price_desc );
		if( count( $pr_desc ) ):
			$list_desc .= '<ul class="pricing-features cx-bg-1 cx-border-1">';

			foreach( $pr_desc as $pr ):
					$list_desc .= '<li>'. $pr .' </li>';
			endforeach;

			$list_desc .= '</ul>';
		endif;
	endif;

	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="pricing-header cx-bg-0">
					<?php if( !empty( $price_title ) ): ?>
			        <div class="pricing-title"><?php echo esc_html( $price_title ); ?></div>
				    <?php endif; ?>
			        <?php if( $featured ): ?>
			        <span class="featured-ribbon"><?php echo esc_html( $featured_text ); ?></span>
				    <?php endif; ?>
			        <div class="pricing-amount-wrapper">
			        	<?php if( !empty( $price ) ): ?>
			        	<span class="pricing-amount"><?php echo esc_html( $price ); ?></span>
				        <?php endif; ?>
				        <?php if( !empty( $price_duration ) ): ?>
			        	<span class="pricing-duration"><?php echo esc_html( $price_duration ); ?></span>
			        	<?php endif; ?>
			        </div>
			    </div>

				<?php printf( '%s', $list_desc ); ?>

				<?php if( $btn_toggle ): ?>
			    <div class="pricing-button cx-bg-0 cx-color-0">
			    	<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>><?php if( !empty( $btn_text ) ): echo esc_html($btn_text); endif; ?></a>
			    </div>
				<?php endif; ?>
			</div>
		</div>


<?php

	$result .= ob_get_clean();
	return $result;

} //End cx_pricing_table


// Integrating Shortcode with King Composer
function cx_pricing_table_kc() {

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_pricing_table' => array(
					'name' => esc_html__( 'Codexin Pricing Table', 'codexin' ),
					'description' => esc_html__('Codexin Pricing Table', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',

					'params' => array(
						'general' => array(
							array(
								'name'			=> 'price_title',
								'label'			=> esc_html__( 'Enter Title', 'codexin' ),
								'type'			=> 'text',
								'admin_label'	=> true,
								'value'			=> 'Sample Title'
							),

							array(
								'name'			=> 'price',
								'label'			=> esc_html__( 'Enter Price Amount', 'codexin' ),
								'type'			=> 'text',
								'admin_label'	=> true,
								'value'			=> '$100'
							),

							array(
								'name'			=> 'price_duration',
								'label'			=> esc_html__( 'Enter Price Term', 'codexin' ),
								'type'			=> 'text',
								'value'			=> 'Per Month'
							),

							array(
								'name'			=> 'price_desc',
								'label'			=> esc_html__( 'Enter Pricing Details. Give Enter After Each Line. You can use HTML tags to highlight your texts', 'codexin' ),
								'type'			=> 'textarea',
								'value'			=> base64_encode("Fully Responsive \nClean Design \nTons of Features \nAwesome Shortcodes \nEasy to Customize")
							),

							array(
								'name'			=> 'featured',
								'label'			=> esc_html__( 'Enable Featured Ribbon', 'codexin' ),
								'type'			=> 'toggle',
								'value'			=> 'no',
							),

							array(
								'name'			=> 'featured_text',
								'label'			=> esc_html__( 'Enter Text for Ribbon', 'codexin' ),
								'type'			=> 'text',
	    						'relation' 		=> array(
	    							'parent'    => 'featured',
	    							'show_when' => 'yes',
    							),
								'value'			=> 'FEATURED',
							),

							array(
								'name'			=> 'btn_toggle',
								'label'			=> esc_html__( 'Enable Button?', 'codexin' ),
								'type'			=> 'toggle',
								'value'			=> 'yes',
							),

	    					array(
	    						'name'     		=> 'href',
	    						'label'    		=> esc_html__(' Custom URL', 'codexin'),
	    						'type'    		=> 'link',
	    						'relation' 		=> array(
	    							'parent'    => 'btn_toggle',
	    							'show_when' => 'yes',
    							),
	    						'value'    		=> '#',
	    						'description' 	=> esc_html__(' The URL which this button assigned to. You can select page/post or other post type', 'codexin')
    						),

							array(
								'name'			=> 'btn_text',
								'label'			=> esc_html__( 'Enter Button Text', 'codexin' ),
								'type'			=> 'text',
								'value'			=> 'Purchase'
							),

	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__(' Extra Class', 'codexin'),
	    						'type'			=> 'text'
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

										'Title-Header'	=> array(
	    									array('property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.pricing-header'),
	    									array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.pricing-header'),
	    									array('property' => 'height', 'label' => esc_html__('height', 'codexin'), 'selector' => '.pricing-header'),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-header'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-header'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-header'),
										),

										'Title'	=> array(
	    									array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-title'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-title'),
										),

										'Price-Wrapper'	=> array(
	    									array('property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'height', 'label' => esc_html__('height', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'position', 'label' => esc_html__('Positioning', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
										),

										'Price'	=> array(
											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-amount'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-amount'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-amount'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-amount'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-amount'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-amount'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-amount'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-amount'),
										),

										'Price-Term'	=> array(
											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-duration'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-duration'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-duration'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-duration'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-duration'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-duration'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-duration'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-duration'),
										),

										'Desc'	=> array(
											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-features li'),
											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.pricing-features li'),
											array('property' => 'background-color', 'label' => esc_html__('Background Color for Odd Elements', 'codexin'), 'selector' => '.pricing-features li:nth-of-type(2n+1)'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-features li'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-features li'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-features li'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-features li'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-features li'),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-features li'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-features li'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-features li'),
											array('property' => 'background-color', 'label' => esc_html__('Background Color of Wrapper', 'codexin'), 'selector' => '.pricing-features'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding of Wrapper', 'codexin'), 'selector' => '.pricing-features'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin of Wrapper', 'codexin'), 'selector' => '.pricing-features'),

										),

										'Ribbon'	=> array(
											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.featured-ribbon'),
											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.featured-ribbon'),
										),

										'Button'	=> array(
	    									array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.pricing-button a:hover'),
	    									array('property' => 'background-color', 'label' => esc_html__('Background Color on Hover', 'codexin'), 'selector' => '.pricing-button a:hover'),
											array('property' => 'border-color', 'label' => esc_html__('Border Color on Hover', 'codexin'), 'selector' => '.pricing-button a:hover'),
	    									array('property' => 'background-color', 'label' => esc_html__('Wrapper Background Color', 'codexin'), 'selector' => '.pricing-button'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-button a'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-button a'),
										),

	    								'Box'	=> array(
	    									array('property' => 'background', 'label' => esc_html__('Background', 'codexin')),
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin')),
	    									array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin')),
	    									array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin')),
	    									array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin')),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin')),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin')),
    									)

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

	            ),  // End of elemnt cx_pricing_table

			) //end of  array 

		);  //end of kc_add_map....

	} //End if

} // end of cx_pricing_table