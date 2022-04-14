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
        Schema::create('saida_terceirizado', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->integer('saida_id')->unsigned();
            $table->integer('terceirizado_id')->unsigned();

            $table->foreign('saida_id')->references('id')->on('saidas')->onDelete('cascade');
            $table->foreign('terceirizado_id')->references('id')->on('terceirizados')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saida_terceirizado');
    }
};
