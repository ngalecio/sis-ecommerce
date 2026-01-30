
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjusteController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CatalogoDetalleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComprobanteCabeceraController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CustomFormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware('auth');;

Route::get('/ajuste/custom-form', function () {
    return view('/ajuste/custom-form');
})->name('custom.form');

Route::post('/custom-form/custom', [AjusteController::class, 'store'])->name('custom.submit3');



Route::get('/admin/ajuste', [AjusteController::class, 'index'])->name('admin.ajuste.index')->middleware('auth');
Route::post('/admin/ajustes/create', [AjusteController::class, 'store'])->name('ajustes.store')->middleware('auth');


//   Route::post('/admin/ajustes', [CustomFormController::class, 'submit'])->name('custom.submit');
Auth::routes();




// Ruta POST para procesar el formulario personalizado



// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home', [AdminController::class, 'index'])->name('home')->middleware('auth');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');


Route::middleware(['auth'])->group(function () {

    Route::put('/admin/ajustes/{id}', [AjusteController::class, 'update'])->name('ajustes.update');
    Route::delete('/ajustes/{id}', [AjusteController::class, 'destroy'])->name('ajustes.destroy');
});


Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/admin/roles/create', [RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('admin.roles.show')->middleware('auth');
Route::get('/admin/roles/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/admin/roles/update/{id}', [RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/roles/delete/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');
// Route::middleware(['auth'])->get('/test-form', function () {


Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create', [UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/admin/usuarios/create', [UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/update/{id}', [UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/delete/{id}', [UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');
Route::post('/admin/usuarios/{id}/restore', [UsuarioController::class, 'restore'])->name('admin.usuarios.restore')->middleware('auth');


Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('admin.categorias.index')->middleware('auth');
Route::get('/admin/categorias/create', [CategoriaController::class, 'create'])->name('admin.categorias.create')->middleware('auth');
Route::post('/admin/categorias/create', [CategoriaController::class, 'store'])->name('admin.categorias.store')->middleware('auth');
Route::get('/admin/categorias/{id}', [CategoriaController::class, 'show'])->name('admin.categorias.show')->middleware('auth');
Route::get('/admin/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('admin.categorias.edit')->middleware('auth');
Route::put('/admin/categorias/update/{id}', [CategoriaController::class, 'update'])->name('admin.categorias.update')->middleware('auth');
Route::delete('/admin/categorias/delete/{id}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy')->middleware('auth');
Route::post('/admin/categorias/{id}/restore', [CategoriaController::class, 'restore'])->name('admin.categorias.restore')->middleware('auth');


Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth');
Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth');
Route::post('/admin/productos/create', [ProductoController::class, 'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/admin/productos/insumos-list', [ProductoController::class, 'listJsonInsumos'])->name('admin.productos.list')->middleware('auth');

Route::get('/admin/productos/{id}', [ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth');
Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth');
Route::put('/admin/productos/update/{id}', [ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/productos/delete/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth');
Route::post('/admin/productos/{id}/restore', [ProductoController::class, 'restore'])->name('admin.productos.restore')->middleware('auth');

Route::get('/admin/productos/{id}/imagenes', [ProductoController::class, 'imagenes'])->name('admin.productos.imagenes')->middleware('auth');
Route::post('/admin/productos/{id}/upload_imagen', [ProductoController::class, 'upload_imagen'])->name('admin.productos.upload_imagen')->middleware('auth');
Route::delete('/admin/productos/{id}/remove_imagen', [ProductoController::class, 'remove_imagen'])->name('admin.productos.remove_imagen')->middleware('auth');


Route::get('/admin/catalogos', [CatalogoController::class, 'index'])->name('admin.catalogos.index')->middleware('auth');
Route::get('/admin/catalogos/create', [CatalogoController::class, 'create'])->name('admin.catalogos.create')->middleware('auth');
Route::post('/admin/catalogos', [CatalogoController::class, 'store'])->name('admin.catalogos.store')->middleware('auth');
Route::get('/admin/catalogos/list', [CatalogoController::class, 'listJson'])->name('admin.catalogos.list')->middleware('auth');
Route::get('/admin/catalogos/todos', [CatalogoController::class, 'listJsonTodos'])->name('admin.catalogos.listTodos')->middleware('auth');
Route::get('/admin/catalogos/{id}', [CatalogoController::class, 'show'])->name('admin.catalogos.show')->middleware('auth');
Route::get('/admin/catalogos/{id}/edit', [CatalogoController::class, 'edit'])->name('admin.catalogos.edit')->middleware('auth');
Route::put('/admin/catalogos/{id}', [CatalogoController::class, 'update'])->name('admin.catalogos.update')->middleware('auth');
Route::delete('/admin/catalogos/delete/{id}', [CatalogoController::class, 'destroy'])->name('admin.catalogos.destroy')->middleware('auth');
Route::post('/admin/catalogos/{id}/restore', [CatalogoController::class, 'restore'])->name('admin.catalogos.restore')->middleware('auth');


Route::get('/admin/catalogosdetalle', [CatalogoDetalleController::class, 'index'])->name('admin.catalogosdetalle.index')->middleware('auth');
Route::get('/admin/catalogosdetalle/create', [CatalogoDetalleController::class, 'create'])->name('admin.catalogosdetalle.create')->middleware('auth');
Route::post('/admin/catalogosdetalle', [CatalogoDetalleController::class, 'store'])->name('admin.catalogosdetalle.store')->middleware('auth');
Route::get('/admin/catalogosdetalle/list', [CatalogoDetalleController::class, 'listJson'])->name('admin.catalogosdetalle.list')->middleware('auth');
Route::get('/admin/catalogosdetalle/{id}', [CatalogoDetalleController::class, 'show'])->name('admin.catalogosdetalle.show')->middleware('auth');
Route::get('/admin/catalogosdetalle/{id}/edit', [CatalogoDetalleController::class, 'edit'])->name('admin.catalogosdetalle.edit')->middleware('auth');
Route::put('/admin/catalogosdetalle/{id}', [CatalogoDetalleController::class, 'update'])->name('admin.catalogosdetalle.update')->middleware('auth');
Route::delete('/admin/catalogosdetalle/delete/{id}', [CatalogoDetalleController::class, 'destroy'])->name('admin.catalogosdetalle.destroy')->middleware('auth');
Route::post('/admin/catalogosdetalle/{id}/restore', [CatalogoDetalleController::class, 'restore'])->name('admin.catalogosdetalle.restore')->middleware('auth');





Route::get('/admin/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth');
Route::get('/admin/clientes/create', [ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth');
Route::post('/admin/clientes/create', [ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth');
Route::get('/admin/clientes/proveedores-list', [ClienteController::class, 'listJsonProveedores'])->name('admin.clientes.proveedores.list')->middleware('auth');
Route::get('/admin/clientes/clientes-list', [ClienteController::class, 'listJsonClientes'])->name('admin.clientes.clientes.list')->middleware('auth');
Route::get('/admin/clientes/{id}', [ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth');
Route::get('/admin/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth');
Route::put('/admin/clientes/update/{id}', [ClienteController::class, 'update'])->name('admin.clientes.update')->middleware('auth');
Route::delete('/admin/clientes/delete/{id}', [ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth');
Route::post('/admin/clientes/{id}/restore', [ClienteController::class, 'restore'])->name('admin.clientes.restore')->middleware('auth');


Route::get('/admin/pacientes', [PacienteController::class, 'index'])->name('admin.pacientes.index')->middleware('auth');
Route::get('/admin/pacientes/create', [PacienteController::class, 'create'])->name('admin.pacientes.create')->middleware('auth');
Route::get('/admin/pacientes/reporte/{id}', [PacienteController::class, 'reporte'])->name('admin.pacientes.reporte')->middleware('auth');
Route::get('/admin/pacientes/reportetodos', [PacienteController::class, 'reportetodos'])->name('admin.pacientes.reportetodos')->middleware('auth');

Route::post('/admin/pacientes/reportepdf', [PacienteController::class, 'reportePDF'])->name('admin.pacientes.reportepdf')->middleware('auth');

Route::post('/admin/pacientes/create', [PacienteController::class, 'store'])->name('admin.pacientes.store')->middleware('auth');
Route::put('/admin/pacientes/registrar/{id}', [PacienteController::class, 'registrar'])->name('admin.pacientes.registrar')->middleware('auth');
Route::get('/admin/pacientes/{id}', [PacienteController::class, 'show'])->name('admin.pacientes.show')->middleware('auth');
Route::get('/admin/pacientes/{id}/edit', [PacienteController::class, 'edit'])->name('admin.pacientes.edit')->middleware('auth');
Route::put('/admin/pacientes/update/{id}', [PacienteController::class, 'update'])->name('admin.pacientes.update')->middleware('auth');
Route::delete('/admin/pacientes/delete/{id}', [PacienteController::class, 'destroy'])->name('admin.pacientes.destroy')->middleware('auth');
Route::post('/admin/pacientes/{id}/restore', [PacienteController::class, 'restore'])->name('admin.pacientes.restore')->middleware('auth');


Route::get('/admin/consultas', [ConsultaController::class, 'index'])->name('admin.consultas.index')->middleware('auth');
Route::get('/admin/consultas/list', [ConsultaController::class, 'listJson'])->name('admin.consultas.list')->middleware('auth');
Route::get('/admin/consultas/{id}', [ConsultaController::class, 'show'])->name('admin.consultas.show')->middleware('auth');
Route::put('/admin/consultas/registrar/{id}', [ConsultaController::class, 'registrar'])->name('admin.consultas.registrar')->middleware('auth');
Route::post('/admin/consultas/{id}/upload_imagen', [ConsultaController::class, 'upload_imagen'])->name('admin.consultas.upload_imagen')->middleware('auth');
Route::delete('/admin/consultas/{id}/remove_imagen', [ConsultaController::class, 'remove_imagen'])->name('admin.consultas.remove_imagen')->middleware('auth');


Route::get('/admin/compras', [ComprobanteCabeceraController::class, 'lista_compras'])->name('admin.compras.index')->middleware('auth');
Route::put('/admin/compras/registrar/{id}', [ComprobanteCabeceraController::class, 'registrarCompra'])->name('admin.compras.registrar')->middleware('auth');
Route::get('/admin/compras/{id}', [ComprobanteCabeceraController::class, 'showCompra'])->name('admin.compras.show')->middleware('auth');
Route::get('/admin/compras/{id}/edit', [ComprobanteCabeceraController::class, 'edit'])->name('admin.compras.edit')->middleware('auth');


Route::get('/admin/facturas', [ComprobanteCabeceraController::class, 'lista_facturas'])->name('admin.facturas.index')->middleware('auth');
Route::put('/admin/facturas/registrar/{id}', [ComprobanteCabeceraController::class, 'registrarFactura'])->name('admin.facturas.registrar')->middleware('auth');
Route::get('/admin/facturas/{id}', [ComprobanteCabeceraController::class, 'showFactura'])->name('admin.facturas.show')->middleware('auth');
Route::get('/admin/facturas/{id}/edit', [ComprobanteCabeceraController::class, 'editFactura'])->name('admin.facturas.edit')->middleware('auth');
//Route::get('/admin/catalogos2', [CatalogoController::class, 'listJson'])->name('admin.catalogos2.index')->middleware('auth');
Route::post('/admin/facturas/reportepdf', [ComprobanteCabeceraController::class, 'reportePDF'])->name('admin.facturas.reportepdf')->middleware('auth');

//     return view('test-form');
// });

// Route::middleware(['auth'])->post('/test-submit', function (Request $request) {
//     return response()->json([
//         'status' => 'success',
//         'data' => $request->all()
//     ]);
// })->name('test.submit');


// Route::get('/admin/ajustes', [App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes.index')->middleware('auth');
// Route::post('/admin/ajustes/create', [App\Http\Controllers\AjusteController::class, 'store'])->name('admin.ajustes.store');


// Route::post('/admin/categorias/create', [AjusteController::class, 'store'])->name('categorias.store')->middleware('auth');


// Route::post('/bienvenida', function () {
//     return response()->json(['mensaje' => '¡Bienvenido!']);
// });