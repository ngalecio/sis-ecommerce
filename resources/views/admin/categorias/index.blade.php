@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4> Categorías Registradas
                    <a href="{{ url('/admin/categorias/create') }}" style="float: right;" class="btn btn-primary"><i
                            class="bi bi-plus"></i> Crear Nuevo</a>
                </h4>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ url('/admin/categorias') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar categoría..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Categoria</th>
                                <th>Slug</th>
                                <th>Descripcion</th>
                               
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                            <tr>
                                <td>{{ ($categorias->currentPage() -1)*$categorias->perPage()+$loop->iteration }}</td>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ $categoria->slug }}</td>
                                <td width="40%">{{ $categoria->descripcion }}</td>
               

                                <td class="text-center">
                                    <!-- Aquí puedes agregar botones para editar o eliminar el rol -->
                                    <a href="{{ url('/admin/categorias/'.$categoria->id) }}"
                                        class="btn btn-sm btn-info ">

                                        <i class="bi bi-eye"></i>Ver
                                    </a>
                                    <a href="{{ url('/admin/categorias/'.$categoria->id.'/edit') }}"
                                        class="btn btn-sm btn-success "><i
                                            class="bi bi-pencil"></i>
                                        Editar
                                    </a>

                                    <form action="{{ url('/admin/categorias/delete/'.$categoria->id) }}" method="POST"
                                        id="delete-form-{{ $categoria->id }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger "
                                            onclick="preguntar({{$categoria->id}}, event);">
                                            <i class="bi bi-trash"></i>Eliminar</button>
                                    </form>
                                    <script>
                                        function preguntar(id, event) {
                                            event.preventDefault();


                                            Swal.fire({
                                                title: '¿Estás seguro de eliminar esta categoría?',
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


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($categorias->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted">
                            Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }} de {{
                            $categorias->total() }}
                            registros

                        </div>
                        {{ $categorias->links('pagination::bootstrap-4') }}
                    </div>
                    @endif

                    <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


                </div>

            </div>
        </div>
    </div>

    @endsection