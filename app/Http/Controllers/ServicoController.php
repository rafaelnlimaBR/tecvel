<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index(Request $r)
    {
        $servicos = Servico::pesquisarPorDescricao($r->input('descricao'))
            ->orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Servicos",
            "titulo_tabela" => "Lista de Servicos"
        ];

        return view('admin.servicos.index',$dados)->with('servicos',$servicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Servico",
            "titulo_formulario" =>'Novo'
        ];
        return view('admin.servicos.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $id = Servico::gravar(\request());
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('servico.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Servico",
            "titulo_formulario" =>'Editar'
        ];
        $servico    =   Servico::find($id);


        return view('admin.servicos.formulario',$dados)->with('servico',$servico);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Servico::atualizar(\request());
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Servico::excluir(\request()->get('id'));
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('servico.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }


}
