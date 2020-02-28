<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('ativo')->default(1);
            $table->string('descricao');
            $table->decimal('valor',12,2);
            $table->decimal('custo_direto',12,2);
            $table->decimal('iss_aliquota',5,3);
            $table->decimal('custo_total', 12,2);
            $table->longtext('observacao')->nullable();
            $table->string('cor')->nullable();
            $table->integer('duracao');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('sub_categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias')
                ->onDelete('cascade');
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias')
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
        Schema::dropIfExists('servicos');
    }
}
