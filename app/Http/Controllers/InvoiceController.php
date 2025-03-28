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

        dd($otId, $request->all());
        
    }



}
