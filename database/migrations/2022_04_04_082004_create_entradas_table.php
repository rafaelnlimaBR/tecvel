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
        Schema::create('entradas', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->dateTime('data');
            $table->string('descricao');
            $table->decimal('valor',8,2);
            $table->decimal('valor_total',8,2);
            $table->integer('taxa_id')->unsigned();

            $table->foreign('taxa_id')->references('id')->on('taxas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas');
    }
};
