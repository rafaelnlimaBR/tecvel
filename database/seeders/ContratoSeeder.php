<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contratos')->insert([
           [
               'cliente_id'     =>  1,
               'veiculo_id'     =>  2,
               'obs'            =>  'observações',
               'defeito'        =>  "defeitos",
               'data'           =>  Carbon::now(),
               'garantia'       =>  90,
               'created_at'     =>  Carbon::now(),
               'updated_at'     =>  Carbon::now(),
           ],[
                'cliente_id'     =>  2,
                'veiculo_id'     =>  1,
                'obs'            =>  'observações 2',
                'defeito'        =>  "defeitos 2",
                'garantia'       =>  30,
                'data'           =>  Carbon::now(),
                'created_at'     =>  Carbon::now(),
                'updated_at'     =>  Carbon::now(),
            ],
        ]);
    }
}
