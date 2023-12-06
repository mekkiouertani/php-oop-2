<?php
include __DIR__."/Product.php";
class Games extends Product {
    public int $appid;
    public string $name;
    public string $img_icon_url;

    public function __construct($appid, $name, $img_icon_url, $price) {
        parent::__construct($price, self::getDiscount());
        $this->appid = $appid;
        $this->name = $name;
        $this->img_icon_url = $img_icon_url;
    }

    public function printCard() {
        $title = $this->name;
        $id = $this->appid;
        $image = "https://cdn.cloudflare.steamstatic.com/steam/apps/{$id}/header.jpg";
        $price = $this->getFormattedPrice();
        include __DIR__."/../Views/card.php";
    }
    private function getFormattedPrice() {
        return "€".number_format($this->price, 2); //formatta il prezzo con due decimali e aggiungi il simbolo del dollaro
    }
    public static function fetchAll() {
        $steamString = file_get_contents(__DIR__.'/../Model/steam_db.json');
        $steamList = json_decode($steamString, true);

        $games = [];
        foreach($steamList as $value) {
            $price = self::getDiscount(); // Usa self::getDiscount() per ottenere lo sconto nella classe Games
            $games[] = new Games($value['appid'], $value['name'], $value['img_icon_url'], $price);
        }
        return $games;
    }
}


?>