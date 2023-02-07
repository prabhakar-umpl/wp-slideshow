<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
class WPSSBP_Ajax {	
	public function __construct() {
		add_action('wp_ajax_save_selected_images_to_slideshow',array($this, 'save_images'));
		add_action('wp_ajax_delete_image_from_wpssbp_slideshow',array($this, 'delete_image'));
		add_action('wp_ajax_update_images_to_wpssbp_slideshow',array($this, 'update_images'));
	}

	public function save_images() {
		$images = get_option('wpssbp_slideshow_gal');
		if(!$images || !is_array($images)) {
			$images = array();
		}
		if(isset($_POST['ids']) && !empty($_POST['ids'])) {
			$images_new = array_unique(array_merge($images, $_POST['ids']));
			update_option('wpssbp_slideshow_gal', $images_new);
		}
		die;
	}

	public function delete_image() {
		$images = get_option('wpssbp_slideshow_gal');
		if(isset($_POST['id']) && !empty($_POST['id'])) {
			if (($key = array_search($_POST['id'], $images)) !== false) {
		    unset($images[$key]);
		    update_option('wpssbp_slideshow_gal', $images);
			}
		}
		die;
	}

	public function update_images() {
		if(isset($_POST['ids']) && !empty($_POST['ids'])) {
			update_option('wpssbp_slideshow_gal', $_POST['ids']);
		}
		die;

	}

}