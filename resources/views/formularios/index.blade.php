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
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('Dashboard') }}
                        </div>  
                        <div class="col-md-6 d-flex justify-content-end">
                            <a href="{{route('formularios.create')}}"><button class="btn btn-success btn-md btn-crear" id="crearFormulario" data-id="2">Crear Formulario</button></a>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    

                    <h1>Lista de Formularios</h1>
                  
                    

                    <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formularios as $formulario)
                            <tr>
                                <td>{{ $formulario->id }}</td>
                                <td>{{ $formulario->nombre }}</td>
                                <td>{{ $formulario->estado }}</td>
                                <td>
                                    <a href="{{ route('formularios.show', $formulario->id) }}" class="btn btn-info">Ver</a>
                                    <a href="{{ route('formularios.edit', $formulario->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('formularios.destroy', $formulario->id) }}" method="POST" style="display: inline-block" onsubmit="return confirmDeleteForm()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" >Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    


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
    <script>
        function confirmDeleteForm() {
            return confirm('¿Estás seguro de que deseas eliminar este formulario?');
        }
    </script>
@stop