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
        ];

        return view('admin.trabalhos.index',$dados)->with('contrato',$contrato);
    }
    
}
