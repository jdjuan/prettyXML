<?php 

include dirname(__FILE__) . '/Model/bookVO.php';
include dirname(__FILE__) . '/DAO/bookDAO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST)) {
		$filter = $_POST["filter"];
		$bookDAO = new BookDAO();
		if (strcmp($filter, "0") === 0) {
			echo $bookDAO->getBooks();
		}else if (strcmp($filter, "1") === 0) {
			echo $bookDAO->getByLanguage("Spanish");
		}else if (strcmp($filter, "2") === 0) {
			echo $bookDAO->getByLanguage("French");
		}else if (strcmp($filter, "3") === 0) {
			echo $bookDAO->getByPriceComparison(">=100");
		}else if (strcmp($filter, "4") === 0) {
			echo $bookDAO->getByPriceComparison("<100");
		}else {
			echo "Error";
		}
	}
}

?>