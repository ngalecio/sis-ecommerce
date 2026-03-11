<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    public function index()
    {
        $total_roles = Role::count();
        $total_usuarios = \App\Models\User::count();
        $total_pacientes = \App\Models\Paciente::count();
        $total_productos = \App\Models\Producto::count();
        return view('admin.index', compact('total_roles', 'total_usuarios', 'total_pacientes', 'total_productos'));
    }
}
