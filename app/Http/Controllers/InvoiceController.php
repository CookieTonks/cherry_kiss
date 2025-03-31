<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Budget;
use App\Models\Client;
use App\Models\Invoice;
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


        $partidas = Item::where('estado', 'E.ENTREGADO')->get();

        $contador = Item::where('estado', 'E.ENTREGADO')->count();

        $clientes = Client::all();

        $facturas = Invoice::all();

        return view('vistas.invoice.home', compact('ordenes', 'contador', 'clientes', 'facturas', 'partidas'));
    }

    public function liberacion($otId, Request $request)
    {

        dd($otId, $request->all());
    }


    public function invoice_alta(Request $request)
    {


        try {
            $invoice = new Invoice();
            $invoice->codigo = $request->codigo;
            $invoice->empresa = $request->razon_social;
            $invoice->estatus = 'PENDIENTE';
            $invoice->cliente = $request->client_id;
            $invoice->save();
            return back()->with('success', 'Factura dada de alta con éxito!');
        } catch (\Throwable $th) {
            return back()->with('error', '¡Hubo un problema al dar de alta la factura, por favor intenta de nuevo!' . $th);
        }
    }
}
