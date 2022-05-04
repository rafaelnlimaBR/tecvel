<?php

namespace App\Http\Controllers;

use App\Mail\NotificacaoComentario;
use App\Models\Avaliacao;
use App\Models\Banner;
use App\Models\Categoria;
use App\Models\Comentario;
use App\Models\Configuracao;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{

    public function __construct()
    {

    }

    public function home()
    {

        return view('welcome');
        $dados  =   [
            "titulo"        =>  "Tecvel - Eletrônica Automotiva",
            "posts"         =>  Post::all(),
            'dados'         =>  Configuracao::find(1),
            'active'        =>  'inicio',
            'banners'        =>  Banner::habilitados(1)->Sequenciadas('asc')->get(),
            'avaliacoes'    =>  Avaliacao::habilitados(1)->Sequenciadas('asc')->get()
        ];
        return view('site.inicio.inicio',$dados);
    }

    public function posts()
    {
        $conf   =   Configuracao::find(1);
        $dados  =   [
            "titulo"        =>  "Tecvel - Postagens",
            "posts"         =>  Post::habilitados(1)->orderBy('data', 'desc'),
            'dados'         =>  $conf,
            'categorias'    =>  Categoria::all(),
            'postagem_recentes' =>  Post::orderBy('data','desc')->take(3)->get(),
            'postagems_mais'    =>  Post::orderBy('visitas','desc')->take(5)->get(),
            'active'            =>  'post',

        ];
        return view('site.posts.includes.todas-postagens',$dados);
    }

    public function post($titulo,$id)
    {
        $post   =   Post::find($id);
        if($post == null){
            return redirect()->route('site.postagens');
        }else{
            $post->adicionarVisita();
        }


        $dados  =   [
            "titulo"        =>  "Tecvel - ".$post->titulo,
            "post"          =>  $post,
            "posts"         =>  Post::orderBy('data', 'desc'),
            'dados'         =>  Configuracao::find(1),
            'categorias'    =>  Categoria::all(),
            'postagem_recentes' =>  Post::orderBy('data','desc')->take(3)->get(),
            'postagems_mais'    =>  Post::orderBy('visitas','desc')->take(5)->get(),
            'meta_tags'         =>  $post->tagsSeparadoPorVirtula(),
            'meta_description'  =>  $post->descricao,
            'active'            =>  'post'
            ];
        return view('site.posts.includes.postagem',$dados);
    }

    public function comentar()
    {
        $conf   =   Configuracao::find(1);
        try{
            $validacao  =   Comentario::validacao(request()->all());

            $postagem       =   Post::find(\request('post_id'));

            if($validacao->fails()){
                return response()->json(['comentarios'=>view('site.posts.includes.comentarios')->with('alerta',['tipo'=>'erro','mensagem'=>'Preencha os camos obrigatórios'])->with('dados',$conf)->with('post',$postagem)->withErrors($validacao)->render()]);
            }

            $comentario = Comentario::gravar(\request());
            Mail::send(new NotificacaoComentario($comentario,$conf->email));
            return response()->json(['comentarios'=>view('site.posts.includes.comentarios')->with('dados', $conf)->with('post',$postagem)->with('alerta',['Comentário adicionado com sucesso'])->render()]);
        }catch (\Exception $e){
            return response()->json(
                [
                    'comentarios'=>view('site.posts.includes.comentarios')->with('dados', $conf)->with('post',$postagem)->with('alerta',['tipo'=>'erro','mensagem'=>'Houve algum erro ao comentar esse post, favor informar nesse numero : '.$conf->telefone_movel])->render(),
                    'erro'      =>  $e->getMessage()
                ]);
        }
    }

    public function categoria($nome,$id)
    {
        $categoria   =   Categoria::find($id);

        if($categoria == null){
            return redirect()->route('site.postagens');
        }
        $dados  =   [
            "titulo"        =>  "Tecvel - ".$categoria->nome,
            "posts"         =>  $categoria->posts(),
            'dados'         =>  Configuracao::find(1),
            'categorias'    =>  Categoria::all(),
            'postagem_recentes' =>  Post::orderBy('data','desc')->take(3)->get(),
            'postagems_mais'    =>  Post::orderBy('visitas','desc')->take(5)->get()
        ];
        return view('site.posts.includes.todas-postagens',$dados);

    }
}
