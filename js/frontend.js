(function($) {

	$(document).ready(function() {

		$(window).resize(fixWidth).resize();

		function fixWidth() {
			$('.latestnews, .single-post .content').css({
				width: $('.main-content').width() - $('#sidebar').width() - 60 - 20
			});
		}

	});

})(jQuery);