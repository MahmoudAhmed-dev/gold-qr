<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $fillable = ['code', 'serial_number', 'material_id', 'weight', 'fineness'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
