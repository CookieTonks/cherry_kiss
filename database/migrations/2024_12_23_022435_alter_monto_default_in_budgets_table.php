<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->decimal('monto', 8, 2)->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->decimal('monto', 8, 2)->nullable()->change(); // Or revert to previous state if applicable
        });
    }
};
