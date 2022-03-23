<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("cadastrando pedidos de teste");
        DB::table('pedidos')->insert([
           [
               'numero_pedido'      =>      "50332321",
               'fornecedor_id'      =>      1,
               'data'               =>      Carbon::now()
           ]
        ]);
    }
}
