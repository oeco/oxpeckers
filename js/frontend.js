(function($) {

	$(document).ready(function() {

		$(window).resize(fixWidth).resize();

		function fixWidth() {
			if($(window).width() >= 720) {
				$('.latestnews, .single-post .content, .content-container').css({
					width: $('.main-content').width() - $('#sidebar').width() - 60 - 20,
					float: 'left'
				});
			} else {
				$('.latestnews, .single-post .content, .content-container').css({
					width: 'auto',
					float: 'none'
				});
			}
		}

	});

})(jQuery);