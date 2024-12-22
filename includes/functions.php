<?php

function config($chave = null){
    $config = require 'config.php';

    if (strlen($chave) > 0){
       return $config[$chave];
    }

    return $config;
}


function abort($code)
{
    http_response_code($code);
    
    die();
}