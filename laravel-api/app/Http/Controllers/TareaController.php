<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::with('usuario:id,nombre,email,rol')->get();
        return response()->json($tareas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|in:pendiente,en_progreso,completada',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $tarea = Tarea::create($validated);

        return response()->json([
            'message' => 'Tarea creada correctamente',
            'data' => $tarea,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        $tarea->load('usuario:id,nombre,email,rol');
        return response()->json($tarea);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        $validated = $request->validate([
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'titulo' => 'sometimes|required|string|max:150',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|in:pendiente,en_progreso,completada',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $tarea->update($validated);

        return response()->json([
            'message' => 'Tarea actualizada correctamente',
            'data' => $tarea,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->json([
            'message' => 'Tarea eliminada correctamente',
        ]);
    }
}
