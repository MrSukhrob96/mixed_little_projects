<?php

ini_set('max_execution_time', 123456789);
header('Content-Type: charset=utf-8');
$message = "Муштариёни мӯҳтарам! Маъмурияти ҶДММ ТАҚХ «МАТИН» ба самми Шумоён мерасонад, ки бозии бурдноки Аксияи пасандози “Бурднок”, санаи 04.07.2020 сол соати 10:00 дар бинои Саридораи Ташкилот, воқеъ дар суроғаи ш. Хуҷанд кӯчаи Шарқ 84 баргузор мегардад. Уважаемые клиенты! Администрация ООО МДО «МАТИН» доводить до Вашего сведения, что розыгрыш Акции депозита «Бурднок», состоится 04.07.2020 года в 10:00 в Головном офисе Организации по адресу г. Худжанд улица Шарк 84. тел: 92 7702717";

$extension = end(explode(".", $_FILES["excel"]["name"]));
$allowed_extension = array("xls", "xlsx", "csv"); 
if(in_array($extension, $allowed_extension) and (!empty($extension))) 
{
	
$dom = new DomDocument('1.0', 'UTF-8'); 	 
$report = $dom->appendChild($dom->createElement('Report'));
//$report->setAttribute('xmlns:ns2', "http://www.w3.org/2000/09/xmldsig#");
$customers = $report->appendChild($dom->createElement('Customers'));
	
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
		$customer = $customers->appendChild($dom->createElement('Customer'));
		$customer->setAttribute('CustomerText', $message);
		$customer->setAttribute('CustomerTel', '992' . $worksheet->getCellByColumnAndRow(1, $row)->getValue());
   }
 }
 
	$dom->formatOutput = true;
	$dom->saveXML();
	if($dom->save('N://bns/sms.xml')){
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
	
?>