<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Maintenance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Display a listing of the resource.

    public function generateReport($id)
    {
        // Obtén los datos necesarios
        $maintenance = Maintenance::findOrFail($id);

        // Carga la vista para el reporte
        $pdf = Pdf::loadView('reports.maintenance_report', compact('maintenance'));

        // Devuelve el PDF como descarga
        return $pdf->download('reporte_mantenimiento.pdf');
    }
    public function index(Request $request)
    {
        // Obtener el parámetro de búsqueda si existe
        $search = $request->input('search');

        // Consulta con paginación
        $maintenances = Maintenance::query()
        ->when($search, function($query, $search) {
            return $query->whereHas('asset', function($query) use ($search) {
                $query->where('codigo', 'like', "%{$search}%");
            });
        })
        ->paginate(10); // Número de elementos por página

        return view('maintenances.index', compact('maintenances'));
    }
    // Show the form for creating a new resource.
    public function create()
    {
        $assets = Asset::all();
        return view('maintenances.create',compact('assets'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'description' => 'required|string',
            'fecha_realizacion' => 'required|string',
            'repuestos' => 'nullable|string',
            'proxima_fecha_mantenimiento' => 'nullable|date',
        ]);

        Maintenance::create($request->all());

        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance created successfully.');
    }

    // Display the specified resource.
    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    // Show the form for editing the specified resource.
    public function edit(Maintenance $maintenance)
    {
        return view('maintenances.edit', compact('maintenance'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'description' => 'required|string',
            'fecha_realizacion' => 'required|string',
            'repuestos' => 'nullable|string',
            'proxima_fecha_mantenimiento' => 'nullable|date',
        ]);

        $maintenance->update($request->all());

        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance deleted successfully.');
    }
}
