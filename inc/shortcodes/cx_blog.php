<?php 

/**
 * Shortcode -  Blog
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Blog Shortcode
function cx_blog_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'layout'			=> '',
		'grid_col'			=> '',
		'order'				=> '',
		'orderby'			=> '',
		'show_author'		=> '',
		'show_meta'			=> '',
		'show_date'			=> '',
		'show_cat'			=> '',
		'show_comm'			=> '',
		'show_like'			=> '',
		'include'			=> '',
		'chr_length'		=> '',
		'title_length'		=> '',
		'desc_length'		=> '',
		'sticky_post'		=> '',
		'post_meta'			=> '',
		'read_more'			=> '',
		'readmore_txt'		=> '',
		'pagination_type'	=> '',
		'class'				=> ''
	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-blog-standard';

    // Retrieving user define classes
    $classes = array( 'row' );
    ( ! empty( $class ) ) ? $classes[] = $class : '';

	// Extracting user included categories
	$cat_include 	= str_replace( ',', ' ', $include );
	$cat_includes 	= explode( " ", $cat_include );

	ob_start(); 

	?>

	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php 
			echo ( $layout == 'grid' ) ? '<div class="blog-grid-wrapper"><div class="row">' : '<div class="blog-list-wrapper">';
				//start query..
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'post_type'				=> 'post',
					'meta_key'				=> ( $orderby == 'meta_value_num' ) ? 'cx_post_views' : '',
					'order'					=> $order,
					'orderby'				=> $orderby,
					'paged'   				=> $paged,
					'category__in'	 		=> ! empty( $include ) ? $cat_includes : '',
					'ignore_sticky_posts' 	=> ( $sticky_post ) ? '' : 1,
				);

				$data = new WP_Query( $args );

				if( $data->have_posts() ) {
					$i = 0;

					while( $data->have_posts() ) {

						$data->the_post();
						$i++;

						// Retrieving Image alt tag
						$image_alt = ( ! empty( codexin_retrieve_alt_tag() ) ) ? codexin_retrieve_alt_tag() : get_the_title();

						// Assigning classed for post_class
						$post_classes = ( $sticky_post && is_sticky() ) ? 'sticky clearfix' : 'clearfix';

						// Retrieving User Meta Infos
						$show_metas = explode( ',', $show_meta );

						// layout
						if( $layout == 'grid' ) {
							$grid_columns = 12 / $grid_col;
							printf( '<div class="post-single-wrap col-lg-%1$s col-md-%1$s col-sm-12">', $grid_columns );
						}
			            	
			?>
						<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( array( esc_attr( $post_classes ) ) ); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
						    <div class="<?php echo ( $layout == 'grid' ) ? esc_attr( 'blog-wrapper reveal-bg-1' ) : esc_attr( 'post-wrapper reveal-border-1' ); ?>">
						    	<?php if( has_post_format( 'gallery' ) ) {

						        $cx_gallery = ( $layout == 'grid' ) ? rwmb_meta( 'reveal_gallery', 'type=image_advanced&size=codexin-core-rectangle-one' ) : rwmb_meta( 'reveal_gallery', 'type=image_advanced&size=codexin-framework-rectangle-four' );
						        echo '<div class="gallery-carousel image-pop-up">';
							        foreach( $cx_gallery as $cx_image ) {

							        	// Retrieving Image width, height, caption and alt tag
							            $image_data =  wp_get_attachment_metadata( $cx_image['ID'] );
							            $data_size  = $image_data['width'] . 'x' . $image_data['height'];
							            $caption    = $cx_image['caption'];
							            $img_alt    = ( !empty( $cx_image['alt'] ) ) ? 'alt="' .  esc_attr( $cx_image['alt'] ) . '"' : ''; 

						            ?>

							            <figure class="item-img-wrap" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
							                <a href="<?php echo esc_url( $cx_image['full_url'] ); ?>" itemprop="contentUrl" data-size="<?php echo esc_attr( $data_size ); ?>">
							                    <img src="<?php echo esc_url( $cx_image['url'] ); ?>" itemprop="image" <?php printf( '%s', $img_alt ); ?> class="img-responsive" />
							                    <div class="item-img-overlay">
							                        <span></span>
							                    </div>
							                </a>
							                <figcaption itemprop="caption description"><?php echo esc_html( $caption ); ?></figcaption>
							            </figure>

								    <?php 
									}
						        echo '</div><!-- end of gallery-carousel -->';

							    } elseif( has_post_format( 'audio' ) ) {

						            $cx_embed = rwmb_meta( 'reveal_audio', 'type=oembed' );
						            echo '<div class="embed">';
						                echo sprintf( '%s', $cx_embed );
						            echo '</div> <!-- end of embed -->';

								} elseif( has_post_format( 'video' ) ) {

						            $cx_embed = rwmb_meta( 'reveal_video', 'type=oembed' );
						            echo '<div class="embed">';
						                echo sprintf( '%s', $cx_embed );
						            echo '</div> <!-- end of embed -->';

								} elseif( has_post_format( 'link' ) ) {

						            $link_url 		= rwmb_meta( 'reveal_link_url', 'type=text' );
						            $link_txt 		= rwmb_meta( 'reveal_link_text', 'type=text' );
						            $link_rel 		= rwmb_meta( 'reveal_link_rel', 'type=text' ); 
						            $link_target 	= rwmb_meta( 'reveal_link_target', 'type=select' ); 

						            $cx_rel = ( !empty( $link_rel ) ) ? 'rel="'. esc_attr( $link_rel ) .'"' : '';
						            ?>
						            <div class="post-link reveal-color-0">
						                <a href="<?php echo esc_url( $link_url ); ?>" <?php printf( '%s', $cx_rel ); ?> target="<?php echo ( $link_target == '_self') ? esc_attr( '_self' ) : esc_attr( '_blank' ); ?>">
						                    <div class="post-format-link reveal-border-1">
						                        <span class="icon"></span>
						                        <p><?php echo ( ! empty( $link_txt ) ) ? esc_html( $link_txt ) : get_the_title(); ?></p>
						                    </div>
						                </a>
						            </div> <!-- end of post-link -->
							    
							    <?php
								} elseif ( has_post_format( 'quote' ) ) {

						            $cx_quote 		= rwmb_meta( 'reveal_quote_text', 'type=textarea' );
						            $cx_name 		= rwmb_meta( 'reveal_quote_name', 'type=text' );
						            $cx_source 		= rwmb_meta( 'reveal_quote_source', 'type=url' );

						            if( !empty( $cx_quote ) ) { ?>
						                <div class="post-quote reveal-color-0 reveal-border-1">
							                <span class="icon"></span>
						                    <blockquote>
						                        <?php 
						                        printf( '%s', $cx_quote );

						                        echo ( ! empty( $cx_source ) ) ? '<a href="'. esc_url( $cx_source ) .'">' : '';
						                        	echo ( ! empty( $cx_name ) ) ? '<span> - '. esc_html( $cx_name ) .'</span>' : '';
						                        echo ( ! empty( $cx_source ) ) ? '</a>' : '';

						                        ?>
						                    </blockquote>
						                </div> <!-- end of post-quote -->
						            <?php 
							        }

							    } else {

									$thumbnail_size = ( $layout == 'grid' ) ? 'codexin-core-rectangle-one' : 'codexin-framework-rectangle-two';
									if( function_exists( 'codexin_attachment_metas_extended' ) ) {
										$post_thumbnail = codexin_attachment_metas_extended( get_the_ID(), 'blog', $thumbnail_size )['src'];
									} else {
										$post_thumbnail = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size ) : '//placehold.it/600X400';
									}

							    	if( $layout == 'grid' ) {
							    ?>
								        <div class="img-thumb">
								            <div class="img-wrapper">
								            	<a href="<?php echo esc_url( get_the_permalink() ); ?>">
								            		<img src="<?php echo esc_url( $post_thumbnail ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="img-responsive">
								            	</a>
								            </div>

								            <?php if( in_array( 'show_date', array_values( $show_metas ) ) ) { ?>
								                <div class="meta reveal-color-2">
								                	<a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) ); ?>">
									                    <p><?php echo esc_html( get_the_time( 'd' ) ); ?></p>
									                    <p><?php echo esc_html( get_the_time( 'M' ) ); ?></p>
								                	</a>
								                </div>
								            <?php } ?>
								        </div> <!-- end of img-thumb -->

							        <?php } else { ?>

							            <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="blog-media-wrapper">
							                <figure class="item-img-wrap" itemscope itemtype="http://schema.org/ImageObject">
							                    <img src="<?php echo esc_url( $post_thumbnail ); ?>" class="img-responsive" alt="<?php echo esc_attr( $image_alt ); ?>" itemprop="image">
							                    <div class="item-img-overlay">
							                        <span></span>
							                    </div>
							                </figure>                       
							            </a> <!-- end of blog-media-wrapper -->
					            	<?php 
						            }
					            }

								if( $layout == 'grid' ) { ?>

							        <div class="blog-content reveal-border-1">
							            <h3 class="blog-title grid" itemprop="headline">
							            	<a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" itemprop="url">
								                <span itemprop="name">
								                <?php 
								                    if( $chr_length ) {
								                    	if( function_exists( 'codexin_char_limit' ) ) {
									                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
								                    	} else {
													    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
								                    	}
								                    } else {
								                        the_title();
								                    }
								                ?>
								                </span>
								            </a>
								        </h3>
								<?php }

									if( in_array( true, array_values( $show_metas ) ) ) { ?>
							            <ul class="list-inline post-detail reveal-color-0 reveal-border-1 <?php echo esc_attr( ( $layout == 'grid' ) ? 'post-meta' : '' ); ?>">

							            	<?php if( in_array( 'show_author', array_values( $show_metas ) ) ) { ?>
								                <li><i class="fa fa-pencil"></i> <span class="post-author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
								                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemprop="url" rel="author">
								                        <span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
								                    </a>
								                    </span>
								                </li>
								            <?php } ?>

											<?php if(in_array( 'show_date', array_values( $show_metas ) ) && ( $layout == 'list' ) ) { ?>
								                <li><i class="fa fa-calendar"></i> <a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) );  ?>"><time datetime="<?php echo get_the_time( 'c' ); ?>" itemprop="datePublished"><?php echo esc_html( date( get_option('date_format'), strtotime( get_the_time( 'd M, Y' ) ) ) ); ?></time></a> </li>
											<?php } ?>
											
											<?php if( in_array( 'show_cat', array_values( $show_metas ) ) ) { ?>
								                <li><i class="fa fa-tag"></i> <span itemprop="genre"><?php the_category( ', ' )?></span></li>
								            <?php } ?>

											<?php if( in_array( 'show_comm', array_values( $show_metas ) ) ) { ?>
								                <li><i class="fa fa-comment"></i><a href="<?php comments_link(); ?>"><?php esc_html( comments_number( 'No Comments', 'One Comment', '% Comments' ) )?></a></li>
								            <?php } ?>

											<?php if( in_array( 'show_like', array_values( $show_metas ) ) ) { ?>
								                <li><?php echo codexin_likes_button( get_the_ID(), 0 ); ?></li>
								            <?php } ?>

							            </ul> <!-- end of post-detail -->
							        <?php }

						        if( $layout == 'list' ) { ?>	
							        <h2 class="post-title" itemprop="headline">
							            <a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" itemprop="url">
							                <span itemprop="name">
							                <?php 
							                    if( $chr_length ) {
							                    	if( function_exists( 'codexin_char_limit' ) ) {
								                        echo apply_filters( 'the_title', codexin_char_limit( $title_length, 'title' ) );
							                    	} else {
												    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
							                    	}
							                    } else {
							                        the_title();
							                    }
							                ?>
							                </span>
							            </a>
							        </h2>
							    <?php } ?>

	                			<div class="<?php echo ($layout == 'grid') ? esc_attr( 'wrapper-content' ) : esc_attr( 'entry-content' ); ?>" itemprop="text">
					                <?php 
					                    if( $chr_length ) {
					                    	if( function_exists( 'codexin_char_limit' ) ) {
					                    		echo '<p>';
							                        echo apply_filters( 'the_content', codexin_char_limit( $desc_length, 'excerpt' ) );
							                    echo '</p>';
					                    	} else {
										    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
					                    	}
					                    } else {
					                        the_excerpt();
					                    }
					                ?>
	                    		</div> <!-- end of <?php echo ($layout == 'grid') ? 'wrapper-content' : 'entry-content'; ?> -->
				                <?php if( $read_more ) { ?>
					                <div class="<?php echo ( $layout == 'grid' ) ? esc_attr( 'cx-btn-grid' ) : esc_attr( 'cx-btn' ); ?> reveal-color-0 reveal-primary-btn">
					                    <a class="cx-btn-text" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( ! empty( $readmore_txt ) ? $readmore_txt : esc_html__( 'Read More', 'codexin' ) ); ?></a>
					                </div>
	                    		<?php }
	                    		?>
	                    		<?php echo ($layout == 'grid') ? '</div> <!-- end of blog-content -->' : ''; ?>
					        </div> <!-- end of <?php echo ($layout == 'grid') ? 'blog-wrapper' : 'post-wrapper'; ?> -->
					    </article> <!-- #post-## -->
					    <?php 
					    if( $layout == 'grid' ) {
		                    echo '</div><!-- end of post-single-wrap -->';

		                    if( $i % $grid_col == 0 ) {
		                        echo '<div class="clearfix"></div>';
		                    }
		                }

					} // end of loop have_posts()
				} //End check-posts if()
				wp_reset_postdata();
				?>

				<?php 
				echo '<div class="clearfix"></div>';
				echo ( $layout == 'grid' ) ? '<div class="col-xs-12">' : '' ;
				if( $pagination_type == 'numbered' ) {
					if( function_exists( 'codexin_numbered_posts_nav' ) ) {
				        echo codexin_numbered_posts_nav( $data );
					} else {
				    	echo '<p class="cx-error">'.esc_html__('Please Activate \'REVEAL\' Theme!', 'codexin').'</p>';
					}
			    } elseif( $pagination_type == 'button' ) {
			    	if( function_exists( 'codexin_posts_link' ) ) {
				        codexin_posts_link( 'Newer Posts', 'Older Posts', $data );
			    	} else {
				    	echo '<p class="cx-error">'.esc_html__( 'Please Activate \'REVEAL\' Theme!', 'codexin' ).'</p>';
			    	}
			    }
			    echo ( $layout == 'grid' ) ? '</div>' : '' ;

				 ?>
				</div> <!-- end of <?php echo ($layout == 'grid') ? 'row' : 'blog-list-wrapper'; ?> -->
			<?php echo ($layout == 'grid') ? '</div> <!-- end of blog-grid-wrapper -->' : ''; ?>
		</div> <!-- end of row -->
	</div> <!-- end of cx-blog-standard -->

	<?php
	$result .= ob_get_clean();
	return $result;
}


// Integrating Shortcode with King Composer
function cx_blog_kc() {

	$cx_categories = codexin_get_post_categories();

	if( function_exists( 'kc_add_map' ) ) { 
		kc_add_map(
			array(
				'cx_blog' => array(
					'name' 			=> esc_html__( 'Codexin Blog', 'codexin' ),
					'description' 	=> esc_html__( 'Codexin Blog', 'codexin' ),
					'icon' 			=> 'et-hazardous',
					'category' 		=> 'Codexin',
					'params' 		=> array(
	    				// General Params
						'general' 	=> array(

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'layout',
	    						'label'			=> esc_html__( 'Select Layout', 'codexin' ),
	    						'value'			=> 'list',
	    						'options'		=> array(
	    							'list' 		=> esc_html__( 'List View', 'codexin' ),
	    							'grid'	    => esc_html__( 'Grid View', 'codexin' ),
	    						),
	    						'description'	=> esc_html__( 'Choose the posts view.', 'codexin' ),
	    						'admin_label' 	=> true,
	    					),

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'grid_col',
	    						'label'			=> esc_html__( 'Number of Column', 'codexin' ),
	    						'value'			=> '2',
	    						'options'		=> array(
	    							'2' 		=> esc_html__( '2', 'codexin' ),
	    							'3'		    => esc_html__( '3', 'codexin' ),
	    							'4'		    => esc_html__( '4', 'codexin' ),
	    						),
    							'relation'		=> array(
    								'parent' 	=> 'layout',
    								'show_when'	=> 'grid',
    							),
	    						'description'	=> esc_html__( 'Choose the number of column to diplay posts.', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'sticky_post',
	    						'label'       	=> esc_html__( 'Show Sticky Post? ', 'codexin' ),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Enable this if you want to show sticky post first.', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'checkbox',
	    						'name'			=> 'show_meta',
	    						'label'			=> esc_html__( 'Which Posts Meta You Want to Show? ', 'codexin' ),
	    						'value'			=> array( 'show_date', 'show_cat' ),
	    						'options'		=> array(
	    							'show_author' => esc_html__( 'Post Author Name', 'codexin' ),
	    							'show_date'   => esc_html__( 'Post Published Date', 'codexin' ),
	    							'show_cat'    => esc_html__( 'Post Categories', 'codexin' ),
	    							'show_comm'   => esc_html__( 'Post Comments Number', 'codexin' ),
	    							'show_like'   => esc_html__( 'Post Likes', 'codexin' ),

	    						),
	    						'description'	=> esc_html__( 'Choose to enable/disable meta information', 'codexin' ),
	    					),

	    					array(
	    						'name'        	=> 'chr_length',
	    						'label'       	=> esc_html__( 'Enable Blog Title and Excerpt Length? ', 'codexin' ),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'no',
	    						'description'	=> esc_html__( 'Select to enable/disable blog-title & excerpt length.', 'codexin' ),
	    					),

	    					array(
	    						'name'			=> 'title_length',
	    						'label'			=> esc_html__( 'Title Length (In Character)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '30',
    							'relation'		=> array(
    								'parent' 	=> 'chr_length',
    								'show_when'	=> 'yes',
    							),
	    						'description'	=> esc_html__( 'Specify number of Characters that you want to show in your title', 'codexin' ),
	    						'options'		=> array(
	    							'min'			=> 10,
	    							'max'			=> 150,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							)
    						),

	    					array(
	    						'name'			=> 'desc_length',
	    						'label'			=> esc_html__( 'Excerpt Length (In Character)', 'codexin' ),
	    						'type'			=> 'number_slider',
	    						'value'			=> '180',
    							'relation'		=> array(
    								'parent' 	=> 'chr_length',
    								'show_when'	=> 'yes',
    							),
	    						'description'	=> esc_html__( 'Specify number of Characters that you want to show in your excerpt', 'codexin' ),
	    						'options'		=> array(
	    							'min'			=> 20,
	    							'max'			=> 500,
	    							'unit'			=> '',
	    							'show_input'	=> false
    							),
    						),

	    					array(
	    						'name'        	=> 'read_more',
	    						'label'       	=> esc_html__( 'Enable Read More Button? ', 'codexin' ),
	    						'type'        	=> 'toggle',
	    						'value'			=> 'yes',
	    						'description'	=> esc_html__( 'Select to enable/disable Read More button.', 'codexin' ),
	    					),

	    					array(
	    						'name'			=> 'readmore_txt',
	    						'label' 		=> esc_html__( 'Button Text', 'codexin' ),
	    						'type'			=> 'text',
	    						'value' 		=> esc_html__( 'Read More', 'codexin' ),
    							'relation'		=> array(
    								'parent' 	=> 'read_more',
    								'show_when'	=> 'yes',
    							),
	    						'description' 	=> esc_html__( 'Enter Button Text', 'codexin' ),
	    					),

	    					array(
	    						'type'			=> 'select',
	    						'name'			=> 'pagination_type',
	    						'label'			=> esc_html__( 'Pagination Type', 'codexin' ),
	    						'value'			=> 'button',
	    						'options'		=> array(
	    							'button' 	=> esc_html__( 'Classic Next-Previous Button', 'codexin' ),
	    							'numbered'  => esc_html__( 'Numbered Pagination', 'codexin' ),
	    						),
	    						'description'	=> esc_html__( 'Choose the Pagination Type', 'codexin' ),
	    					),

	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
	    						'type'			=> 'text',
	    						'description' 	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	    					),
						), //End general params

	    				// Advanced Params
						'advanced' => array(

	    					array(
	    						'name'        	=> 'order',
	    						'label'       	=> esc_html__( 'Post Order', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> array(
    								'ASC'		=> esc_html__( 'Ascending', 'codexin' ),
    								'DESC'		=> esc_html__( 'Descending', 'codexin' ),
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
	 							'name' 			=> 'include',
	 							'label' 		=> esc_html__( 'Filter Categories', 'codexin' ),
	 							'type' 			=> 'multiple',
	 							'options'		=> $cx_categories,
	 							'description'	=> esc_html__( 'Choose if You Want to Show Any Specific Post Category/Categories, Control + Click to Select Multiple Categories to Filter (All Categories will be shown by Default)', 'codexin' ),
	 						),
    					),
	                ) //End params array
	            ),  // End of cx_blog array
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_blog_kc


