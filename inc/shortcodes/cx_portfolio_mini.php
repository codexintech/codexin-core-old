<?php


/*
    ======================================
        CODEXIN MINI PORTFOLIO SHORTCODE
    ======================================
*/

// Registering Mini Portfolio Shortcode
function cx_portfolio_mini_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'section_title' 			=> '',
		'number_of_portfolios'		=> '',
		'type_mode'     	 		=> '',
		'column'      				=> '',
		'column_gutter'      		=> '',
		'order'						=> '',
		'show_icon'					=> '',
		'icon'						=> '',
		'read_more'     			=> '',
		'read_more_text' 			=> '',
		'layout'					=> '',
		'show_view_btn'				=> '',
		'show_view_btn_text'		=> '',
		'show_view_btn_link'		=> '',
		'class'						=> '',
	), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-portfolios';
	ob_start(); 

		if( ! empty( $layout ) ) :

			if( $layout == 1 ) :
			// Retrieving user define classes
			$classes = array( 'portfolio-wrapper-1' );
			(!empty($class)) ? $classes[] = $class : ''; ?>
	
			<div class="<?php echo esc_attr( implode( ' ', $master_class )); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" >

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


		            <div class="portfolio-item-wrapper image-pop-up" itemscope itemtype="http://schema.org/ImageGallery">

					<?php 
						//start wp query..
						$args = array(
							'post_type'			=> 'portfolio',
							'orderby'			=> 'date',
							'order'				=> $order,
							'posts_per_page'	=> !empty($number_of_portfolios) ? $number_of_portfolios : -1
							);
						$data = new WP_Query( $args );
						$i = 0;
						//Check post
						if( $data->have_posts() ) :
							//startloop here..
							while( $data->have_posts() ) : $data->the_post(); 
								$i++;
								$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 

								global $post;
					            $image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
					            $data_size  = $image['width'] . 'x' . $image['height'];
					            $image_alt  = ( !empty( $image['alt'] ) ) ? 'alt="' . esc_attr( $image['alt'] ) . '"' : 'alt="' .get_the_title() . '"';
					            $image_cap  = $image['caption']; 

						?>
						<div class="portfolio cx-portfolio pad-0 <?php foreach ($term_list as $sterm) { echo $sterm->slug.' '; }?>" <?php if(!empty($column)): echo 'style="width:'. $column .'"'; endif; ?>>
							<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php echo (!empty($column_gutter)) ? ' style="margin:'. $column_gutter .'px;" class="item-'.$i.'"' : '' ?>>
							    <a <?php if(!empty($column_gutter)): echo 'class="no-transform"'; endif; ?> style="background-image:url('<?php esc_url(the_post_thumbnail_url('full')); ?>');" href="<?php esc_url( the_post_thumbnail_url('full') ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
									<?php if($type_mode == '2'): ?>
							        <img style="visibility:hidden;opacity:0;" src="<?php esc_url( the_post_thumbnail_url('full') ); ?>" itemprop="thumbnail" <?php echo $image_alt; ?> class="img-responsive" />

							      <?php else: ?>  
							        <img style="visibility:hidden;opacity:0;" src="<?php esc_url( the_post_thumbnail_url('rectangle-two') ); ?>" itemprop="thumbnail" <?php echo $image_alt; ?> class="img-responsive" />
							      <?php endif; ?> 

							    </a>
							    <figcaption itemprop="caption description"><?php echo esc_html( $image_cap ); ?></figcaption>
								<div class="image-mask <?php echo (empty($column_gutter) ? 'add-transform' : '' );?>">
									<div class="image-content">
										<a href="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>">
											<?php if(($show_icon == 'yes') && !empty('icon')): ?>
											<i class="<?php echo $icon; ?>"></i>
											<?php endif; ?>
										</a>
										<h3 class="portfolio-title"> <a href="<?php the_permalink(); ?>" class="clickable"> <?php echo esc_html( get_the_title() ); ?> </a></h3>
										<?php if(($read_more == 'yes') && !empty('read_more_text')): ?>
										<p class="portfolio-readmore"><a href="<?php the_permalink(); ?>" class="clickable"><?php printf('%s', $read_more_text); ?></a></p>
										<?php endif; ?>
									</div>
								</div>
							</figure> <!-- end of cx-portfolio -->
						</div>	

						<?php 
								endwhile;
							endif;
							wp_reset_postdata();
						 ?>
		            </div><!-- end of portfolio-item-wrapper -->
					
					<?php if($show_view_btn): ?>
						<p class="blog-more"><a class="cx-btn" href="<?php echo esc_url($show_view_btn_link); ?>"><?php echo $show_view_btn_text ? esc_html($show_view_btn_text) : esc_html__('View All', 'codexin'); ?></a></p>
		            <?php endif; ?>	
				</div><!-- end of portfolio-wrapper-1 -->
			</div> <!-- end of cx-portfolios -->

	<?php endif; // End layout - 1

			if( $layout == 2 ) :
			// Retrieving user define classes
			$classes = array( 'portfolio-wrapper-2' );
			(!empty($class)) ? $classes[] = $class : ''; ?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

					
					<div class="filter-wrapper">
						<div class="row">
							<!-- section title  -->
							<div class="col-sm-4">
								<h2 class="primary-title"><?php echo esc_html__( $section_title ); ?></h2>
							</div>  <!-- end of col-sm-4 -->
							<div class="col-sm-8">
								<div class="portfolio-filter pull-right">
									<ul class="list-inline">
										<li class="active" data-filter="*">All</li>
										<?php 
											$taxonomy = 'portfolio-category';
											$taxonomies = get_terms($taxonomy); 
											foreach ( $taxonomies as $tax ) {
												echo '<li data-filter=".' .strtolower($tax->slug) .'" >' . $tax->name . '</li>';

											}
										?>
										<?php if($show_view_btn): ?>
											
												<li class="blog-more"><a class="cx-btn" href="<?php echo esc_url($show_view_btn_link); ?>"><?php echo $show_view_btn_text ? esc_html($show_view_btn_text) : esc_html__('View All', 'codexin'); ?></a></li>
											
										<?php endif; ?>	
									</ul>
								</div>
							</div> <!-- end of col-sm-8 -->

							
						</div> <!-- end of row -->
					</div>
					

					<div class="portfolio-item-wrapper image-pop-up" itemscope itemtype="http://schema.org/ImageGallery">
					<?php 
						//start wp query..
						$args = array(
							'post_type'			=> 'portfolio',
							'orderby'			=> 'data',
							'order'				=> 'DESC',
							'posts_per_page'	=> 5,
							);
						$data = new WP_Query( $args );
						$i = 0;
						//Check post
						if( $data->have_posts() ) :
							//startloop here..
							while( $data->have_posts() ) : $data->the_post(); 
							$i++;

							$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 
							global $post;
				            $image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
				            $data_size  = $image['width'] . 'x' . $image['height'];
				            $image_alt  = ( !empty( $image['alt'] ) ) ? 'alt="' . esc_attr( $image['alt'] ) . '"' : 'alt="' .get_the_title() . '"';
				            $image_cap  = $image['caption']; 
						?>
							<div class="portfolio cx-portfolio col-xs-12 col-sm-4 <?php echo ($i==1) ? 'long-height' : 'short-height'; ?> pad-0 <?php foreach ($term_list as $sterm) { echo $sterm->slug.' '; }?>">
								<?php $height = ($i!=1) ? 250 : 500 + 2*$column_gutter; ?>
								<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php echo (!empty($column_gutter)) ? ' style="margin:'. $column_gutter .'px; height:'.$height.'px"; class="item-'.$i.'"' : '' ?>>
								    <a <?php if(!empty($column_gutter)): echo 'class="no-transform"'; endif; ?> style="background-image:url('<?php esc_url(the_post_thumbnail_url('full')); ?>');" href="<?php esc_url( the_post_thumbnail_url('full') ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
								        <img style="visibility:hidden;opacity:0;" src="<?php echo esc_url( the_post_thumbnail_url('rectangle-five') ); ?>" itemprop="thumbnail" class="img-responsive" <?php echo $image_alt; ?> />
								    </a>  
							    <figcaption itemprop="caption description"></figcaption>
									<div class="image-mask <?php echo (empty($column_gutter) ? 'add-transform' : '' );?>">
										<div class="image-content">
											<a href="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>">
												<i class="fa fa-search" aria-hidden="true"></i>
											</a>
											<h3 class="portfolio-title"> <a href="<?php the_permalink(); ?>" class="clickable"> <?php echo esc_html( get_the_title() ); ?> </a></h3>

										</div>
									</div>
								</figure>
							</div>
						
					<?php 
							endwhile;
						endif;
						wp_reset_postdata();
					?>
					</div> <!-- end of portfolio-wrapper -->

				</div> <!-- end of portfolio-area-rv2 -->
			</div> <!-- end of  -->
			<div class="clearfix"></div>

	<?php endif; // End Layout - 2

		if( $layout == 3 ) :


		  // Retrieving user define classes
		  $classes = array( 'portfolio-wrapper-3' );
		  (!empty($class)) ? $classes[] = $class : ''; ?> 
		  <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		  	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					

				<div class="filter-wrapper">
					<div class="row">
						<!-- section title  -->
						<div class="col-sm-4">
							<h2 class="primary-title"><?php echo esc_html__( $section_title ); ?></h2>
						</div>  <!-- end of col-sm-4 -->
						<div class="col-sm-8">
							<div class="portfolio-filter pull-right">
								<ul class="list-inline">
									<li class="active" data-filter="*">All</li>
									<?php 
										$taxonomy = 'portfolio-category';
										$taxonomies = get_terms($taxonomy); 
										foreach ( $taxonomies as $tax ) {
											echo '<li data-filter=".' .strtolower($tax->slug) .'" >' . $tax->name . '</li>';

										}
									?>
									<?php if($show_view_btn): ?>
										
											<li class="blog-more"><a class="cx-btn" href="<?php echo esc_url($show_view_btn_link); ?>"><?php echo $show_view_btn_text ? esc_html($show_view_btn_text) : esc_html__('View All', 'codexin'); ?></a></li>
										
									<?php endif; ?>	
								</ul>
							</div>
						</div> <!-- end of col-sm-8 -->
					</div>
				</div>
					
	  			<div class="portfolio-item-wrapper image-pop-up responsive-class" itemscope itemtype="http://schema.org/ImageGallery">
	  				<?php 
					//start wp query..
  					$args = array(
  					'post_type'			=> 'portfolio',
  					'orderby'			=> 'data',
  					'order'				=> 'DESC',
  					'posts_per_page'	=> 5
  					);
	  				$data = new WP_Query( $args );
	  				$i = 0;
					//Check post
	  				if( $data->have_posts() ) :
						//startloop here..
	  					while( $data->have_posts() ) : $data->the_post(); 
	  					$i++;

	  				$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 

	  				global $post;
	  				$image      = wp_prepare_attachment_for_js( get_post_thumbnail_id( $post->ID ) );
	  				$data_size  = $image['width'] . 'x' . $image['height'];
	  				$image_alt  = ( !empty( $image['alt'] ) ) ? 'alt="' . esc_attr( $image['alt'] ) . '"' : 'alt="' .get_the_title() . '"';
	  				$image_cap  = $image['caption']; ?>

					<div class="portfolio cx-portfolio col-xs-12 <?php echo ($i!=2) ? 'col-sm-3 quarter' : 'col-sm-6 half'; ?> pad-0 <?php foreach ($term_list as $sterm) { echo $sterm->slug.' '; }?>">
						<?php $height = ($i!=2) ? 250 : 500 + 2*$column_gutter; ?>
						<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php echo (!empty($column_gutter)) ? ' style="margin:'. $column_gutter .'px; height:'.$height.'px"; class="item-'.$i.'"' : '' ?>>
						    <a <?php if(!empty($column_gutter)): echo 'class="no-transform"'; endif; ?> style="background-image:url('<?php esc_url(the_post_thumbnail_url('full')); ?>');" href="<?php esc_url( the_post_thumbnail_url('full') ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
						        <img style="visibility:hidden;opacity:0;" src="<?php echo esc_url( the_post_thumbnail_url('rectangle-five') ); ?>" itemprop="thumbnail" class="img-responsive" <?php echo $image_alt; ?> />
						    </a>  
					    <figcaption itemprop="caption description"></figcaption>
							<div class="image-mask <?php echo (empty($column_gutter) ? 'add-transform' : '' );?>">
								<div class="image-content">
									<a href="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>">
										<i class="fa fa-search" aria-hidden="true"></i>
									</a>
									<h3 class="portfolio-title"> <a href="<?php the_permalink(); ?>" class="clickable"> <?php echo esc_html( get_the_title() ); ?> </a></h3>

								</div>
							</div>
						</figure>
					</div>
	  						

	  				<?php 
	  				endwhile;
	  				endif;
	  				wp_reset_postdata();
	  				?>

	  			</div> <!-- end of portfolio-wrapper -->
			</div>	<!-- end of user class -->
	  	</div> <!-- end of master-class -->
		<div class="clearfix"></div>
			
	<?php endif; //End layout - 3 ?>

	<?php endif; ?> <!-- End Empty Layout -->

	<!-- Initializing Photoswipe -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="pswp__bg"></div>
	    <div class="pswp__scroll-wrap">
	        <div class="pswp__container">
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	        </div>
	        <div class="pswp__ui pswp__ui--hidden">
	            <div class="pswp__top-bar">
	                <div class="pswp__counter"></div>
	                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
	                <button class="pswp__button pswp__button--share" title="Share"></button>
	                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
	                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
	                <div class="pswp__preloader">
	                    <div class="pswp__preloader__icn">
	                        <div class="pswp__preloader__cut">
	                            <div class="pswp__preloader__donut"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
	                <div class="pswp__share-tooltip"></div>
	            </div>
	            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
	            </button>
	            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
	            </button>
	            <div class="pswp__caption">
	                <div class="pswp__caption__center"></div>
	            </div>
	        </div>
	    </div>
	</div><!-- end of pswp -->

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_portfolio_mini

