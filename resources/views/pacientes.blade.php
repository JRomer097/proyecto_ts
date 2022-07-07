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
          @foreach($fechas_actuales as $fechas_actual)
          {{ $fechas_actual -> edad }}
          @endforeach
      </div>
  </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>