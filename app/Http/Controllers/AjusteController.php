<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return "hola ajuste";
        //$jsonData = file_get_contents(storage_path('app/ajustes/ajustes.json'));
        $ajuste = Ajuste::first();
        $jsonData = file_get_contents('https://api.hilariweb.com/divisas');
        $divisas = json_decode($jsonData, true);

       
        return view('admin.ajuste.index', compact('divisas', 'ajuste'));
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
        // Procesando la solicitud, estos son los datos recibidos:
        // return response()->json([
        //     'mensaje' => 'Datos recibidos correctamente.',
        //     'datos' => $request->all()
        // ]);


   


            try {
$ajuste=Ajuste::first();
    

            $rules=[
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:1000',
                'sucursal' => 'required|string|max:255',
                'direccion' => 'required|string|max:500',
                'telefonos' => 'nullable|string|max:255',
    
                'email' => 'required|email|max:255',
                'divisa' => 'required|string|max:10',
                'pagina_web' => 'nullable|url|max:255',
            ];


         

            if ($ajuste)
            {
                $rules['logo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                $rules['imagen_login'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
    
            }
            else{
                $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                $rules['imagen_login'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                $ajuste = new Ajuste();
            }

            
            $request->validate($rules);



            $ajuste->nombre = $request->nombre;
                $ajuste->descripcion = $request->descripcion;
                $ajuste->sucursal = $request->sucursal;
                $ajuste->direccion = $request->direccion;
                $ajuste->telefonos = $request->telefonos;
                $ajuste->email = $request->email;
                $ajuste->divisa = $request->divisa;
                $ajuste->pagina_web = $request->pagina_web;

                // Guardar logo
                if ($request->hasFile('logo')) {
                    if (isset($ajuste->logo)&& Storage::disk('public')->exists($ajuste->logo)) {
                        // Eliminar el logo anterior si existe
                        Storage::disk('public')->delete($ajuste->logo);
                    }
                    $logoPath = $request->file('logo')->store('logos', 'public');
                    $ajuste->logo = $logoPath;
                }

                // Guardar imagen_login
                if ($request->hasFile('imagen_login')) {
                if (isset($ajuste->imagen_login) && Storage::disk('public')->exists($ajuste->imagen_login)) {
                    // Eliminar el logo anterior si existe
                    Storage::disk('public')->delete($ajuste->imagen_login);
                }
                    $imagenLoginPath = $request->file('imagen_login')->store('imagen_login', 'public');
                    $ajuste->imagen_login = $imagenLoginPath;
                }

                if (!$ajuste->save()) {
                // return response()->json([
                //     'mensaje' => 'Error al guardar el ajuste.',
                //     'ajuste' => $ajuste
                // ], 500);
                return redirect()->route('admin.ajuste.index')
                    ->with('mensaje', 'Error al guardar el ajuste.')
                    ->with('icono', 'error');
                }


            return redirect()->route('admin.ajuste.index')
                ->with('mensaje', 'Ajuste guardado exitosamente.')
                ->with('icono', 'success');
                // return response()->json([
                //     'mensaje' => 'Datos guardados.',
                //     'datos' => $ajuste
                // ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'mensaje' => 'Error de validación.',
                    'errores' => $e->errors()
                ], 422);
            } catch (\Exception $e) {
                return response()->json([
                    'mensaje' => 'Ocurrió un error inesperado.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajuste $ajuste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
