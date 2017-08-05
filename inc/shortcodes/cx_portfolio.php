<?php
	function cx_portfolio_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> '',
	   ), $atts));

	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'portfolios';
	   $classes = array( 'portfolio-area' );
	   (!empty($class)) ? $classes[] = $class : '';

	   $result = '';

	   ob_start(); 
		?>
		
		<section id="portfolio" class="<?php echo esc_attr( implode( ' ', $master_class )); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" >
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="portfolio-filter">
								<ul class="list-inline">
									<li class="active" data-filter="*">All</li>
									<?php 
									$taxonomy = 'portfolio-category';
									$taxonomies = get_terms($taxonomy); 
									foreach ( $taxonomies as $tax ) {
										echo '<li data-filter=".' .strtolower($tax->slug) .'" >' . $tax->name . '</li>';

									}
									?>
								</ul>
							</div><!--/.portfolio-filter-->
						</div><!--/.col-xs-12-->
					</div> <!-- end of row -->
				</div> <!-- end of container -->

				<div class="portfolio-wrapper">
				<?php 
					//start wp query..
					$args = array(
						'post_type'			=> 'portfolio',
						'orderby'			=> 'data',
						'order'				=> 'DESC',
						'posts_per_page'	=> -1
						);
					$data = new WP_Query( $args );
					//Check post
					if( $data->have_posts() ) :
						//startloop here..
						while( $data->have_posts() ) : $data->the_post(); 

							$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 
				 	?>
							<div class="portfolio <?php foreach ($term_list as $sterm) { echo $sterm->slug.' '; } ?>">
								<img src="<?php echo esc_url( the_post_thumbnail_url( 'portfolio-mini-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
								<a href="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>" class="portfolio-img-popup">
									<div class="image-mask">
										<div class="image-content">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/images/portfolio/hover-icon.png" alt="">
											<h3><?php echo esc_html( the_title() ); ?></h3>
											<p>
												<?php foreach ( $term_list as $sterm ) { echo $sterm->name . " "; } ?>
											</p>
										</div>
									</div>
								</a>
							</div>

					<?php 
							endwhile;
						endif;
						wp_reset_postdata();
					 ?>

				</div> <!-- end of portfolio-wrapper -->
			</div><!--/.portfolio-area -->
		</section> <!-- end of portfolio -->

		<?php
		$result .= ob_get_clean();
		return $result;

 } //End cx_portfolio


 function cx_portfolio_kc() {

 	if (function_exists('kc_add_map')) 
 	{ 
 		kc_add_map(
 			array(
 				'cx_portfolio' => array(
 					'name' => esc_html__( 'Codexin Portfolio', 'codexin' ),
 					'description' => esc_html__('Portfolio Section', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
	                //Only load assets when using this element
 					'assets' => array(
 						'scripts' => array(
 							'imagesloaded-js' => CODEXIN_CORE_ASSET_DIR . '/js/imagesloaded.pkgd.min.js',
 							'isotope-js-script' => CODEXIN_CORE_ASSET_DIR . '/js/isotope.pkgd.min.js',
 							'portfolio-isotope-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_portfolio-isotope.js',
 							'portfolio-popup-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_portfolio-popup.js',
 							),

	                ), //End assets

 					'params' => array(
 						array(
 							'name'	=> 'class',
 							'label' => esc_html__( 'Extra Class', 'codexin' ),
 							'type'	=> 'text',
 							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
 						),

	                ) //End params array()..

	            ),  // End of elemnt cx_portfolio


				) //end of  array 


			);  //end of kc_add_map....

		} //End if

	} // end of cx_team_kc


