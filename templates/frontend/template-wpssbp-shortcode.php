<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
?>
<div class="owl-carousel wpssbp-carousel">
  <?php if(is_array($images) && !empty($images)) {
  	foreach ($images as $img_id) {
  		$url_arr = wp_get_attachment_image_src($img_id, 'full');
  		echo '<div class"wpssbp-image-wrap"><img src="'.$url_arr[0].'" /></div>';  		
  	}
  } ?>

  <script type="text/javascript">
  	jQuery(document).ready(function($){
	  $(".wpssbp-carousel").owlCarousel({
		    loop:true,
		    margin:10,
		    dots: true,
		    autoplay: true,
		    autoplayTimeout: 2000,
		    responsiveClass:true,
		    responsive:{
		        0:{
		            items:1,
		            nav: true
		        },
		        800:{
		            items:2,
		            nav: true
		        },
		        1000:{
		            items:3,
		            nav: true,
		            
		        }
		    }
		});
	});
  </script>
</div>
