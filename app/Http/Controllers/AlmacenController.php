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

    public function check($materialId)
    {
        try {
            Material::where('id', $materialId)->update(['estatus' => 'entregado']);


            return redirect()->route('almacen.home')->with('success', 'Material recibido con éxito.');
        } catch (\Throwable $th) {
            Log::error('Error dar entrada al material: ' . $th->getMessage());
            return redirect()->route('almacen.home')->with('error', 'Hubo un problema al recibir el material.');
        }
    }
}
