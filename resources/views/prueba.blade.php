<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pagina Principal</title>
  </head>
<nav class="navbar navbar-expand-lg" style="background-color: #9FEDD7;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><b>Hospital el Hospitalito</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="true" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse show container-fluid" id="navbarNavAltMarkup" style="">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="{{ route('pruebas.paciente') }}">Pacientes</a>
            <a class="nav-link" href="{{ route('pacientes.index') }}">Administrar pacientes</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
    </div>
</nav>
<body>
  <div style="background-color: #EDEAE5;">
    <div class="container-sm p-4" style="background-color: #EDEAE5;">
          <div class="row row-cols-auto text-center">
              @foreach($id_pacientes as $paciente)
                <div class="card mb-5 col-sm-4" style="max-width: 540px;">
                  <div class="row g-0">
                    <div class="col-sm-4 ali">
                      <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" class="img-fluid rounded-end" alt="...">
                    </div>
                    <div class="col-sm-8">
                      <div class="card-body">
                        <h5 class="card-title">{{ $paciente->nombre }}</h5>
                        <p class="card-text">pulso</p>
                        <p class="card-text">temperatura</p>
                        <p class="card-text">oxigeno en la sangre</p>
                        <a href="{{ route('grafica.graficar', $paciente) }}"> graficas </a>
                        <p class="card-text"><small class="text-muted">25 de julio</small></p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          </div>
      </div>
  </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>