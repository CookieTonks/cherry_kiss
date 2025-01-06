<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Budget;
use App\Models\Item;
use App\Helpers\StringHelper;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $budgets = Budget::where('user_id', $userId)
            ->whereHas('proceso', function ($query) {
                $query->where('cotizaciones', 1);
            })
            ->get();


        $materials = Material::all();
        return view('vistas.orders.home', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showBudgetOrders($budgetId)
    {
        $budget = Budget::findOrFail($budgetId);
        $items = $budget->items;

        return view('vistas.orders.show', compact('budget', 'items'));
    }

    public function makeOrder($budgetId, $ItemId)
    {
        $budget = Budget::findOrFail($budgetId);

        $item = $budget->items->where('id', $ItemId)->first();

        $html = view('vistas.orders.ot', compact('budget', 'item'))->render();

        $pdf = \PDF::loadHTML($html)->setPaper('a4', 'portrait');

        // Descargar el PDF
        return $pdf->stream("budget_{$budget->codigo}_{$ItemId}.pdf");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getMaterials($ItemId)
    {
        // Busca el item con su relación de materiales
        $order = Item::findOrFail($ItemId);

        // Obtén los materiales relacionados
        $materials = $order->materials;

        // Retorna los materiales
        return $materials;
    }


    /**
     * Display the specified resource.
     */
    public function showMaterials($ItemId)
    {
        // Busca el item con su relación de materiales
        $item = Item::findOrFail($ItemId);

        // Obtén los materiales relacionados
        $materials = $item->materials;

        return view('vistas.orders.materials', compact('materials', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detroyMaterial($materialId)
    {
        try {
            $material = Material::findOrFail($materialId);
            $material->delete();

            return back()->with('success', '¡Material eliminado con éxito!');
        } catch (\Throwable $th) {
            return back()->with('error', '¡Material no eliminada, intenta de nuevo!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function addMaterials($ItemId, Request $request)
    {
        try {
            $data = [
                'item_id' => $ItemId,
                'descripcion' => $request->descripcion,
                'cantidad' => $request->cantidad,
                'unidad' => $request->unidad,
                'medida' => $request->medida,
                'estatus'  => 'PENDIENTE',
                'precio_unitario'   => '0.00'
            ];

            $fieldsToUpper = ['descripcion', 'medida', 'estatus'];

            $data = StringHelper::convertToUpperCase($data, $fieldsToUpper);

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
            return back()->with('error', '¡Material no agregado, intenta de nuevo!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
