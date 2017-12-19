<?php


/*
    ======================================
        CODEXIN TEAM SHORTCODE
    ======================================
*/
	
// Registering Team Shortcode
function cx_team_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'order'			 	=> '',
			'orderby'		 	=> '',
			'designation'	 	=> '',
			'class'			 	=> '',
	), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-team-grid-wrapper';

	// Retrieving user define classes
	$classes = array( 'team-wrapper' );
	(!empty($class)) ? $classes[] = $class : ''; 

	ob_start();
	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php 

				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$args = array(
					'post_type'				=> 'team',
					'order'					=> $order,
					'orderby'				=> $orderby,
					'paged'					=> $paged,
					'posts_per_page'		=> -1,
				);
				$data = new WP_Query( $args );

		        if ( $data->have_posts() ) :
		            echo '<ul>';

		            /* Start the Loop */
		            while ( $data->have_posts() ) : $data->the_post();

						if( function_exists( 'retrieve_alt_tag' ) ):
						    $img_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();
						endif;

						$r_team_desig = rwmb_meta( 'reveal_team_designation','type=text' );

				 ?>

						<li id="team-<?php the_ID(); ?>" <?php post_class(); ?>>
							<a href="<?php echo esc_url(get_the_permalink()); ?>">
							   <figure>
							      <div class="team-single-wrapper">
							         <img src="<?php esc_url(the_post_thumbnail_url('codexin-core-square-two'));  ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
							         <figcaption>
							            <div class="team-info-wrapper reveal-color-2">
							            	<?php if( $designation ): ?>
												<span><?php echo esc_html( $r_team_desig ); ?></span>
											<?php endif; ?>
											<h3><?php printf( '%s', the_title() ); ?></h3>
							            </div> <!-- end of team-info-wrapper -->
							         </figcaption>
							      </div> <!-- end of team-single-wrapper -->
							   </figure>
							</a>
						</li>

					<?php 
		            endwhile; 
		            echo '</ul>';
		            echo '<div class="clearfix"></div>';
					if( function_exists( 'codexin_numbered_posts_nav' ) ) {
				        echo codexin_numbered_posts_nav( $data );
					} else {
						echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
					}
		        endif; ?>
			</div> <!-- end of team-wrapper -->
		</div> <!-- end of team-main-wrapper -->

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_team

// Integrating Shortcode with King Composer
function cx_team_kc() {

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_team' => array(
					'name' => esc_html__( 'Codexin Team', 'codexin' ),
					'description' => esc_html__('Codexin Team', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					'params' => array(
						'general' => array(

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__('Team Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__('Ascending', 'codexin'),
    								'DESC'	=> esc_html__('Descending', 'codexin'),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Team:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__('Team Sorting Method', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => esc_html__('Date', 'codexin'),
    								'name'			 => esc_html__('Name', 'codexin'),
    								'rand'			 => esc_html__('Randomize', 'codexin'),
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Team Sorting Method', 'codexin' ),
	    					),
	                		
							array(
								'name' 			=> 'designation',
								'label' 		=> __( 'Display Designation? ', 'codexin' ),
								'type' 			=> 'toggle',
								'description'	=> esc_html__( 'Enable to display designation.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'class',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
							),

	                	), //End general array..

	                ), //End params array()..

	            ),  // End of elemnt cx_testimonial

			) //end of  array 

		);  //end of kc_add_map....

	} //End if

} // end of cx_team_kc


