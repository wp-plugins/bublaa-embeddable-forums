<?php
function bublaa_defaults() {
    return array(
        "page_name" => "forum",
        "height" => "500",
        "bubble" => "about bublaa",
        "autoresize" => true
    );
}

function bublaa_activate()
{
    add_option('bublaa-plugin-options', bublaa_defaults());
}

function bublaa_deactivate()
{
    delete_option('bublaa-plugin-options');
}

function bublaa_menu()
{
    // Create menu tab
    add_menu_page('Bublaa Plugin Options', 'Bublaa Forum', 'manage_options', "bublaa", 'bublaa_admin');
}

function bublaa_admin() {
    if (!current_user_can('edit_plugins'))
    {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    include_once dirname(__FILE__) . '/admin.php';
}

function bublaa_init_embedded (){
    $options = array_merge(bublaa_defaults(), get_option('bublaa-plugin-options'));

    $autoresize = "false";
    if($options["autoresize"])
        $autoresize = "true";

    echo "
        <div id='bublaa'></div>
        <style type='text/css'>
            #bublaa
            {
                height: " . $options["height"] ."px;
            }
        </style>
        <script type='text/javascript'>
            window.bublaa = {
                config : {
                    bubble     : '" . $options["bubble"] ."',
                    autoresize : " . $autoresize .",
                    height     : '" . $options["height"] ."px',
                    serviceHost: 'http://www.bublaa.com'
                }
            };

            (function() {
                var b = document.createElement('script'); b.type = 'text/javascript'; b.async = true;
                b.src = 'http://www.bublaa.com/js/embedded.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(b, s);
            })();
        </script>
    ";
}

function bublaa_load_template() {
    $options = array_merge(bublaa_defaults(), get_option('bublaa-plugin-options'));
    global $post;
    if($post->post_type == 'page' && $post->post_title == $options["page_name"]) {
        include_once dirname(__FILE__) . '/bublaa-template.php';
        exit;
    }
}

function bublaa_update_options() {

    $errors = array();

    $data = bublaa_defaults();

    $data["bubble"] = $_POST["bubble"];

    if(isset($_POST["autoresize"]) && $_POST["autoresize"] == true) {
        $data["autoresize"] = true;
    }
    else {
        $data["autoresize"] = false;
    }

    $data["height"] = intval($_POST["height"]);

    $page_name_error = true;
    if($_POST["page_name"]) {
        $page_name = $_POST["page_name"];
        $pages = get_pages();
        foreach ($pages as $page) {
            if ($page->post_title == $page_name)
                $page_name_error = false;
        }
        if(!$page_name_error)
            $data["page_name"] = $page_name;
        else {
            array_push($errors, "Page with the title \"$page_name\" not found! " . "You have to create it first to use it for your forum.");
        }
    }

    update_option('bublaa-plugin-options', $data);

    return $errors;
}