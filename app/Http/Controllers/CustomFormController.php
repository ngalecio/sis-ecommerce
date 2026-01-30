<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomFormController extends Controller
{
    public function submit(Request $request)
    {
        // Aquí puedes procesar los datos del formulario
        // Por ejemplo, puedes retornar un mensaje de éxito
        return "aaaFormulario enviado con éxito. Datos recibidos: " . json_encode($request->all());
    }

    public function store(Request $request)
    {
        //   return "aaa";
        //
        // Procesando la solicitud, estos son los datos recibidos:
        return response()->json([
            'mensaje' => 'Datos recibidos correctamente version CUSTOM.',
            'datos' => $request->all()
        ]);
    }
}
