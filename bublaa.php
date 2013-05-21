<?php
/*
Plugin Name: Bublaa Embeddable Forums
Plugin URI: http://bublaa.com/#!/bubble/about-bublaa
Description: Adds a Bublaa forum to your WordPress site
Author: Bublaa Team
Version: 1.2.4.2
Author URI: http://bublaa.com/#!/bubble/about-bublaa
*/

include_once dirname(__FILE__) . '/functions.php';

function init_bublaa() {
	global $bublaa;
    $bublaa->init_embedded();
}
function init_bublaa_widgets() {
	if(in_array('bublaa-embeddable-forums/bublaa.php', get_option( 'active_plugins' )))
		register_widget( 'BublaaWidget' );
}


add_action('template_redirect', array($bublaa, 'load_template'));
add_action( 'wp_ajax_update-bublaa-bubble', array($bublaa, 'update_bubble_ajax'));
add_action('admin_init', array($bublaa, 'admin_notice'));
add_action( 'widgets_init', 'init_bublaa_widgets' );


if ( is_admin() ) {
    add_action('admin_menu', array($bublaa, 'menu'));
	$plugin = plugin_basename(__FILE__);
	add_filter( "plugin_action_links_$plugin", array($bublaa, 'add_settings_link') );
}

register_activation_hook(__FILE__, array($bublaa, 'activate'));
register_deactivation_hook(__FILE__, array($bublaa, 'deactivate'));
?>
