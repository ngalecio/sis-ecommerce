@extends('layouts.admin')
@section('content')
<h1>Ajustes del sistema</h1>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Configuraciones del Sistema</h4>
            </div>
            <div class="card-body">



                <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->

                <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">Nombre(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                             
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                value="{{ old('nombre', $ajuste->nombre ?? '') }}"
                                                placeholder="Nombre de la empresa..." @error('nombre') is-invalid
                                                @enderror required>
                                            @error('nombre')
                                            <small style="color:red">{{ $message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="descripcion" class="form-label">Descripcion(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                            <input type="text" class="form-control" id="descripcion" name="descripcion"
                                                value="{{ old('descripcion', $ajuste->descripcion ?? '') }}"
                                                placeholder="descripcion de la empresa..." @error('descripcion')
                                                is-invalid @enderror required>
                                            @error('descripcion')
                                            <small style="color:red">{{ $message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">Sucursal(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-shop"></i></span>
                                            <input type="text" class="form-control" id="sucursal" name="sucursal"
                                                value="{{ old('sucursal', $ajuste->sucursal ?? '') }}"
                                                placeholder="Sucursal de la empresa..." @error('sucursal') is-invalid
                                                @enderror required>
                                            @error('sucursal')
                                            <small style="color:red">{{ $message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="descripcion" class="form-label">Direccion(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                            <textarea type="text" class="form-control" rows="2" id="direccion"
                                                name="direccion" placeholder="Direccion de la empresa..."
                                                @error('direccion') is-invalid @enderror
                                                required>{{ old('direccion', $ajuste->direccion ?? '') }}</textarea>
                                            @error('direccion')
                                            <small style="color:red">{{ $message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="form-label">Telefonos(*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                <input type="text" class="form-control" id="telefonos" name="telefonos"
                                                    value="{{ old('telefonos', $ajuste->telefonos ?? '') }}"
                                                    placeholder="Telefonos de la empresa..." @error('telefonos')
                                                    is-invalid @enderror required>
                                                @error('telefonos')
                                                <small style="color:red">{{ $message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="form-label">Email(*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $ajuste->email ?? '') }}"
                                                    placeholder="Email de la empresa..." @error('email') is-invalid
                                                    @enderror required>
                                                @error('email')
                                                <small style="color:red">{{ $message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="form-label">Divisa(*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="bi bi-currency-dollar"></i></span>
                                                <select class="form-select" id="divisa" name="divisa">
                                               
                                                    <option value="">-- Seleccione una divisa --</option>
                                                    <option value="USD" {{ old('divisa', $ajuste->divisa ?? '') == 'USD' ? 'selected' : '' }}>Dólar estadounidense - USD</option>
                                                    <option value="EUR" {{ old('divisa', $ajuste->divisa ?? '') == 'EUR' ? 'selected' : '' }}>Euro - EUR</option>
                                                    <option value="GBP" {{ old('divisa', $ajuste->divisa ?? '') == 'GBP' ? 'selected' : '' }}>Libra esterlina - GBP</option>
                                                    <option value="JPY" {{ old('divisa', $ajuste->divisa ?? '') == 'JPY' ? 'selected' : '' }}>Yen japonés - JPY</option>
                                                    <option value="MXN" {{ old('divisa', $ajuste->divisa ?? '') == 'MXN' ? 'selected' : '' }}>Peso mexicano - MXN</option>
                                                </select>
                                                @error('divisa')
                                                <small style="color:red">{{ $message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="form-label">Pagina web(*)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                                <input type="text" class="form-control" id="pagina_web"
                                                    name="pagina_web"
                                                    value="{{ old('pagina_web', $ajuste->pagina_web ?? '') }}"
                                                    placeholder="Pagina web de la empresa..." @error('pagina_web')
                                                    is-invalid @enderror required>
                                                @error('pagina_web')
                                                <small style="color:red">{{ $message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="logo" class="form-label">Logo @if(!(isset($ajuste) &&
                                            $ajuste->logo))(*)@endif</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-image"></i></span>
                                            <input type="file" class="form-control" id="logo" name="logo"
                                                accept="image/*" @error('logo') is-invalid @enderror
                                                @if(!(isset($ajuste) && $ajuste->logo)) required @endif
                                            onchange="mostrarImagen(event)">
                                            @error('logo')
                                            <small style="color:red">{{ $message}}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div style="display: flex; justify-content: center;">
                                        @if(isset($ajuste) && $ajuste->logo)
                                        <img id="preview1" src="{{ asset('storage/' . $ajuste->logo) }}"
                                            style="max-width: 300px; margin-top: 10px; max-height: 200px;" id="preview1"
                                            alt="">
                                        @else
                                        <img src="" style="max-width: 300px; margin-top: 10px; max-height: 200px;"
                                            id="preview1" alt="">
                                        @endif
                                    </div>
                                    <script>
                                        const mostrarImagen = e =>
                                            document.getElementById('preview1').src = URL.createObjectURL(e.target.files[0]);
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image_login" class="form-label">Imagen de Login @if(!(isset($ajuste)
                                            && $ajuste->imagen_login))(*)@endif</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-camera"></i></span>
                                            <input type="file" class="form-control" id="imagen_login"
                                                name="imagen_login" accept="image/*" @error('imagen_login') is-invalid
                                                @enderror 
                                                @if(!(isset($ajuste) && $ajuste->imagen_login)) required @endif
                                            onchange="mostrarImagen2(event)">
                                            @error('imagen_login')
                                            <small style="color:red">{{ $message}}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div style="display: flex; justify-content: center;">
                                        @if(isset($ajuste) && $ajuste->imagen_login)
                                        <img id="preview2" src="{{ asset('storage/' . $ajuste->imagen_login) }}"
                                            style="max-width: 300px; margin-top: 10px; max-height: 200px;" id="preview2"
                                            alt="">
                                        @else
                                        <img src="" style="max-width: 300px; margin-top: 10px; max-height: 200px;"
                                            id="preview2" alt="">
                                        @endif
                                    </div>
                                    <script>
                                        const mostrarImagen2 = e =>
                                            document.getElementById('preview2').src = URL.createObjectURL(e.target.files[0]);
                                    </script>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar
                                        Cambios</button>

                                </div>

                            </div>
                        </div>


                </form>
            </div>

        </div>
    </div>
</div>
@endsection