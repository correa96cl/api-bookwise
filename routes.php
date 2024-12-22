<?php



    $api = str_replace('/', '', parse_url($_SERVER['REQUEST_URI'])['path']);



    if (!$api) $api = 'index';

    if (!file_exists("../api/{$api}.php")) {
       abort(404);
    }

    require "../api/{$api}.php";