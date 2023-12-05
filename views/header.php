<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <header>
        <div class="container-fluid bg-my-purple">
            <div class="container py-3 px-4">
                <nav class="navbar navbar-expand-lg">
                    <div class="logo-wrapper d-flex me-3 align-items-center">
                        <div style="width: 50px">
                            <img class="w-100" src="img/icons8-microsoft-todo-2019-144.png" alt="logo">
                        </div>
                        <h1 class="text-light ms-2">
                            Shop
                        </h1>
                    </div>
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item fs-4 ">
                            <a class="nav-link active text-light " aria-current="page" href="books.php">Book</a>
                            </li>
                            <li class="nav-item fs-4">
                            <a class="nav-link active text-light " aria-current="page" href="games.php">Games</a>
                            </li>
                            <li class="nav-item fs-4">
                            <a class="nav-link active text-light " aria-current="page" href="index.php">Movies</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>

        </div>
    </header>