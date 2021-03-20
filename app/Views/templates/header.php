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


        <?php if (session()->get('isUser') == 'Administrateur') : ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="dashboard">Tableau de bord</a></li>
                        <li class="nav-item"><a class="nav-link" href="reservation">Réservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Planning</a></li>
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="logout">Déconnexion</a></li>
                    </ul>
                </div>
            </nav>

        <?php elseif (session()->get('isUser') == 'Utilisateur') : ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="dashboard">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="reservation">Réservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Planning</a></li>
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
                        <li class="nav-item"><a class="nav-link" href="index.php">Connexion</a></li>
                    </ul>
                </div>
            </nav>

        <?php endif ?>

    </header>

    <?php if (session()->get('isLoggedIn')) : ?>
        <div class="container-fluid">
            <div class="row menu-parent">
                <div class="col-2 menu">

                    <div class="accordion accordion-flush" id="accordionMenu">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Client
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionMenu">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="configClient">Liste</a>
                                        </li>
                                      
                                        <li class="nav-item">
                                            <a class="nav-link" href="reservation">Nouveau</a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Utilisateur
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionMenu">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="configUser">Liste</a>
                                        </li>
                                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="addUser">Nouveau</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Chambre
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionMenu">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="configChambre">Liste</a>
                                        </li>
                                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="addChambre">Nouveau</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    Administrateur
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionMenu">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="configAdmin">Liste</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav flex-column parametre">
                        <li><a href="#">Paramètres</a></li>
                    </ul>

                </div>
                <div class="col main">

                <?php endif ?>