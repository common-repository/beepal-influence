<?php
/**
* Plugin Name: Beepal Influence
* Plugin URI: http://beepal.co.uk/
* Description: Beepal WP plugin gives you a way to monetize your photos with tagged items. Beepal social community is great place to showcase your style.
* Version: 1.4
* Author: Plamen Dobrev
* Author URI: http://beepal.co.uk/
* License: GPLv2
*/

require_once 'beepal_widget.php';//comment to disable widget

function beepal_add_menu() {	
	add_options_page('Beepal General Settings', 'Beepal Influence', 'manage_options', 'beepal', 'beepal_settings');

	//--------uncomment when gallery is ready
	//add_menu_page( 'Beepal General Settings', 'Beepal Influence', 'manage_options', 'beepal', 'beepal_settings', plugins_url('images/beepal_m_logo_gray.png', __FILE__) );	
	//add_submenu_page( 'beepal', 'Beepal General Settings', 'General', 'manage_options', 'beepal', 'beepal_settings' );
	//add_submenu_page( 'beepal', 'Beepal Gallery Settings', 'Beepal Gallery', 'manage_options', 'beepal_gallery', 'beepal_gallery');
	//========uncomment when gallery is ready
	
	add_action( 'admin_init', 'beepal_setup' );	
	
}
add_action( 'admin_menu', 'beepal_add_menu' );

function beepal_setup() {
	beepal_settings_setup();
}

//----- General Settings -------------
function beepal_settings() {	
	include_once( 'templates/beepal_settings.php' );
}

function beepal_settings_setup() {
	register_setting( 'beepal-settings-group', 'beepal_username' );
	add_settings_section( 'beepal-settings', 'Beepal Settings', 'beepal_settings_section', 'beepal');
	add_settings_field( 'beepal-username', 'Beepal Username', 'beepal_username', 'beepal', 'beepal-settings');
}

function beepal_settings_section() {
	echo 'Customize your Beepal Information';
}

function beepal_username() {
	$username = esc_attr( get_option( 'beepal_username' ) );
	echo '<input type="text" name="beepal_username" value="'.$username.'" placeholder="Beepal Username" />';
}
//===== General Settings =============

//----- Gallery Settings -------------
function beepal_gallery() {
	echo '<h1>beepal gallery</h1>';
}
//===== Gallery Settings =============