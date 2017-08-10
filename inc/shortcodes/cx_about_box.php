<?php


/*
    ======================================
        CODEXIN ABOUT BOX SHORTCODE
    ======================================
*/

// Registering About Box Shortcode
function cx_about_box_shortcode(  $atts, $content = null) {
   extract(shortcode_atts(array(
   			'image'	 			=> '',
   			'img_alt'		 	=> '',
   			'hover'  			=> '',
   			'icon_toggle'  		=> '',
   			'link_toggle'  		=> '',
   			'hover_icon'  		=> '',
   			'href'		  		=> '',
   			'img_action'  		=> '',
   			'class'				=> ''
	), $atts));

	$result = '';

	// Retrieving the image url
	$retrive_img_url = retrieve_img_src( $image, 'about-mini-image' );
	$ret_full_img_url = retrieve_img_src( $image, 'full' );

	// Retrieving the url
	$retrieve_link = retrieve_url( $href );

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'about-box';

	// Retrieving user define classes
	$classes = array( 'img-thumb' );
	(!empty($class)) ? $classes[] = $class : '';

	$title = ($retrieve_link[1]) ? 'title='.esc_attr($retrieve_link[1]):'';
	$target = ($retrieve_link[2]) ? 'target='.esc_attr($retrieve_link[2]):'';

   	ob_start(); ?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php if ( $img_action == 'open_custom_link' ): ?>
				<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>>
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
			</div><!-- end of img-thumb -->
		</div><!-- end of about-box -->

	<?php
	$result .= ob_get_clean();
	return $result;

} // end of cx_about_box

// Integrating Shortcode with King Composer
function cx_about_box_kc() {
	if (function_exists('kc_add_map')) { 
	    kc_add_map(
	    	array(
	    		'cx_about_box' 		=> array(
	    			'name' 			=> esc_html__( 'Codexin About Box', 'codexin' ),
	    			'description' 	=> esc_html__('Mini About Box', 'codexin'),
	    			'icon' 			=> 'kc-icon-feature-box',
	    			'category' 		=> 'Codexin',
	    			'params' 		=> array(
	    				// General Params
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
	    							''                 => esc_html__(' None', 'codexin'),
	    							'img_pop'          => esc_html__(' Open Image In Lightbox', 'codexin'),
	    							'open_custom_link' => esc_html__(' Open Custom Link', 'codexin')
	    							),
	    						'value'	  		=> '',
	    						'description' 	=> esc_html__(' Select the click event when users click on the image.', 'codexin')
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

	    								'Hover Text' => array(
	    									array('property' => 'color', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-content p'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-content p'),
    									),

	    								'Icon' 	=> array(
	    									array('property' => 'color', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.single-content i'),
	    									array('property' => 'background', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.single-content i'),
	    									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-content i'),
	    									array('property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.single-content i'),
	    									array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-content i'),
	    									array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.single-content i'),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-content i'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-content i')
    									),

	    								'Hover Border' => array(
	    									array('property' => 'border-color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
	    									array('property' => 'border-width', 'label' => esc_html__('Border Width', 'codexin'), 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after')
    									),

	    								'Box'	=> array(
	    									array('property' => 'border', 'label' => esc_html__('Border', 'codexin')),
	    									array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin')),
	    									array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '+.about-box'),
	    									array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin'), 'selector' => '+.about-box:hover'),
	    									array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '+.about-box'),
	    									array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin')),
	    									array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin')),
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
} // end of cx_about_box_kc


