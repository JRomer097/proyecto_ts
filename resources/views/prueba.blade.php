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
            <a class="nav-link active" aria-current="page" href="#">Pacientes</a>
            <a class="nav-link" href="#">Administrar Pacientes</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
    </div>
</nav>
<body>
    <div class="" style="background-color: #EDEAE5;">
        <div class="row row-cols-auto text-center">
            @php
                $cont = 0
            @endphp
            @foreach($pacientes_inf as $paciente)
                <div class="col-sm-4">
                    {{ $paciente -> nombre }} 
                </div>
                @php $cont = $cont + 1 @endphp
                @if($cont == 3)
                    <div class="w-100"></div>
                    @php $cont = 0 @endphp
                @endif
            @endforeach
        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>