@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Usuarios Registrados
                    <a href="{{ url('/admin/usuarios/create') }}" style="float: right;" class="btn btn-primary"><i
                            class="bi bi-plus"></i> Crear Nuevo</a>
                </h4>

                <div class="card-body">
<div class="row">
    <div class="col-md-6">
        <form action="{{ url('/admin/usuarios') }}" method="GET">
            <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                        placeholder="Buscar usuario..."
                        value="{{ request('search') }}">
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
                                <th>Nombre del Usuario</th>
                                <th>Rol</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ ($usuarios->currentPage() -1)*$usuarios->perPage()+$loop->iteration }}</td>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if($usuario->estado==1)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <!-- Aquí puedes agregar botones para editar o eliminar el rol -->
                                <a href="{{ url('/admin/usuarios/'.$usuario->id) }}" 
                                    class="btn btn-sm btn-info @if($usuario->estado==0) disabled @endif">
                                    
                                     <i class="bi bi-eye"></i>Ver
                                </a>
                                    <a href="{{ url('/admin/usuarios/'.$usuario->id.'/edit') }}"
                                        class="btn btn-sm btn-success @if($usuario->estado==0) disabled @endif"><i class="bi bi-pencil"></i>
                                        Editar
                                    </a>
                                    @if($usuario->estado==1)
                                                                        <form action="{{ url('/admin/usuarios/delete/'.$usuario->id) }}" method="POST" id="delete-form-{{ $usuario->id }}"
                                                                            style="display: inline-block;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-sm btn-danger " onclick="preguntar({{$usuario->id}}, event);">
                                                                                <i class="bi bi-trash"></i>Eliminar</button>
                                                                        </form>
                                                                        <script>
                                                                            function preguntar(id, event) {
                                                                                event.preventDefault();


                                                                                Swal.fire({
                                                                                    title: '¿Estás seguro de eliminar este usuario?',
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
                                    @else

                                    <form action="{{ url('/admin/usuarios/'.$usuario->id.'/restore') }}" 
                                        method="POST" id="restore-form-{{ $usuario->id }}"
                                        style="display: inline-block;">
                                        @csrf
                                   
                                        <button type="submit" class="btn btn-sm btn-warning " onclick="preguntar_restaurar({{$usuario->id}}, event);">
                                            <i class="bi bi-arrow-counterclockwise"></i>Restaurar</button>
                                    </form>
                                    <script>
                                        function preguntar_restaurar(id, event) {
                                            event.preventDefault();


                                            Swal.fire({
                                                title: '¿Estás seguro de restaurar este usuario?',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Restaurar',
                                                cancelButtonText: 'Cancelar'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('restore-form-' + id).submit();
                                                }
                                            });

                                        }
                                    </script>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($usuarios->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted">
                            Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }}
                            registros

                        </div>
                        {{ $usuarios->links('pagination::bootstrap-4') }}
                    </div>
                    @endif

                    <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


                </div>

            </div>
        </div>
    </div>

    @endsection