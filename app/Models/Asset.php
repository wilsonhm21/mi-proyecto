<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'nombre',
        'marca',
        'modelo',
        'numero_serie',
        'fecha_registro',
        'estado_actual',
        'descripcion',
        'imagen',
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function equipmentAssignments()
    {
        return $this->hasMany(EquipmentAssignment::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

}
