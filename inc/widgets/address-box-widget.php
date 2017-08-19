<?php

/*
	============================================
		CODEXIN ADDRESS BOX WIDGET CLASS
	============================================
*/

class Codexin_Address_Box extends WP_Widget {
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' 	=> 'codexin-address-box',
			'description' 	=> esc_html__('Display Address', 'codexin'),
		);
		parent::__construct( 'cx_address_box', esc_html__('Codexin: Address Box', 'codexin'), $widget_ops );
		
	}
	
	//back-end display of widget
	public function form( $instance ) {

		$title 				= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__('Address Box', 'codexin') );
		$company_name 		= ( !empty( $instance[ 'company_name' ] ) ? $instance[ 'company_name' ]: '' );
		$small_description 	= ( !empty( $instance[ 'small_description' ] ) ? $instance[ 'small_description' ]: '' );
		$street_address 	= ( !empty( $instance[ 'street_address' ] ) ? $instance[ 'street_address' ] : '' );
		$locality_address 	= ( !empty( $instance[ 'locality_address' ] ) ? $instance[ 'locality_address' ] : '' );
		$regional_address 	= ( !empty( $instance[ 'regional_address' ] ) ? $instance[ 'regional_address' ] : '' );
		$postal_code 		= ( !empty( $instance[ 'postal_code' ] ) ? $instance[ 'postal_code' ] : '' );
		$phone_no 			= ( !empty( $instance[ 'phone_no' ] ) ? $instance[ 'phone_no' ] : '' );
		$fax_no 			= ( !empty( $instance[ 'fax_no' ] ) ? $instance[ 'fax_no' ] : '' );
		$email 				= ( !empty( $instance[ 'email' ] ) ? $instance[ 'email' ] : '' );
		$company_website 	= ( !empty( $instance[ 'company_website' ] ) ? $instance[ 'company_website' ] : '' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'company_name' ) ); ?>"><?php echo esc_html__('Company Name:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'company_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'company_name' ) ); ?>" value="<?php echo esc_attr( $company_name ); ?>" placeholder="Insert Company Name">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'small_description' ) ); ?>"><?php echo esc_html__('Small Description: ', 'codexin') ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'small_description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'small_description' ) ); ?>" value="<?php echo esc_attr( $small_description ); ?>" rows="3" placeholder="Small Description Here"> <?php echo esc_attr( $small_description ); ?> </textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'street_address' ) ); ?>"><?php echo esc_html__('Street Address: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'street_address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'street_address' ) ); ?>" value="<?php echo esc_attr( $street_address ); ?>" placeholder="Ex: 3102 Highway 98">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'locality_address' ) ); ?>"><?php echo esc_html__('Locality Address: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'locality_address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'locality_address' ) ); ?>" value="<?php echo esc_attr( $locality_address ); ?>"
			 placeholder="Ex: Mexico Beach">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'regional_address' ) ); ?>"><?php echo esc_html__('State: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'regional_address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'regional_address' ) ); ?>" value="<?php echo esc_attr( $regional_address ); ?>" placeholder="Ex: FL">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postal_code' ) ); ?>"><?php echo esc_html__('Postal Code: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postal_code' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postal_code' ) ); ?>" value="<?php echo esc_attr( $postal_code ); ?>" placeholder="Ex: 98052">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone_no' ) ); ?>"><?php echo esc_html__('Phone No: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone_no' ) ); ?>" value="<?php echo esc_attr( $phone_no ); ?>" placeholder="Ex: 850-648-4200">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax_no' ) ); ?>"><?php echo esc_html__('Fax No: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fax_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax_no' ) ); ?>" value="<?php echo esc_attr( $fax_no ); ?>" placeholder="Ex: ( 33 1) 42 68 53 01">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php echo esc_html__('Email: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" value="<?php echo esc_attr( $email ); ?>" placeholder="Ex: test@example.com">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'company_website' ) ); ?>"><?php echo esc_html__('Company Website: ', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'company_website' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'company_website' ) ); ?>" value="<?php echo esc_attr( $company_website ); ?>" placeholder="Ex: http://www.janedoe.com">
		</p>

		

