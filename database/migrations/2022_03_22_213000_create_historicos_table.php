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
        Schema::create('historicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('contrato_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->dateTime('data');
            $table->text('obs');
            $table->boolean('autorizado')->default(true);
            $table->integer('desconto_peca');
            $table->integer('desconto_servico');

            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historicos');
    }
};
