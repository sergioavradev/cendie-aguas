@extends('adminlte::page')

@section('title', 'Detalle del Formulario')

@section('content_header')
    <h1>Detalle del Formulario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Nombre del Formulario: {{ $formulario->nombre }}</h2>
        </div>
        <div class="card-body">
            {{-- Mostrar otros detalles del formulario --}}
            <h3>Detalles del Formulario</h3>
            <p>{{$formulario->descripcion}}</p>
        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-header">
            <h2>Campos Personalizados</h2>
        </div>
        <div class="card-body">
            @foreach ($formulario->campos as $campo)
                <div class="campo mb-3">
                    <label for="{{ $campo->nombre }}" class="form-label">{{ $campo->nombre }}:</label>
                    @if ($campo->tipo === 'texto')
                        <input type="text" name="{{ $campo->nombre }}" class="form-control" id="{{ $campo->nombre }}">
                    @elseif ($campo->tipo === 'numerico')
                        <input type="number" name="{{ $campo->nombre }}" class="form-control" id="{{ $campo->nombre }}">
                    @elseif ($campo->tipo === 'seleccion')
                        <select name="{{ $campo->nombre }}" class="form-select" id="{{ $campo->nombre }}">
                            {{-- Agregar opciones para la selección --}}
                        </select>
                    @elseif ($campo->tipo === 'fecha')
                    <input type="date" name="{{ $campo->nombre }}" class="form-control" id="{{ $campo->nombre }}">
                    {{-- Agregar más casos para otros tipos de campo --}}
                    @elseif ($campo->tipo === 'textarea')
                    <div class="form-group" bis_skin_checked="1">
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    {{-- Agregar más casos para otros tipos de campo --}}
                    @elseif ($campo->tipo === 'archivo')
                        <div class="input-group" bis_skin_checked="1">
                            <div class="custom-file" bis_skin_checked="1">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Seleccionar archivo</label>
                            </div>
                            <div class="input-group-append" bis_skin_checked="1">
                                <span class="input-group-text">Subir</span>
                            </div>
                        </div>

                    @endif
                </div>
            @endforeach
        </div>
    </div>
    
    {{-- Agrega más detalles o elementos de presentación aquí --}}
@endsection
