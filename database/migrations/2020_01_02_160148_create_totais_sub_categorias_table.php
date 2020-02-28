<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotaisSubCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('totais_sub_categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ano');
            $table->string('mes');
            $table->decimal('previsto',12,2)->default(0);
            $table->decimal('realizado', 12,2)->default(0);
            $table->unsignedBigInteger('sub_categoria_id');
            $table->unsignedBigInteger('totais_categorias_id');
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias')
            ->onDelete('cascade');
            $table->foreign('totais_categorias_id')->references('id')->on('totais_categorias')
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
        Schema::dropIfExists('totais_sub_categorias');
    }
}
