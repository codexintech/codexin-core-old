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
		'cx_team'

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


// Custom function for retrieving page URL using kc_parse_link function
function retrieve_url ( $href ) {

	$href	= ( '||' === $href ) ? '' : $href;
	$href	= kc_parse_link($href);
	$a_href = $href['url'];
	return $a_href;

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
	   			'description'  			=> ''
	   ), $atts));

	   $result = '';
	   ob_start(); ?>

				<div class="text-center">
					<h3 class="primary-title"><?php echo esc_html( $title ); ?></h3>
					<h2 class="secondary-title"><?php echo esc_html( $subtitle ); ?></h2>
					<?php if( $description_toggle == 'yes' ): ?>
					<div class="col-md-10 col-md-offset-1">
						<p><?php printf('%s', $description ); ?></p>		
					</div>
					<?php endif; ?>
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
	   			'img'	 			=> '',
	   			'img_alt'		 	=> '',
	   			'hover_text'  		=> '',
	   			'icon_toggle'  		=> '',
	   			'hover_icon'  		=> '',
	   			'href'		  		=> ''
		), $atts));

		$result = '';

		$retrive_img_url = retrieve_img_src( $img, 'about-mini-image' );

		$retrieve_link = retrieve_url( $href );

	   ob_start(); ?>

				<div class="img-thumb">
					<a href="<?php echo esc_url($retrieve_link); ?>">
						<img src="<?php echo $retrive_img_url; ?>" alt="<?php echo $img_alt; ?>" />
						<div class="single-content-wrapper">
							<div class="single-content">

								<?php if( $icon_toggle == 'yes' ): ?>
								<i class="<?php echo esc_attr( $hover_icon ); ?>"></i>
								<?php endif; ?>
								
								<p><?php echo esc_html( $hover_text ); ?></p>
							</div>
						</div>
					</a>
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
	   		'bg_color'    => '',
			'icon_toggle' => '',
			'icon'        => '',
			'icon_color'  => '',
			'count_up'    => '',
			'count_color' => '',
			'txt' 		  => '',
			'txt_color'   => ''

	   ), $atts));

	   $result = '';
	   ob_start(); 
		?>

		<div class="project" style="background: <?php echo $bg_color; ?>">

			<?php if( $icon_toggle == 'yes' ): ?>
			<i class="fa <?php echo esc_attr( $icon ); ?>" style="color: <?php echo $icon_color; ?>"></i>
			<?php endif; ?>

			<span class="counter" style="color: <?php echo $count_color; ?>"><?php echo esc_html($count_up ); ?></span>
			<p style="color: <?php echo $txt_color; ?>"><?php echo esc_html( $txt ); ?></p>
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
	   		'icon'    	  	=> '',
			'icon_color'  	=> '',
			'service_title'	=> '',
			'title_color'  	=> '',
			'service_desc' 	=> '',

	   ), $atts));

	   $result = '';
	   ob_start(); 
		?>

		<div class="single-service">
			<div class="media">
				<div class="media-left">
					<i class="<?php echo esc_attr( $icon ); ?>" style="color: <?php echo $icon_color; ?>"></i>
				</div>
				<div class="media-body">
				<h4 class="media-heading" style="color: <?php echo $title_color; ?>"><?php echo esc_html( $service_title ); ?></h4>
				<p><?php printf( '%s', $service_desc ) ; ?></p>
				</div>
			</div>
		</div>

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
			'title_color'  	=> '',
			'info_desc' 	=> '',
			'info_image'	=> '',
			'img_alt'		=> '',
			'info_button_text' => '',
			'href'			=> ''

	   ), $atts));

	   $result = '';

	   $retrive_img_url = retrieve_img_src( $info_image, 'info-image' );

	   $retrieve_link = retrieve_url( $href );

	   ob_start(); 
		?>
		<div class="col-sm-12">
			<div class="contest-wrapper">
				<img src="<?php echo esc_url( $retrive_img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive">
				<div class="content-mask">	
					<h2 style="color: <?php echo $title_color; ?>"><?php echo esc_html( $info_title, 'codexin' ); ?></h2>
					<p> <?php printf('%s', $info_desc ); ?> </p>
					<a href="<?php echo esc_url( $retrieve_link ); ?>"><?php echo esc_html( $info_button_text ); ?></a>
				</div>
			</div>
		</div>

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
*  Codexin Testimonial Shortcode
*
*/
function cx_testimonial_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(

	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		
			 <div id="quote" class="quote">
			 	<div class="container">
			 		<div class="row">
			 			<div class="col-xs-12">
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
			 			</div><!--/.col-xs-12-->
			 		</div><!--/.row-->
			 	</div><!--/container-->
			 </div>  <!-- end of quote -->

		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_testiomonial




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
			<div class="container">
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
			</div><!--/#container-->
		</section>

		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_team
