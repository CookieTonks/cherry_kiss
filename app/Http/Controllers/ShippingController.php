<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ShippingController extends Controller
{
    public function Home()
    {

        $ordenes = Item::where('estado', 'E.PENDIENTE')->get();
        return view('vistas.shipping.home', compact('ordenes'));
    }

    public function liberacion($id)
    {
        try {
            $orden = Item::findOrFail($id);
            $orden->estado = 'E.LIBERADA';
            $orden->save();
            return redirect()->route('shipping.home')->with('success', 'OT liberada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('shipping.home')->with('error', 'Hubo un problema al liberar la OT.');
        }
    }
}
