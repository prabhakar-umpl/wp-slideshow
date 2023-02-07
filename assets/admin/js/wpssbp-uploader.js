jQuery( function($){
	// on upload button click
	$( 'body' ).on( 'click', '.upload-wpssbp-button', function( event ){
		event.preventDefault(); // prevent default link click and page refresh		
		const button = $(this)
		const imageId = button.next().next().val();
		
		const customUploader = wp.media({
			title: 'Select/Upload Images for Slideshow', // modal window title
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Add to Slideshow' // button label text
			},
			multiple: true
		}).on( 'select', function() { // it also has "open" and "close" events
			const attachments = customUploader.state().get( 'selection' ).toJSON();
			var attachments_id = [];

			for (var i=0; i < attachments.length; i++) {
			   let attachment = attachments[i];
			   attachments_id[i] = attachment.id;
			   $(".wpssbp-galary").append('<li class="ui-state-default" data-image-id="'+attachment.id+'"><span class="wpssbp-remove">X</span><img width="100%" src="' + attachment.url + '"></li>');
			   
			}

			var data = {
				action: 'save_selected_images_to_slideshow',
				ids: attachments_id
			}
			$.post(wpssbp_param.ajax_url, data, function(response){
				$(".supports-drag-drop").hide();
			});


			/*const attachment = customUploader.state().get( 'selection' ).first().toJSON();
			button.removeClass( 'button' ).html( '<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
			button.next().show(); // show "Remove image" link
			button.next().next().val( attachment.id ); // Populate the hidden field with image ID*/
		})
		
		// already selected images
		customUploader.on( 'open', function() {

			if( imageId ) {
			  const selection = customUploader.state().get( 'selection' )
			  attachment = wp.media.attachment( imageId );
			  attachment.fetch();
			  selection.add( attachment ? [attachment] : [] );
			}
			
		})

		customUploader.open()
	
	});
	// on remove button click
	$( 'body' ).on( 'click', '.wpssbp-remove', function( event ){
		event.preventDefault();
		var parent = $(this).parent();
		var remove_id = parent.attr('data-image-id');
		$(".wpssbp-image-panel .loading").show();
		var data = {
			action: 'delete_image_from_wpssbp_slideshow',
			id: remove_id
		}
		$.post(wpssbp_param.ajax_url, data, function(response){
			$(".wpssbp-image-panel .loading").hide();
			parent.remove();
		});
	});


});