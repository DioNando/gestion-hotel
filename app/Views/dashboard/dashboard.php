<!--DASHBOARD ADMIN-->

<div class="container-fluid mt-3 mb-3">

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
            // height: "100%",
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

        new Chart(document.getElementById('myChart2'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: "Statut des chambres",
                    backgroundColor: ["#6190E8", "#c1e6ff", "#ff7c1f"],
                    data: data
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Disponibilité des chambres'
                },
                legend: {
                    display: true,
                    position: 'top',
                    // align: 'start'
                },
            }
        });
    }



    function chart2Display(result) {
        let data1 = result.map(function(e) {
            // if (e.motif == 'Nuitée')
            //     return e.reservation;
        });
        let data2 = result.map(function(e) {
            // if (e.motif == 'Day use')
            //     return e.reservation;
            for (i = 1; i < 8; i++) {
                if (e.week == i)
                    return e.reservation;
                else
                    return 0;
            }
        });

        let labels = result.map(function(e) {
            return e.week;
        });

        console.log(result);
        console.log(data1);
        console.log(data2);

        new Chart(document.getElementById("myChart4"), {
            type: 'line',
            data: {
                // labels: labels,
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                // labels: ['1', '2', '3', '4', '5', '6', '7'],
                datasets: [{
                        label: "Nuitée",
                        data: ['5', '2', '2', '4', '0', '6', '1'],
                        borderColor: '#ff7c1f',
                        backgroundColor: 'rgba(255, 255, 255, 0.5)',
                        // fill: false,
                        borderWidth: 5,
                        radius: 2,
                        tension: 0,
                        
                        // data: data1
                    }, {
                        label: "Day Use",
                        data: ['1', '2', '0', '2', '7', '1', '5'],
                        borderColor: '#6190E8',
                        backgroundColor: 'rgba(255, 255, 255, 0.5)',
                        // fill: false,
                        borderWidth: 5,
                        radius: 2,
                        tension: 0,

                        // data: data2
                    },


                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Tendance des reservations'
                },
                responsive: true,
                legend: {
                    display: true,
                    position: 'top',
                    align: 'end'
                },
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

<div class="container-fluid mb-4">
    <div class="row g-3">
        <div class="col-lg-6 col-sm-12">
            <!-- <div class="container"> -->
            <div class="row gx-3" style="height: 100%;">
                <div class="col-12">
                    <div class="p-3 border bg-light bg-dashboard height-dashboard center"><canvas id="myChart2"></canvas></div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash1 height-dashboard center">
                        <h5>Réservations :
                            <?php echo (count($detailsNuit) + count($detailsDay)) ?></h5>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash2 height-dashboard center">
                        <h5>Nuitée :
                            <?php echo (count($detailsNuit)) ?></h5>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash3 height-dashboard center">
                        <h5>Day Use :
                            <?php echo (count($detailsDay)) ?></h5>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light bg-dashboard">
                <div class="p-3" id='calendar'></div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <!-- <div class="container"> -->
            <div class="row gx-3 height-dashboard">
                <div class="col-6">
                    <div class="p-3 border bg-light bg-dashboard height-dashboard">
                        <h3>
                            <div id="heure_jour"></div>
                        </h3>
                        <a href="dashboard">
                            <div class="center"><img src="assets/images/logo-hotel.png" style="width: 70%;"></div>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 border bg-light bg-dashboard height-dashboard">
                        <a href="dashboard">
                            <div class="center"><img src="assets/images/admin.png" style="width: 70%;"></div>
                        </a>
                        <div class="container">
                            <!-- <table class="table table-light">
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
                            </table> -->
                            <h5>
                                <?php echo ($user['nom_user']) . ' ' . $user['prenom_user'] . ',' ?>
                                <?php echo ($user['droit_user']) ?><br>
                            </h5>
                        </div>

                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light bg-dashboard center"><canvas id="myChart4"></canvas></div>
        </div>
    </div>
</div>

<!-- CHARTJS -->

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