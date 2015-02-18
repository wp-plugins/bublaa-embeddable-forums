<?php
/*
Template Name: Bublaa Template
*/
global $bublaa;
$bublaa_options = $bublaa->get_options();
$fileHost = isset($bublaa_options["bublaa_file_host"]) ? $bublaa_options["bublaa_file_host"] : "//cdn.bublaa.com";
$serviceHost = isset($bublaa_options['bublaa_service_host']) ? $bublaa_options['bublaa_service_host'] : 'http://www.bublaa.com';
$id = $post->ID;
$title = $post->post_title;
$description = $post->post_modified . ' ' .  implode(
    '',
    array_slice(
      preg_split(
        '/([\s,\.;\?\!]+)/',
        str_replace('"', "'", stripslashes(strip_tags($post->post_content))),
        50*2-1,
        PREG_SPLIT_DELIM_CAPTURE
      ),
      0,
      50*2-1
    )
  ) . "...";

?>
<div id="comments">
	<div id="bublaa-comments-container" name="comments">
		<div id="bublaa-comments" data-id="<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-description="<?php echo $description; ?>" style="text-align:center;">loading comments...</div>
	</div>
	<script type="text/javascript">
		window.bublaa = {
		    config : {
		        bubble : "<?php echo $bublaa_options["bubble"]; ?>", //REQUIRED
		        forumUrl : "<?php echo get_page_link($bublaa_options['page_id']); ?>",
                serviceHost : "<?php echo $serviceHost ?>"
			}
		};

		(function() {
		    var b = document.createElement('script');
		    b.type = 'text/javascript';
		    b.async = true;
		    b.src = "<?php echo $fileHost ?>/dist/plugins.js";
		    var s = document.getElementsByTagName('script')[0];
		    s.parentNode.insertBefore(b, s);
		})();
	</script>
</div>