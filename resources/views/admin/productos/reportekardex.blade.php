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
    <title>Reporte de Kardex</title>
</head>
<body>
    <div class="container">
        <!-- ENCABEZADO -->
  
        <!-- TABLA DE KARDEX -->
        <table>
            <thead>
                <tr>
                    <th colspan="15" style="text-align:center; background:#fff;">
                        <span style="font-size:18px; font-weight:bold; color:#2d2d2d; letter-spacing:2px; text-transform:uppercase;">
                        {{ $ajuste->nombre ?? 'Nombre de la Empresa' }}
                        </span><br>
                        <span style="font-size:10px; color:#555; margin-top:5px;">
                            {{ $ajuste->descripcion ?? 'Sistema de Gestion' }}
                        </span>
                    </th>
                </tr>
                <tr>
                    <th colspan="13" style="text-align:left; font-size:13px; font-weight:bold; color:#2d2d2d; letter-spacing:1px; padding-top:5px; background:#fff;">
                        Kardex de Producto: {{ $producto->nombre ?? 'N/A' }} ({{ $producto->codigo ?? 'N/A' }})
                    </th>
                    <th colspan="2" style="text-align:right; font-size:9px; color:#666; padding-top:5px; background:#fff;">
                        {{ now()->format('d/m/Y H:i') }}
                    </th>
                </tr>
                <tr>
                    <th style="width:4%;">#</th>
                    <th style="width:7%;">ID Kardex</th>
                    <th style="width:7%;">Fecha</th>
                    <th style="width:8%;">Tipo Movimiento</th>
                    <th style="width:7%;">Tipo Documento</th>
                    <th style="width:7%;">No. Documento</th>
                    <th style="width:7%;">Stock Anterior</th>
                    <th style="width:7%;">Costo Anterior</th>
                    <th style="width:7%;">Costo Total Ant</th>
                    <th style="width:7%;">Cantidad</th>
                    <th style="width:7%;">Costo Unitario</th>
                    <th style="width:7%;">Costo Total</th>
                    <th style="width:7%;">Stock Act</th>
                    <th style="width:7%;">Costo Act</th>
                    <th style="width:7%;">Costo Total Act</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $total = isset($kardex) ? count($kardex) : 0;
                @endphp

                @if($total > 0)
                    @foreach($kardex as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->id ?? '' }}</td>
                            <td>{{ $item->fecha ?? '' }}</td>
                            <td>{{ $item->tipo_movimiento ?? '' }}</td>
                            <td>{{ $item->tipo_documento ?? '' }}</td>
                            <td>{{ $item->numero_documento ?? '' }}</td>
                            <td style="text-align:right;">{{ isset($item->ant_cantidad) ? number_format($item->ant_cantidad, 0, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->ant_costo) ? '$' . number_format($item->ant_costo, 2, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->ant_costo_total) ? '$' . number_format($item->ant_costo_total, 2, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->nue_cantidad) ? number_format($item->nue_cantidad, 0, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->nue_costo) ? '$' . number_format($item->nue_costo, 2, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->nue_costo_total) ? '$' . number_format($item->nue_costo_total, 2, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->act_cantidad) ? number_format($item->act_cantidad, 0, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->act_costo) ? '$' . number_format($item->act_costo, 2, '.', ',') : '' }}</td>
                            <td style="text-align:right;">{{ isset($item->act_costo_total) ? '$' . number_format($item->act_costo_total, 2, '.', ',') : '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="15" style="text-align:center;">No hay movimientos de kardex registrados.</td>
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
                $pdf->page_text(30, 565, "Kardex", $font, $size, $color);
            }
        </script>
</body>
</html>


 


