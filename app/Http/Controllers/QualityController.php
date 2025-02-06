<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class QualityController extends Controller
{
    //

    public function Home()
    {

        $ordenes = Item::where('estado', '=', 'C.ENVIADA')->get();

        return view('vistas.quality.home', compact('ordenes'));
    }
}
