@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Clientes Registrados
                    <a href="{{ url('/admin/clientes/0/edit') }}" style="float: right;" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Crear Nuevo</a>
                </h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ url('/admin/clientes') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar cliente..." value="{{ request('search') }}">
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
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ ($clientes->currentPage() -1)*$clientes->perPage()+$loop->iteration }}</td>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nombres }}</td>
                                <td>{{ $cliente->apellidos }}</td>
                                <td>{{ $cliente->cedula }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/clientes/'.$cliente->id) }}" class="btn btn-sm btn-info ">
                                        <i class="bi bi-eye"></i>Ver
                                    </a>
                                    <a href="{{ url('/admin/clientes/'.$cliente->id.'/edit') }}"
                                        class="btn btn-sm btn-success "><i class="bi bi-pencil"></i>
                                        Editar
                                    </a>
                                    <form action="{{ url('/admin/clientes/delete/'.$cliente->id) }}" method="POST"
                                        id="delete-form-{{ $cliente->id }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger "
                                            onclick="preguntar({{$cliente->id}}, event);">
                                            <i class="bi bi-trash"></i>Eliminar</button>
                                    </form>
                                    <script>
                                        function preguntar(id, event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: '¿Estás seguro de eliminar este cliente?',
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
                    @if($clientes->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted">
                            Mostrando {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }} de {{
                            $clientes->total() }} registros
                        </div>
                        {{ $clientes->links('pagination::bootstrap-4') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endsection


        