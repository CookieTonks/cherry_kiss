<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function clientUsers()
    {
        return $this->hasMany(ClientUser::class);
    }
}
