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
        Schema::create('taxas', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->string('nome');
            $table->decimal('taxa');
            $table->integer('tipo_id')->unsigned();

            $table->foreign('tipo_id')->references('id')->on('tipo_pagamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxas');
    }
};
