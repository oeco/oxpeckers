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

		wp_enqueue_style('oxpeckers-rhino-data', get_stylesheet_directory_uri() . '/inc/rhino-data/rhino-deaths.css');
		wp_enqueue_script('oxpeckers-rhino-data', get_stylesheet_directory_uri() . '/inc/rhino-data/data.js', array('jeo', 'underscore'), '0.0.0');
		wp_localize_script('oxpeckers-rhino-data', 'rhino', array(
			'data' => $this->get_data()
		));

	}

	function get_data() {

		$data = get_transient('humus_rhino_data');

		if(!$data) {

			$csv = fopen($this->csv, 'r');

			$headers = $data = $arr = array();

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
					$data[$i][$headers[$j]] = $item;
					$j++;
				}
				$i++;
			}

			fclose($csv);
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