<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Historico;
use App\Models\HistoricoPeca;
use App\Models\Peca;
use App\Models\Pedido;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PecasController extends Controller
{

    public function adicionarPedido(Request $r)
    {

        try {
              if ($r->ajax() == true) {

                $pedido =   Pedido::find(\request('pedido_id'));


                $historico_peca =   HistoricoPeca::find($r->get('historico_peca'));
//                return $r->all();
                if($r->get('selecionado') == "true"){
                    $historico_peca->pedido_id       =   $pedido->id;
                }elseif($r->get('selecionado') == "false"){
                    $historico_peca->pedido_id       =   null;
                }


                  $historico_peca->save();

                  return \response()->json($historico_peca);
        }

        } catch (\Exception $e) {
            return response()->json(['erro' => $e->getMessage()]);

        }
    }
}
