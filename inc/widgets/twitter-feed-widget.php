<?php



/*
	============================================
		CODEXIN TWITTER FEED WIDGET CLASS
	============================================
*/


class Codexin_Twitter_Widget extends WP_Widget {

	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'codexin-twitter-widget',
			'description' => esc_html__('Displays Twitter Feeds', 'codexin'),
		);
		parent::__construct( 'cx_twitter_widget', esc_html__('Codexin: Twitter Feed Widget', 'codexin'), $widget_ops );
		
	}

	//back-end display of widget
	public function form( $instance ) {

		echo '<p>'. esc_html__('In Order To Use This Widget Please Fill Up The Twitter API Information In The "Twitter API" Section of ', 'codexin') .'<strong><a href="'. esc_url(admin_url().'admin.php?page=codexin-options&action=twitter_api') .'" target="_blank">'. esc_html('Codexin Core.', 'codexin') .'</a></strong></p>';

		$title 			= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__('Twitter Feed', 'codexin') );
		$count 			= ( !empty( $instance[ 'count' ] ) ? absint( $instance[ 'count' ] ) : esc_html__('3', 'codexin') );
		$tw_profile 	= ( !empty( $instance[ 'tw_profile' ] ) ? $instance[ 'tw_profile' ] : '' );
		$tw_name 		= ( !empty( $instance[ 'tw_name' ] ) ? $instance[ 'tw_name' ] : '' );
		$tw_usr 		= ( !empty( $instance[ 'tw_usr' ] ) ? $instance[ 'tw_usr' ] : '' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__('Title:', 'codexin') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php echo esc_html__('Number of Tweets to Show:', 'codexin') ?></label>
			<input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>">
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $tw_profile, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'tw_profile' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'tw_profile' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'tw_profile' ) ); ?>"><?php echo esc_html__('Display Profile Picture?', 'codexin'); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $tw_name, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'tw_name' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'tw_name' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'tw_name' ) ); ?>"><?php echo esc_html__('Display Full Name?', 'codexin'); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $tw_usr, 'on' ) ); ?> id="<?php echo esc_attr ($this->get_field_id( 'tw_usr' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'tw_usr' ) ); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'tw_usr' ) ); ?>"><?php echo esc_html__('Display User Name?', 'codexin'); ?></label>
		</p>


	<?php
	}

	// update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] 		= ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'count' ] 		= ( !empty( $new_instance[ 'count' ] ) ? absint( strip_tags( $new_instance[ 'count' ] ) ) : 0 );
		$instance[ 'tw_profile' ] 	= strip_tags( $new_instance[ 'tw_profile' ] );
		$instance[ 'tw_name' ] 		= strip_tags( $new_instance[ 'tw_name' ] );
		$instance[ 'tw_usr' ] 		= strip_tags( $new_instance[ 'tw_usr' ] );
		
		
		return $instance;
		
	}

	//front-end display of widget
	public function widget( $args, $instance ) {
				
		printf( '%s', $args[ 'before_widget' ] );
		
		if( !empty( $instance[ 'title' ] ) ):			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);			
		endif;

		$twitter_id 			= get_option( 'codexin_options_twitter_api' )[ 'tw_username' ];
		$access_token 			= get_option( 'codexin_options_twitter_api' )[ 'tw_acc_token' ];
		$access_token_secret 	= get_option( 'codexin_options_twitter_api' )[ 'tw_acc_token_sec' ];
		$consumer_key 			= get_option( 'codexin_options_twitter_api' )[ 'tw_cons_key' ];
		$consumer_secret 		= get_option( 'codexin_options_twitter_api' )[ 'tw_cons_secret' ];
		$count 					= absint( $instance['count'] );
		$tw_name 				= $instance['tw_name'];
		$tw_usr 				= $instance['tw_usr'];
		$tw_profile 			= $instance['tw_profile'];

		if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 
		$transName = 'list_tweets_'.$args['widget_id'];
		$cacheTime = 10;
		delete_transient($transName);
		if(false === ($twitterData = get_transient($transName))) {
		     // require the twitter auth class
		     @require_once 'twitteroauth/twitteroauth.php';
		     $twitterConnection = new TwitterOAuth(
							$consumer_key,			// Consumer Key
							$consumer_secret,   	// Consumer secret
							$access_token,       	// Access token
							$access_token_secret    // Access token secret
							);
		    $twitterData = $twitterConnection->get(
							  'https://api.twitter.com/1.1/statuses/user_timeline.json',
							  array(
							    'screen_name'     => $twitter_id,
							    'count'           => $count,
							    'exclude_replies' => false
							  )
							);
		     if($twitterConnection->http_code != 200)
		     {
		          $twitterData = get_transient($transName);
		     }

		     // Save our new transient.
		     set_transient($transName, $twitterData, 60 * $cacheTime);
		};

		$cx_twitter = get_transient($transName);
		if($cx_twitter && is_array($cx_twitter)) {
		?>
		<div class="twitter-widget">
			<div class="cx-tweets-container" id="twitter_<?php echo $args['widget_id']; ?>">
				<?php foreach($cx_twitter as $cx_tweet): ?>
				<div class="media">
					<?php if( 'on' == $instance[ 'tw_profile' ] ): ?>
					<a href="//twitter.com/<?php echo esc_html( $cx_tweet->user->screen_name ); ?>" class="media-left">
						<img class="media-object" src="<?php echo esc_url( $cx_tweet->user->profile_image_url ); ?>" alt="twitter-user-profile">
					</a>
					<?php endif; ?>
					<div class="media-body">
						<?php if( ('on' == $instance[ 'tw_name' ] ) && ( 'on' == $instance[ 'tw_usr' ] ) ): ?>
						<h4 class="media-heading"><?php echo esc_html( $cx_tweet->user->name ); ?> <a href="//twitter.com/<?php echo esc_html( $cx_tweet->user->screen_name ); ?>" class="twitter-user" target="_blank"><em>@<?php echo esc_html( $cx_tweet->user->screen_name ); ?></em></a></h4>
						<?php elseif( 'on' == $instance[ 'tw_name' ] ): ?>
						<h4 class="media-heading"><?php echo esc_html( $cx_tweet->user->name ); ?></h4>
						<?php elseif( 'on' == $instance[ 'tw_usr' ] ): ?>
						<h4 class="media-heading"><a href="//twitter.com/<?php echo esc_html( $cx_tweet->user->screen_name ); ?>" class="twitter-user" target="_blank"><em>@<?php echo esc_html( $cx_tweet->user->screen_name ); ?></em></a></h4>
						<?php endif; ?>
						<p class="cx-tweet-text">
						<?php
						$latestTweet = $cx_tweet->text;
						$latestTweet = preg_replace('/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="//$1" target="_blank">https://$1</a>&nbsp;', $latestTweet);
						$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="//twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
						$latestTweet = preg_replace('/#(\w+)/', '&nbsp;<a href="//twitter.com/hashtag/$1?src=hash" target="_blank">#$1</a>&nbsp;', $latestTweet);
						echo $latestTweet;
						?>
						</p>
						<?php
						$twitterTime = strtotime($cx_tweet->created_at);
						$cx_time = $this->creation_time($twitterTime);
						?>
						<p><a href="http://twitter.com/<?php echo $cx_tweet->user->screen_name; ?>/statuses/<?php echo $cx_tweet->id_str; ?>" target="_blank"><?php echo $cx_time; ?></a></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php 
		} else {
		echo '<p>' . esc_html__('Error: Please Provide Valid Twitter OAuth Information.', 'codexin') . '</p>';
	}
	} else {
		echo '<p>' . esc_html__('Error: Please Provide Valid Twitter OAuth Information.', 'codexin') . '</p>';
	}
		
		printf( '%s', $args[ 'after_widget' ] );

	}

	public function creation_time($time)
		{
		   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		   $lengths = array("60","60","24","7","4.35","12","10");

		   $now = time();

		       $diff = $now - $time;

		   for($j = 0; $diff >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		       $diff /= $lengths[$j];
		   }

		   $diff = round($diff);

		   if($diff != 1) {
		       $periods[$j].= "s";
		   }

		   return "$diff $periods[$j] ago ";
		}

	}


add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Twitter_Widget' );
} );