<?php 
/*
Plugin Name: AMY Ongkir
Plugin URI: http://facebook.com/anandiamy
Description: Used by millions, AMY Ongkir is used to check ongkir.
Version: 0.0.1
Author: Anandia M Y
Author URI: http://facebook.com/anandiamy
Text Domain: akismet
*/

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ( plugin_dir_path(__FILE__) . 'amy-ongkir-widget.php' );
require_once ( plugin_dir_path(__FILE__) . 'amy-ongkir-check.php' );
	
	wp_enqueue_style( 'amy-custom-css', plugins_url( 'css/amy-ongkir-custom.css', __FILE__ ) );

	wp_enqueue_style( 'amy-select2-css', plugins_url( 'third-party/select2/css/select2.min.css', __FILE__ ) );

	wp_enqueue_script( 'amy-select2', plugins_url( 'third-party/select2/js/select2.min.js', __FILE__ ), 'jquery', '20160625', true );

	wp_enqueue_script( 'amy-ongkir-check', plugins_url( 'js/amy-ongkir-check.js', __FILE__ ), 'jquery', '20160625', true );

	wp_enqueue_script( 'amy-ongkir-custom', plugins_url( 'js/amy-ongkir-custom.js', __FILE__ ), 'jquery', '20160625', true );

	wp_localize_script( 'amy-ongkir-check', 'WP_ONGKIR_CHECK', array(
		'url'	=> admin_url( 'admin-ajax.php' ),
	) );




function register_amy_widget() {
    register_widget( 'AMY_ongkir_widget' );
}

add_action( 'widgets_init', 'register_amy_widget' );


 ?>