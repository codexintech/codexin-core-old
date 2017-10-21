<?php


/*
    ===================================
        CODEXIN MINI EVENTS SHORTCODE
    ===================================
*/

// Registering Mini Events Shortcode
function cx_events_mini_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
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
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-events-description';

	// Extracting user included categories
	$cat_include = str_replace(',', ' ', $include);
	$cat_includes = explode( " ", $cat_include );

	$result = '';

	ob_start();

	if( ! empty( $layout ) ) :

		if( $layout == 1 ) :

			// Retrieving user define classes
			$classes = array( 'panel-group' );
			(!empty($class)) ? $classes[] = $class : '';
		?>
	
				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" id="accordion" role="tablist" aria-multiselectable="true">
					<?php 
						//start new query..
						if( empty($include) ):
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
								'posts_per_page'		=> 3
							);

						else:
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
							    'tax_query' 			=> array(
							        array(
							            'taxonomy' => 'events-category',
							            'field'    => 'term_id',
							            'terms'    => $cat_includes,
							        ),
							    ),
							    'posts_per_page'		=> 3
							);
						endif;

						$data = new WP_Query( $args );

						if( $data->have_posts() ) :
							//Start loop here...
							$i = 0;
							while( $data->have_posts() ) : $data->the_post();
								$i++;
								if( $i == 1 ) { 
									$event_icon = $event_icon_one;
									$heading_id = 'headingOne';
									$collapse_id = 'collapseOne';
								} elseif ( $i == 2 ) {
									$event_icon = $event_icon_two;
									$heading_id = 'headingTwo';
									$collapse_id = 'collapseTwo';
								} elseif ( $i == 3 ) {
									$event_icon = $event_icon_three;
									$heading_id = 'headingThree';
									$collapse_id = 'collapseThree';
								}
							?>

						<div class="panel panel-default">
						<?php
							if( $i == 1 ) :
								$class_in = 'in';
						 ?>
							<div class="panel-heading active" role="tab" id="<?php echo $heading_id; ?>">
						<?php
							else : 
								$class_in = '';
						?>
							<div class="panel-heading" role="tab" id="<?php echo $heading_id; ?>">

						<?php endif; ?>	
								<h4 class="panel-title">
									<a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse_id;?>" aria-expanded="true" aria-controls="<?php echo $collapse_id;?>">
										<?php if( $icons ) { ?>
											<i class="<?php echo esc_attr( $event_icon );?>" > </i> <?php } ?><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?>
										
									</a>
								</h4>
							</div>
							<div id="<?php echo $collapse_id;?>" class="panel-collapse collapse <?php echo $class_in; ?>" role="tabpanel" aria-labelledby="<?php echo $heading_id; ?> ">
								<div class="panel-body">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
								</div>
							</div>
						</div><!--end of panel-default-->
							<?php 
							endwhile;
						endif; 
						wp_reset_postdata();  ?>
					</div><!--end of panel-group-->
				</div>  <!-- end of cx-events-description -->

		<?php endif;

		if( $layout == 2 ) : 

			// Retrieving user define classes
			$classes = array( 'cx-events-wrapper-2' );
			(!empty($class)) ? $classes[] = $class : ''; 

			// Retrieving the url
			$retrieve_link = retrieve_url( $href );
			$title = ($retrieve_link[1]) ? 'title="'.esc_attr($retrieve_link[1]).'"':'';
			$target = ($retrieve_link[2]) ? 'target="'.esc_attr($retrieve_link[2]).'"':'';

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="row">
				 		<?php 
				 		//start new query..
						if( empty($include) ):
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
								'posts_per_page'		=> $number_of_events
							);

						else:
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
							    'tax_query' 			=> array(
							        array(
							            'taxonomy' => 'events-category',
							            'field'    => 'term_id',
							            'terms'    => $cat_includes,
							        ),
							    ),
							    'posts_per_page'		=> $number_of_events
							);
						endif;

				 		$data = new WP_Query( $args ); 
						if( $data->have_posts() ) :
							while( $data->have_posts() ) : $data->the_post();

							$column = 12/$number_of_events;

							// Retrieving Image alt tag
							$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

							// Retrieving the meta infos
							$start_time = rwmb_meta( 'reveal_event_start_time','type=time' );
							$end_time 	= rwmb_meta( 'reveal_event_end_time','type=time' );
							$address 	= strtolower( rwmb_meta( 'reveal_event_address','type=textarea' ) );
							$date 		= strtotime( rwmb_meta( 'reveal_event_start_date','type=date' ) ); 

							?>
						 		<div class="col-md-<?php echo esc_html( $column ); ?> col-sm-<?php echo ( $column==4 ) ? esc_html($column) : esc_html(6); ?>">
						 			<div class="events-single">
						 				<div class="event-media-wrapper">
						 					<a href="<?php echo esc_url(get_the_permalink()); ?>">
						 						<div class="event-media">
													<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rectangle-four' ) : '//placehold.it/600x327' ); ?>" alt="<?php echo esc_attr($image_alt); ?>">
						 						</div>
						 					</a>
					 					</div>
						 				<div class="events-single-content">
						 					<a href="<?php echo esc_url(get_the_permalink()); ?>"><h3 class="events-single-title"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></h3></a>

											<?php if( !empty( $start_time ) || !empty( $end_time ) || !empty( $address ) || !empty( $date ) ): ?>
						 					<ul class="events-meta">
						 						<?php if( $show_time && ( !empty( $start_time ) || !empty( $end_time ) ) ): ?>
						 						<li><i class="fa fa-clock-o"></i>
						 							<?php 

						 							echo esc_html($start_time) . ' - ' . esc_html($end_time);
						 							?> 
						 						</li>
							 					<?php endif; ?>
							 					<?php if( $show_date && !empty( $date ) ): ?>
						 						<li>
						 							<i class="fa fa-calendar"></i>
						 							<?php 
														$new_date = date( get_option('date_format'), $date );
														echo esc_html( $new_date );
													?>
						 						</li>
							 					<?php endif; ?>
							 					<?php if( $show_add && !empty( $address ) ): ?>
						 						<li>
						 							<i class="fa fa-map-marker"></i> 
						 							<?php echo esc_html( $address ); ?>
						 						</li>
							 					<?php endif; ?>
						 					</ul>
							 				<?php endif; ?>

						 					<div class="events-single-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?></div>
						 					<?php if( $readmore ): ?>
						 					<a href="<?php echo esc_url(get_the_permalink()); ?>" class="cx-events-btn"><?php echo esc_html( !empty( $button_text ) ? $button_text : __('Read More', 'codexin') ); ?></a>
							 				<?php endif; ?>
						 				</div>
						 			</div>
						 		</div>
					 		<?php 
					 		endwhile;
				 		endif; 
				 		wp_reset_postdata(); ?>
				 	</div>
			 	</div> <!-- end of cx-events-wrapper-2 -->
				<div class="clearfix"></div>
				<?php if( $show_all ): ?>
				<div class="events-view-all">
					<?php if( $href ): ?>
					<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>  class="cx-events-btn"><?php echo esc_html( !empty( $button_text_all ) ? $button_text_all : __('View All', 'codexin') ); ?></a>
					<?php else: ?>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'events' ) ); ?>" class="cx-events-btn"><?php echo esc_html( !empty( $button_text_all ) ? $button_text_all : __('View All', 'codexin') ); ?></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div> <!-- end of cx-events-description -->
		<?php endif; 

		if( $layout == 3 ) : 

			// Retrieving user define classes
			$classes = array( 'cx-events-wrapper-3' );
			(!empty($class)) ? $classes[] = $class : ''; 

			// Retrieving the url
			$retrieve_link = retrieve_url( $href );
			$title = ($retrieve_link[1]) ? 'title="'.esc_attr($retrieve_link[1]).'"':'';
			$target = ($retrieve_link[2]) ? 'target="'.esc_attr($retrieve_link[2]).'"':'';

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="row">
				 		<?php 
				 		//start new query..
						if( empty($include) ):
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
								'posts_per_page'		=> $number_of_events
							);

						else:
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
							    'tax_query' 			=> array(
							        array(
							            'taxonomy' => 'events-category',
							            'field'    => 'term_id',
							            'terms'    => $cat_includes,
							        ),
							    ),
							    'posts_per_page'		=> $number_of_events
							);
						endif;

				 		$data = new WP_Query( $args ); 
						if( $data->have_posts() ) :
							while( $data->have_posts() ) : $data->the_post();

							$column = 12/$number_of_events;

							// Retrieving Image alt tag
							$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

							// Retrieving the meta infos
							$start_time = rwmb_meta( 'reveal_event_start_time','type=time' );
							$end_time 	= rwmb_meta( 'reveal_event_end_time','type=time' );
							$address 	= strtolower( rwmb_meta( 'reveal_event_address','type=textarea' ) );
							$date 		= strtotime( rwmb_meta( 'reveal_event_start_date','type=date' ) ); 

							?>
						 		<div class="col-md-<?php echo esc_html( $column ); ?> col-sm-<?php echo ( $column==4 ) ? esc_html($column) : esc_html(6); ?>">
						 			<div class="events-single">
						 				<div class="event-media-wrapper">
						 					<a href="<?php echo esc_url(get_the_permalink()); ?>">
						 						<div class="event-media">
													<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rectangle-four' ) : '//placehold.it/600x327' ); ?>" alt="<?php echo esc_attr($image_alt); ?>">
								 					<?php if( $show_date && !empty( $date ) ): ?>
							 						<div class="event-date">
							 							<i class="fa fa-calendar"></i>
							 							<?php 
															$new_date = date( get_option('date_format'), $date );
															echo esc_html( $new_date );
														?>
							 						</div>
								 					<?php endif; ?>
						 						</div>
						 					</a>
						 					</div>
						 				<div class="events-single-content">
						 					<a href="<?php echo esc_url(get_the_permalink()); ?>"><h3 class="events-single-title"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></h3></a>
											
											<?php if( !empty( $start_time ) || !empty( $end_time ) || !empty( $address ) ): ?>
						 					<ul class="events-meta">
						 						<?php if( $show_time && ( !empty( $start_time ) || !empty( $end_time ) ) ): ?>
						 						<li><i class="fa fa-clock-o"></i>
						 							<?php 

						 							echo esc_html($start_time) . ' - ' . esc_html($end_time);
						 							?> 
						 						</li>
							 					<?php endif; ?>
							 					<?php if( $show_add && !empty( $address ) ): ?>
						 						<li>
						 							<i class="fa fa-map-marker"></i> 
						 							<?php echo esc_html( $address ); ?>
						 						</li>
							 					<?php endif; ?>
						 					</ul>
							 				<?php endif; ?>

						 					<div class="events-single-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?></div>
						 				</div>
					 					<?php if( $readmore ): ?>
					 					<a href="<?php echo esc_url(get_the_permalink()); ?>" class="cx-events-btn-2"><?php echo esc_html( !empty( $button_text ) ? $button_text : __('Read More', 'codexin') ); ?></a>
						 				<?php endif; ?>
						 			</div>
						 		</div>
					 		<?php 
					 		endwhile;
				 		endif; 
				 		wp_reset_postdata(); ?>
				 	</div>
			 	</div> <!-- end of cx-events-wrapper-2 -->

				<div class="clearfix"></div>
				<?php if( $show_all ): ?>
				<div class="events-view-all">
					<?php if( $href ): ?>
					<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>  class="cx-events-btn"><?php echo esc_html( !empty( $button_text_all ) ? $button_text_all : __('View All', 'codexin') ); ?></a>
					<?php else: ?>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'events' ) ); ?>" class="cx-events-btn"><?php echo esc_html( !empty( $button_text_all ) ? $button_text_all : __('View All', 'codexin') ); ?></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div> <!-- end of cx-events-description -->
		<?php endif;

		if( $layout == 4 ) : 

			// Retrieving user define classes
			$classes = array( 'cx-events-wrapper-4' );
			(!empty($class)) ? $classes[] = $class : ''; 

			// Retrieving the url
			$retrieve_link = retrieve_url( $href );
			$title = ($retrieve_link[1]) ? 'title="'.esc_attr($retrieve_link[1]).'"':'';
			$target = ($retrieve_link[2]) ? 'target="'.esc_attr($retrieve_link[2]).'"':'';

			// Passing values to javascript
			$codeopt = '';
			(!empty( $arrow )) ? $slick_arrow = true : $slick_arrow = false;
			(!empty( $dot )) ? $slick_dot = true : $slick_dot = false;
			$codeopt .= '
			<script type="text/javascript">
				var ev_arrow = "' . $slick_arrow . '";
				var ev_dot = "' . $slick_dot . '";
			</script>';
			echo $codeopt;

			?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<div class="row">
						<div class="events-carousel">
					 		<?php 
					 		//start new query..
						if( empty($include) ):
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
								'posts_per_page'		=> -1
							);

						else:
							$args = array(
								'post_type'				=> 'events',
								'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_event_start_date' : '',
								'order'					=> $order,
								'orderby'				=> $orderby,
							    'tax_query' 			=> array(
							        array(
							            'taxonomy' => 'events-category',
							            'field'    => 'term_id',
							            'terms'    => $cat_includes,
							        ),
							    ),
							    'posts_per_page'		=> -1
							);
						endif;

					 		$data = new WP_Query( $args ); 
							if( $data->have_posts() ) :
								while( $data->have_posts() ) : $data->the_post();

								// Retrieving Image alt tag
								$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

								// Retrieving the meta infos
								$address 	= strtolower( rwmb_meta( 'reveal_event_address','type=textarea' ) );
								$date 		= strtotime( rwmb_meta( 'reveal_event_start_date','type=date' ) ); 

								?>
							 		<div class="col-sm-6 item">
							 			<div class="events-single">
							 				<div class="event-media-wrapper">
						 						<div class="event-media">
													<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rectangle-four' ) : '//placehold.it/600x327' ); ?>" alt="<?php echo esc_attr($image_alt); ?>">
								 					<?php if( $readmore ): ?>
								 					<a href="<?php echo esc_url(get_the_permalink()); ?>" class="cx-events-btn"><?php echo esc_html( !empty( $button_text ) ? $button_text : __('Read More', 'codexin') ); ?></a>
									 				<?php endif; ?>
						 						</div>
							 					</div>
							 				<div class="events-single-content">
							 					<a href="<?php echo esc_url(get_the_permalink()); ?>"><h3 class="events-single-title"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></h3></a>
							 					<div class="events-single-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?></div>
							 				</div>
							 				<?php if( $show_date || $show_add ): ?>
	                                        <ul class="events-meta">
	                                            <?php if( $show_add && !empty( $address ) ): ?>
	                                            <li>
	                                                <i class="fa fa-map-marker"></i> 
	                                                <?php echo esc_html( $address ); ?>
	                                            </li>
	                                            <?php endif; ?>
	                                            <?php if( $show_date && !empty( $date ) ): ?>
	                                            	<?php if( $show_add ): ?>
		                                            <li class="pull-right">
		                                            <?php else: ?>
		                                            <li>
		                                            <?php endif; ?>
		                                                <i class="fa fa-calendar"></i>
		                                                <?php 
		                                                    $new_date = date( get_option('date_format'), $date );
		                                                    echo esc_html( $new_date );
		                                                ?>
		                                            </li>
	                                            <?php endif; ?>
	                                        </ul>
		                                    <?php endif; ?>
							 			</div>
							 		</div>
						 		<?php 
						 		endwhile;
					 		endif; 
					 		wp_reset_postdata(); ?>
					 	</div>
				 	</div>
			 	</div> <!-- end of cx-events-wrapper-2 -->

				<div class="clearfix"></div>
				<?php if( $show_all ): ?>
				<div class="events-view-all">
					<?php if( $href ): ?>
					<a href="<?php echo esc_url($retrieve_link[0]); ?>" <?php echo $title; ?> <?php echo $target; ?>  class="cx-events-btn"><?php echo esc_html( !empty( $button_text_all ) ? $button_text_all : __('View All', 'codexin') ); ?></a>
					<?php else: ?>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'events' ) ); ?>" class="cx-events-btn"><?php echo esc_html( !empty( $button_text_all ) ? $button_text_all : __('View All', 'codexin') ); ?></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div> <!-- end of cx-events-description -->
		<?php endif;

	endif;
	$result .= ob_get_clean();
	return $result;

} //End cx_events_mini

