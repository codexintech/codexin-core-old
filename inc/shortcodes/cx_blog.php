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
			'readmore_text'		=> '',
			'class'				=> ''
	), $atts));

	$result = '';

	ob_start(); 

	if( ! empty( $layout ) ) :
   		if( $layout == 1 ) :
   		// Assigning a master css class and hooking into KC
	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'cx-blog';

	   // Retrieving user define classes
	   $classes = array( 'row' );
   	   (!empty($class)) ? $classes[] = $class : '';		
	?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<?php

				$cat_exclude = str_replace(',', ' ', $exclude);
				$cat_excludes = explode( " ", $cat_exclude );

				//start query..
				$args = array(
						'post_type'				=> 'post',
						'posts_per_page'		=> $number_of_posts,
						'post_status'			=> 'publish',
						'order'					=> $order,
						'orderby'				=> $orderby,
						'category__not_in' 		=> $cat_excludes,
						'ignore_sticky_posts' 	=> 1
					);

				// var_dump($args);

				$data = new WP_Query( $args );

				if( $data->have_posts() ) :

					while( $data->have_posts() ) : $data->the_post();
					$column = 12/$number_of_posts;

					// Retrieving Image alt tag
					$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

				 ?>
					<div class="col-md-<?php echo $column ?> col-sm-12">
						<div class="blog-wrapper">
							<div class="img-thumb">
								<a href="<?php esc_url( the_permalink() ); ?>">
									<div class="img-wrapper">
										<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rectangle-one' ) : '//placehold.it/600x400' ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
									</div>
								</a>
								<?php if( $show_date ) : ?>
								<div class="meta">
									<p><?php echo get_the_time( 'd' ); ?></p>
									<p><?php echo get_the_time( 'M' ); ?></p>
								</div>
								<?php endif; ?>
							</div> <!-- End of img-thumb -->

							<div class="blog-content">
								<p class="blog-title">
									<?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?>
								</p>
								<p class="blog-desc"> 
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
								</p>
								<a class="read-more" href="<?php echo esc_url( get_the_permalink() ); ?>">
									<?php echo esc_html( !empty( $readmore_text ) ? $readmore_text : __('Read More', 'codexin') ); ?>
								</a>
							</div>
						<?php
							if( $postview_comments ) : ?>
							<div class="blog-info">
								<?php
								$order_cpv = 'meta_value_num';
								$order_com = 'comment_count';
								if( $orderby == $order_cpv ) : 
								?>
								<span>
									<i class="fa fa-eye"></i> <i>
										<?php echo codexin_get_post_views(get_the_ID()); ?>
									</i>
								</span>
								<span> 											
									<i class="fa fa-comments"></i> <i>
										<?php comments_number('0', '1', '%'); ?>	
									</i>
								</span>
								<?php elseif( $orderby == $order_com ) : ?>
								<span> 											
									<i class="fa fa-comments"></i> <i>
										<?php comments_number('0', '1', '%'); ?>	
									</i>
								</span>
								<span>
									<i class="fa fa-eye"></i> <i>
										<?php echo codexin_get_post_views(get_the_ID()); ?>
									</i>
								</span>
								<?php else : ?>
								<span>
									<i class="fa fa-eye"></i> <i>
										<?php echo codexin_get_post_views(get_the_ID()); ?>
									</i>
								</span>
								<span> 											
									<i class="fa fa-comments"></i> <i>
										<?php comments_number('0', '1', '%'); ?>	
									</i>
								</span>
							<?php endif; ?>	

							</div><!-- end of blog-info -->

						<?php endif; //End postview_comments if ?>

						</div><!--end of blog-wrapper -->
					</div> <!-- end of col -->
					<?php

					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</div> <!-- end of row -->
		</div> <!-- end of cx-blog -->

		<div class="clearfix"></div>

	<?php endif; //End Layout - 1

		 if( $layout == 2 ) :
		 // Assigning a master css class and hooking into KC
	     $master_class = apply_filters( 'kc-el-class', $atts );
	     $master_class[] = 'letest-post mrg-t-50';

	    // Retrieving user define classes
	    $classes = array( 'rv2-blog-container' );
   	    (!empty($class)) ? $classes[] = $class : '';		
	?>
			<div id="letest_post" class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="blog-row-rv2">
						<?php 
						//start query..
						$args = array(
							'post_type'				=> 'post',
							'posts_per_page'		=> $number_of_posts,
							'order'					=> $order,
							'orderby'				=> $orderby,
							'meta_key'				=> 'cx_post_views',
							'ignore_sticky_posts' 	=> 1
							);

						$data = new WP_Query( $args );

						if( $data->have_posts() ) :

							while( $data->have_posts() ) : $data->the_post();
							$column = 12/$number_of_posts;

							// Retrieving Image alt tag
							$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

						?>
						<div class="col-md-<?php echo $column ?> col-sm-12">
							<div class="rv2-single-post">
								<div class="post-img">
									<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rv2-blog-mini-img' ) : '//placehold.it/360x282' ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
									<a href="<?php the_permalink(); ?>" class="btn-white btn-rv">
										<?php echo esc_html( !empty( $readmore_text ) ? $readmore_text : __('Read More', 'codexin') ); ?>
									</a>
									<?php if( $show_date ) : ?>
										<span class="date-time"> <?php the_time( 'd M' ); ?> </span>
									<?php endif; ?>
								</div>
								<div class="post-info">
									<h3 class="title-3">
										<?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?>
									</h3>
									<p class="rv2-post-category"> <?php the_category( ' ' ); ?> </p>
									<ul>
										<li><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo esc_url(get_the_author_meta()); ?>"> <?php the_author(); ?> </a> </li>
										<li><i class="fa fa-paper-plane" aria-hidden="true"></i> <a href=""> 
										<?php comments_number('0', '1', '%'); ?> </a> </li>
										<li><?php if( function_exists( 'codexin_likes_button' ) ): echo codexin_likes_button( get_the_ID(), 0 ); endif; ?></li>
									</ul>
								</div>
								<p>
								<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
								</p>
							</div>
						</div>
						<?php

						endwhile;
						endif;
						wp_reset_postdata();
						?>
					</div> <!-- end of blog-row-rv2 -->
				</div> <!-- end of rv2-blog-container -->
			</div> <!-- end of letest-post -->
			<div class="clearfix"></div>

	<?php endif; //End Layout - 2 ?>
			
	<?php
	endif;
	$result .= ob_get_clean();
	return $result;

} //End of cx_blog

