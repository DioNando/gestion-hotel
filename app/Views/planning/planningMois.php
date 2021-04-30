<?php include("modal/modalPlanning.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <!-- <h1>Planning du Mois</h1> -->
    <h1>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Planning du Mois
            </div>
        </div>
    </h1>
</div>

<script>
    function planningDisplay(result) {
        console.log(result);

        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            // themeSystem: 'bootstrap',
            height: "auto",
            locale: 'fr',
            initialView: 'dayGridMonth',
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste'
            },
            events: result,
            eventClick: function(info) {

                let ID_unique, motif_unique;
                let ID_reservation = result.map(function(e) {
                    if (e.id == info.event.id) {
                        ID_unique = e.ID_reservation;
                        motif_unique = e.motif;
                        return e.ID_reservation;
                    }
                });

                    $(document).ready(function() {
                        $.ajax({
                            url: 'ajaxPlanning',
                            type: 'post',
                            data: {
                                ID_planning: info.event.id,
                                ID_reservation: ID_unique,
                                motif: motif_unique
                            },

                            success: function(result) {
                                $('#modalPlanningJour').html(result);
                            }
                        })
                        $('#modalPlanning').modal('show');

                    });
        
                // $.ajax({
                //     url: 'ajaxPlanning',
                //     type: 'post',
                //     data: {
                //         ID_planning: info.event.id,
                //         ID_reservation: ID_unique,
                //         motif: motif_unique
                //     },

                //     success: function(result) {
                //         $('#modalPlanningJour').html(result);
                //     }
                // })
                // $('#modalPlanning').modal('show');

            }
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

<h3 class="center mt-3 mb-3">Disponibilité mensuelle des chambres</h3>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3">
        <?php foreach ($chambres as $chambre) { ?>
            <div class="g-3">

                <div class="btn border bg-light col-12">
                    <div>
                        <?php echo ($chambre['ID_chambre']) . ' : ' . ($chambre['motif']) ?>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
</div>

<div class="mt-4 mb-2 center">
    <h3>Calendrier</h3>
</div>


<div class="container-fluid mb-4" id='calendar'></div>