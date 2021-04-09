<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/icons/signe-de-l'hotel.png">
    <title>Hotel</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Chart.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- JAVASCRIPT -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/js/Chart.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jspdf.min.js"></script>
    <script src="assets/js/html2canvas.js"></script>
    <script src="assets/js/main.js"></script>
    <?php if (!session()->get('isLoggedIn')) : ?>
        <style>
            body {
                /* background-image: url("assets/images/background1.png"); */
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
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarHeader" aria-controls="navBarHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="center" href="dashboard">
                        <div class="logo-container"><img src="assets/icons/signe-de-l'hotel.png"></div>
                    </a>
                    <div class="collapse navbar-collapse" id="navBarHeader">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Tableau de bord</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="etatFinancier">Etat financier</a></li>
                                    <li><a class="dropdown-item" href="statistique">Statistique</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Planning</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="planningJour">Planning du jour</a></li>
                                    <li><a class="dropdown-item" href="planningMois">Planning du mois</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="accueilClient">Réservation</a></li>
                            <li class="nav-item"><a class="nav-link" href="ficheCardex">Fiche cardex</a></li>
                        </ul>
                        <ul class="navbar-nav my-2 my-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Paramètres</a>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="#">Profil</a></li>
                                    <li><a class="dropdown-item" href="configUser">Utilisateur</a></li>
                                    <li><a class="dropdown-item" href="configAdmin">Administrateur</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout">Déconnexion</a></li>
                                </ul>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#">Paramètres</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout">Déconnexion</a></li> -->


                        </ul>
                    </div>
                </div>
            </nav>

        <?php elseif (session()->get('isUser') == 'Utilisateur') : ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarHeader" aria-controls="navBarHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="center" href="dashboard">
                        <div class="logo-container"><img src="assets/icons/signe-de-l'hotel.png"></div>
                    </a>
                    <div class="collapse navbar-collapse" id="navBarHeader">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Tableau de bord</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="etatFinancier">Etat financier</a></li>
                                    <li><a class="dropdown-item" href="statistique">Statistique</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Planning</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="planningJour">Planning du jour</a></li>
                                    <li><a class="dropdown-item" href="planningMois">Planning du mois</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="accueilClient">Réservation</a></li>
                            <li class="nav-item"><a class="nav-link" href="ficheCardex">Fiche cardex</a></li>
                        </ul>
                        <ul class="navbar-nav my-2 my-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Paramètres</a>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="#">Profil</a></li>
                                    <li><a class="dropdown-item" href="configUser">Utilisateur</a></li>
                                    <li><a class="dropdown-item" href="configAdmin">Administrateur</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout">Déconnexion</a></li>
                                </ul>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#">Paramètres</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout">Déconnexion</a></li> -->
                        </ul>
                    </div>
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
            <!--Sidebar debut-->
            <div class="row menu-parent">
                <div class="col-2 menu">

                    <div class="accordion accordion-flush" id="accordionMenu">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                                    Réservation
                                </button>
                            </h2>
                            <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1" data-bs-parent="#accordionMenu">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="configReservationNuit">Fiche nuitée</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="configReservationDay">Fiche day use</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="accueilClient">Nouveau</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                                    Client
                                </button>
                            </h2>
                            <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2" data-bs-parent="#accordionMenu">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="configClient">Liste</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="addClient">Nouveau</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                                    Chambre
                                </button>
                            </h2>
                            <div id="flush-collapse3" class="accordion-collapse collapse" aria-labelledby="flush-heading3" data-bs-parent="#accordionMenu">
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
                        <!-- <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                                    Utilisateur
                                </button>
                            </h2>
                            <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-heading4" data-bs-parent="#accordionMenu">
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
                            <h2 class="accordion-header" id="flush-heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                                    Administrateur
                                </button>
                            </h2>
                            <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-heading5" data-bs-parent="#accordionMenu">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="configAdmin">Liste</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                    </div>


                </div>
                <!--Sidebar fin-->
                <div class="col main">

                <?php endif ?>