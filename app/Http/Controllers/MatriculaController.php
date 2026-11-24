<?php

namespace App\Http\Controllers;

use App\Models\Estudent;
use App\Models\Module;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
   
    public function matricular(Request $request)
{
    $datos = $request->validate([
        'estudent_id' => 'required|exists:estudents,id',
        'module_ids' => 'required|array|min:1',
        'module_ids.*' => 'required|integer|distinct|exists:modules,id',
    ]);

    $estudiante = Estudent::findOrFail($datos['estudent_id']);

    $estudiante->Module()->syncWithoutDetaching(
        $datos['module_ids']
    );

    return response()->json([
        'mensaje' => 'Estudiante matriculado correctamente en los módulos seleccionados',
        'modulos' => $estudiante->Module
    ], 201);
}

   
    public function modulosEstudiante($id)
    {
        $estudiante = Estudent::findOrFail($id);

        return response()->json(
            $estudiante->Module
        );
    }

    public function estudiantesModulo($id)
    {
        $modulo = Module::findOrFail($id);

        return response()->json(
            $modulo->Estudent
        );
    }

    
    public function retirar(Request $request)
    {
        $datos = $request->validate([
            'estudent_id' => 'required|exists:estudents,id',
            'module_id' => 'required|exists:modules,id',
        ]);

        $estudiante = Estudent::findOrFail($datos['estudent_id']);

        $estudiante->Module()->detach($datos['module_id']);

        return response()->json([
            'mensaje' => 'Matrícula retirada correctamente'
        ]);
    }
}