<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacotesPedidoTable extends Migration
{
    public function up()
    {
        Schema::create('pacotes_pedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->unsignedBigInteger('pacote_id')->nullable();
            $table->integer('quantidade');
            $table->decimal('valor_unitario',12,2);
            $table->decimal('desconto_item',12,2);
            $table->decimal('valor_liquido_unitario',12,2);
            $table->decimal('valor_total_item',12,2);
            $table->longtext('observacao')->nullable();
            $table->foreign('pacote_id')->references('id')->on('pacotes')
                ->onDelete('cascade');
                $table->foreign('pedido_id')->references('id')->on('pedidos')
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
        Schema::dropIfExists('pedidos');
    }
}
