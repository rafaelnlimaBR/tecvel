<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Fornecedor;
use App\Models\Status;
use App\Models\TipoContrato;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use function Symfony\Component\HttpFoundation\File\getErrorMessage;

class ConfiguracaoController extends Controller
{
    public function editar()
    {
        $configuracao   =   Configuracao::all()->first();
//        return $configuracao;
        $dados      =  [
            "titulo"    => "Configuração",
            'titulo_formulario' => 'Alterar configuração',
            'status'            => Status::PesquisarPorHabilitados(),
            'tipos'             =>  TipoContrato::all(),
            "menu_open"     =>  "configuracoes"
        ];

        return view('admin.configuracao.formulario',$dados)->with('conf',$configuracao);
    }

    public function atualizar()
    {

//        dd(\request()->file('logo_empresa')->getClientOriginalName());
        try{


//            return request();
            Configuracao::atualizar(\request());
            return redirect()->route('configuracao.editar')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('configuracao.editar')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
