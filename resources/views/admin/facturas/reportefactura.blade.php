<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #888;
            padding: 3px 4px;
            font-size: 9px;
            word-break: break-word;
        }
        th {
            background: #e7e7e7;
            font-weight: bold;
            text-align: left;
        }
        .footer {
            font-size: 8px;
            color: #666;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <title>Reporte de Pacientes</title>
</head>
<body>
    <div class="container">
        <!-- ENCABEZADO -->
        <table>
            <thead>

            </thead>

        </table>
        <!-- TABLA DE PACIENTES -->
        <table>
            <thead>
                <tr>
                    <th colspan="10" style="text-align:center; background:#fff;">
                        <span style="font-size:18px; font-weight:bold; color:#2d2d2d; letter-spacing:2px; text-transform:uppercase;">
                            CENTRO MÉDICO
                        </span><br>
                        <span style="font-size:10px; color:#555; margin-top:5px;">
                            Sistema de Gestión de Pacientes
                        </span>
                    </th>
                </tr>
                <tr>
                    <th colspan="8" style="text-align:left; font-size:13px; font-weight:bold; color:#2d2d2d; letter-spacing:1px; padding-top:5px; background:#fff;">
                        Pacientes Registrados
                    </th>
                    <th colspan="2" style="text-align:right; font-size:9px; color:#666; padding-top:5px; background:#fff;">
                        {{ now()->format('d/m/Y H:i') }}
                    </th>
                </tr>
                <tr>
                    <th style="width:3%;">#</th>
                    <th style="width:12%;">Nombre</th>
                    <th style="width:10%;">Cédula / DNI</th>
                    <th style="width:10%;">Fecha Nac.</th>
                    <th style="width:7%;">Edad</th>
                    <th style="width:7%;">Género</th>
                    <th style="width:10%;">Teléfono</th>
                    <th style="width:10%;">Celular</th>
                    <th style="width:15%;">Email</th>
                    <th style="width:16%;">Dirección</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $agrupados = collect($pacientes)->groupBy(function($p) {
                        return strtoupper($p->inicial_apellido);
                    });
                    $contador = 1;
                @endphp
                @forelse($agrupados as $inicial => $grupo)
                    <tr style="background:#f0f0f0; font-weight:bold;">
                        <td colspan="10">Inicial: {{ $inicial }} &mdash; Total: {{ count($grupo) }}</td>
                    </tr>
                    @foreach($grupo as $paciente)
                    <tr>
                        <td>{{ $contador++ }}</td>
                        <td>{{ $paciente->apellidos }} {{ $paciente->nombres }}</td>
                        <td>{{ $paciente->cedula ?? 'No registrado' }}</td>
                        <td>{{ $paciente->fecha_nacimiento ? \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') : 'No registrada' }}</td>
                        <td>{{ $paciente->fecha_nacimiento ? \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age . ' años' : 'N/A' }}</td>
                        <td>{{ $paciente->genero ?? 'No especificado' }}</td>
                        <td>{{ $paciente->telefono ?? 'No registrado' }}</td>
                        <td>{{ $paciente->celular ?? 'No registrado' }}</td>
                        <td>{{ $paciente->email ?? 'No registrado' }}</td>
                        <td>{{ $paciente->direccion ?? 'No registrada' }}</td>
                    </tr>
                    @endforeach
                @empty
                <tr>
                    <td colspan="10" style="text-align:center;">No hay pacientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <div class="footer-info">
                Este documento es confidencial y contiene información médica protegida.<br>
                Su uso está limitado exclusivamente al personal médico autorizado.
            </div>
            <div class="footer-date">
                Documento generado el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i:s') }}
            </div>
        </div>
    </div>
    <script type="text/php">
            if (isset($pdf)) {
                $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
                $font = $fontMetrics->getFont("DejaVu Sans");
                $size = 9;
                $color = array(0.5, 0.5, 0.5);
                
                // Posición: x, y (desde abajo a la derecha)
                $pdf->page_text(720, 565, $text, $font, $size, $color);
                
                // Opcional: Agregar el nombre del documento en el pie
                $pdf->page_text(30, 565, "Reporte de Pacientes", $font, $size, $color);
            }
        </script>
</body>
</html>


 


