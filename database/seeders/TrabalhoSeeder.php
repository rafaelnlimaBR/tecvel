<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrabalhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trabalhos')->insert([
           [
               'data'           =>  Carbon::now(),
               'valor'          =>  150.00,
               'autorizado'     =>  true,
               'historico_id'   =>  1,
               'servico_id'     =>  1
           ],[
                'data'           =>  Carbon::now(),
                'valor'          =>  95.00,
                'autorizado'     =>  true,
                'historico_id'   =>  1,
                'servico_id'     =>  1
            ]
        ]);
    }
}
