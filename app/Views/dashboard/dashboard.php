<!--DASHBOARD ADMIN-->
<?php include("modal/modalPlanning.php"); ?>
<?php include("modal/modalChambre.php"); ?>

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
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
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
                    backgroundColor: ["#283e51", "#ff5f6d", "#ffc371", "#4b79a1"],
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
        let data0 = result[0].map(function(e) {
            return e.reservation;
        });
        let data1 = result[1].map(function(e) {
            return e.reservation;
        });
        let label0 = result[0].map(function(e) {
            return e.week;
        });
        let label1 = result[1].map(function(e) {
            return e.week;
        });

        console.log(result[0]);
        console.log(result[1]);
        console.log(result[2]);

        new Chart(document.getElementById("myChart4"), {
            type: 'bar',
            data: {

                labels: label1,

                datasets: [{
                    label: "Day use",
                    data: data1,
                    backgroundColor: '#ff5f6d',
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
                        display: true,
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

        new Chart(document.getElementById("myChart5"), {
            type: 'bar',
            data: {
                labels: label0,
                datasets: [{
                        label: "Nuitée",
                        data: data0,
                        backgroundColor: '#283e51',
                        borderWidth: false,
                        radius: 1,
                        tension: 0,
                        barThickness: 7,
                    },

                ]
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
                        display: true,
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

    function planning2Display(result) {
        console.log(result);

        let calendarEl = document.getElementById('calendar2');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            height: "100%",
            locale: 'fr',
            resourceAreaWidth: "15%",
            resourceOrder: '',
            initialView: 'resourceTimelineMonth',
            headerToolbar: {
                left: 'resourceTimelineDay,resourceTimelineMonth,resourceTimelineYear',
                right: 'title',
            },
            footerToolbar: {
                left: 'today',
                right: 'prevYear prev,next nextYear',
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

    function calendrierData2() {
        $.ajax({
            url: 'planningChambre',
            type: 'post',
            dataType: 'JSON',
            data: {
                planning: 'planning'
            },

            success: function(data) {
                planning2Display(data);
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
                    $(document).ready(function() {
                        chart1Display(result);
                    });
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
                    $(document).ready(function() {
                        chart2Display(result);
                    });

                }
            })
        }
    }
</script>

<script>
    window.onload = function chargementPage() {
        $(document).ready(function() {
            calendrierData();
            calendrierData2();
            chartData('chart1');
            chartData('chart2');
            showDate();

            // $('#doughtnut-content').show('slow');
            // document.getElementById('doughtnut-content').style.opacity = 1;
            // document.getElementById('dash-calendar').style.opacity = 1;
            // document.getElementById('calendar').style.opacity = 1;
            // document.getElementById('dash-content').style.opacity = 1;
            // document.getElementById('dash-chart').style.opacity = 1;
        });

        // $('#myChart4').hide();
        // $('#myChart5').hide();
    }

    $(document).ready(function() {
        $('#sun').click(function() {
            $('#myChart4').slideDown('250');
            $('#myChart5').fadeOut('250');
        })
        $('#moon').click(function() {
            $('#myChart5').slideDown('250');
            $('#myChart4').fadeOut('250');
        })
    });

    // window.onload = function chargementPage() {
    //     calendrierData();
    //     chartData('chart1');
    //     chartData('chart2');
    // }
</script>



<div class="container-fluid mb-4">
    <!-- <div class="container-fluid p-3 mb-3 border bg-light bg-dashboard" style="height: 70vh;">
        <div id='calendar2'></div>
    </div> -->
    <div class="row g-3">
        <div class="col-lg-6 col-sm-12" id="doughtnut-content">
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
                            <h5 class="center">Mensuelles :
                                <?php echo ($nombresNuitDay) ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash2 height-dashboard container-fluid center">
                        <div class="text-light">
                            <span class="center mb-2" style="font-size: 2.5rem;"><i id="moon" class="fas fa-moon"></i></span>
                            <h5 class="center">Nuitée :
                                <?php echo (count($detailsNuit)) ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <div class="p-3 border bg-light bg-dashboard bg-dash3 height-dashboard container-fluid center">
                        <div style="color: black;">
                            <span class="center mb-2" style="font-size: 2.5rem;"><i id="sun" class="fas fa-sun"></i></span>
                            <h5 class="center">Day Use :
                                <?php echo (count($detailsDay)) ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-6 col-sm-12" id="dash-calendar">
            <div class="p-3 border bg-light bg-dashboard">
                <div id='calendar'></div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12" id="dash-content">
            <!-- <div class="container"> -->
            <div class="row gx-3 height-dashboard">
                <div class="col-6">
                    <div class="p-3 border bg-light bg-dashboard height-dashboard container-fluid">
                        <div style="overflow-y:scroll; height:100% !important">

                            <table class="table table-hover table-striped" id="result">
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="fab fa-slack-hash"></i></th>
                                        <!-- <th scope="col" class="text-start">Description</th>
                                        <th scope="col" class="text-end">Tarif (Ar)</th> -->
                                        <th scope="col" class="text-start">Chambres</th>
                                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                                            <th scope="col">Actions</th>
                                        <?php endif; ?>

                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <?php
                                    if (count($plannings) > 0) {

                                        foreach ($plannings as $chambre) {

                                    ?>
                                            <tr>
                                                <th scope="row"> <?php echo ($chambre['ID_chambre']) ?> </th>
                                                <!-- <td> <?php echo ($chambre['description_chambre']) ?> </td>
                                                <td class="text-end"> <?php echo number_format($chambre['tarif_chambre'], '0', '', ' ') . ' Ar' ?> </td> -->
                                                <td>
                                                    <div class="row">
                                                        <div class="col-1 ms-2 center">
                                                            <?php if ($chambre['statut_chambre'] == 'Libre') echo ('<i class="fas fa-tag text-success"></i>') ?>
                                                            <?php if ($chambre['statut_chambre'] == 'En attente') echo ('<i class="fas fa-exclamation-triangle text-danger"></i>') ?>
                                                            <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('<i class="fas fa-house-user text-secondary"></i>') ?>
                                                        </div>
                                                        <div class="col text-start"><?php echo ($chambre['nom']) ?></div>
                                                    </div>

                                                </td>
                                                <?php if (session()->get('isUser') == 'Administrateur') : ?>
                                                    <td>
                                                        <div class="center">
                                                            <div>
                                                                <?php if ($chambre['statut_chambre'] == 'Libre') { ?>
                                                                    <button disabled type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateChambreReservation('<?php echo $chambre['ID_chambre']; ?>', '<?php echo $chambre['ID_planning']; ?>', 'update')"><i class="fas fa-bed"></i></button>
                                                                    <!-- <button disabled type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreInfo" onclick="infoData('<?php echo $chambre['ID_chambre']; ?>')"><i class="fas fa-user"></i></button> -->
                                                                <?php  } ?>
                                                                <?php if ($chambre['statut_chambre'] == 'En attente' || $chambre['statut_chambre'] == 'Occupée') { ?>
                                                                    <button type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdateReservation" onclick="updateChambreReservation('<?php echo $chambre['ID_chambre']; ?>', '<?php echo $chambre['ID_planning']; ?>', 'update')"><i class="fas fa-bed"></i></button>
                                                                    <!-- <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreInfo" onclick="infoData('<?php echo $chambre['ID_chambre']; ?>')"><i class="fas fa-user"></i></button> -->
                                                                <?php  } ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <?php if (session()->get('isUser') == 'Administrateur') : ?>
                                                <td colspan="3">Tableau vide.</td>
                                            <?php else : ?>
                                                <td colspan="3">Tableau vide.</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>





                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row d-flex align-items-stretch" style="height: 100%">
                        <div class="col-12 mb-2">
                            <div class="p-3 col border bg-light bg-dashboard height-dashboard container-fluid center">
                                <div>
                                    <h5>
                                        <div id="heure_jour"></div>
                                    </h5>
                                    <a href="dashboard">
                                        <div class="center mt-2 mb-4"><img src="assets/images/hote.png" style="width: 60%;"></div>
                                    </a>
                                    <!-- <div class="container">
                                        <h5>
                                            <?php echo ($user['nom_user']) . ' ' . $user['prenom_user'] . ',' ?>
                                            <?php echo ($user['droit_user']) ?><br>
                                        </h5>
                                    </div> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="p-3 col border bg-light bg-dashboard height-dashboard container-fluid center">
                                <div>
                                    <a href="dashboard">
                                        <div class="center mt-2 mb-4"><img src="assets/images/login.png" style="width: 50%;"></div>
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
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="col-lg-6 col-sm-12" id="dash-chart">
            <div class="p-3 border bg-light bg-dashboard" style="height:100% !important">
                <h4>
                    <div class="row">
                        <div class="col text-start">Tendance des réservations</div>
                        <div class="col-1 center"><i class="fas fa-tag"></i></div>
                    </div>
                </h4>
                <!-- <div class="container-fluid d-flex justify-content-evenly row g-2">
                        <canvas class="bg-dark col-6" id="myChart4"></canvas>
                        <canvas class="bg-dark col-6" id="myChart5"></canvas>
                    </div> -->
                <div class="row canvas__chart d-flex align-items-center g-3" style="height: 100%;">
                    <canvas id="myChart4"></canvas>
                    <canvas id="myChart5"></canvas>
                </div>
            </div>
        </div>
    </div>

     <div class="container-fluid p-3 mt-3 border bg-light bg-dashboard" style="height: 70vh;">
        <div id='calendar2'></div>
    </div>
</div>

<!-- CHARTJS -->

<!-- DATE D'AUJOURD'HUI -->

<script>
    function refresh() {
        let t = 1000;
        setTimeout('showDate()', t);
    }

    function showDate() {
        var today = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        var time = today.toLocaleDateString(undefined, options) + " à " + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        document.getElementById('heure_jour').innerHTML = time;
        refresh();
    }
</script>