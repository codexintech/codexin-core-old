<?php


/*
    ==================================
        CODEXIN CLIENT SHORTCODE
    ==================================
*/

// Registering Codexin Client Shortcode
function cx_client_shortcode( $atts, $content = null ) {
   extract(shortcode_atts(array(
   		'number_of_clients'	=> '',
   		'number_of_slides'	=> '',
   		'continous_p'	    => '',
   		'link_client'	    => '',
   		'class'	    	    => '',
   		'arrow'         	=> '',
   		'dots'         	  	=> '',
   		'play'         	    => '',
   		'speed'             => '',
   		'pl_speed'     	  	=> ''
   ), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-clients-wrapper';

	// Retrieving user define classes
	$classes = array( 'cx-client-carousel-01' );
	(!empty($class)) ? $classes[] = $class : '';

	ob_start(); 

	// Passing values to javascript
	$codeopt = '';
	$num_slide 		= ( !empty( $number_of_slides ) ) ? $number_of_slides : '6';
	$cont_p 		= ( $continous_p ) ? true : 0;
	$slick_arrow 	= ( $arrow ) ? true : 0;
	$en_dots 		= ( $dots ) ? true : 0;
	$auto_play 		= ( $play ) ? true : 0;
	$atp_speed 		= ( !empty( $speed ) ) ? $speed : '2000';
	$con_speed 		= ( !empty( $pl_speed ) ) ? $pl_speed : '2500';
	$codeopt .= '
	<script type="text/javascript">
		var logo_slide = "' . $num_slide . '"; 
		var show_arrow = ' . $slick_arrow . '; 
		var show_dot = ' . $en_dots . '; 
		var aut_play = ' . $auto_play . '; 
		var ap_speed = "' . $atp_speed . '"; 
		var con_play = "' . $cont_p . '"; 
		var play_speed = ' . $con_speed . '; 

	</script>';
	echo $codeopt;
	?>

	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php 
			//start wp query..
			$args = array(
				'post_type'			=> 'clients',
				'order'				=> 'DESC',
				'posts_per_page'	=> $number_of_clients
				);
			$data = new WP_Query( $args );
			//Check post
			if( $data->have_posts() ) :
				//startloop here..
				while( $data->have_posts() ) : $data->the_post();
			$client_url = rwmb_meta( 'reveal_clients_surl', 'type=text' );
			// Retrieving Image alt tag
			$image_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();  
			?>
			<div class="item">
				<?php if($link_client): ?>
				<a href="<?php if( ! empty( $client_url ) ) : echo esc_url( $client_url ); endif; ?>" target="_blank">
			  <?php endif; ?>
					<img src="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
				<?php if($link_client): ?>
				</a>
			 <?php endif; ?>
			</div>
			<?php
			endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div> <!-- end of cx-client-carousel-01 -->
	</div> <!-- end of cx-clients-wrapper -->
	<div class="clearfix"></div>

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_client


 function cx_client_kc() {

 	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_client' => array(
 					'name' => esc_html__( 'Codexin Clients', 'codexin' ),
 					'description' => esc_html__('Clients Section', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
	                //Only load assets when using this element
 					'assets' => array(
 						'scripts' => array(
 							 'slick-cx-main-script' => CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js',
 							 'slick-cx-user-client-script' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_client-carousel.js',
 							),

      			'styles'	=> array(
      				'slick-cx-main-style'	=> CODEXIN_CORE_ASSET_DIR . '/css/slick.css',
      				),

	                ), //End assets
 					'params' => array(
 						// general params
 						'general'	=> array(
	    					array(
	    						'name'			=> 'number_of_clients',
	    						'label' 		=> esc_html__( 'Number of Clients', 'codexin' ),
	    						'type'			=> 'dropdown',
	    						'description' 	=> esc_html__( 'Choose the number of client logo you want to show', 'codexin' ),
	    						'options'		=> array(
	    							'3'			=> '3',
	    							'6'			=> '6',
	    							'9'			=> '9',
	    							'-1'		=> 'All',
	    						),
	    						'value'			=> '-1',
	    						'admin_label'	=> true
	    					),
	    					array(
	    						'name'			=> 'number_of_slides',
	    						'label' 		=> esc_html__( 'Number of Slides', 'codexin' ),
	    						'type'			=> 'text',
	    						'description' 	=> esc_html__( 'Choose the number of client logo slides you want to show on screen', 'codexin' ),
	    						'value'			=> '6',
	    						'admin_label'	=> true
	    					),

	    					array(
	    						'name'			=> 'continous_p',
	    						'label' 		=> esc_html__( 'Enable Continous Play?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable Continous Autoplay', 'codexin' ),
	    						'type'			=> 'toggle',
	    						'value'			=> 'no',
	    					),


	    					array(
	    						'name'			=> 'arrow',
	    						'label' 		=> esc_html__( 'Show Arrow?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable Navigation Arrow', 'codexin' ),
	    						'type'			=> 'toggle',
								'relation' => array(
									'parent'	=> 'continous_p',
									'hide_when' => 'yes',
								),
	    						'value'			=> 'no',
	    					),

	    					array(
	    						'name'			=> 'dots',
	    						'label' 		=> esc_html__( 'Show Paginations?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable Pagination', 'codexin' ),
	    						'type'			=> 'toggle',
								'relation' => array(
									'parent'	=> 'continous_p',
									'hide_when' => 'yes',
								),
	    						'value'			=> 'no',
	    					),

	    					array(
	    						'name'			=> 'play',
	    						'label' 		=> esc_html__( 'Enable Autoplay?', 'codexin' ),
	    						'description' 	=> esc_html__( 'Choose Enable/Disable AutoPlay', 'codexin' ),
	    						'type'			=> 'toggle',
								'relation' => array(
									'parent'	=> 'continous_p',
									'hide_when' => 'yes',
								),
	    						'value'			=> 'yes',
	    					),


	    					array(
	    						'name'			=> 'pl_speed',
	    						'label' 		=> esc_html__( 'Continous Play Duration', 'codexin' ),
	    						'type'			=> 'text',
								'relation' => array(
									'parent'	=> 'continous_p',
									'show_when' => 'yes',
								),
	    						'description' 	=> esc_html__( 'Insert the duration of continous play speed in milisecond. For example: 2500', 'codexin' ),
	    						'value'			=> '2500',
	    					),

	    					array(
	    						'name'			=> 'speed',
	    						'label' 		=> esc_html__( 'Autoplay Duration', 'codexin' ),
	    						'type'			=> 'text',
								'relation' => array(
									'parent'	=> 'play',
									'show_when' => 'yes',
								),
	    						'description' 	=> esc_html__( 'Choose the duration of autoplay speed in milisecond. For example: 4000', 'codexin' ),
	    						'value'			=> '2000',
	    					),

	    					array(
	    						'name'			=> 'link_client',
	    						'label' 		=> esc_html__( 'Enable Client URL?', 'codexin' ),
	    						'type'			=> 'toggle',
	    						'description' 	=> esc_html__( 'Choose to enable/disable clients URL', 'codexin' ),
	    						'value'			=> 'yes'
	    					),
	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
	    						'type'			=> 'text',
	    						'description' 	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	    					)
 						), //end of general params
						// Animate Params
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						)//End animate
	                ) //End params array
	            ),  // End of elemnt cx_client
			) //end of  array 
		);  //end of kc_add_map....
	} //End if
} // end of cx_team_kc


