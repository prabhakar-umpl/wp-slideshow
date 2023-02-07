<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
class WPSSBP_Frontend {   

    public function __construct() {
        global $WPSSBP;
        //enqueue scripts
        add_action('wp_enqueue_scripts', array($this, 'frontend_scripts'));
        //enqueue styles
        add_action('wp_enqueue_scripts', array($this, 'frontend_styles'));        
        // SlideShow shortcode
        add_shortcode('wpssbp_slideshow', array($this, 'wpssbp_slideshow_shortcode'));
    }

   

    function frontend_scripts() {
        global $WPSSBP;
        $frontend_script_path = $WPSSBP->plugin_url . 'assets/frontend/js/';
        $frontend_script_path = str_replace(array('http:', 'https:'), '', $frontend_script_path);
        $pluginURL = str_replace(array('http:', 'https:'), '', $WPSSBP->plugin_url);
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        // Enqueue your frontend javascript from here
        

        wp_enqueue_script('wpssbp_frontend_js', $frontend_script_path . 'frontend.js', array( 'jquery', 'jquery-blockui' ), $WPSSBP->version, true);
        wp_enqueue_script('wpssbp_slider_js', $frontend_script_path . 'owl/owl.carousel.min.js', array( 'jquery'), $WPSSBP->version, true);

            
            
        
    }

    function frontend_styles() {
        global $WPSSBP;
        $frontend_style_path = $WPSSBP->plugin_url . 'assets/frontend/css/';
        $frontend_style_path = str_replace(array('http:', 'https:'), '', $frontend_style_path);
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        // Enqueue your frontend stylesheet from here        
        wp_enqueue_style('wpssbp_frontend_css', $frontend_style_path . 'frontend.css', array(), $WPSSBP->version);   
        wp_enqueue_style('wpssbp_slider_css', $frontend_style_path . 'owl/owl.carousel.min.css', array(), $WPSSBP->version);
        wp_enqueue_style('wpssbp_slider_theme', $frontend_style_path . 'owl/owl.theme.default.min.css', array(), $WPSSBP->version);        
       
    }
    
    public function wpssbp_slideshow_shortcode($attr) {
        global $WPSSBP;
        $images = get_option('wpssbp_slideshow_gal');
        ob_start();
        $WPSSBP->get_template('frontend/template-wpssbp-shortcode.php', array('images' => $images));
        return ob_get_clean();        
    }
}
