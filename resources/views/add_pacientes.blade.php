@extends('index')
@section('content')
<div>
    <div class="row">
        <div class="col-sm-4 max-auto container p-4">
            <form action=" {{ route('pacientes.store') }} " method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input class="form-control" name="nombre" value="{{ old('nombre') }}">
                    <div class="form-text text-danger" id="nombre"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido Paterno</label>
                    <input class="form-control" name="apellido_paterno" value="{{ old('apellido_paterno') }}">
                    <div class="form-text text-danger" id="apellido_paterno"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido Materno</label>
                    <input class="form-control" name="apellido_materno" value="{{ old('apellido_materno') }}">
                    <div class="form-text text-danger" id="apellido_materno"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Edad</label>
                    <input class="form-control" name="edad" value="{{ old('edad') }}">
                    <div class="form-text text-danger" id="edad"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Peso</label>
                    <input class="form-control" name="peso" value="{{ old('peso') }}">
                    <div class="form-text text-danger" id="peso"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Altura</label>
                    <input class="form-control" name="altura" value="{{ old('altura') }}">
                    <div class="form-text text-danger" id="altura"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tipo de sangre</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected></option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <input class="form-control" name="tipo_de_sangre" value="{{ old('tipo_de_sangre') }}">
                    <div class="form-text text-danger" id="tipo_de_sangre"></div>
                </div>
                <div class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">Enviar</button>
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