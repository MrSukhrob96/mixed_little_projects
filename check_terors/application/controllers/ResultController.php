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
		
       $this->view->render('Резултать', $this->data);
    }

    public function getFormData(): void
    {
        $this->data = (new Excel())->data;
    }

    public function createArray()
    {
        $array = array();
		$percent = $_POST["percent"];
		$all_excel_data = $this->data;
			
        foreach ($all_excel_data as $excel_data) 
		{				
			foreach ($this->model->getLikeHuman() as $sql_data) 
			{									
				$sql_fio = strtoupper(trim($sql_data['fio']));
						
				$excel_fio = str_replace('.', '', strtoupper(trim($excel_data)));
						
				similar_text($sql_fio, $excel_fio , $perc);					

				if($perc > $percent)
				{
					array_push($array, [$excel_data => $sql_data['fio']]);
				}						
			}				
		}		
		return $array;
	}
    
    public function arrayCorrector($array)
    {
        $arr = [];
        $arrVal = [];
        foreach($array as $key => $arr1){
            foreach($arr1 as $arr2){
                foreach($arr2 as $arr3){
                    foreach($arr3 as $arr4){
                        array_push($arrVal, $arr4);
                    }
                }
            }
            if(!empty($arrVal)){
                $arr[$key] = $arrVal;
            }
            $arrVal = [];
        }
        return $arr;
    }

}
