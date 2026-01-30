@extends('layouts.admin')
@section('content')
<h3>Creación de Producto</h3>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Llene los campos del formulario</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/productos/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rol">Categoria(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                            <select name="categoria_id" id="categoria_id" class="form-control">
                                                <option value="">-- Seleccione una categoria --</option>
                                                @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}" {{ old('categoria_id', request()->
                                                    categoria_id)
                                                    == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->nombre }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('categoria')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="name">Nombre del Producto(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-box"></i></span>
                                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                                class="form-control" placeholder="Ingrese el nombre del producto"
                                                required>
                                        </div>
                                        @error('nombre')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
  
                            </div>
                            <div class="row">
                                                            <div class="col-md-6">
                                                            
                                                                <div class="form-group">
                                                                    <label for="name">Codigo del Producto(*)</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                                                                        <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" class="form-control"
                                                                            placeholder="Ingrese el codigo del producto" required>
                                                                    </div>
                                                                    @error('codigo')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                            
                                                                <div class="form-group">
                                                                    <label for="slug">Descripcion Corta(*)</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="bi bi-text-left"></i></span>
                                                                        <input type="text" name="descripcion_corta" id="descripcion_corta" required
                                                                            value="{{ old('descripcion_corta') }}" class="form-control"
                                                                            placeholder="Ingrese la descripción corta del producto">
                                                                    </div>
                                                                    @error('descripcion_corta')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            
                                                            </div>
                            </div>
                            <div class="row">



                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="password">Descripcion Larga</label>
                                        <div class="input-group">
                                            <div style=" width: 100%">
                                                <textarea name="descripcion_larga" id="descripcion_larga"
                                                    class="form-control ckeditor" rows="1"
                                                    placeholder="Ingrese la descripción larga del producto" required>
                                                                    {{ old('descripcion_larga') }}</textarea>

                                                <style>
                                                    .ck-editor__editable {
                                                        min-height: 250px;
                                                    }
                                                </style>
                                            </div>


                                        </div>

                                        @error('descripcion_larga')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    <script
                                        src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Editor para el contenido (más completo)
                                            ClassicEditor
                                                .create(document.querySelector('#descripcion_larga'), {
                                                    toolbar: {
                                                        items: [
                                                            'heading', '|',
                                                            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                                                            'link', 'bulletedList', 'numberedList', '|',
                                                            'outdent', 'indent', '|',
                                                            'alignment', '|',
                                                            'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                                            'undo', 'redo', '|',
                                                            'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', '|',
                                                            'code', 'codeBlock', 'htmlEmbed', '|',
                                                            'sourceEditing'
                                                        ],
                                                        shouldNotGroupWhenFull: true
                                                    },
                                                    language: 'es',
                                                })
                                                .catch(error => {
                                                    console.error(error);
                                                });
                                        });
                                    </script>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">

                                    <div class="form-group">
                                        <label for="name">Precio de Compra(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                            <input type="text" name="precio_compra" id="precio_compra"
                                                value="{{ old('precio_compra') }}" class="form-control text-end"
                                                step="0.01" min="0" placeholder="0.00 " required>
                                        </div>
                                        @error('precio_compra')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="form-group">
                                        <label for="name">Precio de Venta(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                            <input type="text" name="precio_venta" id="precio_venta"
                                                value="{{ old('precio_venta') }}" class="form-control text-end"
                                                step="0.01" min="0" placeholder="0.00 " required>
                                        </div>
                                        @error('precio_venta')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="form-group">
                                        <label for="name">Stock(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-boxes"></i></span>
                                            <input type="text" name="stock" id="stock" value="{{ old('stock') }}"
                                                class="form-control text-end" step="1" min="0" placeholder="0" required>
                                        </div>
                                        @error('stock')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imagen">Imagen @if(!(isset($producto) &&
                                            $producto->imagen))(*)@endif</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-image"></i></span>
                                            <input type="file" class="form-control" id="imagen" name="imagen"
                                                accept="image/*" @error('imagen') is-invalid @enderror
                                                @if(!(isset($producto) && $producto->imagen)) required @endif
                                            onchange="mostrarImagen(event)">
                                            @error('imagen')
                                            <small style="color:red">{{ $message}}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div style="display: flex; justify-content: center;">
                                        @if(isset($producto) && $producto->imagen)
                                        <img id="preview1" src="{{ asset('storage/' . $producto->imagen) }}"
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

                        </div>


                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar Producto</button>

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