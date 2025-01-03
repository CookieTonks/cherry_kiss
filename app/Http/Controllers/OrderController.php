<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Budget;


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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
