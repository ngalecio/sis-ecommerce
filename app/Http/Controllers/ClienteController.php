<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function listJsonProveedores()
    {

        $proveedores = Cliente::select('id', 'nombres', 'apellidos', 'cedula', 'direccion', 'telefono', 'email')
            ->where('tipo_persona', 'PRO')
            ->orwhere('tipo_persona', 'CYP')
            ->get();



        return response()->json([
            'data' => $proveedores,
        ]);
    }

    public function listJsonClientes()
    {

        $clientes = Cliente::select('id', 'nombres', 'apellidos', 'cedula', 'direccion', 'telefono', 'email')
            ->where('tipo_persona', 'CLI')
            ->orwhere('tipo_persona', 'CYP')
            ->get();



        return response()->json([
            'data' => $clientes,
        ]);
    }

    public function index(Request $request)
    {
        $buscar = $request->get('search');
        $query = Cliente::query()->where(function ($q) {
            $q->whereIn('tipo_persona', ['CLI','CYP']);
        });

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombres', 'like', '%' . $buscar . '%')
                    ->orWhere('apellidos', 'like', '%' . $buscar . '%')
                    ->orWhere('cedula', 'like', '%' . $buscar . '%')
                    ->orWhere('direccion', 'like', '%' . $buscar . '%');
            });
        }




        $clientes = $query->paginate(ENV('PAGE_SIZE'));
        return view('admin.clientes.index', compact('clientes', 'buscar'));
    }

    public function listarProveedores(Request $request)
    {
        $buscar = $request->get('search');
        $query = Cliente::query()->where(function($q) {
            $q->whereIn('tipo_persona', ['PRO', 'CYP']);
        });

        if ($buscar) {
            $query->where(function($q) use ($buscar) {
            $q->where('nombres', 'like', '%' . $buscar . '%')
                ->orWhere('apellidos', 'like', '%' . $buscar . '%')
                ->orWhere('cedula', 'like', '%' . $buscar . '%')
                ->orWhere('direccion', 'like', '%' . $buscar . '%');
            });
        }




        $proveedores = $query->paginate(ENV('PAGE_SIZE'));
        return view('admin.proveedores.index', compact('proveedores', 'buscar'));
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
        try {
            $request->validate([
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'cedula' => 'required|string|max:255|unique:clientes,cedula,',
                'direccion' => 'nullable|string|max:255',
                'telefono' => 'required|string|max:255',
                'email' => 'required|string|max:50',
                'estado' => 'required|string|max:10',
                'tipo_persona' => 'required|string|max:3',
            ]);

            $cliente = new Cliente();
            $cliente->categoria_id = $request->categoria_id;
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->cedula = $request->cedula;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->email = $request->email;
            $cliente->estado = $request->estado;
            $cliente->tipo_persona = $request->tipo_persona;
            $cliente->save();

            return redirect()->route('admin.clientes.index')
                ->with('mensaje', 'Cliente creado exitosamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('mensaje', 'Error al guardar la creación: ' . $e->getMessage())
                ->with('icono', 'error');

            //return response()->json(['error' => 'Error al guardar el producto: ' . $e->getMessage()], 500);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        if ($id == 0) {
            $cliente = null;
        } else {
            $cliente = Cliente::findOrFail($id);
        }

        return view('admin.clientes.edit', compact('cliente'));
    }

    public function editProveedor(String $id)
    {
        if ($id == 0) {
            $proveedor = null;
        } else {
            $proveedor = Cliente::findOrFail($id);
        }

        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        try {
            $request->validate([
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'cedula' => 'required|string|max:255|unique:clientes,cedula,' . $id,
                'direccion' => 'nullable|string|max:255',
                'telefono' => 'required|string|max:255',
                'email' => 'required|string|max:50',
                'estado' => 'required|string|max:10',
                'tipo_persona' => 'required|string|max:3',
            ]);

            $cliente = Cliente::find($id);

            if (!$cliente) {
                $cliente = new Cliente();
            }
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->cedula = $request->cedula;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->email = $request->email;
            $cliente->estado = $request->estado;
            $cliente->tipo_persona = $request->tipo_persona;
            $cliente->save();

            return redirect()->route('admin.clientes.index')
                ->with('mensaje', 'Cliente actualizado exitosamente.')
                ->with('icono', 'success');

       

       
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('mensaje', 'Error al guardar la actualización: ' . $e->getMessage())
                ->with('icono', 'error');

            //return response()->json(['error' => 'Error al guardar el producto: ' . $e->getMessage()], 500);

        }

    
    }


    public function updateProveedor(Request $request, String $id)
    {
        try {
            $request->validate([
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'cedula' => 'required|string|max:255|unique:clientes,cedula,' . $id,
                'direccion' => 'nullable|string|max:255',
                'telefono' => 'required|string|max:255',
                'email' => 'required|string|max:50',
                'estado' => 'required|string|max:10',
                'tipo_persona' => 'required|string|max:3',
            ]);

            $cliente = Cliente::find($id);

            if (!$cliente) {
                $cliente = new Cliente();
            }
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->cedula = $request->cedula;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->email = $request->email;
            $cliente->estado = $request->estado;
            $cliente->tipo_persona = $request->tipo_persona;
            $cliente->save();

            return redirect()->route('admin.proveedores.index')
                ->with('mensaje', 'Proveedor actualizado exitosamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('mensaje', 'Error al guardar la actualización: ' . $e->getMessage())
                ->with('icono', 'error');

            //return response()->json(['error' => 'Error al guardar el producto: ' . $e->getMessage()], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
