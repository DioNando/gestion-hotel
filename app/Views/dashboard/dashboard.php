<!--DASHBOARD ADMIN-->
<?php include("modal/modalPlanning.php"); ?>

<div class="container-fluid mt-3 mb-3">

    <?php if (session()->get('isUser') == 'Administrateur' || session()->get('isUser') == 'Contrôleur') : ?>
        <h1>
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    Tableau de bord, <?= session()->get('nom_user') ?>
                </div>
            </div>
        </h1>
        <!--DASHBOARD USER-->
    <?php else : ?>
        <h1>
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    Tableau de bord, <?= session()->get('nom_user') ?>
                </div>
            </div>
        </h1>

    <?php endif ?>

</div>

<script>
    function planningDisplay(result) {
        // console.log(result);

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // height: "100%",
            // themeSystem: 'bootstrap',

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
            eventClick: function(info) {

                let ID_unique, motif_unique;
                let ID_reservation = result.map(function(e) {
                    if (e.id == info.event.id) {
                        ID_unique = e.ID_reservation;
                        motif_unique = e.motif;
                        return e.ID_reservation;
                    }
                });

                // alert('Event: ' + ID_unique + motif_unique);

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
            }
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
                    data: data,
                    borderWidth: false,
                }],
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: 'Disponibilité des chambres'
                },
                legend: {
                    display: true,
                    position: 'top',
                    align: 'start',
                    labels: {
                        boxWidth: 50,
                        usePointStyle: true,
                        pointStyle: 'cross',
                    }
                },
            }
        });
    }



    function chart2Display(result) {
        let data1 = result.map(function(e) {
            if (e.motif == 'Nuitée')
                return e.reservation;
            else
                return null;
        });
        let data2 = result.map(function(e) {
            if (e.motif == 'Day use')
                return e.reservation;
            else
                return null;
        });

        let labels = result.map(function(e) {
            return e.week;
        });

        // console.log(result[0].week);

        console.log(result);
        console.log(data1);
        console.log(data2);

        new Chart(document.getElementById("myChart4"), {
            type: 'bar',
            data: {
                labels: labels.sort(),
                // labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                // labels: ['1', '2', '3', '4', '5', '6', '7'],
                // labels: [0, 1, 2, 3, 4, 5, 6],
                datasets: [{
                    label: "Nuitée",
                    data: data1,
                    // data: ['5', '2', '2', '4', '0', '6', '1'],
                    // fill: false,
                    // borderColor: '#ff7c1f',
                    // backgroundColor: 'rgba(255, 152, 79, 0.5)',
                    backgroundColor: '#ff7c1f',
                    // borderWidth: 4,
                    borderWidth: false,
                    radius: 1,
                    tension: 0,
                    barThickness: 7,
                }, {
                    label: "Day Use",
                    data: data2,
                    // data: ['1', '2', '0', '2', '7', '1', '5'],
                    // fill: false,
                    // borderColor: '#6190E8',
                    // backgroundColor: 'rgba(140, 180, 255, 0.5)',
                    backgroundColor: '#6190E8',
                    // borderWidth: 4,
                    borderWidth: false,
                    radius: 1,
                    tension: 0,
                    barThickness: 7,
                }, ]
            },
            options: {
                title: {
                    display: false,
                    text: 'Tendance des reservations'
                },
                responsive: true,
                legend: {
                    display: true,
                    position: 'top',
                    align: 'end',
                },
                scales: {
                    xAxes: [{
                        display: false,
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        display: false,
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
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

<div class="container-fluid mb-4">
    <div class="row g-3">
        <div class="col-lg-6 col-sm-12">
            <!-- <div class="container"> -->
            <div class="row gx-3" style="height: 100%;">
                <div class="col-12">
                    <div class="p-3 border bg-light bg-dashboard height-dashboard">
                        <h4>
                            <div class="row">
                                <div class="col text-start">Disponibilité des chambres</div>
                                <div class="col-1 center"><i class="fas fa-house-user"></i></div>
                            </div>
                        </h4>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash1 height-dashboard container-fluid center">
                        <div>
                            <span class="center mb-2" style="font-size: 2.5rem;"><i class="fas fa-tags"></i></span>
                            <h5 class="center">Réservations :
                                <?php echo ($nombresNuitDay) ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash2 height-dashboard container-fluid center">
                        <div style="color: white;">
                            <span class="center mb-2" style="font-size: 2.5rem;"><i class="fas fa-moon"></i></span>
                            <h5 class="center">Nuitée :
                                <?php echo (count($detailsNuit)) ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash3 height-dashboard container-fluid center">
                        <div style="color: black;">
                            <span class="center mb-2" style="font-size: 2.5rem;"><i class="fas fa-sun"></i></span>
                            <h5 class="center">Day Use :
                                <?php echo (count($detailsDay)) ?></h5>
                        </div>
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
                    <div class="p-3 border bg-light bg-dashboard height-dashboard container-fluid center">
                        <div>
                            <h3>
                                <div id="heure_jour"></div>
                            </h3>
                            <a href="dashboard">
                                <div class="center"><img src="assets/images/logo-hotel.png" style="width: 70%;"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 border bg-light bg-dashboard height-dashboard container-fluid center">
                        <div>
                            <a href="dashboard">
                                <div class="center"><img src="assets/images/admin.png" style="width: 70%;"></div>
                            </a>
                            <div class="container">
                                <h5>
                                    <?php echo ($user['nom_user']) . ' ' . $user['prenom_user'] . ',' ?>
                                    <?php echo ($user['droit_user']) ?><br>
                                </h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light bg-dashboard">
                <h4>
                    <div class="row">
                        <div class="col text-start">Tendance des réservations</div>
                        <div class="col-1 center"><i class="fas fa-tag"></i></div>
                    </div>
                </h4>
                <canvas id="myChart4"></canvas>
            </div>
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