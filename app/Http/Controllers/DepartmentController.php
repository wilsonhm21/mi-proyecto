<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Location;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Inicializa la consulta de departamentos
        $query = Department::query();

        // Aplica filtro de búsqueda por nombre
        if ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        }

        // Obtener departamentos y paginación
        $departments = $query->paginate(10);

        // Agrupar departamentos por piso y ubicación
        $departmentsGroupedByFloorAndLocation = $query->get()->groupBy(function($department) {
            return $department->location_id . '-' . $department->piso;
        });

        // Obtener todas las ubicaciones disponibles para el filtro (si aún quieres mostrar el filtro de ubicación en la vista)
        $locations = Location::all();

        return view('departments.index', [
            'departments' => $departments,
            'departmentsGroupedByFloorAndLocation' => $departmentsGroupedByFloorAndLocation,
            'locations' => $locations
        ]);
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            $locations = Location::all(); // Asegúrate de usar el modelo correcto para tus ubicaciones
            return view('departments.create', compact('locations'));
        }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:departments',
            'piso' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'location_id' => 'nullable|exists:locations,id',
        ]);
        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Departamento creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $locations = Location::all(); // Obtener todas las ubicaciones
        return view('departments.edit', compact('department', 'locations'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:departments,nombre,' . $department->id,
            'piso' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'location_id' => 'nullable|exists:locations,id',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Departamento actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Departamento eliminado con éxito.');
    }
}
