<?php
define('WhatsMess_FILE', __FILE__);


define('apimes', 'apimes');

define('WhatsMess_FILE_Rewrite', 'rewrite_whats_mess_api');

function whatsmess_theme_support()
{
    load_theme_textdomain('whatsmess', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('category-thumbnails');
}
add_action('after_setup_theme', 'whatsmess_theme_support');

/// ajax
function mbm_theme_scripts()
{
    global $wp_query;

    wp_enqueue_script(
        'mbm_user_script',
        get_template_directory_uri() . '/assets/js/api-user.js',
        array('jquery'),
        1,
        false
    );
    wp_enqueue_script(
        'mbm_chat_script',
        get_template_directory_uri() . '/assets/js/chat.js',
        array('jquery'),
        1,
        false
    );

    $arg=array(
        'siteurl' => site_url(),
        'apiurl' => site_url().'/' . apimes.'/',
        'asset_url' => get_template_directory_uri() . "/assets/"
    );

    wp_localize_script('mbm_user_script', 'whatsmess_user_object',$arg );

    wp_localize_script('mbm_chat_script', 'whatsmess_chat_object',$arg);

}

add_action('wp_enqueue_scripts', 'mbm_theme_scripts');

add_filter('show_admin_bar', '__return_false');

require get_template_directory() . "/inc/sql_scripts.php";

foreach (glob(get_template_directory() . "/inc/api/*.php") as $filename) {
    require $filename;
}
