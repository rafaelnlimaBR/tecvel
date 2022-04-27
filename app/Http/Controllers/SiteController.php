<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
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
            "posts"         =>  Post::orderBy('data', 'desc'),
            'dados'         =>  Configuracao::find(1),
            'categorias'    =>  Categoria::all(),
            'postagem_recentes' =>  Post::orderBy('data','desc')->take(3)->get()
        ];
        return view('site.posts.includes.todas-postagens',$dados);
    }

    public function post($id,$titulo)
    {
        $post   =   Post::find($id);
        if($post == null){
            return redirect()->route('site.posts');
        }else{
            $post->adicionarVisita();
        }


        $dados  =   [
            "titulo"        =>  "Tecvel - Postagens",
            "post"          =>  $post,
            "posts"         =>  Post::orderBy('data', 'desc'),
            'dados'         =>  Configuracao::find(1),
            'categorias'    =>  Categoria::all(),
            'postagem_recentes' =>  Post::orderBy('data','desc')->take(3)->get()
            ];
        return view('site.posts.includes.postagem',$dados);
    }

    public function comentar()
    {
        $postagem   =   0;
        try{
            $postagem       =   Post::find(\request('post_id'));

            $id = Comentario::gravar(\request());
            return response()->json(['comentarios'=>view('site.posts.includes.comentarios')->with('dados', Configuracao::find(1))->with('post',$postagem)->with('alerta',['Comentário adicionado com sucesso'])->render()]);
        }catch (\Exception $e){
            return response()->json(['erro'=>'Error: '.$e->getMessage()]);
        }
    }
}
