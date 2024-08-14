<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PeopleController;
use JeroenNoten\LaravelAdminLte\Components\Form\Select;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [UsuarioController::class,'profile']);
    Route::resource('locations', 'App\Http\Controllers\LocationController');
    Route::resource('assets', 'App\Http\Controllers\AssetController');
    Route::resource('departments', 'App\Http\Controllers\DepartmentController');
    Route::resource('equipments', 'App\Http\Controllers\EquipmentAssignmentController');
    Route::resource('maintenances', 'App\Http\Controllers\MaintenanceController');
    Route::resource('equipment_assignments', 'App\Http\Controllers\EquipmentAssignmentController');
    Route::resource('peoples', 'App\Http\Controllers\PeopleController');
    Route::resource('positions', 'App\Http\Controllers\PositionController');
    // Ruta para obtener las provincias por departamento
    Route::get('/provincias/{departamento_id}', [LocationController::class, 'getProvincias']);
    Route::get('/distritos/{provincia_id}', [LocationController::class, 'getDistritos']);

    Route::get('/peoples/{id}', [PeopleController::class, 'show'])->name('peoples.show');
    Route::get('/peoples/excel', [PeopleController::class, 'exportExcel'])->name('peoples.excel');
    Route::get('/peoples/pdf', [PeopleController::class, 'exportPdf'])->name('peoples.pdf');

    // maintenances.web
    Route::get('maintenances/{id}/report', [MaintenanceController::class, 'generateReport'])->name('maintenances.report');



});
