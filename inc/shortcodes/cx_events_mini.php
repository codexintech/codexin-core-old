<?php

/**
 * Shortcode -  Mini Events
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Mini Events Shortcode
function cx_events_mini_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'layout'			=> '',
		'include'			=> '',
		'orderby'			=> '',
		'number_of_events'	=> '',
		'icons'				=> '',
		'event_icon_one'	=> '',
		'event_icon_two'	=> '',
		'event_icon_three'	=> '',
		'order'				=> '',
		'show_time'			=> '',
		'show_date'			=> '',
		'show_add'			=> '',
		'show_all'			=> '',
		'readmore'			=> '',
		'title_length'		=> '',
		'desc_length'		=> '',
		'button_text'		=> '',
		'button_text_all'	=> '',
		'href'				=> '',
		'arrow'				=> '',
		'dot'				=> '',
		'class'				=> '',
	), $atts ) );

	$result 		 = '';
	$render_view_all = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-events-description';

	// Retrieving the url
	$retrieve_link 	= codexin_retrieve_url( $href );
	$title 			= ( $retrieve_link[1] ) ? 'title="'. esc_attr( $retrieve_link[1] ).'"':'';
	$target 		= ( $retrieve_link[2] ) ? 'target="'. esc_attr( $retrieve_link[2]) .'"':'';

	// Rendering view all button
	$render_view_all .= '<div class="events-view-all">';
		if( $href ) {
			$render_view_all .= '<div class="cx-color-0 cx-primary-btn">';
				$render_view_all .= '<a href="'. esc_url( $retrieve_link[0] ) .'" '. $title .' '. $target .' class="cx-events-btn">';
					$render_view_all .= ( ! empty( $button_text_all ) ? $button_text_all : esc_html__( 'View All', 'codexin' ) );
				$render_view_all .= '</a>';
			$render_view_all .= '</div>';
		} else {
			$render_view_all .= '<div class="cx-color-0 cx-primary-btn">';
				$render_view_all .= '<a href="'. esc_url( get_post_type_archive_link( 'events' ) ) .'" class="cx-events-btn">';
					$render_view_all .= ( ! empty( $button_text_all ) ? $button_text_all : esc_html__( 'View All', 'codexin' ) );
				$render_view_all .= '</a>';
			$render_view_all .= '</div>';
		}
	$render_view_all .= '</div>';

	// Extracting user included categories
	$cat_include 	= str_replace(',', ' ', $include);
	$cat_includes 	= explode( " ", $cat_include );

	// Buiding up args for query
	$args = array(
		'post_type'				=> 'events',
		'meta_key'				=> ( $orderby == 'meta_value' ) ? 'codexin_event_start_date' : '',
		'order'					=> $order,
		'orderby'				=> $orderby,
		'posts_per_page'		=> $number_of_events
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

	ob_start();

	if( ! empty( $layout ) ) {

		if( $layout == 1 ) {

			// Retrieving user define classes
			$classes = array( 'panel-group' );
			(!empty($class)) ? $classes[] = $class : '';

			// Enqueueing the script for accordion
			wp_enqueue_script( 'cx-events-accordion', CODEXIN_CORE_JS_DIR . '/cx-events-accordion', array ( 'jquery' ), 1.0, true );
		?>
	
				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" id="accordion" role="tablist" aria-multiselectable="true">
					<?php 

						$args['posts_per_page'] = 3;

						$data = new WP_Query( $args );

						if( $data->have_posts() ) {
							//Start loop here...
							$i = 0;
							while( $data->have_posts() ) {
								$data->the_post();
								$i++;

								if( $i == 1 ) { 
									$event_icon = $event_icon_one;
									$heading_id = 'headingOne';
									$collapse_id = 'collapse';
								} elseif ( $i == 2 ) {
									$event_icon = $event_icon_two;
									$heading_id = 'headingTwo';
									$collapse_id = 'collapseTwo';
								} elseif ( $i == 3 ) {
									$event_icon = $event_icon_three;
									$heading_id = 'headingThree';
									$collapse_id = 'collapseThree';
								}

								$class_in 		= ( $i == 1 ) ? ' in' : '';
								$class_active	= ( $i == 1 ) ? ' active' : '';

								echo '<div class="panel panel-default">';
									echo '<div class="panel-heading'. esc_attr( $class_active ) .'" role="tab" id="'. esc_attr( $heading_id ) .'">';
										echo '<h4 class="panel-title">';
											echo '<a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#'. esc_attr( $collapse_id ) .'" aria-expanded="true" aria-controls="'. esc_attr( $collapse_id ) .'">';
												if( $icons ) { echo '<i class="'. esc_attr( $event_icon ) .' cx-color-1" > </i>'; }
												echo esc_html( wp_trim_words( get_the_title(), $title_length ) );
											echo '</a>';
										echo '</h4>';
									echo '</div>';

									echo '<div id="'. esc_attr( $collapse_id ) .'" class="panel-collapse collapse'. esc_attr( $class_in ) .'" role="tabpanel" aria-labelledby="'. esc_attr( $heading_id ) .'">';
										echo '<div class="panel-body">';
											echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) );
										echo '</div>';
									echo '</div>';
								echo '</div> <!--end of panel-default-->'; 
							}
						}
						wp_reset_postdata();
						?>
					</div><!--end of panel-group-->
				</div>  <!-- end of cx-events-description -->

		<?php } // end of layout-1

		if( $layout == 2 ) {

			// Retrieving user define classes
			$classes = array( 'cx-events-wrapper-2' );
			( ! empty( $class ) ) ? $classes[] = $class : ''; 

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="row">
				 		<?php 

				 		$data = new WP_Query( $args );

						if( $data->have_posts() ) {
							while( $data->have_posts() ) {
							$data->the_post();

							$column = 12 / $number_of_events;

							// Retrieving Image alt tag
							$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

							// Retrieving the meta infos
							$start_time = rwmb_meta( 'codexin_event_start_time' );
							$end_time 	= rwmb_meta( 'codexin_event_end_time' );
							$address 	= strtolower( rwmb_meta( 'codexin_event_address' ) );
							$date 		= strtotime( rwmb_meta( 'codexin_event_start_date' ) );

							$thumbnail_size = 'codexin-core-rectangle-four';
							if( function_exists( 'codexin_attachment_metas_extended' ) ) {
								$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'events', $thumbnail_size )['src'];
							} else {
								$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X327';
							}

							?>
						 		<div class="col-md-<?php echo esc_attr( $column ); ?> col-sm-<?php echo ( $column == 4 ) ? esc_attr( $column ) : esc_attr( 6 ); ?>">
						 			<div class="events-single cx-border-1">
						 				<div class="event-media-wrapper">
						 					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						 						<div class="event-media cx-bg-overlay">
													<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						 						</div>
						 					</a>
					 					</div>
						 				<div class="events-single-content">
						 					<h3 class="events-single-title">
						 						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></a>
					 						</h3>

											<?php if( ! empty( $start_time ) || ! empty( $end_time ) || ! empty( $address ) || ! empty( $date ) ){ ?>
							 					<ul class="events-meta">
							 						<?php if( $show_time && ( ! empty( $start_time ) || ! empty( $end_time ) ) ) { ?>
								 						<li><i class="fa fa-clock-o cx-color-1"></i>
								 							<?php echo esc_html( $start_time ) . ' - ' . esc_html( $end_time ); ?> 
								 						</li>
								 					<?php } ?>
								 					<?php if( $show_date && ! empty( $date ) ) { ?>
								 						<li>
								 							<i class="fa fa-calendar cx-color-1"></i>
								 							<?php 
																$new_date = date( get_option( 'date_format' ), $date );
																echo esc_html( $new_date );
															?>
								 						</li>
								 					<?php } ?>
								 					<?php if( $show_add && !empty( $address ) ) { ?>
								 						<li>
								 							<i class="fa fa-map-marker cx-color-1"></i>
								 							<?php echo esc_html( $address ); ?>
								 						</li>
								 					<?php } ?>
							 					</ul>
							 				<?php } ?>

						 					<div class="events-single-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?></div>
						 					<?php if( $readmore ) { ?>
												<div class="cx-color-0 cx-primary-btn">
													<a class="cx-events-btn" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo ( ! empty( $button_text ) ? $button_text : esc_html__( 'Read More', 'codexin' ) ); ?></a>
												</div>
							 				<?php } ?>
						 				</div>
						 			</div> <!-- end of events-single -->
						 		</div> <!-- end of col -->
					 		<?php 
					 		}
				 		}
				 		wp_reset_postdata(); ?>
				 	</div> <!-- end of row -->
			 	</div> <!-- end of cx-events-wrapper-2 -->
				<div class="clearfix"></div>
				<?php if( $show_all ) {
					printf( '%s', $render_view_all );
				} ?>
			</div> <!-- end of cx-events-description -->
		<?php } // end of layout-2

		if( $layout == 3 ) {

			// Retrieving user define classes
			$classes = array( 'cx-events-wrapper-3' );
			( ! empty( $class ) ) ? $classes[] = $class : ''; 

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="row">
				 		<?php 

				 		$data = new WP_Query( $args ); 
						if( $data->have_posts() ) {
							while( $data->have_posts() ) {
							$data->the_post();

							$column = 12 / $number_of_events;

							// Retrieving Image alt tag
							$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

							// Retrieving the meta infos
							$start_time = rwmb_meta( 'codexin_event_start_time' );
							$end_time 	= rwmb_meta( 'codexin_event_end_time' );
							$address 	= strtolower( rwmb_meta( 'codexin_event_address' ) );
							$date 		= strtotime( rwmb_meta( 'codexin_event_start_date' ) ); 

							$thumbnail_size = 'codexin-core-rectangle-four';
							if( function_exists( 'codexin_attachment_metas_extended' ) ) {
								$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'events', $thumbnail_size )['src'];
							} else {
								$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X327';
							}

							?>
						 		<div class="col-md-<?php echo esc_attr( $column ); ?> col-sm-<?php echo ( $column == 4 ) ? esc_attr( $column ) : esc_attr( 6 ); ?>">
						 			<div class="events-single cx-border-1">
						 				<div class="event-media-wrapper cx-color-2">
						 					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						 						<div class="event-media">
													<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
								 					<?php if( $show_date && ! empty( $date ) ) { ?>
							 						<div class="event-date">
							 							<i class="fa fa-calendar"></i>
							 							<?php 
															$new_date = date( get_option( 'date_format' ), $date );
															echo esc_html( $new_date );
														?>
							 						</div>
								 					<?php } ?>
						 						</div>
						 					</a>
						 					</div>
						 				<div class="events-single-content">
						 					<h3 class="events-single-title">
						 						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></a>
						 					</h3>
											
											<?php if( ! empty( $start_time ) || ! empty( $end_time ) || ! empty( $address ) ) { ?>
							 					<ul class="events-meta">
							 						<?php if( $show_time && ( ! empty( $start_time ) || ! empty( $end_time ) ) ) { ?>
							 						<li><i class="fa fa-clock-o cx-color-1"></i>
							 							<?php echo esc_html($start_time) . ' - ' . esc_html($end_time); ?> 
							 						</li>
								 					<?php }; ?>
								 					<?php if( $show_add && !empty( $address ) ) { ?>
							 						<li>
							 							<i class="fa fa-map-marker cx-color-1"></i> 
							 							<?php echo esc_html( $address ); ?>
							 						</li>
								 					<?php } ?>
							 					</ul>
							 				<?php } ?>

						 					<div class="events-single-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?></div>
						 				</div>
					 					<?php if( $readmore ) { ?>
											<div class="events-cx-btn cx-color-0">
												<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo ( ! empty( $button_text ) ? $button_text : esc_html__( 'Read More', 'codexin' ) ); ?></a>
											</div>
						 				<?php } ?>
						 			</div> <!-- end of events-single -->
						 		</div> <!-- end of col -->
					 		<?php 
					 		}
				 		}
				 		wp_reset_postdata(); ?>
				 	</div> <!-- end of row -->
			 	</div> <!-- end of cx-events-wrapper-2 -->

				<div class="clearfix"></div>
				<?php if( $show_all ) {
					printf( '%s', $render_view_all );
				} ?>
			</div> <!-- end of cx-events-description -->
		<?php } // end of layout-3

		if( $layout == 4 ) {

			// Retrieving user define classes
			$classes = array( 'cx-events-wrapper-4' );
			(!empty($class)) ? $classes[] = $class : ''; 

			// Building variables to pass values to javascript
			$slick_arrow 	= ( $arrow ) ? true : 0;
			$slick_dot 		= ( $dot ) ? true : 0;

			// Registering and enqueueing some scripts and passing the values to Javascript
			wp_enqueue_script( 'slick-script', CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js', array ( 'jquery' ), 1.7, true );
			wp_register_script( 'cx-events-shortcode-script', CODEXIN_CORE_JS_DIR . '/cx-event.js', array ( 'jquery', 'slick-script' ), 1.0, true );
		    wp_localize_script( 'cx-events-shortcode-script', 'cx_event_params', array(
		        'ev_arrow' 	=> $slick_arrow,
		        'ev_dot' 	=> $slick_dot,
		    ) ); 
		    wp_enqueue_script( 'cx-events-shortcode-script' );

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="row">
						<div class="events-carousel">
					 		<?php 

					 		$args['posts_per_page'] = -1;

					 		$data = new WP_Query( $args ); 
							if( $data->have_posts() ) {
								while( $data->have_posts() ) {
								$data->the_post();

								// Retrieving Image alt tag
								$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

								// Retrieving the meta infos
								$address 	= strtolower( rwmb_meta( 'codexin_event_address' ) );
								$date 		= strtotime( rwmb_meta( 'codexin_event_start_date' ) );

								$thumbnail_size = 'codexin-core-rectangle-four';
								if( function_exists( 'codexin_attachment_metas_extended' ) ) {
									$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'events', $thumbnail_size )['src'];
								} else {
									$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X327';
								}

								?>
							 		<div class="col-sm-6 item">
							 			<div class="events-single cx-border-1">
							 				<div class="event-media-wrapper">
						 						<div class="event-media">
													<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
								 					<?php if( $readmore ) { ?>
								 						<div class="cx-color-0 cx-primary-btn cx-white-btn">
										 					<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="cx-events-btn"><?php echo ( ! empty( $button_text ) ? $button_text : esc_html__( 'Read More', 'codexin' ) ); ?></a>
										 				</div>
									 				<?php } ?>
						 						</div>
						 					</div>
							 				<div class="events-single-content cx-bg-1">
							 					<h3 class="events-single-title">
							 						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></a>
							 					</h3>
							 					<div class="events-single-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?></div>
							 				</div>
							 				<?php if( $show_date || $show_add ) { ?>
		                                        <ul class="events-meta cx-border-1">
		                                            <?php if( $show_add && !empty( $address ) ) { ?>
		                                            <li>
		                                                <i class="fa fa-map-marker cx-color-1"></i> 
		                                                <?php echo esc_html( $address ); ?>
		                                            </li>
		                                            <?php } ?>
		                                            <?php if( $show_date && !empty( $date ) ) { ?>
			                                            <li class="<?php echo ( $show_add ) ? esc_attr( 'pull-right' ) : '' ?>">
			                                                <i class="fa fa-calendar cx-color-1"></i>
			                                                <?php 
			                                                    $new_date = date( get_option( 'date_format' ), $date );
			                                                    echo esc_html( $new_date );
			                                                ?>
			                                            </li>
		                                            <?php } ?>
		                                        </ul>
		                                    <?php } ?>
							 			</div> <!-- end of events-single -->
							 		</div>
						 		<?php 
						 		}
					 		}
					 		wp_reset_postdata(); ?>
					 	</div> <!-- end of events-carousel -->
				 	</div> <!-- end of row -->
			 	</div> <!-- end of cx-events-wrapper-2 -->

				<div class="clearfix"></div>
				<?php if( $show_all ) {
					printf( '%s', $render_view_all );
				} ?>
			</div> <!-- end of cx-events-description -->
		<?php } // end of layout-4

	} // end of layout check
	$result .= ob_get_clean();
	return $result;

} //End cx_events_mini

// Integrating Shortcode with King Composer
function cx_events_mini_kc() {

	$cx_events_categories = codexin_get_custom_categories('events-category');

	if( function_exists( 'kc_add_map' ) ) { 
 		kc_add_map(
 			array(
 				'cx_events_mini' => array(
 					'name' 			=> esc_html__( 'Codexin Mini Events', 'codexin' ),
 					'description' 	=> esc_html__( 'Mini Events', 'codexin' ),
 					'icon' 			=> 'et-hazardous',
 					'category' 		=> 'Codexin',
                	//Only load assets when using this element
					// 'assets' => array(
					// 	'scripts' => array(
					// 		'slick-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js',
					// 		'event-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_event.js',
					// 	),
  	  //       			'styles'	=> array(
  	  //       				'slick-stylesheet'	=> CODEXIN_CORE_ASSET_DIR . '/css/slick.css',
     //    				),

     //            	), //End assets
 					'params'		=> array(

 						//General params
 						'general'	=> array(
 							array(
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select Events Template', 'codexin' ),
								'name'			=> 'layout',
								'admin_label'	=> true,
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/events/events-1.jpg',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/events/events-2.jpg',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/events/events-3.jpg',
									'4'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/events/events-4.jpg',
								),
								'value'	=> '1'
							),

							array(
	    						'name'        	=> 'number_of_events',
	    						'label'       	=> esc_html__( 'Number Of Events to Display', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'2'	=> esc_html__( '2', 'codexin' ),
    								'3'	=> esc_html__( '3', 'codexin' ),
    								'4'	=> esc_html__( '4', 'codexin' ),
    							),
	    						'value'			=> '3',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '2,3',
    							),
	    						'description'	=> esc_html__( 'Choose the number of events you want to show.', 'codexin' ),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__( 'Event Order', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__( 'Ascending', 'codexin' ),
    								'DESC'	=> esc_html__( 'Descending', 'codexin' ),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Events', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__( 'Events Sorting Method', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'meta_value'	 => esc_html__( 'Event Date', 'codexin' ),
    								'name'			 => esc_html__( 'Event Name', 'codexin' ),
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

	    					array(
	    						'name'			=> 'title_length',
	    						'label'			=> esc_html__( 'Title Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '4',
	    						'description'	=> esc_html__( 'Specify number of Words that you want to show in your title', 'codexin' ),
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
	    						'value'			=> '30',
	    						'description'	=> esc_html__( 'Specify number of Words that you want to show in your excerpt', 'codexin' ),
	    						'options'		=> array(
	    							'min'			=> 10,
	    							'max'			=> 50,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							),
    						),

 							array(
 								'name' 			=> 'icons',
 								'label' 		=> esc_html__( 'Enable Icons', 'codexin' ),
 								'type' 			=> 'toggle',
 								'relation'		=> array(
 									'parent'	=> 'layout',
 									'show_when' => '1',
 								),
 								'value'			=> 'yes',
 								'description'	=> esc_html__( 'Select to Enable/Disable Icons', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'event_icon_one',
 								'label' 		=> esc_html__( 'Select First Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'relation'		=> array(
    								'parent' 	=> 'icons',
    								'show_when'	=> 'yes',
 								),
 								'description'	=> esc_html__( 'Select Event First Icon Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'event_icon_two',
 								'label' 		=> esc_html__( 'Select Second Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'relation'		=> array(
    								'parent' 	=> 'icons',
    								'show_when'	=> 'yes',
 								),
 								'description'	=> esc_html__( 'Select Event Second Icon Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'event_icon_three',
 								'label' 		=> esc_html__( 'Select Third Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'relation'		=> array(
    								'parent' 	=> 'icons',
    								'show_when'	=> 'yes',
 								),
 								'description'	=> esc_html__( 'Select Event Third Icon Here', 'codexin' ),
 							),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'arrow',
	    						'label'			=> esc_html__( 'Show Carousel Navigation Arrow? ', 'codexin' ),
	    						'value'			=> 'yes',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '4',
    							),
	    						'description'	=> esc_html__( 'Choose to enable/disable events carousel navigation arrow', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'dot',
	    						'label'			=> esc_html__( 'Show Carousel Pagination? ', 'codexin' ),
	    						'value'			=> 'yes',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '4',
    							),
	    						'description'	=> esc_html__( 'Choose to enable/disable events carousel pagination', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_time',
	    						'label'			=> esc_html__( 'Show Event Time? ', 'codexin' ),
	    						'value'			=> 'yes',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'hide_when'	=> '1,4',
    							),
	    						'description'	=> esc_html__( 'Choose to enable/disable events time', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_date',
	    						'label'			=> esc_html__( 'Show Event Date? ', 'codexin' ),
	    						'value'			=> 'yes',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'hide_when'	=> '1',
    							),
	    						'description'	=> esc_html__( 'Choose to enable/disable events date', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_add',
	    						'label'			=> esc_html__( 'Show Event Address? ', 'codexin' ),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'hide_when'	=> '1',
    							),
	    						'description'	=> esc_html__('Choose to enable/disable events address', 'codexin'),
	    					),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'readmore',
	    						'label'			=> esc_html__( 'Show \'Read More\' Button? ', 'codexin' ),
	    						'value'			=> 'yes',
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'hide_when'	=> '1',
    							),
	    						'description'	=> esc_html__( 'Choose to enable/disable read more button for single event.', 'codexin' ),
	    					),

 							array(
 								'name' 			=> 'button_text',
 								'label' 		=> esc_html__( 'Read More Button Text', 'codexin' ),
 								'type' 			=> 'text',
 								'relation'		=> array(
 									'parent'	=> 'readmore',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Enter Your Button Text Here', 'codexin' ),
 							),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_all',
	    						'label'			=> esc_html__( 'Show \'View All\' Button? ', 'codexin' ),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'hide_when'	=> '1',
    							),
	    						'description'	=> esc_html__( 'Choose to enable/disable view all events button at the end.', 'codexin' ),
	    					),

 							array(
 								'name' 			=> 'button_text_all',
 								'label' 		=> esc_html__( 'View All button Text', 'codexin' ),
 								'type' 			=> 'text',
 								'relation'		=> array(
 									'parent'	=> 'show_all',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Enter Your Button Text Here', 'codexin' ),
 							),

	    					array(
	    						'name'     		=> 'href',
	    						'label'    		=> esc_html__( 'Custom URL for \'View All\' Button', 'codexin' ),
	    						'type'    		=> 'link',
 								'relation'		=> array(
 									'parent'	=> 'show_all',
 									'show_when' => 'yes',
 								),
	    						'description' 	=> esc_html__(' The URL which this button assigned to. If not selected, default event archive page URL will be assigned to the button.', 'codexin')
    						),

 							array(
 								'name' 			=> 'class',
 								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
 							),

					    ), //End general array

 						//Styling params
 						'styling' => array(

 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										esc_html__( 'Title', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'color', 'label' => esc_html__( 'Color On Hover', 'codexin' ), 'selector' => '.panel-title a:hover, .events-single-title a:hover'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title a, .events-single-title a'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title a, .events-single-title a')
 										),

 										esc_html__( 'Description', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-body, .events-single-desc'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.panel-body, .events-single-desc'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-body, .events-single-desc'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.panel-body, .events-single-desc'),
 											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.panel-body, .events-single-desc'),
 											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.panel-body, .events-single-desc'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-body, .events-single-desc'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-body, .events-single-desc')
 										),

 										esc_html__( 'Icon', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title i, .panel-title a::after, .events-meta li i, .event-date i'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title i, .panel-title a::after, .events-meta li i, .event-date i'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title i, .panel-title a::after, .events-meta li i, .event-date i'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title i, .panel-title a::after, .events-meta li i, .event-date i')
 										),

 										esc_html__( 'Meta Text', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.events-meta li, .event-date')
 										),

 										esc_html__( 'Image', 'codexin' ) => array(
 											array( 'property' => 'background', 'label' => esc_html__( 'Background', 'codexin'), 'selector' => '.event-media:before, .event-media:after'),
 										),

 										esc_html__( 'Wrapper', 'codexin' ) => array(
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Background Color', 'codexin'), 'selector' => '.events-single, .events-single-content'),
 											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => '.events-single'),
 											array( 'property' => 'border-color', 'label' => esc_html__( 'Border Color on Hover', 'codexin'), 'selector' => '.events-single:hover'),
 											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin'), 'selector' => '.events-single'),
 											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow on Hover', 'codexin'), 'selector' => '.events-single:hover'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.events-single'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.events-single')
 										),

 										esc_html__( 'Button', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2, .cx-events-btn:before'),
 											array( 'property' => 'color', 'label' => esc_html__( 'Color on Hover', 'codexin'), 'selector' => '.cx-events-btn:hover, .cx-events-btn-2:hover, .cx-events-btn:hover:before, .events-cx-btn a:hover'),
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Background Color', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Background Color on Hover', 'codexin'), 'selector' => '.cx-events-btn:hover, .cx-events-btn-2:hover, .events-cx-btn a:hover'),
 											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'border-color', 'label' => esc_html__( 'Border Color on Hover', 'codexin'), 'selector' => '.cx-events-btn:hover, .cx-events-btn-2:hover, .events-single:hover .cx-events-btn-2, .events-cx-btn a:hover'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align for "View All" Button', 'codexin'), 'selector' => '.events-view-all'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-events-btn, .events-cx-btn a, .cx-events-btn-2')
 										),

 										esc_html__( 'Tabs', 'codexin' )	=> array(
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Title Tab Background', 'codexin'), 'selector' => '.panel-heading'),
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Title Tab Background on Hover', 'codexin'), 'selector' => '.panel-heading:hover, .panel-heading.active'),
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Description Tab Background Color', 'codexin'), 'selector' => '.panel-body'),
 										),

										esc_html__( 'Nav', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => 'Color of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'background', 'label' => 'Background of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'font-size', 'label' => 'Arrow Font Size of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'margin', 'label' => 'Margin of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'padding', 'label' => 'padding of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array( 'property' => 'background-color', 'label' => 'Color of Dot Nav', 'selector' => '.slick-dots li'),
											array( 'property' => 'background-color', 'label' => 'Color of Dot Nav on Active State', 'selector' => '.slick-dots li.slick-active'),
											array( 'property' => 'background-color', 'label' => 'Color of Dot Nav on Hover', 'selector' => '.slick-dots li:hover'),
											array( 'property' => 'margin', 'label' => 'Margin of Dot Nav', 'selector' => '.slick-dots'),
										),
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
	                ) //End params
	            ),  // End of element
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_events_mini_kc


