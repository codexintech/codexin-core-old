<?php

/**
 * Shortcode -  Testimonials
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );
	
// Registering Testimonials Shortcode
function cx_testimonials_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'order'			 	=> '',
		'orderby'		 	=> '',
		'designation'	 	=> '',
		'company'		 	=> '',
		'pagination'	 	=> '',
		'featured_image'	=> '',
		'class'			 	=> '',
	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-testimonials';

	// Retrieving user define classes
	$classes 		= array( 'row' );
	( ! empty( $class ) ) ? $classes[] = $class : ''; 

	ob_start();
	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); echo ( ! $pagination ) ? esc_attr( ' testimonials-no-pagination' ) : ''; ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="col-sm-12 col-md-10 col-md-offset-1">
					<div class="testimonial-lists-wrapper">
						<?php 

						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'post_type'				=> 'testimonial',
							'order'					=> $order,
							'orderby'				=> $orderby,
							'meta_key'				=> ( $orderby == 'meta_value' ) ? 'reveal_author_name' : '',
							'posts_per_page'		=> ( $pagination ) ? '' : -1,
							'paged'					=> $paged
						);
						$data = new WP_Query( $args );

				        if ( $data->have_posts() ) {
				            echo '<div class="testimonial-archive-wrapper">';

					            /* Start the Loop */
					            while ( $data->have_posts() ) {
					            	$data->the_post();

								    $img_alt 		= ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

									$rt_name 		= rwmb_meta( 'reveal_author_name' ); 
									$rt_desig 		= rwmb_meta( 'reveal_author_desig' ); 
									$rt_company 	= rwmb_meta( 'reveal_author_company' ); 
									$post_classes 	= 'clearfix testimonials-list';

									$thumbnail_size = 'codexin-core-square-one';
									if( function_exists( 'codexin_attachment_metas_extended' ) ) {
										$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'testimonial', $thumbnail_size )['src'];
										$caption 		= codexin_attachment_metas_extended( get_the_ID(), 'testimonial', $thumbnail_size )['caption'];
									} else {
										$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/220X220';
									}

							 ?>

									<article id="testimonial-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( array( esc_attr( $post_classes ) ) ); ?>>
									    <div class="testimonial-single reveal-border-1 reveal-bg-1">
									        <div class="testimonial-list-wrapper">
									        	<?php if( $featured_image ) { ?>
									                <div class="thumb-testimonial-wrapper">
									                    <div class="thumb-testimonial">
									                        <img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="reveal-border-0">
									                    </div>
									                </div>
												<?php } ?>
									            <div class="testimonial-content">
									                <h3 class="testimonial-title reveal-color-1"><?php echo esc_html( $rt_name ); ?>
									                	<?php if( $designation || $company ) { ?>
										                    <div class="testimonial-meta">
										                        <?php if( ! empty( $rt_desig ) && $designation ) { ?>
											                        <span><?php echo esc_html( $rt_desig ); ?></span>
										                        <?php } ?>
										                        <?php if( ! empty( $rt_company ) && $company ) { ?>
											                        <span> - <?php printf( '%s', $rt_company ); ?></span>
										                        <?php } ?>
										                    </div>
										                <?php } ?>
									                </h3>
									                <div class="testimonial-text"> <?php printf( '%s', get_the_content() ); ?> </div>
									            </div>
									        </div>									        
									    </div><!-- end of testimonial-single -->
									</article><!-- #testimonial-## -->
								<?php 
					            }
				            echo '</div> <!-- end of testimonial-archive-wrapper -->';
				            echo '<div class="clearfix"></div>';
				            if( $pagination ) {
				            	if( function_exists( 'codexin_numbered_posts_nav' ) ) {
						            echo codexin_numbered_posts_nav( $data );
				            	} else {
									echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
								}
						    }
				        }
				        wp_reset_postdata();
				        ?>
					</div> <!-- end of testimonial-list-wrapper -->
				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of cx-testimonials -->

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_testimonials

// Integrating Shortcode with King Composer
function cx_testimonials_kc() {

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_testimonials' => array(
					'name' 			=> esc_html__( 'Codexin Testimonials', 'codexin' ),
					'description' 	=> esc_html__( 'Codexin Testimonials', 'codexin' ),
					'icon' 			=> 'et-hazardous',
					'category' 		=> 'Codexin',
					'params' 		=> array(
						'general' 	=> array(

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__( 'Testimonial Order', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__( 'Ascending', 'codexin' ),
    								'DESC'	=> esc_html__( 'Descending', 'codexin' ),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Testimonials:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__( 'Testimonial Sorting Method', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => esc_html__( 'Date', 'codexin' ),
    								'meta_value'	 => esc_html__( 'Name', 'codexin' ),
    								'rand'			 => esc_html__( 'Randomize', 'codexin' ),
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Testimonials Sorting Method', 'codexin' ),
	    					),
	                		
							array(
								'name' 			=> 'designation',
								'label' 		=> esc_html__( 'Display Designation? ', 'codexin' ),
								'type' 			=> 'toggle',
								'description'	=> esc_html__( 'Enable to display designation.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'company',
								'label' 		=> esc_html__( 'Display Company Name? ', 'codexin' ),
								'type' 			=> 'toggle',
								'description'	=> esc_html__( 'Enable to display Company name.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'featured_image',
								'label' 		=> esc_html__( 'Display Featured Image? ', 'codexin' ),
								'type' 			=> 'toggle',
								'description'	=> esc_html__( 'Enable to display Featured Image of Tesimonial.', 'codexin' ),
								'value'			=> 'yes'
							),

							array(
								'name' 			=> 'pagination',
								'label' 		=> esc_html__( 'Enable Pagination? ', 'codexin' ),
								'type' 			=> 'toggle',
								'description'	=> esc_html__( 'Enable to display pagination.', 'codexin' ),
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
			) //end of array 
		);  //end of kc_add_map....
	} //End if
} // end of cx_testimonials_kc


