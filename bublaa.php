<?php
	/*
	Plugin Name: Bublaa Embeddable Forums
	Plugin URI: http://bublaa.com
	Description: Adds a Bublaa forum to your WordPress site
	Author: bublaa
	Version: 1.0
	Author URI: http://bublaa.com
	*/
	
	function init_embedded_bublaa (){
		
		// Options:
			$height = '700px'; 			// Height in pixels or percentage
			$width = 'auto'; 			// Width in pixels, percentage or auto
			$bubble = 'about bublaa'; 	// The name of your bubble (You must change this!)
			$autoresize = 'true'; 		// true or false
		
		// Do not edit after this
		echo "
			<div id='bublaa'></div>
			<style type='text/css'>
				#bublaa 
				{ 
				    height: '". $height ."'; 
				    width: '". $width ."';
				}
				</style>
				<script type='text/javascript'>
				window.bublaa = {
				    config : {
				        bubble : '". $bubble ."',
				        autoresize : '". $autoresize ."',
				        serviceHost : 'http://bublaa.com'
				    }
				};
			(function() { var b = document.createElement('script');
			    b.type = 'text/javascript'; b.async = true;
			    b.src = 'http://bublaa.com/js/embedded.js';
			    var s = document.getElementsByTagName('script')[0];
			    s.parentNode.insertBefore(b, s); })();
			</script>
		";
	}
?>