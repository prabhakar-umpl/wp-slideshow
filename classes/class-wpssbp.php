<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
class WPSSBP {
	public $plugin_url;
	public $plugin_path;
	public $version;
	public $token;	
	public $text_domain;	
	public $library;
	public $shortcode;
	public $admin;
	public $frontend;
	public $template;
	public $ajax;
	private $file;	
	public $settings;
	public $attachments;		
	

	public function __construct($file) {
		$this->file = $file;
		$this->plugin_url = trailingslashit(plugins_url('', $plugin = $file));
		$this->plugin_path = trailingslashit(dirname($file));
		$this->token = WPSSBP_PLUGIN_TOKEN;
		$this->text_domain = WPSSBP_TEXT_DOMAIN;
		$this->version = WPSSBP_PLUGIN_VERSION;
		// default general setting		
		add_action('init', array(&$this, 'init'), 0);
		
	}
	
	/**
	 * initilize plugin on WP init
	 */
	function init() {

		$this->add_image_sizes();
		
		// Init Text Domain
		$this->load_plugin_textdomain();
		// Init ajax
		if(defined('DOING_AJAX')) {
	      	$this->load_class('ajax');
	      	$this->ajax = new  WPSSBP_Ajax();
	    }

		if (is_admin()) {
			$this->load_class('admin');
			$this->admin = new WPSSBP_Admin();
		}

		if (!is_admin() || defined('DOING_AJAX')) {
			$this->load_class('frontend');
			$this->frontend = new WPSSBP_Frontend();
		}

	}
	
	/**
   * Load Localisation files.
   *
   * Note: the first-loaded translation file overrides any following ones if the same translation is present
   *
   * @access public
   * @return void
   */
  	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists('get_user_locale') ? get_user_locale() : get_locale();
		$locale = apply_filters('wpssbp_plugin_locale', $locale, 'wp-slideshow-by-prabhakar');

		unload_textdomain( 'wpssbp' );
		load_textdomain( 'wpssbp', WP_LANG_DIR . '/wpssbp/wpssbp-' . $locale . '.mo' );
		load_plugin_textdomain( 'wpssbp', false, plugin_basename(dirname(dirname(__FILE__))) . '/languages' );		
  	}

	public function load_class($class_name = '') {
		if ('' != $class_name && '' != $this->token) {
			require_once ('class-' . esc_attr($this->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()


	/**
	 * Load template
	 *
	 * @param string $template_name Tempate Name.
	 * @param array  $args args.
	 * @param string $template_path Template Path.
	 * @param string $default_path Default path.
	 */
	public function get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( $args && is_array( $args ) ) {
			extract( $args ); // phpcs:ignore
		}
		$located = $this->locate_template( $template_name, $template_path, $default_path );
		include $located;
	}

	/**
	 * Locate template file
	 *
	 * @param string $template_name template_name.
	 * @param string $template_path template_path.
	 * @param string $default_path default_path.
	 * @return string
	 */
	public function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		$default_path = apply_filters( 'wpssbp_template_path', $default_path );
		if ( ! $template_path ) {
			$template_path = 'wpssbp';
		}
		if ( ! $default_path ) {
			$default_path = $this->plugin_path . 'templates/';
		}
		// Look within passed path within the theme - this is priority.
		$template = locate_template( array( trailingslashit( $template_path ) . $template_name, $template_name ) );
		// Add support of third perty plugin.
		$template = apply_filters( 'wpssbp_locate_template', $template, $template_name, $template_path, $default_path );
		// Get default template.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}
		return $template;
	}

	/**
	* Galary thumbnail size
	*/

	public function add_image_sizes() {
		add_image_size( 'wpssbp_thumbnail', 150, 150 );

	}

	
	/** Cache Helpers *********************************************************/

	/**
	 * Sets a constant preventing some caching plugins from caching a page. Used on dynamic pages
	 *
	 * @access public
	 * @return void
	 */
	function nocache() {
		if (!defined('DONOTCACHEPAGE'))
			define("DONOTCACHEPAGE", "true");
		// WP Super Cache constant
	}

}