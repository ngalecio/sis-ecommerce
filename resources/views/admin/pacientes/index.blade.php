@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Pacientes Registrados
                    <a href="{{ url('/admin/pacientes/0/edit') }}" style="float: right;" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Crear Nuevo</a>
                </h4>

            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{ url('/admin/pacientes') }}" method="GET">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control" placeholder="Buscar paciente..."
                                                    value="{{ $buscar ?? request('search') }}">
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
                                        @foreach($pacientes as $paciente)
                                        <tr>
                                            <td>{{ ($pacientes->currentPage() -1)*$pacientes->perPage()+$loop->iteration }}</td>
                                            <td>{{ $paciente->id }}</td>
                                            <td>{{ $paciente->nombres }}</td>
                                            <td>{{ $paciente->apellidos }}</td>
                                            <td>{{ $paciente->cedula }}</td>
                                            <td>{{ $paciente->telefono }}</td>
                                            <td>{{ $paciente->email }}</td>
                                            <td class="text-center">
                                                <a href="{{ url('/admin/pacientes/'.$paciente->id) }}" class="btn btn-sm btn-info ">
                                                    <i class="bi bi-eye"></i>Ver
                                                </a>
                                                <a href="{{ url('/admin/pacientes/'.$paciente->id.'/edit') }}" class="btn btn-sm btn-success "><i
                                                        class="bi bi-pencil"></i>
                                                    Editar
                                                </a>
                                                <form action="{{ url('/admin/pacientes/delete/'.$paciente->id) }}" method="POST"
                                                    id="delete-form-{{ $paciente->id }}" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger "
                                                        onclick="preguntar({{$paciente->id}}, event);">
                                                        <i class="bi bi-trash"></i>Eliminar</button>
                                                </form>
                                                <script>
                                                    function preguntar(id, event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: '¿Estás seguro de eliminar este paciente?',
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
                                @if($pacientes->hasPages())
                                <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                                    <div class="text-muted">
                                        Mostrando {{ $pacientes->firstItem() }} a {{ $pacientes->lastItem() }} de {{
                                        $pacientes->total() }} registros
                                    </div>
                                    {{ $pacientes->links('pagination::bootstrap-4') }}
                                </div>
                                @endif
                            </div>
        </div>
    </div>

    @endsection


        