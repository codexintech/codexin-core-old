<?php

/**
 * Shortcode -  Pricing Table
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );
	
// Registering Pricing Table Shortcode
function cx_pricing_table_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
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
	), $atts ) );

	$result = '';

	// Retrieving the url
	$retrieve_link 	= codexin_retrieve_url( $href );
	$title 			= ( $retrieve_link[1] ) ? 'title="'.esc_attr( $retrieve_link[1] ).'"':'';
	$target 		= ( $retrieve_link[2] ) ? 'target="'.esc_attr( $retrieve_link[2] ).'"':'';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-pricing-tables';

	// Retrieving user define classes
	$classes = array( 'pricing-table-single clearfix' );
	( ! empty( $class ) ) ? $classes[] = $class : '';

	ob_start(); 

	if ( !empty( $price_desc ) ) {
		$pr_desc = explode( "\n", $price_desc );
		if( count( $pr_desc ) ) {
			$list_desc .= '<ul class="pricing-features cx-bg-1 cx-border-1">';

			foreach( $pr_desc as $pr ) {
					$list_desc .= '<li>'. $pr .' </li>';
			}

			$list_desc .= '</ul>';
		}
	}

	echo '<div class="'. esc_attr( implode( ' ', $master_class ) ) .'">';
		echo '<div class="'. esc_attr( implode( ' ', $classes ) ) .'">';
			echo '<div class="pricing-header cx-bg-0">';
				echo ( !empty( $price_title ) ) ? '<div class="pricing-title">'. esc_html( $price_title ) .'</div>' : '';
				echo ( $featured ) ? '<span class="featured-ribbon">'. esc_html( $featured_text ) .'</span>' : '';
				echo '<div class="pricing-amount-wrapper">';
					echo ( ! empty( $price ) ) ? '<span class="pricing-amount">'. esc_html( $price ) .'</span>' : '';
					echo ( ! empty( $price_duration ) ) ? '<span class="pricing-duration">'. esc_html( $price_duration ) .'</span>' : '';
				echo '</div>';
			echo '</div>';
			echo sprintf( '%s', $list_desc );

			if( $btn_toggle ) {
				echo '<div class="pricing-button cx-bg-0 cx-color-0">';
					echo '<a href="'. esc_url( $retrieve_link[0] ) .'" '. $title .' '. $target .'>';
						echo ( ! empty( $btn_text ) ) ? esc_html( $btn_text ) : '';
					echo '</a>';
				echo '</div>';
			}

		echo '</div> <!-- end of pricing-table-single -->';
	echo '</div> <!-- end of cx-pricing-tables -->';

	$result .= ob_get_clean();
	return $result;

} //End cx_pricing_table


// Integrating Shortcode with King Composer
function cx_pricing_table_kc() {

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_pricing_table' => array(
					'name' 			=> esc_html__( 'Codexin Pricing Table', 'codexin' ),
					'description' 	=> esc_html__( 'Codexin Pricing Table', 'codexin' ),
					'icon' 			=> 'et-hazardous',
					'category' 		=> 'Codexin',

					'params' 		=> array(
						'general' 	=> array(
							array(
								'name'			=> 'price_title',
								'label'			=> esc_html__( 'Enter Title', 'codexin' ),
								'type'			=> 'text',
								'admin_label'	=> true,
								'value'			=> esc_html__( 'Sample Title', 'codexin' )
							),

							array(
								'name'			=> 'price',
								'label'			=> esc_html__( 'Enter Price Amount', 'codexin' ),
								'type'			=> 'text',
								'admin_label'	=> true,
								'value'			=> esc_html__( '$100', 'codexin' )
							),

							array(
								'name'			=> 'price_duration',
								'label'			=> esc_html__( 'Enter Price Term', 'codexin' ),
								'type'			=> 'text',
								'value'			=> esc_html__( 'Per Month', 'codexin' )
							),

							array(
								'name'			=> 'price_desc',
								'label'			=> esc_html__( 'Enter Pricing Details. Give Enter After Each Line. You can use HTML tags to highlight your texts', 'codexin' ),
								'type'			=> 'textarea',
								'value'			=> esc_html__( base64_encode( "Fully Responsive \nClean Design \nTons of Features \nAwesome Shortcodes \nEasy to Customize" ), 'codexin' )
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
								'value'			=> esc_html__( 'FEATURED', 'codexin' ),
							),

							array(
								'name'			=> 'btn_toggle',
								'label'			=> esc_html__( 'Enable Button?', 'codexin' ),
								'type'			=> 'toggle',
								'value'			=> 'yes',
							),

	    					array(
	    						'name'     		=> 'href',
	    						'label'    		=> esc_html__( 'Custom URL', 'codexin' ),
	    						'type'    		=> 'link',
	    						'relation' 		=> array(
	    							'parent'    => 'btn_toggle',
	    							'show_when' => 'yes',
    							),
	    						'value'    		=> '#',
	    						'description' 	=> esc_html__( 'The URL which this button assigned to. You can select page/post or other post type', 'codexin' )
    						),

							array(
								'name'			=> 'btn_text',
								'label'			=> esc_html__( 'Enter Button Text', 'codexin' ),
								'type'			=> 'text',
								'value'			=> esc_html__( 'Purchase', 'codexin' )
							),

	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
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

										esc_html__( 'Title-Header', 'codexin' )	=> array(
	    	 								array('property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.pricing-header'),
	    									array( 'property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.pricing-header'),
	    									array( 'property' => 'height', 'label' => esc_html__('height', 'codexin'), 'selector' => '.pricing-header'),
	    									array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-header'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-header'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-header'),
										),

										esc_html__( 'Title', 'codexin' )	=> array(
	    									array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-title'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-title'),
										),

										esc_html__( 'Price-Wrapper', 'codexin' )	=> array(
	    									array( 'property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'height', 'label' => esc_html__('height', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'position', 'label' => esc_html__('Positioning', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-amount-wrapper'),
										),

										esc_html__( 'Price', 'codexin' )	=> array(
											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-amount'),
	    									array( 'property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-amount'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-amount'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-amount'),
	    									array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-amount'),
	    									array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-amount'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-amount'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-amount'),
										),

										esc_html__( 'Price-Term', 'codexin' )	=> array(
											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-duration'),
	    									array( 'property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-duration'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-duration'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-duration'),
	    									array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-duration'),
	    									array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-duration'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-duration'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-duration'),
										),

										esc_html__( 'Desc', 'codexin' )	=> array(
											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-features li'),
											array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.pricing-features li'),
											array( 'property' => 'background-color', 'label' => esc_html__('Background Color for Odd Elements', 'codexin'), 'selector' => '.pricing-features li:nth-of-type(2n+1)'),
	    									array( 'property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-features li'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-features li'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-features li'),
	    									array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-features li'),
	    									array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-features li'),
	    									array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-features li'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-features li'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-features li'),
											array( 'property' => 'background-color', 'label' => esc_html__('Background Color of Wrapper', 'codexin'), 'selector' => '.pricing-features'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding of Wrapper', 'codexin'), 'selector' => '.pricing-features'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin of Wrapper', 'codexin'), 'selector' => '.pricing-features'),

										),

										esc_html__( 'Ribbon', 'codexin' )	=> array(
											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.featured-ribbon'),
											array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array( 'property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.featured-ribbon'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.featured-ribbon'),
										),

										esc_html__( 'Button', 'codexin' )	=> array(
	    									array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.pricing-button a:hover'),
	    									array( 'property' => 'background-color', 'label' => esc_html__('Background Color on Hover', 'codexin'), 'selector' => '.pricing-button a:hover'),
											array( 'property' => 'border-color', 'label' => esc_html__('Border Color on Hover', 'codexin'), 'selector' => '.pricing-button a:hover'),
	    									array( 'property' => 'background-color', 'label' => esc_html__('Wrapper Background Color', 'codexin'), 'selector' => '.pricing-button'),
	    									array( 'property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.pricing-button a'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.pricing-button a'),
										),

	    								esc_html__( 'Box', 'codexin' )	=> array(
	    									array( 'property' => 'background', 'label' => esc_html__('Background', 'codexin')),
	    									array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin')),
	    									array( 'property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin')),
	    									array( 'property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin')),
	    									array( 'property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin')),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin')),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin')),
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
			) //end of array 
		);  //end of kc_add_map....
	} //End if
} // end of cx_pricing_table_kc