<?php 

include dirname(__FILE__) . '/../Connection/connection.php';

$bookDAO = new BookDAO();  

class BookDAO {
	protected $connect;
	protected $db;

    // Attempts to initialize the database connection using the supplied info.
	public function BookDAO() {
		$this->connect = new Connection();
	}

    // Retrieves all books currently in the database.
	public function getBooks() {
		$sql = "SELECT * FROM books";
		return json_encode($this->select($sql));
	}

    // Retrieves the corresponding rows for the specified language.
	public function getByLanguage($language) {
		$sql = "SELECT * FROM books WHERE language=".$language;
		return json_encode($this->select($sql));
	}

    // Retrieves the corresponding rows for the specified price comparison.
	public function getByPriceComparison($priceComparison) {
		$sql = "SELECT * FROM books WHERE price".$priceComparison;
		return json_encode($this->select($sql));
	}

    //Saves the supplied book to the database.
	public function save($bookVO) {
		$affectedRows = 0;

		if($bookVO->getId() != "") {
			$currentBookVO = $this->getByUserId($bookVO->getId());
		}

        // If the query returned a row then update,
        // otherwise insert a new book.
		if(sizeof($currentBookVO) > 0) {
			$sql = "UPDATE books SET ".
			"title='".$bookVO->getTitle()."', ".
			"author='".$bookVO->getAuthor()."' ".
			"country='".$bookVO->getCountry()."' ".
			"language='".$bookVO->getLanguage()."' ".
			"price=".$bookVO->getPrice()." ".
			"quantity=".$bookVO->getQuantity()." ".
			"WHERE id=".$bookVO->getId();
			$result = $this->query($sql);
		}else {
			$sql = "INSERT INTO books (title, author, country, language, price, quantity) VALUES('".
			$bookVO->getTitle()."', '".
			$bookVO->getAuthor()."', '".
			$bookVO->getCountry()."', '".
			$bookVO->getLanguage()."', ".
			$bookVO->getPrice().", ".
			$bookVO->getQuantity().")";
			$result = $this->query($sql);

			return $result;
		}
	}
}
?>