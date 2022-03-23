<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historicos')->insert([
            [
                'contrato_id'           =>  1,
                'status_id'             =>  1,
                'data'                  =>  Carbon::now(),
                'obs'                   =>  "Reparo realizado com sucesso",
                'autorizado'            =>  true,
                'desconto_peca'         =>  10,
                'desconto_servico'      =>  10
            ],[
                'contrato_id'           =>  2,
                'status_id'             =>  4,
                'data'                  =>  Carbon::now(),
                'obs'                   =>  "Testado",
                'autorizado'            =>  true,
                'desconto_peca'         =>  5,
                'desconto_servico'      =>  5
            ]
        ]);
    }
}
