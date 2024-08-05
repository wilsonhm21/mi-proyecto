<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;
    protected $table = "distritos";

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $guarded = ['id'];
}
