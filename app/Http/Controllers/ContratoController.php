<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Contrato;
use App\Models\Historico;
use App\Models\Servico;
use App\Models\Status;
use App\Models\TipoContrato;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ContratoController extends Controller
{
    public function index()
    {
        $contratos = Contrato::orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"            =>  "Contratos",
            "titulo_tabela"     =>  "Lista de Contratos",
            "menu_open"     =>  "contratos",
            "menu_active"   =>  "contratos"
        ];

        return view('admin.contratos.index',$dados)->with('contratos',$contratos);

    }

    public function novo($tipo)
    {

        $tipo           =   TipoContrato::find($tipo);

        if(empty($tipo) ){
//            FAZIO
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Tipo de contrato não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }else{
            if((Configuracao::find(1)->orcamento != $tipo->id) && (Configuracao::find(1)->ordem_servico != $tipo->id)){
//                Status diferente do configurado no sistema
                return redirect()->route('contrato.index')
                    ->with('alerta',['tipo'=>'warning','msg'=>"Status diferente do configurado",'icon'=>'check','titulo'=>"Não permitido"]);
            }
        }

        $dados      =  [
            "titulo"    => "Contrato",
            "titulo_formulario" =>$tipo->descricao,
            'tipo_contrato'     =>  $tipo->id,
            "menu_open"     =>  "contratos",
            "menu_active"   =>  "contratos"
        ];
        return view('admin.contratos.formulario',$dados);

    }

    public function cadastrar()
    {
//        return request()->all();
        try{
            $validacao  =   Contrato::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('cliente.novo',['tipo'=>\request()->get('tipo_contrato')])->withErrors($validacao)->withInput();
            }

            $contrato = Contrato::gravar(\request());
            return redirect()->route('contrato.editar',['id'=>$contrato->id,'historico_id'=>$contrato->historicos->last()->id,'tela'=>'dados'])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.novo',['tipo'=>\request()->get('tipo_contrato')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id,$historico_id)
    {
        $contrato    =   Contrato::find($id);
       
        $dados      =  [
            "titulo"    => "Contrato",
            "titulo_formulario" =>'Editar',
            "servicos"          =>  Servico::orderby('id','desc'),
            'conf'              => Configuracao::find(1),
            "menu_open"     =>  "contratos",
            "menu_active"   =>  "contratos"

        ];
        $contrato    =      Contrato::find($id);

//        Verificando se o id do historico pertence a o id do contrato
        $existe =   false;
        foreach ($contrato->historicos as $h){
            if($h->id == $historico_id){
                $existe =   true;
            }
        }
        if($existe == false){
            return redirect()->route('contrato.index')
                ->with('active',"dados")
                ->with('alerta',['tipo'=>'warning','msg'=>'Histórico não condiz com o contrato','icon'=>'ban','titulo'=>"Erro"]);
        }
        $historico   =      Historico::find($historico_id);

        if($contrato == null){
            return redirect()->route('contrato.index')
                ->with('alerta',['tipo'=>'warning','msg'=>"Nenhum registro foi encontrado",'icon'=>'ban','titulo'=>"Erro"]);
        }

        return view('admin.contratos.formulario',$dados)
            ->with('contrato',$contrato)->with('historico',$historico);
    }

    public function atualizar()
    {

        try{

            $id = Contrato::atualizar(\request());
            return redirect()->route('contrato.editar',
                [
                    'id'                =>  \request('contrato_id'),
                    'historico_id'      =>  \request('historico_id'),
                    'tela'              =>  'dados'

                ])
                ->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Contrato::excluir(\request()->get('id'));
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function atualizarStatus()
    {
        try{
            $contrato   =   Contrato::find(\request()->get('contrato_id'));
//            dd(\request()->all());
            $contrato->atualizarStatus(\request());
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function invoice($id)
    {

        $contrato    =      Contrato::find($id);
//        dd($contrato->valorTotalPagamentos());
        if($contrato == null){
            return redirect()->back(200)->with('alerta',['tipo'=>'warning','msg'=>"Nenhum contrato foi encontrato",'icon'=>'check','titulo'=>"Falha"]);
        }
        $dados      =  [
            "titulo"    => "Contrato",
            "contrato"          =>  $contrato,
            'conf'              => Configuracao::find(1),
            "menu_open"     =>  "contratos",
            "menu_active"   =>  "contratos"
        ];

        return view('admin.contratos.includes.invoice',$dados);
    }
}
