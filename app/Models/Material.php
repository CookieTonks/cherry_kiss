<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_id',
        'nombre',
        'cantidad',
        'precio_unitario',
        'estatus',
    ];

    // Relación con el presupuesto
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
