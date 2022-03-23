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
        Schema::create('trabalhos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('data');
            $table->decimal('valor',8,2);
            $table->boolean('autorizado')->default(true);
            $table->bigInteger('historico_id')->unsigned();
            $table->integer('servico_id')->unsigned();

            $table->foreign('historico_id')->references('id')->on('historicos')->onDelete('cascade');
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabalhos');
    }
};
