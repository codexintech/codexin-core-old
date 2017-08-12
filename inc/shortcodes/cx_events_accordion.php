<?php


/*
    ===========================================
        CODEXIN EVENTS ACCORDION SHORTCODE
    ===========================================
*/

// Registering Events Box Shortcode
function cx_events_accordion_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'event_icon_one'	=> '',
		'event_icon_two'	=> '',
		'event_icon_three'	=> '',
		'class'				=> '',
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'events-description';

	// Retrieving user define classes
	$classes = array( 'panel-group' );
	(!empty($class)) ? $classes[] = $class : '';

	$result = '';

	ob_start(); ?>
	
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

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_events_accordion

// Integrating Shortcode with King Composer
function cx_events_accordion_kc() {

	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_events_accordion' => array(
 					'name' => esc_html__( 'Codexin Events Accordion', 'codexin' ),
 					'description' => esc_html__('Events Accordion', 'codexin'),
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
 								'name' 			=> 'event_icon_one',
 								'label' 		=> esc_html__( 'Select First Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'description'	=> esc_html__( 'Select Event First Icon Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'event_icon_two',
 								'label' 		=> __( 'Select Second Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
 								'description'	=> esc_html__( 'Select Event Second Icon Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'event_icon_three',
 								'label' 		=> esc_html__( 'Select Third Icon', 'codexin' ),
 								'type' 			=> 'icon_picker',
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

 										'Icon' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title i'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title i'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title i'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title i')
 										),

 										'Box'	=> array(
 											array('property' => 'background'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin')),
 											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin')),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin')),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow on Hover', 'codexin')),
 											array('property' => 'transition', 'label' => esc_html__( 'Hover Transition Animation', 'codexin')),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin')),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin')),
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
} // end of cx_events_accordion_shortcode_kc


