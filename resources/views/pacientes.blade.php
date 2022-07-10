@extends('index')
@section('content')
<div class="container p-4" style="background-color: #C0C1C7;">
  <div class="row text-center t-4 gx-3">
    @for($i=0; $i < $count ; $i++)
      <div class=" mb-5 col-sm-4">
        <div class="card p-1" style="min-height: 280px; background-color: #ACB1BF;" id="card-main">
          <div class="row g-0 align-items-center">
            <div class="col-sm-4 card-image">
              <img src="{{ asset('images/bed.png') }}" class="img-fluid" width="80">
              <h5 class="card-title">{{  $fechas_actuales[$i]['nombre'] }}</h5>
            </div>
            <div class="col-sm-8 text-start">
              <div class="card-body">
                  <p class="card-text" style="font-size: 18px;">
                    <img src="{{ asset('images/heart2.png') }}" class="img-fluid" width="20">
                    {{  $fechas_actuales[$i]['pulso_cardiaco'] }} lpm
                  </p>
                <p class="card-text" style="font-size: 18px;">
                  <img src="{{ asset('images/termometro.png') }}" class="img-fluid" width="20">
                  {{  $fechas_actuales[$i]['temperatura'] }}°c</p>
                <p class="card-text">
                  <img src="{{ asset('images/oxigeno.png') }}" class="img-fluid" width="20">
                  {{  $fechas_actuales[$i]['oxigeno_sangre'] }}% Spo2</p>
                <div class="col-sm-12 text-center" style="font-size: 18px;">
                  <a href="{{ route('grafica.graficar', $fechas_actuales[$i]['paciente_id']) }}" 
                    class="btn" 
                    id="button-main"
                    ><b> Graficas </b></a>
                  <p class="card-text p-4"><small style="font-size: 14px;"><b>{{  $fechas_actuales[$i]['fecha'] }} {{  $fechas_actuales[$i]['hora'] }}</b></small></p>
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