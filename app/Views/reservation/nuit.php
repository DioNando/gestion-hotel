<?php include("assets/toast/myToast.php"); ?>

<div class="container">
    <div class="container-fluid formulaire">
        <h1 class="center mt-3 mb-3">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    Réservation nuitée
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-moon"></i>
                </div>
            </div>
        </h1>
        <form action="" method="post">
            <div class="row">
                <div class="col-12">
                    <!-- <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?> -->
                </div>




                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="nom_client" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="#" name="nom_client" value="<?= session()->get('nom_client') ?>" readonly>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="prenom_client" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="#" name="prenom_client" value="<?= session()->get('prenom_client') ?>" readonly>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="telephone_client" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="#" name="telephone_client" value="<?= session()->get('telephone_client') ?>" readonly>
                    </div>
                </div>
                <div class="col-12 col-sm-3 mt-2">
                    <div class="form-group">
                        <label for="nbr_personne" class="form-label">Nombre de personne</label>
                        <input type="number" class="form-control" id="nbr_personne" name="nbr_personne" value="1" min="1">
                    </div>
                </div>
                <div class="col-12 col-sm-3 mt-2">
                    <div class="form-group">
                        <label for="debut_sejour" class="form-label">Début du séjour</label>
                        <input type="date" class="form-control" id="dateDebutSejour" onchange="calculNuit(document.getElementById('dateDebutSejour').value, document.getElementById('dateFinSejour').value);" name="debut_sejour">
                    </div>
                </div>
                <div class="col-12 col-sm-3 mt-2">
                    <div class="form-group">
                        <label for="fin_sejour" class="form-label">Fin du séjour</label>
                        <input type="date" class="form-control" id="dateFinSejour" onchange="calculNuit(document.getElementById('dateDebutSejour').value, document.getElementById('dateFinSejour').value);" name="fin_sejour">
                    </div>
                </div>
                <div class="col-12 col-sm-3 mt-2 mt-2">
                    <div class="form-group">
                        <label class="form-label">Nombre de nuitée</label>
                        <input type="number" class="form-control" id="nbr_nuit" name="nbr_nuit" value="0" readonly>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-2 mt-2">
                    <div class="form-group">
                        <label class="form-label" for="">Type de réservation</label>
                        <select class="form-select" name="type_reservation">
                            <option selected value="Réception">Réception</option>
                            <option value="Téléphone">Téléphone</option>
                            <option value="Mail">Mail</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-2 mt-2">
                    <div class="form-group">
                        <label for="nom_user" class="form-label">Fait par :</label>
                        <input type="text" class="form-control" id="#" name="nom_user" value="<?= session()->get('nom_user') ?>" readonly>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="remarque_reservation" class="form-label">Remarque</label>
                        <textarea class="form-control" id="remarque_reservation" name="remarque_reservation" rows="2"></textarea>
                    </div>
                </div>

                <!-- FACTURE DEBUT -->



                <div class="col-12 col-lg-6 mt-2">
                    <label for="" class="form-label">Le sejour est-il offert ?</label>
                    <div class="p-2 border checkChambre">

                        <div class="form-check">
                            <input class="form-check-input checkRadio" type="radio" name="offert_sejour" id="offert_non" value="0" checked>
                            <label class="form-check-label align-middle" for="offert_non">
                                Non
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkRadio" type="radio" name="offert_sejour" value="1" id="offert_oui">
                            <label class="form-check-label align-middle" for="offert_oui">
                                Oui
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-2">
                    <label for="" class="form-label">Le tarif à utiliser</label>

                    <div class="p-2 border checkChambre">

                        <div class="form-check">
                            <input class="form-check-input checkRadio" type="radio" name="ancien_nouveau_tarif" id="ancien_tarif" disabled>
                            <label class="form-check-label align-middle" for="ancien_tarif">
                                Ancien tarif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkRadio" type="radio" name="ancien_nouveau_tarif" id="nouveau_tarif" checked disabled>
                            <label class="form-check-label align-middle" for="nouveau_tarif">
                                Nouveau tarif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="remise" class="form-label">Remise</label>
                        <input type="number" class="form-control" id="remise" name="remise" value="0" min="0" max="100">
                    </div>
                </div>

                <!-- FACTURE FIN -->

                <div class="col-12 mt-4">
                    <div class="p-2 border checkChambre">
                        <div class="form-check">
                            <label class="form-check-label align-middle" for="confirmation_reservation">Confirmation de la réservation</label>
                            <input class="form-check-input" type="checkbox" name="confirmation_reservation" value="1" id="confirmation_reservation" checked>
                        </div>
                    </div>
                </div>



                <!--Checkbox-->
                <h3 class="center mt-3 mb-3">Chambres disponible</h3>
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3">
                        <?php foreach ($chambres as $chambre) { ?>
                            <div class="col">
                                <div class="p-2 border checkChambre chambre<?php echo ($chambre['ID_chambre']) ?>">
                                    <div class="form-check">
                                        <input class="form-check-input <?php if ($chambre['statut_chambre'] == 'En attente') echo ('checkBoxAttente');
                                                                        elseif ($chambre['statut_chambre'] == 'Occupée') echo ('checkBoxOccupee'); ?>" type="checkbox" name="ID_chambre[]" value="<?php echo ($chambre['ID_chambre']) ?>" <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('disabled') ?> id="checkbox_chambre <?php echo ($chambre['ID_chambre']) ?>">
                                        <!-- <label class="form-check-label align-middle" for="checkbox_chambre <?php echo ($chambre['ID_chambre']) ?>"><?php echo ($chambre['ID_chambre']) . ' : ' . number_format($chambre['tarif_chambre'], '0', '', ' ') . ' Ar' ?>
                                        </label> -->
                                        <div class="row">
                                            <label class="col form-check-label align-middle" for="checkbox_chambre <?php echo ($chambre['ID_chambre']) ?>"><?php echo ($chambre['ID_chambre']) . ' : ' . number_format($chambre['tarif_chambre'], '0', '', ' ') . ' Ar' ?>
                                            </label>
                                            <label class="col-auto form-check-label center" for="checkbox_chambre <?php echo ($chambre['ID_chambre']) ?>">
                                                <?php if ($chambre['statut_chambre'] == 'Libre') echo ('<i class="fas fa-tag text-success"></i>') ?>
                                                <?php if ($chambre['statut_chambre'] == 'En attente') echo ('<i class="fas fa-exclamation-triangle text-danger"></i>') ?>
                                                <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('<i class="fas fa-house-user text-secondary"></i>') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <script>
                                $(document).ready(function() {
                                    $(".chambre<?php echo ($chambre['ID_chambre']) ?>").hover(function() {
                                        $("#maChambre<?php echo ($chambre['ID_chambre']) ?>").toast('show');
                                    });
                                });
                            </script>

                            <div class="position-fixed bottom-0 start-0 p-3" style="z-index: 5">
                                <div id="maChambre<?php echo ($chambre['ID_chambre']) ?>" class="toast hide chambre-toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <strong class="me-auto">
                                            <div class="row">
                                                <div class="col-1 ms-2 center">
                                                    <?php if ($chambre['statut_chambre'] == 'Libre') echo ('<i class="fas fa-tag text-success"></i>') ?>
                                                    <?php if ($chambre['statut_chambre'] == 'En attente') echo ('<i class="fas fa-exclamation-triangle text-danger"></i>') ?>
                                                    <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('<i class="fas fa-house-user text-secondary"></i>') ?>
                                                </div>
                                                <div class="col text-start">Chambre n ° <?php echo ($chambre['ID_chambre']) ?></div>
                                            </div>
                                        </strong>
                                        <small><?php echo $chambre['statut_chambre'] ?></small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate quisquam <br> blanditiis minima? Ab at, velit vero architecto quisquam voluptas autem placeat quam! Facilis eveniet velit nobis debitis quia dolores doloremque?
                                    </div>
                                </div>
                            </div> -->

                        <?php } ?>
                    </div>
                </div>

                <!-- <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_attente">En attente</button>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_arrive">Arrivé</button>
                    </div>
                </div> -->

                <div class="container-fluid d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mx-2" name="btn_attente">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                En attente
                            </div>
                        </div>
                    </button>
                    <button type="submit" class="btn btn-primary mx-2" name="btn_arrive">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                Arrivé
                            </div>
                        </div>
                    </button>
                </div>

                <?php
                if (isset($validation)) : ?>
                    <div class="col-12 mt-3">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </form>
    </div>
</div>

<script>
    var dateDebut = new Date();
    document.getElementById('dateDebutSejour').valueAsDate = dateDebut;
    document.getElementById('dateFinSejour').valueAsDate = dateDebut;

    function calculNuit(dateDebut, dateFin) {
        var diff = {}
        var x = new Date(dateDebut);
        var y = new Date(dateFin);
        tmp = y - x;

        tmp = Math.floor(tmp / 1000); // Nombre de secondes entre les 2 dates
        diff.sec = tmp % 60; // Extraction du nombre de secondes

        tmp = Math.floor((tmp - diff.sec) / 60); // Nombre de minutes (partie entière)
        diff.min = tmp % 60; // Extraction du nombre de minutes

        tmp = Math.floor((tmp - diff.min) / 60); // Nombre d'heures (entières)
        diff.hour = tmp % 24;

        tmp = Math.floor((tmp - diff.hour) / 24);
        diff.day = tmp;

        document.getElementById('nbr_nuit').value = diff.day;
    }
</script>




