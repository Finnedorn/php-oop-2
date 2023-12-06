<?php
include __DIR__ ."/Product.php";
include __DIR__ ."/../traits/DrawCard.php";
class Game extends Product {
    use DrawCard;
    public $name;
    public $cover;
    public $vote_average;
    
    function __construct($name, $cover, $price, $quantity) {
        parent::__construct($price, $quantity);
        $this->name = $name;
        $this->cover = $cover;
        $this->vote_average = rand(0,10);
        $this->discount = 0;
    }

    public function formatCard() {

        if(ceil($this->vote_average) < 6) {
            try {
                $this->setDiscount(10);
            } catch(Exception $e) {
                $error = "Error: " . $e->getMessage();
            }
        }

        $cardItem = [
            "error" => $error ?? '',
            "poster" => $this->cover,
            "title" => $this->name,
            "price" => $this->drawBadge($this->price),
            "quantity"=> $this->drawBadge($this->quantity),
            "discount" => $this->getDiscount()
        ];
        return $cardItem;

        // $poster = $this->cover;
        // $title = $this->name;
        // $price = $this->drawBadge($this->price);
        // $quantity= $this->drawBadge($this->quantity);
        // //includo la card altrimenti non riuscirei ad associare effettivamente le variabili
        // include __DIR__ ."/../views/partials/card.php";
    }

    public function drawBadge($el) {
        if ($el == $this->price) {
            $template = "<span class='badge text-bg-success me-2'>price: $el$</span>";
        } elseif ($el == $this->quantity) {
            $template = "<span class='badge text-bg-primary me-2'>available: $el</span>";
        }
        return $template;
    }


    public static function fetchAll() {
        //prendo dal json i dati che mi servono
        $gameInfo = file_get_contents(__DIR__."/steam_db.json");
        //trasformo il json in un array php
        $gameInfoList = json_decode($gameInfo, true);
        $games = [];

        foreach ($gameInfoList as $info) {
            $quantity= rand(0, 50);
            $price= rand(10,50);
            $games[] = new Game ($info['name'], $info['img_icon_url'], $price, $quantity);
        }
        return $games;
    }
}

// //prendo dal json i dati che mi servono
// $gameInfo = file_get_contents(__DIR__."/steam_db.json");
// //trasformo il json in un array php
// $gameInfoList = json_decode($gameInfo, true);
// $games = [];

// foreach ($gameInfoList as $info) {
//     $games[] = new Game ($info['name'], $info['img_icon_url']);
// }

Game::fetchAll();

?>