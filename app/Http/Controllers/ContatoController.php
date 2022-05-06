<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index(Request $r)
    {
        $contatos = Contato::all();
        $dados      =  [
            "titulo"    => "Contatos de Visitantes do Site",
            "titulo_tabela" => "Lista de Contatos"
        ];

        return view('admin.contatos.index',$dados)->with('contatos',$contatos);
    }

    public function visualizar($id)
    {
        $contato    =   Contato::find($id);
        $contato->visualizar();
        $dados      =  [
            "titulo"    => "Contatos de Visitantes do Site",
            "titulo_formulario" => "Visualização do Contato",
            "whatsapp"          =>  str_replace(')','',str_replace('(','',$contato->cliente->telefone01)),
            "msg_whatsapp"      =>
                "Olá, você entrou em contato através do nosso site.\nData e Hora: ".date('d/m/Y H:m', strtotime($contato->created_at))."\nMensagem: ".$contato->mensagem
        ];



        return view('admin.contatos.formulario',$dados)->with('contato',$contato);
    }

    public function excluir()
    {
        try{
            $contato    =   Contato::find(\request()->get('id'));
            $contato->excluir(\request());
            return redirect()->route('contato.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contato.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
