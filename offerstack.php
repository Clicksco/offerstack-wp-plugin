<?php
/**
* Plugin Name: Clicksco OfferStack
* Plugin URI: 
* Description: We cover Vouchers, Deals, Offers and Click To Call campaigns.
* Version: 1.2.1
* Author: Clicksco
* Author URI: offerstack.io
* License: MIT
*/
  

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wpdb, $wp_version;
define( 'OFFERSTACK_VERSION', '1.2.1' );


/**
* Add shortcode
*/
add_shortcode('offerstack', 'offers_listing_cos');
function offers_listing_cos($atts)
{	
	extract( shortcode_atts( array('offers_keyword' => 'lego', 'widget_identifier' => '', 'max_iteams' => '', 'is_sidebar'=> ''), $atts ) );
	return get_offers_listing_cos($offers_keyword, $widget_identifier, $max_iteams, $is_sidebar);
}


/**
* enquee assets
*/
add_action('wp_enqueue_scripts','offerstack_assets_files_cos');
function offerstack_assets_files_cos()
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
add_filter("plugin_action_links_".plugin_basename(__FILE__), 'settings_link_cos');
function settings_link_cos($links) {
	$settings_link_cos = '<a href="options-general.php?page=clicksco_offerstack_plugin">Settings</a>';
	array_push($links, $settings_link_cos);
	$settings_link_cos = '<a title="get plugin api key" href="https://offerstack.io/" target="blank">Offerstack API</a>';
	array_push($links, $settings_link_cos);

	return $links;
}


/**
* OfferStack menu added in admin main menu
*/
add_action('admin_menu', 'add_admin_pages_cos');
function add_admin_pages_cos() {
	add_menu_page('OfferStack Plugin', 'Offerstack', 'manage_options', 'clicksco_offerstack_plugin', 'offerstack_settings_page_cos', plugins_url('public/images/logo.png', plugin_basename(__FILE__)), 110);
}
function offerstack_settings_page_cos() {
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
function get_offers_listing_cos($offer_keyword, $widget_identifier, $max_iteams, $is_sidebar)
{	
  	
  	include plugin_dir_path( __FILE__ ).'/config-offerstack.php';
  	$offerstack_api_endpoint = $offerstack_api_endpoint."offers?query=".urlencode($offer_keyword).'&'.additional_param_cos($widget_identifier);


	$args = array(
	    'headers' => array(
	        'Authorization' => 'Bearer ' . get_option('api_key')
	    )
	);
	$response = wp_remote_get( $offerstack_api_endpoint, $args );
	$offers_listing = json_decode($response['body'], true);
	
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
function additional_param_cos($widget_identifier = '') {

	$widget_identifier = sanitize_text_field($widget_identifier);

	if(isset($_GET['utm_source']))
		$utm_source = sanitize_text_field($_GET['utm_source']);
	if(isset($_GET['utm_medium']))
		$utm_medium = sanitize_text_field($_GET['utm_medium']);
	if(isset($_GET['utm_term']))
		$utm_term = sanitize_text_field($_GET['utm_term']);
	if(isset($_GET['utm_content']))
		$utm_content = sanitize_text_field($_GET['utm_content']);		
	if(isset($_GET['utm_campaign']))
		$utm_campaign = sanitize_text_field($_GET['utm_campaign']);		



	$additional_param = [];
	$additional_param[] = ($widget_identifier != '') ? 'identifier=' . $widget_identifier : '';
	$additional_param[] = ($utm_source != '') ? 'utm_source=' . $utm_source : '';
	$additional_param[] = ($utm_medium != '') ? 'utm_medium=' . $_GET['utm_medium'] : '';
	$additional_param[] = ($utm_term != '') ? 'utm_term=' . $_GET['utm_term'] : '';
	$additional_param[] = ($utm_content != '') ? 'utm_content=' . $_GET['utm_content'] : '';
	$additional_param[] = ($utm_campaign != '') ? 'utm_campaign=' . $_GET['utm_campaign'] : '';
	$additional_param = implode('&', array_filter($additional_param));

	return $additional_param;
}
?>