// Integrating Shortcode with King Composer
function cx_portfolio_mini_kc() {

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_portfolio_mini' => array(
					'name' => esc_html__( 'Codexin Mini Portfolio', 'codexin' ),
					'description' => esc_html__('Mini Portfolio Section', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
                	//Only load assets when using this element
					'assets' => array(
						'scripts' => array(
							'imagesloaded-js' => CODEXIN_CORE_ASSET_DIR . '/js/imagesloaded.pkgd.min.js',
							'isotope-js-script' => CODEXIN_CORE_ASSET_DIR . '/js/isotope.pkgd.min.js',
							'portfolio-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx-portfolio.js',
							'photswipe-js' => CODEXIN_CORE_ASSET_DIR . '/js/photoswipe.min.js',
							'photswipe-main-js' => CODEXIN_CORE_ASSET_DIR . '/js/photoswipe-main.js',
							),
						'styles' => array(
							'photoswipe-stylesheet' => CODEXIN_CORE_ASSET_DIR . '/css/photoswipe.css',
							)

                	), //End assets

					'params' => array(
						'General' => array(
							array(
								'type'			=> 'radio_image',
								'label'			=> esc_html__( 'Select Porifolio Template', 'codexin' ),
								'name'			=> 'layout',
								'admin_label'	=> true,
								'options'		=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/portfolio/layout-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/portfolio/layout-2.png',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/portfolio/layout-3.png',
									),
								'value'			=> '1',
								'admin_label' 	=> true,
							),

							array(
	    						'name'        	=> 'number_of_portfolios',
	    						'label'       	=> esc_html__('Number Of Portfolios to Display', 'codexin'),
	    						'type'        	=> 'number',
									'relation' => array(
										'parent'	=> 'layout',
										'show_when'	=> '1',
									),
	    						'value'			=> '8',
	    						'description'	=> esc_html__( 'Choose the number of portfolios you want to show. To show all portfolio, leave the field blank', 'codexin' ),
	    					),

							array(
	    						'name'        	=> 'type_mode',
	    						'label'       	=> esc_html__('Portfolio Layout Mode', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'1'	=> 'Rectangle Grid',
    								'2'	=> 'Masonry Grid',
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
	    						'label'       	=> esc_html__('No of Column', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'50%'	=> '2 Column',
    								'33.33333333%'	=> '3 Column',
    								'25%'	=> '4 Column',
    								'20%'	=> '5 Column',
    								'16.66666666%'	=> '6 Column',
    							),

								'relation' => array(
									'parent'	=> 'layout',
									'show_when'	=> '1',
								),
	    						'value'			=> '25',
	    						'description'	=> esc_html__( 'Choose No. of Column ', 'codexin' ),
	    					),

							array(
	    						'name'        	=> 'column_gutter',
	    						'label'       	=> esc_html__('Column Gutter/Gap', 'codexin'),
	    						'type'        	=> 'text',
									'relation' => array(
										'parent'	=> 'layout',
										'show_when'	=> array('1', '2', '3'),
									),
	    						'description'	=> esc_html__( 'Column Gutter/Gap on "px". Enter only value. For Example: 5', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__('Display Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> 'Ascending',
    								'DESC'	=> 'Descending',
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Portfolios.', 'codexin' ),
	    					),

							array(
							  'name' 			=> 'show_icon',
							  'label' 		=> esc_html__( 'Enable Icon? ', 'codexin' ),
							  'type' 			=> 'toggle',
							),

							array(
								'name'        	=> 'icon',
								'label'       	=> esc_html__('Select Hover Icon', 'codexin'),
								'type'        	=> 'icon_picker',
							    'relation'		=> array(
							    	'parent'	=> 'show_icon',
							    	'show_when'	=> 'yes'
									),
								'value'			=> 'et-focus',
								'description'	=> esc_html__( 'Choose Icon to show on hover.', 'codexin' ),
							),

							array(
								'name'	=> 'section_title',
								'label' => esc_html__( 'Enter Title', 'codexin' ),
								'type'	=> 'text',
								'relation' => array(
									'parent'	=> 'layout',
									'show_when'	=> array('2', '3')
								),
								'description' => esc_html__( 'Enter Portfolio Section Title Here', 'codexin' ),
								),

							array(
							  'name' 			=> 'read_more',
							  'label' 		=> esc_html__( 'Enable \'Read More\' Button? ', 'codexin' ),
							  'type' 			=> 'toggle',
							),


							array(
								'name'	=> 'read_more_text',
								'label' => esc_html__( 'Text For \'Read More\' Button', 'codexin' ),
								'type'	=> 'text',
				                'relation'		=> array(
				                	'parent'	=> 'read_more',
				                	'show_when'	=> 'yes'
				                	),
                				'value' => 'Read More',
								'description' => esc_html__( 'Default Text is "Read More"', 'codexin' ),
							),

							array(
							  'name' 			=> 'show_view_btn',
							  'label' 		=> esc_html__( 'Enable \'View All\' Button? ', 'codexin' ),
							  'type' 			=> 'toggle',
							),

							array(
								'name'	=> 'show_view_btn_text',
								'label' => esc_html__( 'Text For \'View All\' Button', 'codexin' ),
								'type'	=> 'text',
				                'relation'		=> array(
				                	'parent'	=> 'show_view_btn',
				                	'show_when'	=> 'yes'
				                	),
                				'value' => 'View All',
								'description' => esc_html__( 'Default Text is "View All"', 'codexin' ),
							),

							array(
								'name'	=> 'show_view_btn_link',
								'label' => esc_html__( 'URL For \'View All\' Button', 'codexin' ),
								'type'	=> 'text',
				                'relation'		=> array(
				                	'parent'	=> 'show_view_btn',
				                	'show_when'	=> 'yes'
				                	),
                				'value' => '#',
								'description' => esc_html__( 'Enter URL', 'codexin' ),
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

 										'Category Filter' => array(
 											array('property' => 'color', 'label' => esc_html__('Filter Button Text Color', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'background-color', 'label' => esc_html__('Filter Button Background', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'border', 'label' => esc_html__('Filter Button Border', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'color', 'label' => esc_html__('Filter Button Color on Hover', 'codexin'), 'selector' => '.portfolio-filter li:hover'),
 											array('property' => 'color', 'label' => esc_html__('Active Button Text Color', 'codexin'), 'selector' => '.portfolio-filter li.active'),
 											array('property' => 'background-color', 'label' => esc_html__('Active Button Background', 'codexin'), 'selector' => '.portfolio-filter li.active'),
 											array('property' => 'border', 'label' => esc_html__('Active Button Border', 'codexin'), 'selector' => '.portfolio-filter li.active'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.portfolio-filter li'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.portfolio-filter li')
										),

 										'Icon' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.image-content i'),
 											array('property' => 'color', 'label' => esc_html__('Hover Color', 'codexin'), 'selector' => '.image-content a:hover i'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.image-content i'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.image-content i'),
 											array('property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.image-content i'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.image-content i'),
 											array('property' => 'transition', 'label' => esc_html__('Transition', 'codexin'), 'selector' => '.image-content i'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.image-content i'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.image-content i')
										),

 										'Title' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.portfolio-title a'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.portfolio-title'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.portfolio-title'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.portfolio-title'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.portfolio-title'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.portfolio-title'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.portfolio-title'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.portfolio-title'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.portfolio-title')
										),

 										'Button' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.portfolio-readmore a'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.portfolio-readmore a')
										),


										'Image Hover' => array(
 											array('property' => 'background', 'label' => esc_html__('Image Hover Color', 'codexin'), 'selector' => '.image-mask' )
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


