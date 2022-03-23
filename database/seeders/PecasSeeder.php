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
                'qnt'               =>  5,
                'pedido_id'         =>  1,
                'historico_id'      =>  1,
                'autorizado'        =>  true
            ],[
                'valor'             =>  7.90,
                'descricao'         =>  'Fita isolante',
                'qnt'               =>  5,
                'pedido_id'         =>  1,
                'historico_id'      =>  1,
                'autorizado'        =>  true
            ],[
                'valor'             =>  90.00,
                'descricao'         =>  'Bobina de velocidade do painel Branca',
                'qnt'               =>  5,
                'pedido_id'         =>  1,
                'historico_id'      =>  1,
                'autorizado'        =>  true
            ],[
                'valor'             =>  150.00,
                'descricao'         =>  'Bobina de velocidade do painel Metal',
                'qnt'               =>  5,
                'pedido_id'         =>  1,
                'historico_id'      =>  1,
                'autorizado'        =>  true
            ]
        ]);
    }
}
