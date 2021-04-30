<!-- TOAST -->

<script>
    $(document).ready(function() {
        // $(".show-toast").click(function() {
        $("#myToast").toast('show');
        // });
    });
</script>

<!-- <div class="container mt-4">
        <button type="button" class="btn btn-primary show-toast">Show Toast</button>
    </div> -->

<?php if (session()->get('update') || session()->get('delete') || session()->get('success')) : ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div id="myToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <!-- <img src="assets/icons/stickies-fill.svg" class="me-2" alt="..."> -->
                <strong class="me-auto">Réussi</strong>
                <!-- <small>Modification</small> -->
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <!-- <div class="toast-body"> -->
            <?php if (session()->get('update')) : ?>
                <div class="toast-body alert alert-success alert-toast" role="alert">
                    <?= session()->get('update') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->get('delete')) : ?>
                <div class="toast-body alert alert-success alert-toast" role="alert">
                    <?= session()->get('delete') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->get('success')) : ?>
                <div class="toast-body alert alert-success alert-toast" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <!-- </div> -->
        </div>
    </div>
<?php endif; ?>

<?php if (isset($validation)) : ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div id="myToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <!-- <img src="assets/icons/stickies-fill.svg" class="me-2" alt="..."> -->
                <strong class="me-auto">Erreur</strong>
                <!-- <small>Suppression</small> -->
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <!-- <div class="toast-body"> -->
            <div class="toast-body alert alert-danger alert-toast alert-toast-danger" role="alert">
                <?= $validation->listErrors() ?>
            </div>
            <!-- </div> -->
        </div>
    </div>
<?php endif; ?>

<?php if (isset($validation_recherche)) : ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div id="myToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <!-- <img src="assets/icons/stickies-fill.svg" class="me-2" alt="..."> -->
                <strong class="me-auto">Erreur</strong>
                <small>Suppression</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <!-- <div class="toast-body"> -->
            <div class="toast-body alert alert-danger alert-toast alert-toast-danger" role="alert">
                <?= $validation_recherche->listErrors() ?>
            </div>
            <!-- </div> -->
        </div>
    </div>
<?php endif; ?>


<?php if (isset($chambres)) {
    foreach ($chambres as $chambre) { ?>
        <script>
            $(document).ready(function() {
                $(".chambre<?php echo ($chambre['ID_chambre']) ?>").hover(function() {
                    $("#maChambre<?php echo ($chambre['ID_chambre']) ?>").toast('show');
                }, function() {
                    $("#maChambre<?php echo ($chambre['ID_chambre']) ?>").toast('hide', 0);
                });
            });
        </script>

        <div class="position-fixed top-0 end-0 p-3" style="z-index: 5">
            <div id="maChambre<?php echo ($chambre['ID_chambre']) ?>" class="toast hide chambre-toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">
                        <div class="row">
                            <div class="col-1 ms-2 center">
                                <?php if ($chambre['statut_chambre'] == 'Libre') echo ('<i class="fas fa-tag text-success"></i>') ?>
                                <?php if ($chambre['statut_chambre'] == 'En attente') echo ('<i class="fas fa-exclamation-triangle text-danger"></i>') ?>
                                <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('<i class="fas fa-house-user text-secondary"></i>') ?>
                            </div>
                            <div class="col text-start">Chambre n ° <?php echo ($chambre['ID_chambre']) ?></div>
                        </div>
                    </strong>
                    <small><?php echo $chambre['statut_chambre'] ?></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo ($chambre['description_chambre']) ?>
                </div>
            </div>
        </div>
<?php }
} ?>




<!-- TOAST -->