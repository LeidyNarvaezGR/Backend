<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleTeacherController extends Controller
{
    
    public function asignar(Request $request)
    {
        $datos = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'module_id' => 'required|exists:modules,id',
        ]);

        $profesor = Teacher::findOrFail($datos['teacher_id']);

        $profesor->Module()->syncWithoutDetaching([
            $datos['module_id']
        ]);

        return response()->json([
            'mensaje' => 'Profesor asignado correctamente'
        ], 201);
    }

    
    public function modulosProfesor($id)
    {
        $profesor = Teacher::findOrFail($id);

        return response()->json($profesor->Module);
    }

    public function profesoresModulo($id)
    {
        $modulo = Module::findOrFail($id);

        return response()->json($modulo->Teacher);
    }

    
    public function retirar(Request $request)
    {
        $datos = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'module_id' => 'required|exists:modules,id',
        ]);

        $profesor = Teacher::findOrFail($datos['teacher_id']);

        $profesor->Module()->detach($datos['module_id']);

        return response()->json([
            'mensaje' => 'Profesor retirado correctamente'
        ]);
    }
}