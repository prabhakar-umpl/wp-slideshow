<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if(!function_exists('wpssbp_activation_callback')) {
  function wpssbp_activation_callback() {
    /* used for flixibility to use anywhere without editing core code*/
    do_action('wpssbp_activation_action');
  }
}

if(!function_exists('wpssbp_deactivation_callback')) {
  function wpssbp_deactivation_callback() {
    /* used for flixibility to use anywhere without editing core code*/
    do_action('wpssbp_deactivation_action');
  }

}

if(!function_exists('wpssbp_plugin_links')) {
  function wpssbp_plugin_links( $links ) { 
    $plugin_links = array(
      '<a href="' . admin_url( 'admin.php?page=wpssbp-settings' ) . '">' . __( 'Settings', WPSSBP_TEXT_DOMAIN ) . '</a>',
      '<a href="https://github.com/prabhakar-umpl/wp-slideshow/">' . __( 'Github', WPSSBP_TEXT_DOMAIN ) . '</a>',      
    );  
    $links = array_merge( $plugin_links, $links );
    
    return $links;
  }

}

