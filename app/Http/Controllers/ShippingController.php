<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\Request;
use App\Models\Item;


class ShippingController extends Controller
{
    public function Home()
    {

        $next_id = Entrega::max('id') + 1;
        $ordenes = Item::where('estado', 'E.PENDIENTE')->get();
        $contador = Item::where('estado', 'E.PENDIENTE')->count();

        return view('vistas.shipping.home', compact('ordenes', 'contador', 'next_id'));
    }

    public function salida_factura(Request $request, $id)
    {

        try {

            $entrega = new Entrega ();
            $entrega->item_id = $id;
            $entrega->cantidad = $request->cantidad;
            $entrega->tipo_documento = $request->tipo_documento;
            $entrega->numero_documento = $request->numero_documento;
            $entrega->razon_social = $request->razon_social;
            // $entrega->save();

           
            // if($request->ultima_entrega == "1"){
            //     Item::where('id', $id)->update(['estado' => 'E.ENTREGADO']);
            // }


            $html = view('vistas.shipping.factura', compact('entrega'))->render();

            $pdf = \PDF::loadHTML($html)->setPaper('a4', 'portrait');
    
            // Descargar el PDF
            return $pdf->stream("SAL-{$entrega->id}_F-{$request->numero_documento}.pdf");

        } catch (\Throwable $th) {
            return redirect()->route('shipping.home')->with('error', 'Hubo un problema al registrar la salida.');
        }
    }
}
