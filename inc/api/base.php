<?php
class WhatsMessApiBase
{
    public function __construct()
    {
        add_action('init', [$this,'define_url']);
    }
    public function define_url()
    {
        add_rewrite_tag('%'.WhatsMess_FILE_Rewrite.'%', '([^&/]+)');
        add_rewrite_rule('apimes/?([^/]*)', 'index.php?'.WhatsMess_FILE_Rewrite.'=$matches[1]', 'top');
    }
}
$WhatsMessApiBase =new WhatsMessApiBase;

