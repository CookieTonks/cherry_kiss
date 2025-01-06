<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'descripcion', 'cantidad', 'precio_unitario', 'subtotal', 'imagen', 'partida'];

    public function budget()
    {
        return $this->belongsTo(Budget::class); // Relación inversa con la OC
    }

    // En el modelo Item.php
    public function materials()
    {
        return $this->hasMany(Material::class, 'item_id'); // Ajusta 'item_id' según el campo en tu tabla de materiales
    }
}
