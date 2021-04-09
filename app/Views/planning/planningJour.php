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

<script>
    window.onload = function chargementPage() {
        calendrierData();
    }
</script>

<div class="container-fluid">
    <table class="table table-hover table-striped table-light" id="result">
        <thead>
            <tr>
                <th scope="col">N° des chambres</th>
                <th scope="col">Motif</th>
                <th scope="col">Client</th>
                <th scope="col">Date d'arrivé</th>
                <th scope="col">Date départ</th>
                <th scope="col">Durée</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Surplus</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody class="align-middle">

            <?php
            if (count($chambres) > 0) {
                foreach ($chambres as $chambre) { ?>

                    <tr>
                        <th scope="row"><?php echo ($chambre['ID_chambre']); ?></th>
                        <td><?php echo ($chambre['motif']); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    

                <?php
                }
            } else {
                ?>
                <tr>
                    <?php if (session()->get('isUser') == 'Administrateur') : ?>
                        <td colspan="9">Tableau vide.</td>
                    <?php else : ?>
                        <td colspan="9">Tableau vide.</td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div class="container-fluid" id='calendar'></div>