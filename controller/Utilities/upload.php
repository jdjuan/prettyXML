<?php 
//Upload.php is in charge of receiving, validating and storing the information
//coming from the books.xml file.
//the PHP function simplexml_load_string() was used for XML parsing

include dirname(__FILE__) . '/validate.php';
include dirname(__FILE__) . '/../Model/bookVO.php';
include dirname(__FILE__) . '/../DAO/bookDAO.php';

$validate = new Validate();
$bookDAO = new BookDAO();

if (!empty($_FILES)) {
	$file = $_FILES["xmlFile"];
	$fileName = preg_replace("/[^a-zA-Z0-9.]/", "", basename($file["name"]));
	if (!$validate->isFileEmpty($file)) {
		if ($validate->validateFile($file)) {
			$xml_string = file_get_contents('uploads/'.$fileName, FILE_USE_INCLUDE_PATH);
			$xml = simplexml_load_string($xml_string);
			$jsonString = json_encode($xml);
			$data = json_decode($jsonString, true);
			$data = $data["Book"];
			for ($i=0; $i < count($data); $i++) { 
				$row = $data[$i];
				$book = new BookVO($row["Title"], 
					$row["Author"],
					$row["Country"],
					$row["Language"],
					$row["Price"],
					$row["Quantity"]);
				$bookDAO->save($book);
			}
			header("Location: ../../query.html");
		}else{
			echo $validate->getFileError();
		}
	}else{
		echo $validate->getFileError();
	}
}
?>