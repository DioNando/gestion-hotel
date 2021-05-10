<?php include("modal/modalPlanning.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

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
            resourceAreaWidth: "10%",
            resourceOrder: '',
            initialView: 'resourceTimelineMonth',
            headerToolbar: {
                left: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth',
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
        // document.getElementById('calendar').style.opacity = 1;        
    }
</script>

<h3 class="center mt-3 mb-3">Disponibilité mensuelle des chambres</h3>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-6 g-2 g-lg-3">
        <?php foreach ($chambres as $chambre) { ?>
            <div class="g-3">

                <div class="checkChambre checkChambre-radius chambre border col-12 p-2">
                    <div class="row">
                        <label class="col form-check-label align-middle ms-3 text-start" for="checkbox_chambre <?php echo ($chambre['ID_chambre']) ?>"><?php echo ($chambre['ID_chambre']) ?>
                        </label>
                        <label class="col-auto form-check-label center me-3" for="checkbox_chambre <?php echo ($chambre['ID_chambre']) ?>">
                            <?php if ($chambre['motif'] == 'Nuitée') echo ('<i class="fas fa-moon text-dark"></i>') ?>
                            <?php if ($chambre['motif'] == 'Day use') echo ('<i class="fas fa-sun text-dark"></i>') ?>
                        </label>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="container my-3 mx-3">
    <h3>Calendrier</h3>
</div>


<div class="container-fluid mb-4" id='calendar'></div>