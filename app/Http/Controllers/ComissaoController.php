<?php

namespace App\Http\Controllers;

use App\Models\Comissao;
use App\Models\Fornecedor;
use App\Models\Historico;
use App\Models\Saida;
use Illuminate\Http\Request;

class ComissaoController extends Controller
{
    public function novo($id,$historico_id)
    {
        $dados      =  [
            "titulo"    => "Comissao",
            "titulo_formulario" =>'Novo',
            'fornecedores'      =>  Fornecedor::all(),
            'historico_id'      =>  $historico_id,
            'contrato_id'       =>  $id
        ];
        return view('admin.comissao.formulario',$dados);
    }

    public function cadastrar()
    {

        $historico  =   Historico::find(\request()->get('historico_id'));
        try{
            $validacao  =   Comissao::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('comissao.novo',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id')])->withErrors($validacao)->withInput();

            }
            $comissao = Comissao::gravar(\request());

            return redirect()->route('comissao.editar',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id'),'comissao_id'=>$comissao->id,'tela'=>'dados'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('comissao.novo',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id,$historico_id,$comissao_id)
    {
        $historico  =   Historico::find($historico_id);
        $comissao    =   Comissao::find($comissao_id);

        $dados      =  [
            "titulo"    => "Serviços Comissao",
            "titulo_formulario" =>'Editar',
            'fornecedores'      =>  Fornecedor::all(),
            'historico_id'      =>  $historico->id,
            'contrato_id'       =>  $historico->contrato->id,
            'saidas'            =>  $comissao->pagamentos

        ];


        if($comissao == null){
            return redirect()->route('contrato.editar',['id'=>$id,'historico_id'=>$historico_id,'tela'=>'comissoes'])->with('alerta',['tipo'=>'warning','msg'=>"Nenhum registro encontrato",'icon'=>'check','titulo'=>"Erro"]);
        }

        return view('admin.comissao.formulario',$dados)->with('comissao',$comissao);
    }
    public function atualizar()
    {
        try{
            $comissao       =   Comissao::find(\request('comissao_id'));

            $validacao  =   Comissao::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'comissoes'])->withErrors($validacao)->withInput();

            }

            $comissao->atualizar(\request());
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'comissoes'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){


            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'comissoes'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
    public function excluir()
    {
        try{

            $comissao       =   Comissao::find(\request('comissao_id'));
            $id = $comissao->excluir();
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'comissoes'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'comissoes'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }


    public function novoPagamento($id,$historico_id,$comissao_id)
    {
        $historico      =   Historico::find($historico_id);
        $comissao       =   Comissao::find($comissao_id);
        if($historico == null or $comissao == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Histórico não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }





        $dados      =  [
            "titulo"    => "Faturar Comissao :".$comissao_id,
            "titulo_formulario" =>'Novo Pagamento ',
            'modal'             => 0,
            'fk_id'             =>  $comissao_id,
            'route'             =>  route('comissao.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'comissao_id'=>$comissao_id,'tela'=>'pagamentos']),
            "valor"             =>  $comissao->valor - $comissao->pagamentos()->sum('valor'),
            'descricao'         =>  "Pagamento do comissao : ".$comissao_id,
            'action'            =>  route('comissao.pagar'),
        ];
//        return $dados;
        return view('admin.saidas.includes.form',$dados);

    }

    public function editarPagamento($id,$historico_id,$comissao_id,$saida_id)
    {
        $historico      =   Historico::find($historico_id);
        $saida          =   Saida::find($saida_id);
        if($historico == null or $saida == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Registro não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }




        $dados      =  [
            "titulo"    => "Faturar Comissao :".$comissao_id,
            "titulo_formulario" =>'Novo Pagamento ',
            'modal'             => 0,
            'fk_id'             =>  $comissao_id,
            'route'             =>  route('comissao.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'comissao_id'=>$comissao_id,'tela'=>'pagamentos']),
            "valor"             =>  0,
            'descricao'         =>  "Pagamento do comissao : ".$comissao_id,
            'action'            =>  route('comissao.atualizar.pagamento'),
            'pagamento'         =>  $saida,
            'action_excluir'    => route('comissao.excluir.pagamento')
        ];
//        return $dados;
        return view('admin.saidas.includes.form',$dados);

    }

    public function pagar()
    {


        $comissao  =   Comissao::find(\request()->get('fk_id'));
        try{

            $saida  =   Saida::gravar(\request());


            $comissao->pagamentos()->attach($saida->id);
            return redirect()->route('comissao.editar',['id'=>$comissao->historico->contrato->id,'historico_id'=>$comissao->historico->id,'comissao_id'=>$comissao->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$comissao->historico->contrato->id,'historico_id'=>$comissao->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Sucesso!','icon'=>'check']);
        }

    }

    public function excluirPagamento()
    {
        try{

            $pagamento  =   Saida::find(\request('pagamento_id'));
            $pagamento->excluir(\request());

            $comissao  =   Comissao::find(\request()->get('fk_id'));

            return redirect()->route('comissao.editar',['id'=>$comissao->historico->contrato->id,'historico_id'=>$comissao->historico->id,'comissao_id'=>$comissao->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro excluido com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$comissao->historico->contrato->id,'historico_id'=>$comissao->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível excluir o registro, ".$e->getMessage(),'titulo'=>'Erro!','icon'=>'check']);
        }
    }

    public function atualizarPagamento()
    {


        $comissao  =   Comissao::find(\request()->get('fk_id'));
        try{

            $saida  =   Saida::editar(\request());

            return redirect()->route('comissao.editar',['id'=>$comissao->historico->contrato->id,'historico_id'=>$comissao->historico->id,'comissao_id'=>$comissao->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$comissao->historico->contrato->id,'historico_id'=>$comissao->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Sucesso!','icon'=>'check']);
        }
    }
}
