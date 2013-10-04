(function($) {

	/*
	 * Slider
	 */

	$(document).ready(function() {

		var container = $('.highlight-content');
		var items = container.find('.highlights-list > .slider-item');
		var controllers = container.find('.slider-controllers li');

		if(items.length === 1) {

			items.addClass('active');
			controllers.hide();

		} else {

			var current = items.first();
			var next = current.next('.slider-item');
			var run = setInterval(slide, 8000);
			slide(current);

		}

		function slide(item) {

			if(typeof item == 'undefined')
				item = next;

			// change active controller
			controllers.removeClass('active');
			controllers.filter('[data-sliderid="' + item.data('sliderid') + '"]').addClass('active');

			items.removeClass('active');
			item.addClass('active');

			current = item;

			if(current.is(':last-child')) {
				next = items.first();
			} else {
				next = current.next('.slider-item');
			}

			if(typeof run === 'number') {
				clearInterval(run);
				run = setInterval(slide, 8000);
			}

		}

		// bind controls

		controllers.click(function() {

			var toGo = items.filter('[data-sliderid="' + $(this).data('sliderid') + '"]');

			console.log(toGo);
			console.log(items);

			slide(toGo);

			return false;

		});

	});
		

})(jQuery);