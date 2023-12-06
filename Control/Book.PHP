<?php
include __DIR__."/Product.php";
include __DIR__."/../Traits/DrawCard.php";
class Book extends Product {
    use DrawCard;
    public string $title;
    public string $longDescription;
    public string $thumbnailUrl;
    public array $authors;
    public array $categories;

    public function __construct($title, $description, $image, $authors, $categories, $price) {
        parent::__construct($price, self::getDiscount());
        $this->title = $title;
        $this->longDescription = $description;
        $this->thumbnailUrl = $image;
        $this->authors = $authors;
        $this->categories = $categories;
    }
    public function getFormattedPrice() {
        try {
            if($this->price < 100) {
                throw new Exception("Il prezzo non può essere inferiore a 100");
            }
            return "€".number_format($this->price, 2);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function formatCard() {
        $cardItem = [
            "title" => $this->title,
            "description" => $this->longDescription,
            "image" => $this->thumbnailUrl,
            "price" => $this->getFormattedPrice()
        ];
        return $cardItem;
    }
    public static function fetchAll() {
        $bookString = file_get_contents(__DIR__."/../Model/books_db.json");
        $bookList = json_decode($bookString, true);

        $books = [];
        foreach($bookList as $book) {
            $price = Product::getDiscount();
            $books[] = new Book($book['title'], $book['longDescription'], $book['thumbnailUrl'], $book['authors'], $book['categories'], $price);
        }
        return $books;
    }
}
?>