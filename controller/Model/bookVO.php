<?php 
class BookVO {
    protected $id;
    protected $title;
    protected $author;
    protected $country;
    protected $language;
    protected $price;
    protected $quantity;

    //public function BookVO(){}

    public function __construct($title, $author, $country, $language, $price, $quantity) {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setCountry($country);
        $this->setLanguage($language);
        $this->setPrice($price);
        $this->setQuantity($quantity);
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function setAuthor($author) {
        $this->author = $author;
    }
    
    public function getAuthor() {
        return $this->author;
    }
    
    public function setCountry($country) {
        $this->country = $country;
    }
    
    public function getCountry() {
        return $this->country;
    }
    
    public function setLanguage($language) {
        $this->language = $language;
    }
    
    public function getLanguage() {
        return $this->language;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
}

 ?>