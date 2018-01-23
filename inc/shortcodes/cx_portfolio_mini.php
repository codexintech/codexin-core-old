<?php

/**
 * Shortcode -  Mini Portfolio
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Mini Portfolio Shortcode
function cx_portfolio_mini_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'layout'					=> '',
		'number_of_portfolios'		=> '',
		'show_filter'				=> '',
		'type_mode'     	 		=> '',
		'column'      				=> '',
		'column_gutter'      		=> '',
		'include'					=> '',
		'order'						=> '',
		'show_icon'					=> '',
		'icon'						=> '',
		'read_more'     			=> '',
		'read_more_text' 			=> '',
		'show_view_btn'				=> '',
		'button_text_all'			=> '',
		'href'		=> '',
		'class'						=> '',
	), $atts ) );

	$result = '';
	$render_view_all = '';
	$render_filter = '';

	// Retrieving the url
	$retrieve_link 	= codexin_retrieve_url( $href );
	$title 			= ( $retrieve_link[1] ) ? 'title="'. esc_attr( $retrieve_link[1] ) .'"' : '';
	$target 		= ( $retrieve_link[2] ) ? 'target="'. esc_attr( $retrieve_link[2] ) .'"' : '';

	// Rendering view all button
	$render_view_all .= '<div class="cx-color-0 cx-primary-btn cx-btn">';
		if( $href ) {
			$render_view_all .= '<a href="'. esc_url( $retrieve_link[0] ) .'" '. $title .' '. $target .' class="cx-btn-text">';
				$render_view_all .= ( ! empty( $button_text_all ) ? $button_text_all : esc_html__( 'View All', 'codexin' ) );
			$render_view_all .= '</a>';
		} else {
			$render_view_all .= '<a href="'. esc_url( get_post_type_archive_link( 'portfolio' ) ) .'" class="cx-btn-text">';
				$render_view_all .= ( ! empty( $button_text_all ) ? $button_text_all : esc_html__( 'View All', 'codexin' ) );
			$render_view_all .= '</a>';
		}
	$render_view_all .= '</div>';

	// Rendering filter buttons
	$render_filter .= '<div class="row">';
		$render_filter .= '<div class="col-xs-12">';
			$render_filter .= '<div class="portfolio-filter">';
				$render_filter .= '<ul class="list-inline">';
					$render_filter .= '<li class="active" data-filter="*">'. esc_html__( 'All', 'codexin' ) .'</li>';
					$taxonomy = get_terms( 'portfolio-category' ); 
					foreach( $taxonomy as $tax_arr ) {
						$taxonomies[] = $tax_arr->term_id;
					}
					$filtered_cat = ! empty( $include ) ? $cat_includes : $taxonomies;
					$val = '';
					foreach( $filtered_cat as $tax ) {
						$val = get_term_by( 'id', $tax, 'portfolio-category' );
						$render_filter .= '<li data-filter=".'. strtolower( $val->slug ) .'" >' . $val->name . '</li>';
					}
				$render_filter .= '</ul>';
			$render_filter .= '</div> <!--end of portfolio-filter-->';
		$render_filter .= '</div> <!--end of col-->';
	$render_filter .= '</div> <!-- end of row -->';

	// Extracting user included categories
	$cat_include 	= str_replace( ',', ' ', $include );
	$cat_includes 	= explode( " ", $cat_include );

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-portfolios';

	// Buiding up args for query
	$args = array(
		'post_type'			=> 'portfolio',
		'order'				=> $order,
		'orderby'			=> 'date',
		'posts_per_page'	=> ! empty( $number_of_portfolios ) ? $number_of_portfolios : -1
	);

    if( ! empty( $include ) ) {
        $args['tax_query'] = array(
	        array(
	            'taxonomy' => 'portfolio-category',
	            'field'    => 'term_id',
	            'terms'    => $cat_includes,
	        ),
        );
    }

	ob_start(); 

	if( ! empty( $layout ) ) {

		if( $layout == 1 ) {
		// Retrieving user define classes
		$classes = array( 'portfolio-wrapper-1' );
		( ! empty( $class ) ) ? $classes[] = $class : ''; ?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class )); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" >
				<?php 
				if( $show_filter ) {
					printf( '%s', $render_filter );
				}
				?>

	            <div class="portfolio-item-wrapper image-pop-up" itemscope itemtype="http://schema.org/ImageGallery">

					<?php 

					$data = new WP_Query( $args );
					$i = 0;
					//Check post
					if( $data->have_posts() ) {
						//start loop here..
						while( $data->have_posts() ) {
							$data->the_post(); 
							$i++;
							$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 

							global $post;
				            $image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
				            $data_size  = ( ! empty( $image['width'] && ! empty( $image['height'] ) ) ) ? $image['width'] . 'x' . $image['height'] : '1920x1080';
				            $image_alt  = ( ! empty( $image['alt'] ) ) ? 'alt="' . esc_attr( $image['alt'] ) .'"' : 'alt="'. get_the_title() .'"';
				            $image_cap  = $image['caption'];

				            $thumbnail_size = 'codexin-core-rectangle-two';

							if( function_exists( 'codexin_attachment_metas_extended' ) ) {
								$post_thumbnail 	 = codexin_attachment_metas_extended( get_the_ID(), 'portfolio', $thumbnail_size )['src'];
								$post_thumbnail_full = codexin_attachment_metas_extended( get_the_ID(), 'portfolio', 'full' )['src'];
							} else {
								$post_thumbnail 	 = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/570X464';
								$post_thumbnail_full = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '//placehold.it/1920X1080';
							}

					?>
							<div class="portfolio cx-portfolio cx-color-2 pad-0 <?php foreach( $term_list as $sterm ) { echo esc_attr( $sterm->slug ).' '; }?>" <?php if( ! empty( $column ) ) { echo 'style="width: '. esc_attr( $column ) .'"'; } ?>>
								<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php echo ( ! empty( $column_gutter ) ) ? ' style="margin: '. esc_attr( $column_gutter ) .'px;" class="item-'. esc_attr( $i ) .'"' : '' ?>>
								    <a <?php if( ! empty( $column_gutter ) ) { echo 'class="no-transform"'; } ?> style="background-image: url('<?php echo esc_url( $post_thumbnail_full ); ?>');" href="<?php echo esc_url( $post_thumbnail_full ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
										<?php if( $type_mode == '2' ) { ?>
									        <img src="<?php echo esc_url( $post_thumbnail_full ); ?>" itemprop="thumbnail" <?php echo sprintf( '%s', $image_alt ); ?> class="img-responsive" />

									    <?php } else { ?>  
									        <img src="<?php echo esc_url( $post_thumbnail ); ?>" itemprop="thumbnail" <?php echo sprintf( '%s', $image_alt ); ?> class="img-responsive" />
									    <?php } ?> 
								    </a>

								    <figcaption itemprop="caption description"><?php echo esc_html( $image_cap ); ?></figcaption>
									<div class="image-mask<?php echo ( empty( $column_gutter ) ? esc_attr( ' add-transform' ) : '' );?>">
										<div class="image-content">
											<a href="<?php echo esc_url( $post_thumbnail_full ); ?>">
												<?php if( ( $show_icon == 'yes' ) && ! empty( 'icon' ) ) { ?>
													<i class="<?php echo esc_attr( $icon ); ?>"></i>
												<?php } ?>
											</a>
											<h3 class="portfolio-title"> <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="clickable"> <?php echo esc_html( get_the_title() ); ?> </a></h3>
											<?php if( ( $read_more == 'yes' ) && ! empty( 'read_more_text' ) ) { ?>
												<p class="portfolio-readmore"><a href="<?php echo esc_url( get_the_permalink() ); ?>" class="clickable"><?php echo esc_html( $read_more_text ); ?></a>
												</p>
											<?php } ?>
										</div>
									</div> <!-- end of image-mask -->
								</figure>
							</div> <!-- end of cx-portfolio -->

					<?php 
						}
					}
					wp_reset_postdata();
					?>
	            </div><!-- end of portfolio-item-wrapper -->
				
				<?php 
				if( $show_view_btn ) { 
					printf( '%s', $render_view_all );
				}
				?>	
			</div><!-- end of portfolio-wrapper-1 -->
		</div> <!-- end of cx-portfolios -->
		<div class="clearfix"></div>

		<?php } // End layout - 1

		if( $layout == 2 ) {
			// Retrieving user define classes
			$classes = array( 'portfolio-wrapper-2' );
			( ! empty( $class ) ) ? $classes[] = $class : ''; ?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php 
					if( $show_filter ) {
						printf( '%s', $render_filter );
					}
					?>

					<div class="portfolio-item-wrapper image-pop-up" itemscope itemtype="http://schema.org/ImageGallery">

						<?php 

						$args['posts_per_page'] = 5;
						$data = new WP_Query( $args );
						$i = 0;
						//Check post
						if( $data->have_posts() ) {
							//start loop here..
							while( $data->have_posts() ) {
								$data->the_post(); 
								$i++;

								$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

								global $post;
					            $image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
					            $data_size  = ( ! empty( $image['width'] && ! empty( $image['height'] ) ) ) ? $image['width'] . 'x' . $image['height'] : '1920x1080';
					            $image_alt  = ( ! empty( $image['alt'] ) ) ? 'alt="'. esc_attr( $image['alt'] ) .'"' : 'alt="'. get_the_title() .'"';
					            $image_cap  = $image['caption'];

					            $thumbnail_size = 'codexin-core-rectangle-five';

								if( function_exists( 'codexin_attachment_metas_extended' ) ) {
									$post_thumbnail 	 = codexin_attachment_metas_extended( get_the_ID(), 'portfolio', $thumbnail_size )['src'];
									$post_thumbnail_full = codexin_attachment_metas_extended( get_the_ID(), 'portfolio', 'full' )['src'];
								} else {
									$post_thumbnail 	 = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/740X480';
									$post_thumbnail_full = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '//placehold.it/1920X1080';
								}

								$height = ( $i != 1 ) ? 250 : 500 + 2 * $column_gutter;
						?>
								<div class="portfolio cx-portfolio cx-color-2 col-xs-12 col-sm-4<?php echo ($i == 1) ? esc_attr( ' long-height' ) : esc_attr( ' short-height' ); ?> pad-0 <?php foreach( $term_list as $sterm ) { echo esc_attr( $sterm->slug ).' '; }?>">
									<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php echo ( ! empty( $column_gutter ) ) ? ' style="margin: '. esc_attr( $column_gutter ) .'px; height: '. esc_attr( $height ).'px"; class="item-'. esc_attr( $i ).'"' : '' ?>>
									    <a <?php if( ! empty( $column_gutter ) ) { echo 'class="no-transform"'; } ?> style="background-image: url('<?php echo esc_url( $post_thumbnail_full ); ?>');" href="<?php echo esc_url( $post_thumbnail_full ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
									        <img src="<?php echo esc_url( $post_thumbnail ); ?>" itemprop="thumbnail" class="img-responsive" <?php echo sprintf( '%s', $image_alt ); ?> />
									    </a>  
								    <figcaption itemprop="caption description"></figcaption>
										<div class="image-mask<?php echo ( empty( $column_gutter ) ? esc_attr( ' add-transform' ) : '' );?>">
											<div class="image-content">
												<a href="<?php echo esc_url( $post_thumbnail_full ); ?>">
													<?php if( ( $show_icon == 'yes' ) && ! empty( 'icon' ) ) { ?>
														<i class="<?php echo esc_attr( $icon ); ?>"></i>
													<?php } ?>
												</a>
												<h3 class="portfolio-title"> <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="clickable"> <?php echo esc_html( get_the_title() ); ?> </a></h3>
												<?php if( ( $read_more == 'yes' ) && ! empty( 'read_more_text' ) ) { ?>
													<p class="portfolio-readmore"><a href="<?php echo esc_url( get_the_permalink() ); ?>" class="clickable"><?php echo esc_html( $read_more_text ); ?></a></p>
												<?php } ?>
											</div>
										</div>
									</figure>
								</div>
						
						<?php 
							}
						}
						wp_reset_postdata();
						?>
					</div> <!-- end of portfolio-item-wrapper -->

					<?php 
					if( $show_view_btn ) { 
						printf( '%s', $render_view_all );
					}
					?>
				</div> <!-- end of portfolio-wrapper-2-->
			</div> <!-- end of cx-portfolios-->
			<div class="clearfix"></div>

		<?php } // End Layout - 2

		if( $layout == 3 ) {

		  	// Retrieving user define classes
		  	$classes = array( 'portfolio-wrapper-3' );
		  	( ! empty( $class ) ) ? $classes[] = $class : ''; ?>

		  	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		  		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

					<?php 
					if( $show_filter ) {
						printf( '%s', $render_filter );
					}
					?>
					
		  			<div class="portfolio-item-wrapper image-pop-up responsive-class" itemscope itemtype="http://schema.org/ImageGallery">
		  				<?php 
						//start wp query..
		  				$args['posts_per_page'] = 5;
		  				$data = new WP_Query( $args );
		  				$i = 0;
						//Check post
		  				if( $data->have_posts() ) {
							//start loop here..
		  					while( $data->have_posts() ) {
		  						$data->the_post(); 
		  						$i++;

				  				$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 

				  				global $post;
				  				$image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
					            $data_size  = ( ! empty( $image['width'] && ! empty( $image['height'] ) ) ) ? $image['width'] . 'x' . $image['height'] : '1920x1080';
				  				$image_alt  = ( !empty( $image['alt'] ) ) ? 'alt="' . esc_attr( $image['alt'] ) . '"' : 'alt="' .get_the_title() . '"';
				  				$image_cap  = $image['caption'];

					            $thumbnail_size = 'codexin-core-rectangle-five';

								if( function_exists( 'codexin_attachment_metas_extended' ) ) {
									$post_thumbnail 	 = codexin_attachment_metas_extended( get_the_ID(), 'portfolio', $thumbnail_size )['src'];
									$post_thumbnail_full = codexin_attachment_metas_extended( get_the_ID(), 'portfolio', 'full' )['src'];
								} else {
									$post_thumbnail 	 = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/740X480';
									$post_thumbnail_full = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '//placehold.it/1920X1080';
								}

								$height = ( $i != 2 ) ? 250 : 500 + 2 * $column_gutter;

				  				?>

								<div class="portfolio cx-portfolio cx-color-2 col-xs-12 <?php echo ( $i != 2 ) ? esc_attr( 'col-sm-3 quarter' ) : esc_attr( 'col-sm-6 half' ); ?> pad-0 <?php foreach( $term_list as $sterm ) { echo esc_attr( $sterm->slug ).' '; }?>">
									<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php echo ( ! empty( $column_gutter ) ) ? ' style="margin: '. esc_attr( $column_gutter ) .'px; height: '. esc_attr( $height ).'px"; class="item-'. esc_attr( $i ).'"' : '' ?>>
									    <a <?php if( ! empty( $column_gutter ) ) { echo 'class="no-transform"'; } ?> style="background-image: url('<?php echo esc_url( $post_thumbnail_full ); ?>');" href="<?php echo esc_url( $post_thumbnail_full ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
									        <img src="<?php echo esc_url( $post_thumbnail ); ?>" itemprop="thumbnail" class="img-responsive" <?php echo sprintf( '%s', $image_alt ); ?> />
									    </a>  
								    <figcaption itemprop="caption description"></figcaption>
										<div class="image-mask<?php echo ( empty( $column_gutter ) ? ' add-transform' : '' );?>">
											<div class="image-content">
												<a href="<?php echo esc_url( $post_thumbnail_full ); ?>">
													<?php if( ( $show_icon == 'yes' ) && ! empty( 'icon' ) ) { ?>
														<i class="<?php echo esc_attr( $icon ); ?>"></i>
													<?php } ?>
												</a>
												<h3 class="portfolio-title"> <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="clickable"> <?php echo esc_html( get_the_title() ); ?> </a></h3>
												<?php if( ( $read_more == 'yes' ) && ! empty( 'read_more_text' ) ) { ?>
													<p class="portfolio-readmore"><a href="<?php echo esc_url( get_the_permalink() ); ?>" class="clickable"><?php echo esc_html( $read_more_text ); ?></a></p>
												<?php } ?>
											</div>
										</div>
									</figure>
								</div>		  						

		  					<?php 
			  				}
		  				}
		  				wp_reset_postdata();
		  				?>

		  			</div> <!-- end of portfolio-item-wrapper -->
					<?php 
					if( $show_view_btn ) { 
						printf( '%s', $render_view_all );
					}
					?>
				</div> <!-- end of portfolio-wrapper-3  -->
		  	</div> <!-- end of cx-portfolios -->
			<div class="clearfix"></div>
				
		<?php } //End layout - 3 ?>

	<?php } // End Empty Layout ?>

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_portfolio_mini

// Integrating Shortcode with King Composer
function cx_portfolio_mini_kc() {

	$cx_portfolio_categories = codexin_get_custom_categories( 'portfolio-category' );

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_portfolio_mini' => array(
					'name' 			=> esc_html__( 'Codexin Mini Portfolio', 'codexin' ),
					'description' 	=> esc_html__('Mini Portfolio Section', 'codexin'),
					'icon' 			=> 'et-hazardous',
					'category' 		=> 'Codexin',
                	//Only load assets when using this element
					'assets' 		=> array(
						'scripts' 	=> array(
							'imagesloaded-js' 		=> CODEXIN_CORE_ASSET_DIR . '/js/imagesloaded.pkgd.min.js',
							'isotope-js-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/isotope.pkgd.min.js',
							'portfolio-js' 			=> CODEXIN_CORE_JS_DIR . '/cx-portfolio.js',
							'photswipe-script' 		=> CODEXIN_CORE_ASSET_DIR . '/js/photoswipe.min.js',
							'photswipe-main-script' => CODEXIN_CORE_ASSET_DIR . '/js/photoswipe-main.js',
							),
						// 'styles' => array(
						// 	'photoswipe-stylesheet' => CODEXIN_CORE_ASSET_DIR . '/css/photoswipe.css',
						// 	)

                	), //End assets

					'params' => array(
						'General' => array(
							array(
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select Portfolio Style', 'codexin' ),
								'name'			=> 'layout',
								'admin_label'	=> true,
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/portfolio/portfolio-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/portfolio/portfolio-2.png',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/portfolio/portfolio-3.png',
									),
								'value'			=> '1',
								'admin_label' 	=> true,
							),

							array(
	    						'name'        	=> 'number_of_portfolios',
	    						'label'       	=> esc_html__( 'Number of Portfolios to Display', 'codexin' ),
	    						'type'        	=> 'number',
									'relation' 	=> array(
										'parent'	=> 'layout',
										'show_when'	=> '1',
									),
	    						'value'			=> '8',
	    						'description'	=> esc_html__( 'Choose the number of portfolios you want to show. To show all portfolio, leave the field blank', 'codexin' ),
	    					),

	 						array(
	 							'name' 			=> 'include',
	 							'label' 		=> esc_html__( 'Filter Portfolio Categories', 'codexin' ),
	 							'type' 			=> 'multiple',
	 							'options'		=> $cx_portfolio_categories,
	 							'description'	=> esc_html__( 'Choose if You Want to Show Any Specific Portfolio Category/Categories, Control + Click to Select Multiple Categories to Filter (All Categories will be shown by Default)', 'codexin' ),
	 						),

							array(
							  'name' 			=> 'show_filter',
							  'label' 			=> esc_html__( 'Enable Filter? ', 'codexin' ),
							  'type' 			=> 'toggle',
							  'description'		=> esc_html__( 'Choose if You Want to Show portfolio categories as a filter', 'codexin' ),
							  'value'			=> 'yes'
							),

							array(
	    						'name'        	=> 'type_mode',
	    						'label'       	=> esc_html__( 'Portfolio Layout Mode', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'1'	=> esc_html__( 'Rectangle Grid', 'codexin' ),
    								'2'	=> esc_html__( 'Masonry Grid', 'codexin' ),
								),
								'relation' => array(
									'parent'	=> 'layout',
									'show_when'	=> '1',
								),
	    						'value'			=> '1',
	    						'description'	=> esc_html__( 'Choose Portfolio Layout Mode ', 'codexin' ),
	    					),

							array(
	    						'name'        	=> 'column',
	    						'label'       	=> esc_html__( 'No of Column', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'50%'			=> esc_html__( '2 Column', 'codexin' ),
    								'33.33333333%'	=> esc_html__( '3 Column', 'codexin' ),
    								'25%'			=> esc_html__( '4 Column', 'codexin' ),
    								'20%'			=> esc_html__( '5 Column', 'codexin' ),
    								'16.66666666%'	=> esc_html__( '6 Column', 'codexin' ),
    							),

								'relation' => array(
									'parent'	=> 'layout',
									'show_when'	=> '1',
								),
	    						'value'			=> '25%',
	    						'description'	=> esc_html__( 'Choose No. of Column ', 'codexin' ),
	    					),

							array(
	    						'name'        	=> 'column_gutter',
	    						'label'       	=> esc_html__( 'Column Gutter/Gap', 'codexin' ),
	    						'type'        	=> 'text',
	    						'description'	=> esc_html__( 'Column Gutter/Gap on "px". Enter only value. For Example: 5', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__( 'Display Order', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__( 'Ascending', 'codexin' ),
    								'DESC'	=> esc_html__( 'Descending', 'codexin' ),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Portfolios.', 'codexin' ),
	    					),

							array(
							  'name' 			=> 'show_icon',
							  'label' 			=> esc_html__( 'Enable Icon? ', 'codexin' ),
							  'type' 			=> 'toggle',
							),

							array(
								'name'        	=> 'icon',
								'label'       	=> esc_html__( 'Select Hover Icon', 'codexin' ),
								'type'        	=> 'icon_picker',
							    'relation'		=> array(
							    	'parent'	=> 'show_icon',
							    	'show_when'	=> 'yes'
									),
								'value'			=> 'et-focus',
								'description'	=> esc_html__( 'Choose Icon to show on hover.', 'codexin' ),
							),


							array(
								'name' 			=> 'read_more',
								'label' 		=> esc_html__( 'Enable \'Read More\' Button? ', 'codexin' ),
								'type' 			=> 'toggle',
							),


							array(
								'name'			=> 'read_more_text',
								'label' 		=> esc_html__( 'Text For \'Read More\' Button', 'codexin' ),
								'type'			=> 'text',
				                'relation'		=> array(
				                	'parent'	=> 'read_more',
				                	'show_when'	=> 'yes'
			                	),
                				'value' 		=> esc_html__( 'Read More', 'codexin' ),
								'description' 	=> esc_html__( 'Default Text is "Read More"', 'codexin' ),
							),

							array(
								'name' 			=> 'show_view_btn',
								'label' 		=> esc_html__( 'Enable \'View More\' Button? ', 'codexin' ),
								'type' 			=> 'toggle',
							),

 							array(
 								'name' 			=> 'button_text_all',
 								'label' 		=> esc_html__( 'Text For \'View All\' Button', 'codexin' ),
 								'type' 			=> 'text',
 								'relation'		=> array(
 									'parent'	=> 'show_view_btn',
 									'show_when' => 'yes',
 								),
 								'value' 		=> esc_html__( 'View All', 'codexin' ),
 								'description'	=> esc_html__( 'Default Text is "View All"', 'codexin' ),
 							),

	    					array(
	    						'name'     		=> 'href',
	    						'label' 		=> esc_html__( 'Cutom URL For \'View More\' Button', 'codexin' ),
	    						'type'    		=> 'link',
				                'relation'		=> array(
				                	'parent'	=> 'show_view_btn',
				                	'show_when'	=> 'yes'
			                	),
	    						'description' 	=> esc_html__(' The URL which this button assigned to. If not selected, default portfolio archive page URL will be assigned to the button.', 'codexin')
    						),

							array(
								'name'	=> 'class',
								'label' => esc_html__( 'Extra Class', 'codexin' ),
								'type'	=> 'text',
								'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
							),

                		), //End general

						// Style based Params
						'styling' => array(
 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										esc_html__( 'Category Filter', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Filter Button Text Color', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Filter Button Background', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'border', 'label' => esc_html__('Filter Button Border', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'color', 'label' => esc_html__('Filter Button Text Color on Hover', 'codexin'), 'selector' => '.portfolio-filter li:hover'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Filter Button Background Color on Hover', 'codexin'), 'selector' => '.portfolio-filter li:hover'),
 											array( 'property' => 'color', 'label' => esc_html__('Active Button Text Color', 'codexin'), 'selector' => '.portfolio-filter li.active'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Active Button Background', 'codexin'), 'selector' => '.portfolio-filter li.active'),
 											array( 'property' => 'border', 'label' => esc_html__('Active Button Border', 'codexin'), 'selector' => '.portfolio-filter li.active'),
 											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.portfolio-filter li')
										),

 										esc_html__( 'Icon', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.image-content i'),
 											array( 'property' => 'color', 'label' => esc_html__('Hover Color', 'codexin'), 'selector' => '.image-content a:hover i'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.image-content i'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.image-content i'),
 											array( 'property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.image-content i'),
 											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.image-content i'),
 											array( 'property' => 'transition', 'label' => esc_html__('Transition', 'codexin'), 'selector' => '.image-content i'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.image-content i'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.image-content i')
										),

 										esc_html__( 'Title', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.portfolio-title a'),
 											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.portfolio-title'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.portfolio-title'),
 											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.portfolio-title'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.portfolio-title'),
 											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.portfolio-title'),
 											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.portfolio-title'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.portfolio-title'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.portfolio-title')
										),

 										esc_html__( 'Read More Button', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.portfolio-readmore'),
 											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.portfolio-readmore a')
										),

										esc_html__( 'View More Button', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
 											array( 'property' => 'border', 'label' => esc_html__('Button Border', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text'),
											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.cx-btn a.cx-btn-text')
										),


										esc_html__( 'Image Hover', 'codexin' ) => array(
 											array( 'property' => 'background', 'label' => esc_html__('Image Hover Color', 'codexin'), 'selector' => '.image-mask' )
										),
									) 
								) 
							) 
                		), //End styling array..

						// Animate Params
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						),//End animate
					), //End Params
            	),  // End of elemnt cx_portfolio_mini
			) //end of array 
		);  //end of kc_add_map
	} //End if
} // end of cx_portfolio_mini_kc


