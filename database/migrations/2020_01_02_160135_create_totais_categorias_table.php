<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotaisCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('totais_categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ano');
            $table->string('mes');
            $table->decimal('previsto', 12,2)->default(0);
            $table->decimal('realizado', 12,2)->default(0);
            $table->unsignedBigInteger('categoria_id');
            $table->boolean('receita_despesa');
            $table->foreign('categoria_id')->references('id')->on('categorias')
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
        Schema::dropIfExists('totais_categorias');
    }
}
