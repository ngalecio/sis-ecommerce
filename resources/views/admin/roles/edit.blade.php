@extends('layouts.admin')
@section('content')
<h1>Edición de Roles</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card">

            <div class="card-header">
                <h4>Llene los campos del formulario</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/roles/update/'.$role->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="name">Nombre del Rol(*)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}"
                                        placeholder="Ingrese el nombre del rol">
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/roles') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                                
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