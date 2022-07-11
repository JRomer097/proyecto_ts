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
            <table class="table">
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
                            <form action=" {{ route('pacientes.delete', $pas) }}" method ="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Borrar" class="btn btn-info btn-sm">
                            </form>
                            <form action="{{ route('grafica.graficar', $pas) }}" method="POST"> <!-- route('grafica.graficar'), $pas -->
                                @method('GET')
                                @csrf
                                <input type="submit" value="Graficar" class="btn btn-success btn-sm">
                            </form>
                            <form action="{{ route('pacientes.editar', $pas) }}" method="POST"> <!-- route('grafica.graficar'), $pas -->
                                @method('GET')
                                @csrf
                                <input type="submit" value="editar" class="btn btn-danger btn-sm">
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