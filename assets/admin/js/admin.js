jQuery(document).ready(function($){

	$( ".wpssbp-image-panel #sortable" ).sortable({
	    connectWith: ".connectedSortable",
	    update: function( event, ui ) { 
	    	var updated_position = [];
	    	var i = 0;
	    	$( ".wpssbp-image-panel #sortable li" ).each(function(ee){
	    		updated_position[i] = $(this).attr('data-image-id');
	    		i = i + 1;
	    	});

	    	var data = {
	    		action: 'update_images_to_wpssbp_slideshow',
	    		ids: updated_position
	    	}
	    	$.post(wpssbp_param.ajax_url, data, function(response) {

	    	});
	    	

	    }

	}).disableSelection();
});