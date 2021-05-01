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
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" value="<?php echo ($info['date_naissance']); ?>" name="date_naissance">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
                <input type="text" class="form-control" value="<?php echo ($info['lieu_naissance']) ?>" name="lieu_naissance">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="pere_client" class="form-label">Père</label>
                <input type="text" class="form-control" value="<?php echo ($info['pere_client']); ?>" name="pere_client">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="mere_client" class="form-label">Mère</label>
                <input type="text" class="form-control" value="<?php echo ($info['mere_client']) ?>" name="mere_client">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="profession" class="form-label">Profession</label>
                <input type="text" class="form-control" value="<?php echo ($info['profession']) ?>" name="profession">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="domicile_habituel" class="form-label">Domicile habituel</label>
                <input type="text" class="form-control" value="<?php echo ($info['domicile_habituel']) ?>" name="domicile_habituel">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="nationalite" class="form-label">Nationalité</label>
                <input type="text" class="form-control" value="<?php echo ($info['nationalite']) ?>" name="nationalite">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="piece_identite" class="form-label">Pièce d'identité</label>
                <input type="text" class="form-control" value="<?php echo ($info['piece_identite']) ?>" name="piece_identite">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="num_piece_identite" class="form-label">N°Piece</label>
                <input type="text" class="form-control" value="<?php echo ($info['num_piece_identite']) ?>" name="num_piece_identite">
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="date_delivrance" class="form-label">Date de délivrance</label>
                <input type="date" class="form-control" value="<?php echo ($info['date_delivrance']) ?>" name="date_delivrance">
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="lieu_delivrance" class="form-label">Lieu de délivrance</label>
                <input type="text" class="form-control" value="<?php echo ($info['lieu_delivrance']) ?>" name="lieu_delivrance">
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="date_fin_validite" class="form-label">Date fin de validité</label>
                <input type="date" class="form-control" value="<?php echo ($info['date_fin_validite']) ?>" name="date_fin_validite">
            </div>
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