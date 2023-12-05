<?php
include __DIR__ ."/Product.php";
class Book extends Product {
    public $title;
    public $cover;
    public $plot = [];
    public $type = [];
    public $authors = [];

    function __construct($title, $cover, $plot, $type, $authors, $price, $quantity) {
        parent::__construct($price, $quantity);
        $this->title = $title;
        $this->cover = $cover;
        $this->plot = $plot;
        $this->type = $type;
        $this->authors = $authors;

    }

    public function cardPrinter() {
        $poster = $this->cover;
        $title = $this->title;
        $plot = substr($this->plot, 0, 150) . "...";
        $types = $this->type;
        $authors = $this->authors;
        $price = $this->drawBadge($this->price);
        $quantity= $this->drawBadge($this->quantity);
        //includo la card altrimenti non riuscirei ad associare effettivamente le variabili
        include __DIR__ ."/../views/partials/card.php";
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
        $bookInfo = file_get_contents(__DIR__."/books_db.json");
        //trasformo il json in un array php
        $bookInfoList = json_decode($bookInfo, true);
        $books = [];

        foreach ($bookInfoList as $info) {
            $quantity= rand(0, 50);
            $price= rand(10,50);
            $books[] = new Book ($info['title'], $info['thumbnailUrl'], $info['longDescription'], $info['categories'], $info['authors'], $price, $quantity);
        }
        return $books;
    }

}

Book::fetchAll();


// //prendo dal json i dati che mi servono
// $bookInfo = file_get_contents(__DIR__."/books_db.json");
// //trasformo il json in un array php
// $bookInfoList = json_decode($bookInfo, true);
// $books = [];

// foreach ($bookInfoList as $info) {
//     $books[] = new Book ($info['title'], $info['thumbnailUrl'], $info['longDescription'], $info['categories'], $info['authors']);
// }

?>