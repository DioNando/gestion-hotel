<form action="#" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="ID_client" class="form-label">Identification</label>
                <input type="text" class="form-control" value="<?php echo ($info['ID_client']); ?>" name="ID_client" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="nom_client" class="form-label">Nom</label>
                <input type="text" class="form-control" value="<?php echo ($info['nom_client']); ?>" name="nom_client">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="prenom_client" class="form-label">Prénom</label>
                <input type="text" class="form-control" value="<?php echo ($info['prenom_client']); ?>" name="prenom_client">
            </div>
        </div>

        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Lieu de naissance</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Père</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Mère</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Profession</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Domicile habituel</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Nationalité</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Pièce d'identité</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">N°Piece</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Date de délivrance</label>
                <input type="date" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Lieu de délivrance</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Date fin de validité</label>
                <input type="date" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Venant de</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="#" class="form-label">Allant à</label>
                <input type="text" class="form-control" name="#">
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="p-2 border checkChambre">
                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="ancien_nouveau_tarif" id="ancien_tarif">
                    <label class="form-check-label align-middle" for="ancien_tarif">
                        Avion
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="ancien_nouveau_tarif" id="nouveau_tarif">
                    <label class="form-check-label align-middle" for="nouveau_tarif">
                        Train
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="ancien_nouveau_tarif" id="nouveau_tarif">
                    <label class="form-check-label align-middle" for="nouveau_tarif">
                        Auto
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="ancien_nouveau_tarif" id="nouveau_tarif">
                    <label class="form-check-label align-middle" for="nouveau_tarif">
                        Moto
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="ancien_nouveau_tarif" id="nouveau_tarif">
                    <label class="form-check-label align-middle" for="nouveau_tarif">
                        Bateau
                    </label>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary" id="btnSubmit" name="btn_modification">Modifier</button>
        </div>
        <div class="d-grid gap-2 mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
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