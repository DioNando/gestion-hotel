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