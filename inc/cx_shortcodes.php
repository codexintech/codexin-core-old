<?php 

add_action('init', 'codexin_shortcodes');

function codexin_shortcodes() {

	$shortcodes = array(
		'cx_section_heading',
		'cx_about_box',
		'cx_animated_counter',
		'cx_service_box',
		'cx_information_box',
		'cx_events_box',
		'cx_testimonial',
		'cx_team',
		'cx_portfolio',
		'cx_client',
		'cx_client',
		'cx_blog',
		'cx_map',
		'cx_contact_form',
		'cx_social_media_share',

	);

	foreach ( $shortcodes as $shortcode ) :
		add_shortcode( $shortcode, $shortcode . '_shortcode' );
	endforeach;

}


// Custom function for retrieving Image URL
function retrieve_img_src ( $image, $image_size ) {

   $img_src = wp_get_attachment_image_src($image, $image_size);
   $img_source = $img_src[0];
   return $img_source;

}


// Custom function for retrieving page URL, title and target
function retrieve_url ( $href ) {

	if ( !empty( $href ) ) {
		$link_arr = explode( "|", $href );

		( !empty( $link_arr[0] ) ) ? $link_url = $link_arr[0] : $link_url = '';
		( !empty( $link_arr[1] ) ) ? $cx_link_title = $link_arr[1] : $cx_link_title = '';
		( !empty( $link_arr[2] ) ) ? $link_target = $link_arr[2] : $link_target = '';

		return array( $link_url, $cx_link_title, $link_target );

	}

}


/*  
* 
*  Codexin Section Header Shortcode
*
*/

function cx_section_heading_shortcode(  $atts, $content = null) {
	   extract(shortcode_atts(array(
	   			'title' 				=> '',
	   			'subtitle'	 			=> '',
	   			'description_toggle' 	=> '',
	   			'description'  			=> '',
	   			'class'		  			=> '',
	   ), $atts));

	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'section-heading';
	   $classes = array( 'cx-section-heading' );
	   (!empty($class)) ? $classes[] = $class : '';

	   $result = '';
	   ob_start(); ?>
			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<h3 class="primary-title"><?php echo esc_html( $title ); ?></h3>
					<h2 class="secondary-title"><?php echo esc_html( $subtitle ); ?></h2>
					<?php if( $description_toggle == 'yes' ): ?>
					<div class="col-md-10 col-md-offset-1 cx-description">
						<p><?php printf('%s', $description ); ?></p>		
					</div>
					<?php endif; ?>
				</div>
			</div>

		<?php
		$result .= ob_get_clean();
		return $result;

}


/*  
* 
*  Codexin About Box Shortcode
*
*/

function cx_about_box_shortcode(  $atts, $content = null) {
	   extract(shortcode_atts(array(
	   			'image'	 			=> '',
	   			'img_alt'		 	=> '',
	   			'hover'  		=> '',
	   			'icon_toggle'  		=> '',
	   			'link_toggle'  		=> '',
	   			'hover_icon'  		=> '',
	   			'href'		  		=> '',
	   			'img_action'  		=> '',
	   			'class'				=> '',
	   			'img_class'			=> ''
		), $atts));

		$result = '';

		$retrive_img_url = retrieve_img_src( $image, 'about-mini-image' );
		$ret_full_img_url = retrieve_img_src( $image, 'full' );

		$retrieve_link = retrieve_url( $href );

		$master_class = apply_filters( 'kc-el-class', $atts );
		$master_class[] = 'about-box';

		$classes = array( 'img-thumb' );
		$img_classes = array();

		(!empty($class)) ? $classes[] = $class : '';
		(!empty($img_class)) ? $img_classes[] = $img_class : '';

	   	ob_start(); ?>

			<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php if ( $img_action == 'open_custom_link' ): ?>
					<a href="<?php echo esc_url($retrieve_link[0]); ?>" title="<?php echo esc_attr($retrieve_link[1]); ?>" target="<?php echo esc_attr($retrieve_link[2]); ?>">
					<?php elseif ( $img_action == 'img_pop' ): ?>
					<a href="<?php echo $ret_full_img_url; ?>" class="event-image-popup">
					<?php else: ?>
					<div class="content-wrapper">
					<?php endif; ?>
						<img src="<?php echo $retrive_img_url; ?>" alt="<?php echo $img_alt; ?>" />
						<div class="single-content-wrapper">
							<div class="single-content">

								<?php if( $icon_toggle ): ?>
								<i class="<?php echo esc_attr( $hover_icon ); ?>"></i>
								<?php endif; ?>
								
								<p><?php echo esc_html( $hover ); ?></p>
							</div>
						</div>
					<?php if ( $img_action == 'open_custom_link' || $img_action == 'img_pop' ): ?>
					</a>
					<?php else: ?>
					</div>
					<?php endif; ?>
				</div>
			</div>

		<?php
		$result .= ob_get_clean();
		return $result;

}


