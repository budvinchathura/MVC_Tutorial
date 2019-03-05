<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

//load configurations and helper functions
require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

//autoload classes
function myAutoloader($className)
{
    $filePath1 = ROOT . DS . 'core' . DS . $className . '.php';
    $filePath2 = ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php';
    $filePath3 = ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php';

    if (file_exists($filePath1)) {
        require_once($filePath1);
    } elseif (file_exists($filePath2)) {
        require_once($filePath2);
    } elseif (file_exists($filePath3)) {
        require_once($filePath3);
    } else {
        echo 'not found';
    }
}

spl_autoload_register('myAutoloader');

session_start();
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
// $db = DB::getInstance();

//Route the request
Router::route($url); 