<?php
/**
 * index.php入口文件
 *
 * @author by wq
 */

//框架根路径
define('ROOT_PATH', dirname(__DIR__));

//自动注册，包含类所在的文件
require ROOT_PATH.'/vendor/autoload.php';
\FlyPhp\Boot\Init::getInstance()->start(); 
