<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Historico;
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
        $desconto_peca  =   $historico->desconto_peca;
        $desconto_servico  =   $historico->desconto_servico;
        $total_pago     =   $historico->valorTotalPago();
        $valor_servico  =   $historico->valorTotalServicoAutorizado();
        $valor_peca     =   $historico->valorTotalPecasAutorizado();
        $total          =  $valor_peca + $valor_servico;
        $dados      =  [
            "titulo"    => "Faturar Contrato ".$historico->contrato->id,
            "titulo_formulario" =>'Nova Fatura',
            'modal'             => 0,
            'fk_id'             =>  $historico->id,
            'route'             =>  route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'fatura']),
            "valor_total"       =>  $total,
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


}
