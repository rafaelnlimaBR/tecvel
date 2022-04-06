<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('saidas')->insert([
           ['descricao'=>"Pagamento do pedido 55",'valor'=>50.00],
           ['descricao'=>"Pagamento do pedido 55",'valor'=>20.00],
        ]);
        DB::table('saida_pedido')->insert([
            ['pedido_id'=>1,'saida_id'=>1],
            ['pedido_id'=>1,'saida_id'=>2],
        ]);
    }
}
