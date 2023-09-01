@extends('adminlte::page')

@section('title', 'Editar Formulario')

@section('content_header')
    <h1>Editar Formulario</h1>
@stop

@section('content')
<form method="POST" action="{{ route('formularios.update', $formulario->id) }}">
        @csrf
        @method('PUT')

                    <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Formulario:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $formulario->nombre }}">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción (Opcional):</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $formulario->descripcion }}">
                        </div>
                        
        
        <h2>Campos Personalizados</h2>
        <div id="campos-container">
            @foreach ($formulario->campos as $campo)
                <div class="campo mb-3">
                    <div class="input-group">
                        <label for="campo_nombre" class="input-group-text">Nombre del Campo:</label>
                        <input type="text" name="campo_nombre[]" class="form-control" value="{{ $campo->nombre }}" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="campo_tipo_dato" class="input-group-text">Tipo de Dato:</label>
                        <select name="campo_tipo_dato[]" class="form-select" required>
                            <option value="texto" {{ $campo->tipo === 'texto' ? 'selected' : '' }}>Texto</option>
                            <option value="numerico" {{ $campo->tipo === 'numerico' ? 'selected' : '' }}>Numérico</option>
                            <option value="seleccion" {{ $campo->tipo === 'seleccion' ? 'selected' : '' }}>Selección</option>
                            <option value="fecha" {{ $campo->tipo === 'fecha' ? 'selected' : '' }}>Fecha</option>
                            <option value="geolocalizacion" {{ $campo->tipo === 'geolocalizacion' ? 'selected' : '' }}>Geolocalización</option>
                            <option value="textarea" {{ $campo->tipo === 'textarea' ? 'selected' : '' }}>Textarea</option>
                            <option value="archivo" {{ $campo->tipo === 'archivo' ? 'selected' : '' }}>Archivo</option>
                            {{-- Agregar más opciones de tipos de dato --}}
                        </select>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input type="checkbox" name="campo_obligatorio[]" value="1" class="form-check-input" {{ $campo->obligatorio ? 'checked' : '' }}>
                        <label for="campo_obligatorio" class="form-check-label">¿Obligatorio?</label>
                    </div>
                    
                    <button type="button" class="btn btn-danger btn-sm btn-eliminar-campo">Eliminar Campo</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="agregar-campo" class="btn btn-primary">Agregar Campo</button>
        <button type="submit" class="btn btn-success">Actualizar Formulario</button>
    </form>
    
    {{-- Agrega más detalles o elementos de presentación aquí --}}
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const camposContainer = document.getElementById("campos-container");
            const agregarCampoBtn = document.getElementById("agregar-campo");

            agregarCampoBtn.addEventListener("click", function() {
                const nuevoCampo = document.createElement("div");
                nuevoCampo.classList.add("campo", "mb-3");

                nuevoCampo.innerHTML = `
                    <div class="input-group">
                        <label for="campo_nombre" class="input-group-text">Nombre del Campo:</label>
                        <input type="text" name="campo_nombre[]" class="form-control" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="campo_tipo_dato" class="input-group-text">Tipo de Dato:</label>
                        <select name="campo_tipo_dato[]" class="form-select" required>
                            <option value="texto">Texto</option>
                            <option value="numerico">Numérico</option>
                            <option value="seleccion">Selección</option>
                            <option value="fecha">Fecha</option>
                            <option value="geolocalizacion">Geolocalización</option>
                            <option value="textarea">Textarea</option>
                            <option value="archivo">Archivo</option>

                            {{-- Agregar más opciones de tipos de dato --}}
                        </select>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input type="checkbox" name="campo_obligatorio[]" value="1" class="form-check-input">
                        <label for="campo_obligatorio" class="form-check-label">¿Obligatorio?</label>
                    </div>
                    
                    <button type="button" class="btn btn-danger btn-sm btn-eliminar-campo">Eliminar Campo</button>
                `;

                camposContainer.appendChild(nuevoCampo);
            });

            // Agregar campos existentes al cargar la página (edición)
            const camposExistentes = document.querySelectorAll(".campo");
            camposExistentes.forEach(campo => {
                camposContainer.appendChild(campo);
            });

            camposContainer.addEventListener("click", function(event) {
                if (event.target.classList.contains("btn-eliminar-campo")) {
                    event.target.closest(".campo").remove();
                }
            });
        });
    </script>
@stop


