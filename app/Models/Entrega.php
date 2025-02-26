<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'cantidad', 'tipo_documento', 'numero_documento'];

    // Relación con Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
