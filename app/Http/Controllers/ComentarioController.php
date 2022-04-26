<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\RespostasComentarios;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function editar($id)
    {

        $comentario     =   Comentario::find($id);
        if($comentario  == null){
            return redirect()->route('post.index');
        }
        $dados      =  [
            "titulo"    => "Comentário",
            "titulo_formulario" =>'Responder Comentário',
            "titulo_formulario_segundario"  =>  "Respostas"

        ];
        return view('admin.comentarios.formulario',$dados)->with('comentario',$comentario);

    }

    public function atualizar()
    {

        try{
            $comentario   =   Comentario::find(\request('id'));
            $comentario->atualizar(\request());

            return redirect()->route('comentario.editar',['id'=>$comentario->id])->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('comentario.editar',['id'=>$comentario->id])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }




}
