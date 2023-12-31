<!-- creo una card component a cui binderò elementi dell'array movie e che ciclerò per stampare tutti i dati di ciascun elmento in lista -->

<!-- associo delle variabili ad ogni contenuto, poi queste variabili verranno (con una funzione nella classe movie) esse stesse associate alle variabili contenenti gli elementi dell'array  -->

<!-- piazzo una serie di check in modo da poter stampare con la stessa card modelli differenti di card in base alla classe da cui attingo il contenuto -->
<div class="col-12 col-md-4 col-lg-3 my-3">
    <div class="card h-100">
        <div class=" overflow-hidden ">
            <img src="<?= $poster ?>" class="card-img-top w-100  my-ratio" alt="<?= $title ?>">
        </div>
        <div class="card-body">
            <!-- se il catch in formatCard() rileva un errore stampa questo messaggio -->
            <?php if(isset($error) && $error) { ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php } ?>
            <h5 class="card-title">
                <?= $title ?>
            </h5>
            <?php if(isset($plot)) { ?>
                <p class="card-text">
                    <?= $plot ?>
                </p>
            <?php } ?>
            <div class="d-flex justify-content-between align-items-baseline">
                <?php if(isset($genre)) { ?>
                    <div class="card-text">
                        <?= $genre ?>
                    </div>
                <?php } ?>
                <?php if(isset($rate)) { ?>
                    <div class="card-text">
                        <?= $rate ?>
                    </div>
                <?php } ?>
                <?php if(isset($flag)) { ?>
                    <div style="width: 50px" class="rounded-3 overflow-hidden ">
                        <img class="w-100" src="<?= $flag ?>" alt="flag">
                    </div>
                <?php } ?>
                <?php if(isset($types)) { ?>
                    <div>
                        <?php foreach ($types as $type) {
                            echo $type;
                        } ?>
                    </div>
                <?php } ?>
                <?php if(isset($authors)) { ?>
                    <div>
                        <?php foreach ($authors as $author) {
                            echo $author;
                        } ?>
                    </div>
                <?php } ?>
            </div>
            <!--price and etc -->
            <div>
                <?php if(isset($price) && isset($quantity)) { ?>
                    <div class="mb-2">
                        <?= $price ?>
                        <?php if($discount > 0) { ?>
                            <div class='badge text-bg-danger me-2'>
                                promo 50%
                            </div>
                        <?php } ?>
                    </div>
                    <div>
                        <?= $quantity ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>