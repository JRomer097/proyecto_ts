<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <title>Pagina Principal</title>
  </head>
<nav class="navbar navbar-expand-lg" style="background-color: #8ae0db;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#"><b>Hospital el Hospitalito</b></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('pruebas.index') }}">Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pacientes.paciente') }}">Administrar pacientes</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn" type="submit" style="background-color: #8c8c8c; color: white;">Buscar</button>
      </form>
    </div>
  </div>
</nav>
<body>
  <div style="background-color: #EDEAE5;">
    <div class="container-sm p-4" style="background-color: #EDEAE5;">
      <div class="row row-cols-auto text-center p-3 gap-auto">
        @for($i=0; $i < $count ; $i++)
         <div class="card mb-5 col-sm-4 p-4">
            <div class="row g-0 align-items-center">
              <div class="col-sm-4 card-image">
                  <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" class="img-fluid" width="80">
                  <h5 class="card-title">{{  $fechas_actuales[$i]['nombre'] }}</h5>
              </div>
              <div class="col-sm-8">
                  <div class="card-body">
                    <p class="card-text">{{  $fechas_actuales[$i]['pulso_cardiaco'] }} lpm</p>
                    <p class="card-text">{{  $fechas_actuales[$i]['temperatura'] }}°c</p>
                    <p class="card-text">{{  $fechas_actuales[$i]['oxigeno_sangre'] }}% Spo2</p>
                    <a href="{{ route('grafica.graficar', $fechas_actuales[$i]['paciente_id']) }}" class="btn"> graficas </a>
                    <p class="card-text"><small class="text-muted">{{  $fechas_actuales[$i]['fecha'] }} {{  $fechas_actuales[$i]['hora'] }}</small></p>
                  </div>
              </div>
            </div>
        </div>
        @endfor
      </div>    
    </div>
  </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>