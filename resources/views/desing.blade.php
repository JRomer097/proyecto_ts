<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Graficas</title>
</head>
<body>
    <div class="container" style="max-width: 1000px; max-height: 1000px;">
        <canvas id="myChart" width="600" height="500"></canvas>
            <script>
            var cData = JSON.parse(`<?php echo $data ?>`)
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: cData.label,
                    datasets: [{
                        label: 'Temperatura',
                        data: cData.data,
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
                            zooming: true,
                            title: {
                                display: true,
                                text: 'Temperatura'
                            },
                            suggestedMin: 30,
                            suggestedMax: 45,
                            type: 'linear'
                        },
                        x: {
                            zooming: true,
                            title: {
                                display: true,
                                text: 'Horas'
                            }
                        },
                        scroll:{

                        }
                        
                    }
                }
            });
            </script>
    </div>
</body>
</html>