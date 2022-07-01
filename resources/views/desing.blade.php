<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="path/to/chartjs/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8hammerjs@2.0.8"></script>
    <script src="path/to/chartjs-plugin-zoom/dist/chartjs-plugin-zoom.min.js"></script>
    <title>Graficas</title>
</head>
<body>
    <div class="container" style="max-width: 800px; max-height: 800px;">
            <canvas id="myChart" width="600" height="500"></canvas>
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
                        }
                    }
                });
                </script>
    </div>
    <div class="container" style="max-width: 800px; max-height: 800px;">
            <canvas id="chartCardio" width="600" height="500"></canvas>
                <script>
                var zData = JSON.parse(`<?php echo $data_car ?>`)
                const ctx2 = document.getElementById('chartCardio').getContext('2d');
                const chartCardio = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: zData.label_hora,
                        datasets: [{
                            label: 'Pulso Cardiaco',
                            data: zData.data_pulso_cardiaco,
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
                        }
                    }
                });
                </script>
    </div>

</body>
</html>