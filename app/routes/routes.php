<?php

return [
    'get' => [ //request
        '/' => 'HomeController@index', //path   ***HomeController->controller @index->action***
        '/login' => 'LoginController@index'
    ],
    'post' => []
];
