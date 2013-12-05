<?php

/*
 * Oxpeckers
 * Rhino data
 */

class Oxpeckers_RhinoData {
	
	function __construct() {
		
		add_action('init', array($this, 'init'));
		
	}
	
	function init() {
		
		add_action('wp_enqueue_scripts', array($this, 'scripts'));
		add_action('admin_bar_menu', array($this, 'cache_button'), 201);
		$this->cache_button_action();
		
	}
	
	function scripts() {
		
		wp_enqueue_style('oxpeckers-rhino-crisis', get_stylesheet_directory_uri() . '/inc/rhino-crisis/rhino-crisis.css');
		wp_enqueue_script('oxpeckers-rhino-crisis', get_stylesheet_directory_uri() . '/inc/rhino-crisis/rhino-crisis.js', array('jeo', 'underscore'), '0.1.0');
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
	
	function update_data() {
			
		$sources = $this->get_sources();
		
		if(is_array($sources) && !empty($sources)) {
			
			$data = array();
			
			foreach($sources as $key => $csv) {
				
				$csv = fopen($csv, 'r');
				
				if(!$csv)
					continue;
				
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
		
		update_option('humus_rhino_data', $data);
		
		return $data;

	}
	
	function get_data() {
		
		$data = get_option('humus_rhino_data');
		
		if(!$data) {
			$data = $this->update_data();
		}
		
		return $data;
		
	}
	
	function cache_button() {
		global $wp_admin_bar;
		
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
		
		$wp_admin_bar->add_menu( array(
			'id' => 'ox_update_date',
			'title' => __('Update data from Google Docs', 'oxpeckers'),
			'href' => add_query_arg(array('ox_update_data' => 1))
		));
	}
	
	function cache_button_action() {
		if(isset($_REQUEST['ox_update_data']) && is_super_admin()) {
			$this->update_data();
			add_action('admin_notices', array($this, 'cache_clean_message'));
		}
	}
	
	function cache_clean_message() {
		echo '<div class="updated fade"><p>' . __('<strong>Google Data has been updated.</strong>', 'oxpeckers') . '</p></div>';
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
