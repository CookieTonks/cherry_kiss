<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\StringHelper;
use App\Models\Item;
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
        $budgets = Budget::where('user_id', $userId)
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



        $clients = Client::all();


        return view('vistas.budget.home', compact('budgets', 'estado', 'totales', 'clients'));
    }


    public function store(Request $request)
    {
        try {
            $this->createBudget($request);

            return redirect()->route('budgets.index')->with('success', 'Orden de Compra creada con éxito.');
        } catch (\Throwable $th) {
            Log::error('Error al crear el presupuesto: ' . $th->getMessage());
            return redirect()->route('budgets.index')->with('error', 'Hubo un problema al crear el presupuesto.');
        }
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

                // Importa las páginas del PDF original y ajusta tamaño
                for ($i = 1; $i <= $pageCount; $i++) {
                    $templateId = $fpdi->importPage($i);

                    // Obtiene el tamaño y orientación de la página original
                    $size = $fpdi->getTemplateSize($templateId);
                    $orientation = ($size['width'] > $size['height']) ? 'L' : 'P';

                    // Crea una nueva página con las dimensiones originales
                    $fpdi->AddPage($orientation, [$size['width'], $size['height']]);

                    // Usa la plantilla de la página original
                    $fpdi->useTemplate($templateId);

                    // Agregar el logo a la página
                    $fpdi->Image(storage_path('app/public/logo.png'), 10, 10, 20); // Logo en la parte superior izquierda

                    // Establecer las coordenadas y formato para agregar el código
                    $fpdi->SetY(10);
                    $fpdi->SetX($size['width'] - 60); // Ajustar según el tamaño de la página
                    $fpdi->SetFillColor(200, 200, 200); // Fondo gris
                    $fpdi->SetFont('Arial', '', 14);
                    $fpdi->Cell(50, 10, $budget->codigo, 0, 0, 'C', true); // Agregar el código

                    // Agregar pie de página
                    $fpdi->SetY(-15); // Pie de página a 15mm del borde inferior
                    $fpdi->SetFont('Arial', 'I', 8);
                    // $fpdi->Cell(0, 10, 'Página ' . $fpdi->PageNo(), 0, 0, 'C');
                }

                // 3. Guardar el PDF procesado
                $fpdi->Output($processedPdfPath, 'F');

                // El path del archivo final procesado
                $path = $processedPath;
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

    public function show($budgetId)
    {

        $budget = Budget::findorfail($budgetId);
        $items = $budget->items;
        return view('vistas.budget.show', compact('budget', 'items'));
    }


    public function make($budgetId)
    {
        $budget = Budget::findOrFail($budgetId);
        $totalSubtotal = $budget->items->sum('subtotal');
        $budget->monto = $totalSubtotal;
        $budget->save();

        $items = $budget->items;

        $html = view('vistas.budget.cot', compact('budget', 'items'))->render();

        $pdf = \PDF::loadHTML($html)->setPaper('a4', 'portrait');

        // Descargar el PDF
        return $pdf->stream("budget_{$budget->id}.pdf");
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budgetId)
    {
        $budget = $budgetId;
        $clients = Client::all();
        return view('vistas.budget.edit', compact('budget', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {

        try {
            // Actualizar el modelo
            $budget->update($request->only(['descripcion', 'cantidad', 'precio_unitario']));


            return back()->with('success', '¡Cotizacion modificada con éxito!');
        } catch (\Exception $e) {
            return back()->with('error', '¡Cotizacion no modificada, intenta de nuevo!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroyBudget(Budget $budget)
    {
        //
    }

    public function storeItem(Request $request, $budgetId)
    {

        try {
            $budget = Budget::findOrFail($budgetId);

            $path = null;

            if (isset($request->pdf) && $request->pdf->isValid()) {
                // 1. Guarda el archivo original
                $originalPath = $request->pdf->store('partidas-imagenes', 'public');
                $originalPdfPath = storage_path('app/public/' . $originalPath);

                // 2. Combina con FPDI
                $fpdi = new FPDI();
                $pageCount = $fpdi->setSourceFile($originalPdfPath);

                // Ruta del archivo final
                $processedPath = 'partidas-imagenes/processed-' . basename($originalPath);
                $processedPdfPath = storage_path('app/public/' . $processedPath);

                // Importa las páginas del PDF original y ajusta tamaño
                for ($i = 1; $i <= $pageCount; $i++) {
                    $templateId = $fpdi->importPage($i);

                    // Obtiene el tamaño y orientación de la página original
                    $size = $fpdi->getTemplateSize($templateId);
                    $orientation = ($size['width'] > $size['height']) ? 'L' : 'P';

                    // Crea una nueva página con las dimensiones originales
                    $fpdi->AddPage($orientation, [$size['width'], $size['height']]);

                    // Usa la plantilla de la página original
                    $fpdi->useTemplate($templateId);

                    // Agregar el logo a la página
                    $fpdi->Image(storage_path('app/public/logo.png'), 10, 10, 20); // Logo en la parte superior izquierda

                    // Establecer las coordenadas y formato para agregar el código
                    $fpdi->SetY(10);
                    $fpdi->SetX($size['width'] - 60); // Ajustar según el tamaño de la página
                    $fpdi->SetFillColor(200, 200, 200); // Fondo gris
                    $fpdi->SetFont('Arial', '', 14);
                    $fpdi->Cell(50, 10, $budget->codigo, 0, 0, 'C', true); // Agregar el código

                    // Agregar pie de página
                    $fpdi->SetY(-15); // Pie de página a 15mm del borde inferior
                    $fpdi->SetFont('Arial', 'I', 8);
                    // $fpdi->Cell(0, 10, 'Página ' . $fpdi->PageNo(), 0, 0, 'C');
                }

                // 3. Guardar el PDF procesado
                $fpdi->Output($processedPdfPath, 'F');

                // El path del archivo final procesado
                $path = $processedPath;
            }

            $budget->items()->create([
                'descripcion' => $request['descripcion'],
                'cantidad' => $request['cantidad'],
                'precio_unitario' => $request['precio_unitario'],
                'subtotal' => $request['cantidad'] * $request['precio_unitario'],
                'imagen' => $path,
            ]);

            return back()->with('success', '¡Partida agregada con éxito!');
        } catch (\Throwable $th) {
            return back()->with('error', '¡Partida no agregada, intenta de nuevo!');
        }
    }


    public function destroyItem($itemId)
    {
        try {
            $item = Item::findOrFail($itemId);

            if ($item->imagen && file_exists(public_path($item->imagen))) {
                unlink(public_path($item->imagen));
            }
            $item->delete();

            return back()->with('success', '¡Partida y archivo PDF borrados con éxito!');
        } catch (\Throwable $th) {
            return back()->with('error', '¡Partida no eliminada, intenta de nuevo!');
        }
    }
}
