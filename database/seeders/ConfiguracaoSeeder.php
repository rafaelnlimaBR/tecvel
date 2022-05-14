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
            'link_avaliacao'    =>  "https://www.google.com/search?q=tecvel+fortaleza&rlz=1C1CHBD_pt-PTBR916BR916&oq=tecvel+fortaleza&aqs=chrome..69i57j46i175i199i512j69i60.2520j0j7&sourceid=chrome&ie=UTF-8#lrd=0x7c748571eaff129:0x9b9fca91feddd3d4,1,,,"
        ]);
    }
}
