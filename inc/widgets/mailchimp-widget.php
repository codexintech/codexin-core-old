<?php


/*
	========================================
		CODEXIN MAILCHIMP WIDGET CLASS
	========================================
*/


// Including Mailchimp API.
if(!class_exists('MCAPI')){
    require_once ( CODEXIN_CORE_WDGT_DIR.'/mailchimp/mcapi.class.php' );
}


class Codexin_Mailchimp_Widget extends WP_Widget {
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'codexin-mailchimp-widget',
			'description' => esc_html__('MailChimp Newsletter Subscription', 'codexin'),
		);
		parent::__construct( 'cx_newsletter_subscriber', esc_html__('Codexin: MailChimp Widget', 'codexin'), $widget_ops );

        // Fetching data from options page
        $this->options = get_option( 'codexin_options_mailchimp_opt' );

		// Enquequeing scripts
		$this -> codexin_mc_enqueque();

		// Register actions using add_actions() custom function.
		$this -> codexin_mc_add_actions();
	
	}

    // Enquequeing scripts
	public function codexin_mc_enqueque() {

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));

	}

	// Enquequeing scripts and localize for js
    public function enqueue_scripts() {

        wp_enqueue_script( 'codexin-mailchimp-script', CODEXIN_CORE_ASSET_DIR . '/js/mailchimp.js', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'codexin-mailchimp-script', 'ajaxMailChimp', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ) );

    }

    // Adding ajax for frontend
	public function codexin_mc_add_actions() {

        add_action( 'wp_ajax_codexin_ajax_mc', array( $this, 'codexin_ajax_mc_cb') );
        add_action( 'wp_ajax_nopriv_codexin_ajax_mc', array( $this, 'codexin_ajax_mc_cb') );

	}
	
	//back-end display of widget
	public function form( $instance ) {

		$title 		= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__('Newsletter Subscription', 'codexin') );
		$desc 		= ( !empty( $instance[ 'desc' ] ) ? $instance[ 'desc' ] : '' );
		$list 		= ( !empty( $instance[ 'list' ] ) ? $instance[ 'list' ] : '' );
		$opt_in 	= ( !empty( $instance[ 'opt_in' ] ) ? $instance[ 'opt_in' ] : '' );
		$fst_name 	= ( !empty( $instance[ 'fst_name' ] ) ? $instance[ 'fst_name' ] : '' );
		$lst_name 	= ( !empty( $instance[ 'lst_name' ] ) ? $instance[ 'lst_name' ] : '' );
		$fname_ph 	= ( !empty( $instance[ 'fname_ph' ] ) ? $instance[ 'fname_ph' ] : '' );
		$lname_ph 	= ( !empty( $instance[ 'lname_ph' ] ) ? $instance[ 'lname_ph' ] : '' );
		$email_ph 	= ( !empty( $instance[ 'email_ph' ] ) ? $instance[ 'email_ph' ] : '' );
		$submit_txt	= ( !empty( $instance[ 'submit_txt' ] ) ? $instance[ 'submit_txt' ] : '' );

		if ( empty ( $this->options['mc_api'] ) ):
			echo '<p>'. esc_html__('In Order To Use This Widget Please Fill Up The Mailchimp API In The "Mailchimp Settings" Section of ', 'codexin') .'<strong><a href="'. esc_url(admin_url().'admin.php?page=codexin-options&action=mailchimp_opt') .'" target="_blank">'. esc_html('Codexin Core,', 'codexin') .'</a></strong> '. esc_html__( ' And Refresh This Page.', 'codexin' ) .'</p>';
		else:

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('desc') ); ?>"><?php echo esc_html__('Description (Optional):', 'codexin'); ?></label>
			<textarea class="widefat" rows="5" id="<?php echo esc_attr( $this->get_field_id('desc') ); ?>" name="<?php echo esc_attr( $this->get_field_name('desc') ); ?>"><?php echo esc_html( $desc ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('list') ); ?>"><?php echo esc_html__('Choose Email Lists:', 'codexin'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('list') ); ?>" id="<?php echo esc_attr( $this->get_field_id('list') ); ?>" class="widefat">
				<?php

		        if ( isset ( $this->options['mc_api'] ) && !empty ( $this->options['mc_api'] ) ) {
		            $mcapi = new MCAPI($this->options['mc_api']);
		            $lists = $mcapi->lists();
		            if($lists['data']){
		                foreach ($lists['data'] as $mc_list) {
		                    $mc_lists[$mc_list['id']] = $mc_list['name'];
		                }
		            }

					foreach ($mc_lists as $opt => $value) {
						echo '<option value="' . $opt . '" id="' . $opt . '"', $list == $opt ? ' selected="selected"' : '', '>', ucfirst( $value ), '</option>';
					}
				} else {
					echo '<option id="no-list">' . esc_html__('No MailChimp Lists Found', 'codexin') . '</option>';
				}
				?>
			</select>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $opt_in, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'opt_in' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'opt_in' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'opt_in' ) ); ?>"><?php echo esc_html__('Enable Double Opt-In?', 'codexin'); ?></label>
		    <br><small><?php echo esc_html__('(Requires Users to Confirm Their Subscription Through Email)', 'codexin') ?></small></p>
		</p>

		<p style="margin-bottom: 10px; margin-top: 20px;"><?php echo esc_html__('Choose from the following fields to add in the form. Email field will be visible by default. The first field and second field is your MailChimp form field labels', 'codexin'); ?></p>

		<p style="width: 33%; float:left; margin-top: 5px;">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $fst_name, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'fst_name' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'fst_name' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'fst_name' ) ); ?>"><?php echo esc_html__('First Field', 'codexin'); ?></label>
		</p>

		<p style="width: 33%; float:left; margin-top: 5px;">
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $lst_name, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'lst_name' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'lst_name' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'lst_name' ) ); ?>"><?php echo esc_html__('Last Field', 'codexin'); ?></label>
		</p>


		<hr style="clear: both; border: 0;">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fname_ph' ) ); ?>"><?php echo esc_html__('First Field Placeholder Text :', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fname_ph' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fname_ph' ) ); ?>" value="<?php echo esc_attr( $fname_ph ); ?>" placeholder="<?php echo esc_html__('Ex: First Name', 'codexin') ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'lname_ph' ) ); ?>"><?php echo esc_html__('Last Field Placeholder Text:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'lname_ph' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lname_ph' ) ); ?>" value="<?php echo esc_attr( $lname_ph ); ?>" placeholder="<?php echo esc_html__('Ex: Last Name', 'codexin') ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email_ph' ) ); ?>"><?php echo esc_html__('Email Placeholder Text:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_ph' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email_ph' ) ); ?>" value="<?php echo esc_attr( $email_ph ); ?>" placeholder="<?php echo esc_html__('Ex: Email Address', 'codexin') ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'submit_txt' ) ); ?>"><?php echo esc_html__('Submit Button Text:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'submit_txt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'submit_txt' ) ); ?>" value="<?php echo esc_attr( $submit_txt ); ?>" placeholder="<?php echo esc_html__('Ex: Subscribe', 'codexin') ?>">
		</p>

