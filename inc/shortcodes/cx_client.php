<?php
	function cx_client_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> 'Portfolio Image',
	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		<div id="clients" class="clients">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div id="client-carousel" class="owl-carousel">
							<?php 
								//start wp query..
								$args = array(
									'post_type'			=> 'clients',
									'orderby'			=> 'data',
									'order'				=> 'DESC',
									'posts_per_page'	=> -1
									);
								$data = new WP_Query( $args );
								//Check post
								if( $data->have_posts() ) :
									//startloop here..
									while( $data->have_posts() ) : $data->the_post();
										$client_url = rwmb_meta( 'reveal_clients_surl', 'type=text' );
								?>
											<div class="item">
												<a href="<?php if( ! empty( $client_url ) ) : echo esc_url( $client_url ); endif; ?>"><img src="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>"/></a>
											</div>

								<?php
										endwhile;
									endif;
									wp_reset_postdata();
								 ?>			

						</div> <!--/#client-carousel-->				
					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of container -->
		</div> <!-- end of clients -->

		<?php
		$result .= ob_get_clean();
		return $result;

 } //End cx_client


 function cx_client_kc() {

 	if (function_exists('kc_add_map')) 
 	{ 
 		kc_add_map(
 			array(
 				'cx_client' => array(
 					'name' => esc_html__( 'Codexin Clients', 'codexin' ),
 					'description' => esc_html__('Clients Section', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
	                //Only load assets when using this element
 					'assets' => array(
 						'scripts' => array(
 							'owl-carousel-js' => CODEXIN_CORE_ASSET_DIR . '/js/owl.carousel.min.js',
 							'client-carousel-script' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_client-carousel.js',
 							),

	                ), //End assets
 					'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_client


				) //end of  array 


			);  //end of kc_add_map....

		} //End if

	} // end of cx_team_kc


