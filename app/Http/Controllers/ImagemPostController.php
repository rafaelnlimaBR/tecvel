<?php

namespace App\Http\Controllers;

use App\Models\Imagens;
use Illuminate\Http\Request;

class ImagemPostController extends Controller
{
    public function novo($id)
    {

        $dados      =  [
            "titulo"    => "Nova Imagem",
            "titulo_formulario" =>'Imagem ',
            'post'              => $id,
            "menu_open"     =>  "posts"
        ];

        return view('admin.posts.includes.form-imagem',$dados);

    }

    public function editar($id,$imagem_id)
    {

        $dados      =  [
            "titulo"    => "Editar Imagem",
            "titulo_formulario" =>'Imagem ',
            'post'              => $id,
            'imagem'            =>  Imagens::find($imagem_id),
            "menu_open"     =>  "posts"
        ];

        return view('admin.posts.includes.form-imagem',$dados);
    }

    public function cadastrar()
    {
        try {

            $validacao  =   Imagens::validacao(request()->all());


            if($validacao->fails()){
                return redirect()->route('post.imagem.novo',['id'=>\request('post_id')])->withErrors($validacao)->withInput();
            }

            $imag = new Imagens();
            $imag->salvar(\request());
            return redirect()->route('post.editar',['id'=>\request('post_id'),'tela'=>'imagens'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);

        }catch (\Exception $e){

            return redirect()->route('post.editar',['id'=>\request('post_id'),'tela'=>'imagens'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);


        }
    }

    public function atualizar()
    {
        try {

            $validacao  =   Imagens::validacao(request()->all());

            $imag = Imagens::find(\request('imagem_id'));
            if($validacao->fails()){
                return redirect()->route('post.imagem.editar',['id'=>\request('post_id'),'imagem_id'=>$imag->id])->withErrors($validacao)->withInput();
            }


            $imag->atualizar(\request());
            return redirect()->route('post.editar',['id'=>\request('post_id'),'tela'=>'imagens'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);

        }catch (\Exception $e){

            return redirect()->route('post.editar',['id'=>\request('post_id'),'tela'=>'imagens'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);


        }
    }

    public function excluir()
    {

        try {

            $imag = Imagens::find(\request('imagem_id'));
            $post_id        =   $imag->post_id;
            $imag->excluir(\request());
            return redirect()->route('post.editar',['id'=>$post_id,'tela'=>'imagens'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);

        }catch (\Exception $e){
            return redirect()->route('post.editar',['id'=>\request('post_id'),'tela'=>'imagens'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }
}
