<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacotesServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacotes_servicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pacote_id')->nullable();
            $table->unsignedBigInteger('servico_id')->nullable();
            $table->integer('quantidade');
            $table->decimal('valor_unitario',12,2);
            $table->decimal('desconto_real',12,2);
            $table->decimal('valor_servico',12,2);
            $table->foreign('pacote_id')->references('id')->on('pacotes')
                ->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos')
                ->onDelete('cascade ');
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
        Schema::dropIfExists('pacotes_servicos');
    }
}