/*  
* 
*  Codexin Counter Box Shortcode
*
*/


function cx_animated_counter_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
			'icon_toggle' => '',
			'icon'        => '',
			'count_up'    => '',
			'txt' 		  => '',
			'class'		  => ''

	   	), $atts));

	   	$result = '';

		$master_class = apply_filters( 'kc-el-class', $atts );
		$master_class[] = 'cx-animated-counter';
		
		$classes = array( 'project' );
		(!empty($class)) ? $classes[] = $class : '';

	   	ob_start(); 
		?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<?php if( $icon_toggle == 'yes' ): ?>
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
				<?php endif; ?>

				<span class="counter"><?php echo esc_html( $count_up ); ?></span>
				<p><?php echo esc_html( $txt ); ?></p>
			</div>
		</div>

		<?php
		$result .= ob_get_clean();
		return $result;
}



/*  
* 
*  Codexin Service Box Shortcode
*
*/


function cx_service_box_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'layout'    		=> '',
	   		'icon'    	  		=> '',
	   		'icon_toggle'		=> '',
			'service_title'		=> '',
			'service_desc' 		=> '',

	   	), $atts));

	   	$result = '';

		$master_class = apply_filters( 'kc-el-class', $atts );
		$master_class[] = 'cx-service-box';
		
		$classes = array( 'single-service' );
		(!empty($class)) ? $classes[] = $class : '';

	   	ob_start(); 
		?>

		<?php if( $layout == 3 ): ?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="media">
					<?php if( $icon_toggle ): ?>
					<div class="media-left">
						<i class="<?php echo esc_attr( $icon ); ?>"></i>
					</div>
					<?php endif; ?>
					<div class="media-body">
					<h4 class="media-heading"><?php echo esc_html( $service_title ); ?></h4>
					<p><?php printf( '%s', $service_desc ) ; ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php
		$result .= ob_get_clean();
		return $result;
}



/*  
* 
*  Codexin Information Box Shortcode
*
*/


