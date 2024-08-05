<?php

namespace App\Http\Controllers;

use App\Models\EquipmentAssignment;
use App\Models\Asset;
use App\Models\Department;
use App\Models\People;
use Illuminate\Http\Request;

class EquipmentAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = EquipmentAssignment::with(['asset', 'department', 'people']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('asset', function ($query) use ($search) {
                $query->where('codigo', 'like', "%{$search}%");
            });
        }

        $assignments = $query->paginate(10);
        return view('equipment_assignments.index', compact('assignments'));
    }

    public function create()
    {
        $assets = Asset::all();
        $departments = Department::all();
        $peoples = People::all();
        return view('equipment_assignments.create', compact('assets', 'departments', 'peoples'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'fecha_asignacion' => 'required|date',
            'fecha_devolucion' => 'nullable|date',
            'estado' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'people_id' => 'required|exists:peoples,id',
        ]);

        EquipmentAssignment::create($validated);
        return redirect()->route('equipment_assignments.index')->with('success', 'Asignación creada con éxito.');
    }

    public function edit($id)
    {
        $assignment = EquipmentAssignment::findOrFail($id);
        $assets = Asset::all();
        $departments = Department::all();
        $peoples = People::all();
        return view('equipment_assignments.edit', compact('assignment', 'assets', 'departments', 'peoples'));
    }

    public function update(Request $request, $id)
    {
        $assignment = EquipmentAssignment::findOrFail($id);

        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'fecha_asignacion' => 'required|date',
            'fecha_devolucion' => 'nullable|date',
            'estado' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'people_id' => 'required|exists:peoples,id',
        ]);

        $assignment->update($validated);
        return redirect()->route('equipment_assignments.index')->with('success', 'Asignación actualizada con éxito.');
    }

    public function destroy($id)
    {
        $assignment = EquipmentAssignment::findOrFail($id);
        $assignment->delete();
        return redirect()->route('equipment_assignments.index')->with('success', 'Asignación eliminada con éxito.');
    }
}
