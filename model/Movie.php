<?php 
//importo la classe genre così da poterla sfruttare
include __DIR__ ."/Genre.php";
//importo la classe Product così da poterla rendere padre di Movie
include __DIR__ ."/Product.php";

include __DIR__ ."/../traits/DrawCard.php";

//per creare una classe basta la dicitura class seguita dal nome della classe che si deisdera in PascalCase

//tramite la dicitura extends posso rendere la classe Product padre di Movie
//essendo figlia di Product erediterà anche tutte sue le proprietà!

class Movie extends Product {

    use DrawCard;

    //le classi possono avere delle variabili, dette attributi che di norma vengono dichiarate 
    //all'inizio dell'istanza della classe stessa 

    //queste (così come le funzioni interne alla classe) possono essere:
    //public-quindi accessibili da qualsiasi file o metodo che abbia accesso all'istanza della classe
    //protected-possono essere utilizzate solo da classi derivate o all'interno della classe stessa
    //private- possono essere utlizzati solo all'interno della classe dove sono dichiarati
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
        $this->discount = 0;
    }


    //le funzioni interne ad una classe vengono chiamate metodi
    //ogni istanza potra richiamare tutti i metodi definiti in una classe
    //per richiamare i metodi su un'istanza si usa l'operatore ->

    //creo una funzione che mi associ ad ogni variabile della card un valore di variabile di movie
    //in questo caso la funzione è pubblica perchè la richiamo da fuori in index per stampare la card
    public function formatCard() {

        //metto un check, che mi attivi una funzione dichiarata in Product:
        //se il vote_average dell'elemento stampato in card dalla lista $movies è sotto un tot...
        if(ceil($this->vote_average) < 6) {
            //try and catch mi permettono di detectare un errore e stamparmelo
            //try esegue una azione 
            //catch accoglie eventuali errori che si verificano ed agisce di conseguenza 
            //in questo caso catch mi riporta un messaggio di errore
            try {
                $this->setDiscount(10);
            } catch(Exception $e) {
                $error = "Error: " . $e->getMessage();
            }
        }

        //rielaboro la funzione formatCard
        //avendo aggiunto un tratto comune (DrawCard) che accoglie un solo elemento
        //dovrò ridurre tutte le mie variabili associate in un unico array associativo
        $cardItem= [
            "error" => $error ?? '',
            "poster"=> $this->poster_path,
            "title"=> $this->title,
            "plot" => substr($this->overview, 0, 100) . "...",
            "rate" => $this->starPrinter(),
            "flag" => $this->flagPrinter(),
            "genre" => $this->genre,
            "price" => $this->drawBadge($this->price),
            "quantity"=> $this->drawBadge($this->quantity),
            "discount" => $this->getDiscount()
        ];
        return $cardItem;
        
        //la vecchia funzione formatCard:

        // $this->setDiscount($this->title);
        // $poster = $this->poster_path;
        // $title = $this->title;
        // $plot = substr($this->overview, 0, 100) . "...";
        // $rate = $this->starPrinter();
        // $flag = $this->flagPrinter();
        // $genre = $this->genre;
        // $price = $this->drawBadge($this->price);
        // $quantity= $this->drawBadge($this->quantity);
        //includo la card altrimenti non riuscirei ad associare effettivamente le variabili
        // include __DIR__ ."/../views/partials/card.php";
    }

    //creo un metodo che verra richiamato dentro il metodo drawcard
    //mi servirà per creare dei badge con le info di prezzo e quantità
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
        //prendo il voto e lo divido per 2
        //la funzione ceil arrotonderà il risultato per eccesso 
        $rating = ceil($this -> vote_average / 2);
        //creo una variabile che aprà un p 
        $paragraph = '<p style="color: orange">';
        //ciclo 5 volte cioè il numero massimo di stelline ottenibili
        //per ogni ciclo aggiungi al p della var paragraph 
        //se il valore di $i è minore o uguale a $rating metti una stella piena, altrimenti una vuota
        for ($i = 1; $i <= 5; $i++) {
            $paragraph .= $i <= $rating ? '<i class= "fa-solid fa-star"></i>':'<i class= "fa-regular fa-star"></i>';
        }
        //chiudi il p
        $paragraph .= '</p>';
        // e returnalo 
        return $paragraph;
    }

    //creo una funzione che stampi le bandierine al posto della info della lingua 
    private function flagPrinter() {
        //creo un array che contenga tutte le iniziali delle lingue possibili (potenzialmente)
        $flags =['ca','de','es','fr','gb','it','ja','kr','us'];
        //creo una variabile che sulla base del valore della key mi reindirizzi ad una delle svg di bandiere che ho
        //in img
        $flag = "img/".$this->original_language .".svg";
        //se il value della key di original language non è inclusa nell'array $flags
        //allora assumerà il valore dell'indirizzo in cartalla dove ho inserito la bandiera placeholder
        if(!in_array($this->original_language,$flags)) {
            $flag = "img/imagemissing_92832.png";
        }
        //return $flag
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

    // fetchAll

    //porto tutto (linea 214-255) dentro ad una funzione statica, in questo modo il mio codice sarà piu pulito
    //il metodo statico non necessita di un istanza (e quindi che io richiami la classe da fuori e lo designi) per essere utilizzato

    //per utlizzare un metodo o proprietà statico da fuori della classe?
    //è sufficente scrivere: Movie::fetchAll()

    //per invece richiamare un metodo o proprietà statica dentro un metodo?
    //è sufficente scrivere: self::$nomepropietà
    
    public static function fetchAll() {

        //prendo dal json i dati che mi servono
        $movieInfo = file_get_contents(__DIR__."/movie_db.json");
        //trasformo il json in un array php
        $movieInfoList = json_decode($movieInfo, true);
        //creo un array in cui inserire i dati che ciclerò
        $movies = [];

        //richiamo la classe Genre (associandolo ad una var e così creando un oggetto) così da poterlo sfruttare nella mia funzione rngGen e ciclarlo!
        $genres = Genre::fetchAll();

        //ciclo sugli el in array associandolo alla classe new Movie prendendo le info che mi servono ed associandole alle variabili in array della funzione costruttore all'interno della classe
        foreach($movieInfoList as $info) {
            //associo ad una variabile il prodotto della funzione così da poterlo returnare e poi poterlo inserire assieme agli elementi della funzione costruttore quando ciclo 
            //richiamo la classe stessa con self::, posso in quanto rngGen è una funzione statica
            $quantity= rand(0, 50);
            $price= rand(10,50);
            //richiamo un meotodo statico interno alla classe stessa 
            $rngGenreValue = self::rngGen($genres);
            $movies[]= new Movie ($info['id'], $info['title'], $info['overview'], $info['original_language'], $info['vote_average'], $info['poster_path'], $rngGenreValue, $quantity, $price);
        }
        
        return $movies;
    }
    
}

//adesso richiamare la classe da fuori altrimenti non avrò modo di far funzionare il metodo statico, essendo fetchall una funzione statica essa non necessita di essere associata ad una variabile e quindi di essere aperta da un'istanza, a cose normali per portare fuori una classe avrei dovuto associarla ad una variabile e con valori associabili agli elementi del costruttore!
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