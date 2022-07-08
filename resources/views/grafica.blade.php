@extends('index')
@section('content')
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.2.1/chartjs-plugin-zoom.min.js" integrity="sha512-klQv6lz2YR+MecyFYMFRuU2eAl8IPRo6zHnsc9n142TJuJHS8CG0ix4Oq9na9ceeg1u5EkBfZsFcV3U7J51iew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="row" style="background-color: #F3F3F3;">

    <div class="row col-md-8" style="background-color: #F3F3F3;">
        <div class="container p-4" style="max-width: 800px; max-height: 500px;">
            <canvas id="myChart" width="800px" height="500px"></canvas>
        </div>
        <div class="container p-4" style="max-width: 800px; max-height: 500px;">
            <canvas id="myChart2" width="800px" height="500px"></canvas>
        </div>
        <div class="container p-4" style="max-width: 800px; max-height: 500px;">
            <canvas id="myChart3" width="800px" height="500px"></canvas>
        </div>
    </div>

    <div class="col-sm-4 p-4">

        <div class="card mb-3" style="background-color: #F3F3F3;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('images/user.png') }}" class="img-fluid rounded-start" width="80">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $datos->nombre }}</h5>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text">Edad: </p>
                                    <p class="card-text"> {{ $datos->edad }} </p>
                                </div>
                                <div class="col">
                                    <p class="card-text">Sangre: </p>
                                    <p class="card-text"> {{ $datos->tipo_de_sangre }} </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text">Peso: </p>
                                    <p class="card-text"> {{ $datos->peso }}kg</p>
                                </div>
                                <div class="col">
                                    <p class="card-text">Altura: </p>
                                    <p class="card-text"> {{ $datos->altura }}m</p>
                                </div>
                            </div>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm text-center">
            <div class="col-sm-12 scroll-bar">
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

        <div class="card mb-3" style="background-color: #F3F3F3;">
            <div class="row g-0">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title">Temperatura</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Minima </p>
                                <p class="card-text"> ?? </p>
                            </div>
                            <div class="col">
                                <p class="card-text">Maxima </p>
                                <p class="card-text"> ?? </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Promedio: </p>
                                <p class="card-text">
                                @foreach($registro_actual as $registro)
                                    {{ $registro -> temperatura }} 
                                @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3" style="background-color: #F3F3F3;">
            <div class="row g-0">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title">Frecuencia Cardiaca</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Minima </p>
                                <p class="card-text"> ?? </p>
                            </div>
                            <div class="col">
                                <p class="card-text">Maxima </p>
                                <p class="card-text"> ?? </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Promedio: </p>
                                <p class="card-text">
                                @foreach($registro_actual as $registro)
                                    {{ $registro -> pulso_cardiaco }} 
                                @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3" style="background-color: #F3F3F3;">
            <div class="row g-0">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title">Oxigeno en la sangre</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Minima </p>
                                <p class="card-text"> ?? </p>
                            </div>
                            <div class="col">
                                <p class="card-text">Maxima </p>
                                <p class="card-text"> ?? </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Promedio: </p>
                                <p class="card-text">
                                @foreach($registro_actual as $registro)
                                    {{ $registro -> oxigeno_sangre }} 
                                @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

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
                borderWidth: 2
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
                borderWidth: 2
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
                borderWidth: 2
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
@endsection