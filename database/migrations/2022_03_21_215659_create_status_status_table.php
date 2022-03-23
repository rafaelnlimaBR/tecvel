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
        Schema::create('status_status', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->integer('status_atual_id')->unsigned();
            $table->integer('status_proximo_id')->unsigned();

            $table->foreign('status_atual_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('status_proximo_id')->references('id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_status');
    }
};
