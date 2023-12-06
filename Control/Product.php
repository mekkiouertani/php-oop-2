<?php

class Product {
    public float $price;
    public $quantity;
    public function __construct($price, $quantity) {
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public static function getDiscount() {
        $price = rand(80, 150);
        return $price;
    }
    public static function getQuantity() {
        $quantity = rand(0, 10);
        return $quantity;
    }

}
?>