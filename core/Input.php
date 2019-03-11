<?php

class Input{
    public static function get($input){
        if(isset($_POST[$input])){
            return sanitize($_POST[$input]);
        } else if(isset($_GET[$input])){
            return sanitize($_GET[$input]);
        }
    }
}