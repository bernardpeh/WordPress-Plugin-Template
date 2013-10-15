<?php
/*
 * Plugin Name: WordPress Plugin Template
 * Version: 1.0
 * Plugin URI: 
 * Description:
 * Author: 
 * Author URI: 
 * Requires at least: 
 * Tested up to: 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Include plugin class files
require_once( 'classes/class-wordpress-plugin-template.php' );
require_once( 'classes/class-wordpress-plugin-template-settings.php' );
require_once( 'classes/post-types/class-wordpress-plugin-template-post_type.php' );

// Instantiate necessary classes
global $plugin_obj;
$plugin_obj = new WordPress_Plugin_Template( __FILE__ );
$plugin_settings_obj = new WordPress_Plugin_Template_Settings( __FILE__ );
$plugin_post_type_obj = new WordPress_Plugin_Template_Post_Type( __FILE__ );

register_activation_hook( __FILE__, array($plugin_settings_obj,'activate') );
register_deactivation_hook( __FILE__, array($plugin_settings_obj,'deactivate') );