<?php
		
	}

	// update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance[ 'title' ] 				= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'company_name' ]			= ( !empty( $new_instance[ 'company_name' ] ) ? strip_tags( $new_instance[ 'company_name' ] ) : '' );
		$instance[ 'small_description' ]	= ( !empty( $new_instance[ 'small_description' ] ) ? strip_tags( $new_instance[ 'small_description' ] ) : '' );
		$instance[ 'street_address' ]		= ( !empty( $new_instance[ 'street_address' ] ) ? strip_tags( $new_instance[ 'street_address' ] ) : '' );
		$instance[ 'locality_address' ]		= ( !empty( $new_instance[ 'locality_address' ] ) ? strip_tags( $new_instance[ 'locality_address' ] ) : '' );
		$instance[ 'regional_address' ]		= ( !empty( $new_instance[ 'regional_address' ] ) ? strip_tags( $new_instance[ 'regional_address' ] ) : '' );
		$instance[ 'postal_code' ]			= ( !empty( $new_instance[ 'postal_code' ] ) ? strip_tags( $new_instance[ 'postal_code' ] ) : '' );
		$instance[ 'phone_no' ]				= ( !empty( $new_instance[ 'phone_no' ] ) ? strip_tags( $new_instance[ 'phone_no' ] ) : '' );
		$instance[ 'fax_no' ]				= ( !empty( $new_instance[ 'fax_no' ] ) ? strip_tags( $new_instance[ 'fax_no' ] ) : '' );
		$instance[ 'email' ]				= ( !empty( $new_instance[ 'email' ] ) ? strip_tags( $new_instance[ 'email' ] ) : '' );
		$instance[ 'company_website' ]		= ( !empty( $new_instance[ 'company_website' ] ) ? strip_tags( $new_instance[ 'company_website' ] ) : '' );
		
		return $instance;
		
	}

	//front-end display of widget
	public function widget( $args, $instance ) {

		$company_name 		= $instance[ 'company_name' ];
		$small_description 	= $instance[ 'small_description' ];
		$street_address		= $instance[ 'street_address' ];
		$locality_address 	= $instance[ 'locality_address' ];
		$regional_address 	= $instance[ 'regional_address' ];
		$postal_code 		= $instance[ 'postal_code' ];
		$phone_no 			= $instance[ 'phone_no' ];
		$fax_no 			= $instance[ 'fax_no' ];
		$email 				= $instance[ 'email' ];
		$company_website 	= $instance[ 'company_website' ];

		
		printf( '%s', $args[ 'before_widget' ] ); 

		if( !empty( $instance[ 'title' ] ) ):
			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);
			
		endif;

		?>
		
		<div itemscope itemtype="http://schema.org/LocalBusiness">
			<p class="cx-company-name"><span itemprop="name"><?php if( !empty($company_name) ): echo esc_html( $company_name ); endif; ?></span></p>

			<?php if( !empty( $small_description ) ): ?>
			<p class="cx-company-description"><span itemprop="description"><?php echo esc_html( $small_description ); ?></span></p>
			<?php endif; ?>

			<div class="cx-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<p class="cx-street-address"><span itemprop="streetAddress"><?php if( !empty($street_address) ): echo esc_html( $street_address ); endif; ?></span></p>
					
				<p class="cx-locality">
					<span itemprop="addressLocality"><?php if( !empty($locality_address) ): echo esc_html( $locality_address ); endif; ?></span>,&nbsp;
					<span itemprop="addressRegion"><?php if( !empty($regional_address) ): echo esc_html( $regional_address ); endif; ?></span>
					<span itemprop="postalCode">&nbsp;<?php if( !empty($postal_code) ): echo esc_html( $postal_code ); endif; ?></span>
				</p>

			</div>
			<p class="cx-phone"><?php echo esc_html__( 'Phone: ', 'codexin' ) ?><span itemprop="telephone"><?php if( !empty($phone_no) ): echo esc_html( $phone_no ); endif; ?></span></p>

			<?php if( !empty( $fax_no ) ): ?>
			<p class="cx-fax"><?php echo esc_html__( 'Fax: ', 'codexin' ) ?><span itemprop="faxNumber"><?php echo esc_html( $fax_no ); ?></span></p>
			<?php endif; ?>

			<p class="cx-email"><?php echo esc_html__( 'E-mail: ', 'codexin' ); ?><a href="mailto:test@example.com" itemprop="email"><?php if( !empty($email) ): echo esc_html( $email ); endif; ?></a></p>

			<?php if( !empty( $company_website ) ): ?>
			<p class="cx-website"><?php echo esc_html__( 'Website: ', 'codexin' ); ?><a href="<?php echo esc_url( $company_website ); ?>" itemprop="url"><?php echo esc_html($company_website); ?></a></p>
			<?php endif; ?>

		</div>
		
		
		<?php
		printf( '%s', $args[ 'after_widget' ] );

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Address_Box' );
} );
