<?php

class Cookie{

    public static function set($name,$value,$expiry){
        if(setcookie($name,$value,(int)time()+(int)$expiry,'/')){
            return true;
        }
        return false;

    }

    public static function delete($name){
        self::set($name,null,-10);
    }

    public static function get($name){
        return $_COOKIE[$name];
    }

    public static function exists($name){
        return isset($_COOKIE[$name]);
    }
}