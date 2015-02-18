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
    font-size: 14px;
}
#bublaa-settings label {
	display: inline-block;
    line-height: 18px;
    cursor: inherit;
}

#bublaa-settings a, #bublaa-settings a:hover {
    color: #4487f7;
}

#bublaa-settings input[type=text] {
    margin: 5px 0;
	width: 150px;
}

#bublaa-settings input[type=checkbox] {
}

#bublaa-settings select {
    margin: 5px 0;
	width: 110px;
}

#bublaa-settings .bublaa_row {
	display: block;
	width: 100%;
	padding: 10px 0;
}

#bublaa-settings .bublaa_group {
	display: block;
	width: 100%;
	margin: 5px 0px;
	padding: 10px 20px;
	border: 1px solid #dfdfdf;
}

.tip {
    color: #999;
    font-size: 13px;
    line-height: 18px;
    padding-top: 5px;
}

#bublaa-settings input[type=submit] {
	font-weight: bold;
    background: #4487f7;
    color: white;
    border-radius: 5px;
	border: 1px solid #4487f7;
	padding: 10px;
    cursor: pointer;
}
</style>

<?php $options = $bublaa->get_options(); ?>
<form method="POST" id="bublaa-settings">
	<div class="bublaa_group">
		<h3>General</h3>
		<div class="bublaa_row">
            <label>The name of you forum you have created at bublaa.com:</label>
            <br/>
		    <input name="bubble"  value="<?php echo $options['bubble'] ?>" type="text" />
            <?php if(!$options['bubble'] && $options['page_id']){ ?>
                <a href="<?php echo get_page_link($options['page_id']); ?>">Click to create a new forum</a>
            <?php } ?>
            <div class="tip">
			    Be sure that the name matches to the name of the forum you have created at <a target="_blank" href="http://www.bublaa.com">bublaa.com</a>.
			    <br/>Your forum will be part of our forum network at bublaa.com.
            </div>
		</div>
	</div>

	<div class="bublaa_group">
		<h3>Embedding Forum</h3>
		<div class="bublaa_row">
            <label>The page where the forum should appear on:</label>
            <br/>
			<select name="page_id">
				<?php
					foreach(get_pages() as $page) {
						$selected = ($options['page_id'] == $page->ID) ? 'selected' : '';
						echo "<option value='" . $page->ID . "' " . $selected . ">" . $page->post_title ."</option>";
					}
				 ?>
			</select>
		</div>
	</div>

	<div class="bublaa_group">
		<h3>Embedding Comments</h3>
		<div class="bublaa_row">
            <input name="comments_enabled" value="false" <?php if(isset($options['comments_enabled']) && $options['comments_enabled'] == true) { ?> checked="checked" <?php } ?> type="checkbox" />
		    <label>Enabled</label>
		    <div class="tip">
                Bublaa Comments will replace your standard commenting system.
            </div>
		</div>
        <div class="bublaa_row">
            <label>Use Bublaa Comments only in articles published after or at the selected date:</label>
            <br/>
            <input 
                name="useCommentsAfter"
                type="date"
                value="<?php 
                    if(isset($options['useCommentsAfter']) && strlen($options['useCommentsAfter']) > 0) {
                        echo date('Y-m-d', $options['useCommentsAfter']);
                    }
                    ?>" />
            <div class="tip">If you don't select any date Bublaa will be used on every published article.</div>
        </div>
	</div>

	<div class="bublaa_group">
		<h3>Activity widget</h3>
		<div class="bublaa_row">
		    <a href="widgets.php">Enable and edit widget here.</a>
            <div class="tip">
		      Use the Bublaa Activity widget to show the latest forum activity on any of your pages.
            </div>
		</div>
	</div>

    <?php if($options['bubble'] && $options['page_id']){ ?>
        <div class="bublaa_group">
            <h3>Color scheme</h3>
            <div class="bublaa_row">
                <a target="_blank" href="<?php echo get_page_link($options['page_id']); ?>/#bublaa-/settings/plugins/">Click here to edit the background color and the overall color scheme of your forum and comments.</a>
            </div>
        </div>
    <?php } ?>

<div class="bublaa_row">
    <input type="submit" value="Save All Changes" /><span class="update-status"></span>
</div>
</form>

<div id="bublaa_help">
	Need more help? Join us at <a target="_blank" href="http://www.bublaa.com/bubble/about-bublaa">our community</a> Email us at info@bublaa.com
</div>

