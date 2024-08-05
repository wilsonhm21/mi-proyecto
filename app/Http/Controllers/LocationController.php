<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvincias($departamento_id)
    {
        $provincias = Provincia::where('departamento_id', $departamento_id)->get();
        return response()->json($provincias);
    }

    public function getDistritos($provincia_id)
    {
        $distritos = Distrito::where('provincia_id', $provincia_id)->get();
        return response()->json($distritos);
    }
    // Display a listing of the resource.
    public function index()
    {
        $locations = Location::all()->groupBy('piso');
        return view('locations.index', compact('locations'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $departamentos = Departamento::all();
        return view('locations.create', compact('departamentos'));
    }



    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'direccion' => 'required|string|max:255',
            'piso' => 'required|string|max:255',
            'distrito_id' => 'required|exists:distritos,id',
            'provincia_id' => 'required|exists:provincias,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        Location::create($request->all());
        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    // Display the specified resource.
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }

    // Show the form for editing the specified resource.
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'direccion' => 'required|string|max:255',
            'piso' => 'required|string|max:255',
            'distrito_id' => 'required|exists:distritos,id',
            'provincia_id' => 'required|exists:provincias,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        $location->update($request->all());
        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
