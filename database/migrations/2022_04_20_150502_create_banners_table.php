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
        Schema::create('banners', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->string('titulo');
            $table->text('texto');
            $table->string('url')->nullable();
            $table->boolean('habilitado');
            $table->string('img');
            $table->dateTime('data');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
