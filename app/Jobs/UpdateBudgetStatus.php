<?php

namespace App\Jobs;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateBudgetStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Encuentra los presupuestos que tienen más de 3 días y están en 'abierta'
        $budgets = Budget::where('created_at', '<', now()->subDays(3))
            ->where('estado', 'ABIERTA')
            ->get();

        // Cambiar su estado a 'pendiente'
        foreach ($budgets as $budget) {
            $budget->estado = 'PENDIENTE'; 
            $budget->save();
        }
    }
}
