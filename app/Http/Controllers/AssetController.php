<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = Asset::with('location');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('codigo', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%")
                  ->orWhere('marca', 'like', "%{$search}%")
                  ->orWhere('modelo', 'like', "%{$search}%")
                  ->orWhere('numero_serie', 'like', "%{$search}%");
        }

        $assets = $query->paginate(10);
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('assets.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:assets,numero_serie',
            'fecha_registro' => 'required|date',
            'estado_actual' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'location_id' => 'required|exists:locations,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('images', 'public');
        }

        Asset::create($data);

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $locations = Location::all();
        return view('assets.edit', compact('asset', 'locations'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:assets,numero_serie,' . $asset->id,
            'fecha_registro' => 'required|date',
            'estado_actual' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'location_id' => 'required|exists:locations,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($asset->imagen && Storage::exists('public/' . $asset->imagen)) {
                Storage::delete('public/' . $asset->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('images', 'public');
        }

        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        // Eliminar la imagen si existe
        if ($asset->imagen && Storage::exists('public/' . $asset->imagen)) {
            Storage::delete('public/' . $asset->imagen);
        }

        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
