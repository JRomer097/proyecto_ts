<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .scroll-bar{
            scrollbar-width: none;
            overflow-x: scroll;
            white-space: nowrap;
            overflow-y: hidden;
        }
        .scroll-bar-gra{
            scrollbar-width: none;
            overflow-y: scroll;
            white-space: nowrap;
            overflow-x: hidden;
        }
        
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.2.1/chartjs-plugin-zoom.min.js" integrity="sha512-klQv6lz2YR+MecyFYMFRuU2eAl8IPRo6zHnsc9n142TJuJHS8CG0ix4Oq9na9ceeg1u5EkBfZsFcV3U7J51iew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Diseño</title>
</head>
<body>
    <div class="row g-0" style="background-color: #F3F3F3;">
        <div class="row col-sm-8" style="background-color: #F3F3F3;">
            <div class="container" style="max-width: 800px; max-height: 500px;">
                <canvas id="myChart" width="800px" height="500px"></canvas>
            </div>

            <div class="container" style="max-width: 800px; max-height: 500px;">
                <canvas id="myChart2" width="800px" height="500px"></canvas>
            </div>

            <div class="container" style="max-width: 800px; max-height: 500px;">
                <canvas id="myChart3" width="800px" height="500px"></canvas>
            </div>
            <form action="{{ route('pruebas.paciente') }}">
                <input type="submit" 
                    class="btn btn-outline-success "
                    style="padding: 20px 10px;"
                    value="Regresar"
                    name = "fecha">
                </input>
            </form>
        </div>
        <div class="row-cols-1-justify-content-start col-sm-6 col-md-4 row g-0" style="background-color: #F3F3F3;">
            <div class="container row g-0 " style="height: 30%;">
                <div class="col-sm-4 align-items-center row">
                   <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png"  width="80" height="100">
                </div>
                <div class="col-sm-8 row container">
                    <div class="col-sm-8">
                        <span>Nombre: </span>
                        <p> {{ $datos->nombre }} </p>
                    </div>
                    <!-- <div class="w-100"></div> --> 

                    <div class="row">
                        <div class="col-sm-6">
                            <span>Edad: </span>
                            <p> {{ $datos->edad }} </p>
                        </div>

                        <div class="col-sm-6">
                            <span>Sangre: </span>
                            <p> {{ $datos->tipo_de_sangre }} </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <span>Peso: </span>
                            <p> {{ $datos->peso }}kg</p>
                        </div>

                        <div class="col-sm-6">
                            <span>Altura: </span>
                            <p> {{ $datos->altura }}m</p>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="container align-items-center p-2 scroll-bar" style="height: 20%;">
                <div class="text-center">
                    <form action=" {{ route('grafica.graficar_fecha', $datos) }} ">
                        @foreach($fechas as $fecha)
                            <input type="submit" 
                                    class="btn btn-light "
                                    style="padding: 20px 10px; font-size: 10px"
                                    value=" {{ $fecha -> fecha }} "
                                    name = "fecha">
                            </input>
                        @endforeach
                    </form>

                </div>
            </div>
            <div class="row container align-items-center" style="height: 50%;">
                <div class = "col-sm-12 text-center">
                    <span>Temperatura: </span>
                    <p>
                        @foreach($registro_actual as $registro)
                            {{ $registro -> temperatura }} 
                        @endforeach
                    </p>
				</div>

                <div class = "col-sm-12 text-center">
                    <span>Pulso Cardiaco: </span>
                    <p>
                        @foreach($registro_actual as $registro)
                            {{ $registro -> pulso_cardiaco }}
                        @endforeach
                    </p>
				</div>

                <div class = "col-sm-12 text-center ">
                    <span>Oxigenacion en la sangre: </span>
                    <p>
                        @foreach($registro_actual as $registro)
                            {{ $registro -> oxigeno_sangre }}
                        @endforeach
                    </p>
				</div>

            </div>
        </div>
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
                                'rgba(99, 202, 167, 1)'
                            ],
                            borderColor: [
                                'rgba(99, 202, 167, 1)'
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
                                        enabled: true,
                                        speed: .02
                                    },
                                    mode: 'x'
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
                                'rgba(99, 202, 167, 1)'
                            ],
                            borderColor: [
                                'rgba(99, 202, 167, 1)'
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
                                        enabled: true,
                                        speed: .02
                                    },
                                    mode: 'x'
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
                                'rgba(99, 202, 167, 1)'
                            ],
                            borderColor: [
                                'rgba(99, 202, 167, 1)'
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
                                suggestedMin: 80,
                                suggestedMax: 100,
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
                                        enabled: true,
                                        speed: .02
                                    },
                                    mode: 'x'
                                }
                            }
                        }
                    }
                });
    </script>