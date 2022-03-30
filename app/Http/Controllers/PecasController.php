<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Peca;
use Illuminate\Http\Request;

class PecasController extends Controller
{
    public  function cadastrar()
    {
        try{
            $historico      =   Historico::find(\request()->get('historico_id'));
            if($historico == null){
                return response()->json(['erro'=>"historico null"]);
            }

            $peca   =   Peca::cadastrar(\request());

            return response()->json(['html'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->render()]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    public function excluir()
    {
        try{
            $historico          =   Historico::find(\request()->get('historico'));
            $peca           =   Peca::find(\request()->get('peca'));
            if($peca == null){
                return response()->json(["erro"=>"Historico null"]);
            }
            $peca->excluir(\request()->get('peca'));

            return response()->json(['html'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->render()]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }
}
