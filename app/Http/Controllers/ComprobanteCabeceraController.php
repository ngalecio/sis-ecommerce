<?php

namespace App\Http\Controllers;

use App\Models\CatalogoDetalle;
use App\Models\ComprobanteCabecera;
use App\Models\ComprobanteDetalle;
use App\Models\Kardex;
use App\Models\Paciente;
use App\Models\Producto;
use App\Models\Secuencia;
use Illuminate\Http\Request;

use Exception;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class ComprobanteCabeceraController extends Controller
{



    public function lista_facturas(Request $request)
    {
        $buscar = $request->get('search');
        $fecha_desde = $request->get('fecha-desde');
        $fecha_hasta = $request->get('fecha-hasta');



        // Consulta Eloquent con relación a Cliente
        $query = ComprobanteCabecera::with('cliente:id,nombres,apellidos,cedula,telefono,email')
            ->select('id', 'tipo_comprobante', 'cliente_id', 'fecha', 'valor_subtotal', 'valor_iva', 'valor_total', 'estado1', 'estado2', 'estado3', 'numero_comprobante')
            ->where('tipo_comprobante', 'FA');




        if ($fecha_desde && $fecha_hasta) {

            //     $query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        } else {
            $fecha_desde = date('Y-m-01');
            $fecha_hasta = date('Y-m-t');
            //$query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        }

        if ($buscar) {


            $query->whereHas('cliente', function ($q) use ($buscar) {
                $q->where('nombres', 'like', '%' . $buscar . '%')
                    ->orWhere('apellidos', 'like', '%' . $buscar . '%')
                    ->orWhere('cedula', 'like', '%' . $buscar . '%');
            });
        }
        $query->orderBy('fecha', 'desc');



        $facturas = $query->paginate(ENV('PAGE_SIZE'));
        $facturas->appends(['search' => $buscar]);
        $facturas->appends(['fecha-desde' => $fecha_desde, 'fecha-hasta' => $fecha_hasta]);
        return view('admin.facturas.index', compact('facturas', 'buscar', 'fecha_desde', 'fecha_hasta'));
    }

    public function registrarFactura(Request $request, string $id)
    {
        Log::info('info del formulario', ['request' => $request->all(), 'Id' => $id]);

       // return response()->json(['success' => false, 'message' => 'Función registrar llamada correctamente.','request' => $request->all()   ], 401);

        try {
            $comprobanteCabecera = ComprobanteCabecera::find($id);

            if (!$comprobanteCabecera) {
                $comprobanteCabecera = new ComprobanteCabecera();
            } else {
                // El registro existe, proceder con la actualización
                ComprobanteDetalle::where('comprobante_id', $comprobanteCabecera->id)->delete();
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Comprobante no encontrado.'], 404);
        }

        try {
            // Ajusta las reglas de validación según los campos de tu modelo Consulta
            $rules = [
                'fecha' => 'required|date',
                'cliente_id' => 'required|integer|exists:clientes,id',

            ];

            $request->validate($rules);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }
        
        try {
            DB::beginTransaction();
            $establecimiento = "001";
            $punto_emision = "001";
            $ultimo_numero = 1;
            $tipo_comprobante = 'FA';
            $comprobanteCabecera->fecha = $request->fecha;
            $comprobanteCabecera->cliente_id = $request->cliente_id;
            $comprobanteCabecera->tipo_comprobante = $tipo_comprobante;
            $comprobanteCabecera->estado3 = 'GEN';
            $comprobanteCabecera->valor_subtotal_cero = $request->valor_subtotal_cero ?? 0;
            $comprobanteCabecera->valor_subtotal_iva = $request->valor_subtotal_iva ?? 0;
            $comprobanteCabecera->valor_subtotal = $request->valor_subtotal ?? 0;
            $comprobanteCabecera->valor_descuento = $request->valor_descuento ?? 0;
            $comprobanteCabecera->valor_iva = $request->valor_iva ?? 0;
            $comprobanteCabecera->valor_total = $request->valor_total ?? 0;
            $comprobanteCabecera->establecimiento = $establecimiento;
            $comprobanteCabecera->punto_emision = $punto_emision;
            // Solo generar nuevo número de comprobante si es un registro nuevo ($id == 0)
            if ($id == 0) {
                $secuenciaComprobante = Secuencia::where('tipo_comprobante', 'FA')
                    ->where('establecimiento', $establecimiento)
                    ->where('punto_emision', $punto_emision)
                    ->first();
                if ($secuenciaComprobante) {
                    $ultimo_numero = $secuenciaComprobante->secuencia + 1;
                    $secuenciaComprobante->secuencia = $ultimo_numero;
                    $secuenciaComprobante->save();
                }
                $comprobanteCabecera->numero_comprobante = $comprobanteCabecera->establecimiento . '-' . $comprobanteCabecera->punto_emision . '-' . str_pad($ultimo_numero, 9, '0', STR_PAD_LEFT);
            }

            $comprobanteCabecera->condicion_credito = $request->condicion_credito ?? '';

            
            $comprobanteCabecera->save();

           
       



            if (isset($request->detalles) && is_array($request->detalles) && count($request->detalles) > 0) {
                foreach ($request->detalles as $detalle) {
                    Log::info('Detalle de insumo', ['detalle' => $detalle]);
                    $detalleModel = new ComprobanteDetalle();
                    $detalleModel->comprobante_id = $comprobanteCabecera->id;
                    $detalleModel->producto_id = $detalle['producto_id'];
                    $detalleModel->tipo_comprobante = $tipo_comprobante;
                    $detalleModel->cantidad = $detalle['cantidad'];
                    $detalleModel->precio = $detalle['precio'];
                    $detalleModel->subtotal = $detalle['total'];
                    $detalleModel->total = $detalle['total'];
                    $detalleModel->save();


                    $producto = Producto::find($detalle['producto_id']);

                    if ($producto) {


                        $costo_anterior_fraccion = $producto->costo_promedio / $producto->cantidad_por_unidad;
                        $stock_anterior_fraccion = $producto->stock_fraccion ?? 0;
                        $costo_total_anterior_fraccion = $costo_anterior_fraccion * $stock_anterior_fraccion;


                        // Actualizar el stock del producto sumando la cantidad comprada}
                        $costo_anterior = $producto->costo_promedio ?? 0;
                        $stock_anterior = $producto->stock ?? 0;
                        $costo_total_anterior = $costo_anterior * $stock_anterior;

                        $costo_total =  $costo_anterior * $detalle['cantidad'];
                        $stock_nuevo = $producto->stock - $detalle['cantidad'];
                        $nuevo_costo_promedio = $costo_anterior;
                      //  $producto->costo_promedio = $nuevo_costo_promedio;
                      //  $producto->precio_compra = $detalle['precio'];
                        $producto->stock -= $detalle['cantidad'];
                        $producto->save();

                        $kardex = new Kardex();
                        $fechaComprobante = $request->fecha ?? date('Y-m-d');
                        $kardex->anio = date('Y', strtotime($fechaComprobante));
                        $kardex->mes = date('m', strtotime($fechaComprobante));
                        $kardex->fecha = $request->fecha;
                        $kardex->fecha_hora = now();
                        $kardex->producto_id = $producto->id;
                        $kardex->establecimiento = $comprobanteCabecera->establecimiento;
                        $kardex->tipo_movimiento = 'EG';
                        $kardex->comprobante_id = $comprobanteCabecera->id;
                        $kardex->comprobante_detalle_id = $detalleModel->id;
                        $kardex->tipo_comprobante = $comprobanteCabecera->tipo_comprobante;
                        $kardex->fecha_e = $request->fecha;
                        $kardex->fecha_e = date('Ymd', strtotime($request->fecha));
                        $kardex->ant_cantidad = $stock_anterior;
                        $kardex->ant_costo = $costo_anterior;
                        $kardex->ant_costo_total = $costo_total_anterior;
                        $kardex->nue_cantidad = $detalle['cantidad'];
                        $kardex->nue_costo = $costo_anterior;
                        $kardex->nue_costo_total = $costo_anterior * $detalle['cantidad'];
                        $kardex->act_cantidad =  $stock_nuevo;
                        $kardex->act_costo = $nuevo_costo_promedio;
                        $kardex->act_costo_total = $costo_total_anterior- $costo_total;

                        $kardex->ant_cantidad_fraccion = $stock_anterior_fraccion;
                        $kardex->ant_costo_fraccion = $costo_anterior_fraccion;
                        $kardex->ant_costo_fraccion_total = $costo_total_anterior_fraccion;
                        $kardex->nue_cantidad_fraccion = 0;
                        $kardex->nue_costo_fraccion = $costo_anterior_fraccion;
                        $kardex->nue_costo_fraccion_total = 0;
                        $kardex->act_cantidad_fraccion =  $stock_anterior_fraccion;
                        $kardex->act_costo_fraccion = $costo_anterior_fraccion;
                        $kardex->act_costo_fraccion_total = $costo_total_anterior_fraccion;

                        $kardex->save();
                    }
                }
            }
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Compra actualizada con éxito.', 'data' => $comprobanteCabecera], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al actualizar la consulta.', 'error' => $e->getMessage()], 500);
        }
    }
    public function lista_compras(Request $request)
    {
        $buscar = $request->get('search');
        $fecha_desde = $request->get('fecha-desde');
        $fecha_hasta = $request->get('fecha-hasta');



        // Consulta Eloquent con relación a Cliente
        $query = ComprobanteCabecera::with('cliente:id,nombres,apellidos,cedula,telefono,email')
            ->select('id', 'tipo_comprobante', 'cliente_id', 'fecha', 'valor_subtotal', 'valor_iva', 'valor_total', 'estado1','estado2','estado3','numero_comprobante')
            ->where('tipo_comprobante', 'CO');




        if ($fecha_desde && $fecha_hasta) {

       //     $query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        } else
        {
        $fecha_desde = date('Y-m-01');
        $fecha_hasta = date('Y-m-t');
       //$query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        }

        if ($buscar) {


            $query->whereHas('cliente', function ($q) use ($buscar) {
            $q->where('nombres', 'like', '%' . $buscar . '%')
              ->orWhere('apellidos', 'like', '%' . $buscar . '%')
                 ->orWhere('cedula', 'like', '%' . $buscar . '%');
            });

        }
        $query->orderBy('fecha', 'desc');



        $compras = $query->paginate(ENV('PAGE_SIZE'));
        $compras->appends(['search' => $buscar]);
        $compras->appends(['fecha-desde' => $fecha_desde, 'fecha-hasta' => $fecha_hasta]);
        return view('admin.compras.index', compact('compras', 'buscar', 'fecha_desde', 'fecha_hasta'));
    }


    public function registrarCompra(Request $request, string $id)
    {
        Log::info('info del formulario', ['request' => $request->all(), 'Id' => $id]);

        // return response()->json(['success' => false, 'message' => 'Función registrar llamada correctamente.','request' => $request->all()   ], 401);

        try {
            $comprobanteCabecera = ComprobanteCabecera::find($id);

            if (!$comprobanteCabecera) {
                $comprobanteCabecera = new ComprobanteCabecera();
            } else {
                // El registro existe, proceder con la actualización
                ComprobanteDetalle::where('comprobante_id', $comprobanteCabecera->id)->delete();
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Comprobante no encontrado.'], 404);
        }

        try {
            // Ajusta las reglas de validación según los campos de tu modelo Consulta
            $rules = [
                'fecha' => 'required|date',
                'cliente_id' => 'required|integer|exists:clientes,id',
             
            ];

            $request->validate($rules);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $comprobanteCabecera->fecha = $request->fecha;
            $comprobanteCabecera->cliente_id = $request->cliente_id;
            $comprobanteCabecera->tipo_comprobante ='CO';
            $comprobanteCabecera->estado3 = 'GEN';
            $comprobanteCabecera->valor_subtotal_cero = $request->valor_subtotal_cero ?? 0;
            $comprobanteCabecera->valor_subtotal_iva = $request->valor_subtotal_iva ?? 0;
            $comprobanteCabecera->valor_subtotal = $request->valor_subtotal ?? 0;
            $comprobanteCabecera->valor_descuento = $request->valor_descuento ?? 0;
            $comprobanteCabecera->valor_iva = $request->valor_iva ?? 0; 
            $comprobanteCabecera->valor_total = $request->valor_total ?? 0;
            $comprobanteCabecera->establecimiento = "001";
            $comprobanteCabecera->punto_emision = "001";
            $comprobanteCabecera->condicion_credito = $request->condicion_credito ?? '';
            
            $comprobanteCabecera->save();

            $comprobanteCabecera->numero_comprobante = $comprobanteCabecera->establecimiento . '-' . $comprobanteCabecera->punto_emision . '-' . str_pad($comprobanteCabecera->id, 9, '0', STR_PAD_LEFT);
            $comprobanteCabecera->save();



            if (isset($request->detalles) && is_array($request->detalles) && count($request->detalles) > 0) {
                foreach ($request->detalles as $detalle) {
                    Log::info('Detalle de insumo', ['detalle' => $detalle]);
                    $detalleModel = new ComprobanteDetalle();
                    $detalleModel->comprobante_id = $comprobanteCabecera->id;
                    $detalleModel->producto_id = $detalle['producto_id'];
                    $detalleModel->tipo_comprobante = 'CO';
                    $detalleModel->cantidad = $detalle['cantidad'];
                    $detalleModel->precio = $detalle['precio'];
                    $detalleModel->subtotal = $detalle['total'];
                    $detalleModel->total = $detalle['total'];
                    $detalleModel->save();

                    $producto = Producto::find($detalle['producto_id']);

                    if ($producto) {
                        // Actualizar el stock del producto sumando la cantidad comprada}
                        $costo_anterior = $producto->costo_promedio ?? 0;
                        $stock_anterior = $producto->stock ?? 0;
                        $costo_total_anterior = $costo_anterior * $stock_anterior;

                        $costo_anterior_fraccion = $producto->costo_promedio / $producto->cantidad_por_unidad;
                        $stock_anterior_fraccion = $producto->stock_fraccion ?? 0;
                        $costo_total_anterior_fraccion = $costo_anterior_fraccion * $stock_anterior_fraccion;







                        $costo_total = $detalle['precio'] * $detalle['cantidad']; 
                        $stock_nuevo = $producto->stock + $detalle['cantidad'];
                        $nuevo_costo_promedio = ($costo_total_anterior + $costo_total) / $stock_nuevo;
                        $producto->costo_promedio = $nuevo_costo_promedio;
                        $producto->precio_compra = $detalle['precio'];
                        $producto->stock += $detalle['cantidad'];
                        $producto->save();



                        if ($producto->unidad_medida != "UNIDAD") {

                            $nuevo_costo_promedio_fraccion = $nuevo_costo_promedio / $producto->cantidad_por_unidad;
                           
                        } else {

                            $nuevo_costo_promedio_fraccion=0;
                        }
                           



                        $kardex = new Kardex();
                        $fechaComprobante = $request->fecha ?? date('Y-m-d');
                        $kardex->anio = date('Y', strtotime($fechaComprobante));
                        $kardex->mes = date('m', strtotime($fechaComprobante));
                        $kardex->fecha = $request->fecha;
                        $kardex->fecha_hora = now();
                        $kardex->producto_id = $producto->id;
                        $kardex->establecimiento = $comprobanteCabecera->establecimiento;
                        $kardex->tipo_movimiento = 'IN';
                        $kardex->comprobante_id = $comprobanteCabecera->id;
                        $kardex->comprobante_detalle_id = $detalleModel->id;
                        $kardex->tipo_comprobante = $comprobanteCabecera->tipo_comprobante;
                        $kardex->fecha_e = $request->fecha;
                        $kardex->fecha_e = date('Ymd', strtotime($request->fecha));
                        $kardex->ant_cantidad = $stock_anterior;
                        $kardex->ant_costo = $costo_anterior;
                        $kardex->ant_costo_total = $costo_total_anterior;
                        $kardex->nue_cantidad = $detalle['cantidad'];
                        $kardex->nue_costo = $detalle['precio'];
                        $kardex->nue_costo_total = $detalle['precio'] * $detalle['cantidad'];
                        $kardex->act_cantidad =  $stock_nuevo;
                        $kardex->act_costo = $nuevo_costo_promedio;
                        $kardex->act_costo_total = $costo_total_anterior + $costo_total;


                            $kardex->ant_cantidad_fraccion = $stock_anterior_fraccion;
                            $kardex->ant_costo_fraccion = $costo_anterior_fraccion;
                            $kardex->ant_costo_fraccion_total = $costo_total_anterior_fraccion;
                            $kardex->nue_cantidad_fraccion = 0;
                            $kardex->nue_costo_fraccion = 0;
                            $kardex->nue_costo_fraccion_total = 0;
                            $kardex->act_cantidad_fraccion =  $producto->stock_fraccion;
                            $kardex->act_costo_fraccion = $nuevo_costo_promedio_fraccion;
                            $kardex->act_costo_fraccion_total = $nuevo_costo_promedio_fraccion * $producto->stock_fraccion;
                        $kardex->save();

 
                    }
                }
            }
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Compra actualizada con éxito.', 'data' => $comprobanteCabecera], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al actualizar la consulta.', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function show(String $id)
    {
    }
    /**
     * Display the specified resource.
     */
    public function showCompra(String $id)
    {

    //return response()->json(['success' => false, 'message' => 'Función showCompra llamada correctamente.','Id' => $id   ], 401);

        $compra = ComprobanteCabecera::select(
            'id',
            'tipo_comprobante',
            'cliente_id',
            'fecha',
            'valor_subtotal_cero',
            'valor_subtotal_iva',
            'valor_subtotal',
            'valor_descuento',
            'valor_iva',
            'valor_total',
            'establecimiento',
            'punto_emision',
            'condicion_credito',
            'estado1',
            'estado2',
            'estado3',
            'numero_comprobante',
            'created_at',
            'updated_at'
        )
             ->with([
                 'proveedor:id,nombres,apellidos,direccion,telefono,email,cedula',
                 'detalles:id,comprobante_id,producto_id,cantidad,precio,total,subtotal',
                 'detalles.producto:id,nombre,descripcion,codigo',
             ])
            ->find($id);

        return response()->json([
            'success' => true,
            'data' => $compra
        ]);
    }


    public function showFactura(String $id)
    {

        //return response()->json(['success' => false, 'message' => 'Función showCompra llamada correctamente.','Id' => $id   ], 401);

        $factura = ComprobanteCabecera::select(
            'id',
            'tipo_comprobante',
            'cliente_id',
            'fecha',
            'valor_subtotal_cero',
            'valor_subtotal_iva',
            'valor_subtotal',
            'valor_descuento',
            'valor_iva',
            'valor_total',
            'establecimiento',
            'punto_emision',
            'condicion_credito',
            'estado1',
            'estado2',
            'estado3',
            'numero_comprobante',
            'created_at',
            'updated_at'
        )
            ->with([
                'cliente:id,nombres,apellidos,direccion,telefono,email,cedula',
                'detalles:id,comprobante_id,producto_id,cantidad,precio,total,subtotal',
                'detalles.producto:id,nombre,descripcion,codigo',
            ])
            ->find($id);

        return response()->json([
            'success' => true,
            'data' => $factura
        ]);
    }

    public function reportePDF(Request $request)
    {
        $id = $request->get('id');

        $factura = ComprobanteCabecera::select(
            'id',
            'tipo_comprobante',
            'cliente_id',
            'fecha',
            'valor_subtotal_cero',
            'valor_subtotal_iva',
            'valor_subtotal',
            'valor_descuento',
            'valor_iva',
            'valor_total',
            'establecimiento',
            'punto_emision',
            'condicion_credito',
            'estado1',
            'estado2',
            'estado3',
            'numero_comprobante',
            'created_at',
            'updated_at'
        )
            ->with([
                'cliente:id,nombres,apellidos,direccion,telefono,email,cedula',
                'detalles:id,comprobante_id,producto_id,cantidad,precio,total,subtotal',
                'detalles.producto:id,nombre,descripcion,codigo',
            ])
            ->find($id);
        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);

        // $pdf= Pdf::loadView('admin.pacientes.reporte', ['paciente' => $paciente]);
        // $pdf->setPaper('a4', 'portrait');
        // return $pdf->stream('reporte_paciente_'.$id.'.pdf');

        $pdf->loadView('admin.facturas.plantillafactura', compact('factura'));
        $pdf->setPaper('a4', 'portrait');

        $nombreArchivo = 'factura-' . ($factura->numero_comprobante ?? $factura->id) . '.pdf';


        return $pdf->stream($nombreArchivo);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        if ($id == 0) {
            $compra = null;
        } else {
            $compra = ComprobanteCabecera::findOrFail($id);
        }
        $condiciones_credito = CatalogoDetalle::where('codigo_catalogo', 'CONDICION_CREDITO')->get();
        return view('admin.compras.edit', compact('compra', 'condiciones_credito'));
    }

    public function editFactura(String $id)
    {
        if ($id == 0) {
            $factura = null;
        } else {
            $factura = ComprobanteCabecera::findOrFail($id);
        }
        $condiciones_credito = CatalogoDetalle::where('codigo_catalogo', 'CONDICION_CREDITO')->get();
        return view('admin.facturas.edit', compact('factura', 'condiciones_credito'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComprobanteCabecera $comprobanteCabecera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComprobanteCabecera $comprobanteCabecera)
    {
        //
    }
}
