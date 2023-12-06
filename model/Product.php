<?php

class Product  {

    //le variabili di un padre devono essere public o protected altrimenti il figlio non potrà accederci!
    //protected mi permette di accedere alle proprietà solo internamente(come il private) e dalla classe figlia!
    protected int $price;
    protected int $discount;
    protected int $quantity;

    function __construct($price, $quantity) {
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function setDiscount(int $el) {
        if($el < 5 || $el > 90) {
            throw new Exception("The percentage is out of range");
        } else {
            $this->discount = $el;
        }
    }

    public function getDiscount() {
        return $this->discount;
    }

    // public static function getPriceandQuantity() {
    //     $quantity= rand(0, 50);
    //     $price= rand(10,50);
    //     return new self($price, $quantity);
    // }

    // public function setDiscount($title) {
    //     if($title == 'Gunfight at Rio Bravo') {
    //         return $this->discount = 20;
    //     }
    // }
    
}