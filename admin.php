<h2>Bublaa Settings</h2>

<?php
	if($_POST) {
		$errors = bublaa_update_options();
		if(empty($errors)) {
			?><div id="message" class="updated below-h2"><p>Settings updated.</p></div><?php
		}
		else {
			?> <div id="message" class="updated below-h2"> <?php
			foreach ($errors as $error) {
				echo "<p>" . $error . "</p>";
			}
			?> </div> <?php
		}
	}
?>


<?php $options = get_option('bublaa-plugin-options'); ?>
<form method="POST" id="bublaa-settings">

	<label>Page (which page you want the forum to appear on):</label><br/>
	<input name="page_name"  value="<?php echo $options['page_name']; ?>" type="text" /><br /><br/>

    <label>Bubble (the name of your forum on <a target="_blank" href="http://www.bublaa.com">bublaa</a> network):</label><br/>
    <input name="bubble"  value="<?php echo $options['bubble'] ?>" type="text" /><br /><br/>

    <label>Height (pixels):</label><br/>
    <input name="height"  value="<?php echo $options['height'] ?>" type="text" /><br /><br/>

    <label>Autoresize:</label><br/>
    <input name="autoresize"  value="true" <?php if(isset($options['autoresize']) && $options['autoresize'] == true) { ?> checked="checked" <?php } ?> type="checkbox" /><br /><br/>

    <input type="submit" value="Update" /><span class="update-status"></span>

</form>