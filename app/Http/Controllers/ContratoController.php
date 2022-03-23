<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index()
    {

        $contratos = Contrato::orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Contratos",
            "titulo_tabela" => "Lista de Contratos"
        ];

        return view('admin.contratos.index',$dados)->with('contratos',$contratos);

    }

    public function novo()
    {

        $dados      =  [
            "titulo"    => "Contrato",
            "titulo_formulario" =>'Novo'
        ];
        return view('admin.contratos.formulario',$dados);

    }

    public function orcamento()
    {
        return "deu";
    }

    public function cadastrar()
    {
        try{
            $id = Contrato::gravar(\request());
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Contrato",
            "titulo_formulario" =>'Editar'
        ];
        $contrato    =   Contrato::find($id);


        return view('admin.contratos.formulario',$dados)->with('contrato',$contrato);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Contrato::atualizar(\request());
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Contrato::excluir(\request()->get('id'));
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
