<?php

function debugPrint($data){
    echo '<pre>';
    var_dump ($data);
    echo '</pre>';
    die();
}

function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,'UTF-8');
}

function currentUser(){
    return Users::currentLoggedInUser();
}

function postedValues($post){
    $array=[];
    foreach($post as $key=> $value){
        $array[$key] = sanitize($value);
    }
    return $array;
}