function cx_information_box_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
			'info_title'	=> '',
			'info_desc' 	=> '',
			'info_image'	=> '',
			'img_alt'		=> '',
			'button_toggle'	=> '',
			'info_button_text' => '',
			'href'			=> '',
			'class'			=> ''

	   ), $atts));

	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'contest-wrapper';
	   $classes = array( 'content-mask' );
	   (!empty($class)) ? $classes[] = $class : '';

	   $result = '';

	   $retrive_img_url = retrieve_img_src( $info_image, 'info-image' );

	   $retrieve_link = retrieve_url( $href );

	   ob_start(); 
		?>
			<!-- <div class="col-sm-12"> -->
				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<img src="<?php echo esc_url( $retrive_img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">	
						<h2><?php echo esc_html( $info_title, 'codexin' ); ?></h2>
						<p> <?php printf('%s', $info_desc ); ?> </p>
						<?php if( $button_toggle == 'yes') : ?>
							<a href="<?php echo esc_url($retrieve_link[0]); ?>" title="<?php echo esc_attr($retrieve_link[1]); ?>" target="<?php echo esc_attr($retrieve_link[2]); ?>"><?php echo esc_html( $info_button_text ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			<!-- </div> -->
		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_information_box



/*  
* 
*  Codexin Events Box Shortcode
*
*/


function cx_events_box_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
			'event_icon_one'	=> '',
			'event_icon_two'	=> '',
			'event_icon_three'	=> '',
	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		
			<div class="events-description">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

				<?php 
					//start new query..

					$args = array(
							'post_type'		 => 'events',
							'order' 		 => 'DESC',
							'posts_per_page' => 3,
						);

					$data = new WP_Query( $args );

					if( $data->have_posts() ) :
						//Start loop here...
						$i = 0;
						while( $data->have_posts() ) : $data->the_post();
							$i++;
							if( $i == 1 ) { 
								$event_icon = $event_icon_one;
								$heading_id = 'headingOne';
								$collapse_id = 'collapseOne';
							}elseif ( $i == 2 ) {
								$event_icon = $event_icon_two;
								$heading_id = 'headingTwo';
								$collapse_id = 'collapseTwo';
							}elseif ( $i == 3 ) {
								$event_icon = $event_icon_three;
								$heading_id = 'headingThree';
								$collapse_id = 'collapseThree';
							}
				 ?>

					<div class="panel panel-default">
					<?php
						if( $i == 1 ) :
							$class_in = 'in';
					 ?>
						<div class="panel-heading active" role="tab" id="<?php echo $heading_id; ?>">
					<?php
						else : 
							$class_in = '';
					?>
						<div class="panel-heading" role="tab" id="<?php echo $heading_id; ?>">

					<?php	
						endif;
					 ?>	
							<h4 class="panel-title">
								<a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $collapse_id;?>" aria-expanded="true" aria-controls="<?php echo $collapse_id;?>">
									<i class="<?php echo esc_attr( $event_icon );?>" > </i> <?php echo esc_html( the_title() ); ?>
								</a>
							</h4>
						</div>
						<div id="<?php echo $collapse_id;?>" class="panel-collapse collapse <?php echo $class_in; ?>" role="tabpanel" aria-labelledby="<?php echo $heading_id; ?> ">
							<div class="panel-body">
								<p> <?php printf('%s', the_excerpt() ); ?> </p>
							</div>
						</div>
					</div><!--/.panel- panel-defult-->
					<?php 
							endwhile;
						endif; //End check-posts if()....
						wp_reset_postdata();
					 ?>
					
				</div><!--/.panel-group-->
			</div>  <!-- end of events description -->


		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_events_box



/*  
* 
*  Codexin Team Shortcode
*
*/
function cx_team_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> 'Team Image',
	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		
		<section id="team" class="team">
			<!-- <div class="container"> -->
				<div class="row">	
					<?php 
					//start new query..
					$args = array(
						'post_type'		 => 'team',
						'order'			 => 'DESC',
						'posts_per_page' => 4,
						);

					$data = new WP_Query( $args );
					//check post..
					if( $data->have_posts() ) :
						//Start loop here..
						while( $data->have_posts() ) :	$data->the_post();
					?>
						<div class="col-sm-3">
							<div class="single-team">
								<img src="<?php echo esc_url( the_post_thumbnail_url('team-mini-image') ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive" />
								<div class="single-team-wrapper">
									<div class="team-social">
										<?php 
											$designation = rwmb_meta( 'reveal_team_designation', 'type=text' );
											$fb = rwmb_meta( 'reveal_team_facebook', 'type=text' );
											$tr = rwmb_meta( 'reveal_team_twitter', 'type=text' );
											$ig = rwmb_meta( 'reveal_team_ig', 'type=text' );
											$gp = rwmb_meta( 'reveal_team_gp', 'type=text' );

											if( ! empty( $fb ) ) :
										 ?>
											<a href="<?php echo esc_url( $fb ); ?>"><i class="fa fa-facebook"></i></a>
										<?php endif;
											if( ! empty( $tr ) ) :
										 ?>
											<a href="<?php echo esc_url( $tr ); ?>"><i class="fa fa-twitter"></i></a>
										<?php endif;
											if( ! empty( $ig ) ) :
										 ?>
											<a href="<?php echo esc_url( $ig ); ?>"><i class="fa fa-instagram"></i></a>
										<?php endif;
											if( ! empty( $gp ) ) :
									 	?>
											<a href="<?php echo esc_url( $gp ); ?>"><i class="fa fa-google-plus"></i></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="team-description text-center">
								<p><?php echo esc_html( the_title() ); ?></p>
								<p><?php echo esc_html( $designation ); ?></p>
							</div>
						</div><!--/.col-sm-3-->

					<?php 
							endwhile;
						endif; //End check-post if()..
						wp_reset_postdata();
					 ?>

				</div><!--/.row-->
			<!-- </div> --><!--/#container-->
		</section>
		<div class="clearfix"></div>

		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_team



/*  
* 
*  Codexin Portfolio Shortcode
*
*/
function cx_portfolio_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> 'Portfolio Image',
	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		
		<section id="portfolio" class="portfolios">
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

						$id =  $post->ID;  

						$term_list = wp_get_post_terms( get_the_ID(), 'portfolio-category' ); 
			 	?>
						<div class="portfolio <?php foreach ($term_list as $sterm) { echo $sterm->slug.' '; } ?>">
							<img src="<?php echo esc_url( the_post_thumbnail_url( 'portfolio-mini-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
							<a href="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>" class="img-pop-up">
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
		</section> <!-- end of portfolio -->

		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_portfolio



/*  
* 
*  Codexin Client Shortcode
*
*/
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




/*  
* 
*  Codexin Client Testimonial Shortcode
*
*/
function cx_testimonial_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> 'Image',
	   		'layout'	=> '',
	   ), $atts));

	   $result = '';

	   ob_start(); 

	   		if( ! empty( $layout ) ) :
	   			if( $layout == 2 ) :
		?>
					<section id="testimonials" class="testimonials animated">
						<!-- <div class="container"> -->
							<div class="row">
								<?php 
								//start new query..
								$args = array(
									'post_type'		 => 'testimonial',
									'order'			 => 'date',
									'orderby'		 => 'DESC',
									'posts_per_page' => 4,
									);

								$data = new WP_Query( $args );
								if( $data->have_posts() ) :
									//Start loop here...
									while( $data->have_posts() ) : $data->the_post();

								?>
									<div class="col-sm-6 quote-wrapper">
										<div class="media">
											<div class="media-left">
												<img class="media-object img-circle" src="<?php echo esc_url( the_post_thumbnail_url( 'testimonial-mini-image' ) ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
											</div>
											<div class="media-body">
												<h3 class="media-heading">
													<?php 
														$name = rwmb_meta( 'reveal_author_name', 'type=text' ); 
														echo esc_html( $name );
													?>
												</h3>
												<p class="designation">
													<?php 
														$desig = rwmb_meta( 'reveal_author_desig', 'type=text' ); 
														echo esc_html( $desig );
													?>
												</p>
												<p> <?php printf('%s', get_the_excerpt() ); ?> </p>
											</div>
										</div>
									</div> <!--/.quote-wrapper -->

								<?php 
										endwhile;
									endif;
									wp_reset_postdata();
								 ?>

							</div><!--/.row -->
						<!-- </div> --><!--/.container -->
					</section> <!-- end of testimonials -->

			<?php 
				endif; //End layout - 2 ...

					if( $layout == 1 ) :
			?>

						<div id="quote" class="quote">
							<!-- <div class="container"> -->
								<div class="testimonial-row">
									<!-- <div class="col-xs-12"> -->
										<div id="quote-carousel" class="carousel slide" data-ride="carousel">
											<!-- Indicators -->
											<ol class="carousel-indicators hidden">
												<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
												<li data-target="#quote-carousel" data-slide-to="1"></li>
											</ol>

											<!-- Wrapper for slides -->
											<div class="row">
												<div class="col-sm-8 col-sm-offset-2">
													<div class="carousel-inner" role="listbox">
														<?php 
															//start new query..
														$args = array(
															'post_type'		 => 'testimonial',
															'order'			 => 'date',
															'orderby'		 => 'DESC',
															'posts_per_page' => -1,
															);

														$data = new WP_Query( $args );
														$i = 0;
														if( $data->have_posts() ) :
																//Start loop here...
															while( $data->have_posts() ) : $data->the_post();
														$i++;

														if( $i == 1 ) :
															?>
														<div class="item active">
															<?php 
															else : ?>
															<div class="item">
																<?php
																endif;
																?>

																<div class="quote-wrapper">
																	<div class="quote-author-thumb">
																		<i class="fa fa-comments"></i>
																	</div>
																	<div class="quote-text">
																		<p> <?php printf( '%s', the_excerpt() ); ?> </p>
																		<p class="quote-author-name">
																			<?php 
																			$aut_name = rwmb_meta( 'reveal_author_name','type=text' );
																			echo esc_html( $aut_name );
																			?>
																		</p>
																	</div>
																</div>
															</div> <!--/item-->
															<?php 
															endwhile;
														endif; //End check-posts if()....
														wp_reset_postdata();
														?>	
													</div> <!-- end of carousel inner -->
												</div> <!-- end of col -->
											</div> <!-- end of row -->


											<!-- Controls -->
											<a class="left quote-carousel-control" href="#quote-carousel" role="button" data-slide="prev">
												<i class="fa fa-angle-left"></i>
											</a>
											<a class="right quote-carousel-control" href="#quote-carousel" role="button" data-slide="next">
												<i class="fa fa-angle-right"></i>
											</a>
										</div><!--#quote-carousel-->
									<!-- </div> --><!--/.col-xs-12-->
								</div><!--/.row-->
							<!-- </div> --><!--/container-->
						</div>  <!-- end of quote -->

			<?php			
				endif; //End layout-1
			?>

		<?php
			endif;
		$result .= ob_get_clean();
		return $result;

} //End cx_happy_client



