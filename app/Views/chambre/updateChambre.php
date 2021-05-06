<form action="updateChambre" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="ID_chambre" class="form-label">Identification</label>
                <input type="text" class="form-control" value="<?php echo ($info['ID_chambre']) ?>" name="ID_chambre" readonly>
            </div>
        </div>


        <!-- <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="lit_supp" class="form-label">Lit supplémentaire</label>
                <input type="number" class="form-control" value="<?php ?>" min="0">
            </div>
        </div> -->
        <div class="col-12 col-sm-12 mt-2">
            <div class="form-group">
                <label for="descri_chambre" class="form-label">Description de la chambre</label>
                <textarea class="form-control" id="descri_chambre" name="description_chambre" rows="2"><?php echo ($info['description_chambre']) ?></textarea>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label class="form-label">Tarif avant</label>
                <input type="number" class="form-control" value="<?php echo ($info['tarif_ancien']) ?>" name="tarif_ancien" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label class="form-label">Tarif apres</label>
                <input type="number" class="form-control" value="<?php echo ($info['tarif_temp']) ?>" name="tarif_temp">
            </div>
        </div>
        <div class="form-group mt-2">
            <label class="form-label">Statut chambre</label>
            <select class="form-select" id="inputStatut_chambre" name="statut_chambre">
                <option <?php if ($info['statut_chambre'] == 'Libre') echo ('selected'); ?> value="Libre">Libre</option>
                <option <?php if ($info['statut_chambre'] == 'En attente') echo ('selected'); ?> value="En attente">En attente</option>
                <option <?php if ($info['statut_chambre'] == 'Occupée') echo ('selected'); ?> value="Occupée">Occupée</option>
            </select>
        </div>

        <!-- <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary" id="btnSubmit" name="btn_modification">Modifier</button>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div> -->

        <div class="container">
            <hr class="my-3">
            <div class="row center mx-2">
                <button class="col-4 mx-3 center btn btn-secondary" type="button" data-bs-dismiss="modal">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Annuler
                        </div>
                    </div>
                </button>
                <button class="col-4 mx-3 center btn btn-primary" type="submit" id="btnSubmit" name="btn_modification">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Modifier
                        </div>
                    </div>
                </button>
            </div>
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