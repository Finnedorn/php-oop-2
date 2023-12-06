<?php 
include __DIR__."/views/header.php";
//setto che movie possa essere incluso in index altriemnti non vedrò mai cosa stampo
include __DIR__."/model/Book.php";
//associo la classe movies e quindi $movies prodotto di quella classe ad una variabile dello stesso nome così da poterlo ciclare per stampare la card
$books = Book::fetchAll();
?>
    <main>
        <div class="container-fluid bg-secondary pt-5">
            <div class="container bg-dark rounded-4 p-3">
                <h2 class="ms-3 pb-4 text-light">
                    Books
                </h2>
                <div class="row px-5 pt-2">
                    <?php foreach ($books as $book) {
                        echo $book->cardPrinter($book->formatCard());
                    } ?>
                </div>
            </div>
        </div>
    </main>
<?php 
include __DIR__."/views/footer.php";
?>