<?php
class WhatsMessApiUser
{
    public function __construct()
    {
        add_action('template_redirect', [$this,'whatsmess_login']);
    }
    public function login()
    {
        global $wp_query;

        # Don't do anything unless this is an AJAX request
        $method = $wp_query->get(WhatsMess_FILE_Rewrite);
        if (!$method) {
            wp_send_json_success([], 200);
            return;
        }

        # Check method name
        if ($method == "whatsmess_login") {


            // if ( ! empty( $_POST['log'] ) ) {
            //     $credentials['user_login'] = wp_unslash( $_POST['log'] );
            // }
            // if ( ! empty( $_POST['pwd'] ) ) {
            //     $credentials['user_password'] = $_POST['pwd'];
            // }
            // if ( ! empty( $_POST['rememberme'] ) ) {
            //     $credentials['remember'] = $_POST['rememberme'];
            // }

            $array = wp_signon();

            wp_send_json_success($array, 200);
            //wp_send_json_error
        }
        else
        {
            $array = [
            ];
            wp_send_json_error($array, 200);
        }
    }
}

$WhatsMessApiUser=new WhatsMessApiUser;
