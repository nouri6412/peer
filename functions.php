<?php
define('WhatsMess_FILE', __FILE__);
/// ajax
function mbm_theme_scripts()
{
    global $wp_query;

    // wp_enqueue_script(
    //     'mbm_ajax_script',
    //     get_template_directory_uri() . '/assets/js/ajax-v16.js',
    //     array('jquery'),
    //     1,
    //     false
    // );
        wp_enqueue_script(
        'mbm_ajax_script',
        get_template_directory_uri() . '/assets/js/datastore.js',
        array('jquery'),
        1,
        false
    );

    wp_localize_script('mbm_ajax_script', 'custom_theme_mbm_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => site_url(),
        'asset_url' => get_template_directory_uri() . "/assets/"
    ));
}

add_action('wp_enqueue_scripts', 'mbm_theme_scripts');

add_filter('show_admin_bar', '__return_false');

require get_template_directory() . "/inc/sql_scripts.php";

foreach (glob(get_template_directory() . "/inc/api/*.php") as $filename) {
    require $filename;
}
