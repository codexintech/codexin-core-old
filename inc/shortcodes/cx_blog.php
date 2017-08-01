<?php
	function cx_blog_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> 'Image',
	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		<section id="blog" class="blog blog-shortcode">
			<div class="container">
				<div class="row">

					<?php 
					//start query..
					$args = array(
						'post_type'			=> 'post',
						'order'				=> 'date',
						'orderby'			=> 'DESC',
						'posts_per_page'	=> 3
						);

					$data = new WP_Query( $args );

						if( $data->have_posts() ) :
							//Srat loop here..
							while( $data->have_posts() ) : $data->the_post();
					 ?>

						<div class="col-sm-4">
							<div class="blog-wrapper">
								<div class="img-thumb">
									<div class="img-wrapper"><img src="<?php echo esc_url( the_post_thumbnail_url( 'blog-mini-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive"></div>
									<div class="meta">
										<p><?php the_time( 'd' ); ?></p>
										<p><?php the_time( 'M' ); ?></p>
									</div>
								</div>

								<div class="blog-content">
									<p class="blog-title"><?php echo esc_html( get_the_title() ); ?></p>
									<p> <?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?> </p>
									<a href="<?php echo esc_url( get_the_permalink() ); ?>">Read More</a>
								</div>

								<div class="blog-info">
									<span><i class="fa fa-eye"></i> <i><?php echo reveal_get_post_views(get_the_ID()); ?></i></span>
									<span><i class="fa fa-comments"></i> <i><?php comments_number('No Comments', '1', '%'); ?></i></span>
								</div>
							</div><!--/.blog-wrapper -->
						</div> <!-- end of col -->
					<?php
						endwhile;
					endif;
					?>
				</div> <!-- end of row -->
			</div> <!-- end of container -->
		</section> <!-- end of blog -->

		<div class="clearfix"></div>

		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_blog


	function cx_blog_kc() {

		if (function_exists('kc_add_map')) 
		{ 
			kc_add_map(
				array(
					'cx_blog' => array(
						'name' => esc_html__( 'Codexin Blog', 'codexin' ),
						'description' => esc_html__('Codexin Blog', 'codexin'),
						'icon' => 'et-hazardous',
						'category' => 'Codexin',
						'params' => array(


		                ) //End params array()..

		            ),  // End of elemnt cx_blog....


						) //end of  array 


					);  //end of kc_add_map....

				} //End if

			} // end of cx_team_kc


