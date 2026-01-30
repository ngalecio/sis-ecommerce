@extends('layouts.admin')
@section('content')
<h1>Informacion de Usuario</h1>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Información del Usuario</h4>
            </div>
            <div class="card-body">
           
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="rol">Rol de Usuario(*)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                                    <label for="">{{ $usuario->roles->pluck('name')->implode(', ') }}</label>
                             
                                </div>
                            </div>
          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name">Nombre del Usuario(*)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                    <label for="">{{ $usuario->name }}</label>
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
                                    <label for="">{{ $usuario->email }}</label>
                                </div>
                                @error('email')
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
                            

                            </div>
                        </div>
                    </div>
    


                <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


            </div>

        </div>
    </div>
</div>
@endsection