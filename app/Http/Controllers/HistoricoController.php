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
            return redirect()->route('contrato.editar',['id'=>\request()->get('contrato_id'),'historico_id'=>$historico->id])
                ->with('active','servicos')
                ->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
