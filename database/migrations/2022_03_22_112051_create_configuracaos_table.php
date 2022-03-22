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
        Schema::create('configuracao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_empresa');
            $table->string('cnpj');
            $table->string('endereco');
            $table->string('telefone_fixo');
            $table->string('telefone_movel');
            $table->string('email');
            $table->string('logo');
            $table->integer('orcamento')->nullable();
            $table->integer('ordem_servico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracao');
    }
};
