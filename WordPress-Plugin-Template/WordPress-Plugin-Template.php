<?php
/*
 * Plugin Name: WordPress Plugin Template
 * Version: 1.1
 * Plugin URI: 
 * Description: Your own description here
 * Author: Your Name
 * Author URI: http://www.azhowto.com
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Include plugin class files
require_once( 'classes/Class-WordPress-Plugin-Template.php' );
require_once( 'classes/Class-WordPress-Plugin-Template-Settings.php' );
require_once( 'classes/post-types/Class-WordPress-Plugin-Template-Post-Type.php' );

// Instantiate necessary classes
$template = new WordPress_Plugin_Template( __FILE__ );
$settings = new WordPress_Plugin_Template_Settings( __FILE__ );
// uncomment this line to add own custom post type
// $post_type = new WordPress_Plugin_Template_Post_Type( __FILE__ );

register_activation_hook( __FILE__, array($settings,'activate') );
register_deactivation_hook( __FILE__, array($settings,'deactivate') );
