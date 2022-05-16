<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Contrato;
use App\Models\Entrada;
use App\Models\Historico;
use App\Models\Peca;
use App\Models\TipoPagamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoricoController extends Controller
{

    public function invoice($id)
    {

        $historico    =      Historico::find($id);
//        dd($contrato->valorTotalPagamentos());
        if($historico == null){
            return redirect()->back(200)->with('alerta',['tipo'=>'warning','msg'=>"Nenhum contrato foi encontrato",'icon'=>'check','titulo'=>"Falha"]);
        }
        $dados      =  [
            "titulo"    => "Contrato",
            "contrato"          =>  $historico,
            'conf'              => Configuracao::find(1),
            "menu_open"     =>  "contratos",
            "menu_active"   =>  "contratos"
        ];

        return view('admin.contratos.includes.invoice',$dados);
    }

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
            "menu_open"     =>  "contratos"
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
            'taxas'             =>  TipoPagamentos::find($pagamento->taxa->formaPagamento->id)->taxas,
            "menu_open"     =>  "contratos"
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

    public function desvincularPeca()
    {
        try{
            $historico          =   Historico::find(\request()->get('historico'));
            $peca           =   Peca::find(\request()->get('peca'));
            $contrato       =   Contrato::find(\request()->get('contrato'));
            if($peca == null){
                return response()->json(["erro"=>"Historico null"]);
            }
            $historico->pecas()->detach($peca->id);

            return response()->json([
                'pecas'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->with('contrato',$contrato)->render(),
                'pedidos'=>view('admin.contratos.includes.tabelaPedidos')->with('historico',$historico)->with('contrato',$contrato)->render(),
            ]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    public function atualizarPeca(Request $r)
    {
        try{
            if($r->ajax() == true){

                $historico          =   Historico::find(\request()->get('historico_id'));
                $peca           =   Peca::find(\request()->get('peca_id'));
                $contrato       =   Contrato::find(\request()->get('contrato_id'));

                if($peca == null){
                    return response()->json(["erro"=>"Peca null"]);
                }

                $peca->atualizar($r->get('descricao'));

                DB::table('historico_peca')
                    ->where('id',$r->get('historico_peca'))
                    ->update([
                        'valor'             =>  $r->get('valor'),
                        'valor_fornecedor'  =>    $r->get('valor_fornecedor'),
                        'qnt'               =>  $r->get('qnt'),
                        'autorizado'        =>  $r->get('autorizado'),

                    ]);


                return response()->json([
                    'pecas'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->with('contrato',$contrato)->render(),
                    'pedidos'=>view('admin.contratos.includes.tabelaPedidos')->with('historico',$historico)->with('contrato',$contrato)->render(),
                ]);
            }

        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    public function adicionarPeca()
    {
        try{
            $historico      =   Historico::find(\request()->get('historico_id'));
            $contrato       =   Contrato::find(\request()->get('contrato_id'));
            if($historico == null){
                return response()->json(['erro'=>"historico null"]);
            }

            $peca   =   Peca::cadastrar(\request()->get('descricao'),\request()->get('valor'));

            $historico->pecas()->attach($peca->id,[
                'valor_fornecedor'          =>      \request()->get('valor_fornecedor'),
                'valor'                     =>      \request()->get('valor'),
                'qnt'                       =>      \request()->get('qnt'),
                'autorizado'                =>      \request()->get('autorizado')
            ]);

            return response()->json([
                'pecas'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->with('contrato',$contrato)->render(),
                'pedidos'=>view('admin.contratos.includes.tabelaPedidos')->with('historico',$historico)->with('contrato',$contrato)->render(),
            ]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }


}
