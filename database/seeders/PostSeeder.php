<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'titulo'            =>  'teste',
            'conteudo'          =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.

Kucididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do

Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
            'data'              =>  Carbon::now(),
            'habilitado'        =>  1,
            'user_id'           =>  1
        ]);
        DB::table('comentarios')->insert([
            [
                'texto'         =>   "gostei do seruv awd ada klna knad la doaw adn admnadjn nfidghil nvsn safmn ndf jsnnnnkv n vns sj snf sf",
                'cliente_id'    =>   1,
                'post_id'       =>  1,
                'data'          =>  Carbon::now(),
                'habilitado'    =>  1
            ],
            [
                'texto'         =>   "gostei do seruv awd ada klna knad la doaw adn admnadjn nfidghil nvsn safmn ndf jsnnnnkv n vns sj snf sf",
                'cliente_id'    =>   1,
                'post_id'       =>  1,
                'data'          =>  Carbon::now(),
                'habilitado'    =>  1
            ],
            [
                'texto'         =>   "gostei do seruv awd ada klna knad la doaw adn admnadjn nfidghil nvsn safmn ndf jsnnnnkv n vns sj snf sf",
                'cliente_id'    =>   2,
                'post_id'       =>  1,
                'data'          =>  Carbon::now(),
                'habilitado'    =>  1
            ],
            [
                'texto'         =>   "gostei do seruv awd ada klna knad la doaw adn admnadjn nfidghil nvsn safmn ndf jsnnnnkv n vns sj snf sf",
                'cliente_id'    =>   8,
                'post_id'       =>  1,
                'data'          =>  Carbon::now(),
                'habilitado'    =>  1
            ],
            [
                'texto'         =>   "gostei do seruv awd ada klna knad la doaw adn admnadjn nfidghil nvsn safmn ndf jsnnnnkv n vns sj snf sf",
                'cliente_id'    =>   2,
                'post_id'       =>  1,
                'data'          =>  Carbon::now(),
                'habilitado'    =>  1
            ],
            [
                'texto'         =>   "gostei do seruv awd ada klna knad la doaw adn admnadjn nfidghil nvsn safmn ndf jsnnnnkv n vns sj snf sf",
                'cliente_id'    =>   5,
                'post_id'       =>  1,
                'data'          =>  Carbon::now(),
                'habilitado'    =>  1
            ],
        ]);

        DB::table('respostas_comentarios')->insert([
            ['texto'             =>  'awdkma dakçlmamkld ad ad adn jadnka dn ada çodk oç vjkl jvkn  vçna vnsakvnk',
                'data'              =>  Carbon::now(),
                'habilitado'        =>  1,
                'user_id'           =>  1,
                'comentario_id'     =>   2
            ],
            [
                'texto'             =>  'kw fmllç sk vsm,vvmkçl amnkl m kl',
                'data'              =>  Carbon::now(),
                'habilitado'        =>  1,
                'user_id'           =>  1,
                'comentario_id'     =>   2
            ],
            [
                'texto'             =>  'awda a awd abd bfg gh  rt',
                'data'              =>  Carbon::now(),
                'habilitado'        =>  1,
                'user_id'           =>  1,
                'comentario_id'     =>   3
            ]
        ]);

    }
}
