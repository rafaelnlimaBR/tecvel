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
            $table->string('titulo')->nullable();
            $table->text('texto')->nullable();
            $table->string('url')->nullable();
            $table->boolean('habilitado');
            $table->string('sequencia');
            $table->string('img');

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
