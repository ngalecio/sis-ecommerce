<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\ConsultaDetalle;
use App\Models\ConsultaImagen;
use App\Models\Kardex;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ConsultaController extends Controller
{
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

    /**
     * Display the specified resource.
     */

    public function listJson(Request $request)
    {


   
 

    
        try {
            $buscar = $request->get('search');
            $fecha_desde = $request->get('fecha_desde');
            $fecha_hasta = $request->get('fecha_hasta');
            $paciente_id = $request->get('paciente_id');

            $query = Consulta::query();
            $query->select(
                'id',
                'fecha',
                'paciente_id',
                'tipo_consulta',
                'comentario_1',
                'comentario_2',
                'comentario_3',
                'comentario_4',
                'establecimiento',
                'alergias',
                'medicamentos',
                'antecedentes_personales',
                'antecedentes_familiares'
            );

            if ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('alergias', 'like', '%' . $buscar . '%')
                        ->orWhere('medicamentos', 'like', '%' . $buscar . '%')
                        ->orWhere('tipo_consulta', 'like', '%' . $buscar . '%')
                    
                        ->orWhere('antecedentes_personales', 'like', '%' . $buscar . '%')
                        ->orWhere('antecedentes_familiares', 'like', '%' . $buscar . '%')
                        ->orWhere('comentario_1', 'like', '%' . $buscar . '%')
                        ->orWhere('comentario_2', 'like', '%' . $buscar . '%')
                        ->orWhere('comentario_3', 'like', '%' . $buscar . '%')
                        ->orWhere('comentario_4', 'like', '%' . $buscar . '%');
                });
            }

            if ($paciente_id) {
                $query->where('paciente_id', $paciente_id);
            }

            if ($fecha_desde && $fecha_hasta) {
                $query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
            }
            $query->orderBy('fecha', 'desc');
            $consultas = $query->paginate(ENV('PAGINATE_SIZE', 10));

            return response()->json([
                'data' => $consultas->items(),
                'current_page' => $consultas->currentPage(),
                'last_page' => $consultas->lastPage(),
                'from' => $consultas->firstItem(),
                'to' => $consultas->lastItem(),
                'total' => $consultas->total(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las consultas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show(String $id)
    {
        $consulta = Consulta::select(
            'id',
            'fecha',
            'paciente_id',
            'tipo_consulta',
            'comentario_1',
            'comentario_2',
            'comentario_3',
            'comentario_4',
            'establecimiento',
            'alergias',
            'medicamentos',
            'antecedentes_personales',
            'antecedentes_familiares'
        )
            ->with([
                'paciente:id,nombres,apellidos,fecha_nacimiento',
                'imagenes:id,consulta_id,imagen',
                'detalles:id,consulta_id,producto_id,nombre_producto,descripcion,cantidad,precio,total,unidad_medida,precio_fraccion'
            ])
            ->find($id);

        return response()->json([
            'success' => true,
            'data' => $consulta
        ]);

    }



    public function registrar(Request $request, string $id)
    {
        Log::info('info del formulario', ['request' => $request->all(), 'Id' => $id]);

        // return response()->json(['success' => false, 'message' => 'Función registrar llamada correctamente.','request' => $request->all()   ], 401);

        try {
            $consulta = Consulta::find($id);

            if (!$consulta) {
                $consulta = new Consulta();
            }
            else
            {
                // El registro existe, proceder con la actualización
                ConsultaDetalle::where('consulta_id', $consulta->id)->delete();
                
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Consulta no encontrada.'], 404);
        }

        try {
            // Ajusta las reglas de validación según los campos de tu modelo Consulta
            $rules = [
                'fecha' => 'required|date',
                'paciente_id' => 'required|integer|exists:pacientes,id',
                'tipo_consulta' => 'required|string|max:100',
                'comentario_1' => 'nullable|string|max:255',
                'comentario_2' => 'nullable|string|max:255',
                'comentario_3' => 'nullable|string|max:255',
                'comentario_4' => 'nullable|string|max:255',
                'establecimiento' => 'nullable|string|max:255',
                'alergias' => 'nullable|string|max:255',
                'medicamentos' => 'nullable|string|max:255',
                'antecedentes_personales' => 'nullable|string|max:255',
                'antecedentes_familiares' => 'nullable|string|max:255',
            ];

            $request->validate($rules);

        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $consulta->fecha = $request->fecha;
            $consulta->paciente_id = $request->paciente_id;
            $consulta->tipo_consulta = $request->tipo_consulta;
            $consulta->comentario_1 = $request->comentario_1 ?? '';
            $consulta->comentario_2 = $request->comentario_2 ?? '';
            $consulta->comentario_3 = $request->comentario_3 ?? '';
            $consulta->comentario_4 = $request->comentario_4 ?? '';
            $consulta->establecimiento = $request->establecimiento ?? '';
            $consulta->alergias = $request->alergias ?? '';
            $consulta->medicamentos = $request->medicamentos ?? '';
            $consulta->antecedentes_personales = $request->antecedentes_personales ?? '';
            $consulta->antecedentes_familiares = $request->antecedentes_familiares ?? '';
            $consulta->save();


   

            foreach ($request->detalles as $detalle) {
                Log::info('Detalle de insumo', ['detalle' => $detalle]);
                $detalleModel = new ConsultaDetalle();
                $detalleModel->consulta_id = $consulta->id;
                $detalleModel->producto_id = $detalle['producto_id'];
                $detalleModel->nombre_producto = $detalle['nombre'] ?? '';
                $detalleModel->descripcion = $detalle['descripcion'] ?? '';
                $detalleModel->cantidad = $detalle['cantidad'];
                $detalleModel->precio = $detalle['precio'];
                $detalleModel->total = $detalle['total'];
                $detalleModel->unidad_medida = $detalle['unidad_medida'] ?? '';
                $detalleModel->precio_fraccion = $detalle['precio_fraccion'] ?? 0;
                $detalleModel->save();

                $producto = Producto::find($detalle['producto_id']);

                if ($producto) {

                    $costo_anterior = ($producto->costo_promedio ?? 0);
                    $stock_anterior = ($producto->stock ?? 0);
                    $costo_total_anterior = $costo_anterior * $stock_anterior;

                    $costo_anterior_fraccion = $producto->costo_promedio / $producto->cantidad_por_unidad;
                    $stock_anterior_fraccion = $producto->stock_fraccion ?? 0;
                    $costo_total_anterior_fraccion = $costo_anterior_fraccion * $stock_anterior_fraccion;




                    // Actualizar el stock del producto sumando la cantidad comprada}
              
                    $stock_nuevo_fraccion = 0;
                    $stock_nuevo = 0;
       
                    if ($detalleModel->unidad_medida!="UNIDAD") {
                        $multiplos = intdiv($detalle['cantidad'], $producto->cantidad_por_unidad);
                        $residuo = $detalle['cantidad'] % $producto->cantidad_por_unidad;
                        if ($producto->stock_fraccion >= $residuo) {
                            $stock_nuevo_fraccion = $stock_anterior_fraccion - $residuo;
                        } else {
                            $multiplos += 1;
                            $stock_nuevo_fraccion = $producto->cantidad_por_unidad - ($residuo- $stock_anterior_fraccion);
                        }
                        $stock_nuevo = $producto->stock - $multiplos;
                    }   
                    else
                    {
                        $stock_nuevo = $producto->stock - $detalle['cantidad'];
                    }
                    $producto->stock_fraccion = $stock_nuevo_fraccion;
                    $producto->stock = $stock_nuevo;
                    $producto->save();
                    $costo_total =  $costo_anterior * $detalle['cantidad'];
                    $kardex = new Kardex();
                    $fechaComprobante = $request->fecha ?? date('Y-m-d');
                    $kardex->anio = date('Y', strtotime($fechaComprobante));
                    $kardex->mes = date('m', strtotime($fechaComprobante));
                    $kardex->fecha = $request->fecha;
                    $kardex->fecha_hora = now();
                    $kardex->producto_id = $producto->id;
                    $kardex->establecimiento = "001";
                    $kardex->tipo_movimiento = 'EG';
                    $kardex->comprobante_id = $consulta->id;
                    $kardex->comprobante_detalle_id = $detalleModel->id;
                    $kardex->tipo_comprobante = "AT";
                    $kardex->fecha_e = $request->fecha;
                    $kardex->fecha_e = date('Ymd', strtotime($request->fecha));
                    $kardex->ant_cantidad = $stock_anterior;
                    $kardex->ant_costo = $costo_anterior;
                    $kardex->ant_costo_total = $costo_total_anterior;

                    $kardex->ant_cantidad_fraccion = $stock_anterior_fraccion;
                    $kardex->ant_costo_fraccion = $costo_anterior_fraccion;
                    $kardex->ant_costo_fraccion_total = $costo_total_anterior_fraccion;

                    $kardex->nue_cantidad = $multiplos;
                    $kardex->nue_costo = $costo_anterior;
                    $kardex->nue_costo_total = $costo_anterior * $multiplos;
                    $kardex->nue_cantidad_fraccion = $residuo;
                    $kardex->nue_costo_fraccion = $costo_anterior_fraccion;
                    $kardex->nue_costo_fraccion_total = $costo_anterior_fraccion * $residuo;
                    $kardex->act_cantidad =  $stock_nuevo;
                    $kardex->act_costo = $costo_anterior;
                    $kardex->act_costo_total = $stock_nuevo * $costo_anterior;
                    $kardex->act_cantidad_fraccion =  $stock_nuevo_fraccion;
                    $kardex->act_costo_fraccion = $costo_anterior_fraccion;
                    $kardex->act_costo_fraccion_total =  $stock_nuevo_fraccion * $costo_anterior_fraccion;
                    $kardex->save();
                }

            }
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Consulta actualizada con éxito.', 'data' => $consulta], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al actualizar la consulta.', 'error' => $e->getMessage()], 500);
        }
    }

    public function upload_imagen(Request $request, string $id)
    {
        try {
            $request->validate([
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Datos de validación incorrectos.',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $consultaImagen = new ConsultaImagen();
            $consultaImagen->consulta_id = $id;
            if ($request->hasFile('imagen')) {
                $imagenPath = $request->file('imagen')->store('consulta_imagenes', 'public');
                $consultaImagen->imagen = $imagenPath;
            } else {
                throw new Exception('No se encontró el archivo de imagen.');
            }

            $consultaImagen->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Imagen subida exitosamente.',
                'data' => $consultaImagen
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la imagen.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function remove_imagen(String $id)
    {
        //
        try {
            $consultaImagen = ConsultaImagen::find($id);

            if (!$consultaImagen) {
            return response()->json([
                'success' => false,
                'message' => 'Imagen no encontrada.'
            ], 404);
            }

            $consultaId = $consultaImagen->consulta_id;

            if (Storage::disk('public')->exists($consultaImagen->imagen)) {
            Storage::disk('public')->delete($consultaImagen->imagen);
            }

            $consultaImagen->delete();

            return response()->json([
            'success' => true,
            'message' => 'Imagen eliminada exitosamente.',
            'consulta_id' => $consultaId
            ]);
        } catch (\Exception $e) {
            return response()->json([
            'success' => false,
            'message' => 'Error al eliminar la imagen.',
            'error' => $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consulta $consulta)
    {
        //
    }
}
