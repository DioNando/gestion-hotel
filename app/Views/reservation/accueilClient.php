<?php include("modal/modalAccueilReservation.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <h1>Type de réservation</h1>
</div>

<div class="container">
    <div class="row mt-2">

        <div class="col-lg-4 col-sm-12">
            <div class="d-grid gap-2">
                <!-- <a class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#modalNouveauClient">Nouveau client</a> -->
                <div class="card" style="width: 100%;">
                    <a data-bs-toggle="modal" data-bs-target="#modalNouveauClient"><img src="assets/images/reservation1.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Nuitée</h5>
                        <p class="card-text">Enregistrement d'un nouveau client pour une réservation d'une à plusieurs nuits.</p>
                        <a class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#modalNouveauClient">Nouveau client</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="d-grid gap-2">
                <!-- <a class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#modalAncienClient">Ancien client</a> -->
                <div class="card" style="width: 100%;">
                <a data-bs-toggle="modal" data-bs-target="#modalAncienClient"><img src="assets/images/reservation2.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Nuitée</h5>
                        <p class="card-text">Recherche d'un ancien client à partir de son nom pour une réservation d'une à plusieurs nuits.</p>
                        <a class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#modalAncienClient">Ancien client</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="d-grid gap-2">
                <!-- <a href="reservationDay" class="btn btn-primary mt-3 mb-3">Day use</a> -->
                <div class="card" style="width: 100%;">
                <a href="reservationDay"><img src="assets/images/reservation3.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Journée</h5>
                        <p class="card-text">Réservation d'une chambre pour une durée de moins de 24h ou une utilisation day use.</p>
                        <a href="reservationDay" class="btn btn-primary col-12">Day use</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div class="card" style="width: 18rem;">
    <img src="assets/images/background1.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div> -->