<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Workerman\Worker;
use Workerman\MyController\HomeController;

require_once 'Autoloader.php';


// 创建一个Worker监听2345端口，使用http协议通讯
$http_worker = new Worker("Http://170.178.185.130:23456");
//TCP://
// 启动4个进程对外提供服务
$http_worker->count = 4;

// 接收到浏览器发送的数据时回复hello world给浏览器
$http_worker->onMessage = function($connection, $data) {
    // 向浏览器发送hello world

    try {

        $HomeController = new HomeController();




        if (isset($_GET['code'])) {

            $data = $HomeController->SelectFromRedis($_GET['code']);
            $connection->send(@$data);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
};

Worker::runAll();
