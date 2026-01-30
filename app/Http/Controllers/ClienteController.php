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
        $query = Cliente::query();
        if ($buscar) {
            $query->where('nombres', 'like', '%' . $buscar . '%')
                ->orWhere('apellidos', 'like', '%' . $buscar . '%')
                ->orWhere('cedula', 'like', '%' . $buscar . '%')
                ->orWhere('direccion', 'like', '%' . $buscar . '%')
            ;
        }




        $clientes = $query->paginate(ENV('PAGE_SIZE'));
        return view('admin.clientes.index', compact('clientes', 'buscar'));
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
