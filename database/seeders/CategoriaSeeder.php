<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
           [
               'nome'           =>      "Novidades"
           ] ,
            [
                'nome'          =>      "Consertos de Paineis"
            ]
        ]);

        DB::table('post_categoria')->insert([
            [
                'post_id'           =>  1,
                'categoria_id'      =>  1
            ],
            [
                'post_id'           =>  1,
                'categoria_id'      =>  2
            ],
        ]);
    }
}
