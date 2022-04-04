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
        Schema::create('entrada_pedidos', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->integer('entrada_id')->unsigned();
            $table->integer('pedido_id')->unsigned();

            $table->foreign('entrada_id')->references('id')->on('entradas')->onDelete('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrada_pedidos');
    }
};
