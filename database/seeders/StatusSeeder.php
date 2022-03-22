<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Criando status");
        DB:: table('status')->insert([
            [
                'nome'      =>  'Aberto',
                'cor'       =>  '#3CB371',
                'orcamento' => false,
                'habilitado' =>     true
            ],[
                'nome'      =>  'Concluido',
                'cor'       =>  '#008B8B',
                'orcamento' => false,
                'habilitado' =>     true
            ],[
                'nome'      =>  'Não autorizado',
                'cor'       =>  '#FFA500',
                'orcamento' => false,
                'habilitado' =>     true
            ],[
                'nome'      =>  'Retorno',
                'cor'       =>  '#4F4F4F',
                'orcamento' => false,
                'habilitado' =>     true
            ]
            ,[
                'nome'      =>  'Orçamento',
                'cor'       =>  '#4F4F4F',
                'orcamento' => true,
                'habilitado' =>     true
            ],
            [
                'nome'      =>  'Autorizado',
                'cor'       =>  '#4F4F4F',
                'orcamento' => false,
                'habilitado' =>     true
            ]

        ]);
        $this->command->info('inserindo configuração dos status');
        DB::table('status_status')->insert([
           [
               'status_atual_id'        =>  1,
               'status_proximo_id'      =>  5
           ],
           [
                'status_atual_id'        =>  1,
                'status_proximo_id'      =>  2,
            ],
            [
                'status_atual_id'        =>  2,
                'status_proximo_id'      =>  4
            ],
            [
                'status_atual_id'        =>  3,
                'status_proximo_id'      =>  2
            ],
            [
                'status_atual_id'        =>  4,
                'status_proximo_id'      =>  2
            ],
            [
                'status_atual_id'        =>  5,
                'status_proximo_id'      =>  6
            ],
            [
                'status_atual_id'        =>  6,
                'status_proximo_id'      =>  2
            ],
        ]);
    }
}