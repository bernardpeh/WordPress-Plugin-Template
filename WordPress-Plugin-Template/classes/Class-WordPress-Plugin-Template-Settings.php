<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class WordPress_Plugin_Template_Settings {
	private $dir;
	private $file;
	private $assets_dir;
	private $assets_url;
	// make it unique! use underscore.
	public static $page_slug = "Page_Name";
	public static $page_title = "Page_Title";

	public function __construct( $file ) {
		$this->dir = dirname( $file );
		$this->file = $file;
		$this->assets_dir = trailingslashit( $this->dir ) . 'assets';
		$this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $file ) ) );

		// Register plugin settings
		add_action( 'admin_init' , array( &$this , 'register_settings' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( &$this , 'add_menu_item' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->file ) , array( &$this , 'add_settings_link' ) );

	}
	
	public function add_menu_item() {
		// add_options_page( $page_title, $menu_title, $capability, $page_slug, $function);
		add_options_page( __(self::$page_title, 'plugin_textdomain') , __(self::$page_title, 'plugin_textdomain') , 'manage_options' , self::$page_slug ,  array( &$this , 'settings_page' ) );
	}

	public function add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page='.self::$page_slug.'">Settings</a>';
  		array_push( $links, $settings_link );
  		return $links;
	}

	public function register_settings() {
		
		// Add settings section
		// add_settings_section( $id, $title, $callback, $page );
		add_settings_section( 'main_settings' , __( 'plugin settings' , 'plugin_textdomain' ) , array( &$this , 'main_settings' ) , self::$page_slug );
		
		// Add headers fields to plugin settings page
		// add_settings_field( $id, $title, $callback, $page, $section, $args );
		add_settings_field( self::$page_slug.'_menu_1' , __( 'menu item 1' , 'plugin_textdomain' ) , array( &$this , 'menu_1' )  , self::$page_slug , 'main_settings' );
		add_settings_field( self::$page_slug.'_menu_uninstall' , __( 'menu item 2' , 'plugin_textdomain' ) , array( &$this , 'menu_uninstall' )  , self::$page_slug , 'main_settings' );

		// Register/save form settings fields
		// register_setting( $option_group, $option_name, $sanitize_callback );
		register_setting( self::$page_slug , self::$page_slug.'_menu_1' , array( &$this , 'validate_field' ) );
		register_setting( self::$page_slug , self::$page_slug.'_menu_uninstall' , array( &$this , 'validate_field' ) );

	}

	public function main_settings() { 
		echo '<p>' . __( 'Change these settings to customise your plugin.' , 'plugin_textdomain' ) . '</p>'; 
	}

	public function menu_1() {

		$option = get_option(self::$page_slug.'_menu_1');
		$data = array();
		if( $option && count( $option ) > 0 && $option != '' ) {
			$data = $option;
		}
		echo '<p><input id="'.self::$page_slug.'_menu_1[1]" type="text" name="'.self::$page_slug.'_menu_1[1]" value="' . $data[1] . '"/><br/>
				<label for="slug"><span class="description">' . __( 'field 1' , 'plugin_textdomain' ) . '</span></label></p>';
		echo '<p><input id="'.self::$page_slug.'_menu_1[2]" type="text" name="'.self::$page_slug.'_menu_1[2]" value="' . $data[2] . '"/><br/>
				<label for="slug"><span class="description">' . __( 'field 2' , 'plugin_textdomain' ) . '</span></label></p>';
		}

	public function menu_uninstall() {
		$check = get_option(self::$page_slug.'_uninstall');
		echo '<p><input id="'.self::$page_slug.'_menu_uninstall" type="checkbox" name="'.self::$page_slug.'_menu_uninstall" type="checkbox" ';
		checked($check,'on');
		echo '/><br/><label for="slug"><span class="description">' . __( 'check this box if you want to delete the plugin data after uninstalling this plugin' , 'plugin_textdomain' ) . '</span></label></p>';
	}

	// validation function
	public function validate_field( $slug ) {
		// put your validation function here
		return $slug;
	}

	public function settings_page() {

		echo '<div class="wrap">'.
			screen_icon().'<h2>'.self::$page_title.'</h2>
			<form method="post" action="options.php" enctype="multipart/form-data">';
		// Output nonce, action, and option_page fields for a settings page
		settings_fields(self::$page_slug);
		// Prints out all settings sections added to a particular settings page. 
		do_settings_sections(self::$page_slug);

		echo '<p class="submit">
		<input name="Submit" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings' , 'plugin_textdomain' ) ) . '" />
		</p>
		</form>
		</div>';
	}
	
	function network_propagate($pfunction, $networkwide) {
		global $wpdb;
    	if (function_exists('is_multisite') && is_multisite()) {
        	// check network activation 
        	if ($networkwide) {
            	$old_blog = $wpdb->blogid;
            	$blogids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
            	foreach ($blogids as $blog_id) {
                    switch_to_blog($blog_id);
                    call_user_func($pfunction, $networkwide);
            	}
            	switch_to_blog($old_blog);
            	return;
        	}       
    	} 
    	call_user_func($pfunction, $networkwide);
	}

	function activate($networkwide) {
	    $this->network_propagate(array($this, '_activate'), $networkwide);
	}

	function deactivate($networkwide) {
	    $this->network_propagate(array($this, '_deactivate'), $networkwide);
	}

	// plugin activation code here.
	function _activate() {
		// Add options, initiate cron jobs here
	}

	// plugin activation code here.
	function _deactivate() {
	}
}
