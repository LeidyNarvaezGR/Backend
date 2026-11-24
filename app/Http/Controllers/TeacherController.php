<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'telefono' => 'required|max:255',
            'cedula' => 'required|unique:teachers,cedula',
        ]);

        $teacher = Teacher::create($request->all());

        return response()->json($teacher);
    }
    public function show(Teacher $teacher)
{
    return response()->json($teacher);
}
    
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'telefono' => 'required|max:255',
            'cedula' => 'required|unique:teachers,cedula,' . $teacher->id,
        ]);

        $teacher->update($request->all());

        return response()->json($teacher);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return $teacher;
    }
}