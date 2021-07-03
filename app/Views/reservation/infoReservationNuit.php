<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col" class="text-start">Type de réservation</th>
            <th scope="col">Nombre de personne</th>
            <th scope="col" class="text-start">Remarque</th>
            <th scope="col" class="text-start">Date de création</th>
            <!-- <th scope="col">Utilisateur</th> -->
            <th scope="col" class="text-start">Dernière modification</th>
            <!-- <th scope="col">Utilisateur</th> -->
        </tr>
    </thead>
    <tbody class="align-middle">

        <tr>
            <td class="text-start"> <?php echo ($info['type_reservation']); ?> </td>
            <td class="text-center"> <?php echo ($info['nbr_personne']); ?> </td>
            <td> <?php echo ($info['remarque_reservation']); ?> </td>
            <td class="text-start"> <?php echo ($info['date_reservation_nuit'] . ' par ' . $info['nom_user']); ?> </td>
            <!-- <td> <?php echo ($info['nom_user']); ?> </td> -->
            <td class="text-start"> <?php echo ($info['date_modif'] . ' par ' . $info['nom_user_modif']); ?> </td>
            <!-- <td> <?php echo ($info['nom_user_modif']); ?> </td> -->
        </tr>

    </tbody>
</table>


<div class="accordion" id="accordionExample">
    <div class="accordion-item accordion-hotel">
        <h5 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h3>Fiche d'hôtel</h3>
            </button>
        </h5>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body pb-0">
                <div id="ficheCardex">
                    <h3 class="center">REPOBLIKAN'I MADAGASIKARA</h3>

                   
                    <h3>Hotel</h3>
                   
                    <div>Rue 2 Toamasina</div>
                    <div>Mail : hotel@mail.mg</div>
                    <div>Téléphone : +261 34 00 000 01</div>
                    <hr class="my-3">

                    <div class="col-6">CHAMBRE N° : <?php foreach ($chambres as $row) {
                                                        echo ($row['ID_chambre']) . ' - ';
                                                    } ?></div>
                    <hr class="my-3">

                    <h5 class="center">FICHE D'HOTEL</h5>

                    <div>Nom : <?php echo ($info['nom_client']) ?> </div>
                    <div>Prénoms : <?php echo ($info['prenom_client']) ?> </div>
                    <div>Date de naissance : <?php echo ($info['date_naissance']) ?> </div>
                    <div>Lieu de naissance : <?php echo ($info['lieu_naissance']) ?> </div>
                    <div>Père : <?php echo ($info['pere_client']) ?> </div>
                    <div>Mère : <?php echo ($info['mere_client']) ?> </div>
                    <div>Profession : <?php echo ($info['profession']) ?> </div>
                    <div>Domicile habituel : <?php echo ($info['domicile_habituel']) ?> </div>
                    <div>Nationalité : <?php echo ($info['nationalite']) ?> </div>
                    <div>Pièce d'identité : <?php echo ($info['piece_identite']) ?> </div>
                    <div>N° Pièce : <?php echo ($info['num_piece_identite']) ?> </div>
                    <div>Date de délivrance : <?php echo ($info['date_delivrance']) ?> </div>
                    <div>Lieu de délivrance : <?php echo ($info['lieu_delivrance']) ?> </div>
                    <div>Date fin de validité : <?php echo ($info['date_fin_validite']) ?> </div>
                    <div>Venant de : <?php echo ($info['venant_de']) ?> </div>
                    <div>Allant à : <?php echo ($info['allant_a']) ?> </div>
                    <div>Mode de transport : <?php echo ($info['mode_transport']) ?> </div>


                    <div class="row mt-4 mb-5">
                        <div class="col-6">Signature du déclarant</div>
                        <div class="col-6">
                            <div>Toamasina le ..............................</div>
                            <div>Vérifié exact par le receptionniste</div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="container">
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
                    <button class="col-4 mx-3 center btn btn-primary" type="button" class="btn btn-primary" id="imprimer">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-print"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                Exporter
                            </div>
                        </div>
                    </button>
                </div>
            </div>


        </div>
    </div>
</div>
</div>

<script>
    $('#imprimer').click(function() {
        var pdf = new jsPDF('p', 'pt', 'letter'),
            source = $('#ficheCardex')[0],
            specialElementHandlers = {
                '#bypassme': function(element, renderer) {
                    return true
                }
            }

        margins = {
            top: 40,
            bottom: 60,
            left: 40,
            right: 40,
            width: '100%'
        };
        pdf.fromHTML(
            source, margins.left, margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers,
            },
            function(dispose) {
                pdf.save("<?php echo ('Cardex ' . $info['nom_client'] . ' ' . date('d-m-y H-i')) ?>");
            },
            margins
        )
    });
</script>