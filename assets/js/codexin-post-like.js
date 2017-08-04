(function( $ ) {
	'use strict';
	$(document).on('click', '.cx-button', function() {
		var button = $(this);
		var post_id = button.attr('data-post-id');
		var security = button.attr('data-nonce');
		var iscomment = button.attr('data-iscomment');
		var allbuttons;
		if ( iscomment === '1' ) { /* Comments can have same id */
			allbuttons = $('.cx-comment-button-'+post_id);
		} else {
			allbuttons = $('.cx-button-'+post_id);
		}
		var loader = allbuttons.next('#cx-loader');
		if (post_id !== '') {
			$.ajax({
				type: 'POST',
				url: postLikes.ajaxurl,
				data : {
					action : 'codexin_post_like',
					post_id : post_id,
					nonce : security,
					is_comment : iscomment,
				},
				beforeSend:function(){
					loader.html('&nbsp;<div class="loader">Loading...</div>');
				},	
				success: function(response){
					var icon = response.icon;
					var count = response.count;
					allbuttons.html(icon+count);
					if(response.status === 'unliked') {
						var like_text = postLikes.like;
						allbuttons.prop('title', like_text);
						allbuttons.removeClass('liked');
					} else {
						var unlike_text = postLikes.unlike;
						allbuttons.prop('title', unlike_text);
						allbuttons.addClass('liked');
					}
					loader.empty();					
				}
			});
			
		}
		return false;
	});
})( jQuery );
