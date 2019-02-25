<?php

function debugPrint($data){
    echo '<pre>';
    var_dump ($data);
    echo '</pre>';
    die();
}