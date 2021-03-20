<div class="modal fade" id="modalUserUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="ID_user" class="form-label">Identification</label>
                                <input type="text" class="form-control" id="inputID_user" name="ID_user" readonly>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label for="nom_user" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="inputNom_user" name="nom_user">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Droit d'accès</label>
                            <select class="form-select" name="droit_user">
                                <option selected value="Utilisateur">Utilisateur</option>
                                <option value="Administrateur">Administrateur</option>
                            </select>
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
            </div>

        </div>
    </div>
</div>

<!-- DELETE -->

<div class="modal fade" id="modalUserDelete" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Suppression</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment effacer la ligne <b id="innerIDdel"></b> ?</p>
                <form action="#" method="post">
                    <div class="mb-2" style="display: none;">
                        <label for="ID_user" class="form-label">Identification</label>
                        <input type="text" class="form-control" id="inputIDdel" name="ID_user" readonly>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-danger" id="btnDelete" name="btn_suppression">Effacer</button>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    function updateData(ID_user, nom_user) {
        document.getElementById('inputID_user').value = ID_user;
        document.getElementById('inputNom_user').value = nom_user;
        document.getElementById('btnDelete').value = "Modifier";
    }

    function deleteData(ID_user) {
        document.getElementById('innerIDdel').innerHTML = ID_user;
        document.getElementById('inputIDdel').value = ID_user;
        document.getElementById('btnDelete').value = "Effacer";
    }
</script>