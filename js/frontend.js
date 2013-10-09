(function($) {

	$(document).ready(function() {

		$(window).resize(fixWidth).resize();

		function fixWidth() {
			$('.latestnews, .single-post .content, .content-container').css({
				width: $('.main-content').width() - $('#sidebar').width() - 60 - 20
			});
		}

	});

})(jQuery);