<?php

return [
    'get' => [ //request
        '/' => 'HomeController@index', //path   ***HomeController->controller @index->action***
        '/login' => 'LoginController@index',
        '/dashboard' => 'DashboardController@index:auth' //protegendo rota para o usuario nao acessar sem ter passado pelo login
    ],
    'post' => [
        '/login' => 'LoginController@store'
    ]
];
