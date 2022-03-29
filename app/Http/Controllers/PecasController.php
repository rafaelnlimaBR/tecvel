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
}
