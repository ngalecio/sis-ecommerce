
@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
        <h4>{{ isset($cliente->id) && $cliente->id ? 'Edición de Cliente' : 'Registrar Cliente' }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/clientes/update/' . ($cliente->id ?? 0)) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre(*)</label>
                                <input type="text" name="nombres" id="nombres" value="{{ old('nombres', $cliente->nombres ?? '') }}" class="form-control" placeholder="Ingrese el nombre" required>
                                @error('nombres')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido">Apellido(*)</label>
                                <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $cliente->apellidos ?? '') }}" class="form-control" placeholder="Ingrese el apellido" required>
                                @error('apellidos')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ci">CI(*)</label>
                                <input type="text" name="cedula" id="cedula" value="{{ old('cedula', $cliente->cedula ?? '') }}" class="form-control" placeholder="Ingrese el CI" required>
                                @error('cedula')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono ?? '') }}" class="form-control" placeholder="Ingrese el teléfono">
                                @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $cliente->email ?? '') }}" class="form-control" placeholder="Ingrese el email">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener la URL actual
        const url = window.location.pathname;
        // Extraer el parámetro uno antes del final
        const parts = url.split('/');
        const id = parts[parts.length - 2];
        alert('ID en la URL: ' + id);
    });
    </script>
    @endpush