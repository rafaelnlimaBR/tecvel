<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Avaliacao extends Model
{
    use HasFactory;
    protected $table    =   'avaliacoes';
    private static $restricao = [
        'cliente'       =>  'required',
        'texto'       =>  'required',
        'sequencia'      =>     'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse(a) :attribute ',
    ];

    public static function validacao($dados)
    {

        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public function scopeHabilitados($query,$habilitado)
    {
        return $query->where('habilitado',$habilitado);
    }

    public function scopeSequenciadas($query,$seq)
    {
        return $query->orderby('sequencia',$seq);
    }

    public static function gravar(Request $r)
    {
        $avaliacao                         =   new Avaliacao();
        $avaliacao->cliente                   =   $r->get('cliente');
        $avaliacao->texto                    =   $r->get('texto');
        $avaliacao->habilitado             =   $r->get('habilitado');
        $avaliacao->sequencia             =   $r->get('sequencia');


        if($avaliacao->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $avaliacao;
    }

    public static function atualizar(Request $r)
    {
        $avaliacao        =   Avaliacao::find($r->get('id'));
        $avaliacao->cliente                   =   $r->get('cliente');
        $avaliacao->texto                    =   $r->get('texto');
        $avaliacao->habilitado             =   $r->get('habilitado');

        if($avaliacao->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }
        return $avaliacao;
    }

    public static function excluir($id)
    {
        $avaliacao        =   Avaliacao::find($id);
        if($avaliacao->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

}
