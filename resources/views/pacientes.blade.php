@extends('layouts.app')
@section('content')
<div class="container p-4" style="background-color: #f6f6f6;">
  <div class="row text-center t-4 gx-3">
    @for($i=0; $i < $count ; $i++)
      <div class=" mb-5 col-sm-4">
        <div class="card p-1" style="min-height: 280px; background-color: #d4d7e0;" id="card-main">
          <div class="row g-0 align-items-center">
            <div class="col-sm-4 card-image">
              <img src="{{ asset('images/bed.png') }}" class="img-fluid" width="80">
              <h5 class="card-title">{{  $fechas_actuales[$i]['nombre'] }}</h5>
            </div>
            <div class="col-sm-8">
              <div class="card-body">
                <div class="row container p-1">
                  <div class="col-sm-4">
                    <img src="{{ asset('images/heart.png') }}" class="img-fluid" width="25">
                  </div>
                  <div class="col-sm-8">
                    <p class="card-text text-sm-start" style="font-size: 18px;">
                      {{  $fechas_actuales[$i]['pulso_cardiaco'] }} lpm
                    </p>
                  </div>
                </div>
                <div class="row container p-1">
                  <div class="col-sm-4">
                    <img src="{{ asset('images/termometro.png') }}" class="img-fluid" width="10">
                  </div>
                  <div class="col-sm-8">
                    <p class="card-text text-sm-start" style="font-size: 18px;">
                      {{  $fechas_actuales[$i]['temperatura'] }}°c</p>
                    <p class="card-text">
                  </div>
                </div>
                <div class="row container p-1">
                  <div class="col-sm-4">
                    <img src="{{ asset('images/oxigeno.png') }}" class="img-fluid" width="30">
                  </div>
                  <div class="col-sm-8">
                    <p class="card-text text-sm-start">
                      {{  $fechas_actuales[$i]['oxigeno_sangre'] }}% Spo2
                    </p>
                  </div>
                </div>
                <div class="row p-4">
                  <div class="col">
                    <a href="{{ route('pacientes.graficar', $fechas_actuales[$i]['paciente_id']) }}" 
                    class="btn" 
                    id="button-main">
                    <b> Gráficas </b>
                    </a>
                  </div>
                </div>
                <div class="row p-1">
                  <div class="col">
                    <p class="card-text">
                      <small style="font-size: 14px;">
                      <b>{{  $fechas_actuales[$i]['fecha'] }} {{  $fechas_actuales[$i]['hora'] }}</b>
                      </small>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endfor
  </div>
  <div>
  </div>
</div>
@endsection