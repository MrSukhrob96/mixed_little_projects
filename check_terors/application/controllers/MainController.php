<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {
    
    public function __construct($params)
    {
       parent::__construct($params);
       $this->view->render('Главная страница', $params);
    }

    public function mainAction () : void
    {
        
    }



}