<?php
class WhatsMessApiUser
{
    public function __construct()
    {
    }
    public function login()
    {
        global $wp_query;

        # Don't do anything unless this is an AJAX request
        $method = $wp_query->get(WhatsMess_FILE_Rewrite);
        if (!$method) {
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
        } else {
            $array = [];
            wp_send_json_error($array, 200);
        }
    }

    public function signup()
    {
        global $wp_query;

        # Don't do anything unless this is an AJAX request
        $method = $wp_query->get(WhatsMess_FILE_Rewrite);
        if (!$method) {
            return;
        }

        # Check method name
        if ($method == "whatsmess_signup") {
            $username = "";
            $password = "";
            $email = "";

            if (!empty($_POST['username'])) {
                $username = wp_unslash($_POST['username']);
            }

            if (!empty($_POST['password'])) {
                $password = wp_unslash($_POST['password']);
            }

            if (!empty($_POST['email'])) {
                $email = wp_unslash($_POST['email']);
            }


            if (username_exists($username)) {
                $array = ["error" => __("username already registered", "whatsmess")];
            } else {
                $user_id = wp_create_user($username, $password, $email);

                if (is_numeric($user_id) && $user_id > 0) {
                    $array = ["user_id" => $user_id];
                } else {
                    $array = ["error" => __("try again", "whatsmess")];
                }
            }

            wp_send_json_success($array, 200);
            //wp_send_json_error
        } else {
            $array = [];
            wp_send_json_error($array, 200);
        }
    }
}

add_action('template_redirect', 'whatsmess_login');
add_action('template_redirect', 'whatsmess_signup');

function whatsmess_login()
{
    $WhatsMessApiUser = new WhatsMessApiUser;
    $WhatsMessApiUser->login();
}

function whatsmess_signup()
{
    $WhatsMessApiUser = new WhatsMessApiUser;
    $WhatsMessApiUser->signup();
}
