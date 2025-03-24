<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Mail\OrdenListaFacturar;
use Illuminate\Support\Facades\Mail;



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
            $item = Item::find($id);

            if (!$item) {
                return redirect()->route('shipping.home')->with('error', 'La OT no existe.');
            }

            // Sumar todas las entregas existentes
            $sumaEntregas = $item->entregas->sum('cantidad');
            $nuevaCantidad = $request->cantidad;
            $totalEntregas = $sumaEntregas + $nuevaCantidad;

            // Verificar si es la última entrega
            if ($request->ultima_entrega == "1" && $totalEntregas != $item->cantidad) {
                return redirect()->route('shipping.home')->with('error', 'La cantidad total de piezas no coincide. No se registró la entrega.');
            }

            // Registrar la entrega
            $entrega = new Entrega();
            $entrega->item_id = $id;
            $entrega->cantidad = $nuevaCantidad;
            $entrega->tipo_documento = $request->tipo_documento;
            $entrega->numero_documento = $request->numero_documento;
            $entrega->persona_entrega = $request->persona_entrega;
            $entrega->persona_recibe = $request->persona_recibe;
            $entrega->razon_social = $request->razon_social;
            $entrega->save();

            // Si es la última entrega y la cantidad coincide, marcar como "E.ENTREGADO"
            if ($request->ultima_entrega == "1" && $totalEntregas == $item->cantidad) {
                $item->update(['estado' => 'E.ENTREGADO']);
                Mail::to('miriamdominguez.e@gmail.com')->send(new OrdenListaFacturar($item));
            }


            // Generar el PDF para cualquier entrega (última o no)
            $html = view('vistas.shipping.factura', compact('entrega'))->render();
            $pdf = \PDF::loadHTML($html)->setPaper('a4', 'portrait');

            return $pdf->stream("SAL-{$entrega->id}_F-{$request->numero_documento}.pdf");
        } catch (\Throwable $th) {
            return redirect()->route('shipping.home')->with('error', 'Hubo un problema al registrar la entrega. ' . $th->getMessage());
        }
    }



    public function salida_remision(Request $request, $id)
    {
        try {
            $item = Item::find($id);

            if (!$item) {
                return redirect()->route('shipping.home')->with('error', 'La OT no existe.');
            }

            // Sumar todas las entregas existentes
            $sumaEntregas = $item->entregas->sum('cantidad');
            $nuevaCantidad = $request->cantidad;
            $totalEntregas = $sumaEntregas + $nuevaCantidad;

            // Si es la última entrega, validar que la cantidad total coincida antes de guardar
            if ($request->ultima_entrega == "1" && $totalEntregas != $item->cantidad) {
                return redirect()->route('shipping.home')->with('error', 'La cantidad total de piezas no coincide. No se registró la entrega.');
            }

            // Registrar la entrega
            $entrega = new Entrega();
            $entrega->item_id = $id;
            $entrega->cantidad = $nuevaCantidad;
            $entrega->tipo_documento = $request->tipo_documento;
            $entrega->persona_entrega = $request->persona_entrega;
            $entrega->persona_recibe = $request->persona_recibe;
            $entrega->razon_social = $request->razon_social;
            $entrega->save();

            // Si es la última entrega y la cantidad coincide, marcar como entregado
            if ($request->ultima_entrega == "1" && $totalEntregas == $item->cantidad) {
                $item->update(['estado' => 'E.ENTREGADO']);
                Mail::to('miriamdominguez.e@gmail.com')->send(new OrdenListaFacturar($item));
            }

            // Generar el PDF para cualquier entrega (última o no)
            $html = view('vistas.shipping.remision', compact('entrega'))->render();
            $pdf = \PDF::loadHTML($html)->setPaper('a4', 'portrait');

            return $pdf->stream("SAL-{$entrega->id}_R-{$request->numero_documento}.pdf");
        } catch (\Throwable $th) {
            return redirect()->route('shipping.home')->with('error', 'Hubo un problema al registrar la entrega. ' . $th->getMessage());
        }
    }




    public function showHistorial($id)
    {

        $orden = Item::with('entregas')->find($id);
        return response()->json($orden->entregas);
    }

    public function Entregas()
    {
        $entregas = Entrega::all();
        return view('vistas.shipping.entregas', compact('entregas'));
    }

    public function cargaSalida() {}
}
