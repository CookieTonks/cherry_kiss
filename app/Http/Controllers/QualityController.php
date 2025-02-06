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

    public function liberacion($id)
    {
        try {
            $orden = Item::findOrFail($id);
            $orden->estado = 'C.LIBERADA';
            $orden->save();
            return redirect()->route('quality.home')->with('success', 'OT liberada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('quality.home')->with('error', 'Hubo un problema al liberar la OT.');
        }
    }
}
