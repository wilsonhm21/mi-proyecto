<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $table = "departamentos";

    protected $primaryKey = 'idDepa'; //id

    public $incrementing = true;

    protected $guarded = ['idDepa'];


    public function provincias() {
        return $this->hasMany('App\Models\Provincia', 'fkDepa', 'idProv');
    }
}

