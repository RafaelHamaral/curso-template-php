<?php

namespace app\framework\classes;

use Exception;

class Engine
{

    private ?string $layout;
    private string $content;
    private array $data;


    private function load()
    {
        return !empty($this->content) ? $this->content : ''; //this->content é o conteudo de dashboard_home
    }

    private function extends(string $layout, $data = [])
    {
        $this->layout = $layout;
        $this->data = $data;
    }


    public function teste()
    {
        return 'teste';
    }

    public function render(string $view, $data)
    {
        $view = dirname(__FILE__, 2)."/resources/views/{$view}.php";

        if(!file_exists($view)){
            throw new Exception("View {$view} not found.");
        }


        ob_start();

        extract($data);

        require $view;

        $content = ob_get_contents();

        ob_end_clean();

        //logica para nao entrar no loop
        if(!empty($this->layout)){
         $this->content = $content;
         $data = array_merge($this->data, $data);
         $layout = $this->layout;
         $this->layout = null;
         return $this->render($layout, $this->data);
        }

        return $content;

    }
}