<?php

/**
 * Shortcode -  Mini Blog
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Mini Blog Shortcode
function cx_blog_mini_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'layout'			=> '',
		'number_of_posts'	=> '',
		'order'				=> '',
		'orderby'			=> '',
		'include'			=> '',
		'show_date'			=> '',
		'title_length'		=> '',
		'desc_length'		=> '',
		'postview_comments'	=> '',
		'sticky_post'		=> '',
		'post_meta'			=> '',
		'readmore_text'		=> '',
		'class'				=> ''
	), $atts ) );

	$result = '';

	// Extracting user included categories
	$cat_include 	= str_replace(',', ' ', $include);
	$cat_includes 	= explode( " ", $cat_include );

    // Retrieving user define classes
    $classes 		= array( 'row' );
    ( ! empty( $class ) ) ? $classes[] = $class : '';

    // Buiding up args for query
	$args = array(
		'post_type'				=> 'post',
		'posts_per_page'		=> $number_of_posts,
		'post_status'			=> 'publish',
		'meta_key'				=> ( $orderby == 'meta_value_num' ) ? 'cx_post_views' : '',
		'order'					=> $order,
		'orderby'				=> $orderby,
		'category__in'	 		=> ! empty( $include ) ? $cat_includes : '',
		'ignore_sticky_posts' 	=> 1
	);

	ob_start(); 

	if( ! empty( $layout ) ) {
   		
   		if( $layout == 1 ) {
	   		// Assigning a master css class and hooking into KC
		    $master_class = apply_filters( 'kc-el-class', $atts );
		    $master_class[] = 'cx-blog';

		?>
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>" itemscope itemtype="https://schema.org/Blog">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php
					//start query..
					$data = new WP_Query( $args );

					if( $data->have_posts() ) {

						while( $data->have_posts() ) {
							$data->the_post();
							$column = 12 / $number_of_posts;

							// Retrieving Image alt tag
							$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

							$thumbnail_size = 'codexin-core-rectangle-one';
							if( function_exists( 'codexin_attachment_metas_extended' ) ) {
								$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'blog', $thumbnail_size )['src'];
							} else {
								$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X400';
							}

					 ?>
							<div class="col-md-<?php echo esc_html( $column ); ?> col-sm-<?php echo ( $column == 4 ) ? esc_attr( $column ) : esc_attr( 6 ); ?>">
								<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class(); ?>>
									<div class="blog-wrapper">
										<div class="img-thumb">
											<a href="<?php echo esc_url( get_the_permalink() ); ?>">
												<div class="img-wrapper">
													<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
												</div>
											</a>
											<?php if( $show_date ) { ?>
											<div class="meta cx-color-2">
												<a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) ); ?>" class="entry-date">
													<p><?php echo esc_html( get_the_time( 'd' ) ); ?></p>
													<p><?php echo esc_html( get_the_time( 'M' ) ); ?></p>
												</a>
											</div>
											<?php } ?>
										</div> <!-- End of img-thumb -->

										<div class="blog-content">
											<h3 class="blog-title">
												<a href="<?php echo esc_url( get_the_permalink() ); ?>">
													<?php 
							                    	if( function_exists( 'codexin_char_limit' ) ) {
								                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
							                    	} else {
												    	echo esc_html( wp_trim_words( get_the_title(), $title_length ) );
							                    	}
													?>
												</a>
											</h3>
											<div class="blog-desc"> 
												<?php 
						                    	if( function_exists( 'codexin_char_limit' ) ) {
						                    		echo '<p>';
								                        echo apply_filters( 'the_content', codexin_char_limit( $desc_length, 'excerpt' ) );
								                    echo '</p>';
						                    	} else {
											    	echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) );;
						                    	}
												?>
											</div>
										
											<div class="cx-color-0 cx-primary-btn">
												<a class="read-more" href="<?php echo esc_url( get_the_permalink() ); ?>">
													<?php echo esc_html( ! empty( $readmore_text ) ? $readmore_text : esc_html__( 'Read More', 'codexin' ) ); ?>
												</a>
											</div>
										</div> <!-- end of blog-content -->
										
									<?php
										if( $postview_comments ) { ?>
										<div class="blog-info cx-border-1 cx-color-0">
											<?php
											$order_cpv = 'meta_value_num';
											$order_com = 'comment_count';
											if( $orderby == $order_cpv ) {
											?>
												<span>
													<i class="fa fa-eye"></i> <i>
														<?php echo codexin_get_post_views( get_the_ID() ); ?>
													</i>
												</span>
												<span> 											
													<a href="<?php comments_link(); ?>">
														<i class="fa fa-comments"></i> <i><?php comments_number( '0', '1', '%' ); ?></i>
													</a>
												</span>
											<?php } elseif( $orderby == $order_com ) { ?>
												<span> 											
													<a href="<?php comments_link(); ?>">
														<i class="fa fa-comments"></i> <i><?php comments_number( '0', '1', '%' ); ?></i>
													</a>
												</span>
												<span>
													<i class="fa fa-eye"></i> <i>
														<?php echo codexin_get_post_views( get_the_ID() ); ?>
													</i>
												</span>
											<?php } else { ?>
												<span>
													<i class="fa fa-eye"></i> <i>
														<?php echo codexin_get_post_views( get_the_ID() ); ?>
													</i>
												</span>
												<span>									
													<a href="<?php comments_link(); ?>">
														<i class="fa fa-comments"></i> <i><?php comments_number( '0', '1', '%' ); ?></i>
													</a>									
												</span>
											<?php } ?>
										</div><!-- end of blog-info -->
									<?php } ?>

									</div><!--end of blog-wrapper -->
								</article> <!-- end of #post-## -->
							</div> <!-- end of col -->
						<?php
						} // end of loop have_posts()
					} //End check-posts if()
					wp_reset_postdata();
					?>
				</div> <!-- end of row -->
			</div> <!-- end of cx-blog -->

			<div class="clearfix"></div>

		<?php } // end of layout-1

		if( $layout == 2 ) {
		// Assigning a master css class and hooking into KC
		$master_class = apply_filters( 'kc-el-class', $atts );
		$master_class[] = 'cx-blog-2';
	
		?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>" itemscope itemtype="https://schema.org/Blog">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<?php 
				//start query..
				$data = new WP_Query( $args );

				if( $data->have_posts() ) {

					while( $data->have_posts() ) {
					$data->the_post();
					$column = 12 / $number_of_posts;

					// Retrieving Image alt tag
					$image_alt = ( !empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

					$thumbnail_size = 'codexin-core-rectangle-one';
					if( function_exists( 'codexin_attachment_metas_extended' ) ) {
						$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'blog', $thumbnail_size )['src'];
					} else {
						$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X400';
					}

				?>
					<div class="col-md-<?php echo esc_attr( $column ); ?> col-sm-<?php echo ( $column == 4 ) ? esc_attr( $column ) : esc_attr( 6 ); ?>">
						<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class(); ?>>
							<div class="blog-wrapper">
								<div class="img-thumb cx-bg-overlay">
									<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
									<div class="cx-color-0 cx-primary-btn cx-white-btn">
										<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="cx-blog-btn">
											<?php echo esc_html( !empty( $readmore_text ) ? $readmore_text : esc_html__( 'Read More', 'codexin' ) ); ?>
										</a>
									</div>
									<?php if( $show_date ) { ?>
										<div class="date-time cx-bg-0 cx-color-2">
											<p><?php echo esc_html( get_the_time( 'd' ) ); ?></p>
											<p><?php echo esc_html( get_the_time( 'M' ) ); ?></p>
										</div>
									<?php } ?>
								</div> <!-- End of img-thumb -->

								<div class="blog-content cx-bg-1 cx-border-1">
									<h3 class="blog-title">
										<a href="<?php echo esc_url( get_the_permalink() ); ?>">
											<?php 
					                    	if( function_exists( 'codexin_char_limit' ) ) {
						                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
					                    	} else {
										    	echo esc_html( wp_trim_words( get_the_title(), $title_length ) );
					                    	}
											?>
										</a>
									</h3>
									<p class="blog-category cx-color-0"> <?php the_category( '  ' ); ?> </p>
									<ul class="meta cx-color-0">
										<li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><i class="fa fa-user"></i>  <?php the_author(); ?> </a> </li>
										<?php if( $post_meta == 'comment' ) { ?>
											<li><a href="<?php comments_link(); ?>"><i class="fa fa-paper-plane"></i>  <?php comments_number( '0', '1', '%' ); ?></a> </li>
										<?php } else { ?>
											<li><i class="fa fa-eye"></i> <?php echo codexin_get_post_views( get_the_ID() ); ?> </li>
										<?php } ?>
										<li><?php echo codexin_likes_button( get_the_ID(), 0 ); ?></li>
									</ul>
									<div class="blog-desc">
										<?php 
				                    	if( function_exists( 'codexin_char_limit' ) ) {
				                    		echo '<p>';
						                        echo apply_filters( 'the_content', codexin_char_limit( $desc_length, 'excerpt' ) );
						                    echo '</p>';
				                    	} else {
									    	echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) );;
				                    	}
										?>
									</div>
								</div> <!-- end of blog-content -->
							</div> <!-- end of blog-wrapper -->
						</article> <!-- end of #post-## -->
					</div> <!-- end of col -->
					<?php
					} // end of loop have_posts()
				} //End check-posts if()
				wp_reset_postdata();
				?>
			</div> <!-- end of row -->
		</div> <!-- end of cx-blog-2 -->
		<div class="clearfix"></div>

		<?php } // end of layout-2 
	
		if( $layout == 3 ) {
			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-blog-3';

			$number_of_posts = 4;

			?>
				
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>" itemscope itemtype="https://schema.org/Blog">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php 
				//start query..
				$args['posts_per_page'] 		= ( $sticky_post ) ? $number_of_posts-1 : 4;
				$args['ignore_sticky_posts'] 	= ( $sticky_post ) ? '' : 1;

				$data = new WP_Query( $args );

				if( $data->have_posts() ) {
					$i = 1;

					while( $data->have_posts() ) {
					$data->the_post();

					// Retrieving Image alt tag
					$image_alt = ( !empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();
					$thumbnail_size = ( $i == 1 ) ? 'codexin-core-rectangle-one' : 'codexin-core-square-two';
					if( function_exists( 'codexin_attachment_metas_extended' ) ) {
						$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'blog', $thumbnail_size )['src'];
					} else {
						$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X400';
					}

					if( $i == 1 ) {
					?>
						<!-- Left column post -->
						<div class="col-md-6 col-sm-4 col-xs-12">							
							<div id="<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( array( 'blog-wrapper-left cx-border-1' ) ); ?>>
								<div class="img-thumb">
									<a href="<?php echo esc_url( get_the_permalink() ); ?>">
										<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
									</a>
								</div> <!-- End of img-thumb -->
								<div class="blog-content">
									<h3 class="blog-title">
										<?php 
				                    	if( function_exists( 'codexin_char_limit' ) ) {
					                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
				                    	} else {
									    	echo esc_html( wp_trim_words( get_the_title(), $title_length ) );
				                    	}
										?>
									</h3>
									<ul class="meta cx-color-0">
										<li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php echo esc_html__( 'By ', 'codexin' ); the_author(); ?> </a> </li>
										<li><a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) );  ?>" class="entry-date"><?php echo esc_html__( 'On ', 'codexin' ); echo get_the_time( 'd M, Y' ); ?></a> </li>
										<li><?php echo esc_html__( 'In', 'codexin' ); ?> <?php the_category( ', ' ); ?> </li>
									</ul>
									<div class="blog-desc">
										<?php 
				                    	if( function_exists( 'codexin_char_limit' ) ) {
				                    		echo '<p>';
						                        echo apply_filters( 'the_content', codexin_char_limit( $desc_length, 'excerpt' ) );
						                    echo '</p>';
				                    	} else {
									    	echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) );;
				                    	}
										?>
									</div>
								</div> <!-- end of blog-content -->
								<div class="blog-footer cx-border-1 cx-bg-1 cx-color-0">
									<div class="blog-footer-item"><a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?></a> </div>
									<div class="blog-footer-item"><i class="fa fa-eye"></i> <?php echo codexin_get_post_views( get_the_ID() ); ?> </div>
									<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="cx-blog-btn cx-bg-overlay">
										<?php echo esc_html( ! empty( $readmore_text ) ? $readmore_text : esc_html__( 'Read More', 'codexin' ) ); ?>
									</a>
									<div class="clearfix"></div>
								</div>
							</div> <!-- end blog-wrapper-left -->							
						</div> <!--end The col -->

						<!-- Right column posts -->
						<div class="col-md-6 col-sm-8 col-xs-12">
							<ul class="blog-wrapper-right">
					<?php } else { ?>
								<li id="<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( array( 'cx-border-1' ) ); ?>>
									<a class="thumbnail-link" href="<?php echo esc_url( get_the_permalink() ); ?>" style="background-image: url('<?php echo esc_url( $post_thumbnail ); ?>');"> 
										<div class="media-wrapper-right" >
											<div class="img-thumb">
												<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
											</div> <!-- End of img-thumb -->
										</div>
									</a> 
									<!-- End of media-wraper-right -->
									<div class="blog-content">
										<h3 class="blog-title">
											<?php 
					                    	if( function_exists( 'codexin_char_limit' ) ) {
						                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
					                    	} else {
										    	echo esc_html( wp_trim_words( get_the_title(), $title_length ) );
					                    	}
											?>
										</h3>
										<ul class="meta cx-color-0">
											<li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php echo esc_html__( 'By ', 'codexin' ); the_author(); ?> </a> </li>
											<li><a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) );  ?>" class="entry-date"><?php echo esc_html__( 'On ', 'codexin' ); echo get_the_time( 'd M, Y' ); ?></a> </li>
											<li><i class="fa fa-eye"></i> <?php echo codexin_get_post_views( get_the_ID() ); ?> </li>
											<li><a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?></a> </li>
										</ul>
										<div class="blog-desc">
											<?php 
					                    	if( function_exists( 'codexin_char_limit' ) ) {
					                    		echo '<p>';
							                        echo apply_filters( 'the_content', codexin_char_limit( $desc_length, 'excerpt' ) );
							                    echo '</p>';
					                    	} else {
										    	echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) );;
					                    	}
											?>
										</div>
									</div> <!-- end of blog-content -->									
								</li>
							<?php 
							} //End if($i == 1)

						if( $number_of_posts == $i ) { ?>
							</ul> <!-- End Post blog-wrapper-right-->	
						</div> <!-- end of col -->	
						<?php
						}

						$i++;
					} // end of loop have_posts()
				} //End check-posts if()
				wp_reset_postdata();
				?>
				</div> <!-- end of row -->
			</div> <!-- end of cx-blog-3 -->
			<div class="clearfix"></div>

		<?php } // end of layout-3 

		if( $layout == 4 ) {
			// Assigning a master css class and hooking into KC
			$master_class = apply_filters( 'kc-el-class', $atts );
			$master_class[] = 'cx-blog-4';

			?>
				
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>" itemscope itemtype="https://schema.org/Blog">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php 
				//start query..
				$args['posts_per_page'] = 3;

				$data = new WP_Query( $args );

				if( $data->have_posts() ) {

					while( $data->have_posts() ) {
						$data->the_post();

						// Retrieving Image alt tag
						$image_alt = ( !empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

						$thumbnail_size = 'codexin-core-square-two';
						if( function_exists( 'codexin_attachment_metas_extended' ) ) {
							$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'blog', $thumbnail_size )['src'];
						} else {
							$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X400';
						}
						?>
						<!-- Left column post -->
						<div class="col-md-4 col-sm-4">
							<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class(); ?>>
								<div class="blog-wrapper">
									<div class="img-thumb">
										<a href="<?php echo esc_url( get_the_permalink() ); ?>">
											<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
										</a>
									</div> <!-- End of img-thumb -->
									<div class="blog-content cx-color-2">
										<div class="blog-category">
											<?php the_category(' '); ?>
										</div>
										<h3 class="blog-title">
											<a href="<?php echo esc_url( get_the_permalink() ); ?>">
												<?php 
						                    	if( function_exists( 'codexin_char_limit' ) ) {
							                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
						                    	} else {
											    	echo esc_html( wp_trim_words( get_the_title(), $title_length ) );
						                    	}
												?>
											</a>
										</h3>
										<ul class="meta">
											<li><i class="fa fa-clock-o"></i> <a href="<?php echo get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) );  ?>"><?php echo get_the_time( 'd M, Y' ); ?></a> </li>
											<li><i class="fa fa-eye"></i> <?php echo codexin_get_post_views( get_the_ID() ); ?> </li>
											<li><i class="fa fa-comments"></i> <a href="<?php comments_link(); ?>"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a> </li>
										</ul>
									</div> <!-- end of blog-content -->
								</div> <!-- end blog-wrapper-left -->
							</article> <!-- end of #post-## -->
						</div> <!--end The col -->
					<?php 
					}
				}
				wp_reset_postdata();
				?>
				</div> <!-- end of row -->
			</div> <!-- end of cx-blog-4 -->
			<div class="clearfix"></div>

		<?php } // end of layout-4 ?>
			
	<?php
	} // end of layout check
	$result .= ob_get_clean();
	return $result;

} //End of cx_blog_mini


// Integrating Shortcode with King Composer
function cx_blog_mini_kc() {

	$cx_categories = codexin_get_post_categories();

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_blog_mini' 		=> array(
					'name' 			=> esc_html__( 'Codexin Mini Blog', 'codexin' ),
					'description' 	=> esc_html__( 'Codexin Mini Blog', 'codexin' ),
					'icon' 			=> 'et-hazardous',
					'category'	 	=> 'Codexin',
					'params' 		=> array(
	    				// General Params
						'general' => array(
							array(
								'name'			=> 'layout',
								'lable'			=> esc_html__( 'Select Blog Post Template', 'codexin' ),
								'type'			=> 'radio_image',
								'options'		=> array(
									'1'		=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-1.jpg',
									'2'		=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-2.jpg',
									'3'		=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-3.jpg',
									'4'		=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/blog-4.jpg',
								),
								'value'			=> '1',
								'admin_label'	=> true,
							),

							array(
	    						'name'        	=> 'number_of_posts',
	    						'label'       	=> esc_html__( 'Number Of Post to Display', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'2'	=> '2',
    								'3'	=> '3',
    								'4'	=> '4',
    							),
	    						'value'			=> '2',
    							'relation'		=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2',
    							),
	    						'description'	=> esc_html__( 'Choose the number of posts you want to show.', 'codexin' ),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__( 'Post Order', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> esc_html__( 'Ascending', 'codexin' ),
    								'DESC'	=> esc_html__( 'Descending', 'codexin' ),
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Posts:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__( 'Post Sorting Method', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => esc_html__( 'Date', 'codexin' ),
    								'comment_count'	 => esc_html__( 'Number Of Comments', 'codexin' ),
    								'meta_value_num' => esc_html__( 'Views Count', 'codexin' ),
    								'rand'			 => esc_html__( 'Randomize', 'codexin' ),
    							),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Posts Sorting Method', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'post_meta',
	    						'label'       	=> esc_html__( 'Post Meta to Show', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'view'		=> esc_html__( 'Number of Post Views', 'codexin' ),
    								'comment'	=> esc_html__( 'Number Of Comments', 'codexin' ),
    							),
    							'relation'		=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '2',
    							),
	    						'value'			=> 'comment',
	    						'description'	=> esc_html__( 'Choose The Post Meta to Display', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'sticky_post',
	    						'label'       	=> esc_html__( 'Show Sticky Post? ', 'codexin' ),
	    						'type'        	=> 'toggle',
    							'relation'		=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '3',
    							),
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Enable this if you want to show sticky post first.', 'codexin' ),
	    					),

	 						array(
	 							'name' 			=> 'include',
	 							'label' 		=> esc_html__( 'Filter Categories', 'codexin' ),
	 							'type' 			=> 'multiple',
	 							'options'		=> $cx_categories,
	 							'description'	=> esc_html__( 'Choose if You Want to Show Any Specific Post Category/Categories, Control + Click to Select Multiple Categories to Filter (All Categories will be shown by Default)', 'codexin' ),
	 						),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_date',
	    						'label'			=> esc_html__( 'Show Post Published Date?', 'codexin' ),
	    						'value'			=> 'yes',
    							'relation'		=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2',
    							),
	    						'description'	=> esc_html__( 'Choose to enable/disable post published date', 'codexin' ),
	    						'admin_label' 	=> true
	    					),

	    					array(
	    						'name'			=> 'title_length',
	    						'label'			=> esc_html__( 'Title Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '30',
	    						'description'	=> esc_html__( 'Specify number of Words that you want to show in your title', 'codexin' ),
	    						'options'		=> array(
	    							'min'			=> 10,
	    							'max'			=> 150,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
    						),

	    					array(
	    						'name'			=> 'desc_length',
	    						'label'			=> esc_html__( 'Excerpt Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '180',
	    						'description'	=> esc_html__( 'Specify number of Words that you want to show in your excerpt', 'codexin' ),
	    						'options'		=> array(
	    							'min'			=> 20,
	    							'max'			=> 500,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							),
    							'relation'		=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2,3',
    							),
    						),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'postview_comments',
	    						'label'			=> esc_html__( 'Show Posts View & Comments Number?', 'codexin' ),
	    						'value'			=> 'yes',
	    						'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1',
    							),
	    						'description'	=> esc_html__( 'Displays the post views count and comments count', 'codexin' ),
	    					),

	    					array(
	    						'name'			=> 'readmore_text',
	    						'label' 		=> esc_html__( 'Read More Button Text', 'codexin' ),
	    						'type'			=> 'text',
	    						'value'			=> 'Read more',
	    						'description' 	=> esc_html__( 'Edit the text that appears on the "Read more" button.', 'codexin' ),
    							'relation'		=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '1,2,3',
    							),
	    					),

	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
	    						'type'			=> 'text',
	    						'description' 	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	    					),

						), //End general params
					
						// Style based Params
						'styling' => array(
 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										esc_html__( 'Title', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-title a'),
 											array( 'property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.blog-title a:hover'),
 											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-title'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-title'),
 											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-title'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-title'),
 											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-title'),
 											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-title'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-title'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-title')
										),

 										esc_html__( 'Date', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Date Color', 'codexin'), 'selector' => 'div.meta a, .date-time'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Date Background', 'codexin'), 'selector' => 'div.meta a, .date-time'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => 'div.meta a, .date-time'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => 'div.meta a, .date-time')
										),

 										esc_html__( 'Icon', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),

 											array( 'property' => 'color', 'label' => esc_html__('Icon Color for Featured Post (For Layout-3)', 'codexin'), 'selector' => '.blog-footer-item i'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Icon Font Size for Featured Post (For Layout-3)', 'codexin'), 'selector' => '.blog-footer-item i'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon')
										),

										esc_html__( 'Image Hover', 'codexin' ) => array(
 											array( 'property' => 'background', 'label' => esc_html__('Image Hover Color', 'codexin'), 'selector' => '.img-wrapper::before, .img-wrapper::after, .blog-wrapper-left .img-thumb a:before, .blog-wrapper::after, .blog-wrapper-right .thumbnail-link:before, .blog-wrapper .img-thumb:before' )
										),

 										esc_html__( 'Description', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content .blog-desc, .blog-content .blog-category a, .blog-content .meta li, .blog-content .meta li a, .cx-count'),
 											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content .blog-desc')
										),

 										esc_html__( 'Category', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.blog-category a:hover'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Background Color on Hover', 'codexin'), 'selector' => '.blog-category a:hover'),
 											array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'border-color', 'label' => esc_html__('Border Color on Hover', 'codexin'), 'selector' => '.blog-category a:hover'),
 											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-category a'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-category a')
										),

 										esc_html__( 'Button', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'color', 'label' => esc_html__('Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Backgroung Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array( 'property' => 'background-color', 'label' => esc_html__('Border Bottom Color On Hover (For Layout-3)', 'codexin'), 'selector' => '.blog-wrapper-left .cx-blog-btn::before'),
 											array( 'property' => 'transition', 'label' => esc_html__('Hover Transition', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover, .blog-footer .cx-blog-btn:hover'),
 											array( 'property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn'),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn, .blog-footer .cx-blog-btn')
										),

										esc_html__( 'Content Box', 'codexin' ) => array(
 											array( 'property' => 'background-color', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.blog-content, .blog-wrapper-left, .blog-wrapper-right li.cx-border-1, .blog-wrapper' ),
 											array( 'property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-content, .blog-wrapper-left, .blog-wrapper-right li.cx-border-1, .blog-wrapper' ),
 											array( 'property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content, .blog-wrapper-left, .blog-wrapper-right li.cx-border-1, .blog-wrapper' ),
 											array( 'property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content, .blog-wrapper-left, .blog-wrapper-right li.cx-border-1, .blog-wrapper' )
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
	                ) //End params array
	            ),  // End of cx_blog array
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_blog_mini_kc


