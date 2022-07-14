@extends('index')
@section('content')
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
                    @foreach ($pacientes as $pas)
                    <tr>
                        <td> {{$pas->nombre}} </td>
                        <td> {{$pas->apellido_paterno}} </td>
                        <td> {{$pas->apellido_materno}} </td>
                        <td> {{$pas->edad}} </td>
                        <td> {{$pas->peso}}kg </td>
                        <td> {{$pas->altura}}m </td>
                        <td> {{$pas->tipo_de_sangre}} </td>
                        <td>
                            <form class="pt-1" action=" {{ route('pacientes.destroy', $pas) }}" method ="POST">
                                @method('DELETE')
                                @csrf
                                <input  type="submit" 
                                        value="Borrar" 
                                        class="btn btn-secondary btn-sm btn-table"
                                        onclick = "return confirm('¿Desea Eliminar al paciente {{$pas->id}}?')">
                            </form>
                            <form class="pt-1" action="{{ route('grafica.graficar', $pas) }}" method="POST"> <!-- route('grafica.graficar'), $pas -->
                                @method('GET')
                                @csrf
                                <input type="submit" value="Graficar" class="btn btn-secondary btn-sm btn-table">
                            </form>
                            <form class="pt-1" action="{{ route('pacientes.edit', $pas) }}" method="POST"> <!-- route('grafica.graficar'), $pas -->
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
@endsection