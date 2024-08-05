<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_id',
        'description',
        'fecha_realizacion',
        'repuestos',
        'proxima_fecha_mantenimiento'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
