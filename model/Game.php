<?php
class Game {
    public $name;
    public $cover;
    function __construct($name, $cover) {
        $this->name = $name;
        $this->cover = $cover;
    }

    public function cardPrinter() {
        $poster = $this->cover;
        $title = $this->name;
        //includo la card altrimenti non riuscirei ad associare effettivamente le variabili
        include __DIR__ ."/../views/partials/gamecard.php";
    }


    public static function fetchAll() {
        //prendo dal json i dati che mi servono
        $gameInfo = file_get_contents(__DIR__."/steam_db.json");
        //trasformo il json in un array php
        $gameInfoList = json_decode($gameInfo, true);
        $games = [];

        foreach ($gameInfoList as $info) {
            $games[] = new Game ($info['name'], $info['img_icon_url']);
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