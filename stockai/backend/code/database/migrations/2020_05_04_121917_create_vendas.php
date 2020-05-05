<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor_total', 8, 2)->default(0);
            $table->decimal('valor_desconto', 8, 2)->default(0);
            $table->text('obs')->nullable(true);
            $table->string('metodo_pagamento')->default('debito');
            $table->string('status')->default(0);

            $table->integer('unidade_negocio_id')->unsigned();
            $table->foreign('unidade_negocio_id')->references('id')->on('unidade_negocio');

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
        Schema::dropIfExists('produtos');
    }
}
