<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracaoSeeder extends Seeder
{
/*$table->string('nome_empresa');
$table->string('cnpj');
$table->string('endereço');
$table->string('telefone_fixo');
$table->string('telefone_movel');
$table->string('email');
$table->string('logo');
$table->integer('orcamento')->nullable();
$table->integer('ordem_servico')->nullable();*/
    public function run()
    {
        DB::table('configuracao')->insert([
            'nome_empresa'      =>  "Tecvel - Eletrônica Automotiva",
            'cnpj'              =>  "28.727.291/0001-33",
            'endereco'          =>  'Rua Pinto Madeira, 750, Centro - Fortaleza/CE',
            'telefone_fixo'     =>  '8534921856',
            'telefone_movel'    =>  '85981067785',
            'email'             =>  'rafael@tecvelautomotiva.com.br',
            'logo'              =>  'logo.jpeg',
            'instagran'              =>  'https://www.instagram.com/tecvel/',
            'facebook'              =>  'https://www.facebook.com/Tecvel',
            'orcamento'         =>  1,
            'ordem_servico'     =>  2,
            'aberto'                =>  1,
            'concluido'             =>  2,
            'nao_autorizado'        =>  3,
            'retorno'               =>  4,
            'autorizado'            =>  5,
        ]);
    }
}
