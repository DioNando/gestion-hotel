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
                left: 'resourceTimelineDay,resourceTimelineMonth,resourceTimelineYear',
                center: 'title',
                right: 'today prevYear prev,next nextYear',
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                year: 'Année',
                list: 'Liste',

            },

            resources: result[0],
            events: result[1],

            eventMouseEnter: function(info) {
                var res;
                var description_event = result[1].map(function(e) {
                    if (e.id == info.event.id) {
                        res = {"title" : e.client, "description" : e.description};
                        return 1;
                    }
                });

                $(info.el).popover({
                    title: res.title,
                    placement: 'top',
                    content: res.description,
                    container: 'body'
                }).popover('show');
            },

            eventMouseLeave: function(info) {
                $(info.el).popover('hide');
            }

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


        // $(document).ready(function() {
        //     $(".fc-datagrid-cell-main").replaceWith(
        //         "<span class=\"fc-datagrid-cell-main\">Chambres</span>"
        //     )
        // });
    }
</script>



<div class="container my-3 mx-3">
    <h3>Calendrier</h3>
</div>


<div class="container-fluid" id='calendar'></div>

<h3 class="center mt-3 mb-3">Disponibilité mensuelle des chambres</h3>
<div class="container mb-4">
    <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
        <?php foreach ($chambres as $chambre) { ?>
            <div class="g-3">

                <div class="checkChambre checkChambre-radius chambre border col-12 p-2">
                    <div class="planning-row">
                        <div><?php echo ($chambre['ID_chambre']) ?></div>
                        <div><?php echo ($chambre['debut_sejour'] . " - " . $chambre['fin_sejour']) ?></div>
                        <div>
                            <?php if ($chambre['motif'] == 'Nuitée') echo ('<i class="fas fa-moon text-dark"></i>') ?>
                            <?php if ($chambre['motif'] == 'Day use') echo ('<i class="fas fa-sun text-dark"></i>') ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>