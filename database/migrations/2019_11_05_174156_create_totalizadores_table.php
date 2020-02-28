<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalizadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('totalizadores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conta_receber_id')->nullable();
            $table->unsignedBigInteger('conta_pagar_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('sub_categoria_id')->nullable();
            $table->decimal('valor_pago', 12,2 );
            $table->date('data_pagamento');
            $table->foreign('conta_receber_id')->references('id')->on('contas_receber')->onDelete('cascade');
            $table->foreign('conta_pagar_id')->references('id')->on('contas_pagar')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('totalizadores');
    }
}
