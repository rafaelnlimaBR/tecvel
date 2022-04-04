<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taxas')->insert([
           [
               'nome'          =>      "CNPJ",
               'taxa'           =>      0.00,
               'tipo_id'        =>      1
           ],
            [
                'nome'          =>      "Celular",
                'taxa'           =>      0.00,
                'tipo_id'        =>      1
            ],
            [
                'nome'          =>      "Débito",
                'taxa'           =>      2.65,
                'tipo_id'        =>      2
            ],
            [
                'nome'          =>      "Crédito avista",
                'taxa'           =>      3.65,
                'tipo_id'        =>      2
            ],
            [
                'nome'          =>      "Crédito 2 Vezes",
                'taxa'           =>      3.99,
                'tipo_id'        =>      2
            ],
            [
                'nome'          =>      "Crédito 3 Vezes",
                'taxa'           =>      4.99,
                'tipo_id'        =>      2
            ],
            [
                'nome'          =>      "Débito",
                'taxa'           =>      1.44,
                'tipo_id'        =>      3
            ],
            [
                'nome'          =>      "Crédito avista",
                'taxa'           =>      2.89,
                'tipo_id'        =>      3
            ],
            [
                'nome'          =>      "Crédito 2 Vezes",
                'taxa'           =>      4.44,
                'tipo_id'        =>      3
            ],
            [
                'nome'          =>      "Crédito 3 Vezes",
                'taxa'           =>      5.05,
                'tipo_id'        =>      3
            ],

        ]);
    }
}
