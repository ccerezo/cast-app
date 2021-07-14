<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('entradas')->nullable();
            $table->dateTime('ultima_entrada', $precision = 0)->nullable();
            $table->integer('salidas')->nullable();
            $table->dateTime('ultima_salida', $precision = 0)->nullable();
            $table->integer('stock');
            $table->decimal('precio_produccion',$precision = 10, $scale = 4)->nullable();
            $table->decimal('precio_mayorista',$precision = 10, $scale = 4)->nullable();
            $table->decimal('precio_venta_publico',$precision = 10, $scale = 4)->nullable();
            $table->string('descripcion',100)->nullable();

            $table->unsignedBigInteger('producto_id');

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
        Schema::dropIfExists('inventario_detalles');
    }
}
