<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function head()
    {
        return $this->belongsTo(People::class, 'head_of_department_id');
    }
}
