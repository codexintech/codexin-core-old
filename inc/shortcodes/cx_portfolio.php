<?php 


/*
    ================================
        CODEXIN PORTFOLIO SHORTCODE
    ================================
*/

// Registering Codexin Portfolio Shortcode
function cx_portfolio_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'layout'			=> '',
			'grid_col'			=> '',
			'order'				=> '',
			'orderby'			=> '',
			'include'			=> '',
			'chr_length'		=> '',
			'title_length'		=> '',
			'desc_length'		=> '',
			'read_more'			=> '',
			'readmore_txt'		=> '',
			'pagination_type'	=> '',
			'class'				=> ''
	), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-portfolio-standard';

    // Retrieving user define classes
    $classes = array( ($layout == 'grid') ? 'portfolio-grid-wrapper' : 'portfolio-list-wrapper' );
    (!empty($class)) ? $classes[] = $class : '';

	// Extracting user included categories
	$cat_include = str_replace(',', ' ', $include);
	$cat_includes = explode( " ", $cat_include );

	ob_start(); 

	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php 

				echo ($layout == 'grid') ? '<div class="row">' : '';
				//start query..
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

				if( empty($include) ):
					$args = array(
						'post_type'				=> 'portfolio',
						'order'					=> $order,
						'orderby'				=> $orderby,
						'paged'   				=> $paged,
					);

				else:
					$args = array(
						'post_type'				=> 'portfolio',
						'order'					=> $order,
						'orderby'				=> $orderby,
						'paged'   				=> $paged,
					    'tax_query' 			=> array(
					        array(
					            'taxonomy' => 'portfolio-category',
					            'field'    => 'term_id',
					            'terms'    => $cat_includes,
					        ),
					    ),
					);
				endif;

				$data = new WP_Query( $args );

				if( $data->have_posts() ) :
					$i = 0;
					echo '<div class="portfolio-archive-wrapper clearfix">';

					while( $data->have_posts() ) : $data->the_post();
						$i++;

						// Retrieving Image alt tag
						$image_alt = ( !empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

						// Assigning classed for post_class
						$post_classes = ($layout == 'list') ? 'clearfix portfolio-list' : '';

						// layout
						if( $layout == 'grid' ):
							$grid_columns = 12/$grid_col;
							printf('<div class="portfolio-single-wrap col-lg-%1$s col-md-%1$s col-sm-12">', $grid_columns);
						endif;

						// Retrieving the Lists of custom taxonomy for the specific ID
						$port_list = get_the_term_list( $data->ID, 'portfolio-category', '', ', ', '' );

						// Retrieving Values from the Metaboxes
						$p_date = strtotime(rwmb_meta('reveal_portfolio_date', 'type=date'));
						$port_date=date( get_option('date_format'), $p_date );
			            	
					?>
						<article id="event-<?php esc_attr(the_ID()); ?>" <?php post_class(array(esc_attr($post_classes))); ?> itemscope itemtype="http://schema.org/Event">
						    <div class="<?php echo ($layout == 'grid') ? 'portfolio-item-content' : 'post-wrapper reveal-border-1'; ?>">
						    	<?php echo ($layout == 'list') ? '<div class="port-list-wrapper reveal-bg-2">' : '' ?>
						    		<?php if( $layout == 'list' ): ?>
						                <div class="thumb-port" style="background-image:url('<?php if(has_post_thumbnail()): esc_url(the_post_thumbnail_url('codexin-framework-rectangle-one')); else: echo '//placehold.it/600X375'; endif; ?>');">
						                    <a href="<?php echo esc_url(get_the_permalink()); ?>"></a>
						                    <?php if( !empty($port_date) ): ?>
							                    <div class="port-date reveal-bg-2"><p><?php echo esc_html($port_date); ?></p></div>
							                <?php endif; ?>
						                </div> <!-- end of thumb-port -->
						            <?php else: ?>
									    <div class="item-thumbnail">
									        <img src="<?php if(has_post_thumbnail()): esc_url(the_post_thumbnail_url('codexin-core-rectangle-one')); else: echo '//placehold.it/600X400'; endif; ?>"  alt="<?php echo esc_attr($image_alt); ?>">
									        <ul class="portfolio-action-btn reveal-color-0">
									            <li>
									                <a class="venobox" href="<?php echo esc_url(get_the_permalink()); ?>" itemprop="url"><i class="flaticon-link"></i></a>
									            </li>
									        </ul>                                            
									    </div> <!-- end of item-thumbnail -->
								    <?php endif; ?>

						            <div class="<?php echo ($layout == 'list') ? 'desc-port' : 'portfolio-description' ?>">
						            	<?php 
						            	if( $layout == 'list' ):
							            	if(!empty($port_list)): ?>
								                <p class="list-tag reveal-color-0"><i class="flaticon-bookmark"></i> 
								                <?php 
								                   printf( '%s', $port_list );
								                ?>
								                </p>
								            <?php 
							        		endif;
							            endif;
							            echo ( $layout == 'list' ) ? '<h2 class="post-title" itemprop="name">' : '<h4 itemprop="name">';
						                
						                ?>
							                <a href="<?php echo esc_url(get_the_permalink()); ?>" itemprop="url">							                    
								                <?php
							                    if( $chr_length ) :
							                    	if( function_exists('codexin_char_limit') ):
								                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
												    else:
												    	echo '<p class="cx-error">'.esc_html__('Please Activate \'REVEAL\' Theme!', 'codexin').'</p>';
								                    endif;
							                    else:
							                        the_title();
							                    endif;
								                ?>
						                	</a>
						            	<?php echo ( $layout == 'list' ) ? '</h2>' : '</h4>'; 
						            	if( ($layout == 'grid') && !empty($port_list) ): ?>
											<ul class="portfolio-cat reveal-color-0">
												<?php printf('%s', get_the_term_list( $data->ID, 'portfolio-category', '<li>', ', </li><li>', '</li>' ) ); ?>
											</ul>
								        <?php endif; 
						                if ($layout == 'list'): 
						                	echo '<div class="list-content">'; 
							                    if( $chr_length ) :
							                    	if( function_exists('codexin_char_limit') ):
								                        echo apply_filters( 'the_content', codexin_char_limit( $desc_length, 'excerpt' ) );
												    else:
												    	echo '<p class="cx-error">'.esc_html__('Please Activate \'REVEAL\' Theme!', 'codexin').'</p>';
								                    endif;
							                    else:
							                        the_excerpt();
							                    endif;
						                endif;
						                ?>
						                </div> <!-- end of <?php echo ($layout == 'grid') ? 'portfolio-description' : 'list-content'; ?> -->
										<?php if( ($layout == 'list') && $read_more ): ?>
							                <div class="cx-btn reveal-color-0 reveal-primary-btn">
							                	<a class="cx-btn-text" href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html( !empty( $readmore_txt ) ? $readmore_txt : __('Read More', 'codexin') ); ?></a>
							                </div>
							            <?php endif; ?>
						            <?php echo ($layout == 'list') ? '</div> <!-- end of desc-portfolio -->' : ''; ?>
								<?php echo ($layout == 'list') ? '</div> <!-- end of event-list-wrapper -->' : '' ?>
					        </div> <!-- end of <?php echo ($layout == 'grid') ? 'portfolio-item-content' : 'post-wrapper'; ?> -->
					    </article> <!-- #event-## -->
					    <?php 
					    if( $layout == 'grid' ):
		                    echo '</div><!-- end of portfolio-single-wrap -->';

		                    if( $i % $grid_col == 0 ):
		                        echo '<div class="clearfix"></div>';
		                    endif;
		                endif;

					endwhile;
					echo '</div><!-- end of portfolio-archive-wrapper -->';
				endif;
				wp_reset_postdata();
				?>

				<?php 
				echo '<div class="clearfix"></div>';
				echo ( $layout == 'grid' ) ? '<div class="col-xs-12">' : '' ;
				if( $pagination_type == 'numbered' ):
					if( function_exists( 'codexin_numbered_posts_nav' ) ):
				        echo codexin_numbered_posts_nav( $data );
				    else:
				    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
				    endif;
				elseif( $pagination_type == 'button' ):
			    	if( function_exists( 'codexin_posts_link' ) ):
				        codexin_posts_link( 'Newer Portfolios', 'Older Portfolios', $data );
				    else:
				    	echo '<p class="cx-error">'.esc_html__('Please Activate \'REVEAL\' Theme!', 'codexin').'</p>';
				    endif;
				endif;
			    echo ($layout == 'grid') ? '</div></div> <!-- end of row -->' : '';
				?>
			</div> <!-- end of <?php echo ($layout == 'grid') ? 'portfolio-grid-wrapper' : 'portfolio-list-wrapper'; ?> -->
		</div> <!-- end of cx-portfolio-standard -->




	<?php
	$result .= ob_get_clean();
	return $result;
}



