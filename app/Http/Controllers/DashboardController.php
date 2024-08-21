<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Department;
use App\Models\EquipmentAssignment;
use App\Models\Location;
use App\Models\Maintenance;
use App\Models\People;
use App\Models\Position;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el conteo de registros para cada tabla
        return view('dashboard', [
            'assetCount' => Asset::count(),
            'departmentCount' => Department::count(),
            'equipmentAssignmentCount' => EquipmentAssignment::count(),
            'locationCount' => Location::count(),
            'maintenanceCount' => Maintenance::count(),
            'peopleCount' => People::count(),
            'positionCount' => Position::count(),
            'userCount' => User::count(),
        ]);
    }
}

