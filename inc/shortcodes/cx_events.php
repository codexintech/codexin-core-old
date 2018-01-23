<?php

/**
 * Shortcode -  Events
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Events Shortcode
function cx_events_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
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
	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-events-standard';

    // Retrieving user define classes
    $classes = array( 'events-content-wrapper' );
    ( ! empty( $class ) ) ? $classes[] = $class : '';

	// Extracting user included categories
	$cat_include 	= str_replace( ',', ' ', $include );
	$cat_includes 	= explode( " ", $cat_include );

	ob_start(); 

	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="<?php echo ( $layout == 'grid' ) ? 'events-grid-wrapper' : 'events-list-wrapper' ?>">
					<?php 

					echo ( $layout == 'grid' ) ? '<div class="row">' : '';
					//start query..
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

					$args = array(
						'post_type'				=> 'events',
						'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
						'order'					=> $order,
						'orderby'				=> $orderby,
						'paged'   				=> $paged,
					);


				    if( ! empty( $include ) ) {
				        $args['tax_query'] = array(
					        array(
					            'taxonomy' => 'events-category',
					            'field'    => 'term_id',
					            'terms'    => $cat_includes,
					        ),
			            );
				    }

					$data = new WP_Query( $args );

					if( $data->have_posts() ) {
						$i = 0;
						echo '<div class="events-archive-wrapper clearfix">';

						while( $data->have_posts() ) {
						 	$data->the_post();
							$i++;

							// Retrieving Image alt tag
							$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

							// Assigning classed for post_class
							$post_classes = ( $layout == 'list' ) ? 'clearfix events-list' : '';

							// layout
							if( $layout == 'grid' ) {
								$grid_columns = 12 / $grid_col;
								printf( '<div class="events-single-wrap col-lg-%1$s col-md-%1$s col-sm-12">', $grid_columns );
							}

							// Retrieving Values from the Metaboxes
							$e_start_date 	= strtotime( rwmb_meta( 'reveal_event_start_date', 'type=date' ) );
							$e_end_date 	= rwmb_meta( 'reveal_event_end_date', 'type=date' );
							$e_start_time 	= rwmb_meta( 'reveal_event_start_time', 'type=time' );
							$e_end_time 	= rwmb_meta( 'reveal_event_end_time', 'type=time' );
							$e_st_date 		= date( get_option( 'date_format' ), $e_start_date );

							$thumbnail_size = ( $layout == 'list' ) ? 'codexin-framework-rectangle-one' : 'codexin-core-rectangle-four';

							if( function_exists( 'codexin_attachment_metas_extended' ) ) {
								$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'events', $thumbnail_size )['src'];
							} else {
								$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X375';
							}
				            	
						?>
							<article id="event-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( array( esc_attr( $post_classes ) ) ); ?> itemscope itemtype="http://schema.org/Event">
							    <div class="<?php echo ( $layout == 'grid' ) ? esc_attr( 'events-item-content' ) : esc_attr( 'post-wrapper reveal-border-1' ); ?>">
							    	<?php echo ( $layout == 'list' ) ? '<div class="event-list-wrapper reveal-bg-2">' : '' ?>
							    		<?php if( $layout == 'list' ) { ?>
							                <div class="thumb-events" style="background-image: url('<?php echo esc_url( $post_thumbnail ); ?>');">
							                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"></a>
							                    <?php if( ! empty( $e_st_date ) ) { ?>
								                    <div class="events-date reveal-bg-2"><p><?php echo esc_html( $e_st_date ); ?></p></div>
								                <?php } ?>
							                </div>
							            <?php } else { ?>
										    <div class="item-thumbnail">
										        <img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">                                          
										        <ul class="events-action-btn reveal-color-0">
										            <li>
										                <a class="venobox" href="<?php echo esc_url(get_the_permalink()); ?>" itemprop="url"><i class="flaticon-link"></i></a>
										            </li>
										        </ul>                                            
										    </div>
									    <?php } ?>

							            <div class="<?php echo ( $layout == 'list' ) ? esc_attr( 'desc-events' ) : esc_attr( 'events-description' ); ?>">
							            	<?php 
							            	if( $layout == 'list' ) {
								            	$event_list = get_the_term_list( $data->ID, 'events-category', '', ', ', '' );
								            	if( ! empty( $event_list ) ) { ?>
									                <p class="list-tag reveal-color-0"><i class="flaticon-bookmark"></i> 
									                <?php 
									                   printf( '%s', $event_list );
									                ?>
									                </p>
									            <?php 
								        		}
								            }
								            echo ( $layout == 'list' ) ? '<h2 class="post-title" itemprop="name">' : '<h4 itemprop="name">';
							                
							                ?>
								                <a href="<?php echo esc_url( get_the_permalink() ); ?>" itemprop="url">							                    
									                <?php
								                    if( $chr_length ) {
								                    	if( function_exists( 'codexin_char_limit' ) ) {
									                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
								                    	} else {
													    	echo '<p class="cx-error">'. esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ) .'</p>';
								                    	}
								                    } else {
								                        the_title();
								                    }
									                ?>
							                	</a>
							            	<?php echo ( $layout == 'list' ) ? '</h2>' : '</h4>'; 
							            	if( ( $layout == 'grid' ) && ( ! empty( $e_st_date ) || ! empty( $e_start_time ) ) ) { ?>
										        <div class="event-grid-meta">
										        	<?php if( ! empty( $e_st_date ) ) { ?>
											        	<p class="ev-start-date pull-left" itemprop="startDate" content="<?php echo esc_attr( get_the_time('c') ); ?>"><i class="flaticon-agenda"></i> <?php echo esc_html( $e_st_date ); ?></p>
											        <?php } ?>
											        <?php if( ! empty( $e_st_date ) || ! empty( $e_start_time ) ) { ?>
											        	<p class="event-grid-time">
											        		<i class="flaticon-clock-1"></i>
											        		<?php if( ! empty( $e_start_time ) ) { ?> 
												        		<span class=""><?php echo esc_html( $e_start_time ); ?></span>
												        	<?php }
												        	if( ! empty( $e_end_time ) ) { ?>
												        		<span class=""> - <?php echo esc_html( $e_end_time ); ?></span>
											        		<?php } ?>
											        	</p>
											        <?php } ?>
										        </div>
									        <?php } ?>
							                <div class="<?php echo ( $layout == 'grid' ) ? esc_attr( 'events-grid-excerpt' ) : esc_attr( 'list-content' ); ?>">
							                <?php
							                    if( $chr_length ) {
							                    	if( function_exists( 'codexin_char_limit' ) ) {
								                        echo apply_filters( 'the_content', codexin_char_limit( $desc_length, 'excerpt' ) );
							                    	} else {
												    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ) .'</p>';
							                    	}
							                    } else {
							                        the_excerpt();
							                    }
							                ?>
							                </div>
						                	<?php echo ( $layout == 'grid' ) ? '</div> <!-- end of events-description -->' : ''; ?>
											<?php if( $read_more ) { ?>
								                <div class="<?php echo ( $layout == 'list' ) ? esc_attr( 'cx-btn reveal-color-0 reveal-primary-btn' ) : esc_attr( 'events-cx-btn reveal-color-0' ); ?>">
								                	<a <?php echo ( $layout == 'list' ) ? 'class="cx-btn-text"' : ''; ?> href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( ! empty( $readmore_txt ) ? $readmore_txt : esc_html__('Read More', 'codexin') ); ?></a>
								                </div>
								            <?php } ?>
							            <?php echo ( $layout == 'list' ) ? '</div> <!-- end of desc-events -->' : ''; ?>
									<?php echo ( $layout == 'list' ) ? '</div> <!-- end of event-list-wrapper -->' : '' ?>
						        </div> <!-- end of <?php echo ( $layout == 'grid' ) ? 'events-item-content' : 'post-wrapper'; ?> -->
						    </article> <!-- #event-## -->
						    <?php 
						    if( $layout == 'grid' ) {
			                    echo '</div><!-- end of events-single-wrap -->';

			                    if( $i % $grid_col == 0 ) {
			                        echo '<div class="clearfix"></div>';
			                    }
			                }

						}
						echo '</div> <!-- end of events-archive-wrapper -->';
					}
					wp_reset_postdata();
					?>

					<?php 
					echo '<div class="clearfix"></div>';
					echo ( $layout == 'grid' ) ? '<div class="col-xs-12">' : '' ;
					if( $pagination_type == 'numbered' ) {
						if( function_exists( 'codexin_numbered_posts_nav' ) ) {
					        echo codexin_numbered_posts_nav( $data );
						} else {
					    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
						}
					} elseif( $pagination_type == 'button' ) {
				    	if( function_exists( 'codexin_posts_link' ) ) {
					        codexin_posts_link( 'Newer Events', 'Older Events', $data );
				    	} else {
					    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
				    	}
					}
				    echo ( $layout == 'grid' ) ? '</div></div> <!-- end of row -->' : '';
					?>
				</div> <!-- end of <?php echo ( $layout == 'grid' ) ? 'events-grid-wrapper' : 'events-list-wrapper'; ?> -->
			</div> <!-- end of events-content-wrapper -->
		</div> <!-- end of cx-events-standard -->

	<?php
	$result .= ob_get_clean();
	return $result;
}



// Integrating Shortcode with King Composer
function cx_events_kc() {

	$cx_events_categories = codexin_get_custom_categories('events-category');

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_events' 		=> array(
					'name' 			=> esc_html__( 'Codexin Events', 'codexin' ),
					'description' 	=> esc_html__('Codexin Events', 'codexin'),
					'icon' 			=> 'et-hazardous',
					'category' 		=> 'Codexin',
					'params' 		=> array(
	    				// General Params
						'general' => array(

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'layout',
	    						'label'			=> esc_html__( 'Select Layout', 'codexin' ),
	    						'value'			=> 'list',
	    						'options'		=> array(
	    							'list' 		=> esc_html__( 'List View', 'codexin' ),
	    							'grid'	    => esc_html__( 'Grid View', 'codexin' ),
	    						),
	    						'description'	=> esc_html__( 'Choose the Events View.', 'codexin' ),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'grid_col',
	    						'label'			=> esc_html__( 'Number of Column', 'codexin' ),
	    						'value'			=> '2',
	    						'options'		=> array(
	    							'2' 		=> esc_html__( '2', 'codexin' ),
	    							'3'		    => esc_html__( '3', 'codexin' ),
	    							'4'		    => esc_html__( '4', 'codexin' ),
	    						),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> 'grid',
    							),
	    						'description'	=> esc_html__( 'Choose the number of column to display Events.', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'chr_length',
	    						'label'       	=> esc_html__( 'Enable Events Title and Excerpt Length? ', 'codexin' ),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Select to enable/disable events-title & excerpt length.', 'codexin' ),
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
	    						'description'	=> esc_html__( 'Specify number of Characters that you want to show in your title', 'codexin' ),
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
	    						'description'	=> esc_html__( 'Specify number of Characters that you want to show in your excerpt', 'codexin' ),
	    						'options'		=> array(
	    							'min'			=> 20,
	    							'max'			=> 500,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							),
    						),

	    					array(
	    						'name'        	=> 'read_more',
	    						'label'       	=> esc_html__( 'Enable Read More Button? ', 'codexin' ),
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
	    							'button' 	=> esc_html__( 'Classic Next-Previous Button', 'codexin' ),
	    							'numbered'  => esc_html__( 'Numbered Pagination', 'codexin' ),
	    						),
	    						'description'	=> esc_html__( 'Choose the Pagination Type.', 'codexin' ),
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
	    						'label'       	=> esc_html__( 'Events Order', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__( 'Ascending', 'codexin' ),
    								'DESC'	=> esc_html__( 'Descending', 'codexin' ),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Events:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__( 'Events Sorting Method', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'meta_value'	 => esc_html__( 'Date', 'codexin' ),
    								'name'			 => esc_html__( 'Name', 'codexin' ),
    								'rand'			 => esc_html__( 'Randomize', 'codexin' ),
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Events Sorting Method', 'codexin' ),
	    					),

	 						array(
	 							'name' 			=> 'include',
	 							'label' 		=> esc_html__( 'Filter Events Categories', 'codexin' ),
	 							'type' 			=> 'multiple',
	 							'options'		=> $cx_events_categories,
	 							'description'	=> esc_html__( 'Choose if You Want to Show Any Specific Events Category/Categories, Control + Click to Select Multiple Categories to Filter (All Categories will be shown by Default)', 'codexin' ),
	 						),
    					),
	                ) //End params array
	            ),  // End of cx_events array
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_events_kc


