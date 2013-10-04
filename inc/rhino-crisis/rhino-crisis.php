<?php

/*
 * Oxpeckers
 * Rhino data
 */

class Oxpeckers_RhinoData {

	var $csv = 'https://docs.google.com/spreadsheet/pub?key=0Anx0wudPaqDTdDZTR1d3dl9DejNsUWpPSG4tM3VGSFE&single=true&gid=0&output=csv';

	function __construct() {

		add_action('init', array($this, 'init'));

	}

	function init() {

		add_action('wp_enqueue_scripts', array($this, 'scripts'));

	}

	function scripts() {

		wp_enqueue_style('oxpeckers-rhino-crisis', get_stylesheet_directory_uri() . '/inc/rhino-crisis/rhino-crisis.css');
		wp_enqueue_script('oxpeckers-rhino-crisis', get_stylesheet_directory_uri() . '/inc/rhino-crisis/rhino-crisis.js', array('jeo', 'underscore'), '0.0.0');
		wp_localize_script('oxpeckers-rhino-crisis', 'rhino', array(
			'data' => $this->get_data()
		));

	}

	function get_sources() {

		return array(
			'rhino_deaths' => 'https://docs.google.com/spreadsheet/pub?key=0Anx0wudPaqDTdDZTR1d3dl9DejNsUWpPSG4tM3VGSFE&single=true&gid=0&output=csv',
			'poaching_arrests' => 'https://docs.google.com/spreadsheet/pub?key=0Anx0wudPaqDTdDZTR1d3dl9DejNsUWpPSG4tM3VGSFE&single=true&gid=1&output=csv'
		);

	}

	function get_data() {

		$data = get_transient('humus_rhino_data');

		if(!$data) {

			$sources = $this->get_sources();

			if(is_array($sources) && !empty($sources)) {

				$data = array();

				foreach($sources as $key => $csv) {

					$csv = fopen($csv, 'r');

					$headers = $arr = $content = array();

					$i = 0;
					while(($lineArray = fgetcsv($csv, 4000, ',', '"')) !== false) {
						if(!is_array($data[$i]))
							$arr[$i] = array();
						for($j = 0; $j < count($lineArray); $j++) {
							$arr[$i][$j] = $lineArray[$j];
						}
						$i++;
					}

					$headers = $arr[0];
					unset($arr[0]);

					$i = 0;
					foreach($arr as $line) {
						$j = 0;
						foreach($line as $item) {
							$content[$i][$headers[$j]] = $item;
							$content[$i]['marker_class'] = $key;
							$j++;
						}
						$i++;
					}

					fclose($csv);

					$data[$key] = $content;

				}

			}

			//set_transient('humus_rhino_data', $data, 60*60*3);

		}

		return $data;

	}

	function get_data_json() {
		return json_encode($this->get_data());
	}

	function json() {
		header('Content-Type: application/json');
		echo $this->get_data_json();
		exit;
	}

}

$GLOBALS['oxpeckers_rhinodata'] = new Oxpeckers_RhinoData();