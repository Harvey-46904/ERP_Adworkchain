<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string("Nombre_completo");
            $table->string("Cedula");
            $table->string("Cargo");
            $table->date("Fecha_ingreso");
            $table->date("Fecha_finalizacion");
            $table->string("Email");
            $table->string("Telefono_personal");
            $table->string("Contacto_emergencia");
            $table->string("Numero_contacto_emergencia");
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
        Schema::dropIfExists('empleados');
    }
}
