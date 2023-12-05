<?php
class Book {
    public $title;
    public $cover;
    public $plot = [];
    public $type = [];
    public $authors = [];

    function __construct($title, $cover, $plot, $type, $authors) {
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
        //includo la card altrimenti non riuscirei ad associare effettivamente le variabili
        include __DIR__ ."/../views/partials/bookcard.php";
    }


    public static function fetchAll() {
        //prendo dal json i dati che mi servono
        $bookInfo = file_get_contents(__DIR__."/books_db.json");
        //trasformo il json in un array php
        $bookInfoList = json_decode($bookInfo, true);
        $books = [];

        foreach ($bookInfoList as $info) {
            $books[] = new Book ($info['title'], $info['thumbnailUrl'], $info['longDescription'], $info['categories'], $info['authors']);
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