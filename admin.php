<h2>Bublaa Settings</h2>

<?php
	global $bublaa;
	if($_POST) {
		$errors = $bublaa->update_options();
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


<style>
#bublaa-settings {
	border-top: 1px solid #dfdfdf;
	border-bottom: 1px solid #dfdfdf;
	padding:10px;
	margin: 10px 0;
}
#bublaa-settings label {
	display: inline-block;
	width: 80px;
}

#bublaa-settings input[type=text] {
	width: 90px;
}

#bublaa-settings input[type=checkbox] {
	margin-right: 80px;
}

#bublaa-settings select {
	width: 90px;
}

#bublaa-settings .bublaa_row {
	display: block;
	width: 100%;
	padding: 10px 0;
}
</style>

<?php $options = $bublaa->get_options(); ?>
<form method="POST" id="bublaa-settings">

<div class="bublaa_row">
	<label>Page:</label>
	<select name="page_id">
		<?php
			foreach(get_pages() as $page) {
				$selected = ($options['page_id'] == $page->ID) ? 'selected' : '';
				echo "<option value='" . $page->ID . "' " . $selected . ">" . $page->post_title ."</option>";
			}
		 ?>
	</select>
	The page you want the forum to appear on.
</div>

<div class="bublaa_row">
    <label>Bubble:</label>
    <input name="bubble"  value="<?php echo $options['bubble'] ?>" type="text" />
    The name of your forum on <a target="_blank" href="http://www.bublaa.com">bublaa</a> network.
    <?php if(!$options['bubble'] && $options['page_id']){ ?> <a href="<?php echo get_page_link($options['page_id']); ?>">Click here to create a new bubble or to add an existing one</a><?php } ?>
</div>

<div class="bublaa_row">
    <label>Height:</label>
    <input name="height"  value="<?php echo $options['height'] ?>" type="text" />
    The height of your forum in pixels.
</div>

<div class="bublaa_row">
    <label>Autoresize:</label>
    <input name="autoresize"  value="false" <?php if(isset($options['autoresize']) && $options['autoresize'] == true) { ?> checked="checked" <?php } ?> type="checkbox" />
    Enabling this will strech the forum to fit the window and overrule the "Height" value.
</div>

<div class="bublaa_row">
    <label>Show footer template:</label>
    <input name="showFooter"  value="false" <?php if(isset($options['showFooter']) && $options['showFooter'] == true) { ?> checked="checked" <?php } ?> type="checkbox" />
</div>

<div class="bublaa_row">
    <input type="submit" value="Save All Changes" /><span class="update-status"></span>
</div>
<a href="widgets.php">Use the bublaa sidebar widget to show the latest forum activity on your front page</a>
</form>

<div id="bublaa_help">
	Need more help? Join us at <a target="_blank" href="http://www.bublaa.com/bubble/about-bublaa">our community</a> Email us at info@bublaa.com
</div>

