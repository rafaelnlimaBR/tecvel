<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_historicos', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->integer('entrada_id')->unsigned();
            $table->bigInteger('historico_id')->unsigned();

            $table->foreign('entrada_id')->references('id')->on('entradas')->onDelete('cascade');
            $table->foreign('historico_id')->references('id')->on('historicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrada_historicos');
    }
};
