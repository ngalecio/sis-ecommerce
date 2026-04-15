@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Proveedores Registrados
                    <a href="{{ url('/admin/proveedores/0/edit') }}" style="float: right;" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Crear Nuevo</a>
                </h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ url('/admin/proveedores') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar proveedor..." value="{{ request('search') }}">
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
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Tipo de Persona</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $proveedor)
                            <tr>
                                <td>{{ ($proveedores->currentPage() -1)*$proveedores->perPage()+$loop->iteration }}</td>
                                <td>{{ $proveedor->id }}</td>
                                <td>{{ $proveedor->nombres }}</td>
                                <td>{{ $proveedor->apellidos }}</td>
                                <td>{{ $proveedor->cedula }}</td>
                                <td>{{ $proveedor->telefono }}</td>
                                <td>{{ $proveedor->email }}</td>
                <td>
                    @if($proveedor->tipo_persona == 'CLI')
                    CLIENTE
                    @elseif($proveedor->tipo_persona == 'PRO')
                    PROVEEDOR
                    @elseif($proveedor->tipo_persona == 'CYP')
                    CLIENTE Y PROVEEDOR
                    @else
                    {{ $proveedor->tipo_persona }}
                    @endif
                </td>
  
                <td class="text-center">
                    @if($proveedor->estado == 'A')
                    <span class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
                    </span>
                    @else
                    <span class="text-danger">
                        <i class="bi bi-dash-circle-fill" style="font-size: 1.5rem;"></i>
                    </span>
                    @endif
                </td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/proveedores/'.$proveedor->id) }}" class="btn btn-sm btn-info ">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ url('/admin/proveedores/'.$proveedor->id.'/edit') }}"
                                        class="btn btn-sm btn-success "><i class="bi bi-pencil"></i>
                                        
                                    </a>
                                    <form action="{{ url('/admin/proveedores/delete/'.$proveedor->id) }}" method="POST"
                                        id="delete-form-{{ $proveedor->id }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger "
                                            onclick="preguntar({{$proveedor->id}}, event);">
                                            <i class="bi bi-trash"></i></button>
                                    </form>
                                    <script>
                                        function preguntar(id, event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: '¿Estás seguro de eliminar este proveedor?',
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
                    @if($proveedores->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted">
                            Mostrando {{ $proveedores->firstItem() }} a {{ $proveedores->lastItem() }} de {{
                            $proveedores->total() }} registros
                        </div>
                        {{ $proveedores->links('pagination::bootstrap-4') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endsection


        