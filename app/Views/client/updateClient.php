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
        <div class="col-12 col-sm-12 mt-2">
            <div class="form-group">
                <label for="telephone_client" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" value="<?php echo ($info['telephone_client']); ?>" name="telephone_client">
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