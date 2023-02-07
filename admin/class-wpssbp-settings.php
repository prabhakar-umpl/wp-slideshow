<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class WPSSBP_Settings {   
  /**
   * Start up
   */
  public function __construct() {
    // Admin menu
    add_action( 'admin_menu', array( $this, 'add_settings_page' ) );    
  }
  
  /**
   * Add options page
   */
  public function add_settings_page() {
    global $WPSSBP;
    add_menu_page(
      __("WP Slide Show By Prabhakar", $WPSSBP->text_domain),
      __("WPSSBP Settings", $WPSSBP->text_domain),
      'manage_options',
      'wpssbp-settings',array( $this,
      'option_page' ), 'dashicons-format-gallery',
      50
      );    
    add_submenu_page(
      'wpssbp-settings',
      __("Help", $WPSSBP->text_domain),
      __("Documentation", $WPSSBP->text_domain),
      'manage_options',
      'wpssbp-help', array( $this,
      'help_page')
    );    
  }


  /**
  * Callback Settings Page
  */
  public function option_page() {
    global $WPSSBP;
    $attachments = array();
    $attachment_ids = get_option('wpssbp_slideshow_gal');
    foreach ($attachment_ids as  $attachment_id) {      
      $url_arr = wp_get_attachment_image_src($attachment_id, 'wpssbp_thumbnail');
      $attachments[$attachment_id] = $url_arr[0];
    }
    $WPSSBP->attachments = $attachments;
    $WPSSBP->get_template('admin/template-wpssbp-admin-settings.php');
    do_action('wpssbp_admin_footer');
  }

  /**
  * Callback Documentation Page
  */
  public function help_page() {
    global $WPSSBP;
    $WPSSBP->get_template('admin/template-wpssbp-admin-help.php');
    do_action('wpssbp_admin_footer');

  }
}