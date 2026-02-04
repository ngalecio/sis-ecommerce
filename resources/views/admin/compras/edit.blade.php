@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 id="titulo">
               
                    <button id="btn-consultar" type="button" class="btn btn-info"
                        style="float: right; margin-left: 10px;" onclick="consultar_compra();">
                        <i class="bi bi-search"></i> Consultar
                    </button>

                    <button id="btn-registrar" type="button" class="btn btn-primary"
                        style="float: right; margin-left: 10px;" onclick="registrar_compra();">
                        <i class="bi bi-save"></i> Registrar
                    </button>

                    <a href="{{ url('/admin/compras/0/edit') }}" style="float: right; margin-left: 10px;"
                        class="btn btn-success">
                        <i class="bi bi-plus"></i> Nuevo</a>



                    <button type="button" class="btn btn-primary" style="float: right; margin-left: 10px;"
                        onclick="reporte_ficha_pdf()">
                        <i class="bi bi-person-plus"></i> PDF FICHA
                    </button>
                    <button type="button" class="btn btn-primary" style="float: right; margin-left: 10px;"
                        onclick="reporte_todos_pdf()">
                        <i class="bi bi-person-plus"></i> PDF TODOS
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id-comprobante" class="form-label">N° Compra</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-hash"></i></span>
                                <input type="text" name="id-comprobante" id="id-comprobante" disabled
                                    value="{{ old('id-comprobante') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="id-comprobante" class="form-label">N° Comprabante</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-receipt"></i></span>
                                <input type="text" name="numero-comprobante" id="numero-comprobante" disabled
                                   class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha_comprobante" class="form-label">Fecha de Compra</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                <input type="date" name="fecha-comprobante" id="fecha-comprobante"
                                    value="{{ old('fecha-comprobante') }}" class="form-control"
                                    placeholder="Seleccione la fecha de compra">
                            </div>
                            @error('fecha-comprobante')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo_comprobante" class="form-label">Tipo de Compra</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                                <select name="tipo-comprobante" id="tipo-comprobante" class="form-select" required disabled>
                                    <option value="">-- Seleccione --</option>
                                    <option value="CO">
                                        COMPRA</option>
                                    <option value="FA" >
                                        VENTA</option>
                                    <option value="VA">
                                        OTRO</option>
                                </select>
                            </div>
                            @error('tipo-comprobante')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="producto" class="form-label">Proveedor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-box"></i></span>
                                <select class="form-select" id="id-proveedor" name="id-proveedor" required
                                    onchange="actualizarDatosProveedor()">

                                    <option value="">-- Seleccione Proveedor --</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="antecedentes_personales" class="form-label">Identificación
                                Proveedor
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                <input type="text" name="identificacion" id="identificacion"
                                    value="{{ old('identificacion') }}" class="form-control"
                                    placeholder="Ingrese la identificación del proveedor">
                            </div>
                            @error('identificacion')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombres" class="form-label">Nombre Proveedor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="nombres" id="nombres" value="{{ old('nombres') }}"
                                    class="form-control" placeholder="Ingrese el Nombre">
                            </div>
                            @error('nombres')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellidos" class="form-label">Apellido Proveedor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') }}"
                                    class="form-control" placeholder="Ingrese el Apellido">
                            </div>
                            @error('apellidos')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion" class="form-label">Dirección Proveedor
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}"
                                    class="form-control" placeholder="Ingrese la Dirección">
                            </div>
                            @error('direccion')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}"
                                    class="form-control" placeholder="Ingrese el Teléfono">
                            </div>
                            @error('telefono')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="form-control" placeholder="Ingrese el Email">
                            </div>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="condicion_credito" class="form-label">Condicion de Credito</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                                <select name="condicion-credito" id="condicion-credito" class="form-control">
                                    <option value="">-- Seleccione una condicion --</option>
                                    @foreach($condiciones_credito as $condicion)
                                    <option value="{{ $condicion->codigo_catalogo_detalle }}">
                                        {{ $condicion->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="antecedentes_personales" class="form-label">Tipo de documento

                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                                <input type="text" name="tipo-documento" id="tipo-documento"
                                    value="{{ old('tipo-documento') }}" class="form-control"
                                    placeholder="Ingrese la identificación del proveedor">
                            </div>
                            @error('tipo-documento')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Detalle de Compra
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="producto" class="form-label">Producto</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-box"></i></span>
                                                <select class="form-select" id="id-productos-insumos"
                                                    name="id-productos-insumos" required
                                                    onchange="actualizarPrecioInsumo()">

                                                    <option value="">-- Seleccione Producto --</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad" class="form-label">Cantidad</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-123"></i></span>
                                                <input type="number" class="form-control" id="cantidad" name="cantidad"
                                                    placeholder="Cantidad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                                <input type="text" class="form-control" id="descripcion"
                                                    name="descripcion" placeholder="Descripción">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio" class="form-label">Precio</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="bi bi-currency-dollar"></i></span>
                                                <input type="number" step="0.01" class="form-control" id="precio"
                                                    name="precio" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-start">
                                        <div class="form-group w-100">
                                            <label class="form-label" style="visibility:hidden;">&nbsp;</label>
                                            <div class="input-group justify-content-start">
                                                <button type="button" class="btn btn-success" onclick="agregarInsumo()">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                    <th>Descripción</th>
                                                    <th>Precio</th>
                                                    <th>Total</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="insumos-detalle-tbody">
                                                <!-- Las filas se llenarán dinámicamente con JS -->
                                            </tbody>

                                        </table>
                                        <div id="insumos-detalle-paginacion"
                                            class="d-flex justify-content-between align-items-center mt-4 px-3">
                                        </div>
                                    </div>
                                    <div class="col-md-4 offset-md-8">
                                        <div class="row">
                                            <div class="col-6 text-end">
                                                <label class="fw-bold">Subtotal 0:</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span id="insumos-subtotal-cero" class="ms-2">0.00</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <label id="lbl_subtotal_impuesto" class="fw-bold">Subtotal:</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span id="insumos-subtotal-impuesto" class="ms-2">0.00</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <label class="fw-bold">Descuento:</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span id="insumos-descuento" class="ms-2">0.00</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <label id="lbl_iva" class="fw-bold">IVA (12%):</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span id="insumos-iva" class="ms-2">0.00</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <label class="fw-bold">ICE:</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span id="insumos-ice" class="ms-2">0.00</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <label class="fw-bold">Total + IVA:</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span id="insumos-total-iva" class="ms-2">0.00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Comentario 2
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-people"></i></span>
                                                <textarea name="comentario_2" id="comentario_2" class="form-control"
                                                    rows="3"
                                                    placeholder="Comentario 2">{{ old('comentario_2') }}</textarea>
                                            </div>
                                            @error('comentario_2')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

    function reporte_ficha_pdf() {
        const idPacienteElem = document.getElementById('id-paciente');
        const id_paciente = idPacienteElem ? idPacienteElem.value || '0' : '0';

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
        const idPacienteElem = document.getElementById('id-paciente');
        const id_paciente = idPacienteElem ? idPacienteElem.value || '0' : '0';

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
        const idPacienteElem = document.getElementById('id-paciente');
        const id_paciente = idPacienteElem ? idPacienteElem.value || '0' : '0';
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
    function actualizarPrecioInsumo() {
        const productoSelect = document.getElementById('id-productos-insumos');
        const precio = productoSelect.options[productoSelect.selectedIndex]?.getAttribute('data-precio') || '';
       

        if (precio) {
            document.getElementById('precio').value = parseFloat(precio).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            document.getElementById('precio').value = '';
        }
    }

    async function cargarProveedores() {
        const lista_proveedores = document.getElementById('id-proveedor');
        if (!lista_proveedores.classList.contains('form-control')) {
            lista_proveedores.classList.add('form-control');
        }
        // Mostrar loading
        lista_proveedores.innerHTML = '<option value="">Cargando...</option>';
        let url = `/admin/clientes/proveedores-list`;


        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
           // console.log('Respuesta de la API de insumos:', result);
            //console.log('Datos recibidos:', result);

            // Limpiar selects antes de llenar
            lista_proveedores.innerHTML = '<option value="">Seleccione un código</option>';

            if (result.data && result.data.length > 0) {
                result.data.forEach((proveedor) => {
                    // Llenar lista_catalogos_search
                    const optionSearch = document.createElement('option');
                    optionSearch.value = proveedor.id;
                    optionSearch.textContent = `${proveedor.cedula}. ${proveedor.nombres} ${proveedor.apellidos}`;
                    optionSearch.setAttribute('data-nombres', proveedor.nombres);
                    optionSearch.setAttribute('data-apellidos', proveedor.apellidos);
                    optionSearch.setAttribute('data-cedula', proveedor.cedula);
                    optionSearch.setAttribute('data-direccion', proveedor.direccion);
                    optionSearch.setAttribute('data-telefono', proveedor.telefono);
                    optionSearch.setAttribute('data-email', proveedor.email);
                    lista_proveedores.appendChild(optionSearch);
                });
                initSelect2(lista_proveedores);
            } else {
                lista_proveedores.innerHTML = '<option value="">No hay códigos disponibles</option>';
            }

        } catch (err) {
            console.error('Error al cargar insumos:', err);
            lista_proveedores.innerHTML = '<option value="">Error al cargar los códigos</option>';
        }
    }

    function actualizarDatosProveedor() {
        const proveedorSelect = document.getElementById('id-proveedor');
        const identificacion = proveedorSelect.options[proveedorSelect.selectedIndex]?.getAttribute('data-cedula') || '';
        const nombres = proveedorSelect.options[proveedorSelect.selectedIndex]?.getAttribute('data-nombres') || '';
        const apellidos = proveedorSelect.options[proveedorSelect.selectedIndex]?.getAttribute('data-apellidos') || '';
        const direccion = proveedorSelect.options[proveedorSelect.selectedIndex]?.getAttribute('data-direccion') || '';
        const telefono = proveedorSelect.options[proveedorSelect.selectedIndex]?.getAttribute('data-telefono') || '';
        const email = proveedorSelect.options[proveedorSelect.selectedIndex]?.getAttribute('data-email') || '';
        if (identificacion) {
            document.getElementById('identificacion').value = identificacion;
        } else {
            document.getElementById('identificacion').value = '';
        }
        if (nombres) {
            document.getElementById('nombres').value = nombres;
        } else {
            document.getElementById('nombres').value = '';
        }
        if (apellidos) {
            document.getElementById('apellidos').value = apellidos;
        } else {
            document.getElementById('apellidos').value = '';
        }
        if (direccion) {
            document.getElementById('direccion').value = direccion;
        } else {
            document.getElementById('direccion').value = '';
        }
        if (telefono) {
            document.getElementById('telefono').value = telefono;
        } else {
            document.getElementById('telefono').value = '';
        }
        if (email) {
            document.getElementById('email').value = email;
        } else {
            document.getElementById('email').value = '';
        }



    }
    async function cargarProductosInsumos() {
        const lista_insumos = document.getElementById('id-productos-insumos');
        if (!lista_insumos.classList.contains('form-control')) {
            lista_insumos.classList.add('form-control');
        }
        // Mostrar loading
        lista_insumos.innerHTML = '<option value="">Cargando...</option>';
        let url = `/admin/productos/insumos-list`;


        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
           // console.log('Respuesta de la API de insumos:', result);
            //console.log('Datos recibidos:', result);

            // Limpiar selects antes de llenar
            lista_insumos.innerHTML = '<option value="">Seleccione un código</option>';

            if (result.data && result.data.length > 0) {
                console.log('Insumos recibidos:', result.data);
                result.data.forEach((insumo) => {
                    // Llenar lista_catalogos_search
                    const optionSearch = document.createElement('option');
                    optionSearch.value = insumo.id;
                    optionSearch.textContent = `${insumo.codigo} - ${insumo.nombre}`;
                    optionSearch.setAttribute('data-nombre', insumo.nombre);
                    optionSearch.setAttribute('data-precio', insumo.precio_compra);
                    lista_insumos.appendChild(optionSearch);
                });
                initSelect2(lista_insumos);
            } else {
                lista_insumos.innerHTML = '<option value="">No hay códigos disponibles</option>';
            }

        } catch (err) {
            console.error('Error al cargar insumos:', err);
            lista_insumos.innerHTML = '<option value="">Error al cargar los códigos</option>';

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

    // Array para almacenar los insumos agregados
    let insumosDetalle = [];
    let porcentajeIva = 0.12; // 12% de IVA
    let subtototalIva = 0;
    let subtotalCero = 0;
    let descuento = 0;
    let iva = 0;
    let totalIva = 0;
    let ice = 0;

    function agregarInsumo() {
        const productoSelect = document.getElementById('id-productos-insumos');
        const producto = productoSelect.value;
        const nombre = productoSelect.options[productoSelect.selectedIndex]?.getAttribute('data-nombre') || '';
        const cantidad = document.getElementById('cantidad').value;
        const descripcion = document.getElementById('descripcion').value;
        let precio = productoSelect.options[productoSelect.selectedIndex]?.getAttribute('data-precio') || '';
        precio = document.getElementById('precio').value || 0;
        if (!producto || !nombre || !cantidad || !descripcion || !precio) {
            alert('Complete todos los campos de insumo.');
            return;
        }
        // Agregar insumo al array
        insumosDetalle.push({
            producto_id: producto,
            nombre: nombre,
            cantidad: parseFloat(cantidad),
            descripcion,
            precio: parseFloat(precio),
            total: parseFloat(precio) * parseFloat(cantidad)
        });
        renderizarInsumos();
        // Limpiar los inputs
        // Limpiar y reinicializar el select de productos insumos
        const selectInsumos = document.getElementById('id-productos-insumos');
        $(selectInsumos).val('').trigger('change');
        // document.getElementById('nombre').value = '';
        document.getElementById('cantidad').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('precio').value = '';
    }

    // Renderiza la tabla de insumos desde el array
    function renderizarInsumos() {

        // <td class="text-end">$ ${parseFloat(insumo.precio).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
        const tbody = document.getElementById('insumos-detalle-tbody');
        tbody.innerHTML = '';
        insumosDetalle.forEach((insumo, idx) => {


  
            const cantidad_e = parseFloat(insumo.cantidad).toFixed(2);
            const precio_e = parseFloat(insumo.precio).toFixed(2);
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${insumo.producto_id}</td>
                <td>${insumo.nombre}</td>
                <td class="text-end">
                    <input type="number" class="form-control form-control-sm w-100 text-end" 
                        value="${cantidad_e}" 
                        min="1"
                        onblur="actualizarCantidadInsumo(${idx}, this.value)">
                </td>
                <td>${insumo.descripcion}</td>
                
                   
                
                    <input type="number" class="form-control form-control-sm w-100  text-end"
                        value="${precio_e}" 
                        min="1"
                        onblur="actualizarPrecioCompraInsumo(${idx}, this.value)">
                </td>
                <td class="text-end">$ ${(insumo.precio * insumo.cantidad).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger" onclick="eliminarInsumo(${idx});">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });



        subtototalIva = 0;
        subtotalCero = 0;
        descuento = 0;
        iva = 0;
        totalIva = 0;
        ice = 0;

        insumosDetalle.forEach(insumo => {
          subtototalIva += (insumo.cantidad || 0) * (insumo.precio || 0);
         //  console.log('Insumo:', insumo,' subtototalIva actual:', subtototalIva);
        });
        iva = subtototalIva * porcentajeIva;
        totalIva = subtototalIva + iva;
      //  console.log('subtototalIva:', subtototalIva, 'subtotalCero:', subtotalCero, 'descuento:', descuento, 'iva:', iva, 'totalIva:', totalIva, 'ice:', ice);


        const subtotalIvaElem = document.getElementById('insumos-subtotal-impuesto');
        const subtotalCeroElem = document.getElementById('insumos-subtotal-cero');
        const ivaElem = document.getElementById('insumos-iva');
        const totalIvaElem = document.getElementById('insumos-total-iva');

        if (subtotalIvaElem) {
            subtotalIvaElem.textContent = '$' + subtototalIva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            subtotalIvaElem.style.textAlign = 'right';
        }
        if (subtotalCeroElem) {
            subtotalCeroElem.textContent = '$' + subtotalCero.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            subtotalCeroElem.style.textAlign = 'right';
        }
        if (ivaElem) {
            ivaElem.textContent = '$' + iva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            ivaElem.style.textAlign = 'right';
        }
        if (totalIvaElem) {
            totalIvaElem.textContent = '$' + totalIva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            totalIvaElem.style.textAlign = 'right';
        }


    }

    // Actualiza la cantidad y recalcula el total
    function actualizarCantidadInsumo(idx, nuevaCantidad) {
        nuevaCantidad = parseFloat(nuevaCantidad) || 0;
        // Formatear nuevaCantidad con separador de miles y 2 decimales
      
        // Convertir de nuevo a número para cálculos
    
        if (nuevaCantidad < 1) nuevaCantidad = 1;
            insumosDetalle[idx].cantidad = nuevaCantidad;
            insumosDetalle[idx].total = insumosDetalle[idx].precio * nuevaCantidad;

        // Formatear el valor en el input usando celda
        // if (celda && celda.tagName === 'INPUT') {
        //     celda.value = Number(nuevaCantidad).toLocaleString('es-EC', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        // }
   


        renderizarInsumos();
    }

        function actualizarPrecioCompraInsumo(idx, nuevoPrecio) {
                nuevoPrecio = parseFloat(nuevoPrecio) || 0;
                if (nuevoPrecio < 1) nuevoPrecio = 1;
                insumosDetalle[idx].precio = nuevoPrecio;
                insumosDetalle[idx].total = nuevoPrecio * insumosDetalle[idx].cantidad;
                renderizarInsumos();
            }

    // Elimina un insumo del array y actualiza la tabla
    function eliminarInsumo(idx) {
        insumosDetalle.splice(idx, 1);
        renderizarInsumos();
    }

    function totalizar() {
        let total = 0;
        insumosDetalle.forEach(insumo => {
            total += (insumo.cantidad || 0) * (insumo.precio || 0);
        });
        alert('Total: $' + total.toFixed(2));
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



        const id = document.getElementById('id-comprobante').value || '0';
        //alert('ID Paciente:' + id);

        if (id === '0') {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            // document.getElementById('fecha_nacimiento').value = `${yyyy}-${mm}-${dd}`;
            // document.getElementById('tipo_identificacion').value = 'CEDULA';
        }

        // document.getElementById('fecha-desde').value = f_fecha_desde_mes();
        // document.getElementById('fecha-hasta').value = f_fecha_hasta_mes();
        nueva_compra();
        const url = window.location.pathname;
        // Extraer el parámetro uno antes del final
        const parts = url.split('/');
        const id_comprobante = parts[parts.length - 2];
       // alert('ID en la URL: ' + id_comprobante);

        cargarProductosInsumos();
        cargarProveedores();
        let porcentajeIva = 0.15;
        // Actualizar el label de subtotal con el porcentaje de IVA
        document.getElementById('lbl_subtotal_impuesto').textContent = 'Subtotal ' + (porcentajeIva * 100) + '%';
        document.getElementById('lbl_iva').textContent = 'IVA (' + (porcentajeIva * 100) + '%): ';

        // Cambiar el título dinámicamente según si es edición o registro
        const h4Titulo = document.getElementById('titulo');
        if (h4Titulo) {
            const id_comprobante_val = id_comprobante && id_comprobante !== '0';
            h4Titulo.childNodes[0].nodeValue = id_comprobante_val ? 'Edición de Compra ' : 'Registrar Compra ';
        }

        if (id_comprobante != 0) {
            document.getElementById('id-comprobante').value = id_comprobante;
            consultar_compra();
        }

    });


    function nueva_compra() {
        document.getElementById('id-comprobante').value = '0';
        document.getElementById('fecha-comprobante').value = '';
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        document.getElementById('fecha-comprobante').value = `${yyyy}-${mm}-${dd}`;
        document.getElementById('tipo-comprobante').value = 'CO';
        document.getElementById('identificacion').value = '';
        document.getElementById('nombres').value = '';
        document.getElementById('direccion').value = '';
        document.getElementById('telefono').value = '';
        document.getElementById('email').value = '';
        document.getElementById('tipo-documento').value = '';
        document.getElementById('numero-comprobante').value = '';

        // Asignar 0 a los campos de totales
      subtotalCero= 0;
      subtototalIva= 0;
        descuento= 0;
        iva= 0;
        totalIva= 0;


       const subtotalIvaElem = document.getElementById('insumos-subtotal-impuesto');
        const subtotalCeroElem = document.getElementById('insumos-subtotal-cero');
        const ivaElem = document.getElementById('insumos-iva');
        const totalIvaElem = document.getElementById('insumos-total-iva');

        if (subtotalIvaElem) {
            subtotalIvaElem.textContent = '$' + subtototalIva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            subtotalIvaElem.style.textAlign = 'right';
        }
        if (subtotalCeroElem) {
            subtotalCeroElem.textContent = '$' + subtotalCero.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            subtotalCeroElem.style.textAlign = 'right';
        }
        if (ivaElem) {
            ivaElem.textContent = '$' + iva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            ivaElem.style.textAlign = 'right';
        }
        if (totalIvaElem) {
            totalIvaElem.textContent = '$' + totalIva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            totalIvaElem.style.textAlign = 'right';
        }

    }
    function registrar_compra() {



        const id_comprobante = document.getElementById('id-comprobante').value || '0';
        const accion = id_comprobante === '0' ? 'I' : 'M';
        const idProveedor = document.getElementById('id-proveedor').value;
        const condicion_credito = document.getElementById('condicion-credito').value;

       // console.log('condicion credito:', condicion_credito);
       





        const data = {
            accion: accion,
            id: id_comprobante,
            cliente_id: idProveedor,
            fecha: document.getElementById('fecha-comprobante').value,
            valor_subtotal_iva: subtototalIva,
            valor_subtotal_cero: subtotalCero,
            valor_descuento: descuento,
            valor_iva: iva,
            valor_total: totalIva,
            valor_ice: ice,
            condicion_credito: condicion_credito,
            
            // tipo_consulta: document.getElementById('tipo-consulta').value,
            // medicamentos: document.getElementById('medicamentos').value,
            // antecedentes_personales: document.getElementById('antecedentes-personales').value,
            // antecedentes_familiares: document.getElementById('antecedentes-familiares').value,
            // alergias: document.getElementById('alergias').value,
            // comentario_1: document.getElementById('comentario_1').value,
            // comentario_2: document.getElementById('comentario_2').value,
            // comentario_3: document.getElementById('comentario_3').value,
            // comentario_4: document.getElementById('comentario_4').value,
            detalles: insumosDetalle
        };

        console.log('Datos de consulta a enviar:', data);

        fetch(`/admin/compras/registrar/${id_comprobante}`, {
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
                document.getElementById('id-comprobante').value = data.data.id;
                alert(accion === 'I' ? 'Compra registrada exitosamente: ' + data.data.id : 'Compra actualizada exitosamente: ' + data.data.id);
                consultar_compra();

                // Redirigir al formulario de edición de la consulta si lo deseas
                // window.location.href = `/admin/consultas/${data.data.id}/edit`;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + (error.message || 'Error desconocido'));
            });
    }
    function consultar_compra() {
        const id_comprobante = document.getElementById('id-comprobante').value;
    //    alert('Consultar atención para el ID de compra: ' + id_comprobante);




        // Lógica para cargar los datos y mostrar el modal de edición de catálogo detalle
        fetch(`/admin/compras/${id_comprobante}`)
            .then(response => response.json())
            .then(data => {
              
                if (data.success) {
                    if (!data.data) {
                        alert("Comprobante no existe");
                        return;
                    }
                    console.log('Datos de la compra v2:', data.data);
                    // Asumiendo que tienes un modal y formulario para editar catálogo detalle
          
                    document.getElementById('fecha-comprobante').value = data.data.fecha || '';
                    document.getElementById('id-proveedor').value = data.data.cliente_id || '';
                       if (window.$ && $.fn.select2) {
                        $('#id-proveedor').val(data.data.cliente_id).trigger('change');
                    }
                    document.getElementById('nombres').value = data.data.proveedor.nombres || '';
                    document.getElementById('apellidos').value = data.data.proveedor.apellidos || '';
                    document.getElementById('telefono').value = data.data.proveedor.telefono || '';
                    document.getElementById('email').value = data.data.proveedor.email || '';
                    document.getElementById('identificacion').value = data.data.proveedor.cedula || '';
                    document.getElementById('condicion-credito').value = data.data.condicion_credito || '';

                     document.getElementById('tipo-comprobante').value = data.data.tipo_comprobante || '';
                     document.getElementById('numero-comprobante').value = data.data.numero_comprobante || '';

                    // Deshabilitar el campo id-comprobante
                    
       

                    // Cargar los detalles de insumos
                    insumosDetalle = data.data.detalles || [];
                    if (Array.isArray(data.data.detalles)) {
                        insumosDetalle = [];
                        data.data.detalles.forEach(detalle => {
                            insumosDetalle.push({
                                producto_id: detalle.producto_id,
                                nombre: detalle.producto.nombre,
                                cantidad: detalle.cantidad,
                                descripcion: detalle.producto.descripcion,
                                precio: detalle.precio,
                                total: detalle.total
                            });
                        });
                    } else {
                        insumosDetalle = [];
                    }
                    renderizarInsumos();

                    // Cambiar el tab actual a "paciente-consulta"
              
                } else {
                    alert("Error al cargar los datos de la compra");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }



</script>
@endpush