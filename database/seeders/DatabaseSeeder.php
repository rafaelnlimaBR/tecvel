<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ConfiguracaoSeeder::class,
            ClienteSeeder::class,
            VeiculoSeeder::class,
            ServicoSeeder::class,
            StatusSeeder::class,
            FornecedorSeeder::class,
            ContratoSeeder::class,
            TipoSeeder::class,
            HistoricoSeeder::class,
            PedidoSeeder::class,


            TerceirizadosSeeder::class,
            PecasSeeder::class,
            TrabalhoSeeder::class,
        ]);
    }
}
