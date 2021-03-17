<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/icons/favicon.ico">
    <title>Hotel</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if (session()->get('isLoggedIn')) : ?>
        <style>
            body {
                background-image: url("#");
            }
        </style>

    <?php endif ?>
</head>

<body>
    <?php
    $page = $_SERVER['REQUEST_URI'];
    ?>
    <header>


        <?php if (session()->get('isAdmin')) : ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="dashboard">Tableau de bord</a></li>
                        <li class="nav-item"><a class="nav-link" href="client">Réservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="register">Nouvel utilisateur</a></li>
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="logout">Déconnexion</a></li>
                    </ul>
                </div>
            </nav>


        <?php elseif (session()->get('isUser')) : ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="dashboard">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="client">Réservation</a></li>
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="logout">Déconnexion</a></li>
                    </ul>
                </div>
            </nav>


        <?php else : ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Connexion utilisateur</a></li>
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="loginAdmin">Connexion administrateur</a></li>
                    </ul>
                </div>
            </nav>

        <?php endif ?>

    </header>