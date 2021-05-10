<?php include("modal/modalAccueilReservation.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <!-- <h1>Type de réservation</h1> -->

    <h1>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-tags"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Type de réservation
            </div>
        </div>
    </h1>
</div>



<div class="container my-1">
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="text-dark card-all">
                <a data-bs-toggle="modal" data-bs-target="#modalNouveauClient" class="card-icon-alt1">
                    <div class="accueil-card center">
                        <div>
                            <span class="center mb-3" style="font-size: 5rem;"><i class="fas fa-moon"></i></span>
                            <h3 class="center">Nouveau client</h3>
                        </div>
                    </div>
                </a>
                <div class="card-body d-flex align-items-end accueil-card-body">
                    <div class="container-fluid px-0">
                        <h5 class="card-title">Day use</h5>
                        <p class="card-text">Réservation d'une ou plusieurs nuitées pour un nouveau client.</p>
                        <a class="btn btn-primary col-12 center" data-bs-toggle="modal" data-bs-target="#modalNouveauClient">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Nouveau client
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="text-dark card-all">
                <a data-bs-toggle="modal" data-bs-target="#modalAncienClient" class="card-icon-alt2">
                    <div class="accueil-card center">
                        <div>
                            <span class="center mb-3" style="font-size: 5rem;"><i class="fas fa-moon"></i></span>
                            <h3 class="center">Ancien client</h3>
                        </div>
                    </div>
                </a>
                <div class="card-body d-flex align-items-end accueil-card-body">
                    <div class="container-fluid px-0">

                        <h5 class="card-title">Nuitée</h5>
                        <p class="card-text">Réservation d'une ou plusieurs nuitées pour un ancien client.</p>
                        <a class="btn btn-primary col-12 center" data-bs-toggle="modal" data-bs-target="#modalAncienClient">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Ancien client
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="text-dark card-all">
                <a href="reservationDay" class="card-icon-alt3">
                    <div class="accueil-card center">
                        <div>
                            <span class="center mb-3" style="font-size: 5rem;"><i class="fas fa-sun"></i></span>
                            <h3 class="center">Day Use</h3>
                        </div>
                    </div>
                </a>
                <div class="card-body d-flex align-items-end accueil-card-body">
                    <div class="container-fluid px-0">
                        <h5 class="card-title">Day use</h5>
                        <p class="card-text">Réservation pour une durée de moins de 24h.</p>
                        <a href="reservationDay" class="btn btn-primary col-12 center">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-clock"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Day use
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









<!-- <div class="container bg-dark my-5">
    <div class="row center">
        <div class="col-12 col-sm-3 bg-light text-dark card-all m-5">
            <div class="bg-primary accueil-card center">
                <div>
                    <span class="center mb-2" style="font-size: 5rem;"><i id="sun" class="fas fa-sun"></i></span>
                    <h3 class="center">Day Use</h3>
                </div>
            </div>
            <div class="card-body accueil-card-body bg-secondary" style="height: 200px">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="reservationDay" class="btn btn-primary col-12 center">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Day use
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-3 bg-light text-dark card-all m-5">
            <div class="bg-primary accueil-card center">
                <div>
                    <span class="center mb-2" style="font-size: 5rem;"><i id="sun" class="fas fa-sun"></i></span>
                    <h3 class="center">Day Use</h3>
                </div>
            </div>
            <div class="card-body accueil-card-body bg-secondary" style="height: 200px">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="reservationDay" class="btn btn-primary col-12 center">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Day use
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-3 bg-light text-dark card-all m-5">
            <div class="bg-primary accueil-card center">
                <div>
                    <span class="center mb-2" style="font-size: 5rem;"><i id="sun" class="fas fa-sun"></i></span>
                    <h3 class="center">Day Use</h3>
                </div>
            </div>
            <div class="card-body accueil-card-body bg-secondary" style="height: 200px">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="reservationDay" class="btn btn-primary col-12 center">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Day use
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div> -->




</div>


<!-- <div class="card" style="width: 18rem;">
    <img src="assets/images/background1.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div> -->