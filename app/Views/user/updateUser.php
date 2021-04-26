<form action="#" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="ID_user" class="form-label">Identification</label>
                <input type="text" class="form-control" value="<?php echo ($info['ID_user']); ?>" name="ID_user" readonly>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="nom_user" class="form-label">Nom</label>
                <input type="text" class="form-control" value="<?php echo ($info['nom_user']); ?>" name="nom_user">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="prenom_user" class="form-label">Prénom</label>
                <input type="text" class="form-control" value="<?php echo ($info['prenom_user']); ?>" name="prenom_user">
            </div>
        </div>
        <div class="form-group mt-2">
            <label class="form-label" for="">Droit d'accès</label>
            <select class="form-select" name="droit_user">
                <option <?php if ($info['droit_user'] == 'Utilisateur') echo ('selected'); ?> value="Utilisateur">Utilisateur</option>
                <option <?php if ($info['droit_user'] == 'Contrôleur') echo ('selected'); ?> value="Contrôleur">Contrôleur</option>
                <option <?php if ($info['droit_user'] == 'Administrateur') echo ('selected'); ?> value="Administrateur">Administrateur</option>
            </select>
        </div>

        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="mdp_user" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mdp_user" name="mdp_user">
            </div>
        </div>


           


        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="mdp_user_confirm" class="form-label">Confirmer mot de passe</label>
                <input type="password" class="form-control" id="mdp_user_confirm" name="mdp_user_confirm">
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