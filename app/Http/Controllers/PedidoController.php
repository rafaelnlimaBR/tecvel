<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Historico;
use App\Models\Peca;
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
            "titulo_formulario" =>'Novo',
            'fornecedores'      =>  Fornecedor::all(),
            'historico_id'      =>  \request('historico_id'),
            'contrato_id'       =>  Historico::find( \request('historico_id'))->contrato->id
        ];
        return view('admin.pedidos.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $pedido = Pedido::gravar(\request());
            $historico  =   Historico::find(\request()->get('historico_id'));
            return redirect()->route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id'),'tela'=>'pedidos'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('pedido.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id,$historico_id,$pedido_id)
    {
        $historico  =   Historico::find( \request('historico_id'));

        $dados      =  [
            "titulo"    => "Pedido",
            "titulo_formulario" =>'Editar',
            'fornecedores'      =>  Fornecedor::all(),
            'historico_id'      =>  $historico->id,
            'contrato_id'       =>  $historico->contrato->id,
            'pecas'             =>  $historico->pecas
        ];

        $pedido    =   Pedido::find($pedido_id);
        if($pedido == null){
            return redirect()->route('contrato.editar',['id'=>$id,'historico_id'=>$historico_id,'tela'=>'pedidos'])->with('alerta',['tipo'=>'warning','msg'=>"Nenhum registro encontrato",'icon'=>'check','titulo'=>"Erro"]);
        }

        return view('admin.pedidos.formulario',$dados)->with('pedido',$pedido);
    }

    public function atualizar()
    {
        try{

            $pedido = Pedido::atualizar(\request());
            return redirect()->route('contrato.editar',['id'=>$pedido->historico->contrato->id,'historico_id'=>$pedido->historico->id,'tela'=>'pedidos'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){


            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'pedidos'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Pedido::excluir(\request()->get('pedido_id'));
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'pedidos'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'pedidos'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }


}
