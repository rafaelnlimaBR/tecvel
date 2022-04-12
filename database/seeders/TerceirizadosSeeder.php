<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerceirizadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terceirizados')->insert([
            [
                'servico'           =>  'Reparo no modulo',
                'valor'             =>  340.00,
                'data'              =>  Carbon::now(),
                'codigo'       =>  '2324343434',
                'fornecedor_id'     =>  1,
                'historico_id'      =>  1
            ]
        ]);
    }
}
