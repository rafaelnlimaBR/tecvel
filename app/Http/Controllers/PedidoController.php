<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $r)
    {
        $pedidos = Pedido::
            orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Pedidos",
            "titulo_tabela" => "Lista de Pedidos"
        ];

        return view('admin.pedidos.index',$dados)->with('pedidos',$pedidos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Pedido",
            "titulo_formulario" =>'Novo'
        ];
        return view('admin.pedidos.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $id = Pedido::gravar(\request());
            return redirect()->route('pedido.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('pedido.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Pedido",
            "titulo_formulario" =>'Editar'
        ];
        $pedido    =   Pedido::find($id);


        return view('admin.pedidos.formulario',$dados)->with('pedido',$pedido);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Pedido::atualizar(\request());
            return redirect()->route('pedido.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('pedido.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Pedido::excluir(\request()->get('id'));
            return redirect()->route('pedido.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('pedido.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

}
