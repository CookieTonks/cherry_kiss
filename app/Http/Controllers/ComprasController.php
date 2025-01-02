<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class ComprasController extends Controller
{
    public function Home()
    {
        $materiales = Material::all();
        return view('vistas.shooping.home', compact('materiales'));
    }
}
