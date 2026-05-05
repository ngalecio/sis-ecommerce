<!DOCTYPE html>
<html lang="es">
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
    <title>Compra</title>
</head>
<body>
    <div class="container">
        <!-- CABECERA DE COMPRA -->
        <table>
            <tr>
                <th colspan="6" style="text-align:center; background:#fff;">
                    <span style="font-size:18px; font-weight:bold; color:#2d2d2d; letter-spacing:2px; text-transform:uppercase;">
                        {{ $ajuste->nombre ?? 'Nombre de la Empresa' }}
                    </span><br>
                    <span style="font-size:10px; color:#555; margin-top:5px;">
                        {{ $ajuste->descripcion ?? 'Sistema de Gestion' }}
                    </span>
                </th>
            </tr>
            <tr>
                <td colspan="3"><strong>Compra N°:</strong> {{ $compra->numero_comprobante ?? '-' }}</td>
                <td colspan="3"><strong>Fecha:</strong> {{ $compra->fecha ? \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') : '-' }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Proveedor:</strong> {{ $compra->cliente->nombres ?? '-' }} {{ $compra->cliente->apellidos ?? '' }}</td>
                <td colspan="3"><strong>Cédula/DNI:</strong> {{ $compra->cliente->cedula ?? '-' }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Dirección:</strong> {{ $compra->cliente->direccion ?? '-' }}</td>
                <td colspan="3"><strong>Teléfono:</strong> {{ $compra->cliente->telefono ?? '-' }}</td>
            </tr>
        </table>
        <!-- DETALLE DE COMPRA -->
        <table>
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th style="width:40%;">Descripción</th>
                    <th style="width:15%;">Cantidad</th>
                    <th style="width:10%;">Precio Unitario</th>
                    <th style="width:10%;">Subtotal</th>
                    <th style="width:10%;">IVA</th>
                    <th style="width:10%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($compra->detalles as $detalle)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $detalle->producto->nombre ?? '-' }}</td>
                    <td style="text-align:right;">{{ number_format($detalle->cantidad, 2) }}</td>
                    <td style="text-align:right;">{{ number_format($detalle->precio, 2) }}</td>
                    <td style="text-align:right;">{{ number_format($detalle->subtotal, 2) }}</td>
                    <td style="text-align:right;">{{ number_format($detalle->iva, 2) }}</td>
                    <td style="text-align:right;">{{ number_format($detalle->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" style="text-align:right;">Subtotal</th>
                    <td style="text-align:right; font-weight:bold;">{{ number_format($compra->valor_subtotal, 2) }}</td>
                </tr>
                <tr>
                    <th colspan="6" style="text-align:right;">IVA</th>
                    <td style="text-align:right; font-weight:bold;">{{ number_format($compra->valor_iva, 2) }}</td>
                </tr>
                <tr>
                    <th colspan="6" style="text-align:right;">Total</th>
                    <td style="text-align:right; font-weight:bold;">{{ number_format($compra->valor_total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <div class="footer-info">
                Este documento es confidencial y contiene información protegida.<br>
                Su uso está limitado exclusivamente al personal autorizado.
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
            $pdf->page_text(720, 565, $text, $font, $size, $color);
            $pdf->page_text(30, 565, "Compra", $font, $size, $color);
        }
    </script>
</body>
</html>
