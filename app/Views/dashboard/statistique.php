<!-- DEBUT -->

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

<div class="container">
    <div class="row g-2">
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light"><canvas id="myChart1"></canvas></div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light"><canvas id="myChart2"></canvas></div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light"><canvas id="myChart3"></canvas></div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="p-3 border bg-light"><canvas id="myChart4"></canvas></div>
        </div>
    </div>
</div>

<script>
    new Chart(document.getElementById("myChart1"), {
        type: 'bar',
        data: {
            labels: ["1900", "1950", "1999", "2050"],
            datasets: [{
                label: "Africa",
                backgroundColor: "#3e95cd",
                data: [133, 221, 783, 2478]
            }, {
                label: "Europe",
                backgroundColor: "#8e5ea2",
                data: [408, 547, 675, 734]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Population growth (millions)'
            }
        }
    });
</script>

<script>
    new Chart(document.getElementById('myChart2'), {
        type: 'doughnut',
        data: {
            labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                data: [2478, 5267, 734, 784, 433]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
            }
        }
    });
</script>

<script>
    new Chart(document.getElementById("myChart3"), {
        type: 'line',
        data: {
            labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
            datasets: [{
                data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                label: "Africa",
                borderColor: "#3e95cd",
                fill: false
            }, {
                data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
                label: "Asia",
                borderColor: "#8e5ea2",
                fill: false
            }, {
                data: [168, 170, 178, 190, 203, 276, 408, 547, 675, 734],
                label: "Europe",
                borderColor: "#3cba9f",
                fill: false
            }, {
                data: [40, 20, 10, 16, 24, 38, 74, 167, 508, 784],
                label: "Latin America",
                borderColor: "#e8c3b9",
                fill: false
            }, {
                data: [6, 3, 2, 2, 7, 26, 82, 172, 312, 433],
                label: "North America",
                borderColor: "#c45850",
                fill: false
            }]
        },
        options: {
            title: {
                display: true,
                text: 'World population per region (in millions)'
            }
        }
    });
</script>

<script>
    new Chart(document.getElementById("myChart4"), {
        type: 'bubble',
        data: {
            labels: "Africa",
            datasets: [{
                label: ["China"],
                backgroundColor: "rgba(255,221,50,0.2)",
                borderColor: "rgba(255,221,50,1)",
                data: [{
                    x: 21269017,
                    y: 5.245,
                    r: 15
                }]
            }, {
                label: ["Denmark"],
                backgroundColor: "rgba(60,186,159,0.2)",
                borderColor: "rgba(60,186,159,1)",
                data: [{
                    x: 258702,
                    y: 7.526,
                    r: 10
                }]
            }, {
                label: ["Germany"],
                backgroundColor: "rgba(0,0,0,0.2)",
                borderColor: "#000",
                data: [{
                    x: 3979083,
                    y: 6.994,
                    r: 15
                }]
            }, {
                label: ["Japan"],
                backgroundColor: "rgba(193,46,12,0.2)",
                borderColor: "rgba(193,46,12,1)",
                data: [{
                    x: 4931877,
                    y: 5.921,
                    r: 15
                }]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
            },
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Happiness"
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "GDP (PPP)"
                    }
                }]
            }
        }
    });
</script>



<!-- FIN -->