<?php

namespace application\controllers;

use application\core\Controller;
use application\libs\Excel;

class ResultController extends Controller
{

    public $data;
    public $keyArr;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->getFormData();
        $this->data = $this->createArray();        
    }

    public function resultAction(): void
    {
        $this->view->render('Резултать', $this->arrayCorrector($this->data));
    }

    public function getFormData(): void
    {
        $this->data = (new Excel())->data;
    }

}
