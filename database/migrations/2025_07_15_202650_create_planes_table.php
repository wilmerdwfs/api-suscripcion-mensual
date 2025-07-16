<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('precio_mensual');
            $table->integer('limite_usuarios');
            $table->integer('caracteristicas');
            // No timestamps porque el modelo los desactiva
        });
    }

    public function down()
    {
        Schema::dropIfExists('planes');
    }
};
