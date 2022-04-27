<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $r)
    {
        $categorias = Categoria::all();
        $dados      =  [
            "titulo"    => "Categorias",
            "titulo_tabela" => "Lista de Categorias"
        ];

        return view('admin.categorias.index',$dados)->with('categorias',$categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {


        $dados      =  [
            "titulo"    => "Categoria",
            "titulo_formulario" =>'Novo',

        ];

        return view('admin.categorias.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $validacao  =   Categoria::validacao(request()->all());

            if($validacao->fails()){
                return redirect()->route('categoria.novo')->withErrors($validacao)->withInput();
            }
            $categoria  =   new Categoria();
            $categoria  =   $categoria->gravar(\request());
            return redirect()->route('categoria.editar',['id'=>$categoria->id])->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('categoria.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Categoria",
            "titulo_formulario" =>'Editar'
        ];
        $categoria    =   Categoria::find($id);
        if($categoria   == null){
            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'danger','msg'=>"Nenhum registro encontrato",'icon'=>'check','titulo'=>"Erro"]);;
        }


        return view('admin.categorias.formulario',$dados)->with('categoria',$categoria);
    }

    public function atualizar()
    {
        try{
            $categoria  =   Categoria::find(\request('id'));
            $categoria  =   $categoria->atualizar(\request());
            return redirect()->route('categoria.editar',['id'=>$categoria->id])->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('categoria.editar',['id'=>$categoria->id])->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $categoria  =   Categoria::find(\request('id'));
            $categoria->excluir();
            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('categoria.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

}
