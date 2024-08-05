<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PeopleImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function showImportForm()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new PeopleImport, $request->file('file'));

        return redirect()->back()->with('success', 'Datos importados exitosamente.');
    }
}
