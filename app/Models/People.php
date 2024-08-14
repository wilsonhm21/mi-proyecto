<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'peoples';
    protected $fillable = [
        'nombres',
        'ape_paterno',
        'ape_materno',
        'dni',
        'genero',
        'fecha_nacimiento',
        'estado',
        'direccion',
        'telefono',
        'correo_electronico',
        'distrito_id',
        'provincia_id',
        'departamento_id',
        'department_id',
        'position_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    public function headOfDepartment()
    {
        return $this->hasOne(HeadOfDepartment::class, 'people_id');
    }
}
