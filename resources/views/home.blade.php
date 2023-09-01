@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- {{ __('You are logged in!') }} -->

                    <!-- <h5>Rol asociado:</h5>
                    @foreach($user->roles as $rol)
                    <ul>
                    <li>{{$rol->name}}</li>
                    </ul>
                    @endforeach

                    <h5>Regiones asociadas:</h5>
                    @foreach($user->regiones as $region)
                    <ul>
                    <li>{{$region->nombre}}</li>
                    </ul>
                    @endforeach -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop