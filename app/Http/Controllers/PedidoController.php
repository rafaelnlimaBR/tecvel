<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Historico;
use App\Models\Peca;
use App\Models\Pedido;
use App\Models\Saida;
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

        $historico  =   Historico::find(\request()->get('historico_id'));
        try{
            $pedido = Pedido::gravar(\request());
            return redirect()->route('pedido.editar',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id'),'pedido_id'=>$pedido->id,'tela'=>'dados'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('pedido.novo',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id,$historico_id,$pedido_id)
    {
        $historico  =   Historico::find( \request('historico_id'));
        $pedido    =   Pedido::find($pedido_id);

        $dados      =  [
            "titulo"    => "Pedido",
            "titulo_formulario" =>'Editar',
            'fornecedores'      =>  Fornecedor::all(),
            'historico_id'      =>  $historico->id,
            'contrato_id'       =>  $historico->contrato->id,
            'pecas'             =>  $historico->pecas,
            'saidas'            =>  $pedido->pagamentos
        ];


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



    public function novoPagamento($id,$historico_id,$pedido_id)
    {
        $historico      =   Historico::find($historico_id);
        if($historico == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Histórico não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }





        $dados      =  [
            "titulo"    => "Faturar Pedido :".$pedido_id,
            "titulo_formulario" =>'Novo Pagamento ',
            'modal'             => 0,
            'fk_id'             =>  $pedido_id,
            'route'             =>  route('pedido.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'pedido_id'=>$pedido_id,'tela'=>'pagamentos']),
            "valor"             =>  0,
            'descricao'         =>  "Pagamento do pedido : ".$pedido_id,
            'action'            =>  route('pedido.pagar'),
        ];
//        return $dados;
        return view('admin.saidas.includes.form',$dados);

    }

    public function editarPagamento($id,$historico_id,$pedido_id,$saida_id)
    {
        $historico      =   Historico::find($historico_id);
        $saida          =   Saida::find($saida_id);
        if($historico == null or $saida == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Registro não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }




        $dados      =  [
            "titulo"    => "Faturar Pedido :".$pedido_id,
            "titulo_formulario" =>'Novo Pagamento ',
            'modal'             => 0,
            'fk_id'             =>  $pedido_id,
            'route'             =>  route('pedido.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'pedido_id'=>$pedido_id,'tela'=>'pagamentos']),
            "valor"             =>  0,
            'descricao'         =>  "Pagamento do pedido : ".$pedido_id,
            'action'            =>  route('pedido.atualizar.pagamento'),
            'pagamento'         =>  $saida,
            'action_excluir'    => route('pedido.excluir.pagamento')
        ];
//        return $dados;
        return view('admin.saidas.includes.form',$dados);

    }

    public function pagar()
    {


        $pedido  =   Pedido::find(\request()->get('fk_id'));
        try{

            $saida  =   Saida::gravar(\request());


            $pedido->pagamentos()->attach($saida->id);
            return redirect()->route('pedido.editar',['id'=>$pedido->historico->contrato->id,'historico_id'=>$pedido->historico->id,'pedido_id'=>$pedido->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$pedido->historico->contrato->id,'historico_id'=>$pedido->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Sucesso!','icon'=>'check']);
        }

    }

    public function excluirPagamento()
    {
        try{

            $pagamento  =   Saida::find(\request('pagamento_id'));
            $pagamento->excluir(\request());

            $pedido  =   Pedido::find(\request()->get('fk_id'));

            return redirect()->route('pedido.editar',['id'=>$pedido->historico->contrato->id,'historico_id'=>$pedido->historico->id,'pedido_id'=>$pedido->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro excluido com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$pedido->historico->contrato->id,'historico_id'=>$pedido->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível excluir o registro, ".$e->getMessage(),'titulo'=>'Erro!','icon'=>'check']);
        }
    }

    public function atualizarPagamento()
    {


        $pedido  =   Pedido::find(\request()->get('fk_id'));
        try{

            $saida  =   Saida::editar(\request());

            return redirect()->route('pedido.editar',['id'=>$pedido->historico->contrato->id,'historico_id'=>$pedido->historico->id,'pedido_id'=>$pedido->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$pedido->historico->contrato->id,'historico_id'=>$pedido->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Sucesso!','icon'=>'check']);
        }
    }
}
