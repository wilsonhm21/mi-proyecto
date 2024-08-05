<?php

namespace App\Imports;

use App\Models\People;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Department;
use App\Models\Position;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeopleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Encuentra o crea los registros relacionados
        $departamento = Departamento::firstOrCreate(['name' => $row['departamento']]);
        $provincia = Provincia::firstOrCreate(['name' => $row['provincia']]);
        $distrito = Distrito::firstOrCreate(['name' => $row['distrito']]);
        $department = Department::firstOrCreate(['nombre' => $row['department']]);
        $position = Position::firstOrCreate(['nombre' => $row['position']]);

        // Crea o actualiza el registro de People
        return People::updateOrCreate(
            ['dni' => $row['dni']], // Clave única para evitar duplicados
            [
                'nombres' => $row['nombres'],
                'ape_paterno' => $row['ape_paterno'],
                'ape_materno' => $row['ape_materno'],
                'genero' => $row['genero'],
                'fecha_nacimiento' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento']),
                'estado' => $row['estado'],
                'direccion' => $row['direccion'],
                'telefono' => $row['telefono'],
                'correo_electronico' => $row['correo_electronico'],
                'distrito_id' => $distrito->id,
                'provincia_id' => $provincia->id,
                'departamento_id' => $departamento->id,
                'department_id' => $department->id,
                'position_id' => $position->id,
            ]
        );
    }
}

