<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrfConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trf_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titular')->nullable();
            $table->string('doc',20)->nullable(); 
            $table->string('banco', 30)->nullable(); 
            $table->string('agencia', 20)->nullable();
            $table->string('tipo', 20)->nullable(); 
            $table->string('conta', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trf_config');
    }
}
