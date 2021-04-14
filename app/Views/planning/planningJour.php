<div class="container-fluid mt-3 mb-3">
    <h1>Planning du Jour</h1>
</div>

<script>
    function planningDisplay(result) {
        console.log(result);

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            initialView: 'listWeek',
            headerToolbar: {
                left: 'listWeek,timeGridWeek,timeGridDay',
                center: 'title',
                right: 'today prev,next',
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste',
            },
            events: result,
        });
        calendar.render();

    }

    function calendrierData() {
        $.ajax({
            url: 'Planning',
            type: 'post',
            dataType: 'JSON',
            data: {
                planning: 'planning'
            },

            success: function(data) {
                planningDisplay(data);
            }
        })
    }
</script>

<!-- AJAX POUR AFFICHER LE TABLEAU -->

<script>
    function tabPlanningJour() {
        $(document).ready(function() {

            // if (info == 'infoDay') {
            $.ajax({
                url: 'tabPlanningJour',
                type: 'post',
                // dataType: 'JSON',

                success: function(data) {
                    $('#tabPlanningJour').html(data);
                    // console.log(data);
                }
            })
            // }
        });
    }
</script>

<script>
    window.onload = function chargementPage() {
        calendrierData();
        // tabPlanningJour();
    }
</script>

<div class="container-fluid" id="tabPlanningJour">
    <table class="table table-hover table-striped table-light">
        <thead>
            <tr>
                <th scope="col">N° des chambres</th>
                <th scope="col">Motif</th>
                <th scope="col">Client</th>
                <th scope="col">Date d'arrivé</th>
                <th scope="col">Date départ</th>
                <th scope="col">Durée</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Montant</th>
                <th scope="col">Surplus</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody class="align-middle">

            <?php
            if (count($plannings) > 0) {
                foreach ($plannings as $planning) { ?>

                    <tr>
                        <th scope="row"><?php echo ($planning['ID_chambre']); ?></th>
                        <td><?php echo ($planning['motif']); ?></td>
                        <td><?php echo ($planning['nom']); ?></td>
                        <td><?php echo ($planning['debut']); ?></td>
                        <td><?php echo ($planning['fin']); ?></td>
                        <td><?php echo ($planning['duree']); ?></td>
                        <td><?php echo ($planning['commentaire']); ?></td>
                        <td><?php echo ($planning['montant']); ?></td>
                        <td><?php echo ($planning['surplus']); ?></td>
                        <td><?php echo ($planning['total']); ?></td>

                    <?php
                }
            } else {
                    ?>
                    <tr>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <td colspan="10">Tableau vide.</td>
                        <?php else : ?>
                            <td colspan="10">Tableau vide.</td>
                        <?php endif; ?>
                    </tr>
                <?php
            }
                ?>
        </tbody>
    </table>

</div>

<div class="container-fluid mb-4" id='calendar'></div>