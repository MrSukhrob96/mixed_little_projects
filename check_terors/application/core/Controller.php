<?php

namespace application\core;

use application\core\View;

class Controller 
{

    public $route;
    public $view;
    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModule($route['controller']);
    }

    public function loadModule($name)
    {
        $path = 'application\models\\' .  ucfirst($name);
        if(class_exists($path))
		{
            return new $path();
        }
    }	
}