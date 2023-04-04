<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->date("Fecha_interaccion");
            $table->string("Nombre");
            $table->string("Telefono");
            $table->string("Email");
            $table->string("Empresa");
            $table->string("Tipo_cliente");
            $table->string("Servicio");
            $table->date("Ultima_interaccion");
            $table->string("Estado");
            $table->string("Notas");
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
        Schema::dropIfExists('clientes');
    }
}
