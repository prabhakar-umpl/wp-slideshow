<?php
/**
 * WPSSBP Dependency Checker
 *
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
class WPSSBP_Dependencies {
	private static $active_plugins;
	static function init() {
		self::$active_plugins = (array) get_option( 'active_plugins', array() );
		if ( is_multisite() ) {
			self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}
	} 	
}

