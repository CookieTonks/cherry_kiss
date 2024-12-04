<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\StringHelper;
use setasign\Fpdi\Fpdi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



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
        $this->createBudget($request);

        //     return redirect()->route('budgets.index')->with('success', 'Orden de Compra creada con éxito.');
        // } catch (\Throwable $th) {
        //     Log::error('Error al crear el presupuesto: ' . $th->getMessage());
        //     return redirect()->route('budgets.index')->with('error', 'Hubo un problema al crear el presupuesto.');
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

            if (isset($item['pdf']) && $item['pdf']->isValid()) {
                // 1. Guarda el archivo original
                $originalPath = $item['pdf']->store('partidas-imagenes', 'public');
                $originalPdfPath = storage_path('app/public/' . $originalPath);

                // 2. Combina con FPDI
                $fpdi = new FPDI();
                $pageCount = $fpdi->setSourceFile($originalPdfPath);

                // Ruta del archivo final
                $processedPath = 'partidas-imagenes/processed-' . basename($originalPath);
                $processedPdfPath = storage_path('app/public/' . $processedPath);

                // Importa las páginas del PDF original y agrega el logo y el footer
                for ($i = 1; $i <= $pageCount; $i++) {
                    $templateId = $fpdi->importPage($i);
                    $fpdi->AddPage('L'); // Forzar a Landscape (horizontal)
                    $fpdi->useTemplate($templateId);

                    // Agregar el logo a la página
                    $fpdi->Image(storage_path('app/public/logo.png'), 10, 10, 20); // Logo en la parte superior izquierda
                    $fpdi->SetY(10); // Posicionar el footer en la parte inferior
                    $fpdi->SetFont('Arial', '', 12);
                    $fpdi->Cell(0, 2, $budget->codigo, 0, 0, 'C'); // El código en el centro del footer
                }

                // 3. Guardar el PDF procesado
                $fpdi->Output($processedPdfPath, 'F');

                // El path del archivo final procesado
                $path = $processedPath;
            }
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
