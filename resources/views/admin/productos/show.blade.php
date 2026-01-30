@extends('layouts.admin')
@section('content')
<h3>Datos de Producto
    <div style="float: right;">
        <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Volver</a>
    </div>

</h3>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Llene los campos del formulario</h4>
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

@endsection