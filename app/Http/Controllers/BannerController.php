<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $r)
    {
        $banner = Banner::sequenciadas('asc')->get();
        $dados      =  [
            "titulo"    => "Banner",
            "titulo_tabela" => "Lista de Banner",
            "menu_open"     =>  "site",
            "menu_active"   =>  "banner"
        ];

        return view('admin.banner.index',$dados)->with('banner',$banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Banner",
            "titulo_formulario" =>'Novo',
            "menu_open"     =>  "site",
            "menu_active"   =>  "banner"
        ];

        return view('admin.banner.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $validacao  =   Banner::validacao(request()->all());


            if($validacao->fails()){
                return redirect()->route('banner.novo',['id'=>\request('post_id')])->withErrors($validacao)->withInput();
            }


            $banner = Banner::gravar(\request());
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('banner.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Banner",
            "titulo_formulario" =>'Editar',
            "menu_open"     =>  "site",
            "menu_active"   =>  "banner"
        ];


        $Banner    =   Banner::find($id);


        return view('admin.banner.formulario',$dados)->with('banner',$Banner);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Banner::atualizar(\request());
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Banner::excluir(\request()->get('id'));
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('banner.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
}
