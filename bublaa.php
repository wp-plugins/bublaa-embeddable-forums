<?php
/*
Plugin Name: Bublaa Embeddable Forums
Plugin URI: http://bublaa.com/#!/bubble/about-bublaa
Description: Adds a Bublaa forum to your WordPress site
Author: Bublaa Team
Version: 1.1.1
Author URI: http://bublaa.com/#!/bubble/about-bublaa
*/

include_once dirname(__FILE__) . '/functions.php';

function init_bublaa() {
    bublaa_init_embedded();
}

add_action('template_redirect', 'bublaa_load_template');

if ( is_admin() ) {
    add_action('admin_menu', 'bublaa_menu');
}

register_activation_hook(__FILE__, 'bublaa_activate');
register_deactivation_hook(__FILE__, 'bublaa_deactivate');
?>
