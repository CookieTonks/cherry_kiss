<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ShippingController extends Controller
{
    public function Home()
    {

        $ordenes = Item::where('estado', 'E.PENDIENTE')->get();
        $contador = Item::where('estado', 'E.PENDIENTE')->count();

        return view('vistas.shipping.home', compact('ordenes', 'contador'));
    }

    public function liberacion($id)
    {
        try {
            $orden = Item::findOrFail($id);
            $orden->estado = 'F.PENDIENTE';
            $orden->save();
            return redirect()->route('shipping.home')->with('success', 'OT liberada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('shipping.home')->with('error', 'Hubo un problema al liberar la OT.');
        }
    }
}
