@extends('layouts.admin')
@section('content')
<h3>Imagnenes del Producto
    <div style="float: right;">
        <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Volver</a>
    </div>

</h3>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Datos de Producto</h4>
            </div>
            <div class="card-body">


                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rol">Categoria(*)</label>
                            <div class="input-group">
                                <p><i class="bi bi-tags"></i> {{ $producto->categoria->nombre }}</p>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="name">Nombre del Producto(*)</label>
                            <div class="input-group">
                                <p><i class="bi bi-box"></i> {{ $producto->nombre }}</p>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="name">Codigo del Producto(*)</label>
                            <div class="input-group">
                                <p><i class="bi bi-upc-scan"></i> {{ $producto->codigo }}</p>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="slug">Descripcion Corta(*)</label>
                            <div class="input-group">
                                <p><i class="bi bi-text-left"></i> {{ $producto->descripcion_corta }}</p>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row">



                    <!--
                            Este bloque muestra un campo de texto (textarea) para la "Descripción Larga" de un producto en una vista de detalle.
                            El contenido aparece centrado visualmente porque el contenedor principal utiliza la clase "col-md-12", que ocupa todo el ancho disponible en el sistema de grid de Bootstrap.
                            Además, el uso de "input-group" y "input-group-text" de Bootstrap puede alinear verticalmente el icono y el textarea, dando la apariencia de que el contenido está centrado dentro del grupo de entrada.
                            El textarea está configurado como "readonly", mostrando el valor de "$producto->descripcion_larga" sin permitir edición.
                        -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion_larga">Descripcion Larga</label>
                            <p>{!! $producto->descripcion_larga !!}</p>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2">

                        <div class="form-group">
                            <label for="name">Precio de Compra(*)</label>
                            <div class="input-group">
                                <p><i class="bi bi-currency-dollar"></i> {{ $producto->precio_compra }}</p>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-2">

                        <div class="form-group">
                            <label for="name">Precio de Venta(*)</label>
                            <div class="input-group">
                                <p><i class="bi bi-currency-dollar"></i> {{ $producto->precio_venta }}</p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-2">

                        <div class="form-group">
                            <label for="name">Stock(*)</label>
                            <div class="input-group">
                                <p><i class="bi bi-boxes"></i> {{ $producto->stock }}</p>
                            </div>

                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">



                        </div>
                    </div>
                </div>


                <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Imágenes del Producto
                    <div style="float: right;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="bi bi-plus"></i> Cargar Imagen
                        </button>
                    </div>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($producto->imagenes as $imagen)
    
                    <!-- Modal para mostrar la imagen en grande -->
                    <div class="modal fade" id="imagen_{{ $imagen->id }}" tabindex="-1" aria-labelledby="imagenLabel_{{ $imagen->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                            <div class="modal-content" style="background: transparent; border: none;">
                                <div class="modal-header" style="border: none;">
                                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center align-items-center p-0" style="height: 100vh;">
                                    <img src="{{ asset('storage/' . $imagen->imagen) }}" alt="Imagen del Producto" style="width: 100vw; height: 100vh; object-fit: contain; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        
                        <div class="card shadow" style="box-shadow: 0 0 0 2px #0d6efd;">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#imagen_{{ $imagen->id }}">
                                <img src="{{ asset('storage/' . $imagen->imagen) }}" class="card-img-top"
                                    alt="Imagen del Producto"
                                    style="width: 100%; height: 200px; object-fit: contain; object-position: center; background: #f8f9fa;">
                            </a>
                            <div class="d-flex justify-content-end">
                                <form action="{{ url('/admin/productos/' . $imagen->id . '/remove_imagen') }}"
                                    id="delete-form-{{ $imagen->id }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="preguntar({{$imagen->id}}, event);">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <script>
                                function preguntar(id, event) {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: '¿Estás seguro de eliminar esta imagen?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Eliminar',
                                        cancelButtonText: 'Cancelar'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('delete-form-' + id).submit();
                                        }
                                    });
                                }
                            </script>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Subir Imagen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/admin/productos/' . $producto->id . '/upload_imagen') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="logo" class="form-label">Imagen</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                <input type="file" class="form-control" id="imagen" name="imagen"
                                                    accept="image/*" @error('imagen') is-invalid @enderror
                                                    onchange="mostrarImagen(event)">
                                                @error('imagen')
                                                <small style="color:red">{{ $message}}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div style="display: flex; justify-content: center;">

                                            <img src="" style="max-width: 300px; margin-top: 10px; max-height: 200px;"
                                                id="preview1" alt="">

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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Subir Imagen</button>

                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection