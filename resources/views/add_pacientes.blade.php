@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 max_auto">
            <div class="row col-md-10 conteiner">
                <form class="row" action=" {{ route('pacientes.store') }} " method="POST"><!--  route('pacientes.store')-->
                    <div class="col">
                        <input placeholder="Nombre" name="nombre" value="{{ old('nombre') }}">
                    </div>
                    <div class="col">
                        <input placeholder="Apellido Paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}">
                    </div>
                    <div class="col">
                        <input placeholder="Apellido Materno" name="apellido_materno" value="{{ old('apellido_materno') }}">
                    </div>
                    <div class="col">
                        <input placeholder="Edad" name="edad" value="{{ old('edad') }}">
                    </div>
                    <div class="col">
                        <input placeholder="Peso" name="peso" value="{{ old('peso') }}">
                    </div>
                    <div class="col">
                        <input placeholder="Altura" name="altura" value="{{ old('altura') }}">
                    </div>
                    <div class="col">
                        <input placeholder="Tipo de sangre" name="tipo_de_sangre" value="{{ old('tipo_de_sangre') }}">
                    </div>
                    <div class="col">
                        @csrf
                        <button type="submit" class="btn btn-danger">Enviar</button>
                    </div>
                </form>
            </div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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