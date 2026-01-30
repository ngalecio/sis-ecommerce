<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use function PHPUnit\Framework\returnSelf;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $buscar=$request->get('search');
        $query = User::query()->withTrashed();
        if ($buscar) {
            $query->where('name', 'like', '%' . $buscar . '%')
            ->orWhere('email', 'like', '%' . $buscar . '%');
        }
        $usuarios = $query->paginate(10);
     
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles= Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol'=>'required',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        $usuario->assignRole($request->rol);
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario creado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $roles = Role::all();
        $usuario = User::find($id);
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'rol' => 'required',
        ]);

        
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();
        $usuario->syncRoles([$request->rol]);
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario modificado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = User::find($id);
     
        if ($usuario) {
            $usuario->estado = false;
            $usuario->save();
            $usuario->delete();
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', 'Usuario eliminado exitosamente.')
                ->with('icono', 'success');
        }
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario no encontrado.')
            ->with('icono', 'error');
    }

    public function restore(string $id)
    {
        //
        $usuario = User::withTrashed()->find($id);
        $usuario->restore();
        $usuario->estado = true;
        $usuario->save();

      
         
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', 'Usuario Restaurado exitosamente.')
                ->with('icono', 'success');
     
    }
}
