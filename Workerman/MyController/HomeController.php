<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Workerman\MyController;

use Workerman\MyClass\Database;
use Workerman\MyConfig\MyConfig;

class HomeController {

    protected $DB;
    protected $Redis;

    function __construct() {

        try {
            $temConfig = new MyConfig();

            $this->DB = new Database();

            $this->DB->db_con($temConfig->config['DB']['host'], $temConfig->config['DB']['username'], $temConfig->config['DB']['password'], $temConfig->config['DB']['databasename']);

            if (class_exists('Redis')) {


                $this->Redis = new \Redis();
                $this->Redis->connect($temConfig->config['Redis']['redis_host'], $temConfig->config['Redis']['redis_key']);
            }
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }

    public function testDB() {

        $sql = "select * from net_log limit 10";

        $data = $this->DB->db_all($sql);

        return json_encode($data);
    }

    public function SelectFromRedis($RedisKey = NULL) {


        return ($RedisKey) ? $this->Redis->get($RedisKey) : null;
    }

}
