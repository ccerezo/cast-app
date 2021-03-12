<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',30);
            $table->string('descripcion',100);
            $table->decimal('precio_produccion',$precision = 10, $scale = 4);
            $table->decimal('precio_mayorista',$precision = 10, $scale = 4);
            $table->decimal('precio_venta_publico',$precision = 10, $scale = 4);
            $table->integer('stock');
            $table->integer('descuento');
            $table->string('image',200)->nullable();
            $table->enum('activo',['si','no'])->default('si');

            $table->unsignedBigInteger('bodega_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('modelo_id');
            $table->unsignedBigInteger('linea_id');
            $table->unsignedBigInteger('talla_id');
            $table->unsignedBigInteger('color_id');

            $table->foreign('bodega_id')->references('id')->on('bodegas')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
            $table->foreign('linea_id')->references('id')->on('lineas')->onDelete('cascade');
            $table->foreign('talla_id')->references('id')->on('tallas')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

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
        Schema::dropIfExists('productos');
    }
}
