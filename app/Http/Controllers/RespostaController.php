<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\RespostasComentarios;
use App\Models\User;
use Illuminate\Http\Request;

class RespostaController extends Controller
{
    public function novo($id)
    {
        $comentario     =   Comentario::find($id);
        if($comentario  == null){
            return redirect()->route('post.index');
        }
        $dados      =  [
            "titulo"    => "Respota",
            "titulo_formulario" =>'Nova Resposta',
            "usuarios"          =>  User::all(),
            "menu_open"     =>  "site"

        ];
        return view('admin.comentarios.includes.form-responder',$dados)->with('comentario',$comentario);
    }

    public function gravar()
    {
        try{
            $validacao  =   RespostasComentarios::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('comentario.editar.responder',['id'=>request()->get('comentario_id')])->withErrors($validacao)->withInput();
            }

            $resposta           =   new RespostasComentarios();

            $resposta->gravar(\request());

            return redirect()->route('comentario.editar.responder',['id'=>request()->get('comentario_id')])->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('comentario.editar.responder',['id'=>request()->get('comentario_id')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function atualizar()
    {
        try{
            $validacao  =   RespostasComentarios::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('comentario.responder.editar',['id'=>request()->get('comentario_id'),'resposta_id'=>\request('id')])->withErrors($validacao)->withInput();
            }

            $resposta           =   RespostasComentarios::find(\request('id'));

            $resposta->atualizar(\request());

            return redirect()->route('comentario.responder.editar',['id'=>request()->get('comentario_id'),'resposta_id'=>\request('id')])->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('comentario.responder.editar',['id'=>request()->get('comentario_id'),'resposta_id'=>\request('id')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function editar($id,$resposta_id)
    {
        $comentario     =   Comentario::find($id);
        $resposta      =   RespostasComentarios::find($resposta_id);
        if($comentario  == null or $resposta == null){
            return redirect()->route('post.index');
        }
        $dados      =  [
            "titulo"    => "Respota",
            "titulo_formulario" =>'Editar Resposta',
            "usuarios"          =>  User::all(),
            'comentario'        =>  $comentario,
            "menu_open"     =>  "site"

        ];
        return view('admin.comentarios.includes.form-responder',$dados)->with('resposta',$resposta);
    }

    public function excluir()
    {
        try{

            $resposta           =   RespostasComentarios::find(\request('id'));

            $resposta->excluir(\request());

            return redirect()->route('comentario.editar',['id'=>request()->get('comentario_id')])->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('comentario.editar',['id'=>request()->get('comentario_id')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
