@extends('index')
@section('content')
<div class="container p-4" style="background-color: #EDEAE5;">
  <div class="row text-center t-4 gx-3">
    @for($i=0; $i < $count ; $i++)
      <div class=" mb-5 col-sm-4">
        <div class="card p-2">
          <div class="row g-0 align-items-center">
            <div class="col-sm-4 card-image">
              <img src="{{ asset('images/bed.png') }}" class="img-fluid" width="80">
              <h5 class="card-title">{{  $fechas_actuales[$i]['nombre'] }}</h5>
            </div>
            <div class="col-sm-8 text-start">
              <div class="card-body">
                  <p class="card-text">
                    <img src="{{ asset('images/heart2.png') }}" class="img-fluid" width="20">
                    {{  $fechas_actuales[$i]['pulso_cardiaco'] }} lpm
                  </p>
                <p class="card-text">
                  <img src="{{ asset('images/termometro.png') }}" class="img-fluid" width="20">
                  {{  $fechas_actuales[$i]['temperatura'] }}°c</p>
                <p class="card-text">
                  <img src="{{ asset('images/oxigeno.png') }}" class="img-fluid" width="20">
                  {{  $fechas_actuales[$i]['oxigeno_sangre'] }}% Spo2</p>
                <div class="col-sm-12 text-center">
                  <a href="{{ route('grafica.graficar', $fechas_actuales[$i]['paciente_id']) }}" 
                    class="btn" 
                    style="background-color: #8ae0db; color: back; font-size: 18px;"
                    > Graficas </a>
                  <p class="card-text"><small class="text-muted">{{  $fechas_actuales[$i]['fecha'] }} {{  $fechas_actuales[$i]['hora'] }}</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endfor
  </div>
</div>
@endsection