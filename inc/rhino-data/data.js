(function($) {

	var	data = rhino.data,
		rhinoLayer;

	jeo.mapReady(function(map) {

		rhinoLayer = L.featureGroup();

		$.each(data, function(i, m) {

			if(m.latitude && m.longitude) {

				var marker = L.marker([m.latitude, m.longitude]);

				m._marker = marker;

				updateMarker(getTotalByLocation(m), m);

				marker.addTo(rhinoLayer);

			}

		});

		rhinoLayer.addTo(map);

		filter().init();

	});

	function getTotalByLocation(m, years) {

		var total = 0;

		if(typeof years !== 'array' && typeof years !== 'undefined' && years)
			years = [parseInt(years)];

		for(var key in m) {

			var year = parseYear(key);

			if(year) {

				if(!years || typeof years === 'undefined' || years.indexOf(year) !== -1)
					total += parseInt(m[key]);

			}

		}

		return total;

	}

	function getTotalByYear(years) {

		var total = 0;

		_.each(data, function(item, i) {

			total += getTotalByLocation(item, years);

		});

		return total;

	}

	function getYears() {

		years = [];
		for(var key in data[0]) {
			var year = parseYear(key);
			if(year)
				years.push(year);
		}

		return years;

	}

	function parseYear(key) {
		var prefix = 'year_';
		if(key.indexOf(prefix) !== -1) {
			return parseInt(key.replace('year_', ''));
		}
		return false;
	}

	function updateMarker(value, m) {

		var html = markerHtml(value, m);

		m.rhinoIcon = new L.HtmlIcon({
			html: html
		});

		m._marker.setIcon(m.rhinoIcon);

	}

	function markerHtml(value, m) {

		return '<div class="rhino-deaths">' + value + '</div>';

	}

	function filter() {

		var f = {},
			years,
			select,
			container = $('.map .rhino-death-filter'),
			count;

		f.init = function() {

			select = $('<select id="rhino-deaths-dropdown" />');

			years = getYears();

			select.append($('<option value="" selected>All years</option>'));
			$.each(years, function(i, year) {

				select.append($('<option value="' + year + '">' + year + '</option>'));

			});

			container.empty().append(select);

			count = $('<p class="filter-count" />');

			container.append(count);

			f.filter();

			bindEvents();


		}

		f.filter = function(year) {

			// Update total
			var result = getTotalByYear(year);
			count.empty().html(result);

			// Update markers
			$.each(data, function(i, item) {

				var result = getTotalByLocation(item, year);
				updateMarker(result, item);

			});

		}

		function bindEvents() {

			select.on('change', function() {
				f.filter($(this).find(':selected').val());
				return false;
			});

		}

		return f;

	}

})(jQuery);

/**
 * Plugin for adding arbitrary HTML markers to a Leaflet map
 * https://github.com/dwnoble/LeafletHtmlIcon
 * 
 * Public domain
 * 
 */

if(typeof L.HtmlIcon === 'undefined'){

	L.HtmlIcon = L.Icon.extend({
		options: {
			/*
			html: (String) (required)
			iconAnchor: (Point)
			popupAnchor: (Point)
			*/
		},

		initialize: function (options) {
			L.Util.setOptions(this, options);
		},

		createIcon: function () {
			var div = document.createElement('div');
			div.innerHTML = this.options.html;
			return div;
		},

		createShadow: function () {
			return null;
		}
	});

}