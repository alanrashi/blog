<?php
//Подключаем основные файлы и конфиги программы

// 1. Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

// 2. Подключение файлов системы и бд
define('ROOT',dirname(__FILE__));

require_once(ROOT.'/components/autoload.php');

// 4. Вызов Router
$router = new router; 
$router->run();