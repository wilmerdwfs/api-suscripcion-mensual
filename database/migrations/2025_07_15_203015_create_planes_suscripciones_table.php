<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('planes_suscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('plan_anterior_id')->nullable()->constrained('planes')->nullOnDelete();
            $table->foreignId('plan_nuevo_id')->constrained('planes')->cascadeOnDelete();
            $table->string('estado');
            $table->date('fecha');
            // Sin timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('planes_suscripciones');
    }
};
