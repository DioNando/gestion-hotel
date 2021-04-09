<div class="container-fluid mt-3 mb-3">
    <h1>Planning du Mois</h1>
</div>

<script>
    function planningDisplay(result) {
        console.log(result);

        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
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

    // document.addEventListener('DOMContentLoaded', function() {
    //     let calendarEl = document.getElementById('calendar');
    //     let calendar = new FullCalendar.Calendar(calendarEl, {
    //         height: "auto",
    //         locale: 'fr',
    //         initialView: 'dayGridMonth',
    //         buttonText: {
    //             today: 'Aujourd\'hui',
    //             month: 'Mois',
    //             week: 'Semaine',
    //             day: 'Jour',
    //             list: 'Liste'
    //         },
    //         events: evenements,
    //     });
    //     calendar.render();
    // });
</script>




<div class="container-fluid" id='calendar'></div>