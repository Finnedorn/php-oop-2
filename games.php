<?php 
include __DIR__."/views/header.php";
//setto che movie possa essere incluso in index altriemnti non vedrò mai cosa stampo
include __DIR__."/model/Game.php";
//associo la classe movies e quindi $movies prodotto di quella classe ad una variabile dello stesso nome così da poterlo ciclare per stampare la card
$games = Game::fetchAll();
?>
    <main>
        <div class="container">
            <h2>
                Games
            </h2>
            <div class="row">
                <?php foreach ($games as $game) {
                    echo $game->cardPrinter();
                } ?>
            </div>
        </div>
    </main>
<?php 
include __DIR__."/views/footer.php";
?>