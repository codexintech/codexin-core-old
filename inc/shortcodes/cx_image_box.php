<?php

/**
 * Shortcode -  Image Box
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Image Box Shortcode
function cx_image_box_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
		'image'	 			=> '',
		'img_alt'		 	=> '',
		'hover'  			=> '',
		'icon_toggle'  		=> '',
		'link_toggle'  		=> '',
		'hover_icon'  		=> '',
		'href'		  		=> '',
		'img_action'  		=> '',
		'class'				=> ''
	), $atts ) );

	$result = '';

	// Retrieving the image url
	$retrive_img_url 	= codexin_retrieve_img_src( $image, 'codexin-core-rectangle-one' );
	$ret_full_img_url 	= codexin_retrieve_img_src( $image, 'full' );

	// Retrieving the url
	$retrieve_link 		= codexin_retrieve_url( $href );

	// Assigning a master css class and hooking into KC
	$master_class 		= apply_filters( 'kc-el-class', $atts );
	$master_class[] 	= 'cx-image-box';

	// Retrieving user define classes
	$classes 			= array( 'img-thumb' );
	( ! empty( $class ) ) ? $classes[] = $class : '';

	$title 				= ( $retrieve_link[1] ) ? 'title="'. esc_attr( $retrieve_link[1] ) .'"':'';
	$target 			= ( $retrieve_link[2] ) ? 'target="'. esc_attr( $retrieve_link[2] ) .'"':'';

	// Retrieving image dimensions
	if( ! empty( $image ) ) {
		$image_size 	= getimagesize( $ret_full_img_url );
		$data_size 		= $image_size['0'] . 'x' . $image_size['1'];
	}

   	ob_start();

		echo '<div class="'. esc_attr( implode( ' ', $master_class ) ) .'">';
			echo '<div class="'. esc_attr( implode( ' ', $classes ) ) .'">';

				if( empty( $image ) ) {
				echo '<p class="cx-error">'. esc_html__( 'Please Upload Your Image', 'reveal' ).'</p>'; 
				} else {
					if ( $img_action == 'open_custom_link' ) {
						echo '<a href="'. esc_url( $retrieve_link[0] ) .'" '. $title.' '.$target.'>';
					} elseif ( $img_action == 'img_pop' ) {
						echo '<div class="image-pop-up item-img-wrap" itemscope itemtype="http://schema.org/ImageGallery">';
							echo '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
								echo '<a href="'. esc_url( $ret_full_img_url ) .'" itemprop="contentUrl" data-size="'. esc_attr( $data_size ) .'">';
					} else {
						echo '<div class="content-wrapper">';
					}

					echo '<img src="'. esc_url( $retrive_img_url ) .'" alt="'. esc_html( $img_alt ) .'" itemprop="image" />';
					echo '<div class="single-content-wrapper">';
						echo '<div class="single-content">';
							echo ( $icon_toggle ) ? '<i class="'. esc_attr( $hover_icon ) .'"></i>' : '';
							echo '<p class="h3">'. esc_html( $hover ) .'</p>';
						echo '</div>';
					echo '</div>';

					if ( $img_action == 'open_custom_link' ) {
						echo '</a>';
					} elseif ( $img_action == 'img_pop' ) {
								echo '</a>';
								echo '<figcaption itemprop="caption description">'. esc_html( $img_alt ) .'</figcaption>';
							echo '</figure>';
						echo '</div><!-- end of image-pop-up -->';
					} else {
						echo '</div><!-- end of content-wrapper -->';
					}
				}

			echo '</div><!-- end of img-thumb -->';
		echo '</div><!-- end of cx-image-box -->';

	$result .= ob_get_clean();
	return $result;

} // end of cx_image_box

// Integrating Shortcode with King Composer
function cx_image_box_kc() {
	if (function_exists('kc_add_map')) { 
	    kc_add_map(
	    	array(
	    		'cx_image_box' 		=> array(
	    			'name' 			=> esc_html__( 'Codexin Image Box', 'codexin' ),
	    			'description' 	=> esc_html__('Mini Image Box', 'codexin'),
	    			'icon' 			=> 'kc-icon-feature-box',
	    			'category' 		=> 'Codexin',
                	//Only load assets when using this element
					'assets' 		=> array(
						'scripts' 	=> array(
							'photswipe-script' => CODEXIN_CORE_ASSET_DIR . '/js/photoswipe.min.js',
							'photswipe-main-script' => CODEXIN_CORE_ASSET_DIR . '/js/photoswipe-main.js',
						),
		                // 'styles' 	=> array(
		            	   //  'photoswipe-stylesheet' => CODEXIN_CORE_ASSET_DIR . '/css/photoswipe.css',
		                // )
                	), //End assets

	    			'params' 		=> array(
	    				// General Params
	    				'general' 	=> array(
	    					array(
	    						'name'        	=> 'image',
	    						'label'       	=> esc_html__( 'Upload Image', 'codexin' ),
	    						'type'        	=> 'attach_image',
	    						'admin_label' 	=> true,
    						),

	    					array(
	    						'name' 			=> 'img_alt',
	    						'label' 		=> esc_html__( 'Enter Image Alt Tag', 'codexin' ),
	    						'type' 			=> 'text',
    						),

	    					array(
	    						'name' 			=> 'hover',
	    						'label' 		=> esc_html__( 'Text on Hover ', 'codexin' ),
	    						'type' 			=> 'text',
	    						'admin_label' 	=> true,
    						),

	    					array(
	    						'name' 			=> 'icon_toggle',
	    						'label' 		=> esc_html__( 'Enable Hover Icon? ', 'codexin' ),
	    						'type' 			=> 'toggle',
    						),

	    					array(
	    						'name' 			=> 'hover_icon',
	    						'label' 		=> esc_html__( 'Choose Hover Icon', 'codexin' ),
	    						'type' 			=> 'icon_picker',
	    						'relation' 		=> array(
	    							'parent'    => 'icon_toggle',
	    							'show_when' => 'yes',
    							),
    						),

	    					array(
	    						'name'    		=> 'img_action',
	    						'label'   		=> esc_html__(' On click event', 'codexin'),
	    						'type'    		=> 'select',
	    						'options' 		=> array(
	    							''                 => esc_html__( 'None', 'codexin' ),
	    							'img_pop'          => esc_html__( 'Open Image In Lightbox', 'codexin' ),
	    							'open_custom_link' => esc_html__( 'Open Custom Link', 'codexin' )
	    							),
	    						'value'	  		=> '',
	    						'description' 	=> esc_html__( 'Select the click event when users click on the image.', 'codexin' )
    						),

	    					array(
	    						'name'     		=> 'href',
	    						'label'    		=> esc_html__( 'Custom URL', 'codexin' ),
	    						'type'    		=> 'link',
	    						'relation' 		=> array(
	    							'parent'    => 'img_action',
	    							'show_when' => 'open_custom_link',
	    							),
	    						'value'    		=> '#',
	    						'description' 	=> esc_html__( 'The URL which this box assigned to. You can select page/post or other post type', 'codexin' )
    						),

	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
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

	    								esc_html__( 'Hover Text', 'codexin' ) => array(
	    									array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-content p'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-content p'),
    									),

	    								esc_html__( 'Icon', 'codexin' )	=> array(
	    									array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'background', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'height', 'label' => esc_html__('Height', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'border-radius', 'label' => esc_html__('Border radius', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-content i'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-content i')
    									),

	    								esc_html__( 'Hover Border', 'codexin' ) => array(
	    									array( 'property' => 'border-color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
	    									array( 'property' => 'border-width', 'label' => esc_html__('Border Width', 'codexin'), 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after')
    									),

	    								esc_html__( 'Overlay', 'codexin' ) => array(
	    									array( 'property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.img-thumb .content-wrapper, :hover .single-content-wrapper, .img-thumb a:hover .single-content-wrapper')
    									),

	    								esc_html__( 'Box', 'codexin' )	=> array(
	    									array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin')),
	    									array( 'property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '+.cx-image-box'),
	    									array( 'property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin'), 'selector' => '+.cx-image-box:hover'),
	    									array( 'property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '+.cx-image-box'),
	    									array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin')),
	    									array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin')),
    									)
    								)
    							)
    						)
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
} // end of cx_image_box_kc


