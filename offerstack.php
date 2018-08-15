<?php
/**
* Plugin Name: OfferStack
* Plugin URI: 
* Description: We cover Vouchers, Deals, Offers and Click To Call campaigns.
* Version: 1.1.1
* Author: Clicksco
* Author URI: offerstack.io
* License: MIT
*/
  

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wpdb, $wp_version;
define( 'OFFERSTACK_VERSION', '1.1.1' );


/**
* Add shortcode
*/
add_shortcode('offerstack', 'offers_listing');
function offers_listing($atts)
{	
	extract( shortcode_atts( array('offers_keyword' => 'lego', 'widget_identifier' => '', 'max_iteams' => '', 'is_sidebar'=> ''), $atts ) );
	return get_offers_listing($offers_keyword, $widget_identifier, $max_iteams, $is_sidebar);
}


/**
* enquee assets
*/
add_action('wp_enqueue_scripts','offerstack_assets_files');
function offerstack_assets_files()
{			
	if (!is_admin())
	{

		$selected_theme = esc_attr( get_option('offers_theme') );
		$selected_theme = (is_null($selected_theme) ? 'theme-default' : $selected_theme);
		
		wp_enqueue_style('offerstack', plugins_url('/public/css/'.$selected_theme.'/index.css',__FILE__ ), array('bootstrap'), OFFERSTACK_VERSION);	
		wp_enqueue_script('offerstack', plugins_url('/public/js/'.$selected_theme.'/app.js',__FILE__ ), array('jquery'), OFFERSTACK_VERSION, true);	
		
	}
}


/**
* links added in plugin page
*/
add_filter("plugin_action_links_".plugin_basename(__FILE__), 'settings_link');
function settings_link($links) {
	$settings_link = '<a href="options-general.php?page=offerstack_plugin">Settings</a>';
	array_push($links, $settings_link);
	$settings_link = '<a title="get plugin api key" href="https://offerstack.io/" target="blank">Offerstack API</a>';
	array_push($links, $settings_link);

	return $links;
}


/**
* OfferStack menu added in admin main menu
*/
add_action('admin_menu', 'add_admin_pages');
function add_admin_pages() {
	add_menu_page('ABC Plugin', 'Offerstack', 'manage_options', 'offerstack_plugin', 'offerstack_settings_page', plugins_url('public/images/logo.png', plugin_basename(__FILE__)), 110);
}
function offerstack_settings_page() {
	require_once plugin_dir_path( __FILE__ ). 'templates/settings.php';
}
add_action( 'admin_init', function() {
	register_setting( 'offerstack-settings', 'offer_keyword' );
	register_setting( 'offerstack-settings', 'api_key' );
	register_setting( 'offerstack-settings', 'offers_theme' );
});


/**
* Curl call to get data from API
*/
function get_offers_listing($offer_keyword, $widget_identifier, $max_iteams, $is_sidebar)
{	
  	
  	include plugin_dir_path( __FILE__ ).'/config-offerstack.php';
  	$offerstack_api_endpoint = $offerstack_api_endpoint."offers?query=".urlencode($offer_keyword).'&'.additional_param($widget_identifier);

  	
	$ch = curl_init();
	$authorization = "Authorization: Bearer ".get_option('api_key');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $offerstack_api_endpoint);
	$result=curl_exec($ch);
	curl_close($ch);


	$offers_listing = json_decode($result, true);
	

	if($offers_listing != '') {
		ob_start();
			$selected_theme = esc_attr( get_option('offers_theme') );
			$selected_theme = (is_null($selected_theme) ? 'theme-default' : $selected_theme);
			
			include plugin_dir_path( __FILE__ ).'/templates/'.$selected_theme.'.php';
		return ob_get_clean();		
	}		
}


/**
* get additional parameters from url to append in request for offers
*/
function additional_param($widget_identifier = '') {

	$additional_param = [];
	$additional_param[] = ($widget_identifier != '') ? 'identifier=' . $widget_identifier : '';
	$additional_param[] = isset($_GET['utm_source']) ? 'utm_source=' . $_GET['utm_source'] : '';
	$additional_param[] = isset($_GET['utm_medium']) ? 'utm_medium=' . $_GET['utm_medium'] : '';
	$additional_param[] = isset($_GET['utm_term']) ? 'utm_term=' . $_GET['utm_term'] : '';
	$additional_param[] = isset($_GET['utm_content']) ? 'utm_content=' . $_GET['utm_content'] : '';
	$additional_param[] = isset($_GET['utm_campaign']) ? 'utm_campaign=' . $_GET['utm_campaign'] : '';
	$additional_param = implode('&', array_filter($additional_param));

	return $additional_param;
}
?>