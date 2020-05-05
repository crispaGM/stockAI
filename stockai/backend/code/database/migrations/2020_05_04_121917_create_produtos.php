<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('qtd_estoque');
            $table->decimal('valor_custo', 8, 2);
            $table->decimal('valor_venda', 8, 2);
            $table->dateTime('data_validade', 0);

            $table->integer('unidade_negocio_id')->unsigned();
            $table->foreign('unidade_negocio_id')->references('id')->on('unidade_negocio');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');

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
