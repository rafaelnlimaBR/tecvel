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
            $table->text('descricao')->nullable();
            $table->text('tags')->nullable();
            $table->string('email');
            $table->string('logo');
            $table->string('instagran');
            $table->string('facebook');
            $table->string('link_avaliacao')->nullable();
            $table->integer('orcamento')->nullable();
            $table->integer('ordem_servico')->nullable();
            $table->integer('aberto')->nullable();
            $table->integer('concluido')->nullable();
            $table->integer('retorno')->nullable();
            $table->integer('nao_autorizado')->nullable();
            $table->integer('autorizado')->nullable();
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
