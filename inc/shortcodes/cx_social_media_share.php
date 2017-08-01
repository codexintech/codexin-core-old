<?php
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


 function cx_social_media_share_kc() {

 	if (function_exists('kc_add_map')) 
 	{ 
 		kc_add_map(
 			array(
 				'cx_social_media_share' => array(
 					'name' => esc_html__( 'Codexin Social Media', 'codexin' ),
 					'description' => esc_html__('Codexin Social Media', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
 					'params' => array(
 						array(
 							'name' 			=> 'fb',
 							'label' 		=> esc_html__( 'Face Book Link ', 'codexin' ),
 							'type' 			=> 'text',
 							'description'	=> esc_html__( 'Enter Your Face-Book URL Here', 'codexin' ),
 							'admin_label' 	=> false,
 							),

 						array(
 							'name' 			=> 'tw',
 							'label' 		=> esc_html__( 'Twitter Link ', 'codexin' ),
 							'type' 			=> 'text',
 							'description'	=> esc_html__( 'Enter Your Twitter URL Here', 'codexin' ),
 							'admin_label' 	=> false,
 							),

 						array(
 							'name' 			=> 'ld',
 							'label' 		=> esc_html__( 'Linkedin Link ', 'codexin' ),
 							'type' 			=> 'text',
 							'description'	=> esc_html__( 'Enter Your Linkedin URL Here', 'codexin' ),
 							'admin_label' 	=> false,
 							),

 						array(
 							'name' 			=> 'ig',
 							'label' 		=> esc_html__( 'Instagram Link ', 'codexin' ),
 							'type' 			=> 'text',
 							'description'	=> esc_html__( 'Enter Your Instagram URL Here', 'codexin' ),
 							'admin_label' 	=> false,
 							),

 						array(
 							'name' 			=> 'be',
 							'label' 		=> esc_html__( 'Behance Link ', 'codexin' ),
 							'type' 			=> 'text',
 							'description'	=> esc_html__( 'Enter Your Behance URL Here', 'codexin' ),
 							'admin_label' 	=> false,
 							),

 						

	                ) //End params array()..

	            ),  // End of elemnt cx_social_media_share...


			) //end of  array 


		);  //end of kc_add_map....

	} //End if

} // end of cx_team_kc


