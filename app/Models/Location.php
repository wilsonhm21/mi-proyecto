<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'direccion',
        'distrito_id',
        'provincia_id',
        'departamento_id',
        'latitud',
        'longitud',
    ];

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
}
