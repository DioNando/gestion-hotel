<form action="#" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="ID_nuit" class="form-label">Identification</label>
                <input type="text" class="form-control" value="<?php echo($info['ID_nuit']) ?>" name="ID_nuit" readonly>
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