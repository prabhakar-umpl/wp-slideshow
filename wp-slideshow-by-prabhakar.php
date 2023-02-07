<?php

/**
 * The assignment plugin
 *
 * This plugin is created for assignment where user can add multiple slideshow in their post or
 * page with desired order of image display
 * @link              https://github.com/prabhakar-umpl/wp-slideshow
 * @since             1.0.0
 * @package           WP_Slideshow_By_Prabhakar
 *
 * @wordpress-plugin
 * Plugin Name:       WP SlideShow By Prabhakar
 * Plugin URI:        https://github.com/prabhakar-umpl/wp-slideshow
 * Description:       This plugin is created for assignment where user can add multiple slideshow in their post or page with desired order of image display.
 * Version:           1.0.0
 * Author:            Prabhakar Kumar Shaw
 * Author URI:        https://github.com/prabhakar-umpl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpssbp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
define('WPSSBP_PATH', trailingslashit(dirname(__FILE__)));
define('WPSSBP_URL', trailingslashit(plugins_url('/', __FILE__)));
define('WPSSBP_BASE', plugin_basename( __FILE__ ));
require_once WPSSBP_PATH.'wpssbp-config.php';
if ( ! class_exists( 'WPSSBP_Dependencies' ) ) {
    require_once WPSSBP_PATH.'includes/class-wpssbp-dependencies.php';
}
require_once WPSSBP_PATH.'includes/wpssbp-core-functions.php';

if(!defined('WPSSBP_PLUGIN_TOKEN')) exit;
if(!defined('WPSSBP_TEXT_DOMAIN')) exit;
if(!defined('WPSSBP_PLUGIN_VERSION')) exit;

register_activation_hook(__FILE__, 'wpssbp_activation_callback');
register_deactivation_hook(__FILE__, 'wpssbp_deactivation_callback');
add_filter( 'plugin_action_links_' . WPSSBP_BASE, 'wpssbp_plugin_links' );

if(!class_exists('WPSSBP')) {
    require_once( WPSSBP_PATH.'classes/class-wpssbp.php' );
    global $WPSSBP;
    $WPSSBP = new WPSSBP( __FILE__ );
    $GLOBALS['WPSSBP'] = $WPSSBP;
}
