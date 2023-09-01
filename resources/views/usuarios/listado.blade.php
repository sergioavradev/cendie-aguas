@extends('adminlte::page')

@section('title', 'Administración de usuarios')

@section('content_header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <h1>Administración de usuarios</h1>
@stop

@section('content')
<div class="modal fade" id="actualizarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="user/update/" method="POST" id="formulario-actualizar-usuario">
                    @csrf
                    <input type="hidden" id="usuarioActualizar">
                    <div id="modalMensajesActualizar" class="text-danger"></div>


                    <div class="form-group">
                        <label for="nombreActualizar">Nombre</label>
                        <input type="text" id="nombreActualizar" name="nombreActualizar" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailActualizar">Email</label>
                        <input type="email" id="emailActualizar" name="emailActualizar" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="regionesActualizar">Regiones</label>
                        <select name="regionesActualizar[]" id="regionesActualizar" class="form-control select2" multiple required>
                                <option value=""></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rolActualizar">Rol</label>
                        <select id="rolActualizar" name="rolActualizar" class="form-control" required>
                            <option value="1">Administrador</option>
                            <option value="2">Visador</option>
                            <option value="3">Técnico Laboratorio</option>
                        </select>
                    </div>

                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarCamposModalActualizar()">Cerrar</button>
                <button type="submit" type="button" class="btn btn-primary">Guardar</button>
            </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="agregarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario Nuevo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.usuarios.store') }}" method="POST" id="formulario-usuario" >
                    @csrf

                    <div id="modalMensajes" class="text-danger"></div>


                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="regiones">Regiones</label>
                        <select name="regiones[]" class="form-control select2" multiple required>
                            @foreach($regiones as $region)
                                <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select name="rol" class="form-control" required>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>

                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarCamposModal()">Cerrar</button>
                <button type="submit" type="button" class="btn btn-primary">Guardar</button>
            </div>

            </form>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row card-header">
                    <div class="col-6">
                        {{ __('Listado de usuarios') }}
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-success btn-md btn-crear" id="crearUsuario" data-id="2" onclick="crearUsuario()">Crear Usuario</button>
                    </div>
                

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">

                        <table id="miTabla" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <!-- <th>Rol</th> -->
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                        </table>
                    </div>


                    <!-- {{ __('You are logged in!') }} -->

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<!-- Estilos de DataTables con Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
@stop

@section('js')
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

function crearUsuario() {
    $('#agregarUsuarioModal').modal('show');
}
function limpiarMensajesDeError() {
        $('#formulario-usuario')[0].reset(); // Limpia los campos del formulario
        $('.select2').val(null).trigger('change'); // Limpia las selecciones de Select2
        $('#modalMensajes').html('');
        $('#agregarUsuarioModal').modal('hide');

    }

function cargarActualizar(response) {
            $('#usuarioActualizar').val(response.id);
            $('#nombreActualizar').val(response.name);
            $('#emailActualizar').val(response.email);
            $('#rolActualizar').val(response.roles[0].id);
            let regiones = response.regiones;
            let regionesSelec = [];
            regiones.forEach(element => {
                regionesSelec.push(element.id);
            });
            $("#regionesActualizar").val(regionesSelec).trigger("change");
}


function cargarRegiones() {
    // Inicializa el elemento Select2
    $("#regionesActualizar").select2();
    // Limpia las opciones existentes
    $("#regionesActualizar").empty(); 
    
    $.ajax({
        url: 'regiones',
        type: 'GET',
        success:  function(response) {
            response.forEach(element => {
                let option = new Option(element.nombre, element.id);
                $("#regionesActualizar").append(option);
            });

            $("#regionesActualizar").trigger("change");
            
        },
        error: function(error) {
            console.log(error);
        }
        });

}
function actualizarUser(usuarioId) {
        
    $.ajax({
        url: 'user/' + usuarioId,
        type: 'GET',
        success:  function(response) {
            cargarActualizar(response);
            
        },
        error: function(error) {
            console.log(error);
        }
        });
    }

function limpiarCamposModal() {
        $('#formulario-usuario')[0].reset(); // Limpia los campos del formulario
        $('.select2').val(null).trigger('change'); // Limpia las selecciones de Select2
        $('#modalMensajes').html(''); // Limpia los mensajes de error

    }

    function limpiarCamposModalActualizar() {
        $('#formulario-actualizar-usuario')[0].reset(); // Limpia los campos del formulario
        $('.select2').val(null).trigger('change'); // Limpia las selecciones de Select2
        $('#modalMensajesActualizar').html(''); // Limpia los mensajes de error
    }

  // Agregar evento al cerrar el modal
  $('#agregarUsuarioModal').on('hidden.bs.modal', function () {
        limpiarCamposModal();
    });
    
$(document).ready(function() {
    var tabla = $('#miTabla').DataTable({
        processing: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'name', title: 'Nombre' },
            { data: 'email', title: 'Correo Electrónico' },
            {
                data: 'acciones',
                title: 'Acciones',
                searchable: false,
                orderable: false,
                render: function(data, type, row) {
                    return `
                    <button class="btn btn-danger btn-sm btn-eliminar" data-id="${row.id}">Eliminar</button>
                        <button data-toggle="modal" data-target="#actualizarUsuarioModal" class="btn btn-warning btn-sm btn-actualizar" id="actualizarUsuario" data-id="${row.id}">Modificar</button>

                    `;
                }
            }
        ],
    });

    function cargarDatosTabla() {
        $.ajax({
            url: '/get-users-data',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                tabla.clear().rows.add(data).draw();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function eliminarUser(registroId) {
        if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
            $.ajax({
                type: 'DELETE',
                url: '/user-delete/' + registroId,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response.message);
                    cargarDatosTabla();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }


    


     $('#miTabla').on('click', '.btn-eliminar', function() {
        var registroId = $(this).data('id');
        eliminarUser(registroId);
    });

    $('#miTabla').on('click', '.btn-actualizar', function() {
        var registroId = $(this).data('id');
        cargarRegiones();
        $("#formulario-actualizar-usuario").attr('action','user/update/'+registroId)
        actualizarUser(registroId);
    });


    $('.select2').select2();


    $('#formulario-usuario').submit(function(event) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                      
                        limpiarMensajesDeError();
                        cargarDatosTabla();
                    } else {
                        if (response.errors) {
                            var errorMessage = '<ul>';
                            for (var fieldName in response.errors) {
                                errorMessage += '<li>' + response.errors[fieldName][0] + '</li>';
                            }
                            errorMessage += '</ul>';

                            $('#modalMensajes').html(errorMessage);
                        }
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            var errorMessage = '<ul>';
                            for (var fieldName in response.errors) {
                                errorMessage += '<li>' + response.errors[fieldName][0] + '</li>';
                            }
                            errorMessage += '</ul>';

                            $('#modalMensajes').html(errorMessage);
                        }
                    }
                }
            });
            
        });

    


   



    // Cargar datos iniciales al cargar la página
    cargarDatosTabla();
});


</script>


    
@stop