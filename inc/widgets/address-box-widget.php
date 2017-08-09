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
			'classname' => 'codexin-address-box',
			'description' => esc_html__('Display Address', 'codexin'),
		);
		parent::__construct( 'cx_address_box', esc_html__('Codexin: Address Box', 'codexin'), $widget_ops );
		
	}
	
	//back-end display of widget
	public function form( $instance ) {
		$company_name 	= ( !empty( $instance[ 'company_name' ] ) ? $instance[ 'company_name' ]: '' );
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

		$instance[ 'company_name' ]	= ( !empty( $new_instance[ 'company_name' ] ) ? strip_tags( $new_instance[ 'company_name' ] ) : '' );
		$instance[ 'small_description' ]	= ( !empty( $new_instance[ 'small_description' ] ) ? strip_tags( $new_instance[ 'small_description' ] ) : '' );
		$instance[ 'street_address' ]	= ( !empty( $new_instance[ 'street_address' ] ) ? strip_tags( $new_instance[ 'street_address' ] ) : '' );
		$instance[ 'locality_address' ]	= ( !empty( $new_instance[ 'locality_address' ] ) ? strip_tags( $new_instance[ 'locality_address' ] ) : '' );
		$instance[ 'regional_address' ]	= ( !empty( $new_instance[ 'regional_address' ] ) ? strip_tags( $new_instance[ 'regional_address' ] ) : '' );
		$instance[ 'postal_code' ]	= ( !empty( $new_instance[ 'postal_code' ] ) ? strip_tags( $new_instance[ 'postal_code' ] ) : '' );
		$instance[ 'phone_no' ]	= ( !empty( $new_instance[ 'phone_no' ] ) ? strip_tags( $new_instance[ 'phone_no' ] ) : '' );
		$instance[ 'fax_no' ]	= ( !empty( $new_instance[ 'fax_no' ] ) ? strip_tags( $new_instance[ 'fax_no' ] ) : '' );
		$instance[ 'email' ]	= ( !empty( $new_instance[ 'email' ] ) ? strip_tags( $new_instance[ 'email' ] ) : '' );
		$instance[ 'company_website' ]	= ( !empty( $new_instance[ 'company_website' ] ) ? strip_tags( $new_instance[ 'company_website' ] ) : '' );
		
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

		
		printf( '%s', $args[ 'before_widget' ] ); ?>
		
		<div itemscope itemtype="http://schema.org/LocalBusiness">
		
			<?php if( !empty( $instance[ 'company_name' ] ) ):
			
			printf( '%s<span itemprop="name">' . apply_filters( 'widget_title', $instance[ 'company_name' ] ) . '</span>%s', $args[ 'before_title' ], $args[ 'after_title' ]);
			
		endif; ?>
			<p><span itemprop="description"><?php if( !empty($small_description) ): echo esc_html( $small_description ); endif; ?></span></p>
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<p>
					<span itemprop="streetAddress"><?php if( !empty($street_address) ): echo esc_html( $street_address ); endif; ?></span>
					<span itemprop="addressLocality"><?php if( !empty($locality_address) ): echo esc_html( $locality_address ); endif; ?></span>,
				</p>
				<p><span itemprop="addressRegion"><?php if( !empty($regional_address) ): echo esc_html( $regional_address ); endif; ?></span> - 
				<span itemprop="postalCode"><?php if( !empty($postal_code) ): echo esc_html( $postal_code ); endif; ?></span></p>

			</div>
			<p>Phone: <span itemprop="telephone"><?php if( !empty($phone_no) ): echo esc_html__( $phone_no ); endif; ?></span></p>
			<p>Fax: <span itemprop="faxNumber"><?php if( !empty($fax_no) ): echo esc_html__( $fax_no ); endif; ?></span></p>
			<p>E-mail: <a href="mailto:test@example.com" itemprop="email"><?php if( !empty($email) ): echo esc_html__( $email ); endif; ?></a></p>
			<p>Home page: <a href="<?php if( !empty($company_website) ): echo esc_url( $company_website ); endif; ?>" itemprop="url"><?php echo esc_html($company_website); ?></a></p>
		</div>
		
		
		<?php
		printf( '%s', $args[ 'after_widget' ] );

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Address_Box' );
} );
