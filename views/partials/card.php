<!-- creo una card component a cui binderò elementi dell'array movie e che ciclerò per stampare tutti i dati di ciascun elmento in lista -->

<!-- associo delle variabili ad ogni contenuto, poi queste variabili verranno (con una funzione nella classe movie) esse stesse associate alle variabili contenenti gli elementi dell'array  -->

<div class="col-12 col-md-4 col-lg-3 my-3">
    <div class="card">
        <div style="height: 450px" class=" overflow-hidden ">
            <img src="<?= $poster ?>" class="card-img-top w-100  my-ratio" alt="<?= $title ?>">
        </div>
        <div class="card-body">
            <h5 class="card-title">
                <?= $title ?>
            </h5>
            <p class="card-text">
                <?= $plot ?>
            </p>
            <div class="d-flex justify-content-between align-items-baseline">
                <?= $genre ?>
                <?= $rate ?>
                <div style="width: 50px" class="rounded-3 overflow-hidden ">
                    <img class="w-100" src="<?= $flag ?>" alt="flag">
                </div>
            </div>
            <div>
                price:<?= $price ?> $
                available:<?= $quantity ?>
            </div>
        </div>
    </div>
</div>