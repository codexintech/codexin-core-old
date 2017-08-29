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
   		'link_client'		=> '',
   		'class'				=> '',
   ), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'clients mrg-50';

	// Retrieving user define classes
	$classes = array( 'client' );
	(!empty($class)) ? $classes[] = $class : '';

	ob_start(); 

	// Passing values to javascript
	$codeopt = '';
	$num_slide = ( !empty( $number_of_slides ) ) ? $number_of_slides : '6';
	$codeopt .= '
	<script type="text/javascript">
		var logo_slide = "' . $num_slide . '"; 
	</script>';
	echo $codeopt;
	?>

	<div id="clients-rv2" class="clients mrg-50">
		<div id="client-carousel-rv2" class="">
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
				<a href="<?php if( ! empty( $client_url ) ) : echo esc_url( $client_url ); endif; ?>"><img src="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>"></a>
			</div>
			<?php
			endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
	</div> <!-- end of clients -->
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
 							// 'slick-js' => CODEXIN_CORE_ASSET_DIR . '/js/slick.min.js',
 							'client-carousel-script' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_client-carousel.js',
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


