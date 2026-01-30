@extends('layouts.admin')
@section('content')
<h1>Listado de Roles</h1>
<div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-header">
                <h4>Roles Registrados
                 <a href="{{ url('/admin/roles/create') }}" style="float: right;" class="btn btn-primary"><i class="bi bi-plus"></i> Crear Nuevo</a>
            </h4>
          
            <div class="card-body">

              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Nombre del Rol</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($roles as $role)
                    <tr>
                        <td>{{ ($roles->currentPage() -1)*$roles->perPage()+$loop->iteration }}</td>
                      <td>{{ $role->id }}</td>  
                      <td>{{ $role->name }}</td>
                      <td class="text-center">
                        <!-- Aquí puedes agregar botones para editar o eliminar el rol -->
                        <a href="{{ url('/admin/roles/'.$role->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Ver</a>
                        <a href="{{ url('/admin/roles/'.$role->id.'/edit') }}" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i> Editar</a>
                        <form action="{{ url('/admin/roles/delete/'.$role->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este rol?')"> <i class="bi bi-trash"></i> Eliminar</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              @if($roles->hasPages())
                  <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                    <div class="text-muted">
                        Mostrando {{ $roles->firstItem() }} a {{ $roles->lastItem() }} de {{ $roles->total() }} registros

                    </div>
                      {{ $roles->links('pagination::bootstrap-4') }}
                  </div>    
                  @endif

                <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


            </div>

        </div>
    </div>
</div>

@endsection