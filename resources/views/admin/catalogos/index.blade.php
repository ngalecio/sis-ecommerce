@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>Catálogos Registrados
                </h4>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="catalogo-tab" data-bs-toggle="tab" href="#catalogo" role="tab"
                            aria-controls="home" aria-selected="true">Catálogos</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="catalogo-detalle-tab" data-bs-toggle="tab" href="#catalogo_detalle"
                            role="tab" aria-controls="profile" aria-selected="false">Detalle de Catalogos</a>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Contact</a>
                    </li> -->
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="catalogo" role="tabpanel" aria-labelledby="catalogo-tab">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" class="form-control"
                                        placeholder="Buscar catálogo..." value="{{ request('search') }}">
                                    <button id="btn-buscar" type="button" class="btn btn-primary"><i
                                            class="bi bi-search"></i>Buscar</button>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#crearCatalogoModal">
                                    <i class="bi bi-plus"></i> Crear Nuevo
                                </button>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Id</th>
                                    <th>Catálogo</th>
                                    <th>Código</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="catalogos-tbody">
                                <!-- Las filas se llenarán dinámicamente con JS -->
                            </tbody>

                        </table>
                        <div id="catalogos-paginacion"
                            class="d-flex justify-content-between align-items-center mt-4 px-3"></div>
                    </div>
                    <div class="tab-pane fade" id="catalogo_detalle" role="tabpanel"
                        aria-labelledby="catalogo-detalle-tab">
                        <br>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id-codigo-catalogo-search">Código del Catálogo (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                        <select name="id-codigo-catalogo-search" id="id-codigo-catalogo-search" class="form-select" required>
                                            <option value="">Seleccione un código</option>
                                        </select>
                                    </div>
                                    <small class="text-danger" id="error-codigo-detalle"></small>
                                </div>
 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo-catalogo">Código del Catálogo (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                        <input type="text" id="search_detalle" name="search_detalle"
                                            class="form-control" placeholder="Buscar Detalle catálogo..."
                                            value="{{ request('search_detalle') }}">
                                        <button id="btn-buscar-detalle" type="button" class="btn btn-primary"><i
                                                class="bi bi-search"></i>Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex justify-content-end align-items-end" style="padding-top: 24px;">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#crearCatalogoDetalleModal">
                                        <i class="bi bi-plus"></i> Crear Nuevo
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Id</th>
                                    <th>Catálogo Detalle</th>
                                    <th>Código</th>
                                    <th>Catálogo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="catalogos-detalle-tbody">
                                <!-- Las filas se llenarán dinámicamente con JS -->
                            </tbody>

                        </table>
                        <div id="catalogos-detalle-paginacion"
                            class="d-flex justify-content-between align-items-center mt-4 px-3"></div>
                    </div>
                    <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p class="mt-2">Duis ultrices purus non eros fermentum hendrerit. Aenean ornare interdum
                            viverra. Sed ut odio velit. Aenean eu diam
                            dictum nibh rhoncus mattis quis ac risus. Vivamus eu congue ipsum. Maecenas id
                            sollicitudin ex. Cras in ex vestibulum,
                            posuere orci at, sollicitudin purus. Morbi mollis elementum enim, in cursus sem
                            placerat ut.</p>
                    </div> -->
                </div>




                <!-- <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">     -->


            </div>


        </div>
    </div>
    <div class="modal fade" id="crearCatalogoDetalleModal" tabindex="-1"
        aria-labelledby="crearCatalogoDetalleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formCrearCatalogoDetalle">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearCatalogoDetalleModalLabel">Nuevo
                            Catálogo Detalle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="codigo-catalogo">Código del Catálogo (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                        <select name="id-codigo-catalogo" id="id-codigo-catalogo" class="form-control"
                                            required>
                                            <option value="">Seleccione un código</option>
                                        </select>
                                    </div>
                                    <small class="text-danger" id="error-codigo-detalle"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="codigo-catalogo-detalle">Código del Catálogo Detalle (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                        <input type="text" name="codigo-catalogo-detalle" id="codigo-catalogo-detalle"
                                            class="form-control" placeholder="Ingrese el código del detalle catálogo"
                                            required>
                                    </div>
                                    <small class="text-danger" id="error-codigo-detalle"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre-detalle">Nombre del catalogo detalle (*)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                        <input type="text" name="nombre-detalle" id="nombre-detalle"
                                            class="form-control" placeholder="Ingrese el nombre del detalle catálogo"
                                            required>
                                    </div>
                                    <small class="text-danger" id="error-nombre-detalle"></small>
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


        <div class="modal fade" id="editarCatalogoDetalleModal" tabindex="-1" aria-labelledby="editarCatalogoDetalleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="formEditarCatalogoDetalle">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id-catalogo-detalle" name="id-catalogo-detalle">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarCatalogoDetalleModalLabel">
                                Editar Catálogo Detalle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="codigo-catalogo">Código del Catálogo (*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                            <select name="id-catalogo-editar" id="id-catalogo-editar" class="form-control"
                                                required>
                                                <option value="">Seleccione un código</option>
                                            </select>
                                        </div>
                                        <small class="text-danger" id="error-codigo-detalle"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="codigo-catalogo-detalle">Código del Catálogo Detalle (*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                            <input type="text" name="codigo-detalle-editar" id="codigo-detalle-editar"
                                                class="form-control" placeholder="Ingrese el código del detalle catálogo"
                                                required>
                                        </div>
                                        <small class="text-danger" id="error-codigo-detalle"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre-detalle">Nombre del catalogo detalle (*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                            <input type="text" name="nombre-detalle-editar" id="nombre-detalle-editar" class="form-control"
                                                placeholder="Ingrese el nombre del detalle catálogo" required>
                                        </div>
                                        <small class="text-danger" id="error-nombre-detalle-editar"></small>
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


    <div class="modal fade" id="crearCatalogoModal" tabindex="-1" aria-labelledby="crearCatalogoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formCrearCatalogo">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearCatalogoModalLabel">Crear Nuevo
                            Catálogo</h5>
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
        // document.getElementById('catalogos-tbody').addEventListener('click', function (e) {
        //         const btn = e.target.closest('[data-modal-toggle="editarCatalogoModal"]');
        //         if (btn) {
        //             const id = btn.getAttribute('data-id');
        //             const modal = document.getElementById('editarCatalogoModal');
        //             alert('Cargando datos del catálogo ID: ' + id);
        //             // ...tu código para cargar y mostrar el modal...
        //             // (puedes copiar el fetch y el resto de la lógica que ya tienes)
        //         }
        //     });
        function abrirModalEditarCatalogo(id) {
            // Aquí va tu lógica para cargar los datos y mostrar el modal
            // Por ejemplo:
            fetch(`/admin/catalogos/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('catalogo-id').value = data.data.id;
                        document.getElementById('codigo-editar').value = data.data.codigo || '';
                        document.getElementById('nombre-editar').value = data.data.nombre || '';
                        const modal = document.getElementById('editarCatalogoModal');
                        const bootstrapModal = new bootstrap.Modal(modal);
                        bootstrapModal.show();
                    } else {
                        alert("Error al cargar los datos del catálogo");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

                function abrirModalEditarCatalogoDetalle(id) {

                   // alert('Cargando datos del catálogo detalle ID: ' + id);
                    const lista_catalogos_editar = document.getElementById('id-catalogo-editar');
                     initSelect2(lista_catalogos_editar);
                    // Lógica para cargar los datos y mostrar el modal de edición de catálogo detalle
                    fetch(`/admin/catalogosdetalle/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Datos recibidos para catálogo detalle:', data);
                            if (data.success) {
                                // Asumiendo que tienes un modal y formulario para editar catálogo detalle
                                document.getElementById('id-catalogo-detalle').value = data.data.id;
                                document.getElementById('codigo-detalle-editar').value = data.data.codigo_catalogo_detalle || '';
                                document.getElementById('nombre-detalle-editar').value = data.data.nombre || '';
                                 document.getElementById('id-catalogo-editar').value = data.data.catalogo_id || '';
                                 if (window.$ && $.fn.select2) {
                                     $('#id-catalogo-editar').val(data.data.catalogo_id).trigger('change');
                                 }
                                const modal = document.getElementById('editarCatalogoDetalleModal');
                                const bootstrapModal = new bootstrap.Modal(modal);
                                bootstrapModal.show();
                            } else {
                                alert("Error al cargar los datos del catálogo detalle");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

  async function cargarCatalogosTodos() {
        const lista_catalogos_search = document.getElementById('id-codigo-catalogo-search');
        const lista_catalogos = document.getElementById('id-codigo-catalogo');
        const lista_catalogos_editar = document.getElementById('id-catalogo-editar');

        // Validar que los elementos existan
   
        // Agregar clase form-control si no la tiene
        if (!lista_catalogos_search.classList.contains('form-control')) {
            lista_catalogos_search.classList.add('form-control');
        }
        if (!lista_catalogos.classList.contains('form-control')) {
            lista_catalogos.classList.add('form-control');
        }

          if (!lista_catalogos_editar.classList.contains('form-control')) {
          lista_catalogos_editar.classList.add('form-control');
      }
        // Mostrar loading
        lista_catalogos_search.innerHTML = '<option value="">Cargando...</option>';
        lista_catalogos.innerHTML = '<option value="">Cargando...</option>';
        lista_catalogos_editar.innerHTML = '<option value="">Cargando...</option>';

        let url = `/admin/catalogos/todos`;

        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            //console.log('Datos recibidos:', result);

            // Limpiar selects antes de llenar
            lista_catalogos_search.innerHTML = '<option value="">Seleccione un código</option>';
            lista_catalogos.innerHTML = '<option value="">Seleccione un código</option>';
            lista_catalogos_editar.innerHTML = '<option value="">Seleccione un código</option>';

            if (result.data && result.data.length > 0) {
                result.data.forEach((catalogo) => {
                    // Llenar lista_catalogos_search
                    const optionSearch = document.createElement('option');
                    optionSearch.value = catalogo.id;
                    optionSearch.textContent = `${catalogo.codigo} - ${catalogo.nombre}`;
                    lista_catalogos_search.appendChild(optionSearch);

                    // Llenar lista_catalogos
                    const option = document.createElement('option');
                    option.value = catalogo.id;
                    option.textContent = `${catalogo.codigo} - ${catalogo.nombre}`;
                    lista_catalogos.appendChild(option);

                        // Llenar lista_catalogos
                    const option_editar = document.createElement('option');
                    option_editar.value = catalogo.id;
                    option_editar.textContent = `${catalogo.codigo} - ${catalogo.nombre}`;
                    lista_catalogos_editar.appendChild(option_editar);
                });

                                // Inicializar select2 en lista_catalogos_search directamente
                               
                                    initSelect2(lista_catalogos_search);
                     

                                // Inicializar select2 en lista_catalogos solo cuando el modal se muestre
             

               

            } else {
                lista_catalogos_search.innerHTML = '<option value="">No hay códigos disponibles</option>';
                lista_catalogos.innerHTML = '<option value="">No hay códigos disponibles</option>';
            }

        } catch (err) {
            console.error('Error al cargar catálogos:', err);
            lista_catalogos_search.innerHTML = '<option value="">Error al cargar los códigos</option>';
            lista_catalogos.innerHTML = '<option value="">Error al cargar los códigos</option>';
        }
    }

    function initSelect2(element) {
        if (window.$ && $.fn.select2) {
            // Destruir instancia previa si existe
            if ($(element).hasClass('select2-hidden-accessible')) {
                $(element).select2('destroy');
            }

            // Encontrar el modal padre si existe
            const modal = $(element).closest('.modal');
            const config = {
                width: '100%',
                placeholder: 'Seleccione un código',
                allowClear: true,
                language: {
                    noResults: function () {
                        return "No se encontraron resultados";
                    },
                    searching: function () {
                        return "Buscando...";
                    }
                }
            };

            // Si está en un modal, agregar dropdownParent
            if (modal.length > 0) {
                config.dropdownParent = modal;
            }

            // Inicializar select2
            $(element).select2(config);
        }
    }

        async function cargarCatalogos(search2 = '', page = 1) {
            const tbody = document.getElementById('catalogos-tbody');
            const paginacion = document.getElementById('catalogos-paginacion');
            const search = document.getElementById('search').value;
          //  search: document.getElementById('search').value,
                //  alert(`search: ${search}, page: ${page}`)

                tbody.innerHTML = '<tr><td colspan="5">Cargando...</td></tr>';
            let url = `/admin/catalogos/list?search=${encodeURIComponent(search)}&page=${page}`;
            console.log('URL de carga de catálogos:', url); 
            
            try {
                const response = await fetch(url);
                const result = await response.json();
                tbody.innerHTML = '';
                if (result.data && result.data.length > 0) {
                    result.data.forEach((catalogo, idx) => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>${(result.from - 1) + idx + 1}</td>
                        <td>${catalogo.id}</td>
                        <td>${catalogo.nombre}</td>
                        <td>${catalogo.codigo}</td>
                        <td class="text-center">
                            <a  href="/admin/catalogos/${catalogo.id}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i>Ver</a>
                            <button class="btn btn-sm btn-success" type="button" data-modal-toggle="editarCatalogoModal" onclick="abrirModalEditarCatalogo(${catalogo.id})" data-id="${catalogo.id}"><i class="bi bi-pencil"></i></button>
                            <form  action="/admin/catalogos/delete/${catalogo.id}" method="POST" id="delete-form-${catalogo.id}" style="display: inline-block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar(${catalogo.id}, event);"><i class="bi bi-trash"></i>Eliminar</button>
                            </form>
                        </td>
                    `;
                        tbody.appendChild(tr);
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="5">No hay registros</td></tr>';
                }
                // Paginación
                if (result.last_page > 1) {
                    let pagHtml = `<div class='text-muted'>Mostrando ${result.from} a ${result.to} de ${result.total} registros</div><nav><ul class='pagination'>`;
                    for (let i = 1; i <= result.last_page; i++) {
                        pagHtml += `<li class='page-item${i === result.current_page ? ' active' : ''}'><a class='page-link' href='#' onclick='cargarCatalogos("${search}",${i});return false;'>${i}</a></li>`;
                    }
                    pagHtml += '</ul></nav>';
                    paginacion.innerHTML = pagHtml;
                } else {
                    paginacion.innerHTML = '';
                }
            } catch (err) {
                tbody.innerHTML = '<tr><td colspan="5">Error al cargar los datos</td></tr>';
                paginacion.innerHTML = '';
            }
        }


        async function cargarCatalogosDetalle(search_detalle = '', page = 1) {

           // alert('Cargando detalles de catálogos...');
            const tbody = document.getElementById('catalogos-detalle-tbody');
            const paginacion = document.getElementById('catalogos-detalle-paginacion');

            search_detalle = document.getElementById('search_detalle').value;
            const codigo_catalogo_search = document.getElementById('id-codigo-catalogo-search').value;
            //alert(`search_detalle: ${search_detalle}, page: ${page}, codigo_catalogo search: ${codigo_catalogo_search}`);

            //return;


            tbody.innerHTML = '<tr><td colspan="6">Cargando...</td></tr>';
            let url = `/admin/catalogosdetalle/list?search=${encodeURIComponent(search_detalle)}&page=${page}&id_codigo_catalogo=${encodeURIComponent(codigo_catalogo_search)}`;
            try {
                const response = await fetch(url);
                const result = await response.json();
                tbody.innerHTML = '';
                if (result.data && result.data.length > 0) {
                    console.log(result);
                    result.data.forEach((catalogodetalle, idx) => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>${(result.from - 1) + idx + 1}</td>
                        <td>${catalogodetalle.id}</td>
                        <td>${catalogodetalle.nombre}</td>
                        <td>${catalogodetalle.codigo_catalogo_detalle}</td>
                         <td>${catalogodetalle.catalogo.nombre}</td>
                        <td class="text-center">
                            <a  href="/admin/catalogosdetalle/${catalogodetalle.id}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i>Ver</a>
                            <button class="btn btn-sm btn-success" type="button" onclick="abrirModalEditarCatalogoDetalle(${catalogodetalle.id})" data-id="${catalogodetalle.id}"><i class="bi bi-pencil"></i></button>
                            <form  action="/admin/catalogosdetalle/delete/${catalogodetalle.id}" method="POST" id="delete-form-${catalogodetalle.id}" style="display: inline-block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar(${catalogodetalle.id}, event);"><i class="bi bi-trash"></i>Eliminar</button>
                            </form>
                        </td>
                    `;
                        tbody.appendChild(tr);
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="6">No hay registros</td></tr>';
                }
                // Paginación
                if (result.last_page > 1) {
                    let pagHtml = `<div class='text-muted'>Mostrando ${result.from} a ${result.to} de ${result.total} registros</div><nav><ul class='pagination'>`;
                    for (let i = 1; i <= result.last_page; i++) {
                        pagHtml += `<li class='page-item${i === result.current_page ? ' active' : ''}'><a class='page-link' href='#' onclick='cargarCatalogosDetalle("${search_detalle}",${i});return false;'>${i}</a></li>`;
                    }
                    pagHtml += '</ul></nav>';
                    paginacion.innerHTML = pagHtml;
                } else {
                    paginacion.innerHTML = '';
                }
            } catch (err) {
                tbody.innerHTML = '<tr><td colspan="6">Error al cargar los datos</td></tr>';
                paginacion.innerHTML = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            cargarCatalogosTodos();
            cargarCatalogos();
            cargarCatalogosDetalle();

            const modalCatalogoDetalle = document.getElementById('crearCatalogoDetalleModal');
            if (modalCatalogoDetalle) {
                modalCatalogoDetalle.addEventListener('shown.bs.modal', function () {
                    const lista_catalogos = document.getElementById('id-codigo-catalogo');
                    if (lista_catalogos && !$(lista_catalogos).hasClass('select2-hidden-accessible')) {
                        initSelect2(lista_catalogos);
                    }
                });

                // Limpiar al cerrar el modal
                modalCatalogoDetalle.addEventListener('hidden.bs.modal', function () {
                    const lista_catalogos = document.getElementById('id-codigo-catalogo');
                    if (lista_catalogos && $(lista_catalogos).hasClass('select2-hidden-accessible')) {
                        $(lista_catalogos).val(null).trigger('change');
                    }
                });
            }

            const buscarBtn = document.getElementById('btn-buscar');
            const buscarInput = document.getElementById('search');
            if (buscarBtn && buscarInput) {
                buscarBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    cargarCatalogos(buscarInput.value);
                });
            }

            const buscarBtnDetalle = document.getElementById('btn-buscar-detalle');
            const buscarInputDetalle = document.getElementById('search_detalle');
            if (buscarBtnDetalle && buscarInputDetalle) {
                buscarBtnDetalle.addEventListener('click', function (e) {
                    e.preventDefault();
                    cargarCatalogosDetalle(buscarInputDetalle.value);
                });
            }

      
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
                        cargarCatalogos();
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
            // Formulario de crear catálogo detalle
            const formCrearDetalle = document.getElementById('formCrearCatalogoDetalle');
            const modalCrearDetalle = document.getElementById('crearCatalogoDetalleModal');
            formCrearDetalle.addEventListener('submit', function (e) {
                e.preventDefault();
                document.getElementById('error-codigo-detalle').textContent = '';
                document.getElementById('error-nombre-detalle').textContent = '';
                const data = {
                    id_codigo_catalogo: document.getElementById('id-codigo-catalogo').value,
                    codigo_catalogo_detalle: document.getElementById('codigo-catalogo-detalle').value,
                    nombre_detalle: document.getElementById('nombre-detalle').value,
                };
                console.log('DATOS A ENVIAR:', data);
                fetch("{{ route('admin.catalogosdetalle.store') }}", {
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
                        console.log('RESPUESTA:', response);
                        return response.json();
                    })
                    .then(data => {
                        const bootstrapModal = bootstrap.Modal.getInstance(modalCrearDetalle);
                        bootstrapModal.hide();
                        console.log('DATA RECIBIDA:', data);
                        alert('Catálogo detalle creado exitosamente');
                        cargarCatalogosDetalle();
                        //location.reload();
                    })
                    .catch(error => {
                        if (error.errors) {
                            if (error.errors.codigo_detalle) {
                                document.getElementById('error-codigo-detalle').textContent = error.errors.codigo_detalle[0];
                            }
                            if (error.errors.nombre_detalle) {
                                document.getElementById('error-nombre-detalle').textContent = error.errors.nombre_detalle[0];
                            }
                            if (error.errors.id_codigo_catalogo) {
                                document.getElementById('error-codigo-detalle').textContent = error.errors.id_codigo_catalogo[0];
                            }
                        } else {
                            alert('Error al crear el catálogo detalle: ' + (error.message || 'Error desconocido'));
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
                        cargarCatalogos();
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


                    document.querySelector('#editarCatalogoDetalleModal').addEventListener('submit', function (e) {
                e.preventDefault();
                // document.getElementById('error-codigo-detalle-editar').textContent = '';
                // document.getElementById('error-nombre-detalle-editar').textContent = '';
                const modalEditar = document.getElementById('editarCatalogoDetalleModal');

                // alert('Enviando datos de edición de catálogo detalle...');
                // return;
           
                const data = {
                    id: document.getElementById('id-catalogo-detalle').value,
                    codigo_catalogo_detalle: document.getElementById('codigo-detalle-editar').value,
                    nombre_detalle: document.getElementById('nombre-detalle-editar').value,
                    id_codigo_catalogo: document.getElementById('id-catalogo-editar').value
                };
                
                fetch(`/admin/catalogosdetalle/${data.id}`, {
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
                        cargarCatalogosDetalle();
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