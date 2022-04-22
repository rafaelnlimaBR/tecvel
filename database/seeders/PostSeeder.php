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
            'conteudo'          =>  'dawd awd awdawdo awdn çlawd awd',
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

    }
}
