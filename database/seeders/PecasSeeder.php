<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PecasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pecas')->insert([
            [
                'valor'             =>  13.40,
                'descricao'         =>  'Lampada do painel',

            ],[
                'valor'             =>  7.90,
                'descricao'         =>  'Fita isolante',

            ],[
                'valor'             =>  90.00,
                'descricao'         =>  'Bobina de velocidade do painel Branca',

            ],[
                'valor'             =>  150.00,
                'descricao'         =>  'Bobina de velocidade do painel Metal',

            ]
        ]);

        DB::table('historico_peca')->insert([
            [
                'historico_id'=>1,
                'peca_id'       =>1,
                'autorizado'    =>1,
                'valor_fornecedor'=>12.00,
                'valor'=>12.00,
                'qnt'           =>3
                ],
            [
                'historico_id'=>1,
                'peca_id'       =>3,
                'autorizado'    =>  1,
                'valor_fornecedor'=>12.00,
                'valor'=>12.00,
                'qnt'           =>2
            ],
            [
                'historico_id'=>1,
                'peca_id'       =>3,
                'autorizado'    =>1,
                'valor_fornecedor'=>12.00,
                'valor'=>12.00,
                'qnt'           =>4
            ],
        ]);
    }
}
