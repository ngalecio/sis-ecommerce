<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\CatalogoDetalle;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function listJsonInsumos()
    {

        $productos = Producto::select('id', 'codigo', 'nombre', 'precio', 'stock','precio_compra')
        ->where('tipo_producto', 'B')
        ->where('estado', 'A')
        ->take(10)->orderBy('id','desc')
        ->get();



        return response()->json([
            'data' => $productos,
        ]);
    }

    public function index(Request $request)
    {
        $ajuste= Ajuste::first();
        $buscar = $request->get('search');
        $query = Producto::query();
        $query->select('id', 'categoria_id', 'nombre', 'codigo', 'descripcion', 'precio', 'precio_compra'
        , 'stock', 'imagen', 'prescripcion', 'presentacion'
        , 'imprime_receta', 'aplica_iva'
        , 'tipo_producto', 'v_max', 'v_min', 'v_med', 'estado')
            ->with('categoria');
        if ($buscar) {
            $query->where('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('codigo', 'like', '%' . $buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $buscar . '%')
                ;
        }




        $productos = $query->paginate(ENV('PAGE_SIZE')*2);
        return view('admin.productos.index', compact('productos', 'buscar','ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        $unidades_medida = CatalogoDetalle::where('codigo_catalogo', 'UNIDAD_MEDIDA')->get();
        return view('admin.productos.create', compact('categorias','unidades_medida'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    
        try {
            $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:productos,codigo',
        
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'precio_compra' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $producto = new Producto();
            $producto->categoria_id = $request->categoria_id;
            $producto->nombre = $request->nombre;
            $producto->codigo = $request->codigo;
            $producto->descripcion = $request->descripcion;
      
            $producto->precio = $request->precio;
            $producto->precio_compra = $request->precio_compra;
            $producto->stock = $request->stock;
            $producto->prescripcion = $request->prescripcion;
            $producto->presentacion = $request->presentacion;
            $producto->imprime_receta = $request->imprime_receta ?? 0;
            $producto->aplica_iva = $request->aplica_iva ?? 0;
            $producto->tipo_producto = $request->tipo_producto;
            $producto->v_max = $request->precio;
            $producto->v_min = $request->precio;
            $producto->v_med = $request->precio;
            $producto->estado = $request->estado ?? 'A';
            $producto->unidad_medida = $request->unidad_medida ?? 'UNIDAD';
            $producto->cantidad_por_unidad = $request->cantidad_por_unidad ?? 1;
            $producto->stock_fraccion = 0;


            if ($request->hasFile('imagen')) {
                if (isset($producto->imagen) && Storage::disk('public')->exists($producto->imagen)) {
                    // Eliminar el logo anterior si existe
                    Storage::disk('public')->delete($producto->imagen);
                }
                $imagenPath = $request->file('imagen')->store('productos', 'public');
                $producto->imagen = $imagenPath;
            }
       
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('mensaje', 'Error al guardar el producto: ' . $e->getMessage())
                ->with('icono', 'error');

            //return response()->json(['error' => 'Error al guardar el producto: ' . $e->getMessage()], 500);

        }
      
        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto creado exitosamente.')
            ->with('icono', 'success');
    }


    public function upload_imagen(Request $request,string $id)
    {


        try {
            $request->validate([
            'imagen'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        
            $productoImagen = new ProductoImagen();
            $productoImagen->producto_id = $id;
            if ($request->hasFile('imagen')) {
                $imagenPath = $request->file('imagen')->store('producto_imagenes', 'public');
                $productoImagen->imagen = $imagenPath;
            }

       
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('mensaje', 'Error al guardar la imagen: ' . $e->getMessage())
                ->with('icono', 'error');

            //return response()->json(['error' => 'Error al guardar el producto: ' . $e->getMessage()], 500);

        }

        $productoImagen->save();
        return redirect()->route('admin.productos.imagenes', $id)
            ->with('mensaje', 'Imagen subida exitosamente.')
            ->with('icono', 'success');

      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $producto = Producto::find($id);
        return view('admin.productos.show', compact('producto'));
    }

    public function imagenes(string $id)
    {
        //
        $producto = Producto::find($id);
        return view('admin.productos.imagenes', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        //
        $categorias = Categoria::all();
        $unidades_medida = CatalogoDetalle::where('codigo_catalogo', 'UNIDAD_MEDIDA')->get();
        $producto = Producto::find($id);
        return view('admin.productos.edit', compact('producto', 'categorias', 'unidades_medida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        try {
            $request->validate([
                'categoria_id' => 'required|exists:categorias,id',
                'nombre' => 'required|string|max:255',
                'codigo' => 'required|string|max:255|unique:productos,codigo,' . $id,
                'descripcion' => 'nullable|string',
                'precio' => 'required|numeric',
                'precio_compra' => 'nullable|numeric',
                'stock' => 'required|numeric',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $producto = Producto::find($id);
            $producto->categoria_id = $request->categoria_id;
            $producto->nombre = $request->nombre;
            $producto->codigo = $request->codigo;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->precio_compra = $request->precio_compra;
            $producto->stock = $request->stock;
            $producto->prescripcion = $request->prescripcion;
            $producto->presentacion = $request->presentacion;
            $producto->imprime_receta = $request->imprime_receta ?? 0;
            $producto->aplica_iva = $request->aplica_iva ?? 0;
            $producto->tipo_producto = $request->tipo_producto;
            $producto->v_max = $request->precio;
            $producto->v_min = $request->precio;
            $producto->v_med = $request->precio;
            $producto->estado = $request->estado ?? 'A';
            $producto->unidad_medida = $request->unidad_medida ?? 'UNIDAD';
            $producto->cantidad_por_unidad = $request->cantidad_por_unidad ?? 1;
            $producto->stock_fraccion = $request->stock_fraccion ?? 1;

            if ($request->hasFile('imagen')) {
                if (isset($producto->imagen) && Storage::disk('public')->exists($producto->imagen)) {
                    // Eliminar el logo anterior si existe
                    Storage::disk('public')->delete($producto->imagen);
                }
                $imagenPath = $request->file('imagen')->store('productos', 'public');
                $producto->imagen = $imagenPath;
            }

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('mensaje', 'Error al guardar la actualización: ' . $e->getMessage())
                ->with('icono', 'error');

            //return response()->json(['error' => 'Error al guardar el producto: ' . $e->getMessage()], 500);

        }

        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto actualizado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        //
        $producto = Producto::find($id);
        foreach ($producto->imagenes as $imagen) {
            if (Storage::disk('public')->exists($imagen->imagen)) {
                Storage::disk('public')->delete($imagen->imagen);
            }
            $imagen->delete();
        }
        $producto->delete();
        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto eliminado exitosamente.')
            ->with('icono', 'success');
    }

    public function remove_imagen(String $id)
    {
        //
        $productoImagen = ProductoImagen::find($id);
        $productoId = $productoImagen->producto_id;
        if (Storage::disk('public')->exists($productoImagen->imagen)) {
            Storage::disk('public')->delete($productoImagen->imagen);
        }
        $productoImagen->delete();
        return redirect()->route('admin.productos.imagenes', $productoId)
            ->with('mensaje', 'Imagen eliminada exitosamente.')
            ->with('icono', 'success');
    }

}
