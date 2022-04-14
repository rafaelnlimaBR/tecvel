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
        Schema::create('saida_comissao', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->integer('saida_id')->unsigned();
            $table->integer('comissao_id')->unsigned();

            $table->foreign('saida_id')->references('id')->on('saidas')->onDelete('cascade');
            $table->foreign('comissao_id')->references('id')->on('comissoes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saida_comissao');
    }
};
