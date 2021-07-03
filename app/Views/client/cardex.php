<div class="container">
    <div id="ficheCardex">

        <h2 class="center"><?php echo ('Cardex ' . $client['nom_client']) . ' ' . $client[('prenom_client')] ?></h2>

        <h3>Hotel</h3>
        <div>Rue 2 Toamasina</div>
        <div>Mail : hotel@mail.mg</div>
        <div>Téléphone : +261 34 00 000 01</div>

        <hr class="my-3">

        <div>Nom : <?php echo ($client['nom_client']) ?> </div>
        <div>Prénoms : <?php echo ($client['prenom_client']) ?> </div>
        <div>Date de naissance : <?php echo ($client['date_naissance']) ?> </div>
        <div>Lieu de naissance : <?php echo ($client['lieu_naissance']) ?> </div>
        <div>Père : <?php echo ($client['pere_client']) ?> </div>
        <div>Mère : <?php echo ($client['mere_client']) ?> </div>
        <div>Profession : <?php echo ($client['profession']) ?> </div>
        <div>Domicile habituel : <?php echo ($client['domicile_habituel']) ?> </div>
        <div>Nationalité : <?php echo ($client['nationalite']) ?> </div>
        <div>Pièce d'identité : <?php echo ($client['piece_identite']) ?> </div>
        <div>N° Pièce : <?php echo ($client['num_piece_identite']) ?> </div>
        <div>Date de délivrance : <?php echo ($client['date_delivrance']) ?> </div>
        <div>Lieu de délivrance : <?php echo ($client['lieu_delivrance']) ?> </div>
        <div>Date fin de validité : <?php echo ($client['date_fin_validite']) ?> </div>
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
                pdf.save("<?php echo ('Cardex ' . $client['nom_client'] . ' ' . date('d-m-y H-i')) ?>");
            },
            margins
        )
    });
</script>