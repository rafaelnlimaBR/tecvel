<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function index(Request $r)
    {
        $veiculos = Veiculo::pesquisarPorPlaca($r->input('placa'))
            ->orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Veiculos",
            "titulo_tabela" => "Lista de Veiculos"
        ];

        return view('admin.veiculos.index',$dados)->with('veiculos',$veiculos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Veículo",
            "titulo_formulario" =>'Novo'
        ];

        return view('admin.veiculos.formulario',$dados);

    }

    public function cadastrar()
    {
        try {
            Veiculo::gravar(\request());
            if (\request()->get('modal') == 1) {
                return redirect()->back()->with('alerta', ['tipo' => 'success', 'msg' => "Veículo cadastrado com sucesso", 'icon' => 'check', 'titulo' => "Sucesso"]);
            } else{
                return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'success','msg'=>"Cadastrado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
            }
        }catch (\Exception $e){
            return redirect()->route('veiculo.novo')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Veiculo",
            "titulo_formulario" =>'Editar'
        ];
        $Veiculo    =   Veiculo::find($id);


        return view('admin.veiculos.formulario',$dados)->with('veiculo',$Veiculo);
    }

    public function atualizar()
    {
        try{
//            return request();
            $id = Veiculo::atualizar(\request());
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'success','msg'=>"Editado com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);
        }catch (\Exception $e){
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }

    public function excluir()
    {
        try{
            $id = Veiculo::excluir(\request()->get('id'));
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'success','msg'=>"Excluido com sucesso",'icon'=>'check','titulo'=>"Sucesso"]);;
        }catch (\Exception $e){
            return redirect()->route('veiculo.index')->with('alerta',['tipo'=>'danger','msg'=>'Erro:'.$e->getMessage(),'icon'=>'ban','titulo'=>"Erro"]);
        }
    }
    public function carregarSelect2()
    {
        if(request()->ajax()){
            $veiculos   =   Veiculo::PesquisarPorPlaca(request()->get('q'))->limit(10)->orderBy('created_at','desc')->get();
            $retorno    =   [];

            foreach ($veiculos as $key => $value) {
                $retorno[$key]['id'] = $value->id;
                $retorno[$key]['text'] = $value->placa;
                $retorno[$key]['modelo'] = $value->modelo." - ".$value->mod_ano;
                $retorno[$key]['marca'] = $value->marca;
            }

            return response()->json($retorno);
        }else{
            return redirect()->route('cliente.index')->with('alerta',['tipo'=>'danger','msg'=>'Acesso negado.','icon'=>'ban']);
        }
    }
}
