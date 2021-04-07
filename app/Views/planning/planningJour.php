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

<div class="container-fluid" id='calendar'></div>