<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentAssignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_id',
        'fecha_asignacion',
        'fecha_devolucion',
        'estado',
        'department_id',
        'people_id'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }
}
