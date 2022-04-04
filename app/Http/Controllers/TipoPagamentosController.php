<?php

namespace App\Http\Controllers;

use App\Models\TipoPagamentos;
use Illuminate\Http\Request;

class TipoPagamentosController extends Controller
{
    public function listarTaxas()
    {

        $id =   \request()->get('id');
        return response()->json(TipoPagamentos::find($id)->taxas);
    }
}
