<?php


namespace application\libs;

use PHPExcel_IOFactory;

class Excel
{

    public $data = [];

    public function __construct()
    {
        ini_set('max_execution_time', 123456789);
        $this->data = $this->readExcel();
    }

    public function readExcel() : array
    {
        $arr = array();
        if (isset($_FILES['excel'])) 
		{
            $extension = explode(".", $_FILES["excel"]["name"]);
            $allowed_extension = array("xls", "xlsx", "csv");
        } else {
            return $arr;
        }
        if (in_array(end($extension), $allowed_extension) and (!empty(end($extension))))
		{

            $file = $_FILES["excel"]["tmp_name"];

            require_once('./application/libs/PHPExcel/IOFactory.php');

            $objPHPExcel = PHPExcel_IOFactory::load($file);

            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
			{
                $highestRow = $worksheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++)
				{
                    if ($worksheet->getCellByColumnAndRow(1, $row)->getValue())
					{
                        array_push($arr, trim($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
                    }
                }
            }
        }
        return $arr;
    }
}
