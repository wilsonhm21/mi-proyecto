<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Mostrar una lista de las posiciones.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::with('department')->get();
        return view('positions.index', compact('positions'));
    }

    /**
     * Mostrar el formulario para crear una nueva posición.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    /**
     * Almacenar una nueva posición en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Crear una nueva posición con los datos validados
        Position::create($validatedData);

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('positions.index')->with('success', 'Posición creada con éxito.');
    }

    /**
     * Mostrar el formulario para editar una posición existente.
     *
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        $departments = Department::all();
        return view('positions.edit', compact('position', 'departments'));
    }

    /**
     * Actualizar una posición existente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Actualizar la posición con los datos validados
        $position->update($validatedData);

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('positions.index')->with('success', 'Posición actualizada con éxito.');
    }

    /**
     * Eliminar una posición existente de la base de datos.
     *
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        // Eliminar la posición
        $position->delete();

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('positions.index')->with('success', 'Posición eliminada con éxito.');
    }
}
