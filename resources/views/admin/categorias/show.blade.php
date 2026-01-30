@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
            <h4>Detalle de Categoria</h4>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="name">Nombre del Categoria(*)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                <input type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }}"
                                 readonly   class="form-control">
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="slug">Slug(*)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="text" name="slug" id="slug" value="{{ $categoria->slug }}"
                                 readonly   class="form-control">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="password">Descripcion</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <textarea name="descripcion" id="descripcion" class="form-control"
                                readonly rows="3"
                                    placeholder="Ingrese la descripción de la categoría">{{ $categoria->descripcion }}</textarea>


                            </div>

                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Fecha y hora de Creación</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock-fill"></i></span>
                               
        <input type="text" name="slug" id="slug"  readonly value="{{ $categoria->created_at }}" class="form-control">

                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ url('/admin/categorias') }}" class="btn btn-secondary">Cancelar</a>


                        </div>
                    </div>
                </div>



                <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


            </div>

        </div>
    </div>
</div>

@endsection