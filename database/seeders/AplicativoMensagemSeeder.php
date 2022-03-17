<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AplicativoMensagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aplicativo_mensagens')->insert([
            'nome' => "Whatsapp",
            'link' => "https://wa.me/",
            'habilitado'    =>  true,
            'icon'          =>  'fa fa-whatsapp',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'nome' => "Telegran",
            'link' => "https://wa.me/",
            'habilitado'    =>  true,
            'icon'          =>  'fa fa-telegram',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