// Integrating Shortcode with King Composer
function cx_events_mini_kc() {

	$cx_events_categories = cx_get_custom_categories('events-category');

	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_events_mini' => array(
 					'name' => esc_html__( 'Codexin Mini Events', 'codexin' ),
 					'description' => esc_html__('Mini Events', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
                	//Only load assets when using this element
					'assets' => array(
						'scripts' => array(
							'slick-cx-main-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js',
							'event-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_event.js',
						),
  	        			'styles'	=> array(
  	        				'slick-cx-main-style'	=> CODEXIN_CORE_ASSET_DIR . '/css/slick.css',
        				),

                	), //End assets
 					'params' => array(

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
	    						'label'       	=> esc_html__('Number Of Events to Display', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'2'	=> '2',
    								'3'	=> '3',
    								'4'	=> '4',
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
	    						'label'       	=> esc_html__('Event Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> 'Ascending',
    								'DESC'	=> 'Descending',
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Events', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__('Events Sorting Method', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'meta_value'	 => esc_html__('Event Date', 'codexin'),
    								'name'			 => esc_html__('Event Name', 'codexin'),
    								'rand'			 => esc_html__('Randomize', 'codexin'),
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
	    						'value'			=> '30',
	    						'description'	=> esc_html__('Specify number of Words that you want to show in your excerpt', 'codexin'),
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
 								'label' 		=> __( 'Select Second Icon', 'codexin' ),
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
	    						'description'	=> esc_html__('Choose to enable/disable events carousel navigation arrow', 'codexin'),
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
	    						'description'	=> esc_html__('Choose to enable/disable events carousel pagination', 'codexin'),
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
	    						'description'	=> esc_html__('Choose to enable/disable events time', 'codexin'),
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
	    						'description'	=> esc_html__('Choose to enable/disable events date', 'codexin'),
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
	    						'description'	=> esc_html__('Choose to enable/disable read more button for single event.', 'codexin'),
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
	    						'description'	=> esc_html__('Choose to enable/disable view all events button at the end.', 'codexin'),
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
	    						'label'    		=> esc_html__(' Custom URL for All Events Button', 'codexin'),
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

 										'Title' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'color', 'label' => esc_html__( 'Color On Hover' ), 'selector' => '.panel-title, .events-single:hover h3.events-single-title'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title, h3.events-single-title'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title, h3.events-single-title')
 										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-body p, .events-single-desc'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.panel-body p, .events-single-desc'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-body p, .events-single-desc'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.panel-body p, .events-single-desc'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.panel-body p, .events-single-desc'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.panel-body p, .events-single-desc'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-body p, .events-single-desc'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-body p, .events-single-desc')
 										),

 										'Icon' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title i, .events-meta li i, .event-date i'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title i, .events-meta li i, .event-date i'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title i, .events-meta li i, .event-date i'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title i, .events-meta li i, .event-date i')
 										),

 										'Meta Text' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.events-meta li, .event-date'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.events-meta li, .event-date')
 										),

 										'Image'	=> array(
 											array('property' => 'background', 'label' => esc_html__( 'Background', 'codexin'), 'selector' => '.event-media:before, .event-media:after'),
 										),

 										'Wrapper' => array(
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color', 'codexin'), 'selector' => '.events-single, .events-single-content'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => '.events-single'),
 											array('property' => 'border-color', 'label' => esc_html__( 'Border Color on Hover', 'codexin'), 'selector' => '.events-single:hover'),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin'), 'selector' => '.events-single'),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow on Hover', 'codexin'), 'selector' => '.events-single:hover'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.events-single'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.events-single')
 										),

 										'Button' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2, .cx-events-btn:before'),
 											array('property' => 'color', 'label' => esc_html__( 'Color on Hover', 'codexin'), 'selector' => '.cx-events-btn:hover, .cx-events-btn-2:hover, .cx-events-btn:hover:before'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color on Hover', 'codexin'), 'selector' => '.cx-events-btn:hover, .cx-events-btn-2:hover'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'border-color', 'label' => esc_html__( 'Border Color on Hover', 'codexin'), 'selector' => '.cx-events-btn:hover, .cx-events-btn-2:hover, .events-single:hover .cx-events-btn-2'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align for "View All" Button', 'codexin'), 'selector' => '.events-view-all'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-events-btn, .cx-events-btn-2')
 										),

 										'Tabs'	=> array(
 											array('property' => 'background-color', 'label' => esc_html__( 'Title Tab Background', 'codexin'), 'selector' => '.panel-heading'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Title Tab Background on Hover', 'codexin'), 'selector' => '.panel-heading:hover'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Description Tab Background Color', 'codexin'), 'selector' => '.panel-body'),
 										),

										'Nav' => array(
											array('property' => 'color', 'label' => 'Color of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'background', 'label' => 'Background of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'font-size', 'label' => 'Arrow Font Size of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'margin', 'label' => 'Margin of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'padding', 'label' => 'padding of Nav Arrow', 'selector' => '.slick-slider span.slick-arrow'),
											array('property' => 'background-color', 'label' => 'Color of Dot Nav', 'selector' => '.slick-dots li'),
											array('property' => 'background-color', 'label' => 'Color of Dot Nav on Active State', 'selector' => '.slick-dots li.slick-active'),
											array('property' => 'background-color', 'label' => 'Color of Dot Nav on Hover', 'selector' => '.slick-dots li:hover'),
											array('property' => 'margin', 'label' => 'Margin of Dot Nav', 'selector' => '.slick-dots'),
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


