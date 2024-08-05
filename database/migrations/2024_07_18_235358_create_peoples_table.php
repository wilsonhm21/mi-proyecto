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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('nombres',20);
            $table->string('ape_paterno',20);
            $table->string('ape_materno',20);
            $table->string('dni',8);
            $table->string('genero');
            $table->string('fecha_nacimiento');
            $table->string('estado',18);
            $table->string('direccion',20);
            $table->string('telefono',9);
            $table->string('correo_electronico')->unique();
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('department_id');
            $table->string('departamento_id');
            $table->string('provincia_id');
            $table->string('distrito_id');

            $table->timestamps();



            $table->foreign('distrito_id')->references('id')->on('distritos');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoples');
    }
};
