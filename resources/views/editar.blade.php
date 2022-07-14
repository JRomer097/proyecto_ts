@extends('index')
@section('content')
<div>
    <div class="row">
        <div class="col-sm-4 max-auto container p-4">
            <form action="{{ route('pacientes.update', $datos) }}">
                @method('PATCH')
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input class="form-control" name="nombre" value="{{ $datos->nombre }}">
                    <div class="form-text text-danger" id="nombre"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido Paterno</label>
                    <input class="form-control" name="apellido_paterno" value="{{ $datos->apellido_paterno }}">
                    <div class="form-text text-danger" id="apellido_paterno"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido Materno</label>
                    <input class="form-control" name="apellido_materno" value="{{ $datos->apellido_materno }}">
                    <div class="form-text text-danger" id="apellido_materno"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Edad</label>
                    <input class="form-control" name="edad" value="{{ $datos->edad }}">
                    <div class="form-text text-danger" id="edad"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Peso</label>
                    <input class="form-control" name="peso" value="{{ $datos->peso }}">
                    <div class="form-text text-danger" id="peso"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Altura</label>
                    <input class="form-control" name="altura" value="{{ $datos->altura }}">
                    <div class="form-text text-danger" id="altura"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tipo de sangre</label>
                    <select class="form-select" name="tipo_de_sangre" id="tipo_de_sangre" type="text">
                        <option value="{{ $datos->tipo_de_sangre }}" selected>{{ $datos->tipo_de_sangre }}</option>
                        <option value="O+">O+</option>
                        <option value="O+-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                    <div class="form-text text-danger" id="tipo_de_sangre"></div>
                </div>
                <div class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-primary" onclick="return confirm('¿Desea modificar esta información?')">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->any())
<script>
    const mensajes = JSON.parse(`<?php echo $errors ?>`)
    document.getElementById("nombre").innerHTML = mensajes.nombre;
    document.getElementById("apellido_paterno").innerHTML = mensajes.apellido_paterno;
    document.getElementById("apellido_materno").innerHTML = mensajes.apellido_materno;
    document.getElementById("edad").innerHTML = mensajes.edad;
    document.getElementById("peso").innerHTML = mensajes.peso;
    document.getElementById("altura").innerHTML = mensajes.altura;
    document.getElementById("tipo_de_sangre").innerHTML = mensajes.tipo_de_sangre;
</script>
@endif
@endsection