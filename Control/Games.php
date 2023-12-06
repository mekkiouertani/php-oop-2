<?php
include __DIR__."/Product.php";
include __DIR__."/../Traits/DrawCard.php";
class Games extends Product {
    use DrawCard;
    public int $appid;
    public string $name;
    public string $img_icon_url;

    public function __construct($appid, $name, $img_icon_url, $price) {
        parent::__construct($price, self::getDiscount());
        $this->appid = $appid;
        $this->name = $name;
        $this->img_icon_url = $img_icon_url;
    }

    public function formatCard() {
        $cardItem = [
            "title" => $this->name,
            "id" => $this->appid,
            "image" => "https://cdn.cloudflare.steamstatic.com/steam/apps/{$this->appid}/header.jpg",
            "price" => $this->getFormattedPrice()
        ];
        return $cardItem;
        /*   $title = $this->name;
          $id = $this->appid;
          $image = "https://cdn.cloudflare.steamstatic.com/steam/apps/{$id}/header.jpg";
          $price = $this->getFormattedPrice();
          include __DIR__."/../Views/card.php"; */
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