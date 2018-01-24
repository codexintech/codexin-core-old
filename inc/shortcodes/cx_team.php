<?php

/**
 * Shortcode -  Team
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );
	
// Registering Team Shortcode
function cx_team_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'order'			 	=> '',
		'orderby'		 	=> '',
		'designation'	 	=> '',
		'class'			 	=> '',
	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-team-grid-wrapper';

	// Retrieving user define classes
	$classes 		= array( 'team-wrapper' );
	( ! empty( $class ) ) ? $classes[] = $class : ''; 

	ob_start();
	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php 

				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'post_type'				=> 'team',
					'order'					=> $order,
					'orderby'				=> $orderby,
					'paged'					=> $paged,
					'posts_per_page'		=> -1,
				);
				$data = new WP_Query( $args );

		        if ( $data->have_posts() ) {
		            echo '<ul>';

		            /* Start the Loop */
		            while ( $data->have_posts() ) {

		            	$data->the_post();
					    $img_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();
						$r_team_desig = rwmb_meta( 'reveal_team_designation' );

						$thumbnail_size = 'codexin-core-square-two';
						if( function_exists( 'codexin_attachment_metas_extended' ) ) {
							$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'team', $thumbnail_size )['src'];
							$caption 		= codexin_attachment_metas_extended( get_the_ID(), 'team', $thumbnail_size )['caption'];
						} else {
							$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/500X500';
						}

				 ?>

						<li id="team-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class(); ?>>
							<a href="<?php echo esc_url( get_the_permalink() ); ?>">
							   	<figure>
							      	<div class="team-single-wrapper">
							         	<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
										<div class="team-caption">
								            <div class="team-info-wrapper reveal-color-2">
								            	<?php if( $designation ) { ?>
													<span><?php echo esc_html( $r_team_desig ); ?></span>
												<?php } ?>
												<h3><?php echo esc_html( get_the_title() ); ?></h3>
								            </div> <!-- end of team-info-wrapper -->
										</div>
							      	</div> <!-- end of team-single-wrapper -->
							      	<figcaption><?php echo esc_html( ! empty( ( $caption ) ) ? $caption : get_the_title() ); ?></figcaption>
							   	</figure>
							</a>
						</li>

					<?php 
		            }
		            echo '</ul>';
		            echo '<div class="clearfix"></div>';
					if( function_exists( 'codexin_numbered_posts_nav' ) ) {
				        echo codexin_numbered_posts_nav( $data );
					} else {
						echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
					}
		        }
		        wp_reset_postdata();
		        ?>
			</div> <!-- end of team-wrapper -->
		</div> <!-- end of team-main-wrapper -->

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_team

// Integrating Shortcode with King Composer
function cx_team_kc() {

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_team' => array(
					'name' 			=> esc_html__( 'Codexin Team', 'codexin' ),
					'description' 	=> esc_html__( 'Codexin Team', 'codexin' ),
					'icon' 			=> 'et-hazardous',
					'category' 		=> 'Codexin',
					'params' 		=> array(
						'general' 	=> array(

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__( 'Team Order', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__( 'Ascending', 'codexin' ),
    								'DESC'	=> esc_html__( 'Descending', 'codexin' ),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Team:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__( 'Team Sorting Method', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => esc_html__( 'Date', 'codexin' ),
    								'name'			 => esc_html__( 'Name', 'codexin' ),
    								'rand'			 => esc_html__( 'Randomize', 'codexin' ),
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Team Sorting Method', 'codexin' ),
	    					),
	                		
							array(
								'name' 			=> 'designation',
								'label' 		=> esc_html__( 'Display Designation? ', 'codexin' ),
								'type' 			=> 'toggle',
								'description'	=> esc_html__( 'Enable to display designation.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'class',
								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
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