<?php
		endif;
		
	}

	// update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] 		= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'desc' ] 		= ( !empty( $new_instance[ 'desc' ] ) ? strip_tags( $new_instance[ 'desc' ] ) : '' );
		$instance[ 'list' ] 		= strip_tags( $new_instance[ 'list' ] );
		$instance[ 'opt_in' ] 		= strip_tags( $new_instance[ 'opt_in' ] );
		$instance[ 'fst_name' ] 	= strip_tags( $new_instance[ 'fst_name' ] );
		$instance[ 'lst_name' ] 	= strip_tags( $new_instance[ 'lst_name' ] );
		$instance[ 'fname_ph' ] 	= ( !empty( $new_instance[ 'fname_ph' ] ) ? strip_tags( $new_instance[ 'fname_ph' ] ) : '' );
		$instance[ 'lname_ph' ] 	= ( !empty( $new_instance[ 'lname_ph' ] ) ? strip_tags( $new_instance[ 'lname_ph' ] ) : '' );
		$instance[ 'email_ph' ] 	= ( !empty( $new_instance[ 'email_ph' ] ) ? strip_tags( $new_instance[ 'email_ph' ] ) : '' );
		$instance[ 'submit_txt' ] 	= ( !empty( $new_instance[ 'submit_txt' ] ) ? strip_tags( $new_instance[ 'submit_txt' ] ) : '' );
		
		return $instance;
		
	}

	//front-end display of widget
	public function widget( $args, $instance ) {
		
		$desc 		=  $instance[ 'desc' ];
		$list 		=  $instance[ 'list' ];
		$opt_in 	=  $instance[ 'opt_in' ];
		$fst_name 	=  $instance[ 'fst_name' ];
		$lst_name 	=  $instance[ 'lst_name' ];
		$fname_ph 	=  ( !empty( $instance[ 'fname_ph' ] ) ? $instance[ 'fname_ph' ] : '' );
		$lname_ph 	=  ( !empty( $instance[ 'lname_ph' ] ) ? $instance[ 'lname_ph' ] : '' );
		$email_ph 	=  ( !empty( $instance[ 'email_ph' ] ) ? $instance[ 'email_ph' ] : esc_html__( 'Email Address', 'codexin' ) );
		$submit_txt	=  ( !empty( $instance[ 'submit_txt' ] ) ? $instance[ 'submit_txt' ] : esc_html__( 'Subscribe', 'codexin' ) );;
		
		printf( '%s', $args[ 'before_widget' ] );

		if( !empty( $instance[ 'title' ] ) ):
			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);
			
		endif;

	        if ( isset ( $this->options['mc_api'] ) && !empty ( $this->options['mc_api'] ) ) {

	    	if( 'on' == $instance[ 'opt_in' ] ) {
	        	$msg_success = ( !empty( $this->options['mcd_success']) ? $this->options['mcd_success'] : esc_html__( 'Your sign-up request was successful! Please check your email inbox to confirm. Thank You.', 'codexin' ) );
	        } else {
	        	$msg_success = ( !empty( $this->options['mc_success']) ? $this->options['mc_success'] : esc_html__( 'You have been successfully subscribed. Thank You.', 'codexin' ) );
	        }

		?>
		
		<div class="codexin-mailchimp-wrapper" id="mailchimp-wrapper-<?php echo uniqid(); ?>">
			<?php if( !empty( $desc ) ): ?>
		    <div class="mailchimp-desc"><p><?php echo esc_html( $desc ); ?></p></div>
			<?php endif; ?>

		    <form class="mailchimp-form clearfix" action="#" method="post">
		    	<?php if( 'on' == $instance[ 'fst_name' ] ): ?>
		        <div class="mailchimp-input-fname">
		            <input name="firstname" class="mailchimp-firstname" type="text" placeholder="<?php echo esc_attr( $fname_ph ); ?>">
		        </div>
			    <?php endif; ?>
			    <?php if( 'on' == $instance[ 'lst_name' ] ): ?>
		        <div class="mailchimp-input-lname">
		            <input name="lastname" class="mailchimp-lastname" type="text" placeholder="<?php echo esc_attr( $lname_ph );  ?>">
		        </div>
			    <?php endif; ?>
		        <div class="mailchimp-input-email">
		            <input name="email" class="mailchimp-email" required type="email" placeholder="<?php echo esc_attr( $email_ph ); ?>*">
		        </div>
		        <div class="mailchimp-input-button">
		            <button data-loading="<?php echo esc_attr__('Loading', 'codexin'); ?>" data-text="<?php echo esc_attr( $submit_txt ); ?>" class="mailchimp-submit" type="submit"><?php echo esc_html( $submit_txt ); ?></button>
		        </div>
		        <input type="hidden" name="action" value="signup">
		        <input type="hidden" name="list_id" value="<?php echo esc_attr( $list ); ?>">
		        <input type="hidden" name="opt_in" value="<?php echo esc_attr($opt_in); ?>">
		        <div class="mailchimp-success"><?php echo $msg_success; ?></div>
		        <div class="mailchimp-error"></div>
		    </form>
		</div>


	<?php

		printf( '%s', $args[ 'after_widget' ] );

		} else {
			echo '<p class="error">'.__("No Valid MailChimp API Key found. Please Make Sure You Have Entered a Valid MailChimp API Key.", 'codexin').'</p>';
		}

	}

	// Mailchimp Ajax Callback
	public function codexin_ajax_mc_cb() {

        $output = array( 'error'=> 1, 'msg' => '');
        $error = '';

        $email 		= strip_tags($_POST['email']);
        $firstname 	= isset($_POST['firstname']) ? strip_tags($_POST['firstname']) : '';
        $lastname 	= isset($_POST['lastname']) ? strip_tags($_POST['lastname']) : '';

        if(strlen(trim($firstname)) <= 0) {
            $firstname = '';
        }

        if(strlen(trim($lastname)) <= 0) {
            $lastname = '';
        }

        $merge_vars['FNAME'] = $merge_vars['MERGE1'] = $firstname;
        $merge_vars['LNAME'] = $merge_vars['MERGE2'] = $lastname;


        if (!$email) {
            $error = esc_html__('Email address is required.', 'codexin');
        }elseif(!is_email($email)){
            $error = esc_html__('Email address seems invalid.', 'codexin');
        }

        if($error) {
            $output['msg'] = $error;
        } else {
            if ( isset ( $this->options['mc_api'] ) && !empty ( $this->options['mc_api'] ) ) {
                $mcapi = new MCAPI($this->options['mc_api']);
                $opt_in = in_array($_POST['opt_in'], array('1', 'true', 'y', 'yes', 'on'));

                $mcapi->listSubscribe($_POST['list_id'], $email, $merge_vars, 'html', $opt_in);
                $output['mcapi'] = $mcapi;

                if($mcapi->errorCode) {
                    $output['msg'] = $mcapi->errorMessage;
                } else {
                    $output['error'] = 0;
                }
            }
        }

        echo json_encode($output);
        die();

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Mailchimp_Widget' );
} );
