<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     
        $buscar = $request->get('search');
        $query = Paciente::query();
        if ($buscar) {
            $query->where('nombres', 'like', '%' . $buscar . '%')
                ->orWhere('apellidos', 'like', '%' . $buscar . '%')
                ->orWhere('cedula', 'like', '%' . $buscar . '%')
                ->orWhere('direccion', 'like', '%' . $buscar . '%')
            ;
        }




        $pacientes = $query->paginate(ENV('PAGE_SIZE'));
        $pacientes->appends(['search' => $buscar]);
        return view('admin.pacientes.index', compact('pacientes', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function reporte(String $id)
    {
        //
        $paciente = Paciente::findOrFail($id);
        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);
        
        // $pdf= Pdf::loadView('admin.pacientes.reporte', ['paciente' => $paciente]);
        // $pdf->setPaper('a4', 'portrait');
        // return $pdf->stream('reporte_paciente_'.$id.'.pdf');

        $pdf->loadView('admin.pacientes.reporteficha', compact('paciente'));
        $pdf->setPaper('a4', 'portrait');

        $nombreArchivo = 'ficha-medica-' . ($paciente->cedula ?? $paciente->id) . '.pdf';

        return $pdf->stream($nombreArchivo);
    }

    
    public function reportePDF(Request $request)
    {
        $id = $request->get('id');
        
        $paciente = Paciente::findOrFail($id);
        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);

        // $pdf= Pdf::loadView('admin.pacientes.reporte', ['paciente' => $paciente]);
        // $pdf->setPaper('a4', 'portrait');
        // return $pdf->stream('reporte_paciente_'.$id.'.pdf');

        $pdf->loadView('admin.pacientes.reporteficha', compact('paciente'));
        $pdf->setPaper('a4', 'portrait');

        $nombreArchivo = 'ficha-medica-' . ($paciente->cedula ?? $paciente->id) . '.pdf';
        

        return $pdf->stream($nombreArchivo);
    }

    public function reporteTodos(Request $request)
    {



        $pacientes = Paciente::selectRaw("
            id,
            nombres,
            apellidos,
            cedula,
            direccion,
            telefono,
            email,
            fecha_nacimiento,
            tipo_identificacion,
            LEFT(TRIM(apellidos), 1) as inicial_apellido
        ")->orderBy('apellidos')->take(500)->get();

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
            'isPhpEnabled' => true // IMPORTANTE: Habilitar PHP en DOMPDF
        ]);

        $pdf->loadView('admin.pacientes.reportetodos', compact('pacientes'));
        $pdf->setPaper('a4', 'landscape');

        $nombreArchivo = 'rpt_pacientes_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->stream($nombreArchivo);


      

  
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function registrar(Request $request, string $id)
    {
        Log::info('info del formulario', ['request' => $request->all(), 'Id' => $id]);

      

        
        try {
            $paciente = Paciente::find($id);


            if (!$paciente) {
               $paciente = new Paciente();
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Paciente no encontrada.'], 404);
        }

       



        try {

        $rules=[
                'nombres'    => 'required|string|max:100',
                'apellidos'  => 'required|string|max:100',
                'direccion'  => 'nullable|string|max:255',
                'telefono'   => 'nullable|string|max:50',
                'email'      => 'nullable|string|max:100',
                'fecha_nacimiento'  => 'nullable|date',
                'tipo_identificacion'       => 'nullable|string|max:20',
            ];


            if ($paciente) {
                $rules['cedula'] =  'required|string|max:20|unique:pacientes,cedula,' . $id;
              
            }
            else
                {
                    $rules['cedula'] =  'required|string|max:20|unique:pacientes,cedula';
                }


            $request->validate($rules);

            // return response()->json(['success' => true, 'message' => 'Paciente actualizado encontrada(rules).' . $id], 201);

        

        
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Datos de validación incorrectos.', 'errors' => $e->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $paciente->nombres = $request->nombres;
            $paciente->apellidos = $request->apellidos ?? '';
            $paciente->cedula = $request->cedula;
            $paciente->direccion = $request->direccion ?? '';
            $paciente->telefono = $request->telefono ?? '';
            $paciente->email = $request->email ?? '';
            $paciente->fecha_nacimiento = $request->fecha_nacimiento ?? null;
            $paciente->tipo_identificacion = $request->tipo_identificacion ?? null;
            $paciente->save();
            DB::commit();
            //  return response()->json(['success' => true, 'message' => 'Categoría actualizada con éxito.','data'=>'AAA'], 201);

            return response()->json(['success' => true, 'message' => 'Paciente actualizada con éxito.', 'data' => $paciente], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al actualizar la paciente.', 'error' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        if ($id == 0) {
            $paciente = null;
        } else {
            $paciente = Paciente::findOrFail($id);
        }

        return view('admin.pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
