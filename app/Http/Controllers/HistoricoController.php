<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Historico;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{

    public function totalValorAutorizadoAjax()
    {
        if(\request()->ajax()){

        }
        return "nao autorizado";

    }

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
            "titulo"    => "Cliente",
            "titulo_formulario" =>'Novo',
            'modal'             => 0,
            'fk_id'             =>  $historico->id,
            'route'        =>  route('contrato.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'tela'=>'faturar']),
            "valor_total"       =>  $total,
            'descricao'         =>  "pagamento do contrato: ".$historico->contrato->id
        ];

        return view('admin.entradas.includes.form',$dados);

    }

    public function pagar()
    {
        try{
//            if(\request()->ajax()){
                $pagamento  =   Entrada::gravar(\request());

                $historico  =   Historico::find(\request()->get('fk_id'));

                $historico->pagamentos()->attach($pagamento->id);
                return response()->json(['pagamentos'=>view('admin.contratos.includes.tabelaPagamentos')->with('historico',$historico)->render()]);
//            }
        }catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
//        return \request()->all();

    }


}
