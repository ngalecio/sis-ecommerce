@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Productos Registrados
                    <a href="{{ url('/admin/productos/create') }}" style="float: right;" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Crear Nuevo</a>
                </h4>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ url('/admin/productos') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar producto..." value="{{ request('search') }}">
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
                                <th>Producto</th>
                                <th>Codigo</th>
                                <th>Categoria</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Stock</th>
                                <th>Tipo de Producto</th>
                                <th>Aplica Iva</th>
                                <th>Estado</th>

                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>{{ ($productos->currentPage() -1)*$productos->perPage()+$loop->iteration }}</td>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->codigo }}</td>
                                <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                                <td>{{ $ajuste->divisa . ' ' . number_format($producto->precio_compra, 2, '.', ',') }}</td>
                                <td>{{ $ajuste->divisa . ' ' . number_format($producto->precio, 2, '.', ',') }}</td>
                                <td>{{ $producto->stock }}</td>
                                
                                <td>
                                    @if($producto->tipo_producto == 'B')
                                        BIEN
                                    @elseif($producto->tipo_producto == 'S')
                                        SERVICIO
                                    @elseif($producto->tipo_producto == 'O')
                                        OBSEQUIO
                                    @elseif($producto->tipo_producto == 'I')
                                        INSUMO
                                    @else
                                        {{ $producto->tipo_producto }}
                                    @endif
                                </td>
                                <td>{{ $producto->aplica_iva ? 'Sí' : 'No' }}</td>
                                <td class="text-center">
                                    @if($producto->estado == 'A')
                                        <span class="text-success">
                                            <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            <i class="bi bi-dash-circle-fill" style="font-size: 1.5rem;"></i>
                                        </span>
                                    @endif
                                </td>

                            <td class="text-center" style="white-space: nowrap; vertical-align: middle;">
                                    
                                    <!-- Aquí puedes agregar botones para editar o eliminar el rol -->
     

                                    <a href="{{ url('/admin/productos/'.$producto->id.'/imagenes') }}"
                                        class="btn btn-sm btn-warning ">

                                    <i class="bi bi-images"></i>
                                    </a>
                                    <a href="{{ url('/admin/productos/'.$producto->id.'/edit') }}"
                                        class="btn btn-sm btn-success "><i class="bi bi-pencil"></i>
                                        
                                    </a>

                                    <form action="{{ url('/admin/productos/delete/'.$producto->id) }}" method="POST"
                                        id="delete-form-{{ $producto->id }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger "
                                            onclick="preguntar({{$producto->id}}, event);">
                                            <i class="bi bi-trash"></i></button>
                                    </form>
                                    <script>
                                        function preguntar(id, event) {
                                            event.preventDefault();


                                            Swal.fire({
                                                title: '¿Estás seguro de eliminar este producto?',
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
                    @if($productos->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted">
                            Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de {{
                            $productos->total() }}
                            registros

                        </div>
                        {{ $productos->links('pagination::bootstrap-4') }}
                    </div>
                    @endif

                    <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


                </div>

            </div>
        </div>
    </div>

    @endsection