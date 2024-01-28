<?php

namespace app\framework\classes;

use Exception;

class Router
{
    private string $path;
    private string $request;


    private function routerFound($routes)
    {
        if(!isset($routes[$this->request])){ //method (get ou post)
            throw new Exception("Route {$this->path} does not exist");
        }

        if(!isset($routes[$this->request][$this->path])){ //uri
            throw new Exception("Route {$this->path} does not exist");
        }
    }

    private function controllerFound(string $controllerNamespace, string $controller, $action)
    {
        if(!class_exists($controllerNamespace)){
            throw new Exception("Controller {$controller} does not exist.");
        }

        if(!method_exists($controllerNamespace, $action)){
            throw new Exception("Action {$action} does not exist in controller {$controller}.");
        }
    }

    public function execute($routes)
    {
        $this->path = path();
        $this->request = request();

        $this->routerFound($routes);

        // list($controller, $action) = explode('@', $routes[$this->request][$this->path]);
        [$controller, $action]= explode('@', $routes[$this->request][$this->path]);

        if(str_contains($action, ':')){  //srt_contains disponivel a partir do php8
          [$action, $auth] = explode(':', $action);
          Auth::check($auth);
        }

        // var_dump($action);
        // die();

        $controllerNamespace = "app\\controllers\\{$controller}";

        $this->controllerFound($controllerNamespace, $controller, $action);

        $controllerInstance = new $controllerNamespace;
        $controllerInstance->$action();

        // var_dump($controllerNamespace);

    }
}