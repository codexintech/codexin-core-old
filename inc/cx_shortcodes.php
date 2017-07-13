<?php 

add_action('init', 'codexin_shortcodes');

function codexin_shortcodes() {

	$shortcodes = array(
		'cx_section_heading',
		'cx_about_box',
		'cx_animated_counter',

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
					<h3 class="primary-title"><?php echo $title; ?></h3>
					<h2 class="secondary-title"><?php echo $subtitle; ?></h2>
					<?php if( $description_toggle == 'yes' ): ?>
					<div class="col-md-10 col-md-offset-1">
						<p><?php echo $description; ?></p>		
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
								<i class="<?php echo $hover_icon; ?>"></i>
								<?php endif; ?>
								
								<p><?php echo $hover_text; ?></p>
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
			<i class="fa <?php echo $icon; ?>" style="color: <?php echo $icon_color; ?>"></i>
			<?php endif; ?>

			<span class="counter" style="color: <?php echo $count_color; ?>"><?php echo $count_up; ?></span>
			<p style="color: <?php echo $txt_color; ?>"><?php echo $txt; ?></p>
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
					<i class="<?php echo $icon; ?>" style="color: <?php echo $icon_color; ?>"></i>
				</div>
				<div class="media-body">
				<h4 class="media-heading" style="color: <?php echo $title_color; ?>"><?php echo $service_title; ?></h4>
				<p><?php echo $service_desc; ?></p>
				</div>
			</div>
		</div>

		<?php
		$result .= ob_get_clean();
		return $result;
}