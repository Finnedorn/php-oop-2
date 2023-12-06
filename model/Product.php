<?php

class Product  {

    //le variabili di un padre devono essere public o protected altrimenti il figlio non potrà accederci!
    //protected mi permette di accedere alle proprietà solo internamente(come il private) e dalla classe figlia!
    protected int $price;
    //setto una var discount il cui valore però è dichiarato nella classe figlio
    protected int $discount;
    protected int $quantity;

    function __construct($price, $quantity) {
        $this->price = $price;
        $this->quantity = $quantity;
    }


    //questa funzione si attiva se nela classe figlio, in formatCard, vote_average è sotto un certo valore
    //accoglie un valore numerico (int)
    //mostra un messaggio nel caso in cui il valore sia sotto una certa soglia e 
    //subentri il catch (contenuto nel figlio)
    //altrimenti associa a discount il valore di quell'elemento
    public function setDiscount(int $el) {
        if($el < 5 || $el > 90) {
            throw new Exception("The percentage is out of range");
        } else {
            $this->discount = $el;
        }
    }

    //questa funzione mi permette di associare a discount il valore prodotto dal risultato dell'if di format card
    //e della funzione setDiscount
    //così da poterlo inserire in card e attivare il badge di sconto 50% nel caso in cui discount
    //abbia valore superiore al suo valore base (0)
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