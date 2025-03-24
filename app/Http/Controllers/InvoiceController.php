<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Budget;

use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function home()
    {

        $ordenes = Budget::whereHas('items', function ($query) {
            $query->where('estado', 'E.ENTREGADO');
        })
        ->select('budgets.*')
        ->distinct()
        ->get();
    


        $contador = Item::where('estado', 'E.ENTREGADO')->count();

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
            return redirect()->route('invoice.home')->with('error', 'Hubo un problema al liberar OT, por favor intenta de nuevo.' . $th);
        }
    }
}
