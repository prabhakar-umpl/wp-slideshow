<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
global $WPSSBP; ?>
<div class="wpssbp-setting-panel">
	<h1 class="wp-heading-inline">Slideshow Settings</h1>
	<div class="button-panel">
		<button class="upload-wpssbp-button button button-primary">Select Images</button>
	</div>


	

	<div class="wpssbp-image-panel">
		<div class="loading"><img src="<?php echo $WPSSBP->plugin_url.'assets/admin/img/loader.gif'; ?>"></div>
		<ul id="sortable" class="connectedSortable wpssbp-galary">
		  <?php foreach($WPSSBP->attachments as $attachment_id => $url) { ?>
		  	<li class="ui-state-default" data-image-id="<?php echo $attachment_id ?>"><span class="wpssbp-remove">X</span><img width="100%" src="<?php echo $url; ?>"></li>

		  <?php }?>		  
		</ul>
	</div>
</div>