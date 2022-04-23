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
        Schema::create('respostas_comentarios', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->string('texto');
            $table->dateTime('data');
            $table->boolean('habilitado');
            $table->integer('user_id')->unsigned();
            $table->integer('comentario_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('comentario_id')->references('id')->on('comentarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respostas_comentarios');
    }
};