/**
 *
 * Helper function to fetch all post categories
 *
 */  
function cx_get_post_categories() {

	$categories = get_categories( array(
	    'orderby' => 'name',
	    'order'   => 'ASC'
	) );

	$post_cat = array();
	if ( $categories ) {		

		foreach ( $categories as $value ) {
			$post_cat[$value->term_id] = ucfirst( $value->name ) . ' (Posts Count: '. $value->category_count .')';
		}

	} else {

		$post_cat[0] = __( 'No Categories found', 'codexin' );

	}

	return $post_cat;


} //End cx_get_post_categories()..

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
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/layout-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/layout-2.png',
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
	    						'value'			=> '3',
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
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1',
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Posts Sorting Method:', 'codexin' ),
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
    							)
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
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-title, .rv2-single-post .title-3')
										),

 										'Date' => array(
 											array('property' => 'color', 'label' => esc_html__('Date Color', 'codexin'), 'selector' => '.meta, .date-time'),
 											array('property' => 'background-color', 'label' => esc_html__('Date Background', 'codexin'), 'selector' => '.meta, .date-time'),
 											// array('property' => 'color', 'label' => esc_html__('Post Meta Icon Color', 'codexin'), 'selector' => '.blog-info i, .rv2-single-post ul li a, .cx-count, .rv2-post-category a' ),
 											// array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a'),
 											// array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a'),
 											// array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a'),
 											// array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a'),
 											// array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a'),
 											// array('property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.meta, .rv2-single-post ul li a, .cx-count, .rv2-post-category a')
										),

										'Image Hover' => array(
 											array('property' => 'background', 'label' => esc_html__('Image Hover Color', 'codexin'), 'selector' => '.img-wrapper::before, .img-wrapper::after' )
										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content .blog-desc, .rv2-single-post p'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content .blog-desc, .rv2-single-post p'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content .blog-desc, .rv2-single-post p'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content .blog-desc, .rv2-single-post p'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content .blog-desc, .rv2-single-post p'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content .blog-desc, .rv2-single-post p'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content .blog-desc, .rv2-single-post p')
										),

 										'Read More' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'color', 'label' => esc_html__('Hover Color', 'codexin'), 'selector' => '.blog-content a:hover, .btn-white:hover'),
 											array('property' => 'background-color', 'label' => esc_html__('Backgroung Hover Color', 'codexin'), 'selector' => '.blog-content a:hover, .btn-white:hover'),
 											array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'codexin'), 'selector' => '.blog-content a:hover, .btn-white:hover'),
 											array('property' => 'transition', 'label' => esc_html__('Hover Transition', 'codexin'), 'selector' => '.blog-content a:hover, .btn-white:hover'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content a, .btn-white'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content a, .btn-white')
										),

 									// 	'Box'	=> array(
 									// 		array('property' => 'background'),
 									// 		array('property' => 'background-color', 'label' => esc_html__( 'BG Color On Hover' ), 'selector' => '.rv2-single-post:hover .post-img:before' ),
 									// 		array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
 									// 		array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin') ),
 									// 		array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin') ),
 									// 		array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
 									// 		array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
										// ),



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


