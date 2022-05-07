<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Historico;
use App\Models\Trabalho;
use Illuminate\Http\Request;

class TrabalhoController extends Controller
{
    public function index($id,$historico_id)
    {

//        $trabalhos      =   Trabalho::all();
       $contrato           = Contrato::find($id);
        $dados      =  [
            "titulo"    => "Servicos Realizados",
            "titulo_tabela" => "Lista de servicos",
            "contrato_id"   =>  $id,
            "historico_id"  =>  $historico_id,
            "menu_open"     =>  "contratos"
        ];

        return view('admin.trabalhos.index',$dados)->with('contrato',$contrato);
    }

    public function cadastrar()
    {
        try{
            $historico      =   Historico::find(\request()->get('historico_id'));
            if($historico == null){
                return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','msg'=>"Hitorico não encontrato",'icon'=>'check','titulo'=>"Sucesso"]);
            }
//            dd(\request()->all());
            $historico->cadastrarServico(\request());

            return response()->json(['html'=>view('admin.contratos.includes.tabelaServicos')->with('historico',$historico)->render()]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    public function excluir()
    {
        try{
            $historico          =   Historico::find(\request()->get('historico'));
            $trabalho           =   Trabalho::find(\request()->get('trabalho'));
            if($trabalho == null){
                return response()->json(["erro"=>"Historico null"]);
            }
            $trabalho->excluir(\request()->get('trabalho'));

            return response()->json(['html'=>view('admin.contratos.includes.tabelaServicos')->with('historico',$historico)->render()]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }
}
