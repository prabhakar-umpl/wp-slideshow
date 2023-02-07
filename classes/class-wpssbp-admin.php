<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
class WPSSBP_Admin {

    public $settings;

    public function __construct() {
        //admin script and style
        add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_script'));
        add_action('wpssbp_admin_footer', array(&$this, 'wpssbp_admin_footer'));
        $this->load_class('settings');
        $this->settings = new WPSSBP_Settings();
        
    }

    function load_class($class_name = '') {
        global $WPSSBP;
        if ('' != $class_name) {
            require_once ($WPSSBP->plugin_path . '/admin/class-' . esc_attr($WPSSBP->token) . '-' . esc_attr($class_name) . '.php');
        } // End If Statement
    }

    // End load_class()
    public function wpssbp_admin_footer() {
        global $WPSSBP;
        ?>
        <div style="clear: both"></div>
        <div id="wpssbp-admin-footer">
        <?php esc_html_e('Powered by', $WPSSBP->text_domain); ?> <a href="https://github.com/prabhakar-umpl/wp-slideshow" target="_blank"><img src="https://2.gravatar.com/avatar/2ec6da2580cf354870edc8169c862c1c?s=16"></a><?php esc_html_e('Prabhakar Kumar Shaw', $WPSSBP->text_domain); ?> &copy; <?php echo date('Y'); ?>
        </div>
        <?php
    }

    /**
     * Admin Scripts
     */
    public function enqueue_admin_script() {
        global $WPSSBP;
        $screen = get_current_screen();   
            
        // Enqueue admin script and stylesheet from here
        if ($screen && ($screen->id == 'toplevel_page_wpssbp-settings' || $screen->id == 'wpssbp-settings_page_wpssbp-help') ) : 
            if ( ! did_action( 'wp_enqueue_media' ) ) {
                wp_enqueue_media();
            }
            $wpssbp_localize_param = array(
                'ajax_url'  => admin_url( 'admin-ajax.php' )
            );
            wp_enqueue_script('wpssbp_uploader_js', $WPSSBP->plugin_url . 'assets/admin/js/wpssbp-uploader.js', array('jquery'), $WPSSBP->version, true);    
            wp_localize_script('wpssbp_uploader_js','wpssbp_param', $wpssbp_localize_param);
            wp_enqueue_script( 'jquery-ui-sortable' );            
            wp_enqueue_script('wpssbp_admin_js', $WPSSBP->plugin_url . 'assets/admin/js/admin.js', array('jquery'), $WPSSBP->version, true);
            wp_enqueue_style('wpssbp_admin_css', $WPSSBP->plugin_url . 'assets/admin/css/admin.css', array(), $WPSSBP->version);           

        endif;
    }
}


    

    

    

   

    

    