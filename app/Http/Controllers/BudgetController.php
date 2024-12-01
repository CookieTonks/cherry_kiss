<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $cotizaciones = Budget::where('user_id', auth()->id())->get();

        return view('vistas.budget.home', compact('cotizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string',
            'estado' => 'required|string',
            'monto' => 'required|string',
            'tipo' => 'required|string',
        ]);

        try {
            // Crear una nueva instancia de Budget
            $budget = new Budget();
            $budget->cliente = $request->cliente;
            $budget->user_id = auth()->id(); // Obtener el ID del usuario autenticado
            $budget->estado = $request->estado;
            $budget->monto = $request->monto;
            $budget->tipo = $request->tipo;
            $budget->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('cotizaciones.home')->with('error', 'Cotizacion creada exitosamente');
        } catch (\Throwable $th) {
            // Si ocurre un error, capturamos la excepción y retornamos con un mensaje de error
            return redirect()->route('cotizaciones.home')->with('error', 'Hubo un problema al crear el presupuesto. Intenta de nuevo.');
        }
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
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