/*  
* 
*  Codexin Blog Shortcode
*
*/
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



/*  
* 
*  Codexin Map Shortcode
*
*/
function cx_map_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> 'Image',
	   ), $atts));

	   $result = '';

	   ob_start(); 

	   if(!empty(reveal_option('reveal-google-map-latitude'))):
	   	$latitude = reveal_option('reveal-google-map-latitude');
	   endif;

	   if(!empty(reveal_option('reveal-google-map-longitude'))):
	   	$longtitude = reveal_option('reveal-google-map-longitude');
	   endif;

	   if(!empty(reveal_option('reveal-google-map-zoom'))):
	   	$c_zoom = reveal_option('reveal-google-map-zoom');
	   endif;

	   if(!empty(reveal_option('reveal-google-map-marker'))):
	   	$gmap_marker = reveal_option('reveal-google-map-marker');
	   endif;

	   $codeopt = '';
	   $codeopt .= '
	   <script type="text/javascript">
	   	var reveal_lat = "'. $latitude .'"; 
	   	var reveal_long = "'. $longtitude .'"; 
	   	var reveal_marker = "'. $gmap_marker['url'] .'"; 
	   	var reveal_m_zoom = Number ("'. $c_zoom .'"); 
	   </script>

	   ';

	   echo $codeopt;

	   ?>
		
		<div id="map">
			<div id="gmap-wrap">
				<div id="gmap"> 				
				</div>	 			
			</div>
		</div><!--/#map-->
				

		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_map