// Integrating Shortcode with King Composer
function cx_portfolio_kc() {

	$cx_portfolio_categories = codexin_get_custom_categories('portfolio-category');

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_portfolio' => array(
					'name' => esc_html__( 'Codexin Portfolio', 'codexin' ),
					'description' => esc_html__('Codexin Portfolio', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					'params' => array(
	    				// General Params
						'general' => array(

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'layout',
	    						'label'			=> esc_html__( 'Select Layout', 'codexin' ),
	    						'value'			=> 'list',
	    						'options'		=> array(
	    							'list' 		=> esc_html__('List View', 'codexin'),
	    							'grid'	    => esc_html__('Grid View', 'codexin'),
	    						),
	    						'description'	=> esc_html__('Choose the Portfolio View.', 'codexin'),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'grid_col',
	    						'label'			=> esc_html__( 'Number of Column', 'codexin' ),
	    						'value'			=> '3',
	    						'options'		=> array(
	    							'2' 		=> esc_html__('2', 'codexin'),
	    							'3'		    => esc_html__('3', 'codexin'),
	    							'4'		    => esc_html__('4', 'codexin'),
	    						),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> 'grid',
    							),
	    						'description'	=> esc_html__('Choose the number of column to display Portfolio.', 'codexin'),
	    					),

	    					array(
	    						'name'        	=> 'chr_length',
	    						'label'       	=> esc_html__('Enable Portfolio Title and Excerpt Length? ', 'codexin'),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Select to enable/disable portfolio-title & excerpt length.', 'codexin' ),
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
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> 'list',
    							),
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

	    				// Advanced Params
						'advanced' => array(

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__('Portfolio Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__('Ascending', 'codexin'),
    								'DESC'	=> esc_html__('Descending', 'codexin'),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Portfolio:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__('Portfolio Sorting Method', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'	 		 => esc_html__('Date', 'codexin'),
    								'name'			 => esc_html__('Name', 'codexin'),
    								'rand'			 => esc_html__('Randomize', 'codexin'),
    							),
	    						'value'			=> 'meta_value',
	    						'description'	=> esc_html__( 'Choose The Portfolio Sorting Method', 'codexin' ),
	    					),

	 						array(
	 							'name' 			=> 'include',
	 							'label' 		=> esc_html__( 'Filter Portfolio Categories', 'codexin' ),
	 							'type' 			=> 'multiple',
	 							'options'		=> $cx_portfolio_categories,
	 							'description'	=> esc_html__( 'Choose if You Want to Show Any Specific Portfolio Category/Categories, Control + Click to Select Multiple Categories to Filter (All Categories will be shown by Default)', 'codexin' ),
	 						),

    					),


	                ) //End params array
	            ),  // End of cx_portfolio array
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_portfolio_kc


