<!-- DEBUT -->

<script>
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
            chartData('chart1');
            chartData('chart2');
        });
    }
</script>

<div class="container-fluid mt-3 mb-3">

    <!-- <h1>Statistique</h1> -->
    <h1>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Statistique
            </div>
        </div>
    </h1>

</div>

<div class="container mb-3">
    <div class="row p-2 g-3">
        <div class="col-12 mb-1 stat__sub p-3 border bg-light bg-dashboard">
            <div class="p-3">
                <canvas id="myChart4"></canvas>
            </div>
            <div class="p-3">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus aut id itaque commodi, tenetur odio nobis harum repellendus repellat possimus dolores. Repellat pariatur cupiditate ducimus eveniet ex enim natus illo.
            </div>
        </div>
        <div class="col-12 mb-1 stat__sub p-3 border bg-light bg-dashboard">
            <div class="p-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente animi modi necessitatibus itaque voluptas dicta! Corporis, sequi repellat expedita, fugiat tempora blanditiis provident enim deserunt inventore, temporibus ad velit incidunt.
            </div>
            <div class="p-3">
                <canvas id="myChart5"></canvas>
            </div>
        </div>
        <div class="col-12 mb-1 stat__sub p-3 border bg-light bg-dashboard">
            <div class="p-3">
                <canvas id="myChart2"></canvas>
            </div>
            <div class="p-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente animi modi necessitatibus itaque voluptas dicta! Corporis, sequi repellat expedita, fugiat tempora blanditiis provident enim deserunt inventore, temporibus ad velit incidunt.
            </div>

        </div>

    </div>

</div>

<!-- FIN -->