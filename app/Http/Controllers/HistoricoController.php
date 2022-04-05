<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Historico;
use App\Models\TipoPagamentos;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{


    public function faturar($historico_id)
    {
        $historico      =   Historico::find($historico_id);
        if($historico == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Histórico não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }




        $total          =   $historico->valorTotalComDesconto()-$historico->valorTotalPago();
        $dados      =  [
            "titulo"    => "Faturar Contrato ".$historico->contrato->id,
            "titulo_formulario" =>'Nova Fatura',
            'modal'             => 0,
            'fk_id'             =>  $historico->id,
            'route'             =>  route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura']),
            "valor"             =>  $total,
            'descricao'         =>  "pagamento do contrato: ".$historico->contrato->id,
            'action'            =>  route('historico.pagar'),
        ];
//        return $dados;
        return view('admin.entradas.includes.form',$dados);

    }

    public function pagar()
    {
        try{

                $pagamento  =   Entrada::gravar(\request());

                $historico  =   Historico::find(\request()->get('fk_id'));

                $historico->pagamentos()->attach($pagamento->id);
                return redirect()->route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura'])
                    ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Sucesso!','icon'=>'check']);
        }

    }

    public function editarPagamento($historico_id, $fatur_id)
    {

        $historico      =   Historico::find($historico_id);
        $pagamento      =   Entrada::find($fatur_id);

        if($historico == null or $pagamento == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Histórico ou Pagamento não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }

        $total          =   $historico->valorTotalComDesconto()-$historico->valorTotalPago();

        $dados      =  [
            "titulo"    => "Faturar Contrato ".$historico->contrato->id,
            "titulo_formulario" =>'Editar Fatura',
            'modal'             => 0,
            'fk_id'             =>  $historico->id,
            'route'             =>  route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura']),
            "valor_total"       =>  $total,
            'descricao'         =>  "pagamento do contrato: ".$historico->contrato->id,
            'action'            =>  route('historico.faturar.atualizar'),
            'action_excluir'    =>  route('historico.fatura.excluir'),
            'pagamento'         =>  $pagamento,
            'taxas'             =>  TipoPagamentos::find($pagamento->taxa->formaPagamento->id)->taxas
        ];

        return view('admin.entradas.includes.form',$dados);
    }

    public function atualizarPagamento()
    {
        try{

            $pagamento  =   Entrada::find(\request('pagamento_id'));
            $pagamento->atualizar(\request());

            $historico  =   Historico::find(\request()->get('fk_id'));

            return redirect()->route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Erro!','icon'=>'check']);
        }
    }

    public function excluirPagamento()
    {
        try{

            $pagamento  =   Entrada::find(\request('pagamento_id'));
            $pagamento->excluir(\request());

            $historico  =   Historico::find(\request()->get('fk_id'));

            return redirect()->route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro excluido com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível excluir o registro",'titulo'=>'Erro!','icon'=>'check']);
        }
    }

}
