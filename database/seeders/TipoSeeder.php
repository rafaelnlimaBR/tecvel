<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_contratos')->insert([
           [
               'descricao'=>'Orcamento',
               'autorizado'=>   false
           ],[
                'descricao'=>'Ordem de Serviço',
                'autorizado'=>   true
            ]
        ]);
    }
}
