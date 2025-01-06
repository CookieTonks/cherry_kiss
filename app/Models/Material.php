<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'nombre',
        'cantidad',
        'precio_unitario',
        'unidad',
        'medida',
        'estatus',
        'descripcion'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
