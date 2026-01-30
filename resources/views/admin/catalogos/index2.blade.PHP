@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Catálogos Registrados
           
                <button type="button" class="btn btn-primary" style="float: right;" 
                data-bs-toggle="modal" data-bs-target="#crearCatalogoModal">
                    <i class="bi bi-plus"></i> Crear Nuevo
                </button>

           
                <!-- Modal -->
                <div class="modal fade" id="crearCatalogoModal" tabindex="-1" aria-labelledby="crearCatalogoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="formCrearCatalogo">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="crearCatalogoModalLabel">Crear Nuevo Catálogo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="codigo">Código del Catálogo(*)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                                    <input type="text" name="codigo" id="codigo" class="form-control"
                                                        placeholder="Ingrese el código del catálogo" required>
                                                </div>
                                                <small class="text-danger" id="error-codigo"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">Nombre(*)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                                        placeholder="Ingrese el nombre del catálogo" required>
                                                </div>
                                                <small class="text-danger" id="error-nombre"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
  
                </h4>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ url('/admin/catalogos') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar catálogo..." value="{{ request('search') }}">
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
                                <th>Catálogo</th>
                                <th>Codigo</th>

                               
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catalogos as $catalogo)
                            <tr>
                                <td>{{ ($catalogos->currentPage() -1)*$catalogos->perPage()+$loop->iteration }}</td>
                                <td>{{ $catalogo->id }}</td>
                                <td>{{ $catalogo->nombre }}</td>
                                <td>{{ $catalogo->codigo }}</td>
                              
               

                                <td class="text-center">
                                    <!-- Aquí puedes agregar botones para editar o eliminar el rol -->
                                    <a href="{{ url('/admin/catalogos/'.$catalogo->id) }}"
                                        class="btn btn-sm btn-info ">

                                        <i class="bi bi-eye"></i>Ver
                                    </a>
                                    <!-- <a href="{{ url('/admin/catalogos/'.$catalogo->id.'/edit') }}"
                                        class="btn btn-sm btn-success "><i
                                            class="bi bi-pencil"></i>
                                        Editar
                                    </a> -->
                                                                <button class="btn btn-sm btn-success" type="button"
                                                                    data-modal-target="editarCatalogoModal" data-modal-toggle="editarCatalogoModal" data-id="{{ $catalogo->id }}">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>

                                    <form action="{{ url('/admin/catalogos/delete/'.$catalogo->id) }}" method="POST"
                                        id="delete-form-{{ $catalogo->id }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger "
                                            onclick="preguntar({{$catalogo->id}}, event);">
                                            <i class="bi bi-trash"></i>Eliminar</button>
                                    </form>
                                    <script>
                                        function preguntar(id, event) {
                                            event.preventDefault();


                                            Swal.fire({
                                                title: '¿Estás seguro de eliminar este catálogo?',
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
                    @if($catalogos->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted">
                            Mostrando {{ $catalogos->firstItem() }} a {{ $catalogos->lastItem() }} de {{
                            $catalogos->total() }}
                            registros

                        </div>
                        {{ $catalogos->links('pagination::bootstrap-4') }}
                    </div>
                    @endif

                    <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


                </div>

            </div>
        </div>
    </div>

    <!-- Modal Editar Catálogo -->
    <div id="editarCatalogoModal" tabindex="-1" aria-hidden="true" class="modal fade" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <!-- Modal content -->
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square me-2 text-primary"></i>
                        Editar Catálogo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="formEditarCatalogo">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="catalogo-id" name="id">
    
                        <div class="mb-3">
                            <label for="codigo-editar" class="form-label">
                                Código del Catálogo <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                <input type="text" name="codigo" id="codigo-editar" required class="form-control"
                                    placeholder="Ej. CAT001">
                            </div>
                            <small class="text-danger" id="error-codigo-editar"></small>
                        </div>
    
                        <div class="mb-3">
                            <label for="nombre-editar" class="form-label">
                                Nombre <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="text" name="nombre" id="nombre-editar" required class="form-control"
                                    placeholder="Ej. Electrónicos">
                            </div>
                            <small class="text-danger" id="error-nombre-editar"></small>
                        </div>
    
                        <div class="modal-footer border-top pt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
        //  document.addEventListener('DOMContentLoaded', function () {
        //         // Función para manejar todos los modales
        //         function setupModal(modalId, toggleSelector = null) {
        //             const modal = document.getElementById(modalId);
        //             if (!modal) return;

        //             // Configurar botones de apertura
        //             if (toggleSelector) {
        //                 document.querySelectorAll(toggleSelector).forEach(button => {
        //                     button.addEventListener('click', (e) => {
        //                         e.preventDefault();
        //                         // Resetear el modal primero
        //                         modal.style.display = 'none';
        //                         modal.classList.add('hidden');

        //                         // Mostrar correctamente
        //                         modal.style.display = 'flex';
        //                         modal.classList.remove('hidden');
        //                         document.body.style.overflow = 'hidden';
        //                     });
        //                 });
        //             }

        //             // Configurar botón de cierre (X)
        //             const closeButton = modal.querySelector('[data-modal-hide]');
        //             if (closeButton) {
        //                 closeButton.addEventListener('click', (e) => {
        //                     e.preventDefault();
        //                     modal.style.display = 'none';
        //                     modal.classList.add('hidden');
        //                     document.body.style.overflow = 'auto';
        //                 });
        //             }

        //             // Cerrar al hacer clic fuera del modal
        //             modal.addEventListener('click', (e) => {
        //                 if (e.target === modal) {
        //                     e.preventDefault();
        //                     modal.style.display = 'none';
        //                     modal.classList.add('hidden');
        //                     document.body.style.overflow = 'auto';
        //                 }
        //             });
        //         }

        //         // Inicializar cada modal
        //        // setupModal('crearCategoriaModal', '[data-modal-toggle="crearCategoriaModal"]');
        //         setupModal('editarCatalogoModal', '[data-modal-toggle="editarCatalogoModal"]');
        //     });
          document.querySelectorAll('[data-modal-toggle="editarCatalogoModal"]').forEach(button => {

           // alert('Cargando datos del catálogo ID: ' + button.getAttribute('data-id'));
                button.addEventListener('click', async function () {

                    const id = this.getAttribute('data-id');
                    const modal = document.getElementById('editarCatalogoModal');
           
                    try {
                        const response = await fetch(`/admin/catalogos/${id}`);
                     
                        const data = await response.json();
                    

                        if (data.success) {
                  
                            document.getElementById('catalogo-id').value = data.data.id;
                            document.getElementById('codigo-editar').value = data.data.codigo || '';
                            document.getElementById('nombre-editar').value = data.data.nombre || '';


                            // Mostrar el modal correctamente con Bootstrap
                            const bootstrapModal = new bootstrap.Modal(modal);
                            bootstrapModal.show();
                        } else {
                            alert("Error al cargar los datos del catálogo");
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });
    document.addEventListener('DOMContentLoaded', function () {
        // Formulario de crear catálogo
        const formCrear = document.getElementById('formCrearCatalogo');
        const modalCrear = document.getElementById('crearCatalogoModal');
        formCrear.addEventListener('submit', function (e) {
            e.preventDefault();
            document.getElementById('error-codigo').textContent = '';
            document.getElementById('error-nombre').textContent = '';
            const data = {
                codigo: document.getElementById('codigo').value,
                nombre: document.getElementById('nombre').value,
            };
            fetch("{{ route('admin.catalogos.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    const bootstrapModal = bootstrap.Modal.getInstance(modalCrear);
                    bootstrapModal.hide();
                    alert('Catálogo creado exitosamente');
                    location.reload();
                })
                .catch(error => {
                    if (error.errors) {
                        if (error.errors.codigo) {
                            document.getElementById('error-codigo').textContent = error.errors.codigo[0];
                        }
                        if (error.errors.nombre) {
                            document.getElementById('error-nombre').textContent = error.errors.nombre[0];
                        }
                    } else {
                        alert('Error al crear el catálogo: ' + (error.message || 'Error desconocido'));
                    }
                });
        });

        // Formulario de editar catálogo
  
         document.querySelector('#editarCatalogoModal').addEventListener('submit', function (e) {
            e.preventDefault();
            document.getElementById('error-codigo-editar').textContent = '';
            document.getElementById('error-nombre-editar').textContent = '';
              const modalEditar = document.getElementById('editarCatalogoModal');
            const id = document.getElementById('catalogo-id').value;
            const data = {
                codigo: document.getElementById('codigo-editar').value,
                nombre: document.getElementById('nombre-editar').value,
            };
            fetch(`/admin/catalogos/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    const bootstrapModal = bootstrap.Modal.getInstance(modalEditar);
                    bootstrapModal.hide();
                    alert('Catálogo actualizado exitosamente');
                    location.reload();
                })
                .catch(error => {
                    if (error.errors) {
                        if (error.errors.codigo) {
                            document.getElementById('error-codigo-editar').textContent = error.errors.codigo[0];
                        }
                        if (error.errors.nombre) {
                            document.getElementById('error-nombre-editar').textContent = error.errors.nombre[0];
                        }
                    } else {
                        alert('Error al actualizar el catálogo: ' + (error.message || 'Error desconocido'));
                    }
                });
        });
    });
</script>
@endpush