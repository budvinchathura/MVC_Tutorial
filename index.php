<?php
    session_start();
    define('DS', DIRECTORY_SEPARATOR);
    define ('ROOT', dirname(__FILE__));
    // echo DS;
    // echo ROOT;
    // echo $_SERVER['PATH_INFO'];
    $url = isset($_SERVER['PATH_INFO']) ? explode('/',ltrim($_SERVER['PATH_INFO'],'/')):[];
    // var_dump($url);
    require_once(ROOT.DS.'core'.DS.'bootstrap.php');
