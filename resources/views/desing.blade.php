<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.2.1/chartjs-plugin-zoom.min.js" integrity="sha512-klQv6lz2YR+MecyFYMFRuU2eAl8IPRo6zHnsc9n142TJuJHS8CG0ix4Oq9na9ceeg1u5EkBfZsFcV3U7J51iew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Graficas</title>
</head>

<body>
    <div class="container" style="max-width: 800px; max-height: 800px;">
        <canvas id="myChart" width="600" height="500"></canvas>
    </div>
    <div class="container" style="max-width: 800px; max-height: 800px;">
        <canvas id="myChart2" width="600" height="500"></canvas>
    </div>
    <div class="container" style="max-width: 800px; max-height: 800px;">
        <canvas id="myChart3" width="600" height="500"></canvas>
    </div>

</body>

</html>
<script>
    var cData = JSON.parse(`<?php echo $data_temp ?>`)
    const ctx = document.getElementById('myChart').getContext('2d');
    const chartTemperatura = new Chart(ctx, {
        type: 'line',
        data: {
            labels: cData.label_hora,
            datasets: [{
                label: 'Temperatura',
                data: cData.data_temperatura,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Temperatura'
                    },
                    suggestedMin: 30,
                    suggestedMax: 45,
                },
                x: {
                    title: {
                        display: true,
                        text: 'Horas'
                    }
                }
            },
            plugins: {
                zoom: {
                    zoom: {
                        wheel: {
                            enabled: true
                        }
                    }
                }
            }
        }
    });
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const chartTemperatura2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: cData.label_hora,
            datasets: [{
                label: 'Pulso Cardiaco',
                data: cData.data_pulso_cardiaco,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Pulso Cardiaco'
                    },
                    suggestedMin: 30,
                    suggestedMax: 45,
                },
                x: {
                    title: {
                        display: true,
                        text: 'Horas'
                    }
                }
            },
            plugins: {
                zoom: {
                    zoom: {
                        wheel: {
                            enabled: true
                        }
                    }
                }
            }
        }
    });
    const ctx3 = document.getElementById('myChart3').getContext('2d');
    const chartTemperatura3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: cData.label_hora,
            datasets: [{
                label: 'Oxigenacion en la sangre',
                data: cData.data_oxi_sangre,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Oxigenacion en la sangre'
                    },
                    suggestedMin: 30,
                    suggestedMax: 45,
                },
                x: {
                    title: {
                        display: true,
                        text: 'Horas'
                    }
                }
            },
            plugins: {
                zoom: {
                    zoom: {
                        wheel: {
                            enabled: true
                        }
                    }
                }
            }
        }
    });
</script>