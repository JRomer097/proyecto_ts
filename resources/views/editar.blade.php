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
    <div>
        <form action="{{ route('pacientes.update', $datos) }}">
            @method('PACTH')
            <div>
                <label for="">Nombre: </label>
                <input name="nombre_p" value="{{ $datos->nombre_p }}">
            </div>
            <div>
                <label for="">Apellido Paterno: </label>
                <input name="apellidoP_p" value="{{ $datos->apellidoP_p }}">
            </div>
            <div>
                <label for="">Apellido Materno: </label>
                <input name="apellidoM_p" value="{{ $datos->apellidoM_p }}">
            </div>
            <div>
                <label for="">Edad: </label>
                <input name="edad" value="{{ $datos->edad }}">
            </div>
            <div>
                <label for="">Peso: </label>
                <input name="peso" value="{{ $datos->peso }}">
            </div>
            <div>
                <label for="">Altura: </label>
                <input name="altura" value="{{ $datos->altura }}">
            </div>
            <div>
                <label for="">Tipo de sangre: </label>
                <input name="tipo_de_sangre" value="{{ $datos->tipo_de_sangre }}">
            </div>
            <div>
                @csrf
                <input type="submit" value="Guardar">
            </div>
        </form>
    </div>
</body>
</html>