<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;


class FornecedorController extends Controller
{
    public function index(Request $r)
    {
        $fornecedores = Fornecedor::pesquisarPorNome($r->input('nome'))
            ->orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Fornecedores",
            "titulo_tabela" => "Lista de Fornecedores"
        ];

        return view('admin.fornecedor.index',$dados)->with('fornecedores',$fornecedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Fornecedor",
            "titulo_formulario" =>'Novo'
        ];

        return view('admin.fornecedor.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $id = Fornecedor::gravar(\request());
            return redirect()->route('fornecedor.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('fornecedor.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Fornecedor",
            "titulo_formulario" =>'Editar'
        ];
        $Fornecedor    =   Fornecedor::find($id);


        return view('admin.fornecedor.formulario',$dados)->with('fornecedor',$Fornecedor);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Fornecedor::atualizar(\request());
            return redirect()->route('fornecedor.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('fornecedor.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Fornecedor::excluir(\request()->get('id'));
            return redirect()->route('fornecedor.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('fornecedor.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function descontoAjax()
    {
        if(\request()->ajax()){
            $desconto       =   Fornecedor::find(\request()->get('fornecedor_id'))->desconto;
            return response()->json(['desconto'=>$desconto]);
        }else{
            return "acesso negado";
        }
    }

}
