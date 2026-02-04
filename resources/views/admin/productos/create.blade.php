@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Creación de Producto</h4>
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
                                            <select name="categoria_id" id="categoria_id" class="form-select">
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
                                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}"
                                                class="form-control" placeholder="Ingrese el codigo del producto"
                                                required>
                                        </div>
                                        @error('codigo')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="slug">Prescripcion</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-text-left"></i></span>
                                            <input type="text" name="prescripcion" id="prescripcion"
                                                value="{{ old('prescripcion') }}" class="form-control"
                                                placeholder="Ingrese la prescripcion del producto">
                                        </div>
                                        @error('prescripcion')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">



                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="password">Descripcion</label>
                                        <div class="input-group">
                                            <div style=" width: 100%">
                                                <textarea name="descripcion" id="descripcion"
                                                    class="form-control ckeditor" rows="1"
                                                    placeholder="Ingrese la descripción del producto" required>
                                                                    {{ old('descripcion') }}</textarea>

                                                <style>
                                                    .ck-editor__editable {
                                                        min-height: 150px;
                                                    }
                                                </style>
                                            </div>


                                        </div>

                                        @error('descripcion')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    <script
                                        src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Editor para el contenido (más completo)
                                            ClassicEditor
                                                .create(document.querySelector('#descripcion'), {
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
                                            <input type="text" name="precio" id="precio" value="{{ old('precio') }}"
                                                class="form-control text-end" step="0.01" min="0" placeholder="0.00 "
                                                required>
                                        </div>
                                        @error('precio')
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
                                                                <div class="col-md-2">
                                                                
                                                                    <div class="form-group">
                                                                        <label for="name">Stock Fraccion(*)</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"><i class="bi bi-boxes"></i></span>
                                                                            <input type="text" name="stock_fraccion" id="stock_fraccion" value="{{ old('stock_fraccion') }}" class="form-control text-end" step="1"
                                                                                min="0" placeholder="0" required>
                                                                        </div>
                                                                        @error('stock_fraccion')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                
                                                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipo_producto">Tipo de Producto(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                                            <select name="tipo_producto" id="tipo_producto" class="form-control"
                                                required>
                                                <option value="">-- Seleccione --</option>
                                                <option value="B" {{ old('tipo_producto')=='B' ? 'selected' : '' }}>BIEN
                                                </option>
                                                <option value="S" {{ old('tipo_producto')=='S' ? 'selected' : '' }}>
                                                    SERVICIO</option>
                                                <option value="I" {{ old('tipo_producto')=='I' ? 'selected' : '' }}>
                                                    INSUMO</option>
                                                <option value="O" {{ old('tipo_producto')=='O' ? 'selected' : '' }}>
                                                    OBSEQUIO</option>
                                            </select>
                                        </div>
                                        @error('tipo_producto')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="aplica_iva">Aplica IVA(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-percent"></i></span>
                                            <select name="aplica_iva" id="aplica_iva" class="form-control" required>
                                                <option value="">-- Seleccione --</option>
                                                <option value="0" {{ old('aplica_iva')=='0' ? 'selected' : '' }}>0% IVA
                                                </option>
                                                <option value="2" {{ old('aplica_iva')=='2' ? 'selected' : '' }}>Grava
                                                    IVA</option>
                                            </select>
                                        </div>
                                        @error('aplica_iva')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

  
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rol">Unidad de Medida(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                            <select name="unidad_medida" id="unidad_medida"  class="form-select"
                                            onchange="handleUnidadMedidaChange()">
                                                <option value="">--Seleccione unidad de medida--</option>
                                                @foreach($unidades_medida as $unidad)
                                                <option value="{{ $unidad->codigo_catalogo_detalle }}" {{ old('unidad_medida',
                                                    request()->unidad_medida)
                                                    == $unidad->codigo_catalogo_detalle ? 'selected' : '' }}>
                                                    {{ $unidad->nombre }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('unidad_medida')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="cantidad_por_unidad">Cantidad por Unidad</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-text-left"></i></span>
                                            <input type="text" name="cantidad_por_unidad" id="cantidad_por_unidad"
                                                value="{{ old('cantidad_por_unidad') }}" class="form-control"
                                                placeholder="Ingrese la cantidad por unidad del producto">
                                        </div>
                                        @error('cantidad_por_unidad')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="imprime_receta">Imprime Receta(*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-printer"></i></span>
                                        <select name="imprime_receta" id="imprime_receta" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <option value="N" {{ old('imprime_receta')=='N' ? 'selected' : '' }}>NO
                                            </option>
                                            <option value="S" {{ old('imprime_receta')=='S' ? 'selected' : '' }}>SI
                                            </option>
                                        </select>
                                    </div>
                                    @error('imprime_receta')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
     



                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="estado">Estado(*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                            <select name="estado" id="estado" class="form-control" required>
                                                <option value="">-- Seleccione --</option>
                                                <option value="A" {{ old('estado')=='A' ? 'selected' : '' }}>ACTIVO
                                                </option>
                                                <option value="I" {{ old('estado')=='I' ? 'selected' : '' }}>INACTIVO
                                                </option>
                                            </select>
                                        </div>
                                        @error('estado')
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

<script>
    function handleUnidadMedidaChange() {
        var select = document.getElementById('unidad_medida');
        var input = document.getElementById('cantidad_por_unidad');
        var value = select.options[select.selectedIndex].text.trim().toUpperCase();
        if (value === 'UNIDAD' || value.includes('--')) {
            input.disabled = true;
            input.value = '1';
        } else {
            input.disabled = false;
        }
    }
    window.addEventListener('DOMContentLoaded', function () {
        handleUnidadMedidaChange();
    });
</script>
