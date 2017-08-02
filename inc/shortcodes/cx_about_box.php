<?php


	function cx_about_box_shortcode(  $atts, $content = null) {
	   extract(shortcode_atts(array(
	   			'image'	 			=> '',
	   			'img_alt'		 	=> '',
	   			'hover'  		=> '',
	   			'icon_toggle'  		=> '',
	   			'link_toggle'  		=> '',
	   			'hover_icon'  		=> '',
	   			'href'		  		=> '',
	   			'img_action'  		=> '',
	   			'class'				=> '',
	   			'img_class'			=> ''
		), $atts));

		$result = '';

		$retrive_img_url = retrieve_img_src( $image, 'about-mini-image' );
		$ret_full_img_url = retrieve_img_src( $image, 'full' );

		$retrieve_link = retrieve_url( $href );

		$master_class = apply_filters( 'kc-el-class', $atts );
		$master_class[] = 'about-box';

		$classes = array( 'img-thumb' );
		$img_classes = array();

		(!empty($class)) ? $classes[] = $class : '';
		(!empty($img_class)) ? $img_classes[] = $img_class : '';

	   	ob_start(); ?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php if ( $img_action == 'open_custom_link' ): ?>
					<a href="<?php echo esc_url($retrieve_link[0]); ?>" title="<?php echo esc_attr($retrieve_link[1]); ?>" target="<?php echo esc_attr($retrieve_link[2]); ?>">
					<?php elseif ( $img_action == 'img_pop' ): ?>
					<a href="<?php echo $ret_full_img_url; ?>" class="event-image-popup">
					<?php else: ?>
					<div class="content-wrapper">
					<?php endif; ?>
						<img src="<?php echo $retrive_img_url; ?>" alt="<?php echo $img_alt; ?>" />
						<div class="single-content-wrapper">
							<div class="single-content">

								<?php if( $icon_toggle ): ?>
								<i class="<?php echo esc_attr( $hover_icon ); ?>"></i>
								<?php endif; ?>
								
								<p><?php echo esc_html( $hover ); ?></p>
							</div>
						</div>
					<?php if ( $img_action == 'open_custom_link' || $img_action == 'img_pop' ): ?>
					</a>
					<?php else: ?>
					</div>
					<?php endif; ?>
				</div>
			</div>

		<?php
		$result .= ob_get_clean();
		return $result;

 }


	function cx_about_box_kc() {

		if (function_exists('kc_add_map')) 
		{ 
		    kc_add_map(
			    	array(

			    		'cx_about_box' 		=> array(
			    			'name' 			=> esc_html__( 'Codexin About Box', 'codexin' ),
			    			'description' 	=> esc_html__('Mini About Box', 'codexin'),
			    			'icon' 			=> 'kc-icon-feature-box',
			    			'category' 		=> 'Codexin',
			    			'params' 		=> array(
			    				'general' 	=> array(
			    					array(
			    						'name'        	=> 'image',
			    						'label'       	=> esc_html__(' Upload Image', 'codexin'),
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
			    						'value'			=> 'Sample Text',
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
			    						'value'			=> 'no'
			    						),

			    					array(
			    						'name'    		=> 'img_action',
			    						'label'   		=> esc_html__(' On click event', 'codexin'),
			    						'type'    		=> 'select',
			    						'options' 		=> array(
			    							''                 => esc_html__(' None', 'codexin'),
			    							'img_pop'          => esc_html__(' Open Image In Lightbox', 'codexin'),
			    							'open_custom_link' => esc_html__(' Open Custom Link', 'codexin')
			    							),
			    						'value'	  		=> '',
			    						'description' => esc_html__(' Select the click event when users click on the image.', 'codexin')
			    						),

			    					array(
			    						'name'     		=> 'href',
			    						'label'    		=> esc_html__(' Custom URL', 'codexin'),
			    						'type'    		=> 'link',
			    						'relation' 		=> array(
			    							'parent'    => 'img_action',
			    							'show_when' => 'open_custom_link',
			    							),
			    						'value'    		=> '#',
			    						'description' 	=> esc_html__(' The URL which this box assigned to. You can select page/post or other post type', 'codexin')
			    						),

			    					array(
			    						'name'			=> 'class',
			    						'label' 		=> __(' Extra Class', 'codexin'),
			    						'type'			=> 'text'
			    						),
			    					),

			    				'styling' => array(
			    					array(
			    						'name'    		=> 'codexin_css',
			    						'type'    		=> 'css',
			    						'options' 		=> array(
			    							array(
			    								"screens" => "any,1199,991,767,479",

			    								'Hover Text' => array(
			    									array('property' => 'color', 'label' => 'Label Color', 'selector' => '.single-content p'),
			    									array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.single-content p'),
			    									array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-content p'),
			    									array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.single-content p'),
			    									array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.single-content p'),
			    									array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-content p'),
			    									array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.single-content p'),
			    									array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-content p'),
			    									array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-content p'),
			    									),

			    								'Icon' => array(
			    									array('property' => 'color', 'label' => 'Label Color', 'selector' => '.single-content i'),
			    									array('property' => 'background', 'label' => 'Label Color', 'selector' => '.single-content i'),
			    									array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-content i'),
			    									array('property' => 'display', 'label' => 'Display', 'selector' => '.single-content i'),
			    									array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-content i'),
			    									array('property' => 'width', 'label' => 'Width', 'selector' => '.single-content i'),
			    									array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-content i'),
			    									array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-content i')
			    									),

			    								'Hover Border' => array(
			    									array('property' => 'border-color', 'label' => 'Color', 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
			    									array('property' => 'border-width', 'label' => 'Border Width', 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
			    									array('property' => 'margin', 'label' => 'Margin', 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after')
			    									),

			    								'Box'	=> array(
			    									array('property' => 'border', 'label' => 'Border'),
			    									array('property' => 'border-radius', 'label' => 'Border Radius'),
			    									array('property' => 'box-shadow', 'label' => 'Box Shadow', 'selector' => '+.about-box'),
			    									array('property' => 'box-shadow', 'label' => 'Box Shadow on Hover', 'selector' => '+.about-box:hover'),
			    									array('property' => 'transition', 'label' => 'Hover Transition Animation', 'selector' => '+.about-box'),
			    									array('property' => 'margin', 'label' => 'Margin'),
			    									array('property' => 'padding', 'label' => 'Padding'),
			    									)									
			    								)
			    							)
			    						)
			    					),

			    				'animate' => array(
			    					array(
			    						'name'    		=> 'animate',
			    						'type'    		=> 'animate'
			    						)
			    					),
			    				)
				            ),  // End of elemnt cx_about_box
		            

					) //end of  array 


			    );  //end of kc_add_map....

			} //End if

	} // end of cx_section_heading_kc


