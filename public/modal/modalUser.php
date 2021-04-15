<!-- MODIFICATION -->

<div class="modal fade" id="modalUserUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalUpdateUser">

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
    // function updateData(ID_user, nom_user, prenom_user, droit_user) {
    //     document.getElementById('inputID_user').value = ID_user;
    //     document.getElementById('inputNom_user').value = nom_user;
    //     document.getElementById('inputPrenom_user').value = prenom_user;
    //     document.getElementById('inputDroit_user').value = droit_user;
    //     document.getElementById('btnDelete').value = "Modifier";
    // }

    function deleteData(ID_user) {
        document.getElementById('innerIDdel').innerHTML = ID_user;
        document.getElementById('inputIDdel').value = ID_user;
        document.getElementById('btnDelete').value = "Effacer";
    }

    function updateUser(ID_user, type) {
        $(document).ready(function() {

            if (type == 'update') {
                $.ajax({
                    url: 'User',
                    type: 'post',
                    data: {
                        ID_user: ID_user,
                        type: type,
                    },

                    success: function(data) {
                        $('#modalUpdateUser').html(data);
                    }
                })
            }
        });
    }
</script>