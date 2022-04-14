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
        Schema::create('status', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->string('nome');
            $table->string('cor');
            $table->boolean('habilitado')->default(true);
            $table->boolean('editar_servicos')->default(false);
            $table->boolean('editar_pagamentos')->default(false);
            $table->boolean('editar_pecas')->default(false);
            $table->boolean('editar_pedidos')->default(false);
            $table->boolean('editar_terceirizados')->default(false);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status');
    }
};
