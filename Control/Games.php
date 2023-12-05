<?php
include __DIR__ . "/Product.php";
class Games extends Product
{
    public int $appid;
    public string $name;

    public string $img_icon_url;

    public function __construct($appid, $name, $img_icon_url)
    {
        $this->appid = $appid;
        $this->name = $name;
        $this->img_icon_url = $img_icon_url;
    }

    public function printCard()
    {
        $title = $this->name;
        $id = $this->appid;
        $image = "https://cdn.cloudflare.steamstatic.com/steam/apps/{$id}/header.jpg";
        include __DIR__ . "/../Views/card.php";
    }
    public static function fetchAll()
    {
        $steamstring = file_get_contents(__DIR__ . "/../Model/steam_db.json");
        $steamList = json_decode($steamstring, true);

        $games = [];
        foreach ($steamList as $value) {
            $games[] = new Games($value['appid'], $value['name'], $value['img_icon_url']);
        }
        return $games;
    }
}


?>