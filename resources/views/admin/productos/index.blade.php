@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Productos Registrados
                    <a href="{{ url('/admin/productos/create') }}" style="float: right; margin-left: 10px;" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Crear Nuevo</a>

                    <button id="btn-crear-pdf" type="button" class="btn btn-primary" style="float: right; margin-left: 10px;" onclick="reporte_productos_pdf()">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </button>


                

                </h4>

                <div class="card-body">
                    <form action="{{ url('/admin/productos') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                                        <select id="estado" name="estado" class="form-select">
                                            <option value="" {{ request('estado')=='' ? 'selected' : '' }}>Todos
                                            </option>
                                            <option value="A" {{ request('estado')=='A' ? 'selected' : '' }}>Activo
                                            </option>
                                            <option value="I" {{ request('estado')=='I' ? 'selected' : '' }}>Inactivo
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="search">Texto a Buscar (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                        <input type="text" id="search" name="search" class="form-control"
                                            value="{{ $buscar ?? request('search') }}" placeholder="Buscar producto...">
                                        <button id="btn-buscar-citas" type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i>Buscar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Producto</th>

                                <th>Categoria</th>
                                <th>Unidad Medida</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Stock</th>
                                <th>Stock Fracción</th>
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

                                <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                                <td>
                                    @if(($producto->unidad_medida ?? '') !== 'UNIDAD')
                                    {{ number_format($producto->cantidad_por_unidad ?? 0, 0, '.', ',') }} {{
                                    $producto->unidad_medida ?? 'Sin unidad' }}
                                    @else
                                    {{ $producto->unidad_medida ?? 'Sin unidad' }}
                                    @endif
                                </td>
                                <td>{{ $ajuste->divisa . ' ' . number_format($producto->precio_compra, 2, '.', ',') }}
                                </td>
                                <td>{{ $ajuste->divisa . ' ' . number_format($producto->precio, 2, '.', ',') }}</td>
                                <td>{{ number_format($producto->stock, 0, '.', ',') }}</td>
                                <td>
                                    {{ $producto->stock_fraccion == 0
                                    ? '-'
                                    : number_format($producto->stock_fraccion, 0, '.', ',') . ' ' .
                                    ($producto->unidad_medida ?? '') }}
                                </td>
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


                                    <!-- <a href="{{ url('/admin/productos/'.$producto->id.'/imagenes') }}"
                                        class="btn btn-sm btn-warning ">

                                    <i class="bi bi-images"></i>
                                    </a> -->
                                    <a href="{{ url('/admin/productos/'.$producto->id.'/kardex') }}"
                                        class="btn btn-sm btn-warning ">


                                        <i class="bi bi-journal-text"></i>
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

    @push('scripts')
    <script>


        function reporte_productos_pdf() {
            const estado = document.getElementById('estado').value;
            const search = document.getElementById('search').value;
            // console.log('Generando reporte PDF con estado:', estado, 'y búsqueda:', search);
     

            const url = `{{ url('/admin/productos/reportepdf') }}?estado=${encodeURIComponent(estado)}&search=${encodeURIComponent(search)}`;
            window.open(url, '_blank');

        }
    </script>
    @endpush