<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'serial_number', 'identifier', 'material_id', 'weight', 'fineness'];
    protected $with = ['material'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
