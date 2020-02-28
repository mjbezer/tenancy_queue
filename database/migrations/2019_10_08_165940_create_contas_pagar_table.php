<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasPagarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_pagar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento_fiscal');
            $table->date('data_documento_fiscal');
            $table->decimal('valor_original',12,2);
            $table->string('especie');
            $table->decimal('valor_pago',12,2)->nullable();
            $table->date('data_vencimento')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->longtext('observacao')->nullable();
            $table->unsignedBigInteger('pessoa_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('sub_categoria_id')->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')
              ->onDelete('cascade')->onUpdate('cascade');
              $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias')
              ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('contas_pagar');
    }
}
