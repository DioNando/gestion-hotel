<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">RESERVATION HEURE</h1>
        <form action="" method="post">
            <div class="row">
                <div class="col-12">
                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                </div>
               
                
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="date_passage" class="form-label">Date</label>
                        <input type="date" class="form-control" id="#" name="date_passage">
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="heure_passage" class="form-label">Heure</label>
                        <input type="time" class="form-control" id="#" name="heure_passage">
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="duree_passage" class="form-label">Durée</label>
                        <input type="number" class="form-control" id="#" name="duree_passage" value="1" min="1">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="nom_user" class="form-label">Fait par :</label>
                        <input type="text" class="form-control" id="#" name="nom_user" value="<?= session()->get('nom_user') ?>" readonly>
                    </div>
                </div>
                <!--Checkbox-->
                <h3 class="center mt-3">Chambres disponible</h3>
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3">
                        <?php foreach ($chambres as $chambre) { ?>
                            <div class="col">
                                <div class="p-2 border checkChambre">
                                    <div class="form-check">
                                        <input class="form-check-input <?php if ($chambre['statut_chambre'] == 'En attente') echo ('checkBoxAttente');
                                                                        elseif ($chambre['statut_chambre'] == 'Occupée') echo ('checkBoxOccupee'); ?>" type="checkbox" name="ID_chambre[]" value="<?php echo($chambre['ID_chambre']) ?>" <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('disabled') ?> id="checkbox_chambre <?php echo($chambre['ID_chambre']) ?>">
                                        <label class="form-check-label align-middle" for="checkbox_chambre <?php echo($chambre['ID_chambre']) ?>"><?php echo ($chambre['ID_chambre']) . ' : ' . ($chambre['statut_chambre']) ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!--Checkbox-->
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary" name="btn_reservation">Valider</button>
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