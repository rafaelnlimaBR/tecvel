<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Contato;
use App\Models\Contrato;
use App\Models\Entrada;
use App\Models\Saida;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {

        $dados      =  [
            "titulo"            =>  "Dashboardd",
            "contatos"  =>      Contato::visualizados(0)->orderBy('created_at','desc')->take(5)->get(),
            "comentarios"   =>  Comentario::visualizados(0)->orderBy('created_at','desc')->take(5)->get(),
            "contratos"     =>  Contrato::all(),
            "clientes"      =>  Cliente::all(),
            "entradas"      =>  Entrada::orderBy('data','desc')->take(5)->get(),
            "saidas"        =>  Saida::orderBy('data','desc')->take(5)->get(),
            "entradas_hj"   =>  Entrada::whereDate('data',Carbon::now())->sum('valor_total'),
            "saidas_hj"     =>  Saida::whereDate('data',Carbon::now())->sum('valor'),
            "menu_open"     =>  "dashboard"
        ];
        return view('admin.dashboard.index',$dados);
    }

    public function sair()
    {
        Auth::logout();

        return redirect()->route('site.inicio');
    }
}
