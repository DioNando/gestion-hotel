<?php include("assets/toast/myToast.php"); ?>

<div class="container">
    <div class="container-fluid formulaire">
        <h1 class="center mt-3 mb-3">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    Réservation day use
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-sun"></i>
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

                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="nom_client_day" class="form-label">Nom du client</label>
                        <input type="text" class="form-control" id="nom_client_day" name="nom_client_day" autocomplete="off">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="date_day" class="form-label">Date</label>
                        <input type="date" class="form-control" id="dateAujourdhui" name="date_day" readonly>
                        <script>
                            document.getElementById('dateAujourdhui').valueAsDate = new Date();
                        </script>
                    </div>
                </div>
                <div class="col-12 col-sm-4 mt-2">
                    <div class="form-group">
                        <label for="heure_arrive" class="form-label">Heure d'entrée</label>
                        <input type="time" class="form-control" id="heure_arrive" onchange="calculHeure(document.getElementById('heure_arrive').value, document.getElementById('heure_depart').value,);" name="heure_arrive">
                    </div>
                </div>
                <div class="col-12 col-sm-4 mt-2">
                    <div class="form-group">
                        <label for="heure_depart" class="form-label">Heure de sortie</label>
                        <input type="time" class="form-control" id="heure_depart" onchange="calculHeure(document.getElementById('heure_arrive').value, document.getElementById('heure_depart').value,);" name="heure_depart">
                    </div>
                </div>
                <div class="col-12 col-sm-4 mt-2">
                    <div class="form-group">
                        <label for="duree_day" class="form-label">Durée</label>
                        <input type="number" class="form-control" id="duree_day" name="duree_day" value="0" min="1" readonly>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="nom_user" class="form-label">Fait par :</label>
                        <input type="text" class="form-control" id="#" name="nom_user" value="<?= session()->get('nom_user') ?>" readonly>
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
                                        <!-- <label class="form-check-label align-middle" for="checkbox_chambre <?php echo ($chambre['ID_chambre']) ?>"><?php echo ($chambre['ID_chambre']) . ' : ' . number_format($chambre['tarif_chambre'], '0', '', ' ') . ' Ar' ?></label> -->
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
                        <?php } ?>
                    </div>
                </div>
                <!--Checkbox-->
                <!-- <div class="d-grid gap-2 col-6 mx-auto mt-3">
                    <button type="submit" class="btn btn-primary" name="btn_validation">Valider</button>
                </div> -->
                <div class="container-fluid d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mx-2" name="btn_validation">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                Valider
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
    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes();
    document.getElementById('heure_arrive').value = time;
    document.getElementById('heure_depart').value = time;

    function calculHeure(heure_arrive, heure_depart) {
        x = heure_arrive.split(':');
        y = heure_depart.split(':');

        let debut, fin, temps;

        debut = x[0] * 60 + parseInt(x[1]);
        fin = y[0] * 60 + parseInt(y[1]);

        temps = (fin - debut) / 60;
        if (temps < 0) {
            fin += 1440;
            temps = (fin - debut) / 60;
        };

        console.log(temps);
        temps = Math.round(temps);

        document.getElementById('duree_day').value = temps;
    }
</script>