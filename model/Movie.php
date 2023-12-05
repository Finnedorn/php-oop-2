<?php 
//importo la classe genre così da poterla sfruttare
include __DIR__ ."/Genre.php";
//importo la classe Product così da poterla rendere padre di Movie
include __DIR__ ."/Product.php";
//tramite la dicitura extends posso rendere product padre di Movie
//essendo figlia di Product erediterà anche tutte sue le proprietà!
class Movie extends Product {
    public $id;
    public $title;
    public $overview;
    public float $vote_average;
    public $original_language;
    public $poster_path;
    //aggiungo un a variabile genre: mi servirà per importare in Movie la variabile con l'elemento estratto rng
    public string $genre;

    //ogni classe necessita di una funzione costruttore che associa ogni variabile ad un valore all'interno dell'argomento della funzione
    function __construct($id,$title,$overview,$original_language,$vote_average,$poster_path, $genre, $quantity, $price) {
        parent::__construct($price, $quantity);
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->original_language = $original_language;
        $this->vote_average = $vote_average;
        $this->poster_path = $poster_path;
        $this->genre = $genre;
    }

    //creo una funzione che mi associ ad ogni variabile della card un valore di variabile di movie
    //in questo caso la funzione è pubblica perchè la richiamo da fuori in index per stampare la card
    public function cardPrinter() {
        // $this->setDiscount($this->title);
        $poster = $this->poster_path;
        $title = $this->title;
        $plot = substr($this->overview, 0, 100) . "...";
        $rate = $this->starPrinter();
        $flag = $this->flagPrinter();
        $genre = $this->genre;
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

    //creo una funzione che stampi le stelle al posto del valore 
    //la funzione è privata perchè è interna al ciclo della classe e non utilizzata da fuori
    private function starPrinter() {
        $rating = ceil($this -> vote_average / 2);
        $paragraph = '<p style="color: orange">';
        for ($i = 1; $i <= 5; $i++) {
            $paragraph .= $i <= $rating ? '<i class= "fa-solid fa-star"></i>':'<i class= "fa-regular fa-star"></i>';
        }
        $paragraph .= '</p>';
        return $paragraph;
    }

    //creo una funzione che stampi le bandierine al posto della info della lingua 
    private function flagPrinter() {
        $flags =['ca','de','es','fr','gb','it','ja','kr','us'];
        $flag = "img/".$this->original_language .".svg";
        if(!in_array($this->original_language,$flags)) {
            $flag = "img/imagemissing_92832.png";
        }
        return $flag;
    }

    //creo una funzione che cicli estraendomi a sorte uno o piu elementi dall'array gender popolato da Genre 
    public static function rngGen($array) {
        $rngNumber = rand(1,3);
        $rngGenreString = "";
        for($i=0; $i < $rngNumber; $i++) {
            $rngValue = $array[rand(0, count($array) -1)]->name; 
            if(!str_contains($rngGenreString, $rngValue)) {
                $rngGenreString .= $rngValue . ' ';
            };
        }
        return $rngGenreString;
    }

    //porto tutto dentro ad una funzione statica, un parametro statico permette all'elemento di avere sempre quel valore a prescindere dai fattori esterni ma va richiamata in un modo tutto suo
    public static function fetchAll() {

        //prendo dal json i dati che mi servono
        $movieInfo = file_get_contents(__DIR__."/movie_db.json");
        //trasformo il json in un array php
        $movieInfoList = json_decode($movieInfo, true);
        //creo un array in cui inserire i dati che ciclerò
        $movies = [];

        //richiamo Genre e gli do un valore associato alla varibaile così da poterlo sfruttare nella mia funzione rngGen e ciclarlo!
        $genres = Genre::fetchAll();

        //ciclo sugli el in array associandolo alla classe new Movie prendendo le info che mi servono ed associandole alle variabili in array della funzione costruttore all'interno della classe
        foreach($movieInfoList as $info) {
            //associo ad una variabile il prodotto della funzione così da poterlo returnare e poi poterlo inserire assieme agli elementi della funzione costruttore quando ciclo 
            //richiamo la classe stessa con self::, posso in quanto rngGen è una funzione statica
            $quantity= rand(0, 50);
            $price= rand(10,50);
            $rngGenreValue = self::rngGen($genres);
            $movies[]= new Movie ($info['id'], $info['title'], $info['overview'], $info['original_language'], $info['vote_average'], $info['poster_path'], $rngGenreValue, $quantity, $price);
        }
        
        return $movies;
    }
    
}

//adesso richiamare la classe da fuori altrimenti non avrò modo di farla funzionare, essendo fetchall una funzione statica essa non necessita di essere associata ad una variabile, a cose normali per portare fuori una classe avrei dovuto associarla ad una variabile e con valori associabili agli elementi del costruttore!
Movie::fetchAll();


// //ciclo sugli el in array associandolo alla classe new Movie prendendo le info che mi servono ed associandole alle variabili in array della funzione costruttore all'interno della classe
// foreach($movieInfoList as $info) {
//     //associo ad una variabile il prodotto della funzione così da poterlo returnare e poi poterlo inserire assieme agli elementi della funzione costruttore quando ciclo 
//     $rngGenreValue = rngGen($gender);
//     $movies[]= new Movie ($info['id'], $info['title'], $info['overview'], $info['original_language'], $info['vote_average'], $info['poster_path'], $rngGenreValue);
// };

//     }

// }

// //prendo dal json i dati che mi servono
// $movieInfo = file_get_contents(__DIR__."/movie_db.json");
// //trasformo il json in un array php
// $movieInfoList = json_decode($movieInfo, true);
// //creo un array in cui inserire i dati che ciclerò
// $movies = [];

// //creo una funzione che cicli estraendomi a sorte uno o piu elementi dall'array gender popolato da Genre 
// function rngGen($array) {
//     $rngNumber = rand(1,3);
//     $rngGenreString = "";
//     for($i=0; $i < $rngNumber; $i++) {
//         $rngValue = $array[rand(0, count($array) -1)]->name; 
//         if(!str_contains($rngGenreString, $rngValue)) {
//             $rngGenreString .= $rngValue . ' ';
//         };
//     }
//     return $rngGenreString;
// }

// //ciclo sugli el in array associandolo alla classe new Movie prendendo le info che mi servono ed associandole alle variabili in array della funzione costruttore all'interno della classe
// foreach($movieInfoList as $info) {
//     //associo ad una variabile il prodotto della funzione così da poterlo returnare e poi poterlo inserire assieme agli elementi della funzione costruttore quando ciclo 
//     $rngGenreValue = rngGen($gender);
//     $movies[]= new Movie ($info['id'], $info['title'], $info['overview'], $info['original_language'], $info['vote_average'], $info['poster_path'], $rngGenreValue);
// };

// //lo stampo
// // var_dump($movies);

?>