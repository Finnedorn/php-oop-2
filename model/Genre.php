<?php

class Genre {
    public $name;

    function __construct($name) {
        $this->name = $name;
    }

    public function drawBadge($el) {
        $template = "<span class='badge text-bg-primary me-2'>$el</span>";
        return $template;
    }
    
    //porto tutto dentro ad una funzione statica, un parametro statico permette all'elemento di avere sempre quel valore a prescindere dai fattori esterni ma va richiamata in un modo tutto suo
    public static function fetchAll() {
        //prendo dal json i dati che mi servono
        $genreInfo = file_get_contents(__DIR__."/genre_db.json");
        //trasformo il json in un array php
        $genreInfoList = json_decode($genreInfo, true);
        $genres = [];

        foreach ($genreInfoList as $info) {
            $genres[] = new Genre($info);
        }
        return $genres;
    }
}

//esportando Genre in un altro file con include e sfruttando di questo solo $genres per la mia funzione su Movies, non necessito di doverlo ridichiarare fuori per attivare la classe ma la richiamerò dentro alla classe Movies

// //prendo dal json i dati che mi servono
// $genreInfo = file_get_contents(__DIR__."/genre_db.json");
// //trasformo il json in un array php
// $genreInfoList = json_decode($genreInfo, true);
// $gender = [];

// foreach ($genreInfoList as $info) {
//     $gender[] = new Genre($info);
// }

// //stampo
// var_dump($genre);


?>