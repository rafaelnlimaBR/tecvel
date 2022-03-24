<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Contrato;
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
            "titulo"    => "Contratos",
            "titulo_tabela" => "Lista de Contratos"
        ];

        return view('admin.contratos.index',$dados)->with('contratos',$contratos);

    }

    public function novo($tipo)
    {
//        dd(Configuracao::find(1)->orcamento != $status);
        $tipo           =   TipoContrato::find($tipo);

        if(empty($tipo) ){
//            FAZIO
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'warning','msg'=>"Tipo de contrato não encontrado",'icon'=>'check','titulo'=>"Não permitido"]);
        }else{
            if((Configuracao::find(1)->orcamento != $tipo->id) && (Configuracao::find(1)->ordem_servico != $tipo->id)){
//                Status diferente do configurado no sistema
                return redirect()->route('contrato.index')->with('alerta',['tipo'=>'warning','msg'=>"Status diferente do configurado",'icon'=>'check','titulo'=>"Não permitido"]);
            }
        }

        $dados      =  [
            "titulo"    => "Contrato",
            "titulo_formulario" =>'Novo',
            'tipo_contrato'     =>  $tipo->id
        ];
        return view('admin.contratos.formulario',$dados);

    }

    public function cadastrar()
    {
//        return \request()->all();
        try{
            $id = Contrato::gravar(\request());
            return redirect()->route('contrato.editar',['id'=>$id])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('contrato.novo',['status'=>\request()->get('tipo_contrato')])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Contrato",
            "titulo_formulario" =>'Editar'
        ];
        $contrato    =   Contrato::find($id);
        if($contrato == null){
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'warning','msg'=>"Nenhum registro foi encontrado",'icon'=>'ban','titulo'=>"Erro"]);
        }


        return view('admin.contratos.formulario',$dados)->with('contrato',$contrato);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Contrato::atualizar(\request());
            return redirect()->route('contrato.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
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
}
