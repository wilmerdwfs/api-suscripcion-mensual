<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->boolean('es_admin')->default(false);
            // Sin timestamps
       });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
