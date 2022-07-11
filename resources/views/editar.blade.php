@extends('index')
@section('content')
<div class="container">
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
@endsection