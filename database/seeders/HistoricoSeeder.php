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
                'tipo_id'               =>  2,

            ],[
                'contrato_id'           =>  2,
                'status_id'             =>  4,
                'data'                  =>  Carbon::now(),
                'obs'                   =>  "Testado",
                'tipo_id'               =>  2,

            ]
        ]);
    }
}
