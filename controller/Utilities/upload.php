<?php 
include dirname(__FILE__) . '/validate.php';
$validate = new Validate();

if (!empty($_FILES)) {
	$file = $_FILES["xmlFile"];
	$fileName = preg_replace("/[^a-zA-Z0-9.]/", "", basename($file["name"]));
	if (!$validate->isFileEmpty($file)) {
		if ($validate->validateFile($file)) {
			$xml_string = file_get_contents('uploads/'.$fileName, FILE_USE_INCLUDE_PATH);
			$xml = simplexml_load_string($xml_string);
			$jsonString = json_encode($xml);
			$data = json_decode($jsonString, true);
			var_dump($data);
		}else{
			echo $validate->getFileError();
		}
	}else{
		echo $validate->getFileError();
	}
}
?>