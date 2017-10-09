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
			'order'				=> '',
			'orderby'			=> '',
			'show_author'		=> '',
			'show_meta'			=> '',
			'show_date'			=> '',
			'show_cat'			=> '',
			'show_comm'			=> '',
			'show_like'			=> '',
			'chr_length'		=> '',
			'title_length'		=> '',
			'desc_length'		=> '',
			'sticky_post'		=> '',
			'post_meta'			=> '',
			'read_more'			=> '',
			'readmore_txt'		=> '',
			'pagination_type'	=> '',
			'class'				=> ''
	), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-blog-standard';

    // Retrieving user define classes
    $classes = array( 'row' );
    (!empty($class)) ? $classes[] = $class : '';

	ob_start(); 

	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="blog-list-wrapper">
					<?php 
					//start query..
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array(
						'post_type'				=> 'post',
						'meta_key'				=> ( $orderby == 'meta_value_num' ) ? 'cx_post_views' : '',
						'order'					=> $order,
						'orderby'				=> $orderby,
						'paged'   				=> $paged,
						'ignore_sticky_posts' 	=> ( $sticky_post ) ? '' : 1,
					);

					$data = new WP_Query( $args );

					if( $data->have_posts() ) :

						while( $data->have_posts() ) : $data->the_post();

						// Retrieving Image alt tag
						$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

						// Assigning classed for post_class
						$post_classes = ($sticky_post && is_sticky()) ? 'sticky clearfix' : 'clearfix';

						// Retrieving User Meta Infos
						$show_metas = explode(',', $show_meta);
			            	
					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(array(esc_attr($post_classes))); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
						    <div class="post-wrapper">
					            <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="blog-media-wrapper">
					                <figure class="item-img-wrap" itemscope itemtype="http://schema.org/ImageObject">
					                    <img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'reveal-post-single' ) : '//placehold.it/750x332' ); ?>" class="img-responsive" <?php printf( '%s', $image_alt ); ?> itemprop="image">
					                    <div class="item-img-overlay">
					                        <span></span>
					                    </div>
					                </figure>                       
					            </a> <!-- end of blog-media-wrapper -->					            

								<?php if(in_array(true, array_values($show_metas))): ?>
					            <ul class="list-inline post-detail">

					            	<?php if(in_array('show_author', array_values($show_metas))): ?>
						                <li><i class="fa fa-pencil"></i> <span class="post-author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
						                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemprop="url" rel="author">
						                        <span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
						                    </a>
						                    </span>
						                </li>
						            <?php endif; ?>

									<?php if(in_array('show_date', array_values($show_metas))): ?>
						                <li><i class="fa fa-calendar"></i> <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>"><time datetime="<?php echo get_the_time('c'); ?>" itemprop="datePublished"><?php echo date( get_option('date_format'), strtotime( get_the_time( 'd M, Y' ) ) ); ?></time></a> </li>
									<?php endif; ?>
									
									<?php if(in_array('show_cat', array_values($show_metas))): ?>
						                <li><i class="fa fa-tag"></i> <span itemprop="genre"><?php the_category( ', ' )?></span></li>
						            <?php endif; ?>

									<?php if(in_array('show_comm', array_values($show_metas))): ?>
						                <li><i class="fa fa-comment"></i><?php comments_number( 'No Comments', 'One Comment', '% Comments' )?></li>
						            <?php endif; ?>

									<?php if(in_array('show_like', array_values($show_metas))): ?>
						                <li><?php if( function_exists( 'codexin_likes_button' ) ): echo codexin_likes_button( get_the_ID(), 0 ); endif; ?></li>
						            <?php endif; ?>

					            </ul> <!-- end of post-detail -->
						        <?php endif; ?>

						        <h2 class="post-title" itemprop="headline">
						            <a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" itemprop="url">
						                <span itemprop="name">
						                <?php 
						                    if( $chr_length ) :
						                    	if( function_exists('reveal_title') ):
							                        reveal_title( $title_length );
							                    endif;
						                    else:
						                        the_title();
						                    endif;
						                ?>
						                </span>
						            </a>
						        </h2>

	                			<div class="entry-content" itemprop="text">
					                <?php 
					                    if( $chr_length ) :
					                    	if( function_exists('reveal_excerpt') ):
						                        reveal_excerpt( $desc_length );
						                    endif;
					                    else:
					                        the_excerpt();
					                    endif;
					                ?>
					                <?php if( $read_more ): ?>
		                    			<p class="blog-more"><a class="cx-btn" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( !empty( $readmore_txt ) ? $readmore_txt : __('Read More', 'codexin') ); ?></a></p>
		                    		<?php endif; ?>
	                    		</div> <!-- end of entry-content -->
					        </div> <!-- end of post-wrapper -->
					    </article> <!-- #post-## -->
					    <div class="clearfix"></div>

						<?php 
						endwhile;
					endif;
					wp_reset_postdata();
					?>

				<?php 

		        // $prev_link = get_previous_posts_link(esc_html__('&laquo; Newer Posts', 'reveal'));
		        // $next_link = get_next_posts_link(esc_html__('Older Posts &raquo; ', 'reveal'), $data->max_num_pages );

		        // echo '<div class="posts-nav clearfix">';
		        //     if($next_link): 
		        //     echo '<div class="nav-next alignright">'. $next_link .'</div>';
		        //     endif; 
		            
		        //     if($prev_link): 
		        //     echo '<div class="nav-previous alignleft">'. $prev_link .'</div>';
		        //     endif; 
		        // echo '</div>';
				if( $pagination_type == 'numbered' ):
					if( function_exists('reveal_posts_link_numbered') ):
				        echo reveal_posts_link_numbered($data);
				    else:
				    	echo '<p class="cx-error">'.esc_html__('Please Activate \'REVEAL\' Theme!', 'reveal').'</p>';
				    endif;
			    elseif( $pagination_type == 'button' ):
			    	if( function_exists('reveal_posts_link') ):
				        reveal_posts_link('Newer Posts', 'Older Posts', $data);
				    else:
				    	echo '<p class="cx-error">'.esc_html__('Please Activate \'REVEAL\' Theme!', 'reveal').'</p>';
				    endif;
			    endif;

				 ?>
				</div> <!-- end of blog-list-wrapper -->
			</div> <!-- end of row -->
		</div> <!-- end of cx-blog-standard -->




	<?php
	$result .= ob_get_clean();
	return $result;
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
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__('Post Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__('Ascending', 'codexin'),
    								'DESC'	=> esc_html__('Descending', 'codexin'),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Posts:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__('Post Sorting Method', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => esc_html__('Date', 'codexin'),
    								'comment_count'	 => esc_html__('Number Of Comments', 'codexin'),
    								'meta_value_num' => esc_html__('Views Count', 'codexin'),
    								'rand'			 => esc_html__('Randomize', 'codexin'),
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Posts Sorting Method', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'sticky_post',
	    						'label'       	=> esc_html__('Show Sticky Post? ', 'codexin'),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Enable this if you want to show sticky post first.', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'checkbox',
	    						'name'			=> 'show_meta',
	    						'label'			=> esc_html__( 'Which Posts Meta You Want to Show? ', 'codexin' ),
	    						'value'			=> array('show_author', 'show_date', 'show_cat', 'show_comm', 'show_like'),
	    						'options'		=> array(
	    							'show_author' => esc_html__('Post Author Name', 'codexin'),
	    							'show_date'   => esc_html__('Post Published Date', 'codexin'),
	    							'show_cat'    => esc_html__('Post Categories', 'codexin'),
	    							'show_comm'   => esc_html__('Post Comments Number', 'codexin'),
	    							'show_like'   => esc_html__('Post Likes', 'codexin'),

	    						),
	    						'description'	=> esc_html__('Choose to enable/disable meta information', 'codexin'),
	    					),

	    					array(
	    						'name'        	=> 'chr_length',
	    						'label'       	=> esc_html__('Enable Blog Title and Excerpt Length? ', 'codexin'),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Select to enable/disable blog-title & excerpt length.', 'codexin' ),
	    					),

	    					array(
	    						'name'			=> 'title_length',
	    						'label'			=> esc_html__( 'Title Length (In Character)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '30',
    							'relation'	=> array(
    								'parent' 	=> 'chr_length',
    								'show_when'	=> 'yes',
    							),
	    						'description'	=> esc_html__('Specify number of Characters that you want to show in your title', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 10,
	    							'max'			=> 150,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
    						),

	    					array(
	    						'name'			=> 'desc_length',
	    						'label'			=> esc_html__( 'Excerpt Length (In Character)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '180',
    							'relation'	=> array(
    								'parent' 	=> 'chr_length',
    								'show_when'	=> 'yes',
    							),
	    						'description'	=> esc_html__('Specify number of Characters that you want to show in your excerpt', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 20,
	    							'max'			=> 500,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							),
    						),

	    					array(
	    						'name'        	=> 'read_more',
	    						'label'       	=> esc_html__('Enable Read More Button? ', 'codexin'),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'yes',
	    						'description'	=> esc_html__( 'Select to enable/disable Read More button.', 'codexin' ),
	    					),

	    					array(
	    						'name'			=> 'readmore_txt',
	    						'label' 		=> esc_html__( 'Button Text', 'codexin' ),
	    						'type'			=> 'text',
	    						'value' 		=> esc_html__( 'Read More', 'codexin' ),
    							'relation'		=> array(
    								'parent' 	=> 'read_more',
    								'show_when'	=> 'yes',
    							),
	    						'description' => esc_html__( 'Enter Button Text', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'pagination_type',
	    						'label'			=> esc_html__( 'Pagination Type', 'codexin' ),
	    						'value'			=> 'button',
	    						'options'		=> array(
	    							'button' 	=> esc_html__('Classic Next-Previous Button', 'codexin'),
	    							'numbered'  => esc_html__('Numbered Pagination', 'codexin'),
	    							'ajx_pagi'  => esc_html__('Ajax Pagination', 'codexin'),
	    						),
	    						'description'	=> esc_html__('Choose the Pagination Type.', 'codexin'),
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


