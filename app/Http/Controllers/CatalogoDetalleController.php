<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\CatalogoDetalle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use ReturnTypeWillChange;

class CatalogoDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function listJson(Request $request)
    {
        
        $buscar = $request->get('search');
        $codigo_catalogo = $request->get('id_codigo_catalogo');
        $query = CatalogoDetalle::query();
        $query->select('id', 'codigo_catalogo_detalle', 'nombre', 'valor_1', 'valor_2','valor_3','catalogo_id','codigo_catalogo');
        $query->with('catalogo:id,nombre,codigo');
        if (isset($codigo_catalogo) && !empty($codigo_catalogo)) {
            $query->where('catalogo_id', $codigo_catalogo);
        }
     

        if ($buscar) {
            $query->where('codigo_catalogo_detalle', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%');
        }
        $catalogos_detalle = $query->paginate(ENV('PAGE_SIZE'));

        return response()->json([
            'data' => $catalogos_detalle->items(),
            'current_page' => $catalogos_detalle->currentPage(),
            'last_page' => $catalogos_detalle->lastPage(),
            'from' => $catalogos_detalle->firstItem(),
            'to' => $catalogos_detalle->lastItem(),
            'total' => $catalogos_detalle->total(),
            
        ]);
    }

    public function index(Request $request)
    {
        //
        return view('admin.catalogos.index');

        $buscar = $request->get('search');
        $query = Catalogo::query();
        if ($buscar) {
            $query->where('codigo', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%');
        }




        $catalogos = $query->paginate(5);
        return view('admin.catalogos.index', compact('catalogos'));

    }
    public function index2(Request $request)
    {
        //
    

        $buscar = $request->get('search');
        $query = Catalogo::query();
        if ($buscar) {
            $query->where('codigo', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%');
        }




        $catalogos = $query->paginate(5);
        return view('admin.catalogos.index2', compact('catalogos'));
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
        Log::info('info del formulario', ['request' => $request->all()]);

      


        try {
            $request->validate([
            'id_codigo_catalogo' => 'required|integer|exists:catalogos,id',
            'nombre_detalle' => 'required|string|max:250',
            'codigo_catalogo_detalle' => 'required|string|max:255|unique:catalogo_detalles,codigo_catalogo_detalle',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }

     //   return response()->json(['success' => true, 'message' => 'Datos validados correctamente.'], 201);
        try {
            DB::beginTransaction();
            $catalogos_detalle = new CatalogoDetalle();
            $catalogos_detalle->nombre = $request->nombre_detalle;
            $catalogos_detalle->codigo_catalogo_detalle = $request->codigo_catalogo_detalle ?? '';
            $catalogos_detalle->catalogo_id = $request->id_codigo_catalogo;
            $catalogo = Catalogo::find($request->id_codigo_catalogo);
            $catalogos_detalle->codigo_catalogo = $catalogo ? $catalogo->codigo : '';
            $catalogos_detalle->valor_1 = $request->valor_1 ?? '0';
            $catalogos_detalle->valor_2 = $request->valor_2 ?? '0';
            $catalogos_detalle->valor_3 = $request->valor_3 ?? '0';
            $catalogos_detalle->save();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Catalogo detalle creada con éxito.', 'data' => $catalogos_detalle], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al crear la Catalogo.', 'error' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catalogos_detalle = CatalogoDetalle::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $catalogos_detalle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info('info del formulario', ['request' => $request->all(), 'Id' => $id]);

 

        try {
            $catalogos_detalle = CatalogoDetalle::findOrFail($id);
        

            if (!$catalogos_detalle) {
                return response()->json(['success' => false, 'message' => 'Catalogo no encontrada.'], 404);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Catalogo no encontrada.'], 404);
        }


        try {
            $request->validate([
            'id_codigo_catalogo' => 'required|integer|exists:catalogos,id',
            'nombre_detalle' => 'required|string|max:250',
            'codigo_catalogo_detalle' => 'required|string|max:255|unique:catalogo_detalles,codigo_catalogo_detalle,' . $id,
            ]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }


  


        try {
            DB::beginTransaction();




            // $categoria = Categoria::findOrFail($id);

            // $caracteristica = $categoria->caracteristica;
            $catalogo = Catalogo::findOrFail($request->id_codigo_catalogo);

            $catalogos_detalle->nombre = $request->nombre_detalle;
            $catalogos_detalle->codigo_catalogo_detalle = $request->codigo_catalogo_detalle ?? '';
            $catalogos_detalle->catalogo_id = $request->id_codigo_catalogo;
            $catalogos_detalle->codigo_catalogo = $catalogo ? $catalogo->codigo : '';
            $catalogos_detalle->valor_1 = $request->valor_1 ?? '0';
            $catalogos_detalle->valor_2 = $request->valor_2 ?? '0';
            $catalogos_detalle->valor_3 = $request->valor_3 ?? '0';
            $catalogos_detalle->update();

            DB::commit();
            //  return response()->json(['success' => true, 'message' => 'Categoría actualizada con éxito.','data'=>'AAA'], 201);

            return response()->json(['success' => true, 'message' => 'Catalogo actualizada con éxito.', 'data' => $catalogo], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al actualizar la catalogo.', 'error' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
