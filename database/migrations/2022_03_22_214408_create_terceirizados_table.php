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
        Schema::create('terceirizados', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->text('servico');
            $table->text('obs')->nullable();
            $table->decimal('valor',8,2);
            $table->dateTime('data');
            $table->string('codigo')->nullable();
            $table->integer('fornecedor_id')->unsigned();
            $table->bigInteger('historico_id')->unsigned();

            $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('cascade');
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
        Schema::dropIfExists('terceirizados');
    }
};
