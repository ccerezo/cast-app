<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_detalles', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_produccion',$precision = 10, $scale = 4);
            $table->decimal('precio_mayorista',$precision = 10, $scale = 4);
            $table->decimal('precio_venta_publico',$precision = 10, $scale = 4);
            $table->integer('cantidad');
            $table->integer('descuento');
            $table->string('iva',10);

            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('producto_id');

            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');

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
        Schema::dropIfExists('factura_detalles');
    }
}
