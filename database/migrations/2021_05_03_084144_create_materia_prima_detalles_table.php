<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaPrimaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_prima_detalles', function (Blueprint $table) {
            $table->id();
            $table->decimal('salidas',$precision = 10, $scale = 2);
            $table->dateTime('fecha')->nullable();

            $table->unsignedBigInteger('inventario_materia_prima_id');

            $table->foreign('inventario_materia_prima_id')->references('id')->on('inventario_materia_primas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia_prima_detalles');
    }
}
