<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Workerman\MyConfig;

class MyConfig {

    public $config;

    public function __construct() {

        $this->config = array(
            "DB" => array(
                "host" => "localhost",
                "username" => "root",
                "password" => "!@#$%^",
                "databasename" => "cj_168"
            ),
            "Redis" => array(
                "redis_host" => '127.0.0.1',
                "redis_key" => '6379'
            )
        );
    }

}
