<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Cadastrando fornecedores');
        DB::table('fornecedores')->insert([
           [
               'nome'       =>  'Tecnovel',
               'endereco' =>  'Rua J. da Penha, 4423',
               'telefone01' =>  '8532256135',
               'telefone02' =>  '85988554223',
               'desconto'   =>  0.00,
               'created_at' =>  Carbon::now(),
               'updated_at' =>  Carbon::now()
           ],[
               'nome'       =>  'Placnort',
               'endereco' =>  'Av. dos Expedicionários, 221',
               'telefone01' =>  '8532256135',
               'telefone02' =>  '85988554223',
                'desconto'   =>  10.00,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
           ],
        ]);
    }
}
