<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;

class ProductionController extends Controller
{
    public function Home()
    {
        $ordenes = Item::all();

        $tecnicos = User::role('Developer')->get();

        return view('vistas.production.home', compact('ordenes', 'tecnicos'));
    }

    public function tecnicoOt(Request $request, $otId)
    {
        try {

            $orden = Item::findOrFail($otId);
            $orden->tecnico = $request->tecnico_id;
            $orden->estado = 'ASIGANDA';
            $orden->save();
            return redirect()->route('production.home')->with('success', 'Tecnico asignado con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('production.home')->with('error', 'Hubo un problema al asignar el tecnico.');
        }
    }

    public function liberacionOt(Request $request, $otId)
    {
        try {
            $orden = Item::findOrFail($otId);
            $orden->estado = 'E.CALIDAD';
            $orden->save();
            return redirect()->route('production.home')->with('success', 'OT enviada a calidad con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('production.home')->with('error', 'Hubo un problema al enviar OT a calidad, por favor intenta de nuevo.');
        }
    }
}
