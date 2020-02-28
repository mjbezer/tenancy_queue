<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasReceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_receber', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->unsignedBigInteger('pessoa_id')->nullable();
            $table->date('data_vencimento');
            $table->decimal('valor_original',12,2);
            $table->date('data_pagamento')->nullable();
            $table->decimal('desconto', 12,2)->nullable();
            $table->decimal('valor_pago',12,2)->nullable();
            $table->longtext('observacao')->nullable();
            $table->unsignedBigInteger('forma_recebimento_id')->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade');
            $table->foreign('forma_recebimento_id')->references('id')->on('formas_recebimentos')->onDelete('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')
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
        Schema::dropIfExists('contas_receber');
    }
}
