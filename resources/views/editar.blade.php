@extends('layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<div>
    <div class="row">
        <div class="col-sm-4 max-auto container p-4">
            <form action="{{ route('pacientes.update', $paciente) }}" method = "POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input class="form-control" name="nombre" value="{{ $paciente->nombre }}">
                    <div class="form-text text-danger" id="nombre"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido Paterno</label>
                    <input class="form-control" name="apellido_paterno" value="{{ $paciente->apellido_paterno }}">
                    <div class="form-text text-danger" id="apellido_paterno"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido Materno</label>
                    <input class="form-control" name="apellido_materno" value="{{ $paciente->apellido_materno }}">
                    <div class="form-text text-danger" id="apellido_materno"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Fecha</label>
                    <input  autocomplete="off" 
                            class="form-control" 
                            name="fecha_nacimiento" 
                            placeholder="YYYY-MM-DD" 
                            type="text" 
                            value="{{ $paciente->fecha_nacimiento }}"
                            />
                    <div class="form-text text-danger" id="fecha_nacimiento"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Peso</label>
                    <input class="form-control" name="peso" value="{{ $paciente->peso }}">
                    <div class="form-text text-danger" id="peso"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Altura</label>
                    <input class="form-control" name="altura" value="{{ $paciente->altura }}">
                    <div class="form-text text-danger" id="altura"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tipo de sangre</label>
                    <select class="form-select" name="tipo_de_sangre" id="tipo_de_sangre" type="text">
                        <option value="{{ $paciente->tipo_de_sangre }}" selected>{{ $paciente->tipo_de_sangre }}</option>
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
                    @method('PUT')
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
<script>
    $(document).ready(function() {
        var date_input = $('input[name="fecha_nacimiento"]');
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })
</script>

@endsection