@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Kardex : {{ $producto->nombre }} , Código: ({{ $producto->codigo }})

                </h4>

     
                <div class="card-body">
                            <div class="row">
                            <input type="hidden" id="id-producto" value="{{ $producto->id }}">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha-desde">Fecha Desde (*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                            <input type="date" name="fecha-desde" id="fecha-desde" class="form-control" required>
                                        </div>
                                        <small class="text-danger" id="error-fecha-desde"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha-hasta">Fecha Hasta (*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                            <input type="date" name="fecha-hasta" id="fecha-hasta" class="form-control" required>
                                        </div>
                                        <small class="text-danger" id="error-fecha-hasta"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="codigo-catalogo">Texto a Buscar (*)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                            <input type="text" id="search-citas" name="search-citas" class="form-control"
                                                placeholder="Buscar consultas...">
                                            <button id="btn-buscar-citas" type="button" class="btn btn-primary" onclick="cargar_citas()">
                                                <i class="bi bi-search"></i>Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end align-items-end" style="padding-top: 24px;">
                                    <div class="form-group">
                                        <button id="btn-crear-pdf" type="button" class="btn btn-primary" onclick="alert('crear pdf')">
                                            <i class="bi bi-plus"></i> Generar PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Consulta</th>
                                <th>Fecha</th>
                                <th>Tipo Consulta</th>
                                <th>Medicamentos</th>
                                <th>Antecedentes Familiares</th>
                                <th>Alergias</th>
                                <th>Antecedentes Personales</th>
                                <th>Diagnóstico</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="consultas-detalle-tbody">
                            <!-- Las filas se llenarán dinámicamente con JS -->
                        </tbody>

                    </table>
                    <div id="consultas-detalle-paginacion"
                        class="d-flex justify-content-between align-items-center mt-4 px-3"></div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

    function reporte_ficha_pdf() {
        const id_paciente = document.getElementById('id-paciente').value || '0';

        if (!id_paciente || id_paciente === '0') {
            alert('El paciente debe estar registrado para generar el PDF.');
            return;
        }

        // Spinner
        const btnReporte = document.querySelector('.btn-reporte');
        if (btnReporte) {
            btnReporte.disabled = true;
            btnReporte.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Generando...';
        }

        fetch("{{ route('admin.pacientes.reportepdf') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
                "Accept": "application/pdf",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: id_paciente })
        })
            .then(response => {
                if (!response.ok) throw new Error('Error en el servidor');
                return response.blob();
            })
            .then(blob => {
                // 1. Crear el objeto con el tipo MIME correcto
                const file = new Blob([blob], { type: 'application/pdf' });
                const url = window.URL.createObjectURL(file);

                // 2. Crear un nombre descriptivo
                const nombreArchivo = `reporte-ficha-${id_paciente}.pdf`;

                // --- OPCIÓN: DESCARGA DIRECTA (Soluciona el error de conexión) ---
                const a = document.createElement('a');
                a.href = url;
                a.download = nombreArchivo; // AQUÍ SE ASIGNA EL NOMBRE
                document.body.appendChild(a);
                a.click();

                // 3. IMPORTANTE: No borrar el objeto inmediatamente
                // Le damos 10 segundos para que el navegador termine de procesar la descarga
                setTimeout(() => {
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                }, 10000);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al generar el PDF.');
            })
            .finally(() => {
                if (btnReporte) {
                    btnReporte.disabled = false;
                    btnReporte.innerHTML = '<i class="bi bi-file-pdf"></i> Generar Reporte';
                }
            });
    }

    function reporte_ficha_pdf3() {
        const id_paciente = document.getElementById('id-paciente').value || '0';

        if (!id_paciente || id_paciente === '0') {
            alert('El paciente debe estar registrado para generar el PDF.');
            return;
        }

        // --- EL CAMBIO EMPIEZA AQUÍ ---

        // 1. Creamos un formulario temporal (oculto)
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('admin.pacientes.reportepdf') }}";
        form.target = '_blank'; // Esto hace que se abra en pestaña nueva

        // 2. Agregamos el Token CSRF (indispensable para POST en Laravel)
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // 3. Agregamos el ID del paciente
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = id_paciente;
        form.appendChild(idInput);

        // 4. Lo añadimos al documento, lo enviamos y lo eliminamos
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

        // Nota: Como se abre una pestaña nueva, no es estrictamente necesario 
        // manejar el estado del botón "Generando...", pero si quieres puedes 
        // poner un pequeño delay para reactivarlo.
    }

    function reporte_ficha_pdf2() {
        // Mostrar loading
        const id_paciente = document.getElementById('id-paciente').value || '0';
        if (!id_paciente || id_paciente === '0') {
            alert('El paciente debe estar registrado para generar el PDF.');
            return;
        }

        const btnReporte = event?.target || null;
        if (btnReporte) {
            btnReporte.disabled = true;
            btnReporte.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generando...';
        }



        const data = {

            id: id_paciente
        }

        fetch("{{ route('admin.pacientes.reportepdf') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
                "Accept": "application/pdf",
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al generar el PDF');
                }
                return response.blob();
            })
            .then(blob => {
                // Crear URL del blob
                //const url = window.URL.createObjectURL(blob);

                // Opción A: Abrir en nueva pestaña con nombre
                // Abrir el PDF en una nueva pestaña con el nombre correcto
                // const fileName = 'reporte-paciente-' + id_paciente + '.pdf';
                // const pdfWindow = window.open('', '_blank');
                // if (pdfWindow) {
                //     pdfWindow.document.write(
                //         `<html><head><title>${fileName}</title></head><body style="margin:0">
                //         <embed src="${url}" type="application/pdf" width="100%" height="100%" />
                //         </body></html>`
                //     );
                // }

                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');

                a.href = url;
                // Aquí defines el nombre real que tendrá el archivo al bajarse
                a.download = `Reporte_Pacientes_${new Date().toISOString().slice(0, 10)}.pdf`;

                document.body.appendChild(a);
                a.click();

                // Limpieza
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);

                return;



                const url2 = window.URL.createObjectURL(blob);
                const nombreArchivo = 'Reporte-Pacientes-' + new Date().toLocaleDateString() + '.pdf';

                // 1. Abrir una nueva ventana en blanco
                const nuevaVentana = window.open();

                // 2. Inyectar un HTML básico con el título y un iframe que ocupe todo
                nuevaVentana.document.write(
                    `<html>
            <head>
                <title>${nombreArchivo}</title>
                <style>body { margin: 0; }</style>
            </head>
            <body>
                <embed src="${url}" type="application/pdf" width="100%" height="100%">
            </body>
        </html>`
                );

                // Opción B: Descargar directamente (descomenta si prefieres esto)
                // const a = document.createElement('a');
                // a.href = url;
                // a.download = 'reporte-pacientes-' + new Date().getTime() + '.pdf';
                // document.body.appendChild(a);
                // a.click();
                // document.body.removeChild(a);

                // Limpiar URL del blob después de un tiempo
                setTimeout(() => window.URL.revokeObjectURL(url), 100);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al generar el PDF: ' + error.message);
            })
            .finally(() => {
                // Restaurar botón
                if (btnReporte) {
                    btnReporte.disabled = false;
                    btnReporte.innerHTML = '<i class="bi bi-file-pdf"></i> Generar Reporte';
                }
            });
    }
    function reporte_ficha_pdf_get() {
        const id_paciente = document.getElementById('id-paciente').value || '0';
        if (!id_paciente || id_paciente === '0') {
            alert('El paciente debe estar registrado para generar el PDF.');
            return;
        }
        const url = "{{ url('/admin/pacientes/reporte/') }}/" + id_paciente;
        window.open(url, '_blank');
    }



    function reporte_todos_pdf() {
        const id_paciente = document.getElementById('id-paciente').value || '0';
        if (!id_paciente || id_paciente === '0') {
            alert('El paciente debe estar registrado para generar el PDF.');
            return;
        }
        const url = "{{ url('/admin/pacientes/reportetodos') }}/";
        window.open(url, '_blank');
    }

    function reporte_todos_pdf_bk() {
        fetch("{{ url('/admin/pacientes/reportetodos') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
                "Accept": "application/json"
            }
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.url) {
                    window.open(data.url, '_blank');
                } else {
                    alert('No se pudo generar el PDF.');
                }
            })
            .catch(error => {
                alert('Error al generar el PDF.');
                console.error(error);
            });
    }














    function preguntar(id, event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro de eliminar esta imagen?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarImagenConsulta(id);
            }
        });
    }




    function f_fecha_desde_mes() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        return `${yyyy}-${mm}-01`;
    }

    function f_fecha_hasta_mes() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = today.getMonth() + 1;
        // Obtener el último día del mes en curso
        const lastDay = new Date(yyyy, mm, 0).getDate();
        return `${yyyy}-${String(mm).padStart(2, '0')}-${String(lastDay).padStart(2, '0')}`;
    }
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener la URL actual


        const id = document.getElementById('id-producto').value || '0';


   

        document.getElementById('fecha-desde').value = f_fecha_desde_mes();
        document.getElementById('fecha-hasta').value = f_fecha_hasta_mes();

        // Actualizar el label de subtotal con el porcentaje de IVA

        // const url = window.location.pathname;
        // // Extraer el parámetro uno antes del final
        // const parts = url.split('/');
        // const id = parts[parts.length - 2];
        // alert('ID en la URL: ' + id);

      
    });

    async function cargar_citas(page = 1) {
        const tbody = document.getElementById('consultas-detalle-tbody');
        const paginacion = document.getElementById('consultas-detalle-paginacion');

        const search_citas = document.getElementById('search-citas').value;
        // const codigo_catalogo_search = document.getElementById('id-codigo-catalogo-search').value;
        //alert(`search_detalle: ${search_detalle}, page: ${page}, codigo_catalogo search: ${codigo_catalogo_search}`);
        const fecha_desde = document.getElementById('fecha-desde').value;
        const fecha_hasta = document.getElementById('fecha-hasta').value;
        const id_producto = document.getElementById('id-producto').value;
        //return;


        tbody.innerHTML = '<tr><td colspan="10">Cargando...</td></tr>';
        // console.log('Cargando citas con los parámetros:', {
        //     search_citas,
        //     page,
        //     id_producto,
        //     fecha_desde,
        //     fecha_hasta
        // });
        let url = `/admin/consultas/list?search=${encodeURIComponent(search_citas)}&producto_id=${encodeURIComponent(id_producto)}&page=${page}&fecha_desde=${encodeURIComponent(fecha_desde)}&fecha_hasta=${encodeURIComponent(fecha_hasta)}`;
        try {
            const response = await fetch(url);
            const result = await response.json();
            tbody.innerHTML = '';
            console.log('Resultado de la carga de citas:', result);
            if (result.data && result.data.length > 0) {
                result.data.forEach((consulta, idx) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${(result.from - 1) + idx + 1}</td>
                        <td>${consulta.id ?? ''}</td>
                        <td>${consulta.fecha ?? ''}</td>
                        <td>${consulta.tipo_consulta ?? ''}</td>
                        <td>${consulta.medicamentos ?? ''}</td>
                        <td>${consulta.antecedentes_familiares ?? ''}</td>
                        <td>${consulta.alergias ?? ''}</td>
                        <td>${consulta.antecedentes_personales ?? ''}</td>
                        <td>${consulta.comentario_4 ?? ''}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-success" type="button" onclick="document.getElementById('id-consulta').value='${consulta.id}'; consultar_cita();">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                        `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="10">No hay registros</td></tr>';
            }
            // Paginación
            if (result.last_page > 1) {
                let pagHtml = `<div class='text-muted'>Mostrando ${result.from} a ${result.to} de ${result.total} registros</div><nav><ul class='pagination'>`;
                for (let i = 1; i <= result.last_page; i++) {
                    pagHtml += `<li class='page-item${i === result.current_page ? ' active' : ''}'><a class='page-link' href='#' onclick='cargar_citas(${i});return false;'>${i}</a></li>`;
                }
                pagHtml += '</ul></nav>';
                paginacion.innerHTML = pagHtml;
            } else {
                paginacion.innerHTML = '';
            }
        } catch (err) {
            tbody.innerHTML = `<tr><td colspan="10">Error al cargar los datos: ${err && err.message ? err.message : JSON.stringify(err)}</td></tr>`;
            paginacion.innerHTML = '';
            console.error('Error al cargar los datos:', err);
        }
    }
    function nueva_cita() {
        document.getElementById('id-consulta').value = '0';
        document.getElementById('fecha-consulta').value = '';
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        document.getElementById('fecha-consulta').value = `${yyyy}-${mm}-${dd}`;
        document.getElementById('tipo-consulta').value = 'CON';
        document.getElementById('medicamentos').value = '';
        document.getElementById('antecedentes-personales').value = '';
        document.getElementById('antecedentes-familiares').value = '';
        document.getElementById('alergias').value = '';
        document.getElementById('comentario_1').value = '';
        document.getElementById('comentario_2').value = '';
        document.getElementById('comentario_3').value = '';
        document.getElementById('comentario_4').value = '';


    }
    function registrar_cita() {



        const idConsulta = document.getElementById('id-consulta').value || '0';
        const accion = idConsulta === '0' ? 'I' : 'M';
        const idPaciente = document.getElementById('id-paciente').value;
        console.log('Insumos detalle a enviar:', insumosDetalle);

        const data = {
            accion: accion,
            id: idConsulta,
            paciente_id: idPaciente,
            fecha: document.getElementById('fecha-consulta').value,
            tipo_consulta: document.getElementById('tipo-consulta').value,
            medicamentos: document.getElementById('medicamentos').value,
            antecedentes_personales: document.getElementById('antecedentes-personales').value,
            antecedentes_familiares: document.getElementById('antecedentes-familiares').value,
            alergias: document.getElementById('alergias').value,
            comentario_1: document.getElementById('comentario_1').value,
            comentario_2: document.getElementById('comentario_2').value,
            comentario_3: document.getElementById('comentario_3').value,
            comentario_4: document.getElementById('comentario_4').value,
            detalles: insumosDetalle
        };

        console.log('Datos de consulta a enviar:', data);

        fetch(`/admin/consultas/registrar/${idConsulta}`, {
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
                console.log('Success:', data);
                document.getElementById('id-consulta').value = data.data.id;
                alert(accion === 'I' ? 'Consulta registrada exitosamente: ' + data.data.id : 'Consulta actualizada exitosamente: ' + data.data.id);


                // Redirigir al formulario de edición de la consulta si lo deseas
                // window.location.href = `/admin/consultas/${data.data.id}/edit`;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + (error.message || 'Error desconocido'));
            });
    }
    function consultar_cita() {
        const idConsulta = document.getElementById('id-consulta').value;
        // alert('Consultar atención para el ID de consulta: ' + idConsulta);




        // Lógica para cargar los datos y mostrar el modal de edición de catálogo detalle
        fetch(`/admin/consultas/${idConsulta}`)
            .then(response => response.json())
            .then(data => {
                //  console.log('Datos recibidos para consulta:', data);
                if (data.success) {
                    if (!data.data) {
                        alert("Consulta no existe");
                        return;
                    }
                    console.log('Datos de la consulta:', data.data);
                    // Asumiendo que tienes un modal y formulario para editar catálogo detalle
                    document.getElementById('fecha-consulta').value = data.data.fecha || '';
                    document.getElementById('medicamentos').value = data.data.medicamentos || '';
                    document.getElementById('antecedentes-personales').value = data.data.antecedentes_personales || '';
                    document.getElementById('antecedentes-familiares').value = data.data.antecedentes_familiares || '';
                    document.getElementById('alergias').value = data.data.alergias || '';
                    document.getElementById('comentario_1').value = data.data.comentario_1 || '';
                    document.getElementById('comentario_2').value = data.data.comentario_2 || '';
                    document.getElementById('comentario_3').value = data.data.comentario_3 || '';
                    document.getElementById('comentario_4').value = data.data.comentario_4 || '';
                    document.getElementById('tipo-consulta').value = data.data.tipo_consulta || '';


                    if (Array.isArray(data.data.imagenes) && data.data.imagenes.length > 0) {
                        // Renderiza las imágenes en la galería
                        // const galeriaRow = document.querySelector('#collapseFive .row');
                        const galeriaRow = document.getElementById('id_galeria');
                        if (galeriaRow) {
                            galeriaRow.innerHTML = '';
                            data.data.imagenes.forEach(imagen => {
                                const col = document.createElement('div');
                                col.className = 'col-md-3';
                                col.style.marginBottom = '20px';
                                col.innerHTML = `
                                        <div class="card shadow" style="box-shadow: 0 0 0 2px #0d6efd;">
                                            <a href="#" onclick="mostrarImagenMaximizada('${imagen.id}', '${imagen.imagen}')">
                                                <img src="${imagen.url || '/storage/' + imagen.imagen}" class="card-img-top" alt="Imagen del Producto"
                                                    style="width: 100%; height: 200px; object-fit: contain; object-position: center; background: #f8f9fa;">
                                            </a>
                                            <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="preguntar(${imagen.id}, event);">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                    
                                            </div>
                                        </div>
                                    `;
                                galeriaRow.appendChild(col);
                            });
                        }
                    } else {
                        const galeriaRow = document.getElementById('id_galeria');

                        if (galeriaRow) {
                            galeriaRow.innerHTML = '';
                            galeriaRow.innerHTML = `<div class="col-12 text-center text-muted py-4">No hay imágenes registradas.</div>`;
                        }
                    }


                    // Cargar los detalles de insumos
                    insumosDetalle = data.data.detalles || [];
                    if (Array.isArray(data.data.detalles)) {
                        insumosDetalle = [];
                        data.data.detalles.forEach(detalle => {
                            insumosDetalle.push({
                                producto_id: detalle.producto_id,
                                nombre: detalle.nombre_producto,
                                cantidad: detalle.cantidad,
                                descripcion: detalle.descripcion,
                                precio: detalle.precio,
                                total: detalle.total,
                                unidad_medida: detalle.unidad_medida,
                                precio_fraccion: detalle.precio_fraccion
                            });
                        });
                    } else {
                        insumosDetalle = [];
                    }
                    console.log('Insumos detalle cargados:', insumosDetalle);
                    console.log('Insumos detalle cargados (JSON):', JSON.stringify(insumosDetalle));
                    renderizarInsumos();

                    // Cambiar el tab actual a "paciente-consulta"
                    var tabTrigger = document.querySelector('a#paciente-consulta-tab');
                    if (tabTrigger) {
                        var tab = new bootstrap.Tab(tabTrigger);
                        tab.show();
                    }
                } else {
                    alert("Error al cargar los datos de la consulta");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    function registrar_paciente(tipo) {
        const idPacienteInput = document.getElementById('id-paciente').value;


        const accion = tipo === 'nuevo' ? 'I' : 'M';
        const id = document.getElementById('id-paciente').value;
        const data = {
            accion: accion,
            id: id,
            nombres: document.getElementById('nombres').value,
            apellidos: document.getElementById('apellidos').value,
            tipo_identificacion: document.getElementById('tipo_identificacion').value,
            cedula: document.getElementById('cedula').value,
            email: document.getElementById('email').value,
            telefono: document.getElementById('telefono').value,
            direccion: document.getElementById('direccion').value,
            fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
            estado: document.getElementById('estado').value
        };

        console.log('Datos a enviar:', data);

        fetch(`/admin/pacientes/registrar/${id}`, {
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
                console.log('Success:', data);

                alert(accion === 'I' ? 'Paciente registrado exitosamente' + data.data.id : 'Paciente actualizado exitosamente' + data.data.id);
                // Redirigir al formulario de edición del paciente
                window.location.href = `/admin/pacientes/${data.data.id ?? id}/edit`;
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.errors) {
                    if (error.errors.nombres) {
                        document.getElementById('error-nombres').textContent = error.errors.nombres[0];
                    }
                    if (error.errors.apellidos) {
                        document.getElementById('error-apellidos').textContent = error.errors.apellidos[0];
                    }
                    if (error.errors.cedula) {
                        document.getElementById('error-cedula').textContent = error.errors.cedula[0];
                    }
                    if (error.errors.tipo_identificacion) {
                        document.getElementById('error-tipo_identificacion').textContent = error.errors.tipo_identificacion[0];
                    }
                } else {
                    alert('Error: ' + (error.message || 'Error desconocido'));
                }
            });
    }


</script>
@endpush