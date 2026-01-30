@extends('layouts.admin')
@section('content')
<h1>Creación de Usuario</h1>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Llene los campos del formulario</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/usuarios/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="rol">Rol de Usuario(*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                                        <select name="rol" id="rol" class="form-control">
                                            <option value="">-- Seleccione un rol --</option>
                                            @foreach($roles as $rol)
                                                <option value="{{ $rol->name }}" {{ old('rol', request()->rol) == $rol->name ? 'selected' : '' }}>
                                                    {{ $rol->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('rol')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name">Nombre del Usuario(*)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                                        placeholder="Ingrese el nombre del usuario" required>
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                                                <div class="col-md-6">
                                                
                                                    <div class="form-group">
                                                        <label for="email">Email(*)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                                            <input type="text" name="email" id="email" required value="{{ old('email') }}" class="form-control" placeholder="Ingrese el email del usuario">
                                                        </div>
                                                        @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                
                                                </div>
                    </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                        
                                                <div class="form-group">
                                                    <label for="password">Password(*)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                        <input type="password" name="password" id="password"
                                                           value="{{ old('password') }}" class="form-control"
                                                           required
                                                            placeholder="Ingrese la contraseña del usuario">
                                                    </div>
                                                    @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                        
                                            </div>
                                            <div class="col-md-6">
                                        
                                                <div class="form-group">
                                                    <label for="password_confirmation">Confirmar Contraseña(*)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                                                        <input type="password" name="password_confirmation" 
                                                        id="password_confirmation" value="{{ old('password_confirmation') }}" 
                                                        class="form-control" required
                                                            placeholder="Ingrese la confirmación de la contraseña">
                                                    </div>
                                                    @error('password_confirmation')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                        
                                            </div>
                                        </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                                
                            </div>
                        </div>
                    </div>
                </form>


                <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


            </div>

        </div>
    </div>
</div>
@endsection