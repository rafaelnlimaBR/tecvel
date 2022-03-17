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
        Schema::create('telefones_apps', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer("telefone_id")->unsigned();
            $table->integer("app_id")->unsigned();

            $table->foreign("telefone_id")
                ->references("id")
                ->on("telefones")
                ->onDelete("cascade");
            $table->foreign('app_id')
                ->references("id")
                ->on("aplicativo_mensagens")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefones_apps');
    }
};
