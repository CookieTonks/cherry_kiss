<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['budget_id', 'descripcion', 'cantidad', 'precio_unitario', 'subtotal', 'imagen', 'partida'];

    public function budget()
    {
        return $this->belongsTo(Budget::class); // Relación inversa con la OC
    }
}
