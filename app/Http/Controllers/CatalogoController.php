<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function listJson(Request $request)
    {

        $buscar = $request->get('search');
        $query = Catalogo::query();
        if ($buscar) {
            $query->where('codigo', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%');
        }
        $catalogos = $query->paginate(ENV('PAGE_SIZE'));

        return response()->json([
            'data' => $catalogos->items(),
            'current_page' => $catalogos->currentPage(),
            'last_page' => $catalogos->lastPage(),
            'from' => $catalogos->firstItem(),
            'to' => $catalogos->lastItem(),
            'total' => $catalogos->total()
        ]);
    }
    public function listJsonTodos()
    {

        $catalogos = Catalogo::select('id', 'codigo', 'nombre')->get();
    
 

        return response()->json([
            'data' => $catalogos,
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
                // No se necesita excepción de ID aquí porque es una CREACIÓN
                'nombre' => 'required|string|max:60|unique:catalogos',
                'codigo' => 'required|string|max:255',
         
            ]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $catalogo = new Catalogo();
            $catalogo->nombre = $request->nombre;
            $catalogo->codigo = $request->codigo ?? '';
            $catalogo->save();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Catalogo creada con éxito.', 'data' => $catalogo], 201);
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
        $catalogo = Catalogo::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $catalogo
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
            $catalogo = Catalogo::findOrFail($id);
        

            if (!$catalogo) {
                return response()->json(['success' => false, 'message' => 'Catalogo no encontrada.'], 404);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Catalogo no encontrada.'], 404);
        }



        try {
            $request->validate([
                'nombre' => 'required|string|max:60|unique:catalogos,nombre,' . $catalogo->id . ',id',
                'codigo' => 'required|string|max:255',
           
            ]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }


        try {
            DB::beginTransaction();




            // $categoria = Categoria::findOrFail($id);

            // $caracteristica = $categoria->caracteristica;

            $catalogo->nombre = $request->nombre;
            $catalogo->codigo = $request->codigo ?? '';
            $catalogo->update();

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
