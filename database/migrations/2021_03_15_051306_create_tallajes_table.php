<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tallajes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',100)->nullable();
            $table->enum('activo',['si','no'])->default('si');

            $table->unsignedBigInteger('linea_id');
            $table->unsignedBigInteger('talla_id');

            $table->foreign('linea_id')->references('id')->on('lineas')->onDelete('cascade');
            $table->foreign('talla_id')->references('id')->on('tallas')->onDelete('cascade');


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
        Schema::dropIfExists('tallajes');
    }
}
