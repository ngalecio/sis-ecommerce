@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Atenciones Registradas
                                    <button id="btn-crear-pdf" type="button" class="btn btn-primary" style="float: right; margin-left: 10px;"
                                        onclick="reporte_consultas_pdf()">
                                        <i class="bi bi-file-earmark-pdf"></i> PDF
                                    </button>
                </h4>


            </div>
            <div class="card-body">
                                <form action="{{ url('/admin/consultas') }}" method="GET">
                                    <div class="row">
                                
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fecha-desde">Fecha Desde (*)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                                    <input type="date" name="fecha-desde" id="fecha-desde" class="form-control"
                                                        value="{{ $fecha_desde ?? request('fecha-desde') }}" required>
                                                </div>
                                                <small class="text-danger" id="error-fecha-desde"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fecha-hasta">Fecha Hasta (*)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                                    <input type="date" name="fecha-hasta" id="fecha-hasta" class="form-control"
                                                        value="{{ $fecha_hasta ?? request('fecha-hasta') }}" required>
                                                </div>
                                                <small class="text-danger" id="error-fecha-hasta"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                
                                            <div class="form-group">
                                                <label for="codigo-catalogo">Texto a Buscar (*)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                                    <input type="text" id="search" name="search" class="form-control"
                                                        value="{{ $buscar ?? request('search') }}" placeholder="Buscar Cliente...">
                                                    <button id="btn-buscar-citas" type="submit" class="btn btn-primary">
                                                        <i class="bi bi-search"></i>Buscar</button>
                                                </div>
                                            </div>
                                        </div>

                                
                                </form>
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>ID Atención</th>
                                        <th>Paciente</th>
                                        <th>Fecha</th>
                                        <th>Tipo Atención</th>
                                        <th>Productos que usa</th>
                                        <th>Historia Capilar</th>
                                        <th>Alergias</th>
                                        <th>Antecedentes de Procesos Químicos</th>
                                        <th>Tiene Caídas</th>
                                        <th class="text-center">Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach($consultas as $consulta)
                                        <tr>
                                            <td>{{ ($consultas->currentPage() -1)*$consultas->perPage()+$loop->iteration }}</td>
                                            <td>{{ $consulta->id }}</td>
                                            <td>{{ $consulta->paciente->apellidos ?? '' }} {{ $consulta->paciente->nombres ?? '' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}</td>
                                            <td>{{ $consulta->tipo_atencion }}</td>
                                            <td>{{ $consulta->medicamentos }}</td>
                                            <td>{{ $consulta->antecedentes_familiares }}</td>
                                            <td>{{ $consulta->alergias }}</td>
                                            <td>{{ $consulta->antecedentes_personales }}</td>
                                            <td>{{ $consulta->comentario_4 }}</td>
                                
                                            <td class="text-center">
                                
                                                <a href="{{ url('/admin/consultas/'.$consulta->id.'/edit') }}" class="btn btn-sm btn-success "><i
                                                        class="bi bi-pencil"></i>
                                
                                                </a>
                                
                                
                                            </td>
                                
                                
                                
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($consultas->hasPages())
                                <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                                    <div class="text-muted">
                                        Mostrando {{ $consultas->firstItem() }} a {{ $consultas->lastItem() }} de {{
                                        $consultas->total() }} registros
                                    </div>
                                    {{ $consultas->links('pagination::bootstrap-4') }}
                                </div>
                                @endif

            </div>


        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script>
        function reporte_consultas_pdf() {

                // Recuperar los valores de los campos de fecha
                const fechaDesde = document.getElementById('fecha-desde').value;
                const fechaHasta = document.getElementById('fecha-hasta').value;
                // Valida el estado con operador ternario
                let estado = document.getElementById('estado') ? document.getElementById('estado').value : '';
                const search = document.getElementById('search').value;

                // Construir la URL con los parámetros
                const url = `{{ url('/admin/consultas/reporteconsultaspdf') }}?search=${encodeURIComponent(search)}&fecha-desde=${encodeURIComponent(fechaDesde)}&fecha-hasta=${encodeURIComponent(fechaHasta)}`;
                window.open(url, '_blank');

            }
    // function f_fecha_desde_mes() {
    //     const today = new Date();
    //     const yyyy = today.getFullYear();
    //     const mm = String(today.getMonth() + 1).padStart(2, '0');
    //     return `${yyyy}-${mm}-01`;
    // }

    // function f_fecha_hasta_mes() {
    //     const today = new Date();
    //     const yyyy = today.getFullYear();
    //     const mm = today.getMonth() + 1;
    //     // Obtener el último día del mes en curso
    //     const lastDay = new Date(yyyy, mm, 0).getDate();
    //     return `${yyyy}-${String(mm).padStart(2, '0')}-${String(lastDay).padStart(2, '0')}`;
    // }
    // document.addEventListener('DOMContentLoaded', function () {
    //     // Obtener la URL actual




    //     document.getElementById('fecha-desde').value = f_fecha_desde_mes()
    //     document.getElementById('fecha-hasta').value = f_fecha_hasta_mes()

    //     cargarProductosInsumos();
    // });
</script>
@endpush