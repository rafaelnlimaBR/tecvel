<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Historico;
use App\Models\Saida;
use App\Models\Terceirizados;
use Illuminate\Http\Request;

class TerceirizadosController extends Controller
{

    public function novo($id,$historico_id)
    {
        $dados      =  [
            "titulo"    => "Serviço Terceirizado",
            "titulo_formulario" =>'Novo',
            'fornecedores'      =>  Fornecedor::all(),
            'historico_id'      =>  $historico_id,
            'contrato_id'       =>  $id,
            "menu_open"     =>  "contratos"
        ];
        return view('admin.terceirizados.formulario',$dados);
    }

    public function cadastrar()
    {

        $historico  =   Historico::find(\request()->get('historico_id'));
        try{
            $validacao  =   Terceirizados::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('terceirizado.novo',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id')])->withErrors($validacao)->withInput();

            }

            $terceirizado = Terceirizados::gravar(\request());

            return redirect()->route('terceirizado.editar',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id'),'terceirizado_id'=>$terceirizado->id,'tela'=>'dados'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('terceirizado.novo',['id'=>$historico->contrato->id,'historico_id'=>\request()->get('historico_id')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id,$historico_id,$terceirizado_id)
    {
        $historico  =   Historico::find($historico_id);
        $terceirizado    =   Terceirizados::find($terceirizado_id);

        $dados      =  [
            "titulo"    => "Serviços Terceirizados",
            "titulo_formulario" =>'Editar',
            'fornecedores'      =>  Fornecedor::all(),
            'historico_id'      =>  $historico->id,
            'contrato_id'       =>  $historico->contrato->id,
            'saidas'            =>  $terceirizado->pagamentos,
            "menu_open"     =>  "contratos"

        ];


        if($terceirizado == null){
            return redirect()->route('contrato.editar',['id'=>$id,'historico_id'=>$historico_id,'tela'=>'terceirizado'])->with('alerta',['tipo'=>'warning','msg'=>"Nenhum registro encontrato",'icon'=>'check','titulo'=>"Erro"]);
        }

        return view('admin.terceirizados.formulario',$dados)->with('terceirizado',$terceirizado);
    }
    public function atualizar()
    {
        try{
            $terceirizado       =   Terceirizados::find(\request('terceirizado_id'));
//            dd($terceirizado);
            $terceirizado->atualizar(\request());
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'terceirizados'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){


            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'terceirizados'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
    public function excluir()
    {
        try{

            $terceirizado       =   Terceirizados::find(\request('terceirizado_id'));
            $id = $terceirizado->excluir();
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'terceirizados'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>\request('contrato_id'),'historico_id'=>\request('historico_id'),'tela'=>'terceirizados'])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }


    public function novoPagamento($id,$historico_id,$terceirizado_id)
    {
        $historico      =   Historico::find($historico_id);
        $terceirizado   =   Terceirizados::find($terceirizado_id);
        if($historico == null or $terceirizado == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Registro não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }





        $dados      =  [
            "titulo"    => "Faturar Terceirizado :".$terceirizado_id,
            "titulo_formulario" =>'Novo Pagamento ',
            'modal'             => 0,
            'fk_id'             =>  $terceirizado_id,
            'route'             =>  route('terceirizado.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'terceirizado_id'=>$terceirizado_id,'tela'=>'pagamentos']),
            "valor"             =>  $terceirizado->valor - $terceirizado->pagamentos()->sum('valor'),
            'descricao'         =>  "Pagamento do terceirizado : ".$terceirizado_id,
            'action'            =>  route('terceirizado.pagar'),
            "menu_open"     =>  "contratos"
        ];
//        return $dados;
        return view('admin.saidas.includes.form',$dados);

    }

    public function editarPagamento($id,$historico_id,$terceirizado_id,$saida_id)
    {
        $historico      =   Historico::find($historico_id);
        $saida          =   Saida::find($saida_id);
        if($historico == null or $saida == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Registro não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }




        $dados      =  [
            "titulo"    => "Faturar Terceirizado :".$terceirizado_id,
            "titulo_formulario" =>'Novo Pagamento ',
            'modal'             => 0,
            'fk_id'             =>  $terceirizado_id,
            'route'             =>  route('terceirizado.editar',['id'=>$historico->contrato->id,'historico_id'=>$historico->id,'terceirizado_id'=>$terceirizado_id,'tela'=>'pagamentos']),
            "valor"             =>  0,
            'descricao'         =>  "Pagamento do terceirizado : ".$terceirizado_id,
            'action'            =>  route('terceirizado.atualizar.pagamento'),
            'pagamento'         =>  $saida,
            'action_excluir'    => route('terceirizado.excluir.pagamento'),
            "menu_open"     =>  "contratos"
        ];
//        return $dados;
        return view('admin.saidas.includes.form',$dados);

    }

    public function pagar()
    {


        $terceirizado  =   Terceirizados::find(\request()->get('fk_id'));
        try{

            $saida  =   Saida::gravar(\request());


            $terceirizado->pagamentos()->attach($saida->id);
            return redirect()->route('terceirizado.editar',['id'=>$terceirizado->historico->contrato->id,'historico_id'=>$terceirizado->historico->id,'terceirizado_id'=>$terceirizado->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$terceirizado->historico->contrato->id,'historico_id'=>$terceirizado->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Sucesso!','icon'=>'check']);
        }

    }

    public function excluirPagamento()
    {
        try{

            $pagamento  =   Saida::find(\request('pagamento_id'));
            $pagamento->excluir(\request());

            $terceirizado  =   Terceirizados::find(\request()->get('fk_id'));

            return redirect()->route('terceirizado.editar',['id'=>$terceirizado->historico->contrato->id,'historico_id'=>$terceirizado->historico->id,'terceirizado_id'=>$terceirizado->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro excluido com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$terceirizado->historico->contrato->id,'historico_id'=>$terceirizado->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível excluir o registro, ".$e->getMessage(),'titulo'=>'Erro!','icon'=>'check']);
        }
    }

    public function atualizarPagamento()
    {


        $terceirizado  =   Terceirizados::find(\request()->get('fk_id'));
        try{

            $saida  =   Saida::editar(\request());

            return redirect()->route('terceirizado.editar',['id'=>$terceirizado->historico->contrato->id,'historico_id'=>$terceirizado->historico->id,'terceirizado_id'=>$terceirizado->id,'tela'=>'pagamentos'])
                ->with('alerta',['tipo'=>'success','msg'=>"Registro realizado com sucesso",'titulo'=>'Sucesso!','icon'=>'check']);

        }catch (\Exception $e){
            return redirect()->route('contrato.editar',['id'=>$terceirizado->historico->contrato->id,'historico_id'=>$terceirizado->historico->id,'tela'=>'fatura'])
                ->with('alerta',['tipo'=>'danger','msg'=>"Não foi possível faturar",'titulo'=>'Sucesso!','icon'=>'check']);
        }
    }

}
