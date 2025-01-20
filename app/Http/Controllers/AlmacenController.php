<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Helpers\StringHelper;


class AlmacenController extends Controller
{
    public function Home()
    {
        $materiales = Material::where('estatus', '=', 'pendiente')->get();
        // $ocs = Oc::all();
        // $proveedores = Supplier::all();
        return view('vistas.store.home', compact('materiales'));
    }

    public function check($materialId)
    {
        try {
            Material::where('id', $materialId)->update(['estatus' => 'entregado']);
            return redirect()->route('almacen.home')->with('success', 'Material recibido con éxito.');
        } catch (\Throwable $th) {
            Log::error('Error dar entrada al material: ' . $th->getMessage());
            return redirect()->route('almacen.home')->with('error', 'Hubo un problema al recibir el material.');
        }
    }

    public function askMaterial(Request $request)
    {
        try {
            $data = [
                'descripcion' => $request->descripcion,
                'cantidad' => $request->cantidad,
                'unidad' => $request->unidad,
                'medida' => $request->medida,
                'estatus'  => 'registrado',
                'precio_unitario'   => '0.00'
            ];

            $fieldsToUpper = ['descripcion', 'medida', 'estatus'];

            $data = StringHelper::convertToUpperCase($data, $fieldsToUpper);

            //Asignanr OT default para material interno

            $ItemId = 1;


            $material = Material::create([
                'item_id' => $ItemId,
                'descripcion' =>  $data['descripcion'],
                'cantidad' =>  $data['cantidad'],
                'unidad' => $data['unidad'],
                'medida' => $data['medida'],
                'estatus' => $data['estatus'],
                'precio_unitario' => $data['precio_unitario'],
            ]);

            return back()->with('success', '¡Material agregado con éxito!');
        } catch (\Throwable $th) {
            return back()->with('error', '¡Material no agregado, intenta de nuevo!' . $th);
        }
    }
}
