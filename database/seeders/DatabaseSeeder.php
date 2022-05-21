<?php

namespace Database\Seeders;

use App\Models\Comentario;
use App\Models\Pedido;
use App\Models\Taxa;
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
            UsuarioSeeder::class,
            ConfiguracaoSeeder::class,
//            ComentarioSeeder::class,
//            ClienteSeeder::class,
//            VeiculoSeeder::class,
//            ServicoSeeder::class,
            StatusSeeder::class,
//            FornecedorSeeder::class,
//            ContratoSeeder::class,
            TipoSeeder::class,
//            HistoricoSeeder::class,
//            PedidoSeeder::class,


//            TerceirizadosSeeder::class,
//            PecasSeeder::class,
//            TrabalhoSeeder::class,
            TipoPagamentosSeeder::class,
            TaxaSeeder::class,
//            SaidaSeeder::class,

//            PostSeeder::class,
//            CategoriaSeeder::class,
            AvaliacaoSeeder::class
        ]);
    }
}
