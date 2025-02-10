<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class InvoiceController extends Controller
{
    public function home()
    {
        return view('vistas.invoice.home');
    }

    public function liberacion($otId)
    {

        //Aqui se va a añadir un valor la factura a la OT o remision.
        try {
            $orden = Item::findOrFail($otId);
            $orden->estado = 'F.LIBERADA';
            $orden->factura = 'F0001';
            $orden->save();
            return redirect()->route('invoices.home')->with('success', 'OT liberada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('invoices.home')->with('error', 'Hubo un problema al liberar OT, por favor intenta de nuevo.');
        }
    }
}
