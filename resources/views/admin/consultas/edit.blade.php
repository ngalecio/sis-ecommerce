@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="card">
        <div class="card-header">
            <h4 id="titulo">Cliente: 
                <button id="btn-consultar" type="button" class="btn btn-info" style="float: right; margin-left: 10px;"
                   hidden onclick="consultar_cita();">
                    <i class="bi bi-search"></i> Consultar
                </button>

                <button id="btn-registrar" type="button" class="btn btn-primary"
                    style="float: right; margin-left: 10px;" disabled onclick="registrar_cita(); ">
                    <i class="bi bi-plus"></i> Registrar
                </button>
                            <a href="{{ url('/admin/consultas/0/edit') }}" style="float: right; margin-left: 10px;" class="btn btn-success disabled" tabindex="-1" aria-disabled="true">
                                <i class="bi bi-plus"></i> Nuevo</a>

                                                    <!-- <button type="button" class="btn btn-primary" style="float: right; margin-left: 10px;" onclick="reporte_pdf()">
                                                        <i class="bi bi-person-plus"></i> PDF
                                                    </button>
                                                    <button type="button" class="btn btn-primary" style="float: right; margin-left: 10px;" onclick="reporte_todos_pdf()">
                                                        <i class="bi bi-person-plus"></i> PDF TODOS
                                                    </button> -->
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id-consulta" class="form-label">N° Atención</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-hash"></i></span>
                            <input type="text" name="id-consulta" id="id-consulta" value="{{ old('id-consulta') }}"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha_consulta" class="form-label">Fecha de Atención</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="fecha-consulta" id="fecha-consulta"
                                value="{{ old('fecha-consulta') }}" class="form-control"
                                placeholder="Seleccione la fecha de atención">
                        </div>
                        @error('fecha-consulta')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tipo_consulta" class="form-label">Tipo de Atención</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                            <select name="tipo-consulta" id="tipo-consulta" class="form-select" required>
                                <option value="">-- Seleccione --</option>
                                <option value="CON" {{ old('tipo-consulta')=='CON' ? 'selected' : '' }}>
                                    CONSULTA</option>
                                <option value="REV" {{ old('tipo-consulta')=='REV' ? 'selected' : '' }}>
                                    REVISION</option>
                                <option value="PRO" {{ old('tipo-consulta')=='PRO' ? 'selected' : '' }}>
                                    PROCEDIMIENTO</option>
                            </select>
                        </div>
                        @error('tipo-consulta')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="medicamentos" class="form-label">Medicamentos</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-capsule"></i></span>
                            <textarea name="medicamentos" id="medicamentos" class="form-control" rows="3"
                                placeholder="Ingrese Medicamentos">{{ old('medicamentos') }}</textarea>
                        </div>
                        @error('medicamentos')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="antecedentes_personales" class="form-label">Antecedentes
                            Patologicos
                            Personales</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-medical"></i></span>
                            <textarea name="antecedentes-personales" id="antecedentes-personales" class="form-control"
                                rows="3" placeholder="Antecedentes">{{ old('antecedentes-personales') }}</textarea>
                        </div>
                        @error('antecedentes-personales')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alergias" class="form-label">Alegias</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-exclamation-triangle"></i></span>
                            <textarea name="alergias" id="alergias" class="form-control" rows="3"
                                placeholder="Ingrese Medicamentos">{{ old('alergias') }}</textarea>
                        </div>
                        @error('alergias')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="antecedentes_familiares" class="form-label">Antecedentes
                            Familiares</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                            <textarea name="antecedentes-familiares" id="antecedentes-familiares" class="form-control"
                                rows="3"
                                placeholder="Antecedentes Familiares">{{ old('antecedentes-familiares') }}</textarea>
                        </div>
                        @error('antecedentes-familiares')
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
                            <h6>Insumos Utilizados</h6>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row" hidden>
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                                            <textarea name="comentario_1" id="comentario_1" class="form-control"
                                                rows="3"
                                                placeholder="Evolución Medica">{{ old('comentario_1') }}</textarea>
                                        </div>
                                        @error('comentario_1')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
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
                                        <label for="unidad_medida" class="form-label">Unidad
                                            Medida</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                            <input type="text" class="form-control" id="unidad_medida"
                                                name="unidad_medida" placeholder="Unidad Medida" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="precio" class="form-label">Precio</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                            <input type="number" step="0.01" class="form-control" id="precio"
                                                name="precio" placeholder="Precio" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="precio_fraccion" class="form-label">Precio por
                                            Fraccion</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                            <input type="number" step="0.01" class="form-control" id="precio_fraccion"
                                                name="precio_fraccion" placeholder="Precio por Fraccion" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-start">
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
                                                <th>Unidad de Medida</th>
                                                <th>Precio</th>
                                                <th>Precio por Fraccion</th>
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
                                    <div class="d-flex flex-column align-items-end">
                                        <div class="mb-1">
                                            <label id="lbl_subtotal_impuesto" class="fw-bold">SubTotal: </label>
                                            <span id="insumos-total" class="ms-2">0.00</span>
                                        </div>
                                        <div class="mb-1">
                                            <label id="lbl_iva" class="fw-bold">IVA (15%): </label>
                                            <span id="insumos-iva" class="ms-2">0.00</span>
                                        </div>
                                        <div>
                                            <label class="fw-bold">Total + IVA: </label>
                                            <span id="insumos-total-iva" class="ms-2">0.00</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="accordion-item" hidden>
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
                                                rows="3" placeholder="Comentario 2">{{ old('comentario_2') }}</textarea>
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
                <div class="accordion-item" hidden>
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Comentario 3
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                                            <textarea name="comentario_3" id="comentario_3" class="form-control"
                                                rows="3" placeholder="Comentario 3">{{ old('comentario_3') }}</textarea>
                                        </div>
                                        @error('comentario_3')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" hidden>
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Diagnostico
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                                            <textarea name="comentario_4" id="comentario_4" class="form-control"
                                                rows="3" placeholder="Diagnostico">{{ old('comentario_4') }}</textarea>
                                        </div>
                                        @error('comentario_4')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <h6>Galería de Imágenes</h6>
                        </button>
                    </h2>
                    <div class="modal fade" id="imagen_maximizada" tabindex="-1" aria-labelledby="imagenLabel_20"
                        aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                            <div class="modal-content" style="background: transparent; border: none;">
                                <div class="modal-header" style="border: none;">
                                    <button type="button" class="btn-close btn-close-white ms-auto"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center align-items-center p-0"
                                    style="height: 100vh;">
                                    <img src="" alt="Imagen del Producto"
                                        style="width: 100vw; height: 100vh; object-fit: contain; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Subir Imagen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="logo" class="form-label">Imagen</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-image"></i></span>
                                                        <input type="file" class="form-control" id="imagen"
                                                            name="imagen" accept="image/*" @error('imagen') is-invalid
                                                            @enderror onchange="mostrarImagen(event)">
                                                        @error('imagen')
                                                        <small style="color:red">{{
                                                            $message}}</small>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div style="display: flex; justify-content: center;">

                                                    <img src=""
                                                        style="max-width: 300px; margin-top: 10px; max-height: 200px;"
                                                        id="preview1" alt="">

                                                </div>
                                                <script>
                                                    const mostrarImagen = e =>
                                                        document.getElementById('preview1').src = URL.createObjectURL(e.target.files[0]);
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="subirImagen()">Subir
                                                        Imagen</button>

                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h4>Imágenes de la Atención
                                            <div style="float: right;" hidden>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="mostrarModalImagen()">
                                                    <i class="bi bi-plus"></i> Cargar Imagen
                                                </button>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row" id="id_galeria">
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

    function reporte_pdf() {
        const idComprobanteElem = document.getElementById('id-comprobante');
        const id_comprobante = idComprobanteElem ? idComprobanteElem.value || '0' : '0';

        if (!id_comprobante || id_comprobante === '0') {
            alert('El comprobante debe estar registrado para generar el PDF.');
            return;
        }

        // Spinner
        const btnReporte = document.querySelector('.btn-reporte');
        if (btnReporte) {
            btnReporte.disabled = true;
            btnReporte.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Generando...';
        }

        fetch("{{ route('admin.facturas.reportepdf') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
                "Accept": "application/pdf",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: id_comprobante })
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
                const nombreArchivo = `factura-${id_comprobante}.pdf`;

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

                const tipo_producto = productoSelect.options[productoSelect.selectedIndex]?.getAttribute('data-tipo-producto') || '';
                alert(`Tipo de producto seleccionado: ${tipo_producto}`);

                // Habilitar el input de precio

                document.getElementById('precio').disabled = true;
                if (tipo_producto === 'S') {
                    document.getElementById('precio').disabled = false;
                }

                if (precio) {
                    document.getElementById('precio').value = parseFloat(precio).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                } else {
                    document.getElementById('precio').value = '';
                }
            }
    function actualizarPrecioInsumo_BK() {
        const productoSelect = document.getElementById('id-productos-insumos');
        const precio = productoSelect.options[productoSelect.selectedIndex]?.getAttribute('data-precio') || '';

        const tipo_producto = productoSelect.options[productoSelect.selectedIndex]?.getAttribute('data-tipo-producto') || '';


        // Habilitar el input de precio

        document.getElementById('precio').disabled = true;
        if (tipo_producto === 'S') {
            document.getElementById('precio').disabled = false;
        }

        if (precio) {
            document.getElementById('precio').value = parseFloat(precio).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            document.getElementById('precio').value = '';
        }
    }

    async function cargarClientes() {
        const lista_clientes = document.getElementById('id-cliente');
        if (!lista_clientes.classList.contains('form-control')) {
            lista_clientes.classList.add('form-control');
        }
        // Mostrar loading
        lista_clientes.innerHTML = '<option value="">Cargando...</option>';
        let url = `/admin/clientes/clientes-list`;


        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            // console.log('Respuesta de la API de insumos:', result);
            //console.log('Datos recibidos:', result);

            // Limpiar selects antes de llenar
            lista_clientes.innerHTML = '<option value="">Seleccione un código</option>';

            if (result.data && result.data.length > 0) {
                result.data.forEach((cliente) => {
                    // Llenar lista_catalogos_search
                    const optionSearch = document.createElement('option');
                    optionSearch.value = cliente.id;
                    optionSearch.textContent = `${cliente.cedula}. ${cliente.nombres} ${cliente.apellidos}`;
                    optionSearch.setAttribute('data-nombres', cliente.nombres);
                    optionSearch.setAttribute('data-apellidos', cliente.apellidos);
                    optionSearch.setAttribute('data-cedula', cliente.cedula);
                    optionSearch.setAttribute('data-direccion', cliente.direccion);
                    optionSearch.setAttribute('data-telefono', cliente.telefono);
                    optionSearch.setAttribute('data-email', cliente.email);
                    lista_clientes.appendChild(optionSearch);
                });
                initSelect2(lista_clientes);
            } else {
                lista_clientes.innerHTML = '<option value="">No hay códigos disponibles</option>';
            }

        } catch (err) {
            console.error('Error al cargar insumos:', err);
            lista_clientes.innerHTML = '<option value="">Error al cargar los códigos</option>';
        }
    }

    function actualizarDatosCliente() {
        const clienteSelect = document.getElementById('id-cliente');
        const identificacion = clienteSelect.options[clienteSelect.selectedIndex]?.getAttribute('data-cedula') || '';
        const nombres = clienteSelect.options[clienteSelect.selectedIndex]?.getAttribute('data-nombres') || '';
        const apellidos = clienteSelect.options[clienteSelect.selectedIndex]?.getAttribute('data-apellidos') || '';
        const direccion = clienteSelect.options[clienteSelect.selectedIndex]?.getAttribute('data-direccion') || '';
        const telefono = clienteSelect.options[clienteSelect.selectedIndex]?.getAttribute('data-telefono') || '';
        const email = clienteSelect.options[clienteSelect.selectedIndex]?.getAttribute('data-email') || '';
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


            // Validar que los elementos existan

            // Agregar clase form-control si no la tiene
            if (!lista_insumos.classList.contains('form-control')) {
                lista_insumos.classList.add('form-control');
            }



            // Mostrar loading
            lista_insumos.innerHTML = '<option value="">Cargando...</option>';


            let url = `/admin/productos/productos-list`;
     


            try {
                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                console.log('Respuesta de la API de insumos:', result);
                //console.log('Datos recibidos:', result);

                // Limpiar selects antes de llenar
                lista_insumos.innerHTML = '<option value="">Seleccione un código</option>';

                if (result.data && result.data.length > 0) {
                    result.data.forEach((insumo) => {
                        // Llenar lista_catalogos_search
                        const optionSearch = document.createElement('option');
                        optionSearch.value = insumo.id;
                        optionSearch.textContent = `${insumo.codigo} - ${insumo.nombre}`;
                        optionSearch.setAttribute('data-nombre', insumo.nombre);
                        optionSearch.setAttribute('data-precio', insumo.precio);
                        optionSearch.setAttribute('data-unidad-medida', insumo.unidad_medida);
                        optionSearch.setAttribute('data-cantidad-por-unidad', insumo.cantidad_por_unidad || '1');
                        lista_insumos.appendChild(optionSearch);


                    });

                    // Inicializar select2 en lista_catalogos_search directamente

                    initSelect2(lista_insumos);


                    // Inicializar select2 en lista_catalogos solo cuando el modal se muestre




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
        const precio = document.getElementById('precio').value;


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
        document.getElementById('precio').disabled = true;
    }

    // Renderiza la tabla de insumos desde el array
        function renderizarInsumos() {
            const tbody = document.getElementById('insumos-detalle-tbody');
            tbody.innerHTML = '';
            insumosDetalle.forEach((insumo, idx) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${insumo.producto_id}</td>
                <td>${insumo.nombre}</td>
                <td>
                    <input type="number" class="form-control form-control-sm" 
                        value="${insumo.cantidad}" 
                        min="1"
                        style="width:80px"
                        onblur="actualizarCantidadInsumo(${idx}, this.value)">
                </td>
                <td>${insumo.unidad_medida}</td>
                <td class="text-end">$ ${insumo.precio.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                <td class="text-end">$ ${insumo.precio_fraccion.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                <td class="text-end">$ ${(insumo.total).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger" hidden onclick="eliminarInsumo(${idx});">
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


            let total = 0;
            insumosDetalle.forEach(insumo => {
                subtototalIva += (insumo.cantidad || 0) * (insumo.precio_fraccion || 0);
            });

            iva = subtototalIva * porcentajeIva;
            totalIva = subtototalIva + iva;


            document.getElementById('insumos-total').textContent = '$' + subtototalIva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('insumos-total').style.textAlign = 'right';
            document.getElementById('insumos-iva').textContent = '$' + iva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('insumos-iva').style.textAlign = 'right';
            document.getElementById('insumos-total-iva').textContent = '$' + totalIva.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            document.getElementById('insumos-total-iva').style.textAlign = 'right';


        }

    // Actualiza la cantidad y recalcula el total
    function actualizarCantidadInsumo(idx, nuevaCantidad) {
        nuevaCantidad = parseFloat(nuevaCantidad) || 0;
        if (nuevaCantidad < 1) nuevaCantidad = 1;
        insumosDetalle[idx].cantidad = nuevaCantidad;
        insumosDetalle[idx].total = insumosDetalle[idx].precio * nuevaCantidad;
        renderizarInsumos();
    }



        function mostrarImagenMaximizada(imagenId, imagenUrl) {

                // alert('Mostrar imagen ID: ' + imagenId + ', URL: ' + imagenUrl);


                // var myModal = new bootstrap.Modal(document.getElementById('imagen_maximizada'), {
                //     keyboard: false
                // });
                // myModal.show();


                // return;
                // Actualiza el src de la imagen en el modal antes de mostrarlo
                var modal = document.getElementById('imagen_maximizada');
                var img = modal.querySelector('img');
                if (img) {
                    img.src = '   /storage/' + imagenUrl;
                }
                var myModal = new bootstrap.Modal(modal, {
                    keyboard: false
                });
                myModal.show();
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



        const id = document.getElementById('id-consulta').value || '0';
        //alert('ID Paciente:' + id);

        if (id === '0') {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            // document.getElementById('fecha_nacimiento').value = `${yyyy}-${mm}-${dd}`;
            // document.getElementById('tipo_identificacion').value = 'CEDULA';
        }

        nueva_cita();
        const url = window.location.pathname;
        // Extraer el parámetro uno antes del final
        const parts = url.split('/');
        const id_consulta = parts[parts.length - 2];
        // alert('ID en la URL: ' + id_consulta);'id-proveedor'

        cargarProductosInsumos();
        //cargarClientes();
        let porcentajeIva = 0.15;
        // Actualizar el label de subtotal con el porcentaje de IVA
        document.getElementById('lbl_subtotal_impuesto').textContent = 'Subtotal ' + (porcentajeIva * 100) + '%';
        document.getElementById('lbl_iva').textContent = 'IVA (' + (porcentajeIva * 100) + '%): ';

        // Cambiar el título dinámicamente según si es edición o registro
    

        if (id_consulta != 0) {
            document.getElementById('id-consulta').value = id_consulta;
            consultar_cita();
        }

    });


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
    function registrar_factura() {



        const id_comprobante = document.getElementById('id-comprobante').value || '0';
        const accion = id_comprobante === '0' ? 'I' : 'M';
        const idProveedor = document.getElementById('id-cliente').value;
        const condicion_credito = document.getElementById('condicion-credito').value;

        // console.log('condicion credito:', condicion_credito);






        const data = {
            accion: accion,
            id: id_comprobante,
            cliente_id: idProveedor,
            fecha: document.getElementById('fecha-comprobante').value,
            valor_subtotal_iva: subtototalIva,
            valor_subtotal_cero: subtotalCero,
            valor_subtotal: subtototalIva + subtotalCero,
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

        fetch(`/admin/facturas/registrar/${id_comprobante}`, {
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
                alert(accion === 'I' ? 'Factura registrada exitosamente: ' + data.data.id : 'Factura actualizada exitosamente: ' + data.data.id);
                consultar_factura();

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


                        const h4Titulo = document.getElementById('titulo');
                    if (h4Titulo) {
                        const nombres = data.data.paciente && data.data.paciente.nombres ? data.data.paciente.nombres : '';
                        const apellidos = data.data.paciente && data.data.paciente.apellidos ? data.data.paciente.apellidos : '';
                        h4Titulo.childNodes[0].nodeValue =  'Cliente :' + nombres + ' ' + apellidos;
                    }



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
                                                    <button type="button" class="btn btn-sm btn-danger" hidden onclick="preguntar(${imagen.id}, event);">
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
                                descripcion: detalle.observacion != null ? detalle.observacion : '',
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


</script>
@endpush