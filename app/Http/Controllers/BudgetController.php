<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\StringHelper;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $estado = $request->query('estado');
        $userId = auth()->id();

        // Obtener cotizaciones según el estado
        $cotizaciones = Budget::where('user_id', $userId)
            ->when($estado, function ($query) use ($estado) {
                $query->where('estado', strtoupper($estado));
            })
            ->get();

        // Calcular el total por estado
        $totales = [
            'abiertas' => Budget::where('user_id', $userId)->where('estado', 'ABIERTA')->count(),
            'pendientes' => Budget::where('user_id', $userId)->where('estado', 'PENDIENTE')->count(),
            'cerradas' => Budget::where('user_id', $userId)->where('estado', 'CERRADA')->count(),
        ];


        $clientes = Client::all();


        return view('vistas.budget.home', compact('cotizaciones', 'estado', 'totales', 'clientes'));
    }





    public function store(Request $request)
    {


        // try {
            // Crear el presupuesto
            $this->createBudget($request);

            // Redirigir con mensaje de éxito
            return redirect()->route('budgets.index')->with('success', 'Orden de Compra creada con éxito.');
        // } catch (\Throwable $th) {
            // Manejar error
            Log::error('Error al crear el presupuesto: ' . $th->getMessage());
            return redirect()->route('budgets.index')->with('error', 'Hubo un problema al crear el presupuesto.');
        // }
    }


    public function createBudget(Request $request)
    {
        // Convertir datos generales a mayúsculas
        $data = [
            'client_id' => $request->client,
            'estado' => $request->estado,
            'tipo' => $request->tipo,
        ];

        // Especificamos los campos que queremos convertir
        $fieldsToUpper = ['estado', 'tipo'];

        $data = StringHelper::convertToUpperCase($data, $fieldsToUpper);

        // Crear el presupuesto
        $budget = Budget::create([
            'client_id' => $data['client_id'],
            'user_id' => auth()->id(),
            'estado' => 'ABIERTA',  // Estado convertido a mayúsculas
            'codigo' => 'OC-' . (Budget::max('id') + 1),
            'tipo' => $data['tipo'],  // Tipo convertido a mayúsculas
            'monto' => 0
        ]);

        $total = 0;

        // Crear partidas y convertir descripciones de items a mayúsculas
        $items = StringHelper::convertItemsToUpperCase($request->items);

        foreach ($request->items as $index => $item) {
            $path = null;


            if (isset($item['imagen']) && $item['imagen']->isValid()) {
                $path = $item['imagen']->store('partidas-imagenes', 'public');
            }


            $budget->items()->create([
                'descripcion' => $item['descripcion'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio_unitario'],
                'subtotal' => $item['cantidad'] * $item['precio_unitario'],
                'imagen' => $path,
            ]);
        }

        // Actualizar el monto total
        $budget->update([
            'monto' => $total,
        ]);

        return $budget;
    }




    public function getItems($budgetId)
    {
        $budget = Budget::findOrFail($budgetId);
        return response()->json($budget->items);
    }
}
