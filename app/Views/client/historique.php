<div class="container-fluid">

    <div class="row my-3">
        <div class="col">
            <h4>
                <div class="row">
                    <div class="col-1 ms-2 center"><i class="fas fa-history"></i></div>
                    <div class="col text-start"><?php echo ($nom . ' ' . $prenom) ?></div>
                </div>

            </h4>
        </div>
        <div class="col-auto center"><button type="button" class="btn-close" onclick="closeNav()" aria-label="Close"></button></div>
    </div>
    <hr>

    <?php if (count($infos) > 0) : {
            foreach ($infos as $info) {
    ?>

                <!-- <p class="mt-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <?php echo ($info['date_reservation_nuit']) ?>
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                    </div>
                </div> -->


                <div class="accordion accordion-flush mb-3" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne<?php echo ($info['ID_nuit']) ?>">
                            <button class="accordion-button py-2 collapsed" style="background-color: #6190e8; color: white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo ($info['ID_nuit']) ?>" aria-expanded="false" aria-controls="flush-collapseOne<?php echo ($info['ID_nuit']) ?>">
                                <div class="row">
                                    <div class="col-1 ms-2 center"><i class="fas fa-calendar-alt"></i></div>
                                    <div class="col text-start"><?php echo ($info['date_reservation_nuit']) ?></div>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapseOne<?php echo ($info['ID_nuit']) ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne<?php echo ($info['ID_nuit']) ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Du : <?php echo ($info['debut_sejour']) ?> au : <?php echo ($info['fin_sejour']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo<?php echo ($info['ID_nuit']) ?>">
                            <button class="accordion-button py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo<?php echo ($info['ID_nuit']) ?>" aria-expanded="false" aria-controls="flush-collapseTwo<?php echo ($info['ID_nuit']) ?>">
                                <div class="row">
                                    <div class="col-1 ms-2 center"><i class="fas fa-moon"></i></div>
                                    <div class="col text-start">Réservation n ° <?php echo ($info['ID_nuit']) . ' de ' . $info['nbr_nuit'] . ' nuit' ?></div>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapseTwo<?php echo ($info['ID_nuit']) ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo<?php echo ($info['ID_nuit']) ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div>Pour <?php echo ($info['nbr_personne']) ?> personne(s)</div>
                                <?php foreach ($chambres as $chambre) {
                                    if ($chambre['ID_planning'] == $info['ID_planning']) { ?>
                                        <div>Chambres n ° : <?php echo ($chambre['ID_chambre']) ?></div>
                                <?php }
                                } ?>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree<?php echo ($info['ID_nuit']) ?>">
                            <button class="accordion-button py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree<?php echo ($info['ID_nuit']) ?>" aria-expanded="false" aria-controls="flush-collapseThree<?php echo ($info['ID_nuit']) ?>">
                                <div class="row">
                                    <div class="col-1 ms-2 center"><i class="fas fa-money-check"></i></div>
                                    <div class="col text-start">Facture</div>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapseThree<?php echo ($info['ID_nuit']) ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingThree<?php echo ($info['ID_nuit']) ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Facture n ° : <?php echo ($info['ID_facture_nuit']) ?><br>
                                Du : <?php echo ($info['date_facture_nuit']) ?><br>
                                Remise : <?php echo ($info['remise']) . '%' ?><br>
                                Payement : <?php echo ($info['type_payement_nuit']);
                                            $total = 0; ?>
                                <?php foreach ($chambres as $chambre) {
                                    if ($chambre['ID_planning'] == $info['ID_planning']) {
                                        $total = $total + $chambre['tarif_chambre'] * $info['nbr_nuit'];
                                ?>
                                <?php }
                                } ?>
                                <div><b> Total : <?php echo number_format($total - $total * $info['remise'] / 100, '0', '', ' ')  . ' Ar' ?></b></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>

            <?php }
        }
    else : { ?>
            <div class="center fixed-bottom mb-5 histo-close" onclick="closeNav()">
                <!-- <div class="center" onclick="closeNav()"> -->
                <div>
                    <div class="container center mb-4">
                        <h3>
                            Historique vide
                        </h3>
                    </div>
                    <div class="mb-4 mt-2">
                        <div class="center"><i style="font-size: 5rem;" class="far fa-calendar-times"></i></div>
                    </div>
                    <div class="container center">
                        <h3>
                            Fermer
                        </h3>
                    </div>
                </div>
            </div>
    <?php }
    endif ?>
</div>