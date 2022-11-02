<?php


class WhatsMessApiUser
{
    public function __construct()
    {
    }

    public function forward()
    {
        global $wp_query;

        # Don't do anything unless this is an AJAX request
        $method = $wp_query->get(WhatsMess_FILE_Rewrite);
        if (!$method) {
            return;
        }

        if ($method == "whatsmess_login") {
            $this->login();
        } else if ($method == "whatsmess_signup") {
            $this->signup();
        }
    }
    public function login()
    {

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

    public function signup()
    {

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
    }
}


add_action('template_redirect', 'whatsmess_signup');
add_action('template_redirect', 'whatsmess_login');

function whatsmess_login()
{
    $WhatsMessApiUser = new WhatsMessApiUser;
    $WhatsMessApiUser->forward();
}

function whatsmess_signup()
{
    $WhatsMessApiUser = new WhatsMessApiUser;
    $WhatsMessApiUser->forward();
}
