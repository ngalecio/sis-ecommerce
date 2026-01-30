<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $roles = Role::paginate(5);
       return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        $role = new Role();
        $role->name = strtoupper($request->name);
        $role->save();
       // return response()->json(['message' => 'Rol creado exitosamente.'], 201);
        return redirect()->route('admin.roles.index')
        ->with('mensaje', 'Rol creado exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $role = Role::findById($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $role = Role::findById($id);
        return view('admin.roles.edit', compact('role'));
       // return response()->json(['message' => 'Mostrar formulario de edición para el rol con ID: ' . $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
        ]);


        $role = Role::findById($id);
        $role->name = strtoupper($request->name);
        $role->save();
        return redirect()->route('admin.roles.index')
        ->with('mensaje', 'Rol actualizado exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

       // return "aaaa";
        $role = Role::findById($id);
        
        $role->delete();
        return redirect()->route('admin.roles.index')
       ->with('mensaje', 'Rol eliminado exitosamente.')
       ->with('icono', 'success');
    }
}
