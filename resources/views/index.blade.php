<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <title>Pagina Principal</title>
  </head>
<body>
  <nav class="navbar navbar-expand-lg" style="background-color: #a2b6ff;" id="nav-tex">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand"><b>Hospital el Hospitalito</b></a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" id="nav-tex" href="{{ route('pacientes.index') }}" style="font-size: 20px;">Pacientes</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link active" id="nav-tex" href="{{ route('pacientes.paciente') }}" style="font-size: 20px;">Administrar pacientes</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn" type="submit" style="background-color: #DADADA; color: black;"><b>Buscar</b></button>
        </form>
      </div>
    </div>
  </nav>
  <div style="background-color: #f6f6f6;">
    @yield('content')
  </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>