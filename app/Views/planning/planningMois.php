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
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            height: "auto",
            locale: 'fr',
            resourceAreaWidth: "15%",
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste'
            },
            initialView: 'resourceTimelineMonth',
            resources: result[0],
            events: result[1],
        });
        calendar.render();
    }

    function calendrierData() {
        $.ajax({
            url: 'planningChambre',
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