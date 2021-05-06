<?php

namespace application\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = []) : void
    {
        ob_start();
            $path = 'application/views/' . $this->path . '.php';
            require_once($path);
        $content = ob_get_clean();


        if (file_exists($path)) {
            require_once './application/views/layouts/' . $this->layout . '.php';
        }
    }

    public function redirect($url) : void
    {
        header('Location: ' . $url);
    }

    public static function errorCode($code) : void
    {
        http_response_code($code);
        require_once('./application/views/errors//' . $code . '.php');
        exit();
    }

}
