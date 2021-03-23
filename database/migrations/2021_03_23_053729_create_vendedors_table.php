<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendedors', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion',20);
            $table->string('nombre',30);
            $table->decimal('cupo_aprobado',8,2);
            $table->decimal('cupo_disponible',8,2);
            $table->string('codigo',10)->nullable();
            $table->string('correo',30)->nullable();
            $table->string('telefono',30)->nullable();
            $table->enum('activo',['si','no'])->default('si');
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
        Schema::dropIfExists('vendedors');
    }
}
