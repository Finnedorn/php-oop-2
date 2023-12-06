<?php
//come fare quando ho una funzione che si ripete tra piu classi, come quella della card? 
//entrano in gioco i tratti! 
//di norma le classi non possono mettere in comunicazione elementi tra loro che non tramite il rapporto parent-child
//ma possono sharare un tratto comune che ouo hostare le funzioni per loro 

//creo il tratto con questa dicitura
trait DrawCard {
    //il tratto non necessita di un costruttore e ne di varibili ad esso correlate

    //creo una funzione che accoglierà un generico item come elemento e lo rimanderà alla card
    public function cardPrinter($item) {
        //tramite la funzione extract posso rielaborare l'array associativo di item ricevuto da game/book/movie
        //e tradurlo così da mandarlo associarlo alla card
        extract($item);
        //come fa la funzione a stmpare la card nell'index se non ritorna alcun valore o non associa il contenuto di card ad una var?
        //il comando include automaticamente da il comando di stampa alla funzione pertanto non necessita di dichiarare il contenuto della card nè in una var ne di conseguenza di returnarlo!!!
        include __DIR__ ."/../views/partials/card.php";
    }

}

?>