<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Post;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $r)
    {
        $posts = Post::all();
        $dados      =  [
            "titulo"    => "Posts",
            "titulo_tabela" => "Lista de Postagens",
            'modal'         =>  0
        ];

        return view('admin.posts.index',$dados)->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Postagens",
            "titulo_formulario" =>'Novo',
            "usuarios"          =>  User::all(),
            "categorias"        =>  Categoria::all(),
            "tags"              =>  Tags::all()
        ];

        return view('admin.posts.formulario',$dados);

    }

    public function cadastrar()
    {
        try {
            $validacao  =   Post::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('post.novo')->withErrors($validacao)->withInput();
            }

            $post = new Post();
            $post->gravar(\request());
            return redirect()->route('post.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);

        }catch (\Exception $e){

            return redirect()->route('post.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);


        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Post",
            "titulo_formulario" =>'Editar',
            'usuarios'          => User::all(),
            "categorias"        =>  Categoria::all(),
            "tags"              =>  Tags::all()

        ];
        $Post    =   Post::find($id);


        return view('admin.posts.formulario',$dados)->with('post',$Post);
    }

    public function atualizar()
    {


        try{
            $post   =   Post::find(\request('id'));
            $post->atualizar(\request());

            return redirect()->route('post.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('post.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $post = Post::find(\request()->get('id'));
            $post->excluir();
            return redirect()->route('post.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('post.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
