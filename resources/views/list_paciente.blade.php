@extends('layouts.app')
@section('content')
@if(auth()->user()->rol_id == 1 or auth()->user()->rol_id == 2)
<div>
    <div class="row">
        <div class="col-sm-10 max_auto container">
            <div class="text-center p-4 text-sm-end">
                <a 
                    class="btn" 
                    type="submit" 
                    style="background-color: #DADADA; color: black;"
                    href="{{ route('pacientes.add_paciente') }}">
                    <b>Agregar Paciente</b>
                </a>
            </div>
            <table class="table table-striped">
                <thead>
                    <th Scope = "Col">Nombre</th>
                    <th Scope = "Col">Apellido Paterno</th>
                    <th Scope = "Col">Apellido Materno</th>
                    <th Scope = "Col">Edad</th>
                    <th Scope = "Col">Peso</th>
                    <th Scope = "Col">Altura</th>
                    <th Scope = "Col">Tipo de sangre</th>
                    <th></th>
                </thead>
                <tbody>
                <tbody>
                    @foreach ($pacientes as $paciente)
                    <tr>
                        <td> {{$paciente->nombre}} </td>
                        <td> {{$paciente->apellido_paterno}} </td>
                        <td> {{$paciente->apellido_materno}} </td>
                        <td> {{$paciente->edad}} años</td>
                        <td> {{$paciente->peso}}kg </td>
                        <td> {{$paciente->altura}}m </td>
                        <td> {{$paciente->tipo_de_sangre}} </td>
                        <td>
                            <form class="pt-1" action=" {{ route('pacientes.destroy', $paciente) }}" method ="POST">
                                @method('DELETE')
                                @csrf
                                <input  type="submit" 
                                        value="Borrar" 
                                        class="btn btn-secondary btn-sm btn-table"
                                        onclick = "return confirm('¿Desea Eliminar al paciente {{ $paciente->nombre }}?')">
                            </form>
                            <form class="pt-1" action="{{ route('pacientes.graficar', $paciente) }}" method="POST"> 
                                @method('GET')
                                @csrf
                                <input type="submit" value="Graficar" class="btn btn-secondary btn-sm btn-table">
                            </form>
                            <form class="pt-1" action="{{ route('pacientes.edit', $paciente) }}" method="POST">
                                @method('GET')
                                @csrf
                                <input type="submit" value="editar" class="btn btn-secondary btn-sm btn-table">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection