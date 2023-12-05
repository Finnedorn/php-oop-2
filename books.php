<?php 
include __DIR__."/views/header.php";
//setto che movie possa essere incluso in index altriemnti non vedrò mai cosa stampo
include __DIR__."/model/Book.php";
//associo la classe movies e quindi $movies prodotto di quella classe ad una variabile dello stesso nome così da poterlo ciclare per stampare la card
$books = Book::fetchAll();
?>
    <main>
        <div class="container-fluid">
            <div class="container">
                <h2>
                    Books
                </h2>
                <div class="row">
                    <?php foreach ($books as $book) {
                        echo $book->cardPrinter();
                    } ?>
                </div>
            </div>
        </div>
    </main>
<?php 
include __DIR__."/views/footer.php";
?>