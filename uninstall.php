<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if ( !is_user_logged_in() )
        wp_die( 'You must be logged in to run this script.' );

if ( !current_user_can( 'install_plugins' ) )
        wp_die( 'You do not have permission to run this script.' );

// Enter our plugin uninstall script below
require_once( 'classes/Class-WordPress-Plugin-Template-Settings.php' );
$page_slug = WordPress_Plugin_Template_Settings::$page_slug;
$check = get_option($page_slug.'_menu_uninstall');
if ($check) {
	// remember to delete all the fields that you pre-defined.
	delete_option( $page_slug.'_menu_1' );
	delete_option( $page_slug.'_menu_uninstall' );
}
