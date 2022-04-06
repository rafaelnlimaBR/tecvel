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
        Schema::create('historico_peca', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->timestamps();
            $table->bigInteger('historico_id')->unsigned();
            $table->integer('peca_id')->unsigned();
            $table->boolean('autorizado')->default(1);
            $table->integer('qnt')->default(1);
            $table->integer('pedido_id')->unsigned()->nullable()->default(null);
            $table->decimal('valor_fornecedor',8,2)->nullable();
            $table->decimal('valor',8,2)->nullable();

            $table->foreign('historico_id')->references('id')->on('historicos')->onDelete('cascade');
            $table->foreign('peca_id')->references('id')->on('pecas')->onDelete('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_peca');
    }
};
