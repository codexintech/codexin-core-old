<?php


/*
    ======================================
        CODEXIN PORTFOLIO SHORTCODE
    ======================================
*/

// Registering Portfolio Shortcode
function cx_portfolio_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'img_alt'	=> '',
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'portfolios';

	// Retrieving user define classes
	$classes = array( 'portfolio-area' );
	(!empty($class)) ? $classes[] = $class : '';

	$result = '';

	ob_start(); ?>
	
		<div class="<?php echo esc_attr( implode( ' ', $master_class )); ?>">
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
							</div><!--end of portfolio-filter-->
						</div><!--end of col-xs-12-->
					</div> <!-- end of row -->
				</div> <!-- end of container -->

	            <div class="portfolio-wrapper image-pop-up" itemscope itemtype="http://schema.org/ImageGallery">

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

							global $post;
				            $image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
				            $data_size  = $image['width'] . 'x' . $image['height'];
				            $image_alt  = ( !empty( $image['alt'] ) ) ? 'alt="' . esc_attr( $image['alt'] ) . '"' : 'alt="' .get_the_title() . '"';
				            $image_cap  = $image['caption'];

				 	?>
							<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="portfolio <?php foreach ($term_list as $sterm) { echo $sterm->slug.' '; } ?>">
							    <a href="<?php esc_url( the_post_thumbnail_url('full') ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
							        <img src="<?php esc_url( the_post_thumbnail_url('portfolio-mini-image') ); ?>" itemprop="thumbnail" <?php echo $image_alt; ?> class="img-responsive" />
							    </a>
							    <figcaption itemprop="caption description"><?php echo esc_html( $image_cap ); ?></figcaption>
								<div class="image-mask">
									<div class="image-content">
										<a href="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/images/portfolio/hover-icon.png" alt="Hover Icon">
										</a>
										<h3 class="portfolio-title"> <a href="<?php the_permalink(); ?>" class="clickable"> <?php echo esc_html( get_the_title() ); ?> </a></h3>
										<p><?php foreach ( $term_list as $sterm ) { echo $sterm->name . " "; } ?></p>
									</div>
								</div>
							</figure>

					<?php 
							endwhile;
						endif;
						wp_reset_postdata();
					 ?>
	            </div><!-- end of portfolio-wrapper -->
			</div><!-- end of portfolio-area -->
		</div> <!-- end of portfolios -->

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_portfolio

// Integrating Shortcode with King Composer
function cx_portfolio_kc() {

	if (function_exists('kc_add_map')) { 
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
							'portfolio-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx-portfolio-isotope.js',
							'photswipe-js' => CODEXIN_CORE_ASSET_DIR . '/js/photoswipe.min.js',
							'photswipe-main-js' => CODEXIN_CORE_ASSET_DIR . '/js/photoswipe-main.js',
						),
		                'styles' => array(
		            	    'photoswipe-stylesheet' => CODEXIN_CORE_ASSET_DIR . '/css/photoswipe.css',
		                )

                	), //End assets

					'params' => array(
						array(
							'name'	=> 'class',
							'label' => esc_html__( 'Extra Class', 'codexin' ),
							'type'	=> 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
						),
                	) //End params
            	),  // End of elemnt cx_portfolio
			) //end of array 
		);  //end of kc_add_map
	} //End if
} // end of cx_team_kc


