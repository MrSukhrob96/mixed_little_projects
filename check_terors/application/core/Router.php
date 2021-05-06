<?php

namespace application\core;
use application\core\View;

class Router
{

    private $routes = [];
    private $params = [];

    public function __construct()
    {
        $arr = require_once('./application/config/router.php');

        foreach ($arr as $key => $data) 
		{
            $this->routes["#^" . $key . '$#'] = $data;
        }
    }

    private function match() : bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $route => $params) 
		{
            if (preg_match($route, $url)) 
			{
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run() : void
    {

        if ($this->match()) 
		{

           $controller = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($controller)) 
			{
                $action = $this->params['action'] . 'Action';
                if (method_exists($controller, $action)) 
				{
                    (new $controller($this->params))->$action();
                } 
				else
				{
                    View::errorCode(404);
                }
            } 
			else 
			{
                View::errorCode(404);
            }
        } 
		else 
		{
            View::errorCode(404);
        }
    }
}
