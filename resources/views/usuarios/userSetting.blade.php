@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')

    <h1>Mi Perfil</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Datos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Rol</label>
                            @foreach($user->roles as $rol)
                            <input type="text" class="form-control" id="inputAddress" value="{{$rol->name}}" disabled>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Regiones</label>
                            
                            <select class="form-control select2" multiple="multiple" style="width: 100%;" disabled>
                            @foreach ($user->regiones as $region)
                                <option value="{{ $region->nombre }}" selected>{{ $region->nombre }}</option>
                            @endforeach
                                <!-- <option value="1" selected>Opción 1</option>
                                <option value="2" selected>Opción 2</option> -->
                                <option value="3">Opción 3</option>

                                <!-- Agregar más opciones aquí -->
                            </select>
                        </div>
                        <form class="row g-3" action="{{ route('userUpdate', $user->id) }}" method="post" id="updateForm">
                        @csrf
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Nombre</label>
                                <input type="text" class="form-control toggle-input" id="name" name="name" value="{{$user->name}}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control toggle-input" id="email" name="email"  value="{{$user->email}}" disabled>
                            </div>

                            <div class="col-12 mt-3">
                                <button type="button" class="btn btn-warning" id="toggleButton">Editar</button>
                                <button type="submit" class="btn btn-primary toggle-input" id="updateButton" disabled>Guardar</button>
                            </div>

                        </form>


                      
                      
                     
                     
                       
</div>




                    <!-- {{ __('You are logged in!') }} -->

                
                </div>
            </div>


            <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                   
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.select2').select2({
                theme:'classic'
            }
                
            );
        });
        //fx para editar 
        $('#toggleButton').click(function() {
            $('.toggle-input').prop('disabled', function(_, val) {
                return !val;
            });
        });

        // $('#updateButton').click(function() {
        //     var formData = $('#updateForm').serialize();

        //     $.ajax({
        //         type: 'POST',
        //         url: '/ruta-de-actualizacion', // Cambia esto por la ruta correcta en tu aplicación
        //         data: formData,
        //         success: function(response) {
        //             $('#name').val(response.name);
        //             $('#email').val(response.email);
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });
        // });




    </script>
@stop