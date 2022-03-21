<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->command->info("Criando veiculos");

        DB::table('veiculos')->insert([
            ['placa' => "HUI3024",
            'modelo' => "Gol ",
            'montadora' =>"VW",
            'mod_ano' =>"94/94",
            'cor'   =>  'branco'],
            [
                'placa' => "PCN7081",
                'modelo' => "Classic",
                'montadora' =>"GM",
                'mod_ano' =>"14/15",
                'cor'   =>  'Preto'
            ]
        ]
            );


    }
}
