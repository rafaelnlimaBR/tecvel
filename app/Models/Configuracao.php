<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\throwException;

class Configuracao extends Model
{
    use HasFactory;
    protected $table        =   'configuracao';


    public static function atualizar (Request $r)
    {

        $configuracao                    =   Configuracao::find($r->get('id'));
        $configuracao->nome_empresa      =   $r->input('nome');
        $configuracao->email             =   $r->input('email');
        $configuracao->cnpj              =   $r->input('cnpj');
        $configuracao->telefone_fixo     =   $r->get('telefone_fixo');
        $configuracao->telefone_movel    =   $r->get('telefone_movel');
        $configuracao->endereco          =   $r->get('endereco');
        $configuracao->orcamento         =   $r->get('orcamento_id');
        $configuracao->ordem_servico     =   $r->get('os_id');
        $configuracao->aberto            =   $r->get('aberto');
        $configuracao->concluido         =   $r->get('concluido');
        $configuracao->nao_autorizado    =   $r->get('nao_autorizado');
        $configuracao->retorno           =   $r->get('retorno');
        $configuracao->autorizado        =   $r->get('autorizado');
        $configuracao->instagran        =   $r->get('instagran');
        $configuracao->facebook        =   $r->get('facebook');
        $configuracao->link_avaliacao        =   $r->get('avaliacao');

        if(\request()->hasFile('logo_empresa')){
            if(File::exists(public_path().'/imagens/'.$configuracao->logo)){
                File::delete(public_path().'/imagens/'.$configuracao->logo);
            }
            $logo = 'logo'.'.'.$r->file('logo_empresa')->getClientOriginalExtension();
            $configuracao->logo              =  $logo;
            \request()->file('logo_empresa')->move(public_path()."/imagens/",$logo);
        }

        if($configuracao->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }



    }

}
