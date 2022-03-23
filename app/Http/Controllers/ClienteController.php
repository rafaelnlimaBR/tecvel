<?php

namespace App\Http\Controllers;

use App\Models\AplicativoMensagem;
use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $clientes = Cliente::pesquisarPorNome($r->input('nome'))
            ->pesquisarPorEmail($r->input('email'))
            ->orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Clientes",
            "titulo_tabela" => "Lista de Clientes"
        ];

        return view('admin.clientes.index',$dados)->with('clientes',$clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Cliente",
            "titulo_formulario" =>'Novo'
        ];
        return view('admin.clientes.formulario',$dados);

    }

    public function cadastrar()
    {
        try{

            $id = Cliente::gravar(\request());
            if(\request()->get('modal') == 1){
                return redirect()->back()->with('alerta',['tipo'=>'success','msg'=>"Cliente cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
            }else{
                return redirect()->route('cliente.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
            }

        }catch (\Exception $e){
            return redirect()->route('cliente.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Cliente",
            "titulo_formulario" =>'Editar'
        ];
        $cliente    =   Cliente::find($id);


        return view('admin.clientes.formulario',$dados)->with('cliente',$cliente);
    }

    public function atualizar()
    {
        try{
//            return request();
                $id = Cliente::atualizar(\request());

            return redirect()->route('cliente.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('cliente.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Cliente::excluir(\request()->get('id'));
            return redirect()->route('cliente.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('cliente.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function carregarSelect2()
    {
        if(request()->ajax()){
            $clientes   =   Cliente::PesquisarPorNome(request()->get('q'))->limit(10)->orderBy('created_at','desc')->get();
            $retorno    =   [];

            foreach ($clientes as $key => $value) {
                $retorno[$key]['id'] = $value->id;
                $retorno[$key]['text'] = $value->nome;
                $retorno[$key]['nome'] = $value->nome;
                $retorno[$key]['telefone'] = $value->telefone01;

            }

            return response()->json($retorno);
        }else{
            return redirect()->route('cliente.index')->with('alerta',['tipo'=>'danger','msg'=>'Acesso negado.','icon'=>'ban']);
        }
    }
}
