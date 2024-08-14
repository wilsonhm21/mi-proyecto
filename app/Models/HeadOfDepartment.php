<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOfDepartment extends Model
{
    use HasFactory;

    protected $table = 'head_of_department';

    // Definir las relaciones
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }
}
