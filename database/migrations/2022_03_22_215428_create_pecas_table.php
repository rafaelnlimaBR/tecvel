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
        Schema::create('pecas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->decimal('valor',8,2);
            $table->string('descricao');
            $table->integer('qnt')->default(1);
            $table->integer('pedido_id')->unsigned()->nullable();
            $table->bigInteger('historico_id')->unsigned();
            $table->boolean('autorizado')->default(true);

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
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
        Schema::dropIfExists('pecas');
    }
};
