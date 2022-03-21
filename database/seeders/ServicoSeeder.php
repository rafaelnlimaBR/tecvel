<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicos')->insert([
                ['descricao' => "Conserto do display",
                    'valor' => 150.00]
                ,['descricao' => "Troca da malha do display",
                    'valor' => 150.00]
                ,['descricao' => "Conserto da placa",
                    'valor' => 350.00]
                ,
                ['descricao' => "Troca dos leds de iluminação",
                    'valor' => 190.00]
                ,
            ]
        );
    }
}
