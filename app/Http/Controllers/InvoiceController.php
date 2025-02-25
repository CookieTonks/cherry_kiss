<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class InvoiceController extends Controller
{
    public function home()
    {

        $ordenes = Item::where('estado', 'F.PENDIENTE')->get();

        $contador = Item::where('estado', 'F.PENDIENTE')->count();

        return view('vistas.invoice.home', compact('ordenes', 'contador'));
    }

    public function liberacion($otId, Request $request)
    {
        try {
            $orden = Item::findOrFail($otId);
            $orden->estado = 'F.LIBERADA';
            $orden->invoice_number = $request->factura;
            $orden->save();
            return redirect()->route('invoice.home')->with('success', 'OT liberada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('invoice.home')->with('error', 'Hubo un problema al liberar OT, por favor intenta de nuevo.' .$th);
        }
    }
}
