<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_facturas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha', $precision = 0);
            $table->decimal('monto',$precision = 10, $scale = 4);
            $table->string('descripcion',150)->nullable();

            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('metodo_pago_id');

            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos')->onDelete('cascade');
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
        Schema::dropIfExists('pago_facturas');
    }
}
