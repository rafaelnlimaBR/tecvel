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
        Schema::create('imagens_post', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->string('img');
            $table->string('titulo');
            $table->string('descricao')->nullable();
            $table->string('alt');
            $table->integer('sequencia')->default(1);
            $table->integer('post_id')->unsigned();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagens');
    }
};
