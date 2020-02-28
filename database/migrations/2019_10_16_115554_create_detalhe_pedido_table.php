<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalhePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhe_pedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pacote_pedido_id')->nullable();
            $table->unsignedBigInteger('servico_id')->nullable();
            $table->integer('qtde_adquirida');
            $table->integer('qtde_consumida')->default(0);
            $table->foreign('pacote_pedido_id')->references('id')->on('pacotes_pedido')
                ->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos')
                ->onDelete('cascade');
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
        Schema::dropIfExists('detalhe_pedido');
    }
}
