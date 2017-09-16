<?php


/*
    ================================
        CODEXIN BLOG SHORTCODE
    ================================
*/

// Registering Codexin Blog Shortcode
function cx_blog_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'layout'			=> '',
			'number_of_posts'	=> '',
			'order'				=> '',
			'orderby'			=> '',
			'exclude'			=> '',
			'show_date'			=> '',
			'title_length'		=> '',
			'desc_length'		=> '',
			'postview_comments'	=> '',
			'post_meta'			=> '',
			'readmore_text'		=> '',
			'class'				=> ''
	), $atts));

	$result = '';

	// Extracting user excluded categories
	$cat_exclude = str_replace(',', ' ', $exclude);
	$cat_excludes = explode( " ", $cat_exclude );

	ob_start(); 

	if( ! empty( $layout ) ) :
   		if( $layout == 1 ) :
   		// Assigning a master css class and hooking into KC
	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'cx-blog';

	   // Retrieving user define classes
	   $classes = array( 'row' );
   	   (!empty($class)) ? $classes[] = $class : '';		
	?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<?php

				//start query..
				$args = array(
					'post_type'				=> 'post',
					'posts_per_page'		=> $number_of_posts,
					'post_status'			=> 'publish',
					'meta_key'				=> ( $orderby == 'meta_value_num' ) ? 'cx_post_views' : '',
					'order'					=> $order,
					'orderby'				=> $orderby,
					'category__not_in' 		=> $cat_excludes,
					'ignore_sticky_posts' 	=> 1
				);


				$data = new WP_Query( $args );

				if( $data->have_posts() ) :

					while( $data->have_posts() ) : $data->the_post();
					$column = 12/$number_of_posts;

					// Retrieving Image alt tag
					$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

				 ?>
					<div class="col-md-<?php echo $column ?> col-sm-12">
						<div class="blog-wrapper">
							<div class="img-thumb">
								<a href="<?php esc_url( the_permalink() ); ?>">
									<div class="img-wrapper">
										<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rectangle-one' ) : '//placehold.it/600x400' ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
									</div>
								</a>
								<?php if( $show_date ) : ?>
								<div class="meta">
									<p><?php echo get_the_time( 'd' ); ?></p>
									<p><?php echo get_the_time( 'M' ); ?></p>
								</div>
								<?php endif; ?>
							</div> <!-- End of img-thumb -->

							<div class="blog-content">
								<p class="blog-title">
									<a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></a>
								</p>
								<p class="blog-desc"> 
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
								</p>
								<a class="read-more" href="<?php echo esc_url( get_the_permalink() ); ?>">
									<?php echo esc_html( !empty( $readmore_text ) ? $readmore_text : __('Read More', 'codexin') ); ?>
								</a>
							</div> <!-- end of blog-content -->
						<?php
							if( $postview_comments ) : ?>
							<div class="blog-info">
								<?php
								$order_cpv = 'meta_value_num';
								$order_com = 'comment_count';
								if( $orderby == $order_cpv ) : 
								?>
								<span>
									<i class="fa fa-eye"></i> <i>
										<?php echo codexin_get_post_views(get_the_ID()); ?>
									</i>
								</span>
								<span> 											
									<i class="fa fa-comments"></i> <i>
										<?php comments_number('0', '1', '%'); ?>	
									</i>
								</span>
								<?php elseif( $orderby == $order_com ) : ?>
								<span> 											
									<i class="fa fa-comments"></i> <i>
										<?php comments_number('0', '1', '%'); ?>	
									</i>
								</span>
								<span>
									<i class="fa fa-eye"></i> <i>
										<?php echo codexin_get_post_views(get_the_ID()); ?>
									</i>
								</span>
								<?php else : ?>
								<span>
									<i class="fa fa-eye"></i> <i>
										<?php echo codexin_get_post_views(get_the_ID()); ?>
									</i>
								</span>
								<span> 											
									<i class="fa fa-comments"></i> <i>
										<?php comments_number('0', '1', '%'); ?>	
									</i>
								</span>
							<?php endif; ?>	

							</div><!-- end of blog-info -->

						<?php endif; ?>

						</div><!--end of blog-wrapper -->
					</div> <!-- end of col -->
					<?php

					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</div> <!-- end of row -->
		</div> <!-- end of cx-blog -->

		<div class="clearfix"></div>

	<?php endif; //End Layout - 1

		 if( $layout == 2 ) :
		 // Assigning a master css class and hooking into KC
	     $master_class = apply_filters( 'kc-el-class', $atts );
	     $master_class[] = 'cx-blog-2';

	    // Retrieving user define classes
	    $classes = array( 'row' );
   	    (!empty($class)) ? $classes[] = $class : '';		
	?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<?php 
				//start query..
				$args = array(
					'post_type'				=> 'post',
					'posts_per_page'		=> $number_of_posts,
					'post_status'			=> 'publish',
					'meta_key'				=> ( $orderby == 'meta_value_num' ) ? 'cx_post_views' : '',
					'order'					=> $order,
					'orderby'				=> $orderby,
					'category__not_in' 		=> $cat_excludes,
					'ignore_sticky_posts' 	=> 1
				);

				$data = new WP_Query( $args );

				if( $data->have_posts() ) :

					while( $data->have_posts() ) : $data->the_post();
					$column = 12/$number_of_posts;

					// Retrieving Image alt tag
					$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

					?>
					<div class="col-md-<?php echo $column ?> col-sm-12">
						<div class="blog-wrapper">
							<div class="img-thumb">
								<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rectangle-one' ) : '//placehold.it/600x400' ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
								<a href="<?php the_permalink(); ?>" class="cx-blog-btn">
									<?php echo esc_html( !empty( $readmore_text ) ? $readmore_text : __('Read More', 'codexin') ); ?>
								</a>
								<?php if( $show_date ) : ?>
									<div class="date-time"> 
										<p><?php echo get_the_time( 'd' ); ?></p>
										<p><?php echo get_the_time( 'M' ); ?></p>
									</div>
								<?php endif; ?>
							</div> <!-- End of img-thumb -->

							<div class="blog-content">
								<h3 class="blog-title">
									<a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></a>
								</h3>
								<p class="blog-category"> <?php the_category( '  ' ); ?> </p>
								<ul class="meta">
									<li><i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"> <?php the_author(); ?> </a> </li>
									<?php if( $post_meta == 'comment' ): ?>
										<li><i class="fa fa-paper-plane"></i> <?php comments_number('0', '1', '%'); ?> </li>
									<?php else: ?>
										<li><i class="fa fa-eye"></i> <?php echo codexin_get_post_views(get_the_ID()); ?> </li>
									<?php endif; ?>
									<li><?php if( function_exists( 'codexin_likes_button' ) ): echo codexin_likes_button( get_the_ID(), 0 ); endif; ?></li>
								</ul>
								<p class="blog-desc">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
								</p>
							</div> <!-- end of blog-content -->
						</div> <!-- end of blog-wrapper -->
					</div> <!-- end of col -->
					<?php

					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</div> <!-- end of row -->
		</div> <!-- end of cx-blog-2 -->
		<div class="clearfix"></div>

	<?php endif; //End Layout - 2 
	
	if( $layout == 3 ) : 
		// Assigning a master css class and hooking into KC
	     $master_class = apply_filters( 'kc-el-class', $atts );
	     $master_class[] = 'cx-blog-3';

	    // Retrieving user define classes
	    $classes = array( 'row' );
   	    (!empty($class)) ? $classes[] = $class : ''; ?>
			
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php 
			//start query..
			$args = array(
					'post_type'				=> 'post',
					'posts_per_page'		=> $number_of_posts,
					'post_status'			=> 'publish',
					'meta_key'				=> ( $orderby == 'meta_value_num' ) ? 'cx_post_views' : '',
					'order'					=> $order,
					'orderby'				=> $orderby,
					'category__not_in' 		=> $cat_excludes,
					'ignore_sticky_posts' 	=> 1
			);

			$data = new WP_Query( $args );

			if( $data->have_posts() ) :
				$i = 1;

				while( $data->have_posts() ) : $data->the_post();

				// Retrieving Image alt tag
				$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();
				if($i == 1): 
				?>
					<!-- Left column post -->
					<div class="col-md-6 col-sm-12">
						<div class="blog-wrapper-left">
							<div class="img-thumb">
								<a href="<?php esc_url( the_permalink() ); ?>">
									<img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'rectangle-one' ) : '//placehold.it/600x400' ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
								</a>
							</div> <!-- End of img-thumb -->
							<div class="blog-content">
								<h3 class="blog-title">
									<a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></a>
								</h3>
								<ul class="meta">
									<li><?php echo esc_html__('By', 'reveal'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"> <?php the_author(); ?> </a> </li>
									<li><?php echo esc_html__('On', 'reveal'); ?> <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>" class="entry-date"><?php echo get_the_time( 'd M, Y' ); ?></a> </li>
									<li><?php echo esc_html__('In', 'reveal'); ?> <?php the_category( ', ' ); ?> </li>
								</ul>
								<p class="blog-desc">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
								</p>
							</div> <!-- end of blog-content -->
							<div class="blog-footer">
								<div class="blog-footer-item"><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> </div>
								<div class="blog-footer-item"><i class="fa fa-eye"></i> <?php echo codexin_get_post_views(get_the_ID()); ?> </div>
								<a href="<?php the_permalink(); ?>" class="cx-blog-btn">
									<?php echo esc_html( !empty( $readmore_text ) ? $readmore_text : __('Read More', 'codexin') ); ?>
								</a>
								<div class="clearfix"></div>
							</div>
						</div> <!-- end blog-wrapper-left -->
					</div> <!--end The col -->

					<!-- Right column posts -->
					<div class="col-sm-6">
						<ul class="blog-wrapper-right">
				<?php else : ?>
							<li>
								<div class="img-thumb">
									<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( ( has_post_thumbnail() ) ? the_post_thumbnail_url( 'square-one' ) : '//placehold.it/220x220' ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive"></a>
								</div>
								<div class="blog-content">
									<h3 class="blog-title">
										<a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words( get_the_title(), $title_length ) ); ?></a>
									</h3>
									<ul class="meta">
										<li><?php echo esc_html__('By', 'reveal'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"> <?php the_author(); ?> </a> </li>
										<li><?php echo esc_html__('On', 'reveal'); ?> <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>" class="entry-date"><?php echo get_the_time( 'd M, Y' ); ?></a> </li>
										<li><i class="fa fa-eye"></i> <?php echo codexin_get_post_views(get_the_ID()); ?> </li>
										<li><i class="fa fa-comments"></i> <?php comments_number('0', '1', '%'); ?> </li>
									</ul>
									<p class="blog-desc">
										<?php echo esc_html( wp_trim_words( get_the_excerpt(), $desc_length ) ); ?> 
									</p>
								</div> <!-- end of blog-content -->
							</li>
						<?php 
						endif; //End if($i == 1)

					if( $number_of_posts == $i ) : ?>
						</ul> <!-- End Post blog-wrapper-right-->	
					</div> <!-- end of col -->	
					<?php endif; ?>

					<?php 
						$i++;
					endwhile;
					endif;
					wp_reset_postdata();
					?>
				</div> <!-- end of row -->
			</div> <!-- end of cx-blog-3 -->
			<div class="clearfix"></div>

	<?php endif; //End layout - 3 ?>
			
	<?php
	endif;
	$result .= ob_get_clean();
	return $result;

} //End of cx_blog

/**
 *
 * Helper function to fetch all post categories
 *
 */  
function cx_get_post_categories() {

	$categories = get_categories( array(
	    'orderby' => 'name',
	    'order'   => 'ASC'
	) );

	$post_cat = array();
	if ( $categories ) {		

		foreach ( $categories as $value ) {
			$post_cat[$value->term_id] = ucfirst( $value->name ) . ' (Posts Count: '. $value->category_count .')';
		}

	} else {

		$post_cat[0] = __( 'No Categories found', 'codexin' );

	}

	return $post_cat;


} //End cx_get_post_categories()..

// Integrating Shortcode with King Composer
function cx_blog_kc() {

	$cx_categories = cx_get_post_categories();

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_blog' => array(
					'name' => esc_html__( 'Codexin Blog', 'codexin' ),
					'description' => esc_html__('Codexin Blog', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					'params' => array(
	    				// General Params
						'general' => array(
							array(
								'name'	=> 'layout',
								'lable'	=> esc_html__( 'Select Blog Post Template', 'codexin' ),
								'type'	=> 'radio_image',
								'options'	=> array(
									'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/layout-1.png',
									'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/layout-2.png',
									'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/layout-img/blog/layout-3.png',
								),
								'value'	=> '1',
								'admin_label'	=> true,
							),

							array(
	    						'name'        	=> 'number_of_posts',
	    						'label'       	=> esc_html__('Number Of Post to Display', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'2'	=> '2',
    								'3'	=> '3',
    								'4'	=> '4',
    							),
	    						'value'			=> '3',
	    						'description'	=> esc_html__( 'Choose the number of posts you want to show.', 'codexin' ),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__('Post Order', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'	=> 'Ascending',
    								'DESC'	=> 'Descending',
    							),
	    						'value'			=> 'DESC',
	    						'description'	=> esc_html__( 'Choose The Order to Display Posts:', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'orderby',
	    						'label'       	=> esc_html__('Post Sorting Method', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'date'			 => 'Date',
    								'comment_count'	 => 'Number Of Comments',
    								'meta_value_num' => 'Views Count',
    								'rand'			 => 'Randomize',
    							),
    							// 'relation'	=> array(
    							// 	'parent' 	=> 'layout',
    							// 	'show_when'	=> '1',
    							// ),
	    						'value'			=> 'date',
	    						'description'	=> esc_html__( 'Choose The Posts Sorting Method', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'post_meta',
	    						'label'       	=> esc_html__('Post Meta to Show', 'codexin'),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'view'		 => 'Number of Post Views',
    								'comment'	 => 'Number Of Comments',
    							),
    							'relation'	=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> '2',
    							),
	    						'value'			=> 'comment',
	    						'description'	=> esc_html__( 'Choose The Post Meta to Display', 'codexin' ),
	    					),

	 						array(
	 							'name' 			=> 'exclude',
	 							'label' 		=> esc_html__( 'Exclude Categories', 'codexin' ),
	 							'type' 			=> 'multiple',
	 							'options'		=> $cx_categories,
	 							'description'	=> esc_html__( 'Choose if You Want to Exclude Any Post Category, Control + Click to Select Multiple Categories to Exclude (No Categories are Excluded by Default)', 'codexin' ),
	 						),

	    					array(
	    						'type'			=> 'toggle',
	    						'name'			=> 'show_date',
	    						'label'			=> esc_html__( 'Show Post Pulbished Date?', 'codexin' ),
	    						'value'			=> 'yes',
	    						'description'	=> esc_html__('Choose to enable/disable post published date', 'codexin'),
	    						'admin_label' => true
	    					),

	    					array(
	    						'name'			=> 'title_length',
	    						'label'			=> esc_html__( 'Title Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '4',
	    						'description'	=> esc_html__('Specify number of Words that you want to show in your title', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 3,
	    							'max'			=> 8,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
    						),

	    					array(
	    						'name'			=> 'desc_length',
	    						'label'			=> esc_html__( 'Excerpt Length (In Words)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '10',
	    						'description'	=> esc_html__('Specify number of Words that you want to show in your excerpt', 'codexin'),
	    						'options'		=> array(
	    							'min'			=> 10,
	    							'max'			=> 32,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
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
	    						'description'	=> esc_html__('Displays the post views count and comments count', 'codexin'),
	    					),

	    					array(
	    						'name'	=> 'readmore_text',
	    						'label' => esc_html__( 'Read More Button Text', 'codexin' ),
	    						'type'	=> 'text',
	    						'value'	=> 'Read more',
	    						'description' => esc_html__( 'Edit the text that appears on the "Read more" button.', 'codexin' ),
	    					),

	    					array(
	    						'name'	=> 'class',
	    						'label' => esc_html__( 'Extra Class', 'codexin' ),
	    						'type'	=> 'text',
	    						'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
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

 										'Title' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-title a'),
 											array('property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.blog-title a:hover'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-title'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-title')
										),

 										'Date' => array(
 											array('property' => 'color', 'label' => esc_html__('Date Color', 'codexin'), 'selector' => 'div.meta, .date-time'),
 											array('property' => 'background-color', 'label' => esc_html__('Date Background', 'codexin'), 'selector' => 'div.meta, .date-time'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => 'div.meta, .date-time'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => 'div.meta, .date-time')
										),

 										'Icon' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-info i, ul.meta i, ul.meta .cx-icon')
										),

										'Image Hover' => array(
 											array('property' => 'background', 'label' => esc_html__('Image Hover Color', 'codexin'), 'selector' => '.img-wrapper::before, .img-wrapper::after, .img-thumb:before' )
										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content .blog-desc, .blog-content .blog-category a, .blog-content .meta li, .blog-content .meta li a, .cx-count'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content .blog-desc'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content .blog-desc')
										),

 										'Button' => array(
 											array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'color', 'label' => esc_html__('Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover'),
 											array('property' => 'background-color', 'label' => esc_html__('Backgroung Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover'),
 											array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover'),
 											array('property' => 'transition', 'label' => esc_html__('Hover Transition', 'codexin'), 'selector' => '.blog-content .read-more:hover, .img-thumb .cx-blog-btn:hover'),
 											array('property' => 'font-family', 'label' => esc_html__('Font family', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn'),
 											array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.blog-content .read-more, .img-thumb .cx-blog-btn')
										),

 									// 	'Box'	=> array(
 									// 		array('property' => 'background'),
 									// 		array('property' => 'background-color', 'label' => esc_html__( 'BG Color On Hover' ), 'selector' => '.rv2-single-post:hover .post-img:before' ),
 									// 		array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
 									// 		array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin') ),
 									// 		array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin') ),
 									// 		array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
 									// 		array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
										// ),



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
} // end of cx_blog_kc