/*  
* 
*  Codexin Contact form Shortcode
*
*/
function cx_contact_form_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'contact_title'	=> 'Get In touch',
	   		'show_form_id'	=> '',
	   		'contact_desc'	=> ''
	   ), $atts));

	   $result = '';

	   ob_start(); 
	?>
		<!-- <section id="location" class="location contact-location"> -->
			<div class="contact-form-wrapper reveal-contact-form">
				<div class=" contact-form">
					<div class="contact-intro">
						<h3><?php echo esc_html( $contact_title ); ?></h3>
						<p><?php printf( '%s', $contact_desc ); ?></p>
					</div>		
					<div class="row">

						<?php echo do_shortcode( '[contact-form-7 id="'. $show_form_id .'" title="Contact form 1"]' ); ?>

					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of col -->		
		<!-- </section> -->

	<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_contact_form



/*  
* 
*  Codexin Social Media Share Shortcode
*
*/
function cx_social_media_share_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'fb'	=> '',
	   		'tw'	=> '',
	   		'ld'	=> '',
	   		'ig'	=> '',
	   		'be'	=> '',
	   ), $atts));

	   $result = '';

	   ob_start(); 
	?>
		<div class="socials socials-share">
			<?php 
				if( ! empty( $fb ) ) :
			 ?>
				<a href="<?php echo esc_url( $fb ); ?>"><i class="fa fa-facebook"></i></a>
			<?php endif;
				if( ! empty( $tw ) ) :
			 ?>
				<a href="<?php echo esc_url( $tw ); ?>"><i class="fa fa-twitter"></i></a>
			<?php endif; 
				if( ! empty( $ld ) ) :
			?>
			<a href="<?php echo esc_url( $ld ); ?>"><i class="fa fa-linkedin"></i></a>
			<?php endif;
				if( $ig ) :
			 ?>
				<a href="<?php echo esc_url( $ig ); ?>"><i class="fa fa-instagram"></i></a>
			<?php endif;
				if( $be ) :
			 ?>
				<a href="<?php echo esc_url( $be ); ?>"><i class="fa fa-behance"></i></a>
			<?php endif; ?>
		</div>

	<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_social_media_share


