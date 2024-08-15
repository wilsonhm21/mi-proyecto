<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\People;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeoplesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Distrito;
use App\Models\Position;
use App\Models\Provincia;

class PeopleController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new PeoplesExport, 'peoples.xlsx');
    }

    // Método para exportar a PDF
    public function exportPdf()
    {
        $peoples = People::all(); // Puedes ajustar la consulta según tus necesidades

        $pdf = Pdf::loadView('peoples.pdf', compact('peoples'));
        return $pdf->download('peoples.pdf');
    }
    // Método para mostrar la lista de personas
    public function index(Request $request)
    {
        $query = People::with(['departamento', 'provincia', 'distrito']);

        // Aplicar filtro de búsqueda
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                  ->orWhere('dni', 'like', "%{$search}%");
            });
        }

        // Aplicar filtro de año
        if ($request->has('year') && !empty($request->input('year'))) {
            $year = $request->input('year');
            $query->whereYear('fecha_nacimiento', $year);
        }

        // Ordenar por nombres y aplicar paginación
        $peoples = $query->orderBy('nombres')->paginate(10);

        // Pasar variables a la vista
        return view('peoples.index', [
            'peoples' => $peoples,
            'search' => $request->input('search'),
            'year' => $request->input('year'),
        ]);
    }


    // Método para mostrar el formulario de creación de personas
    public function create()
    {
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        $departments = Department::all();
        $positions = Position::all();
        return view('peoples.create', compact('departamentos', 'provincias', 'distritos','departments','positions'));
    }
    public function show($id)
{
    $people = People::findOrFail($id);
    return view('peoples.show', compact('people'));
}

    // Método para almacenar una nueva persona
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'ape_paterno' => 'required|string|max:255',
            'ape_materno' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'genero' => 'required|string|max:10',
            'fecha_nacimiento' => 'required|date',
            'estado' => 'required|string|max:10',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'correo_electronico' => 'required|string|email|max:255',
            'distrito_id' => 'required|exists:distritos,id',
            'provincia_id' => 'required|exists:provincias,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        People::create($request->all());

        return redirect()->route('peoples.index')->with('success', 'Persona creada exitosamente.');
    }

    // Método para mostrar el formulario de edición de una persona
    public function edit($id)
{
    // Buscar la persona por ID
    $person = People::with(['departamento', 'provincia', 'distrito', 'position', 'department'])->findOrFail($id);

    // Obtener listas para los campos de selección
    $departamentos = Departamento::all();
    $provincias = Provincia::all();
    $distritos = Distrito::all();
    $positions = Position::all();
    $departments = Department::all();

    // Pasar los datos a la vista
    return view('peoples.edit', compact('person', 'departamentos', 'provincias', 'distritos', 'positions', 'departments'));
}


    // Método para actualizar una persona existente
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombres' => 'required|string|max:255',
            'ape_paterno' => 'required|string|max:255',
            'ape_materno' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'genero' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'correo_electronico' => 'required|email|max:255',
            'departamento_id' => 'required|exists:departamentos,id',
            'provincia_id' => 'required|exists:provincias,id',
            'distrito_id' => 'required|exists:distritos,id',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Encontrar la persona
        $person = People::findOrFail($id);

        // Actualizar los datos
        $person->update($request->all());

        // Redirigir con un mensaje de éxito
        return redirect()->route('peoples.index')->with('success', 'Persona actualizada exitosamente.');
    }



    // Método para eliminar una persona
    public function destroy($id)
    {
        $person = People::find($id);
        $person->delete();

        return redirect()->route('peoples.index')->with('success', 'Persona eliminada exitosamente.');
    }
}
