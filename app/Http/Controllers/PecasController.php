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
