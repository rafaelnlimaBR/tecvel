<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Configuracao;
use App\Models\Post;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function __construct()
    {

    }

    public function home()
    {

        $dados  =   [
            "titulo"        =>  "Tecvel - Eletrônica Automotiva",
            "posts"         =>  Post::all(),
            'dados'         =>  Configuracao::find(1)
        ];
        return view('site.home',$dados);
    }

    public function posts()
    {
        $dados  =   [
            "titulo"        =>  "Tecvel - Postagens",
            "posts"         =>  Post::all(),
            'dados'         =>  Configuracao::find(1)
        ];
        return view('site.posts.posts',$dados);
    }

    public function post($id,$titulo)
    {
        $post   =   Post::find($id);
        if($post == null){
            return redirect()->route('site.posts');
        }


        $dados  =   [
            "titulo"        =>  "Tecvel - Postagens",
            "post"          =>  $post,
            'dados'         =>  Configuracao::find(1)
        ];
        return view('site.posts.post',$dados);
    }

    public function comentar()
    {
        $postagem   =   0;
        try{
            $postagem       =   Post::find(\request('post_id'));

            $id = Comentario::gravar(\request());
            return response()->json(['comentarios'=>view('site.posts.comentarios')->with('dados', Configuracao::find(1))->with('post',$postagem)->with('alerta',['Comentário adicionado com sucesso'])->render()]);
        }catch (\Exception $e){
            return response()->json(['erro'=>'Error: '.$e->getMessage()]);
        }
    }
}
