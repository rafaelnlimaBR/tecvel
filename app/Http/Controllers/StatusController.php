<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $r)
    {
        $status = Status::pesquisarPorDescricao($r->input('nome'))
            ->orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Status",
            "titulo_tabela" => "Lista de Status"
        ];

        return view('admin.status.index',$dados)->with('status',$status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Veículo",
            "titulo_formulario" =>'Novo'
        ];

        return view('admin.status.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $id = Status::gravar(\request());
            return redirect()->route('status.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('status.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Status",
            "titulo_formulario" =>'Editar'
        ];
       $todosStatusHabilitados = Status::PesquisarPorHabilitados();

        $Status    =   Status::find($id);


        return view('admin.status.formulario',$dados)->with('status',$Status)->with('todos',$todosStatusHabilitados);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Status::atualizar(\request());
            return redirect()->route('status.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('status.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Status::excluir(\request()->get('id'));
            return redirect()->route('status.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('status.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function adicionarStatus()
    {
        try{

            Status::adicionarRelacionamento(\request());
            return redirect()->route('status.editar',\request()->get('status_atual_id'))->with('alerta',['tipo'=>'success','msg'=>"Vingulado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('status.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
