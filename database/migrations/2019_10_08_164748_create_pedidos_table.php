<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pessoa_id')->nullable();
            $table->date('data_pedido');
            $table->decimal('valor',12,2);
            $table->decimal('desconto',12,2);
            $table->decimal('valor_total',12,2);
            $table->longtext('observacao')->nullable();
            $table->unsignedBigInteger('forma_recebimento_id')->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas')
                ->onDelete('cascade');
            $table->foreign('forma_recebimento_id')->references('id')->on('formas_recebimentos')
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
