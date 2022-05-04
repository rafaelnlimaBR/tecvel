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
        Schema::create('posts', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->string('titulo');
            $table->text('conteudo');
            $table->text('descricao');
            $table->string('img')->default("logo");
            $table->dateTime('data');
            $table->boolean('habilitado')->default(0);
            $table->bigInteger('visitas')->default(0)->nullable();
            $table->integer('user_id')->nullable()->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
