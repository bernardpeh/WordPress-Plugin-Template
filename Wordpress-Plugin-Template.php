<?php
/*
 * Plugin Name: WordPress Plugin Template
 * Version: 1.0
 * Plugin URI: 
 * Description: Your own description here
 * Author: Bernard Peh
 * Author URI: http://www.azhowto.com
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Include plugin class files
require_once( 'classes/Class-Wordpress-Plugin-Template.php' );
require_once( 'classes/Class-Wordpress-Plugin-Template-Settings.php' );
require_once( 'classes/post-types/Class-Wordpress-Plugin-Template-Post-Type.php' );

// Instantiate necessary classes
global $plugin_obj;
$plugin_obj = new WordPress_Plugin_Template( __FILE__ );
$plugin_settings_obj = new WordPress_Plugin_Template_Settings( __FILE__ );
$plugin_post_type_obj = new WordPress_Plugin_Template_Post_Type( __FILE__ );

register_activation_hook( __FILE__, array($plugin_settings_obj,'activate') );
register_deactivation_hook( __FILE__, array($plugin_settings_obj,'deactivate') );
