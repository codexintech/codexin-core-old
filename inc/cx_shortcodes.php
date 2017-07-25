<?php 

add_action('init', 'codexin_shortcodes');

function codexin_shortcodes() {

	$shortcodes = array(
		'cx_section_heading',
		'cx_about_box',
		'cx_animated_counter',
		'cx_service_box',
		'cx_information_box',
		'cx_events',

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
				<img src="<?php echo $retrive_img_url; ?>" alt="" class="img-responsive">
				<div class="content-mask">	
					<h2 style="color: <?php echo $title_color; ?>"><?php echo esc_html( $info_title ); ?></h2>
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


function cx_events_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
			'event_title'	=> '',
			'title_color'  	=> '',
			'event_icon'	=> '',
			'icon_color'	=> '',
			'event_desc' 	=> ''

	   ), $atts));

	   $result = '';

	   ob_start(); 
		?>
		<div class="col-sm-12">
			<div class="events-description">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

					<div class="panel panel-default">
						<div class="panel-heading active" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="<?php echo $event_icon; ?>"></i> <?php echo $event_title; ?>
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<p> <?php echo $event_desc; ?> </p>
							</div>
						</div>
					</div><!--/.panel- panel-defult-->
					
				</div><!--/.panel-group-->
			</div>  <!-- end of events description -->
		</div>  <!-- end of col -->

		<?php
		$result .= ob_get_clean();
		return $result;

} //End cx_events