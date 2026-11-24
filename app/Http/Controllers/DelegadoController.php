<?php

namespace App\Http\Controllers;

use App\Models\Estudent;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DelegadoController extends Controller
{
    // Asignar o cambiar el delegado de un estudiante
    public function asignar(Request $request)
    {
        $datos = $request->validate([
            'estudent_id' => 'required|exists:estudents,id',
            'delegado_id' => 'required|exists:estudents,id',
        ]);

        if ($datos['estudent_id'] == $datos['delegado_id']) {
            throw ValidationException::withMessages([
                'delegado_id' => 'Un estudiante no puede ser su propio delegado.'
            ]);
        }

        $estudiante = Estudent::findOrFail($datos['estudent_id']);

        $estudiante->delegado_id = $datos['delegado_id'];
        $estudiante->save();

        return response()->json([
            'mensaje' => 'Delegado asignado correctamente',
            'estudiante' => $estudiante->load('delegado')
        ], 200);
    }

    // Consultar el delegado de un estudiante
    public function consultar($id)
    {
        $estudiante = Estudent::with('delegado')->findOrFail($id);

        return response()->json($estudiante);
    }

    // Consultar estudiantes representados por un delegado
    public function representados($id)
    {
        $delegado = Estudent::with('representados')->findOrFail($id);

        return response()->json($delegado);
    }

    // Retirar el delegado de un estudiante
    public function retirar($id)
    {
        $estudiante = Estudent::findOrFail($id);

        $estudiante->delegado_id = null;
        $estudiante->save();

        return response()->json([
            'mensaje' => 'Delegado retirado correctamente'
        ]);
    }
}