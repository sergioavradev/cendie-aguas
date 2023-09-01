@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Crear Nuevo Formulario</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('formularios.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Formulario:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción (Opcional):</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control">
                        </div>

                        
                        <div class="mb-3">
                            <h2 class="fw-bold">Campos Personalizados</h2>
                            <div id="campos-container">
                                <div class="campo mb-3">
                                    <button type="button" class="btn btn-danger btn-sm btn-eliminar-campo">Eliminar Campo</button>
                                    <label for="campo_nombre" class="form-label">Nombre del Campo:</label>
                                    <input type="text" name="campo_nombre[]" class="form-control" required>
                                    
                                    <label for="campo_tipo_dato" class="form-label">Tipo de Dato:</label>
                                    <select name="campo_tipo_dato[]" class="form-select" required>
                                        <option value="texto">Texto</option>
                                        <option value="numerico">Numérico</option>
                                        <!-- <option value="seleccion">Selección</option> -->
                                        <option value="fecha">Fecha</option>
                                        <!-- <option value="geolocalizacion">Geolocalización</option> -->
                                        {{-- Agregar más opciones de tipos de dato --}}
                                        <option value="textarea">Textarea</option>
                                        <option value="archivo">Archivo</option>
                                    </select>
                                    
                                    <div class="form-check">
                                        <input type="checkbox" name="campo_obligatorio[]" value="1" class="form-check-input">
                                        <label for="campo_obligatorio" class="form-check-label">¿Obligatorio?</label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="agregar-campo" class="btn btn-primary">Agregar Campo</button>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Crear Formulario</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Vista Previa') }}</div>

                <div class="card-body" id="vista-previa">
                    <h4 id="vista-previa-titulo">Vista Previa del Formulario:</h4>
                    <p id="vista-previa-nombre">Nombre del Formulario: </p>
                    <!-- ... Otros campos de la vista previa ... -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         function actualizarVistaPrevia() {
                const nombre = $("#nombre").val();
                $("#vista-previa-nombre").text("Nombre del Formulario: " + nombre);
            }
    </script>
    <script>

       


        $(document).ready(function() {
            const camposContainer = $("#campos-container");
            const agregarCampoBtn = $("#agregar-campo");

            agregarCampoBtn.click(function() {
                const nuevoCampo = `
                    <div class="campo mb-3">
                        <button type="button" class="btn btn-danger btn-sm btn-eliminar-campo">Eliminar Campo</button>
                        <label for="campo_nombre" class="form-label">Nombre del Campo:</label>
                        <input type="text" name="campo_nombre[]" class="form-control" required>
                        
                        <label for="campo_tipo_dato" class="form-label">Tipo de Dato:</label>
                        <select name="campo_tipo_dato[]" class="form-select" required>
                            <option value="texto">Texto</option>
                            <option value="numerico">Numérico</option>
                          
                            <option value="fecha">Fecha</option>
                          
                            <option value="textarea">Textarea</option>
                            <option value="archivo">Archivo</option>
                            {{-- Agregar más opciones de tipos de dato --}}
                        </select>
                        
                        <div class="form-check">
                            <input type="checkbox" name="campo_obligatorio[]" value="1" class="form-check-input">
                            <label for="campo_obligatorio" class="form-check-label">¿Obligatorio?</label>
                        </div>
                    </div>
                `;

                camposContainer.append(nuevoCampo);
                actualizarVistaPrevia();
            });

            $("#nombre").on("change",function() {
                actualizarVistaPrevia();
            });
            // Agregar evento para eliminar campos
            camposContainer.on("click", ".btn-eliminar-campo", function() {
                $(this).parent().remove();
                actualizarVistaPrevia();
            });
        });
    </script>
@endsection
