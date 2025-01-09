<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Oc;
use App\Models\Supplier;

class ComprasController extends Controller
{
    public function Home()
    {
        $materiales = Material::all();
        $ocs = Oc::all();
        $proveedores = Supplier::all();
        return view('vistas.shooping.home', compact('materiales', 'ocs', 'proveedores'));
    }

    public function store(Request $request)
    {

        try {
            $data = [
                'codigo' => 'OC-' . (Oc::max('id') + 1),
                'supplier_id' => $request->supplier_id,
                'moneda' => $request->moneda,
                'estatus' => 'REGISTRADA',
            ];
            Oc::create($data);
            return back()->with('success', '¡OC creada con éxito!');
        } catch (\Exception $e) {
            return back()->with('error', '¡Hubo un problema al crear la OC, intenta de nuevo!');
        }
    }

    public function materialOc($materialId, Request $request)
    {
        try {
            $id = $request->materialId;
            Material::whereKey($id)->update([
                'oc_id' => $request->oc_id,
                'precio_unitario' => $request->precio_unitario,
            ]);
            return back()->with('success', '¡Material asignada a OC con exito!');
        } catch (\Exception $e) {
            return back()->with('error', '¡Hubo un problema al asignar el material a OC, intenta de nuevo!' . $e);
        }
    }

    public function getMaterials($ocId)
    {

        $oc = Oc::findorfail($ocId);

        $materials = $oc->materials()->with([
            'item.budget.client',
            'item.budget.user',
            'oc',
        ])->get();


        return response()->json($materials); // Devuelve la respuesta en formato JSON.
    }

    public function ocPdf()
    {

        $html = view('vistas.shooping.oc')->render();

        $pdf = \PDF::loadHTML($html)->setPaper('a4', 'portrait');

        // Descargar el PDF
        return $pdf->stream("budget.pdf");
    }
}
