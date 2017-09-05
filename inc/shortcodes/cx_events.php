<?php


/*
    =================================
        CODEXIN EVENTS SHORTCODE
    =================================
*/

// Registering Events Box Shortcode
function cx_events_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'layout'			=> '',
		'event_icon_one'	=> '',
		'event_icon_two'	=> '',
		'event_icon_three'	=> '',
		'class'				=> '',
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-events-description';

	// Retrieving user define classes
	$classes = array( 'panel-group' );
	(!empty($class)) ? $classes[] = $class : '';

	$result = '';

	ob_start();

		if( ! empty( $layout ) ) :

			if( $layout == 1 ) :
		?>
	
				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" id="accordion" role="tablist" aria-multiselectable="true">
					<?php 
						//start new query..
						$args = array(
								'post_type'		 => 'events',
								'order' 		 => 'DESC',
								'posts_per_page' => 3,
								);

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
										<i class="<?php echo esc_attr( $event_icon );?>" > </i> <?php echo esc_html( the_title() ); ?>
									</a>
								</h4>
							</div>
							<div id="<?php echo $collapse_id;?>" class="panel-collapse collapse <?php echo $class_in; ?>" role="tabpanel" aria-labelledby="<?php echo $heading_id; ?> ">
								<div class="panel-body">
									<?php printf('%s', the_excerpt() ); ?> 
								</div>
							</div>
						</div><!--end of panel-default-->
							<?php 
							endwhile;
						endif; 
						wp_reset_postdata();  ?>
					</div><!--end of panel-group-->
				</div>  <!-- end of events description -->

		<?php endif;
			if( $layout == 2 ) :
			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'wrapper-event-v2';

			// Retrieving user define classes
			$classes = array( 'rv2-single-event' );
			(!empty($class)) ? $classes[] = $class : ''; 
			//start new query..
			$args = array(
					'post_type'		 => 'events',
					'order' 		 => 'DESC',
					'posts_per_page' => 2,
					);

			$data = new WP_Query( $args ); ?>
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<?php
			if( $data->have_posts() ) :
				while( $data->have_posts() ) : $data->the_post(); ?>

					<div class=" col-sm-6">
						<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
							<div class="event-img">
								<img src="<?php echo get_the_post_thumbnail_url('','event-v2-image' ); ?>" alt=""></div>
							<a href="#">
								<h3 class="title-3"><?php esc_html( the_title() ); ?></h3>
							</a>

							<ul>
								<li><i class="fa fa-clock-o" aria-hidden="true"></i>
								<?php 
									$start_time = rwmb_meta( 'reveal_event_start_time' );
									$end_time 	= rwmb_meta( 'reveal_event_end_time' );
									echo $start_time . ' - ' . $end_time;
								?> 
								</li>
								<li>
									<i class="fa fa-map-marker" aria-hidden="true"></i>  
									<?php echo rwmb_meta( 'reveal_event_address' ); ?>
								</li>
								<li>
									<i class="fa fa-calendar" aria-hidden="true"></i>
									<?php 
										$date = strtotime( rwmb_meta( 'reveal_event_start_date' ) ); 
										$new_date = date( 'd M Y', $date );
										echo $new_date;
									?>
								</li>
							</ul>

							<div class="rv2-event-desc">
								<?php printf('%s', the_excerpt() ); ?>
							</div>
						</div> <!-- end of single-event -->
					</div> <!-- end of col-sm-6 -->

		<?php 
				endwhile;
			endif; 
			wp_reset_postdata(); ?>	

		</div><!-- end of wrapper-event-v2 -->


	<?php endif; //end layout-2 ?>
	<?php
		endif;
	$result .= ob_get_clean();
	return $result;

} //End cx_events

// Integrating Shortcode with King Composer
function cx_events_kc() {

	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_events' => array(
 					'name' => esc_html__( 'Codexin Events', 'codexin' ),
 					'description' => esc_html__('Events', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
                	//Only load assets when using this element
					'assets' => array(
						'scripts' => array(
							'event-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_event.js',
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
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/events/layout-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/events/layout-2.png',
								),
								'value'	=> '1'
							),

 							array(
 								'name' 			=> 'event_icon_one',
 								'label' 		=> esc_html__( 'Select First Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'relation'		=> array(
 									'parent'	=> 'layout',
 									'show_when' => '1',
 								),
 								'description'	=> esc_html__( 'Select Event First Icon Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'event_icon_two',
 								'label' 		=> __( 'Select Second Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'relation'		=> array(
 									'parent'	=> 'layout',
 									'show_when' => '1',
 								),
 								'description'	=> esc_html__( 'Select Event Second Icon Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'event_icon_three',
 								'label' 		=> esc_html__( 'Select Third Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'relation'		=> array(
 									'parent'	=> 'layout',
 									'show_when' => '1',
 								),
 								'description'	=> esc_html__( 'Select Event Third Icon Here', 'codexin' ),
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
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title, .rv2-single-event .title-3'),
 											array('property' => 'color', 'label' => esc_html__( 'Color On Hover' ), 'selector' => '.panel-title, .rv2-single-event:hover h3'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.panel-title, gle-event .title-3'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title, gle-event .title-3'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.panel-title, gle-event .title-3'),
 											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.panel-title, gle-event .title-3'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.panel-title, gle-event .title-3'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title, gle-event .title-3'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title, gle-event .title-3')
 										),

 										'Meta Text' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.rv2-single-event ul li'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.rv2-single-event ul li'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.rv2-single-event ul li'),
 											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.rv2-single-event ul li'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.rv2-single-event ul li'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.rv2-single-event ul li'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.rv2-single-event ul li')
 										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-body p, .rv2-event-desc'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-body p, .rv2-event-desc'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.panel-body p, .rv2-event-desc'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.panel-body p, .rv2-event-desc'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.panel-body p, .rv2-event-desc'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-body p, .rv2-event-desc'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-body p, .rv2-event-desc')
 										),

 										'Icon' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title i,, .panel-title a::after, .rv2-single-event ul i'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title i, .rv2-single-event ul i'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title i, .rv2-single-event ul i'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title i, .rv2-single-event ul i')
 										),

 										'Tabs'	=> array(
 											array('property' => 'background-color', 'label' => esc_html__( 'Title Tab Background', 'codexin'), 'selector' => '.panel-heading'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Title Tab Background on Hover', 'codexin'), 'selector' => '.panel-heading:hover'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Description Tab Background Color', 'codexin'), 'selector' => '.panel-body'),
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
	            ),  // End of elemnt cx_events_accordion
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_events_kc


