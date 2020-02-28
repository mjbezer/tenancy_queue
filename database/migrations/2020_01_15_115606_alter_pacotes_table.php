<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPacotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacotes', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('sub_categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')
            ->onDelete('cascade');
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacotes', function (Blueprint $table) {
            //
        });
    }
}
