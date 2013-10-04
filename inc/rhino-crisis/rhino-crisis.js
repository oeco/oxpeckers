(function($) {

	var	map,
		data = rhino.data,
		layers = {},
		currentLayer;

	jeo.mapReady(function(m) {

		map = m;

		/*
		 * Layers
		 */

		for(var key in data) {

			var layerData = data[key];

			layers[key] = L.featureGroup();

			layers[key]._data = layerData;

			$.each(layerData, function(i, m) {

				if(m.latitude && m.longitude) {

					var marker = L.marker([m.latitude, m.longitude], {
						riseOnHover: true,
						riseOffset: 9999,
						clickable: false,
						keyboard: false
					});

					m._marker = marker;

					updateMarker(getTotalByLocation(m), m);

					marker.addTo(layers[key]);

				}

			});

			if(typeof currentLayer === 'undefined')
				activateLayer(key);

		}

		/*
		 * Initialize filters
		 */

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

		_.each(currentLayer._data, function(item, i) {

			total += getTotalByLocation(item, years);

		});

		return total;

	}

	function getYears() {

		years = [];
		for(var key in currentLayer._data[0]) {
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
		m._marker.update();

	}

	function markerHtml(value, m) {

		var marker_class = '';
		var layer_name = '';
		if(typeof m.marker_class !== 'undefined') {
			marker_class = m.marker_class;

			if(marker_class == 'rhino_deaths') {
				layer_name = 'Rhino deaths in ';
			} else if(marker_class == 'poaching_arrests') {
				layer_name = 'Poaching arrests in ';
			}

		}


		return '<div class="rhino-crisis ' + marker_class + '">' + value + '<div class="bubble-container"><div class="bubble-content">' + layer_name + m.location + '</div></div></div>';

	}

	function activateLayer(key) {

		if(typeof currentLayer !== 'undefined' && map.hasLayer(currentLayer))
			map.removeLayer(currentLayer);

		layers[key].addTo(map);

		currentLayer = layers[key];

	}

	function filter() {

		var f = {},
			years,
			yearSelect,
			container = $('.map .rhino-death-filter'),
			count;

		f.init = function() {

			container.empty();

			layerSelect = $('<div class="rhino-crisis-layer-selector" />');
			for(var key in data) {
				var layer_name = '';
				if(key == 'rhino_deaths') {
					layer_name = 'Rhino deaths';
				} else if(key == 'poaching_arrests') {
					layer_name = 'Poaching arrests';
				}
				layerSelect.append('<input type="radio" name="rhino-crisis-layer" id="layer_' + key + '" value="' + key + '" />');
				layerSelect.append('<label for="layer_' + key + '">' + layer_name + '</label>');
			}

			layerSelect.find('input:first').attr('checked', 'checked');

			container.append(layerSelect);

			yearSelect = $('<select id="rhino-crisis-year-dropdown" />');

			years = getYears();

			yearSelect.append($('<option value="" selected>All years</option>'));
			$.each(years, function(i, year) {

				yearSelect.append($('<option value="' + year + '">' + year + '</option>'));

			});

			container.append(yearSelect);

			count = $('<p class="filter-count">Total: <span class="total"></span></p>');

			container.append(count);

			f.filter();

			bindEvents();


		}

		f.filter = function(year) {

			// Update total
			var result = getTotalByYear(year);
			count.find('.total').html(result);

			// Update markers
			$.each(currentLayer._data, function(i, item) {

				var result = getTotalByLocation(item, year);
				updateMarker(result, item);

			});

		}

		function bindEvents() {

			layerSelect.find('input').on('change', function() {
				activateLayer(layerSelect.find(':checked').val());
				yearSelect.trigger('change');
			});

			yearSelect.on('change', function() {
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