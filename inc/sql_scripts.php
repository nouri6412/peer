<?php
class WhatsMess_Sql_Scripts
{

  public function __construct()
  {
    add_action('after_switch_theme', array($this, "install"));
  }

  public function get_install_script()
  {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = '';

    $table_name = $wpdb->prefix . "user_relation";
    $sql .= "CREATE TABLE $table_name ( 
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `user_id_1` BIGINT NOT NULL ,
    `user_id_2` BIGINT NOT NULL ,
       PRIMARY KEY (`id`))ENGINE=InnoDB $charset_collate; ";

    return $sql;
  }

  public function install()
  {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($this->get_install_script());
  }
}

$WhatsMess_Sql_Scripts =new WhatsMess_Sql_Scripts;
