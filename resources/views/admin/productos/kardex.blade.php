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
                                            <input type="text" id="search-producto" name="search-producto" class="form-control"
                                                placeholder="Buscar...">
                                            <button id="btn-buscar-citas" type="button" class="btn btn-primary" onclick="cargar_kardex()">
                                                <i class="bi bi-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end align-items-end" style="padding-top: 24px;">
                                    <div class="form-group">
                                        <button id="btn-crear-pdf" type="button" class="btn btn-primary" onclick="reporte_kardex_pdf()">
                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Kardex</th>
                                <th>Fecha</th>
                                <th>Tipo Movimiento</th>
                                <th>Tipo Documento</th>
                                <th>No. Documento</th>
                                <th>Stock Anterior</th>
                                <th>Costo Anterior</th>
                                <th>Costo Total Ant</th>
                                <th>Cantidad</th>
                                <th>Costo Unitario</th>
                                <th>Costo Total</th>
                                <th>Stock Act</th>
                                <th>Costo Act</th>
                                <th>Costo Total Act</th>

                               
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


    function reporte_kardex_pdf() {
        const id_producto = document.getElementById('id-producto').value || '0';
        if (!id_producto || id_producto === '0') {
            alert('El producto debe estar registrado para generar el PDF.');
            return;
        }
        const fecha_desde = document.getElementById('fecha-desde').value;
        const fecha_hasta = document.getElementById('fecha-hasta').value;

        // La ruta espera los parámetros como segmentos, no como query string
        const url = `{{ url('/admin/productos/reportekardex') }}/${id_producto}/${encodeURIComponent(fecha_desde)}/${encodeURIComponent(fecha_hasta)}`;
        window.open(url, '_blank');
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

    async function cargar_kardex(page = 1) {
        const tbody = document.getElementById('consultas-detalle-tbody');
        const paginacion = document.getElementById('consultas-detalle-paginacion');

        const search_producto = document.getElementById('search-producto').value;
        // const codigo_catalogo_search = document.getElementById('id-codigo-catalogo-search').value;
        //alert(`search_detalle: ${search_detalle}, page: ${page}, codigo_catalogo search: ${codigo_catalogo_search}`);
        const fecha_desde = document.getElementById('fecha-desde').value;
        const fecha_hasta = document.getElementById('fecha-hasta').value;
        const id_producto = document.getElementById('id-producto').value;
        //return;


        tbody.innerHTML = '<tr><td colspan="10">Cargando...</td></tr>';
        console.log('Cargando kardex con los parámetros:', {
            search_producto,
            page,
            id_producto,
            fecha_desde,
            fecha_hasta
        });
        let url = `/admin/productos/kardex-list?search=${encodeURIComponent(search_producto)}&producto_id=${encodeURIComponent(id_producto)}&page=${page}&fecha_desde=${encodeURIComponent(fecha_desde)}&fecha_hasta=${encodeURIComponent(fecha_hasta)}`;
        try {
            const response = await fetch(url);
            const result = await response.json();
            tbody.innerHTML = '';
            console.log('Resultado de la carga de kardex:', result);
            if (result.data && result.data.length > 0) {
                result.data.forEach((consulta, idx) => {
                    const tr = document.createElement('tr');
                    // Formatear fecha_hora a 'YYYY-MM-DD HH:mm'
                    let fechaHoraFormatted = '';
                    if (consulta.fecha_hora) {
                        const fechaObj = new Date(consulta.fecha_hora);
                        if (!isNaN(fechaObj.getTime())) {
                            const yyyy = fechaObj.getFullYear();
                            const mm = String(fechaObj.getMonth() + 1).padStart(2, '0');
                            const dd = String(fechaObj.getDate()).padStart(2, '0');
                            const hh = String(fechaObj.getHours()).padStart(2, '0');
                            const min = String(fechaObj.getMinutes()).padStart(2, '0');
                            fechaHoraFormatted = `${yyyy}-${mm}-${dd} ${hh}:${min}`;
                        } else {
                            fechaHoraFormatted = consulta.fecha_hora;
                        }
                    }
                    // Formatear ant_cantidad a miles sin decimales
                
                    tr.innerHTML = `
                        <td>${(result.from - 1) + idx + 1}</td>
                        <td>${consulta.id ?? ''}</td>
                        <td>${fechaHoraFormatted}</td>
                        <td>${consulta.tipo_movimiento ?? '-'}</td>
                        <td>${consulta.tipo_documento ?? '-'}</td>
                        <td>${consulta.numero_documento ?? '-'}</td>
                        <td>${formato_numero(consulta.ant_cantidad, 0)}</td>
                        <td>${formato_numero(consulta.ant_costo,2,true)}</td>
                        <td>${formato_numero(consulta.ant_costo_total,2,true)}</td>
                        <td>${formato_numero(consulta.nue_cantidad, 0)}</td>
                        <td>${formato_numero(consulta.nue_costo,2,true)}</td>
                        <td>${formato_numero(consulta.nue_costo_total,2,true)}</td>
                        <td>${formato_numero(consulta.act_cantidad, 0)}</td>
                        <td>${formato_numero(consulta.act_costo,2,true)}</td>
                        <td>${formato_numero(consulta.act_costo_total,2,true)}</td>
  
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
                    pagHtml += `<li class='page-item${i === result.current_page ? ' active' : ''}'><a class='page-link' href='#' onclick='cargar_kardex(${i});return false;'>${i}</a></li>`;
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

    function formato_numero(numero, decimales = 2,moneda = false) {
        if (numero === null || numero === undefined || isNaN(numero)) {
            return '-';
        }
        // Formato: separador de miles ',' y decimal '.'
        const opciones = {
            minimumFractionDigits: decimales,
            maximumFractionDigits: decimales,
            useGrouping: true
        };
        // 'en-US' usa ',' para miles y '.' para decimales
        // Forzar el locale 'en-US' para asegurar separador decimal '.' y miles ','
        if(moneda){
            return '$ ' + Number(numero).toLocaleString('en-US', opciones);
        }
        return Number(numero).toLocaleString('en-US', opciones);
    }


</script>
@endpush