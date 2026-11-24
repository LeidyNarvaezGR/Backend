<?php

namespace App\Http\Controllers;

use App\Models\Estudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstudentController extends Controller
{
    
    public function index()
    {
        $estudiantes = Estudent::all();

        return response()->json($estudiantes);
    }

    
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'expediente' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')
                ->store('estudents', 'public');
        }

        $estudiante = Estudent::create($datos);

        return response()->json($estudiante, 201);
    }

    
    public function show(Estudent $estudent)
    {
        return response()->json($estudent);
    }

    public function update(Request $request, Estudent $estudent)
    {
        $datos = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellidos' => 'sometimes|required|string|max:255',
            'fecha_nacimiento' => 'sometimes|required|date',
            'expediente' => 'sometimes|required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {

            $nuevaFoto = $request->file('foto')
                ->store('estudents', 'public');

            if ($estudent->foto) {
                Storage::disk('public')->delete($estudent->foto);
            }

            $datos['foto'] = $nuevaFoto;
        }

        $estudent->update($datos);

        return response()->json($estudent);
    }

   
    public function destroy(Estudent $estudent)
    {
        if ($estudent->foto) {
            Storage::disk('public')->delete($estudent->foto);
        }

        $estudent->delete();

        return response()->json([
            'mensaje' => 'Estudiante eliminado correctamente'
        ]);
    }
}