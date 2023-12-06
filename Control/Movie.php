<?php
include __DIR__."/Product.php";
include __DIR__."/../Traits/DrawCard.php";
include __DIR__."/../Control/Genre.php";
class Movie extends Product {

    use DrawCard;

    // Attributi privati della classe Movie
    private int $id;
    private string $title;
    private string $overview;
    private string $vote_average;
    private string $poster_path;
    private string $original_language;
    private $genre_ids;

    // Costruttore della classe Movie
    function __construct($id, $title, $overview, $vote, $image, $language, $genre, $price) {
        // Inizializza le proprietà con i valori passati al costruttore
        parent::__construct($price, self::getDiscount());
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote;
        $this->poster_path = $image;
        $this->original_language = $language;
        $this->genre_ids = $genre;
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
    // Metodo per ottenere la bandiera del paese
    public function getFlagApi() {
        $apiFlag = strtoupper(substr($this->original_language, 0, 2));

        if($apiFlag === "EN") {
            $apiFlag = "GB";
        } elseif($apiFlag === "JA") {
            $apiFlag = "JP";
        } elseif($apiFlag === "DA") {
            $apiFlag = "CA";
        } elseif($apiFlag === "ZH") {
            $apiFlag = "ES";
        } elseif($apiFlag === "HI") {
            $apiFlag = "CL";
        }
        return $this->currentFlag = "https://flagsapi.com/".$apiFlag."/flat/64.png";
    }

    // Metodo per ottenere la rappresentazione visuale del voto
    public function getVote() {
        $vote = ceil($this->vote_average / 2);
        $template = "<p>";
        for($n = 1; $n <= 5; $n++) {
            $template .= ($n <= $vote) ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        $template .= "</p>";
        return $template;
    }

    // Metodo per stampare la card del film
    public function formatCard() {
        // Ottieni i dati necessari e includi il file di visualizzazione
        $cardItem = [
            'image' => $this->poster_path,
            'title' => $this->title,
            'content' => substr($this->overview, 0, 100).'...',
            'custom' => $this->getVote(),
            'poster_path' => $this->poster_path,
            'language' => $this->getFlagApi(),
            'genre' => $this->genre_ids,
            'price' => $this->getFormattedPrice(),
        ];
        return $cardItem;
        /*  $image = $this->poster_path;
         $title = $this->title;
         $content = substr($this->overview, 0, 100).'...';
         $custom = $this->getVote();
         $language = $this->getFlagApi();
         $genre = $this->genre_ids;
         $price = $this->getFormattedPrice();
         include __DIR__.'/../Views/card.php'; */
    }

    public static function fetchAll() {
        // Leggi il contenuto del file JSON che contiene i dati dei film
        $movieString = file_get_contents(__DIR__.'/../Model/db.json');
        $movieList = json_decode($movieString, true);

        // Inizializza un array vuoto per i film
        $movies = [];

        foreach($movieList as $item) {
            $price = Product::getDiscount();
            $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path'], $item['original_language'], $item['genre_ids'], $price);
        }
        return $movies;
    }
}
?>