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
    <title>Reporte de Productos</title>
</head>

<body>
    <div class="container">
        <!-- ENCABEZADO -->

        <!-- TABLA DE PRODUCTOS -->
        <table>
            <thead>
                    <tr>
                        <th colspan="12" style="text-align:center; background:#fff;">
                            <span style="font-size:18px; font-weight:bold; color:#2d2d2d; letter-spacing:2px; text-transform:uppercase;">
                            {{ $ajuste->nombre ?? 'Nombre de la Empresa' }}
                            </span><br>
                            <span style="font-size:10px; color:#555; margin-top:5px;">
                            {{ $ajuste->descripcion ?? 'Sistema de Gestion' }}
                            </span>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="10"
                            style="text-align:left; font-size:13px; font-weight:bold; color:#2d2d2d; letter-spacing:1px; padding-top:5px; background:#fff;">
                            Productos Registrados
                        </th>
                        <th colspan="2" style="text-align:right; font-size:9px; color:#666; padding-top:5px; background:#fff;">
                            {{ now()->format('d/m/Y H:i') }}
                        </th>
                    </tr>
                <tr>
                    <th style="width:6%;">#</th>
                    <th style="width:8%;">Id</th>
                    <th style="width:18%;">Producto</th>
                    <th style="width:5%;">Categoria</th>
                    <th style="width:8%;">Unidad Medida</th>
                    <th style="width:9%;">Precio Compra</th>
                    <th style="width:9%;">Precio Venta</th>
                    <th style="width:8%;">Stock</th>
                    <th style="width:8%;">Stock Fracción</th>
                    <th style="width:8%;">Tipo de Producto</th>
                    <th style="width:7%;">Aplica Iva</th>
                    <th style="width:6%;">Estado</th>
                </tr>
            </thead>
            <tbody>


                @if($productos)
         
                @foreach($productos as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->id ?? '' }}</td>
                    <td>{{ $item->nombre ?? '' }}</td>
                    <td>{{ $item->categoria_id ?? '' }}</td>
                    <td>{{ $item->unidad_medida ?? '' }}</td>
                    <td>{{ $item->precio_compra ?? '' }}</td>
                    <td>{{ $item->precio ?? '' }}</td>
                    <td>{{ $item->stock ?? '' }}</td>
                    <td>{{ $item->stock_fraccion ?? '' }}</td>
                    <td>{{ $item->tipo_producto ?? '' }}</td>
                    <td>{{ $item->aplica_iva ?? '' }}</td>
                    <td>{{ $item->estado ?? '' }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="15" style="text-align:center;">No hay productos registrados.</td>
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
                $pdf->page_text(30, 565, "Productos", $font, $size, $color);
            }
        </script>
</body>

</html>




