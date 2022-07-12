@extends('index')
@section('content')
<style>
    .scroll-bar {
        scrollbar-width: none;
        overflow-x: scroll;
        white-space: nowrap;
        overflow-y: hidden;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.2.1/chartjs-plugin-zoom.min.js" integrity="sha512-klQv6lz2YR+MecyFYMFRuU2eAl8IPRo6zHnsc9n142TJuJHS8CG0ix4Oq9na9ceeg1u5EkBfZsFcV3U7J51iew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="row" style="background-color: #f6f6f6;">

    <div class="row col-md-8" style="background-color: #f6f6f6;">
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

    <div class="col-sm-4 p-4 text-center">

        <div class="card mb-3" style="background-color: #a2b6ff;" id="card-main">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('images/user.png') }}" class="img-fluid rounded-start" width="80">
                </div>
                <div class="col-md-8">
                    <div class="card-body text-sm-start">
                        <h5 class="card-title">{{ $datos->nombre }}</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Edad</b></p>
                                <p class="card-text"> {{ $datos->edad }} </p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Sangre</b></p>
                                <p class="card-text"> {{ $datos->tipo_de_sangre }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Peso</b></p>
                                <p class="card-text"> {{ $datos->peso }}kg</p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Altura</b></p>
                                <p class="card-text"> {{ $datos->altura }}m</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="scroll-bar p-4">
            <form action=" {{ route('grafica.graficar_fecha', $datos) }} ">
                @foreach($fechas_day as $fecha)
                <button type="submit" class="btn btn-dark btn_graficas" value=" {{ $fecha -> fecha }} " name="fecha">
                    {{ $fecha -> dia }}
                </button>
                @endforeach
            </form>
        </div>


        <div class="card mb-3" style="background-color: #a2b6ff;" id="card-graph">
            <div class="row g-0 align-items-center p-2">
                <div class="col-sm-4 text-center">
                    <img src="{{ asset('images/termometro.png') }}" width="30">
                </div>
                <div class="col-sm-8">
                    @if($status == 0)
                    <div class="card-body text-sm-start">
                        <h5 class="card-title">Temperatura</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Maxima</b></p>
                                <p class="card-text">
                                    ??°c
                                </p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Minima</b></p>
                                <p class="card-text">
                                    ??°c
                                </p>
                            </div>
                        </div>
                        <div class="row text-sm-center">
                            <div class="col ">
                                <p class="card-text" style="margin:0;"><b>Promedio</b></p>
                                <p class="card-text">
                                    ??°c
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($temperatura_status as $registro)
                    <div class="card-body text-sm-start">
                        <h5 class="card-title">Temperatura</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Maxima</b></p>
                                <p class="card-text">
                                    {{ $registro -> max_temp }}°c
                                </p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Minima</b></p>
                                <p class="card-text">
                                    {{ $registro -> min_temp }}°c
                                </p>
                            </div>
                        </div>
                        <div class="row text-sm-center">
                            <div class="col ">
                                <p class="card-text" style="margin:0;"><b>Promedio</b></p>
                                <p class="card-text">
                                    {{ $registro -> avg_temp }}°c
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card mb-3" style="background-color: #a2b6ff;" id="card-graph">
            <div class="row g-0 align-items-center p-2">
                <div class="col-sm-4 text-center">
                    <img src="{{ asset('images/heart.png') }}" width="80">
                </div>
                <div class="col-sm-8">
                    @if($status == 0)
                    <div class="card-body text-sm-start">
                        <h5 class="card-title">Frecuencia Cardiaca</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Maxima</b></p>
                                <p class="card-text">
                                    ?? lpm
                                </p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Minima</b></p>
                                <p class="card-text">
                                    ?? lpm
                                </p>
                            </div>
                        </div>
                        <div class="row text-sm-center">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Promedio</b></p>
                                <p class="card-text">
                                    ?? lpm
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($heart_status as $registro)
                    <div class="card-body text-sm-start">
                        <h5 class="card-title">Frecuencia Cardiaca</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Maxima</b></p>
                                <p class="card-text">
                                    {{ $registro -> max_heart }} lpm
                                </p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Minima</b></p>
                                <p class="card-text">
                                    {{ $registro -> min_heart }} lpm
                                </p>
                            </div>
                        </div>
                        <div class="row text-sm-center">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Promedio</b></p>
                                <p class="card-text">
                                    {{ $registro -> avg_heart }} lpm
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card mb-3" style="background-color: #a2b6ff;" id="card-graph">
            <div class="row g-0 align-items-center p-2">
                <div class="col-sm-4 text-center ">
                    <img src="{{ asset('images/oxigeno.png') }}" width="100">
                </div>
                <div class="col-sm-8">
                    @if($status == 0)
                    <div class="card-body text-sm-start">
                        <h5 class="card-title">Oxigeno en la sangre</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Maxima</b></p>
                                <p class="card-text">
                                    ??% Spo2
                                </p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Minima</b></p>
                                <p class="card-text">
                                    ??% Spo2
                                </p>
                            </div>
                        </div>
                        <div class="row text-sm-center">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Promedio</b></p>
                                <p class="card-text">
                                    ??% Spo2
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($blood_status as $registro)
                    <div class="card-body text-sm-start">
                        <h5 class="card-title">Oxigeno en la sangre</h5>
                        <div class="row">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Maxima</b></p>
                                <p class="card-text">
                                    {{ $registro -> max_blood }}% Spo2
                                </p>
                            </div>
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Minima</b></p>
                                <p class="card-text">
                                    {{ $registro -> min_blood }}% Spo2
                                </p>
                            </div>
                        </div>
                        <div class="row text-sm-center">
                            <div class="col">
                                <p class="card-text" style="margin:0;"><b>Promedio</b></p>
                                <p class="card-text">
                                    {{ $registro -> avg_blood }}% Spo2
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    'rgba(7, 99, 122, 1)'
                ],
                borderColor: [
                    'rgba(7, 99, 122, 1)'
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
                        mode: 'x',
                        pinch: {
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
                    'rgba(7, 99, 122, 1)'
                ],
                borderColor: [
                    'rgba(7, 99, 122, 1)'
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
                    'rgba(7, 99, 122, 1)'
                ],
                borderColor: [
                    'rgba(7, 99, 122, 1)'
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