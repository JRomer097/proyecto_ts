@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-header p-3" id="card-font-title">
                    <b>{{ __('Bienvenido') }}</b
                ></div>

                <div class="card-body" id="card-font-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ auth()->user()->name }} 
                    {{ auth()->user()->apellido_paterno }} 
                    {{ auth()->user()->apellido_materno }}
                    <p>{{ $nowDate }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
