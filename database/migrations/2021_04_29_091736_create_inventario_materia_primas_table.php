<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioMateriaPrimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_materia_primas', function (Blueprint $table) {
            $table->id();

            $table->decimal('stock',$precision = 10, $scale = 2);
            $table->decimal('costo_unidad',$precision = 10, $scale = 4);
            $table->date('fecha_compra')->nullable();
            $table->enum('activo',['si','no'])->default('si');

            $table->unsignedBigInteger('materia_prima_id');
            $table->unsignedBigInteger('proveedor_id');


            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade');

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
        Schema::dropIfExists('inventario_materia_primas');
    }
}
