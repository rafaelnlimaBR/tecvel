<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{

    public function cadastrarServico()
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

}
