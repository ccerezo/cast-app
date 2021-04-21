<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->dateTime('fecha', $precision = 0);
            $table->decimal('subtotal',10,2);
            $table->decimal('iva',10,2);
            $table->decimal('total',10,2);
            $table->decimal('descuento',10,2);
            $table->enum('forma_pago',['CONTADO','CREDITO'])->default('CONTADO');
            $table->string('observacion',150)->nullable();
            $table->date('vencimiento')->nullable();
            $table->unsignedBigInteger('facturado_como_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('cajero_id');
            $table->unsignedBigInteger('estado_factura_id');

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('facturado_como_id')->references('id')->on('tipo_clientes')->onDelete('cascade');
            $table->foreign('cajero_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('estado_factura_id')->references('id')->on('estado_facturas')->onDelete('cascade');
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
        Schema::dropIfExists('facturas');
    }
}
