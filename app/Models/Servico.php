<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Servico extends Model
{
    use HasFactory;
    protected $table = "servicos";

    private static $restricao = [
        'descricao'       =>     'required|unique:servicos',
        'valor'             =>   'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse :attribute ',
    ];
    public static function validacao($dados)
    {
        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public function scopePesquisarPorDescricao($query, $nome)
    {
        return $query->where('descricao','like','%'.$nome.'%');
    }

    public static function gravar(Request $r)
    {
        $servico                =   new Servico();
        $servico->descricao     =   $r->get('descricao');
        $servico->valor         =   $r->get('valor');
        if($servico->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $servico;
    }

    public static function atualizar(Request $r)
    {
        $servico                =   Servico::find($r->get('id'));
        $servico->descricao     =   $r->get('descricao');
        $servico->valor         =   $r->get('valor');
        if($servico->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $servico->id;
    }

    public static function excluir($id)
    {
        $servico        =   Servico::find($id);
        if($servico->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

}
