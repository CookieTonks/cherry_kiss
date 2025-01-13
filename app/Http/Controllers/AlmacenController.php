<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class AlmacenController extends Controller
{
    public function Home()
    {
        $materiales = Material::where('estatus', '=', 'pendiente')->get();
        // $ocs = Oc::all();
        // $proveedores = Supplier::all();
        return view('vistas.store.home', compact('materiales'));
    }
}
