<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('marca');
            $table->string('modelo');
            $table->string('numero_serie')->unique();
            $table->string('fecha_registro');
            $table->string('estado_actual');
            $table->string('descripcion');
            $table->string('imagen');
            $table->timestamps();
            $table->unsignedBigInteger('location_id');

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
