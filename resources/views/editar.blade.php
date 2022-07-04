<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <div class="container row">
        <div class="col-sm-2">
            <form action="{{ route('pacientes.update', $datos) }}">
                @method('PACTH')
                <div>
                    <label for="" class="form-label">Nombre: </label>
                    <input name="nombre" value="{{ $datos->nombre }}" class="form-control">
                </div>  
                <div>
                    <label for="" class="form-label">Apellido Paterno: </label>
                    <input name="apellido_paterno" value="{{ $datos->apellido_paterno }}" class="form-control">
                </div>
                <div>
                    <label for="" class="form-label">Apellido Materno: </label>
                    <input name="apellido_materno" value="{{ $datos->apellido_materno }}" class="form-control">
                </div>
                <div>
                    <label for="" class="form-label">Edad: </label>
                    <input name="edad" value="{{ $datos->edad }}" class="form-control">
                </div>
                <div>
                    <label for="" class="form-label">Peso: </label>
                    <input name="peso" value="{{ $datos->peso }}" class="form-control">
                </div>
                <div>
                    <label for="" class="form-label">Altura: </label>
                    <input name="altura" value="{{ $datos->altura }}" class="form-control">
                </div>
                <div>
                    <label for="" class="form-label">Tipo de sangre: </label>
                    <input name="tipo_de_sangre" value="{{ $datos->tipo_de_sangre }}" class="form-control">
                </div>
                <div>
                    @csrf
                    <input type="submit" value="Guardar" class="form-control">
                </div>
            </form>
        </div>

    </div>
</body>
</html>