@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ isset($proveedor->id) && $proveedor->id ? 'Edición de Proveedor' : 'Registrar Proveedor' }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/proveedores/update/' . ($proveedor->id ?? 0)) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre(*)</label>
                                <input type="text" name="nombres" id="nombres"
                                    value="{{ old('nombres', $proveedor->nombres ?? '') }}" class="form-control"
                                    placeholder="Ingrese el nombre" required>
                                @error('nombres')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido">Apellido(*)</label>
                                <input type="text" name="apellidos" id="apellidos"
                                    value="{{ old('apellidos', $proveedor->apellidos ?? '') }}" class="form-control"
                                    placeholder="Ingrese el apellido" required>
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
                                <input type="text" name="cedula" id="cedula"
                                    value="{{ old('cedula', $proveedor->cedula ?? '') }}" class="form-control"
                                    placeholder="Ingrese el CI" required>
                                @error('cedula')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" id="telefono"
                                    value="{{ old('telefono', $proveedor->telefono ?? '') }}" class="form-control"
                                    placeholder="Ingrese el teléfono">
                                @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_persona">Tipo de Persona(*)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-printer"></i></span>
                                    <select name="tipo_persona" id="tipo_persona" class="form-select" required>
                                        <option value="">-- Seleccione --</option>
                                        <option value="CLI" {{ old('tipo_persona', $proveedor->tipo_persona ?? '') ==

                                            'CLI' ? 'selected' : '' }}>CLIENTE</option>
                                        <option value="PRO" {{ old('tipo_persona', $proveedor->tipo_persona ?? '') ==
                                            'PRO' ? 'selected' : '' }}>PROVEEDOR</option>
                                        <option value="CYP" {{ old('tipo_persona', $proveedor->tipo_persona ?? '') ==
                                            'CYP' ? 'selected' : '' }}>CLIENTE Y PROVEEDOR</option>
                                    </select>
                                </div>
                                @error('tipo_persona')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $proveedor->email ?? '') }}" class="form-control"
                                    placeholder="Ingrese el email">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado(*)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                    <select name="estado" id="estado" class="form-select" required>
                                        <option value="">-- Seleccione --</option>
                                        <option value="A" {{ old('estado', $proveedor->estado ?? '') ==
                                            'A' ? 'selected' : '' }}>ACTIVO</option>
                                        <option value="I" {{ old('estado', $proveedor->estado ?? '') ==
                                            'I' ? 'selected' : '' }}>INACTIVO</option>
                                    </select>
                                </div>
                                @error('estado')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">
                                    {{ isset($proveedor->id) && $proveedor->id ? 'Actualizar' : 'Registrar' }}
                                </button>
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
      //  alert('ID en la URL: ' + id);
    });
</script>
@endpush