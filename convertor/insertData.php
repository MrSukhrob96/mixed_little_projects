<?php

ini_set('max_execution_time', 123456789);

$extension = end(explode(".", $_FILES["excel"]["name"]));
$allowed_extension = array("xls", "xlsx", "csv"); 
if(in_array($extension, $allowed_extension) and (!empty($extension))) 
{
	
$dom = new DomDocument('1.0', 'UTF-8'); 	 
$mdo_matin = $dom->appendChild($dom->createElement('MDO_MATIN'));
$report = $mdo_matin->appendChild($dom->createElement('Report'));
	
 $file = $_FILES["excel"]["tmp_name"]; 
 include("./PHPExcel/IOFactory.php"); 
 $objPHPExcel = PHPExcel_IOFactory::load($file); 
 
 $i = 0;

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
 {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
	    $i++;
		$info_fiz = $report->appendChild($dom->createElement('Info_fiz'));
		
		$info_fiz->setAttribute('ID_person', $worksheet->getCellByColumnAndRow(0, $row)->getValue());
		$info_fiz->setAttribute('FIO_person', $worksheet->getCellByColumnAndRow(1, $row)->getValue());
		$info_fiz->setAttribute('Sex', $worksheet->getCellByColumnAndRow(2, $row)->getValue());
		$info_fiz->setAttribute('Birthday', date('d.m.y', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(3, $row)->getValue())));
		$info_fiz->setAttribute('Birth_place', "null");
		$info_fiz->setAttribute('Document', $worksheet->getCellByColumnAndRow(4, $row)->getValue());
		$info_fiz->setAttribute('Serial', $worksheet->getCellByColumnAndRow(5, $row)->getValue());
		$info_fiz->setAttribute('Issued', $worksheet->getCellByColumnAndRow(6, $row)->getValue());
		$info_fiz->setAttribute('Issue_date', date('d.m.y', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(7, $row)->getValue())));
		$info_fiz->setAttribute('Branch', "1");
		$info_fiz->setAttribute('INN', $worksheet->getCellByColumnAndRow(8, $row)->getValue());
		$info_fiz->setAttribute('Code_country', "");
		$info_fiz->setAttribute('Region', "null");
		$info_fiz->setAttribute('District', "null");
		$info_fiz->setAttribute('Country', $worksheet->getCellByColumnAndRow(9, $row)->getValue());		
		$info_fiz->setAttribute('Street_MKR', $worksheet->getCellByColumnAndRow(10, $row)->getValue());
		$info_fiz->setAttribute('Home', "null");
		$info_fiz->setAttribute('Apartment', "null");		
		$info_fiz->setAttribute('Address', $worksheet->getCellByColumnAndRow(11, $row)->getValue());
		$info_fiz->setAttribute('Company_Number', $worksheet->getCellByColumnAndRow(12, $row)->getValue());
		$info_fiz->setAttribute('Question', "null");
		$info_fiz->setAttribute('Answer', "null");
		$info_fiz->setAttribute('Account_CARD', $worksheet->getCellByColumnAndRow(13, $row)->getValue());
		$info_fiz->setAttribute('Account_TYPE', "1");
		$info_fiz->setAttribute('Type_PCenter', "01");
		$info_fiz->setAttribute('Status_PCenter', "3");
		$info_fiz->setAttribute('Total_Balance', "0");
		$info_fiz->setAttribute('Avail_Balance', "0");
		$info_fiz->setAttribute('Min_Balance', "");
		$info_fiz->setAttribute('Credit_lina', "null");		
		$info_fiz->setAttribute('Card_Number', $worksheet->getCellByColumnAndRow(14, $row)->getValue());
		$info_fiz->setAttribute('mbr', $worksheet->getCellByColumnAndRow(15, $row)->getValue());
		$info_fiz->setAttribute('Card_Condition', $worksheet->getCellByColumnAndRow(16, $row)->getValue());
		$info_fiz->setAttribute('Card_Status', $worksheet->getCellByColumnAndRow(17, $row)->getValue());
		$info_fiz->setAttribute('Card_Date_In', date('d.m.y', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(18, $row)->getValue())));
		$info_fiz->setAttribute('Card_Issue_Date', date('d.m.y', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(19, $row)->getValue())));
		$info_fiz->setAttribute('Card_Date_End', date('d.m.y', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(20, $row)->getValue())));	
		$info_fiz->setAttribute('Profile', "2");
		$info_fiz->setAttribute('Used_CARD_ATM', "10");
		$info_fiz->setAttribute('Period_Type_ATM', "День");
		$info_fiz->setAttribute('Used_CARD_POS', "10");
		$info_fiz->setAttribute('Period_Type_POS', "День");
		$info_fiz->setAttribute('TSP_mes', "5000");
		$info_fiz->setAttribute('Period_Type_TSP', "Сумма");
		$info_fiz->setAttribute('ATM_POS_mes', "10000");
		$info_fiz->setAttribute('Period_Type_ATM_POS', "Сумма");
		$info_fiz->setAttribute('ATM_POS_P2P_mes', "1000");
		$info_fiz->setAttribute('Period_Type_ATM_POS_P2P', "Сумма");
		$info_fiz->setAttribute('SMS_Status', "");
		$info_fiz->setAttribute('Start_Date', "");
		$info_fiz->setAttribute('End_Date', "");		
		$info_fiz->setAttribute('Phone', "");
   }
 }
 
	$dom->formatOutput = true;
	$dom->saveXML();
	if($dom->save('Z://bns/'.date('Y-m-d').'.xml')){
		try{
			header('location: index.html');
		}catch(Exception $ex){
			header('location: 404.html');
		}
	} else {
		header('location: 404.html');
	}
 
} else {
	header('location: 404.html');
}