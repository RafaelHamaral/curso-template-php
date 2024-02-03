<?php

namespace app\controllers;

use app\framework\classes\Cache;
use app\framework\database\Connection;

class DashboardController
{
    public function index()
    {
        //data de criacao do arquivo de cache + 5 minutos (ou outro parametro do strtotime) 
        // var_dump(strtotime('+2 minutes', filemtime('users.txt')), strtotime('now'));
        // die();

        $users = Cache::get('users', function(){ //callback
            $connection = Connection::getConnection();
            $query = $connection->query("select * from users limit 15");
            return $query->fetchAll();
        }, 5); //5 minutos

        view('dashboard_home',['title' => 'Dashboard - Home', 'users' => $users]);
    }
}


/*
Logica: se nao existir o cache cria o cache.. senao retorna o cache que esta no callback, data de xpiracao sera em minutos
O retorno será em json (encode para inserir e  decode para resgatar)
*/