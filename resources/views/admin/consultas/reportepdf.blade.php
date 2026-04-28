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

        th,
        td {
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
    <title>Reporte de Atenciones</title>
</head>

<body>
    <div class="container">
        <!-- ENCABEZADO -->

        <!-- TABLA DE PRODUCTOS -->
        <table>
            <thead>
                <tr>
                    <th colspan="10" style="text-align:center; background:#fff;">
                        <span
                            style="font-size:18px; font-weight:bold; color:#2d2d2d; letter-spacing:2px; text-transform:uppercase;">
                            {{ $ajuste->nombre ?? 'Nombre de la Empresa' }}
                        </span><br>
                        <span style="font-size:10px; color:#555; margin-top:5px;">
                            {{ $ajuste->descripcion ?? 'Sistema de Gestion' }}
                        </span>
                    </th>
                </tr>
                <tr>
                    <th colspan="8"
                        style="text-align:left; font-size:13px; font-weight:bold; color:#2d2d2d; letter-spacing:1px; padding-top:5px; background:#fff;">
                        Atenciones Registradas
                    </th>
                    <th colspan="2"
                        style="text-align:right; font-size:9px; color:#666; padding-top:5px; background:#fff;">
                        {{ now()->format('d/m/Y H:i') }}
                    </th>
                </tr>
                <tr>
                    <th style="width:3%;">#</th>
                    <th style="width:7%;">ID Atención</th>
                    <th style="width:12%;">Paciente</th>
                    <th style="width:7%;">Fecha</th>
                    <th style="width:10%;">Tipo Atención</th>
                    <th style="width:12%;">Productos que usa</th>
                    <th style="width:10%;">Historia Capilar</th>
                    <th style="width:10%;">Alergias</th>
                    <th style="width:14%;">Antecedentes de Procesos Químicos</th>
                    <th style="width:15%;">Tiene Caídas</th>


                </tr>
            </thead>
            <tbody>


                @if($consultas)

                @foreach($consultas as $i => $consulta)
                <tr>
                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $consulta->id }}</td>
                                    <td>{{ $consulta->paciente->apellidos ?? '' }} {{ $consulta->paciente->nombres ?? '' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $consulta->tipo_atencion }}</td>
                                    <td>{{ $consulta->medicamentos }}</td>
                                    <td>{{ $consulta->antecedentes_familiares }}</td>
                                    <td>{{ $consulta->alergias }}</td>
                                    <td>{{ $consulta->antecedentes_personales }}</td>
                                    <td>{{ $consulta->comentario_4 }}</td>
                </tr>
                @endforeach

                @else
                <tr>
                    <td colspan="15" style="text-align:center;">No hay atenciones registrados.</td>
                </tr>
                @endif
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
                $pdf->page_text(30, 565, "Atenciones", $font, $size, $color);
            }
        </script>
</body>

</html>