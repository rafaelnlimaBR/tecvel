<?php

namespace App\Http\Controllers;

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
        

        return view('site.posts.posts');
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
            return redirect()->route('posts');
        }


        $dados  =   [
            "titulo"        =>  "Tecvel - Postagens",
            "post"          =>  $post,
            'dados'         =>  Configuracao::find(1)
        ];
        return view('site.posts.post',$dados);
    }
}
