<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index(Request $r)
    {
        $avaliacao = Avaliacao::all();
        $dados      =  [
            "titulo"    => "Avaliacao",
            "titulo_tabela" => "Lista de Avaliacões",
            "menu_open"     =>  "site",
            "menu_active"   =>  "avaliacoes"
        ];

        return view('admin.avaliacao.index',$dados)->with('avaliacao',$avaliacao);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Avaliação",
            "titulo_formulario" =>'Novo',
            "menu_open"     =>  "site",
            "menu_active"   =>  "avaliacoes"
        ];

        return view('admin.avaliacao.formulario',$dados);

    }

    public function cadastrar()
    {
        try{

            $validacao  =   Avaliacao::validacao(request()->all());


            if($validacao->fails()){
                return redirect()->route('avaliacao.novo')->withErrors($validacao)->withInput();
            }
            $avaliacao = Avaliacao::gravar(\request());
            return redirect()->route('avaliacao.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('avaliacao.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Avaliacao",
            "titulo_formulario" =>'Editar',
            "menu_open"     =>  "site",
            "menu_active"   =>  "avaliacoes"
        ];

        $avaliacao    =   Avaliacao::find($id);


        return view('admin.avaliacao.formulario',$dados)->with('avaliacao',$avaliacao);
    }

    public function atualizar()
    {
        try{
            $validacao  =   Avaliacao::validacao(request()->all());


            if($validacao->fails()){
                return redirect()->route('avaliacao.editar',['id'=>\request('id')])->withErrors($validacao)->withInput();
            }
//
            $id = Avaliacao::atualizar(\request());
            return redirect()->route('avaliacao.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('avaliacao.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Avaliacao::excluir(\request()->get('id'));
            return redirect()->route('avaliacao.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('avaliacao.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
