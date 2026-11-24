<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return response()->json($modules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:modules,codigo',
            'nombre' => 'required|max:255',
        ]);

        $module = Module::create($request->all());

        return response()->json($module);
    }

    public function show(Module $module)
    {
        return response()->json($module);
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'codigo' => 'required|unique:modules,codigo,' . $module->id,
            'nombre' => 'required|max:255',
        ]);

        $module->update($request->all());

        return response()->json($module);
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return response()->json($module);
    }
}