<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('inicio');
            $table->datetime('fim');
            $table->boolean('status_agenda')->default(1);
            $table->boolean('status_financeiro')->default(0);            
            $table->longtext('observacao')->nullable();
            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->unsignedBigInteger('servico_id')->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos')
            ->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('servico_id')->references('id')->on('servicos')
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
        Schema::dropIfExists('agenda');
    }
}
