<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_pagamentos')->insert([
            ['nome'      =>  'Pix'],
            ['nome'     =>  'Sumup'],
            ['nome'    =>  'Infinit-Pay'],

        ]);
    }
}
