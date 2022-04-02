<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Historico;
use App\Models\Peca;
use App\Models\Pedido;
use http\Env\Response;
use Illuminate\Http\Request;

class PecasController extends Controller
{
    public  function cadastrar()
    {
        try{
            $historico      =   Historico::find(\request()->get('historico_id'));
            $contrato       =   Contrato::find(\request()->get('contrato_id'));
            if($historico == null){
                return response()->json(['erro'=>"historico null"]);
            }

            $peca   =   Peca::cadastrar(\request());

            return response()->json([
                'pecas'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->with('contrato',$contrato)->render(),
                'pedidos'=>view('admin.contratos.includes.tabelaPedidos')->with('historico',$historico)->with('contrato',$contrato)->render(),
                                    ]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    public function excluir()
    {
        try{
            $historico          =   Historico::find(\request()->get('historico'));
            $peca           =   Peca::find(\request()->get('peca'));
            $contrato       =   Contrato::find(\request()->get('contrato'));
            if($peca == null){
                return response()->json(["erro"=>"Historico null"]);
            }
            $peca->excluir(\request()->get('peca'));

            return response()->json([
                'pecas'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->with('contrato',$contrato)->render(),
                'pedidos'=>view('admin.contratos.includes.tabelaPedidos')->with('historico',$historico)->with('contrato',$contrato)->render(),
            ]);
        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    public function atualizar(Request $r)
    {


        try{
            if($r->ajax() == true){

                $historico          =   Historico::find(\request()->get('historico_id'));
                $peca           =   Peca::find(\request()->get('peca_id'));
                $contrato       =   Contrato::find(\request()->get('contrato_id'));

                if($peca == null){
                    return response()->json(["erro"=>"Peca null"]);
                }

                $peca->atualizar(\request());

                return response()->json([
                    'pecas'=>view('admin.contratos.includes.tabelaPecas')->with('historico',$historico)->with('contrato',$contrato)->render(),
                    'pedidos'=>view('admin.contratos.includes.tabelaPedidos')->with('historico',$historico)->with('contrato',$contrato)->render(),
                ]);
            }

        }catch (\Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    public function adicionarPedido(Request $r)
    {
        try {
              if ($r->ajax() == true) {

                $peca = Peca::find(\request()->get('peca_id'));
                $historico  =   Historico::find(\request('historico_id'));
                $pecas  =   $historico->pecas;
                $pedido =   Pedido::find(\request('pedido_id'));
                if ($peca == null) {
                    return response()->json(["erro" => "Peca null"]);
                }

                $peca->adicionarPedido(\request());


        }

        } catch (\Exception $e) {
            return response()->json(['erro' => $e->getMessage()]);

        }
    }
}
