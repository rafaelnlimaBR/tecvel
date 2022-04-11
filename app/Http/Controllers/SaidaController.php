<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{

    public function index()
    {
        $saidas = Saida::all();

        $dados      =  [
            "titulo"    => "Caixa de Saidas",
            "titulo_tabela" => "Lista de saidas do caixa"
        ];

        return view('admin.saidas.index',$dados)->with('saidas',$saidas);
    }
}
