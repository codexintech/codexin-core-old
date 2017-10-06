<?php 


/*
    ================================
        CODEXIN BLOG SHORTCODE
    ================================
*/

// Registering Codexin Blog Shortcode
function cx_blog_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'layout'			=> '',
			'number_of_posts'	=> '',
			'order'				=> '',
			'orderby'			=> '',
			'exclude'			=> '',
			'show_date'			=> '',
			'title_length'		=> '',
			'desc_length'		=> '',
			'postview_comments'	=> '',
			'sticky_post'		=> '',
			'post_meta'			=> '',
			'readmore_text'		=> '',
			'class'				=> ''
	), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-blog';

    // Retrieving user define classes
    $classes = array( 'row' );
    (!empty($class)) ? $classes[] = $class : '';


	ob_start(); 



}



// Integrating Shortcode with King Composer
function cx_blog_kc() {

	$cx_categories = cx_get_post_categories();

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_blog' => array(
					'name' => esc_html__( 'Codexin Blog', 'codexin' ),
					'description' => esc_html__('Codexin Blog', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					'params' => array(
	    				// General Params
						'general' => array(
							array(
								'name'	=> 'layout',
								'lable'	=> esc_html__( 'Select Blog Post Template', 'codexin' ),
								'type'	=> 'radio_image',
								'options'	=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-1.jpg',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-2.jpg',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-3.jpg',
									'4'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-4.jpg',
								),
								'value'	=> '1',
								'admin_label'	=> true,
							),

							array(
	    						'name'        	=> 'number_of_posts',
	    						'label'       	=> esc_html__('Number Of Post to Display', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'2'	=> '2',
    								'3'	=> '3',
    								'4'	=> '4',
    							),
	    						'value'			=> '2',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2',
    							),
	    						'description'	=> esc_html__( 'Choose the number of posts you want to show.', 'codexin' ),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__('Post Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> 'Ascending',
    								'DESC'	=> 'Descending',
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Posts:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__('Post Sorting Method', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => 'Date',
    								'comment_count'	 => 'Number Of Comments',
    								'meta_value_num' => 'Views Count',
    								'rand'			 => 'Randomize',
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Posts Sorting Method', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'post_meta',
	    						'label'       	=> esc_html__('Post Meta to Show', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'view'		 => 'Number of Post Views',
    								'comment'	 => 'Number Of Comments',
    							),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '2',
    							),
	    						'value'			=> 'comment',
	    						'description'	=> esc_html__( 'Choose The Post Meta to Display', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'sticky_post',
	    						'label'       	=> esc_html__('Show Sticky Post? ', 'codexin'),
	    						'type'        	=> 'toggle',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '3',
    							),
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Enable this if you want to show sticky post first.', 'codexin' ),
	    					),

	 						array(
	 							'name' 			=> 'exclude',
	 							'label' 		=> esc_html__( 'Exclude Categories', 'codexin' ),
	 							'type' 			=> 'multiple',
	 							'options'		=> $cx_categories,
	 							'description'	=> esc_html__( 'Choose if You Want to Exclude Any Post Category, Control + Click to Select Multiple Categories to Exclude (No Categories are Excluded by Default)', 'codexin' ),
	 						),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_date',
	    						'label'			=> esc_html__( 'Show Post Pulbished Date?', 'codexin' ),
	    						'value'			=> 'yes',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2',
    							),
	    						'description'	=> esc_html__('Choose to enable/disable post published date', 'codexin'),
	    						'admin_label' => true
	    					),

	    					array(
	    						'name'			=> 'title_length',
	    						'label'			=> esc_html__( 'Title Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '4',
	    						'description'	=> esc_html__('Specify number of Words that you want to show in your title', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 3,
	    							'max'			=> 8,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
    						),

	    					array(
	    						'name'			=> 'desc_length',
	    						'label'			=> esc_html__( 'Excerpt Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '10',
	    						'description'	=> esc_html__('Specify number of Words that you want to show in your excerpt', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 10,
	    							'max'			=> 32,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2,3',
    							),
    						),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'postview_comments',
	    						'label'			=> esc_html__( 'Show Posts View & Comments Number?', 'codexin' ),
	    						'value'			=> 'yes',
	    						'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1',
    							),
	    						'description'	=> esc_html__('Displays the post views count and comments count', 'codexin'),
	    					),

	    					array(
	    						'name'	=> 'readmore_text',
	    						'label' => esc_html__( 'Read More Button Text', 'codexin' ),
	    						'type'	=> 'text',
	    						'value'	=> 'Read more',
	    						'description' => esc_html__( 'Edit the text that appears on the "Read more" button.', 'codexin' ),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2,3',
    							),
	    					),

	    					array(
	    						'name'	=> 'class',
	    						'label' => esc_html__( 'Extra Class', 'codexin' ),
	    						'type'	=> 'text',
	    						'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	    					),

						), //End general params
					
						// Style based Params
						'styling' => array(
 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										'Title' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-title a'),
 											array('property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.blog-title a:hover'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-title')
										),

 										'Date' => array(
 											array('property' => 'color', 'label' => esc_html__('Date Color', 'codexin'), 'selector' => 'div.meta, .date-time'),
 											array('property' => 'background-color', 'label' => esc_html__('Date Background', 'codexin'), 'selector' => 'div.meta, .date-time'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => 'div.meta, .date-time'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => 'div.meta, .date-time')
										),

 										'Icon' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),

 											array('property' => 'color', 'label' => esc_html__('Icon Color for Featured Post (For Layout-3)', 'codexin'), 'selector' => '.blog-footer-item i'),
 											array('property' => 'font-size', 'label' => esc_html__('Icon Font Size for Featured Post (For Layout-3)', 'codexin'), 'selector' => '.blog-footer-item i'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon')
										),

										'Image Hover' => array(
 											array('property' => 'background', 'label' => esc_html__('Image Hover Color', 'codexin'), 'selector' => '.img-wrapper::before, .img-wrapper::after, .blog-wrapper-left .img-thumb a:before, .blog-wrapper::after, .blog-wrapper-right .thumbnail-link:before' )
										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content .blog-desc, .blog-content .blog-category a, .blog-content .meta li, .blog-content .meta li a, .cx-count'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content .blog-desc')
										),

 										'Category' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.blog-category a:hover'),
 											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'background-color', 'label' => esc_html__('Background Color on Hover', 'codexin'), 'selector' => '.blog-category a:hover'),
 											array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'border-color', 'label' => esc_html__('Border Color on Hover', 'codexin'), 'selector' => '.blog-category a:hover'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-category a'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-category a')
										),

 										'Button' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'color', 'label' => esc_html__('Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array('property' => 'background-color', 'label' => esc_html__('Backgroung Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array('property' => 'background-color', 'label' => esc_html__('Border Bottom Color On Hover (For Layout-3)', 'codexin'), 'selector' => '.blog-wrapper-left .cx-blog-btn::before'),
 											array('property' => 'transition', 'label' => esc_html__('Hover Transition', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn')
										),
									) 
								) 
							) 
                		), //End styling array..

						// Animate Params
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						),//End animate
	                ) //End params array
	            ),  // End of cx_blog array
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_blog_kc


