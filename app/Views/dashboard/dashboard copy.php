<!--DASHBOARD ADMIN-->

<div class="container-fluid mt-3">

    <?php if (session()->get('isUser') == 'Administrateur') : ?>
        <h1>Tableau de bord, <?= session()->get('nom_user') ?></h1>

        <!--DASHBOARD USER-->
    <?php else : ?>
        <h1>Tableau de bord, <?= session()->get('nom_user') ?></h1>

    <?php endif ?>

</div>

<script>
    function planningDisplay(result) {
        console.log(result);

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            height: "100%",
            locale: 'fr',
            initialView: 'listWeek',
            headerToolbar: {
                left: '',
                center: '',
                right: 'title',
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

    function chart1Display(result) {
        let labels = result.map(function(e) {
            return e.statut;
        });
        let data = result.map(function(e) {
            return e.nombre;
        });

        console.log(labels);
        console.log(data);

        new Chart(document.getElementById('myChart2'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: "Statut des chambres",
                    backgroundColor: ["#c1e6ff", "#067eed", "#ff7c1f"],
                    data: data
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: 'Disponibilité des chambres'
                }
            }
        });
    }

    function chart2Display(result) {
        let labels = result.map(function(e) {
            return e.date;
        });
        let data = result.map(function(e) {
            return e.nombre;
        });
        let motif = result.map(function(e) {
            return e.motif;
        });

        console.log(result);
        // console.log(labels);
        // console.log(data);
        // console.log(motif);

        new Chart(document.getElementById("myChart4"), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Nuitée",
                    backgroundColor: "#067eed",
                    data: data
                }, {
                    label: "Day Use",
                    backgroundColor: "#c1e6ff",
                    data: data
                }]
            },
            options: {
                title: {
                    display: false,
                    text: 'Tendance des reservations'
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Line Chart'
                    }
                }
            },
        });
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

    function chartData(num_chart) {
        if (num_chart == 'chart1') {
            $.ajax({
                url: 'Planning',
                type: 'post',
                dataType: 'JSON',
                data: {
                    chart: num_chart
                },

                success: function(result) {
                    chart1Display(result);
                }
            })
        }

        if (num_chart == 'chart2') {
            $.ajax({
                url: 'Planning',
                type: 'post',
                dataType: 'JSON',
                data: {
                    chart: num_chart
                },

                success: function(result) {
                    chart2Display(result);
                }
            })
        }
    }
</script>

<script>
    window.onload = function chargementPage() {
        calendrierData();
        chartData('chart1');
        chartData('chart2');
    }
</script>


<div class="container">
    <div class="row g-2 mb-3">
        <div class="col-lg-5 col-sm-12">
            <div class="p-3" style="height: 500px;">
                <div class="row g-2" style="height: 100%;">
                    <div class="col-lg-12 col-sm-12">
                        <div class="p-3 border bg-light"><canvas id="myChart2"></canvas></div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="p-3 border bg-light center" style="height: 100%;">
                            <h3>Nuitée :
                                <?php echo (count($detailsNuit)) ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="p-3 border bg-light center" style="height: 100%;">
                            <h3>Day Use :
                                <?php echo (count($detailsDay)) ?></h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-12">
            <div class="p-3" id='calendar'></div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light" style="height: 100%;">


                <h3>
                    <div id="heure_jour"></div>
                </h3>

                <table class="table table-hover table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Droit</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <td><?php echo ($user['nom_user']) ?></td>
                        <td><?php echo ($user['prenom_user']) ?></td>
                        <td><?php echo ($user['droit_user']) ?></td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light"><canvas id="myChart4"></canvas></div>
        </div>
    </div>
</div>

<!-- CHARTJS -->

<script>

</script>

<script>

</script>

<!-- DATE D'AUJOURD'HUI -->

<script>
    var today = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };

    var time = today.toLocaleDateString(undefined, options) + " à " + today.getHours() + ":" + today.getMinutes();
    document.getElementById('heure_jour').innerHTML = time
</script>